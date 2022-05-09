<?php

use App\Http\Controllers\Api\V2\Auth\AuthController;
use App\Http\Controllers\Api\V2\ProductController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('signin', [AuthController::class, 'signin']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::resource('products', ProductController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('version', function () {
    return 'API Version 2';
});
