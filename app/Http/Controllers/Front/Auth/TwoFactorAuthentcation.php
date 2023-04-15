<?php

namespace App\Http\Controllers\Front\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthentcation extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('Front.auth.two-factor-auth', compact('user'));
    }
}
