<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('registrasi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'username' => 'required|string|min:3|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan user
        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'name' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // ✅ Kirim email (pakai try-catch biar tidak error)
        try {
            Mail::send('emails.registrasi', ['user' => $user], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Registrasi Berhasil');
            });
        } catch (\Exception $e) {
            // kalau email gagal, tidak ganggu registrasi
            \Log::error('Email gagal dikirim: ' . $e->getMessage());
        }

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }
}