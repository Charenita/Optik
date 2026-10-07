@extends('layouts.app')

@section('content')

<div class="flex items-center justify-center px-4 py-12">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

        <!-- ICON -->
        <div class="flex justify-center mb-4">
            <div class="bg-teal-500 text-white p-4 rounded-xl text-2xl shadow">
                <i class="fa-solid fa-lock"></i>
            </div>
        </div>

        <!-- TITLE -->
        <h2 class="text-2xl font-bold text-center text-gray-800">
            Login
        </h2>
        <p class="text-center text-gray-500 text-sm mb-6">
            Silakan masuk ke akun Anda
        </p>

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- USERNAME -->
            <div class="mb-4">
                <label class="text-sm text-gray-600">Username</label>
                <div class="flex items-center border rounded-lg px-3 py-2 focus-within:ring-2 focus-within:ring-teal-400">
                    <i class="fa-regular fa-user text-gray-400 mr-2"></i>
                    <input type="text" name="username"
                        class="w-full outline-none"
                        placeholder="Masukkan username" required>
                </div>
                @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div class="mb-6">
                <label class="text-sm text-gray-600">Password</label>
                <div class="flex items-center border rounded-lg px-3 py-2 focus-within:ring-2 focus-within:ring-teal-400">
                    <i class="fa-solid fa-lock text-gray-400 mr-2"></i>
                    <input type="password" name="password"
                        class="w-full outline-none"
                        placeholder="Masukkan password" required>
                </div>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-teal-500 to-teal-600 text-white py-3 rounded-xl font-semibold
                transition-all duration-300 hover:scale-[1.02] hover:shadow-lg active:scale-95">

                Login
            </button>
        </form>

        <!-- LINK -->
        <p class="text-center mt-5 text-sm text-gray-500">
            Belum punya akun?
            <a href="{{ route('registrasi') }}"
               class="text-teal-600 font-semibold hover:underline">
               Registrasi
            </a>
        </p>

    </div>

</div>

@endsection