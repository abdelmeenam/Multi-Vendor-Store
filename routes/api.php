<?php

use App\Http\Controllers\Api\AccessTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return \Illuminate\Support\Facades\Auth::guard('sanctum')->user();
});

//-----------Authentication-----------------
Route::post('auth/access-tokens', [AccessTokenController::class, 'store'])->middleware('guest:sanctum');
//-------------Revoke token-----------------
Route::delete('auth/access-tokens/{token?}', [AccessTokenController::class, 'destroy'])->middleware('auth:sanctum');


//-----------Api resource for products----------
Route::apiResource('products' , \App\Http\Controllers\Api\ProductController::class);

