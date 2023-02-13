<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
            $user = 'Abdelmonem Mohmed';
            return view('Admin.index' , compact(['user']));
    }
}
