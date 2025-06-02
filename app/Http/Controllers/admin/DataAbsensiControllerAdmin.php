<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsensiGuruModel;
use App\Models\GuruModel;
use Carbon\Carbon;
use App\Helpers\WhatsappHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;



class DataAbsensiControllerAdmin extends Controller
{

    public function dataAbsensi(Request $request)
    {
        $tanggal = $request->query('tanggal', Carbon::today()->toDateString());


        $query = AbsensiGuruModel::join('guru', 'absensi_guru.id_guru', '=', 'guru.id')
            ->orderBy('tanggal', 'desc');

        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        $dataAbsensi = $query->get();

        return view('admin.data-absensi.data-absensi', compact('dataAbsensi'));
    }


    public function rekapHariIni(Request $request)
    {
        $tanggal = $request->input('tanggal');

        if (!$tanggal) {
            return redirect()->back()->with('error', 'Tanggal rekap harus dipilih.');
        }

        $tanggalRekap = Carbon::parse($tanggal)->toDateString();

        $guruIds = GuruModel::pluck('id');
        $guruSudahAbsen = AbsensiGuruModel::where('tanggal', $tanggalRekap)->pluck('id_guru');
        $guruBelumAbsen = $guruIds->diff($guruSudahAbsen);

        $daftarTidakHadir = [];

        foreach ($guruBelumAbsen as $id_guru) {
            $guru = GuruModel::find($id_guru);

            AbsensiGuruModel::create([
                'id_guru' => $id_guru,
                'nama' => $guru->nama,
                'tanggal' => $tanggalRekap,
                'waktu_masuk' => null,
                'status' => 'Tidak Hadir',
            ]);

            $daftarTidakHadir[] = $guru->nama;
        }

        // ✅ Kirim WA hanya jika ada yang tidak hadir
        if (count($daftarTidakHadir) > 0) {
            $pesan = "*Rekap Absensi - $tanggalRekap*\n\n";
            $pesan .= "Guru Tidak Hadir:\n";

            foreach ($daftarTidakHadir as $nama) {
                $pesan .= "- $nama\n";
            }

            $nomorAtasan = '6285668947486'; // format internasional tanpa +
            $token = env('FONNTE_TOKEN');

            $response = Http::asForm()->withHeaders([
                'Authorization' => $token
            ])->post('https://api.fonnte.com/send', [
                'target' => $nomorAtasan,
                'message' => $pesan,
                'delay' => 1,
                'countryCode' => '62'
            ]);

            Log::info('FONNTE WA Response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if (!$response->json('status')) {
                return redirect()->back()->with('error', 'Rekap berhasil, tapi WA gagal dikirim: ' . $response->json('reason'));
            }
        }

        return redirect()->back()->with('success', 'Rekap absensi tanggal ' . $tanggalRekap . ' berhasil dilakukan.');
    }
}
