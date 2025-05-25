<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GuruModel;

class DataGuruControllerAdmin extends Controller
{
    public function dataGuru()
    {
        // Fetch all data from the GuruModel
        $dataGuru = GuruModel::with('user')->get();


        return view('admin.data-guru.data-guru',compact('dataGuru'));
    }

    public function create()
    {
        // Show the form to create a new Guru
        return view('admin.data-guru.create');
    }
}
