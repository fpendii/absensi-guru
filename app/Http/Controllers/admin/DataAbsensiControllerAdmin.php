<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataAbsensiControllerAdmin extends Controller
{
    public function dataAbsensi()
    {
        // Logic to retrieve and display attendance data
        // This could involve fetching data from a model and passing it to a view

        return view('admin.data-absensi.data-absensi'); // Adjust the view path as necessary
    }
}
