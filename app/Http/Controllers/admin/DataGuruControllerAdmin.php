<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataGuruControllerAdmin extends Controller
{
    public function dataGuru()
    {
        // Logic to retrieve and display data for teachers (guru)
        // This could involve fetching data from a model and passing it to a view

        return view('admin.data-guru.data-guru'); // Adjust the view path as necessary
    }
}
