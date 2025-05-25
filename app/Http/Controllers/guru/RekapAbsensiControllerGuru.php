<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\AbsensiGuruModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiGuruExport;

class RekapAbsensiControllerGuru extends Controller
{
    public function rekapAbsensi()
    {
        $dataAbsensiGuru = AbsensiGuruModel::where('id_guru', 2) // Ganti dengan ID guru yang sesuai
            ->orderBy('tanggal', 'desc')
            ->join('guru', 'absensi_guru.id_guru', '=', 'guru.id')
            ->get();

        return view('guru.rekap-absensi.rekap-absensi', compact('dataAbsensiGuru')); // Adjust the view path as necessary
    }

    public function exportExcel()
    {
        return Excel::download(new AbsensiGuruExport, 'rekap-absensi.xlsx');
    }
}
