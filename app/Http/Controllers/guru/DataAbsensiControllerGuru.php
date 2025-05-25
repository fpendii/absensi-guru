<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\GuruModel;
use Illuminate\Http\Request;
use App\Models\AbsensiGuruModel;

class DataAbsensiControllerGuru extends Controller
{
    public function dataAbsensi()
{
    $dataGuru = GuruModel::where('id', 2)->first();

    if (!$dataGuru) {
        return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
    }

    // Cek apakah guru sudah absen hari ini
    $absensiHariIni = AbsensiGuruModel::where('id_guru', $dataGuru->id)
        ->whereDate('tanggal', date('Y-m-d'))
        ->exists(); // akan bernilai true jika sudah absen

    return view('guru.data-absensi.data-absensi', compact('dataGuru', 'absensiHariIni'));
}


    public function store(Request $request)
    {
        $dataGuru = GuruModel::where('id', $request->id_guru)->first();
        if (!$dataGuru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }
        $tanggal = date('Y-m-d', strtotime($request->tanggal));

        $dataAbsensi = [
            'id_guru' => $dataGuru->id, // Ganti dengan ID guru yang sesuai
            'tanggal' => $tanggal,
            'waktu_masuk' => $request->waktu,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ];

        // Simpan ke database (logika penyimpanan tergantung pada model yang digunakan)
        AbsensiGuruModel::create($dataAbsensi);

        return redirect()->back()->with('success', 'Data absensi berhasil disimpan.');
    }
}
