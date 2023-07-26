<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $r)
    {
        $validated = $r->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'email' => 'Format :attribute tidak valid.',
            'min' => ':Attribute harus memiliki minimal :min karakter.',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($validated)) {
            // Authentication successful
            return redirect('/dashboard');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
