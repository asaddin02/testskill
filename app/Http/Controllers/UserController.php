<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Register user
    public function register(Request $request)
    {
        Hash::make($request['password']);
        $alert = User::create($request->all());
        if ($alert) {
            return redirect('/')->with('user_created', true);
        } else {
            return redirect()->back()->with('error', 'Isi data user dengan benar!');
        }
    }

    // Login User
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('product')->with('success', 'Selamat datang');
        }
        return back()->with('error', 'Pastikan email dan password benar');
    }

    public function logout()
    {
        session()->flush();
        return redirect('login');
    }
}
