<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserIndexController extends Controller
{
    public function index()
    {
        return view('user.main');
    }
}