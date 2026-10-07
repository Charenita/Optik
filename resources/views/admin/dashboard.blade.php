@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-semibold text-gray-700 mb-6">
    Dashboard Overview
</h2>

{{-- CARD --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 mb-8">

    <div class="bg-white border border-softborder rounded-xl p-5 shadow-sm hover:shadow-md transition">
        <p class="text-sm text-gray-500">Total Pengguna</p>
        <h3 class="text-3xl font-bold text-primary mt-2">{{ $totalUsers }}</h3>
    </div>

    <div class="bg-white border border-softborder rounded-xl p-5 shadow-sm hover:shadow-md transition">
        <p class="text-sm text-gray-500">Total Diagnosa</p>
        <h3 class="text-3xl font-bold text-green-500 mt-2">{{ $totalDiagnosa }}</h3>
    </div>

    <div class="bg-white border border-softborder rounded-xl p-5 shadow-sm hover:shadow-md transition">
        <p class="text-sm text-gray-500">Total Penyakit</p>
        <h3 class="text-3xl font-bold text-red-400 mt-2">{{ $totalPenyakit }}</h3>
    </div>

    <div class="bg-white border border-softborder rounded-xl p-5 shadow-sm hover:shadow-md transition">
        <p class="text-sm text-gray-500">Total Gejala</p>
        <h3 class="text-3xl font-bold text-purple-400 mt-2">{{ $totalGejala }}</h3>
    </div>

</div>

{{-- MENU --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    
    <a href="{{ route('admin.penyakit') }}"
       class="bg-white border border-softborder rounded-xl p-6 hover:shadow-md transition group">
        <div class="text-3xl mb-2 group-hover:scale-110 transition">💊</div>
        <h3 class="font-semibold text-gray-700">Kelola Penyakit</h3>
        <p class="text-sm text-gray-500">Data penyakit</p>
    </a>

    <a href="{{ route('admin.gejala') }}"
       class="bg-white border border-softborder rounded-xl p-6 hover:shadow-md transition group">
        <div class="text-3xl mb-2 group-hover:scale-110 transition">📝</div>
        <h3 class="font-semibold text-gray-700">Kelola Gejala</h3>
        <p class="text-sm text-gray-500">Data gejala</p>
    </a>

    <a href="{{ route('admin.rules') }}"
       class="bg-white border border-softborder rounded-xl p-6 hover:shadow-md transition group">
        <div class="text-3xl mb-2 group-hover:scale-110 transition">⚙️</div>
        <h3 class="font-semibold text-gray-700">CF Rules</h3>
        <p class="text-sm text-gray-500">Atur nilai CF</p>
    </a>

    <a href="{{ route('admin.laporan') }}"
       class="bg-white border border-softborder rounded-xl p-6 hover:shadow-md transition group">
        <div class="text-3xl mb-2 group-hover:scale-110 transition">📊</div>
        <h3 class="font-semibold text-gray-700">Laporan</h3>
        <p class="text-sm text-gray-500">Riwayat diagnosa</p>
    </a>

</div>

@endsection