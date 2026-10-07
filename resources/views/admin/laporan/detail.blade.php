@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6 text-gray-700">Detail Laporan Diagnosa</h2>

<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">

    <!-- HEADER -->
    <div class="flex justify-between mb-6 flex-wrap gap-3 items-center">
        <h3 class="text-lg font-semibold text-gray-600">Informasi Hasil Diagnosa</h3>

        <a href="{{ route('admin.laporan.detail.pdf', $diagnosa->id) }}"
            class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition">
            Cetak PDF
        </a>
    </div>

    <!-- INFORMASI UTAMA -->
    <div class="grid md:grid-cols-2 gap-4 text-gray-700 mb-6">

        <div>
            <p class="text-sm text-gray-500">Nama Pengguna</p>
            <p class="font-semibold">{{ $diagnosa->user->name }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Tanggal Diagnosa</p>
            <p class="font-semibold">{{ $diagnosa->created_at->format('d M Y H:i') }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Hasil Diagnosa</p>
            <p class="font-semibold text-teal-600">
                {{ $diagnosa->penyakit->nama_penyakit }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Nilai Kepastian (CF)</p>
            <p class="font-semibold">
                {{ number_format($diagnosa->cf_result, 2) }}
            </p>
        </div>

    </div>

    <hr class="my-4">

    <!-- DESKRIPSI -->
    <div class="mb-5">
        <h4 class="font-semibold text-gray-600 mb-2">Deskripsi Penyakit</h4>
        <p class="text-gray-700 leading-relaxed text-justify">
            {{ $diagnosa->penyakit->deskripsi }}
        </p>
    </div>

    <!-- SARAN -->
    <div>
        <h4 class="font-semibold text-gray-600 mb-2">Saran Penanganan</h4>
        <p class="text-gray-700 leading-relaxed text-justify">
            {{ $diagnosa->penyakit->saran_penanganan }}
        </p>
    </div>

</div>

@endsection