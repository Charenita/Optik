<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Gejala;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatController extends Controller
{
    public function index()
    {
        $diagnosas = Diagnosa::where('user_id', Auth::id())
            ->with('penyakit')
            ->latest()
            ->get();

        return view('riwayat.index', compact('diagnosas'));
    }

    public function show($id)
    {
        $diagnosa = Diagnosa::with(['penyakit', 'user'])->findOrFail($id);

        $selected = $diagnosa->gejala_terpilih ?? [];
        $gejalas = Gejala::whereIn('id', $selected)->get();

        return view('riwayat.show', compact('diagnosa', 'gejalas'));
    }

    public function printPdf($id)
    {
        $diagnosa = Diagnosa::with(['user', 'penyakit'])->findOrFail($id);

        $selected = $diagnosa->gejala_terpilih ?? [];
        $gejalas = Gejala::whereIn('id', $selected)->get();

        $pdf = Pdf::loadView('riwayat.pdf', compact('diagnosa', 'gejalas'));

        return $pdf->download('diagnosa.pdf');
    }
}