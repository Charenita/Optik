@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- HEADER -->
    <div class="mb-10 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
            Riwayat Diagnosa
        </h2>
        <p class="text-gray-500 mt-2 text-sm md:text-base">
            Daftar hasil diagnosa yang telah dilakukan sebelumnya.
        </p>
    </div>

    @if($diagnosas->isEmpty())
        <div class="bg-white rounded-2xl shadow-md p-8 text-center border border-gray-100">
            <p class="text-gray-500">Belum ada riwayat diagnosa.</p>
        </div>
    @else

    <div class="space-y-6">

        @foreach($diagnosas as $diagnosa)

        <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 border border-gray-100 hover:shadow-lg transition">

            <!-- TOP -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-4">

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-teal-100 text-teal-600 flex items-center justify-center rounded-lg">
                        🧾
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ $diagnosa->penyakit->nama_penyakit }}
                        </h3>
                        <p class="text-sm text-gray-500">
                            {{ $diagnosa->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>

                <div class="text-left md:text-right">
                    <p class="text-sm text-gray-500">Tingkat Keyakinan</p>
                    <p class="text-lg font-bold text-teal-600">
                        {{ number_format($diagnosa->cf_result * 100, 2) }}%
                    </p>
                </div>

            </div>

            <!-- PROGRESS -->
            <div class="w-full bg-gray-100 rounded-full h-3 mb-4">
                <div class="bg-teal-500 h-3 rounded-full"
                     style="width: {{ $diagnosa->cf_result * 100 }}%">
                </div>
            </div>

            <!-- ACTION -->
            <div class="flex justify-end">
                <a href="{{ route('riwayat.show', $diagnosa->id) }}"
                   class="bg-teal-500 hover:bg-teal-600 text-white text-sm px-4 py-2 rounded-lg">
                    👁️ Lihat Detail
                </a>
            </div>

        </div>

        @endforeach

    </div>

    @endif

</div>
@endsection