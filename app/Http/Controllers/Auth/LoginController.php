<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!auth()->attempt($credentials)) {
            return back()->with('failed', 'Email atau Password tidak sesuai');
        }

        $request->session()->regenerate();

        return redirect(route('dashboard'))->with('success', 'Welcome');
    }

    public function signOut()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect(route('user.landing_page'));
    }
}
