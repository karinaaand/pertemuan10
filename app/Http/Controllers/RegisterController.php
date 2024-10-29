<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationSuccess;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // Method to show the registration form
    public function create()
    {
        return view('emails.registration_success'); // Fixed missing quotation mark
    }

    public function store(Request $request)
    {
        // Validasi data pengguna
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Mengirim email konfirmasi
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'subject' => 'Selamat Datang di Aplikasi Kami!',
        ];

        Mail::to($user->email)->send(new RegistrationSuccess($data));

        // Kembali dengan pesan sukses
        return redirect()->route('home')->with('success', 'Pendaftaran berhasil! Cek email Anda untuk informasi lebih lanjut.');
    }
}
