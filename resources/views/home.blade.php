@extends('layouts.app')

@section('content')

<!-- HERO FULL WIDTH -->
<div class="bg-gradient-to-r from-teal-600 to-teal-500 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-24 md:py-28 lg:py-32">

        <div class="text-center max-w-3xl mx-auto">

            <!-- LABEL -->
            <div class="mb-5 inline-block bg-white/20 px-4 py-1.5 rounded-full text-sm backdrop-blur">
                👁️ Solusi Penyakit Mata
            </div>

            <!-- TITLE -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-5xl font-bold leading-tight mb-5">
                Deteksi Dini <br class="hidden md:block">
                Kesehatan Mata Anda
            </h1>

            <!-- DESC -->
            <p class="text-base sm:text-lg md:text-xl text-white/90 mb-8 leading-relaxed">
                Lakukan diagnosa awal penyakit mata dengan cepat, mudah, dan akurat.
            </p>

            <!-- BUTTON -->
            <a href="{{ auth()->check() ? route('diagnosa') : route('registrasi') }}"
               class="inline-block bg-white text-teal-600 
               px-7 sm:px-8 md:px-9 py-3.5 sm:py-4 
               rounded-xl text-base sm:text-lg font-semibold shadow-md
               transition-all duration-300
               hover:bg-gray-100 hover:scale-105 hover:shadow-lg active:scale-95">

                Mulai Diagnosa
            </a>

        </div>
    </div>
</div>
<!-- FITUR -->
<div class="bg-gray-50 py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 grid gap-6 sm:gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

        <!-- CARD 1 -->
        <div class="bg-white rounded-2xl shadow-md p-5 sm:p-6 text-center 
                    transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="text-3xl sm:text-4xl mb-3">⚡</div>
            <h3 class="font-semibold text-base sm:text-lg mb-2">Diagnosa Cepat</h3>
            <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                Proses diagnosa hanya dalam hitungan detik
            </p>
        </div>

        <!-- CARD 2 -->
        <div class="bg-white rounded-2xl shadow-md p-5 sm:p-6 text-center 
                    transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="text-3xl sm:text-4xl mb-3">🧠</div>
            <h3 class="font-semibold text-base sm:text-lg mb-2">Metode Cerdas</h3>
            <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                Menggunakan Certainty Factor untuk akurasi hasil
            </p>
        </div>

        <!-- CARD 3 -->
        <div class="bg-white rounded-2xl shadow-md p-5 sm:p-6 text-center 
                    transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="text-3xl sm:text-4xl mb-3">📋</div>
            <h3 class="font-semibold text-base sm:text-lg mb-2">Riwayat Diagnosa</h3>
            <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                Simpan dan akses hasil diagnosa kapan saja
            </p>
        </div>

    </div>
</div>

@endsection