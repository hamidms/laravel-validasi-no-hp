<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    // Fungsi untuk menampilkan formulir pendaftaran
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Fungsi untuk melakukan pendaftaran pengguna
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^\+62/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    // Fungsi untuk menampilkan formulir login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Fungsi untuk melakukan autentikasi pengguna
    public function login(Request $request)
    {
        $credentials = $request->only('phone_number', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return redirect()->route('login')->withErrors(['phone_number' => 'Nomor handphone atau kata sandi salah.'])->withInput();
    }

    // Fungsi untuk melakukan logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
