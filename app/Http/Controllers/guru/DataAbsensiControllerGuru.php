<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\GuruModel;
use Illuminate\Http\Request;
use App\Models\AbsensiGuruModel;
use App\Models\Lokasi; // Import model Lokasi
use App\Models\LokasiModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Import Carbon untuk tanggal dan waktu

class DataAbsensiControllerGuru extends Controller
{
    /**
     * Menampilkan halaman absensi untuk guru.
     * Mengambil lokasi sekolah dari database untuk ditampilkan di peta.
     *
     * @return \Illuminate\View\View
     */
    public function dataAbsensi()
    {
        // Ambil ID guru dari user yang sedang login
        $idGuru = Auth::user()->id;
        // Ambil data guru berdasarkan user_id
        $dataGuru = GuruModel::where('user_id', $idGuru)->first();

        if (!$dataGuru) {
            // Jika data guru tidak ditemukan, arahkan kembali dengan pesan error
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }

        // Cek apakah guru sudah absen hari ini
        $absensiHariIni = AbsensiGuruModel::where('id_guru', $dataGuru->id)
            ->whereDate('tanggal', date('Y-m-d'))
            ->exists(); // akan bernilai true jika sudah absen

        // --- Ambil data lokasi sekolah dari database ---
        // Asumsi hanya ada satu entri lokasi sekolah yang relevan untuk absensi.
        $lokasiSekolah = LokasiModel::first();

        // Jika belum ada data lokasi di database, berikan nilai default
        if (!$lokasiSekolah) {
            $lokasiSekolah = new LokasiModel([
                'sekolahLat' => '-6.200000',    // Default Latitude (contoh: Jakarta)
                'sekolahLong' => '106.816666',  // Default Longitude (contoh: Jakarta)
                'radius' => 500,                // Default Radius dalam meter
            ]);
        }

        // Dapatkan waktu saat ini untuk ditampilkan di view
        $now = Carbon::now();

        // Kirim data guru, status absensi hari ini, lokasi sekolah, dan waktu saat ini ke view
        return view('guru.data-absensi.data-absensi', compact('dataGuru', 'absensiHariIni', 'lokasiSekolah', 'now'));
    }

    /**
     * Menyimpan data absensi guru.
     * Termasuk validasi lokasi berdasarkan radius sekolah.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'id_guru' => 'required|exists:guru,id', // Pastikan ID guru valid (sesuaikan 'gurus' dengan nama tabel guru Anda)
            'latitude' => 'required|numeric',       // Latitude pengguna
            'longitude' => 'required|numeric',      // Longitude pengguna
            'status' => 'required|in:hadir,izin,sakit', // Status absensi
            'waktu' => 'required', // Waktu masuk (dari frontend)
            'tanggal' => 'required', // Tanggal (dari frontend)
            // 'keterangan' => 'nullable|string', // Keterangan opsional
        ]);

        // Ambil data guru berdasarkan ID yang dikirim dari form
        $dataGuru = GuruModel::where('id', $request->id_guru)->first();
        if (!$dataGuru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }

        // --- Logika Validasi Lokasi untuk Status 'hadir' ---
        $userLat = (float)$request->input('latitude');
        $userLong = (float)$request->input('longitude');

        // Ambil lokasi sekolah dari database untuk validasi server-side
        $lokasiSekolah = LokasiModel::first();
        if (!$lokasiSekolah) {
            return redirect()->back()->with('error', 'Data lokasi sekolah belum diatur di sistem.');
        }

        // Pastikan konversi ke float/integer karena dari DB bisa berupa string (VARCHAR)
        $sekolahLat = (float)$lokasiSekolah->sekolahLat;
        $sekolahLong = (float)$lokasiSekolah->sekolahLong;
        $radiusMaks = (int)$lokasiSekolah->radius; // Radius dalam meter

        // Jika status yang dipilih adalah 'hadir', lakukan pengecekan jarak
        if ($request->status === 'hadir') {
            $distance = $this->hitungJarakHaversine($userLat, $userLong, $sekolahLat, $sekolahLong);

            if ($distance > $radiusMaks) {
                // Jika di luar radius, kembalikan dengan pesan error
                return redirect()->back()->with('error', 'Anda berada di luar radius absensi yang diperbolehkan untuk status Hadir. Jarak Anda: ' . round($distance, 2) . ' meter.');
            }
        }

        // --- Persiapan Data Absensi ---
        $tanggal = date('Y-m-d', strtotime($request->tanggal)); // Pastikan format tanggal benar
        $waktuMasuk = date('H:i:s', strtotime($request->waktu)); // Pastikan format waktu benar

        $dataAbsensi = [
            'id_guru' => $dataGuru->id,
            'tanggal' => $tanggal,
            'waktu_masuk' => $waktuMasuk,
            'status' => $request->status,
            'latitude_guru' => $userLat,    // Simpan latitude guru saat absen
            'longitude_guru' => $userLong,  // Simpan longitude guru saat absen
            'keterangan' => $request->keterangan ?? null, // Keterangan opsional
        ];

        try {
            // Simpan ke database
            AbsensiGuruModel::create($dataAbsensi);
            return redirect()->back()->with('success', 'Data absensi berhasil disimpan!');
        } catch (\Exception $e) {
            // Tangani error jika penyimpanan gagal
            return redirect()->back()->with('error', 'Gagal menyimpan data absensi: ' . $e->getMessage());
        }
    }

    /**
     * Fungsi pembantu untuk menghitung jarak antara dua titik koordinat (Haversine formula).
     *
     * @param float $lat1 Latitude titik 1
     * @param float $lon1 Longitude titik 1
     * @param float $lat2 Latitude titik 2
     * @param float $lon2 Longitude titik 2
     * @return float Jarak dalam meter
     */
    private function hitungJarakHaversine($lat1, $lon1, $lat2, $lon2)
    {
        $R = 6371e3; // Radius bumi dalam meter
        $phi1 = deg2rad($lat1);
        $phi2 = deg2rad($lat2);
        $deltaPhi = deg2rad($lat2 - $lat1);
        $deltaLambda = deg2rad($lon2 - $lon1);

        $a = sin($deltaPhi / 2) * sin($deltaPhi / 2) +
             cos($phi1) * cos($phi2) *
             sin($deltaLambda / 2) * sin($deltaLambda / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $R * $c; // Jarak dalam meter
        return $distance;
    }
}
