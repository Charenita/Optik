<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Diagnosa;
use App\Services\CertaintyFactorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosaController extends Controller
{
    protected $cfService;

    public function __construct(CertaintyFactorService $cfService)
    {
        $this->cfService = $cfService;
    }

    public function index()
    {
        // Gejala ditampilkan urut berdasarkan kode G01, G02, G03, dst.
        $gejalas = Gejala::orderBy('kode_gejala', 'asc')->get();

        return view('diagnosa.index', compact('gejalas'));
    }

    public function proses(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:1|max:120',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'gejala' => 'required|array|min:1',
            'gejala.*' => 'exists:gejalas,id',
        ]);

        if (Auth::check()) {
            Auth::user()->update([
                'name' => $request->nama,
                'umur' => $request->umur,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);
        }

        $gejalaIds = $request->gejala;

        $results = $this->cfService->hitungDiagnosa($gejalaIds);
        $topResult = $results[0] ?? null;

        if (Auth::check() && $topResult) {
            Diagnosa::create([
                'user_id' => Auth::id(),
                'penyakit_id' => $topResult['penyakit']->id,
                'cf_result' => $topResult['cf'],
                'gejala_terpilih' => $gejalaIds,
                'hasil_diagnosa' => $topResult['percentage'] >= 50
                    ? "Kemungkinan mengalami {$topResult['penyakit']->nama_penyakit}"
                    : "Tidak terdeteksi dengan tingkat keyakinan yang cukup"
            ]);
        }

        return view('diagnosa.hasil', compact('results', 'topResult'));
    }
}