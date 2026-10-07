@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-12 py-10">

    <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">
        Hasil Diagnosa
    </h2>

    @if(isset($results) && count($results) > 0)

    <div class="space-y-6">

        @foreach($results as $index => $result)
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition">

            <!-- HEADER -->
            <div class="flex justify-between items-start flex-wrap gap-3 mb-4">
                <div>
                    <span class="text-xs bg-teal-100 text-teal-600 px-3 py-1 rounded-full font-semibold">
                        #{{ $index + 1 }}
                    </span>
                    <h3 class="text-xl font-bold text-gray-800 mt-2">
                        {{ $result['penyakit']->nama_penyakit }}
                    </h3>
                </div>

                <div class="text-right">
                    <p class="text-2xl font-bold text-teal-600">
                        {{ number_format($result['percentage'], 0) }}%
                    </p>
                    <p class="text-sm text-gray-500">
                        @if($result['percentage'] >= 60)
                            Yakin
                        @elseif($result['percentage'] >= 30)
                            Cukup Yakin
                        @else
                            Kurang Yakin
                        @endif
                    </p>
                </div>
            </div>

            <!-- PROGRESS BAR -->
            <div class="w-full bg-gray-200 rounded-full h-3 mb-5">
                <div class="bg-teal-500 h-3 rounded-full transition-all duration-500"
                     style="width: {{ $result['percentage'] }}%">
                </div>
            </div>

            <!-- DESKRIPSI -->
            <p class="text-gray-600 leading-relaxed mb-4">
                {{ $result['penyakit']->deskripsi }}
            </p>

            <!-- SARAN -->
            <div class="bg-teal-50 border border-teal-100 rounded-xl p-4 flex gap-3">
                <div class="text-teal-500 text-xl">⚠️</div>
                <p class="text-sm text-gray-600 leading-relaxed">
                    {{ $result['penyakit']->saran_penanganan }}
                </p>
            </div>

        </div>
        @endforeach

    </div>

    @else

    <!-- JIKA TIDAK ADA DATA -->
    <div class="bg-yellow-50 border border-yellow-300 rounded-xl p-5 text-center text-yellow-800">
        Tidak ada hasil diagnosa.
    </div>

    @endif

    <!-- BUTTON -->
    <div class="flex flex-col sm:flex-row gap-3 mt-10">

        <a href="{{ route('diagnosa') }}"
           class="flex-1 text-center bg-gray-500 text-white py-3 rounded-xl hover:bg-gray-600 transition">
            Diagnosa Ulang
        </a>

        <a href="{{ route('riwayat') }}"
           class="flex-1 text-center bg-teal-500 text-white py-3 rounded-xl hover:bg-teal-600 transition">
            Lihat Riwayat
        </a>

    </div>

</div>
@endsection