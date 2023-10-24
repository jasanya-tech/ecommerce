<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', [
            'title' => 'login'
        ]);
    }

    public function loginProcess(Request $request)
    {
        $message = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($message)) {
            if (Auth()->user()->role == 1) {
                $request->session()->regenerate();
                return redirect('/admin')->with('success', 'selamat datang admin');
            } elseif (Auth()->user()->role == 2) {
                $request->session()->regenerate();
                return redirect('/')->with(['success' => 'selamat datang user']);
            }
        }
        return redirect()->route('auth.login')->with('errors', 'Email atau password salah');
    }

    public function register()
    {
        return view('auth.register', [
            'title' => 'register'
        ]);
    }

    public function registerProcess(Request $request)
    {
        $message = $request->validate([
            'email' => 'email:rfc,dns|unique:users,email',
            'name' => 'required|min:6',
            'phone_number' => 'required|numeric|unique:users,phone_number',
            'password' => 'required|confirmed|min:6',
        ], [
            'password.min' => 'minimal karakter 6',
            'password.required' => 'tidak boleh dikosongkan',
            'password.confirmed' => 'password dan konfirmasi password tidak sesuai',
            'phone_number.required' => 'tidak boleh dikosongkan',
            'phone_number.numeric' => 'harus berupa angka',
            'phone_number.unique' => 'nomor handphone sudah terdaftar',
            'name.required' => 'tidak boleh dikosongkan',
            'name.numeric' => 'minimal karakter 6',
            'email.email' => 'invalid email',
            'email.euniquemail' => 'email sudah terdaftar',
        ]);

        $user = User::create([
            'email' => $message['email'],
            'name' => $message['name'],
            'phone_number' => $message['phone_number'],
            'password' => bcrypt($message['password']),
        ]);

        Auth::login($user);
        return redirect('/')->with(['success' => 'selamat datang user']);
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerate();
        return redirect('/');
    }
}
