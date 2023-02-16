<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('');
        $this->middleware(['auth', 'verified'])->only('');
    }

    public function index(Request $request  )
    {
            return view('Admin.index' );
    }
}
