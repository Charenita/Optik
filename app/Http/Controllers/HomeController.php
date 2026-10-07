<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
}