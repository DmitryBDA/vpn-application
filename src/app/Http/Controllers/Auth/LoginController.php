<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function create(): View
    {
        return view('user.login');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('home');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        Auth::attempt($request->only('email', 'password'), $request->filled('remember'));

        return redirect()->intended();
    }
}