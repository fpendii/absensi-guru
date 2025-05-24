<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LokasiSekolahControllerAdmin extends Controller
{
    public function lokasiSekolah()
    {
        // Logic to retrieve and display school location data
        // This could involve fetching data from a model and passing it to a view

        return view('admin.lokasi-sekolah.lokasi-sekolah'); // Adjust the view path as necessary
    }
}
