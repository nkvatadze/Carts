<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductsController;
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

Route::post('register', [AuthController::class, 'register'])->name('api.register');
Route::post('login', [AuthController::class, 'login'])->name('api.login');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductsController::class, 'index']);
    Route::post('/addProductInCart', [ProductsController::class, 'addProductInCart']);
    Route::post('/removeProductFromCart', [ProductsController::class, 'removeProductFromCart']);
    Route::post('/setCartProductQuantity', [ProductsController::class, 'setCartProductQuantity']);
    Route::get('/getUserCart', [ProductsController::class, 'getUserCart']);
});
