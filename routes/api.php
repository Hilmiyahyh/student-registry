<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\StudentController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
    // Route::post('logout', [\App\Http\Controllers\API\RegisterController::class, 'logout']);

// });

Route::post('register', [\App\Http\Controllers\API\RegisterController::class, 'register']);
Route::post('login', [\App\Http\Controllers\API\RegisterController::class, 'login']);
Route::apiResource('student', \App\Http\Controllers\StudentController::class);

