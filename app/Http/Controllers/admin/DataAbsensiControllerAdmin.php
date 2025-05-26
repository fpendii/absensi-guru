<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsensiGuruModel;
use App\Models\GuruModel;
use Carbon\Carbon;


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

        // Ambil semua ID guru
        $guruIds = GuruModel::pluck('id');

        // Ambil ID guru yang sudah absen pada tanggal tersebut
        $guruSudahAbsen = AbsensiGuruModel::where('tanggal', $tanggalRekap)->pluck('id_guru');

        // Cari guru yang belum absen
        $guruBelumAbsen = $guruIds->diff($guruSudahAbsen);

        // Tambahkan absensi status "Tidak Hadir"
        foreach ($guruBelumAbsen as $id_guru) {
            $guru = GuruModel::find($id_guru);

            AbsensiGuruModel::create([
                'id_guru' => $id_guru,
                'nama' => $guru->nama,
                'tanggal' => $tanggalRekap,
                'waktu_masuk' => null,
                'status' => 'Tidak Hadir',
            ]);
        }

        return redirect()->back()->with('success', 'Rekap absensi tanggal ' . $tanggalRekap . ' berhasil dilakukan.');
    }
}
