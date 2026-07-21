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

    public function destroy(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('home');
    }

    /**
     * Авторизует пользователя
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (! Auth::attempt(
            $request->only('email', 'password'),
            $request->boolean('remember')
        )) {
            return back()
                ->withErrors([
                    'email' => 'Неверный email или пароль.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended();
    }
}
