<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.index');
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('auth.index')->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth.index');
    }
}
