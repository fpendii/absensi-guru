<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\AbsensiGuruModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiGuruExport;
use Illuminate\Support\Facades\Auth;
Use App\Models\GuruModel;

class RekapAbsensiControllerGuru extends Controller
{
    public function rekapAbsensi()
{
    // Ambil ID guru dari user yang sedang login
    $idGuru = Auth::user()->id;
    // Ambil data guru berdasarkan ID (misalnya ID 2)
    $dataGuru = GuruModel::where('user_id', $idGuru)->first();
    if (!$dataGuru) {
        return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
    }



    // Ambil data absensi berdasarkan ID guru
    $dataAbsensiGuru = AbsensiGuruModel::where('id_guru',$dataGuru->id)
        ->orderBy('tanggal', 'desc')
        ->join('guru', 'absensi_guru.id_guru', '=', 'guru.id')
        ->get();

    return view('guru.rekap-absensi.rekap-absensi', compact('dataAbsensiGuru'));
}


    public function exportExcel()
    {
        return Excel::download(new AbsensiGuruExport, 'rekap-absensi.xlsx');
    }
}
