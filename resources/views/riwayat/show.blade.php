@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">

    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">

        <!-- TITLE -->
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                Detail Diagnosa
            </h2>
            <p class="text-gray-500 text-sm mt-2">
                Informasi lengkap hasil diagnosa pasien
            </p>
        </div>

        <!-- HEADER PENYAKIT -->
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-teal-100 text-teal-600 flex items-center justify-center rounded-xl text-xl">
                👁️
            </div>

            <div>
                <h3 class="text-xl md:text-2xl font-semibold text-gray-800">
                    {{ $diagnosa->penyakit->nama_penyakit }}
                </h3>
                <p class="text-gray-500 text-sm">
                    {{ $diagnosa->created_at->format('d M Y, H:i') }}
                </p>
            </div>
        </div>

        <!-- DATA PASIEN -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

            <div class="bg-gray-50 rounded-xl p-4 border">
                <p class="text-gray-500 text-sm">Nama</p>
                <p class="font-semibold text-gray-800">
                    {{ $diagnosa->user->name }}
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4 border">
                <p class="text-gray-500 text-sm">Umur</p>
                <p class="font-semibold text-gray-800">
                    {{ $diagnosa->user->umur ?? '-' }} tahun
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4 border">
                <p class="text-gray-500 text-sm">Jenis Kelamin</p>
                <p class="font-semibold text-gray-800">
                    {{ $diagnosa->user->jenis_kelamin ?? '-' }}
                </p>
            </div>

        </div>

        <!-- CF -->
        <div class="mb-6">
            <p class="text-sm text-gray-500 mb-1">Tingkat Keyakinan</p>
            <p class="text-xl font-bold text-teal-600 mb-2">
                {{ number_format($diagnosa->cf_result * 100, 2) }}%
            </p>

            <div class="w-full bg-gray-100 h-3 rounded-full">
                <div class="bg-teal-500 h-3 rounded-full"
                     style="width: {{ $diagnosa->cf_result * 100 }}%"></div>
            </div>
        </div>

        <!-- GEJALA -->
        <div class="mb-6">
            <h4 class="text-sm font-semibold text-gray-700 mb-3">
                Gejala yang Dipilih
            </h4>

            @if($gejalas->isEmpty())
                <p class="text-gray-500 text-sm">Tidak ada gejala</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($gejalas as $g)
                        <div class="flex items-center gap-2 bg-teal-50 border border-teal-100 rounded-lg px-3 py-2 text-sm">
                            <span class="text-teal-500">✔</span>
                            <span class="text-gray-700">{{ $g->nama_gejala }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- DESKRIPSI -->
        <div class="mb-6">
            <h4 class="text-sm font-semibold text-gray-700 mb-2">
                Deskripsi Penyakit
            </h4>
            <p class="text-gray-600 text-sm md:text-base leading-relaxed text-justify">
                {{ $diagnosa->penyakit->deskripsi }}
            </p>
        </div>

        <!-- SARAN -->
        <div class="bg-teal-50 border border-teal-100 rounded-xl p-4 mb-6">
            <h4 class="text-sm font-semibold text-teal-700 mb-1">
                Saran Penanganan
            </h4>
            <p class="text-gray-600 text-sm md:text-base leading-relaxed text-justify">
                {{ $diagnosa->penyakit->saran_penanganan }}
            </p>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-end">
            <a href="{{ route('riwayat.print', $diagnosa->id) }}"
               class="inline-flex items-center gap-2 bg-teal-500 hover:bg-teal-600 text-white text-sm px-4 py-2 rounded-lg transition">
                🖨️ Cetak PDF
            </a>
        </div>

    </div>

</div>
@endsection