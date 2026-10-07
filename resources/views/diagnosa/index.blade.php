@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="bg-white rounded-2xl shadow-md p-6 md:p-10">

        <!-- TITLE -->
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                Diagnosa Kelainan Mata
            </h2>
            <p class="text-gray-500 mt-2">
                Pilih gejala yang Anda alami sesuai kondisi mata, lalu klik "Proses Diagnosa"
            </p>
        </div>

        <form action="{{ route('diagnosa.proses') }}" method="POST">
            @csrf

            <!-- ================= DATA DIRI ================= -->
            <div class="mb-10">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Data Diri
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <input type="text" name="nama"
                        value="{{ old('nama', auth()->user()->name ?? '') }}"
                        placeholder="Nama Lengkap"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-400 outline-none"
                        required>

                    <input type="number" name="umur"
                        value="{{ old('umur', auth()->user()->umur ?? '') }}"
                        placeholder="Umur"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-400 outline-none"
                        required>

                    <select name="jenis_kelamin"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-400 outline-none"
                        required>
                        <option value="">Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>

                </div>
            </div>


<!-- ================= GEJALA ================= -->
<div class="mb-10">
    <h3 class="text-lg font-semibold text-gray-700 mb-1 flex items-center gap-2">
        <span class="text-teal-500">👁️</span> Daftar Gejala Kelainan Mata
    </h3>

    <p class="text-red-500 text-xs italic mb-4">
        * Pilih minimal 2 gejala yang sesuai dengan kondisi Anda dan hindari memilih seluruh gejala yang tersedia agar hasil diagnosa lebih akurat.
    </p>




                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">

                    @foreach($gejalas as $gejala)

                    <label class="flex items-center gap-3 border rounded-xl px-4 py-3 cursor-pointer
                                  transition-all duration-200 hover:border-teal-400 hover:bg-teal-50/40">

                        <!-- INPUT -->
                        <input type="checkbox"
                               name="gejala[]"
                               value="{{ $gejala->id }}"
                               class="peer hidden">

                        <!-- BULATAN -->
                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center
                                    transition-all duration-200
                                    peer-checked:border-teal-500 peer-checked:bg-teal-500">

                            <!-- CENTANG -->
                            <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition"
                                 fill="none" stroke="currentColor" stroke-width="3"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5 13l4 4L19 7"/>
                            </svg>

                        </div>

                        <!-- TEXT -->
                        <span class="text-gray-700 text-sm
                                     peer-checked:text-teal-700
                                     peer-checked:font-semibold transition">
                            {{ $gejala->nama_gejala }}
                        </span>

                    </label>

                    @endforeach

                </div>

                @error('gejala')
                    <p class="text-red-500 text-sm mt-3">{{ $message }}</p>
                @enderror
            </div>

            <!-- ================= BUTTON ================= -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center">

                <button type="submit"
                    class="bg-teal-500 text-white px-8 py-3 rounded-xl font-semibold
                           hover:bg-teal-600 transition-all duration-300
                           hover:scale-105 shadow-md">
                    Proses Diagnosa
                </button>

                <button type="reset"
                    class="border px-8 py-3 rounded-xl text-gray-600
                           hover:bg-gray-100 transition">
                    Reset
                </button>

            </div>

        </form>

    </div>

</div>

@endsection