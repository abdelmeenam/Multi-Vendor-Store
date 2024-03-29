<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductContoller;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;


// Route::get('/dash', function () {
//     return view('dashboard');
// })->middleware('auth')->name('dash');


Route::group(
    [
        'middleware' => ['auth:admin,web'],
        'as' => 'dashboard.',
        'prefix' => 'admin/dashboard'
    ],
    function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        //-----Categories Soft delete routes
        Route::get('/categories/trash/', [CategoryController::class, 'trash'])->name('categories.trash');
        Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');

        //-----------Resource----------
        Route::resources([
            'products' => ProductContoller::class,
            'categories' => CategoryController::class,
            'roles' => RolesController::class,
            'users' => UserController::class,
            'admins' => AdminController::class,
        ]);


        //-------Profile
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    }
);
