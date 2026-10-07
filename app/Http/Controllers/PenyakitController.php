<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;

class PenyakitController extends Controller
{
    public function index()
    {
        $penyakits = Penyakit::all();
        return view('penyakit.index', compact('penyakits'));
    }
}