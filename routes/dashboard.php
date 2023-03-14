<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductContoller;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;


//Route::get('/dash', function () { return view('dashboard');})->middleware('auth')->name('dash');


Route::group(['middleware' => ['auth', 'verified', 'auth.type:admin,super-admin'], 'as' => 'dashboard.', 'prefix' => 'dashboard'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //-----Categories Soft delete routes
    Route::get('/categories/trash/', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');

    //----Resource
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductContoller::class);


    //-------Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
});
