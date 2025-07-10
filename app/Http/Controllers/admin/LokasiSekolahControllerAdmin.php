<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LokasiModel; // Pastikan Anda sudah mengimpor model Lokasi

class LokasiSekolahControllerAdmin extends Controller
{
    /**
     * Menampilkan halaman pengaturan lokasi sekolah.
     * Mengambil data lokasi dari database dan mengirimkannya ke view.
     *
     * @return \Illuminate\View\View
     */
    public function lokasiSekolah()
    {
        $lokasi = LokasiModel::first();

        if (!$lokasi) {
            $lokasi = new LokasiModel([
                'sekolahLat' => '-6.200000',
                'sekolahLong' => '106.816666',
                'radius' => 500,
            ]);
        }

        return view('admin.lokasi-sekolah.lokasi-sekolah', compact('lokasi'));
    }

    /**
     * Menyimpan atau memperbarui lokasi sekolah ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateLokasiSekolah(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'alamat' => 'required|string|max:255',
        ]);

        $lokasi = LokasiModel::firstOrNew([]);

        $lokasi->sekolahLat = $request->input('latitude');
        $lokasi->sekolahLong = $request->input('longitude');
        $lokasi->nama_alamat = $request->input('alamat');
        $lokasi->radius = 500;

        $lokasi->save();

        return redirect()->back()->with('success', 'Lokasi sekolah berhasil diperbarui!');
    }
}
