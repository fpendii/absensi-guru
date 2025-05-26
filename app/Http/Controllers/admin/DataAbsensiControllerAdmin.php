<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsensiGuruModel;
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
}
