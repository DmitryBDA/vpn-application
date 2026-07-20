<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\UserIndexController;
use Illuminate\Support\Facades\Route;


Route::get('/admin', [MainController::class, 'index'])->name('admin.index');
Route::get('/', [UserIndexController::class, 'index'])->name('user.index');
Route::get('/register', [RegisterController::class, 'create'])->name('user.register');
Route::get('/login', [LoginController::class, 'create'])->name('user.login');