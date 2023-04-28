<?php

use App\Http\Controllers\Front\Auth\TwoFactorAuthentcation;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\LangController;
use App\Http\Controllers\Front\ProductsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    //--------------Products----------------------------
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/products/{product:slug}', [ProductsController::class, 'show'])->name('products.show');

    //--------------cart & checkout----------------------------
    Route::resource('cart', CartController::class);
    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('auth/user/2fa', [TwoFactorAuthentcation::class, 'index'])->name('front.2fa');

    Route::post('currency', [CurrencyConverterController::class, 'store'])->name('currency.store');
    Route::get('/change-language', [LangController::class, 'changeLanguage'])->name('changeLanguage');
});

//require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
