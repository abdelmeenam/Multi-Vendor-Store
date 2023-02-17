<?php


use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/dash', function () { return view('dashboard');})->middleware('auth')->name('dash');

Route::get('/dashboard', [DashboardController::class , 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/dashboard/categories' , \App\Http\Controllers\Admin\CategoryController::class );
