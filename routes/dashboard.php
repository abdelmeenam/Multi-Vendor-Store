<?php


use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/dash', function () { return view('dashboard');})->middleware('auth')->name('dash');


Route::group(['middleware' => ['auth' , 'verified'] , 'as' => 'dashboard.' , 'prefix' => 'dashboard'] ,function () {

    Route::get('/dashboard', [DashboardController::class , 'index'])->name('dashboard') ;

    Route::get('/categories/trash/' ,[CategoryController::class , 'trash'] )->name('categories.trash');
    Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');

    Route::resource('/categories' , CategoryController::class );




//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
