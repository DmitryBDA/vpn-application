<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\UserIndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserIndexController::class, 'index'])->name('home');

Route::get('/admin', [MainController::class, 'index'])->middleware('auth')->name('admin.index');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');