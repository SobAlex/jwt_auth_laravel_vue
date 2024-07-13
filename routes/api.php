<?php

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
     return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\AuthController::class, 'me']);

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::group(['namespace' => 'Fruit', 'prefix' => 'fruits' ], function() {
            Route::get('/', [App\Http\Controllers\Fruit\IndexController::class, 'index']);
        });
    });
});

Route::group(['namespace' => 'User', 'prefix' => 'users' ], function() {
    Route::post('/', [App\Http\Controllers\User\StoreController::class, 'store']);
});


