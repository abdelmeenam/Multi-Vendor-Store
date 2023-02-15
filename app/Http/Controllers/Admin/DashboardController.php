<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request  )
    {


            $user = 'Abdelmonem Mohmed';
            return view('Admin.index' , compact(['user']));
    }
}
