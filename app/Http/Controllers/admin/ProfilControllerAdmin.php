<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilControllerAdmin extends Controller
{
    public function profil()
    {
        // Logic to retrieve and display profile data
        // This could involve fetching data from a model and passing it to a view

        return view('admin.profil.profil'); // Adjust the view path as necessary
    }
}
