<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::group([
//     'middleware' => 'api',
//     // 'prefix' => 'auth'
// ], function ($router) {
//     Route::post('/register', [AuthController::class, 'register'])->name('user.register');
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::post('/refresh', [AuthController::class, 'refresh']);
//     Route::get('/profile', [AuthController::class, 'userProfile']);
//     Route::post('/product', [App\Http\Controllers\ProductController::class,'store'])->name('user.product');     
// });

Route::controller(AuthController::class)
->middleware('api')
->group(function ()  {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');
    Route::get('/profile', 'userProfile');   
});



Route::controller(ProductController::class)->middleware('api')->group(function () {
    Route::post('/product', 'store');
    Route::get('/product/{id}', 'show');
    Route::get('/products', 'view');    
    Route::get('/latest-product', 'latest_product');    
});
