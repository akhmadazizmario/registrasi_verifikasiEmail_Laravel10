<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class Authcontroller extends Controller
{
    // register tampilan mengarah ke views
    public function register()
    {
        return view('register');
    }

    // proses registrasi atau dalam load upload data ke database
    public function registerProses(Request $request)
    {
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'alamat' => $request->alamat,
        //     'password' => Hash::make($request->password)
        // ]);

        // Validasi input ketika kolom kosong dan pesan errornya
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'alamat' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'Kolom Nama harus diisi.',
            'email.required' => 'Kolom Email harus diisi.',
            'email.email' => 'Format Email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'alamat.required' => 'Kolom Alamat harus diisi.',
            'password.required' => 'Kolom Password harus diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        // Jika validasi berhasil, buat pengguna
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password)
        ]);

        // memproses registrasi baru
        event(new Registered($user));
        // meloginkan
        Auth::login($user);
        // mengirim email verifikasi
        return redirect('/email/verify');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }

    // Halaman Login
    public function loginku()
    {
        return view('login');
    }

    // authentikasi login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // Memeriksa apakah email_verified_at tidak null
            if (auth()->user()->email_verified_at !== null) {
                $request->session()->regenerate();
                return redirect()->intended('/profile');
            } else {
                Auth::logout(); // Logout jika email_verified_at null
                return back()->with('loginError', 'Login Gagal!, akun belum terverifikasi.');
            }
        }

        return back()->with('loginError', 'Login Gagal!, masukkan email dan password dengan benar!!');
    }
}
