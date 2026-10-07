<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Rule;
use App\Models\Diagnosa;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminController extends Controller
{
    // 🔒 Helper cek admin
    private function checkAdmin()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }
    }

    // Dashboard
    public function dashboard()
    {
        $this->checkAdmin();

        $totalUsers = User::where('role', 'user')->count();
        $totalDiagnosa = Diagnosa::count();
        $totalPenyakit = Penyakit::count();
        $totalGejala = Gejala::count();
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDiagnosa',
            'totalPenyakit',
            'totalGejala'
        ));
    }

    // ================= PENYAKIT =================
    public function penyakitIndex()
    {
        $this->checkAdmin();

        $penyakits = Penyakit::all();
        return view('admin.penyakit.index', compact('penyakits'));
    }

    public function penyakitStore(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'kode_penyakit' => 'required|unique:penyakits',
            'nama_penyakit' => 'required',
            'deskripsi' => 'required',
            'gejala_umum' => 'required',
            'saran_penanganan' => 'required',
        ]);

        Penyakit::create($request->all());

        return redirect()->route('admin.penyakit')
            ->with('success', 'Penyakit berhasil ditambahkan');
    }

    public function penyakitUpdate(Request $request, $id)
    {
        $this->checkAdmin();

        $penyakit = Penyakit::findOrFail($id);
        $penyakit->update($request->all());

        return redirect()->route('admin.penyakit')
            ->with('success', 'Penyakit berhasil diupdate');
    }

    public function penyakitDestroy($id)
    {
        $this->checkAdmin();

        Penyakit::findOrFail($id)->delete();

        return redirect()->route('admin.penyakit')
            ->with('success', 'Penyakit berhasil dihapus');
    }

    // ================= GEJALA =================
    public function gejalaIndex()
    {
        $this->checkAdmin();

        $gejalas = Gejala::all();
        return view('admin.gejala.index', compact('gejalas'));
    }

    public function gejalaStore(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'kode_gejala' => 'required|unique:gejalas',
            'nama_gejala' => 'required',
        ]);

        Gejala::create($request->all());

        return redirect()->route('admin.gejala')
            ->with('success', 'Gejala berhasil ditambahkan');
    }

    public function gejalaUpdate(Request $request, $id)
    {
        $this->checkAdmin();

        $gejala = Gejala::findOrFail($id);
        $gejala->update($request->all());

        return redirect()->route('admin.gejala')
            ->with('success', 'Gejala berhasil diupdate');
    }

    public function gejalaDestroy($id)
    {
        $this->checkAdmin();

        Gejala::findOrFail($id)->delete();

        return redirect()->route('admin.gejala')
            ->with('success', 'Gejala berhasil dihapus');
    }

    // ================= RULES =================
    public function rulesIndex()
    {
        $this->checkAdmin();

        $rules = Rule::with(['penyakit', 'gejala'])->get();
        $penyakits = Penyakit::all();
        $gejalas = Gejala::all();

        return view('admin.rules.index', compact('rules', 'penyakits', 'gejalas'));
    }

    public function rulesStore(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'penyakit_id' => 'required',
            'gejala_id' => 'required|unique:rules,gejala_id,NULL,id,penyakit_id,' . $request->penyakit_id,
            'cf_value' => 'required|numeric|min:0|max:1',
        ]);

        Rule::create($request->all());

        return redirect()->route('admin.rules')
            ->with('success', 'Rule CF berhasil ditambahkan');
    }

    public function rulesUpdate(Request $request, $id)
    {
        $this->checkAdmin();

        $rule = Rule::findOrFail($id);
        $rule->update($request->all());

        return redirect()->route('admin.rules')
            ->with('success', 'Rule CF berhasil diupdate');
    }

    public function rulesDestroy($id)
    {
        $this->checkAdmin();

        Rule::findOrFail($id)->delete();

        return redirect()->route('admin.rules')
            ->with('success', 'Rule CF berhasil dihapus');
    }

    // ================= LAPORAN =================
public function laporanRiwayat(Request $request)
{
    $this->checkAdmin();

    $query = Diagnosa::with(['user', 'penyakit']);

    // 🔍 SEARCH USER
    if ($request->search) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    }

    // 📅 FILTER TANGGAL
    if ($request->from) {
        $query->whereDate('created_at', '>=', $request->from);
    }

    if ($request->to) {
        $query->whereDate('created_at', '<=', $request->to);
    }

    $diagnosas = $query->latest()->get();

    return view('admin.laporan.index', compact('diagnosas'));
}


// 🔹 Detail 1 diagnosa
public function laporanDetail($id)
{
    $this->checkAdmin();

    $diagnosa = Diagnosa::with(['user', 'penyakit'])->findOrFail($id);

    return view('admin.laporan.detail', compact('diagnosa'));
}


// 🔹 PDF per diagnosa
public function laporanPdf($id)
{
    $this->checkAdmin();

    $diagnosa = Diagnosa::with(['user', 'penyakit'])->findOrFail($id);

    $pdf = Pdf::loadView('admin.laporan.pdf', compact('diagnosa'));

    return $pdf->stream('laporan-diagnosa.pdf');
}
public function destroy($id)
{
    $data = Diagnosa::findOrFail($id);
    $data->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus');
}
public function laporanHarianPdf(Request $request)
{
    $this->checkAdmin();

    $query = Diagnosa::with(['user', 'penyakit']);

    // FILTER SAMA SEPERTI INDEX
    if ($request->search) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->from) {
        $query->whereDate('created_at', '>=', $request->from);
    }

    if ($request->to) {
        $query->whereDate('created_at', '<=', $request->to);
    }

    $diagnosas = $query->latest()->get();

    $pdf = Pdf::loadView('admin.laporan.pdf_harian', compact('diagnosas'));

    return $pdf->stream('laporan-harian.pdf');
}
}
