<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // tampil form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('index'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // tampil form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // proses register
    // proses register
    public function register(Request $request)
{
    $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|string|email|max:255|unique:users',
        'password'  => 'required|string|min:3|confirmed',
        'alamat'    => 'nullable|string|max:255',
        'no_hp'     => 'nullable|string|max:20',
    ]);

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'alamat'   => $request->alamat,
        'no_hp'    => $request->no_hp,
        'role'     => 'user', // default user
    ]);

    return redirect()->route('auth.login')
                     ->with('success', 'Registrasi berhasil! Silakan login.');
}

    // proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
