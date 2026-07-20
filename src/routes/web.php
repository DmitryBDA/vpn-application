<?php

use App\Http\Controllers\Admin\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [MainController::class, 'index'])->name('admin.index');