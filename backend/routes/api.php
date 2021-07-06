<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware("auth:api")->group(function(){

    Route::get('/me', function(){
        return auth()->user();
    });

    Route::resource("schools", SchoolController::class);
    Route::resource("students", StudentController::class);
    Route::resource("classes", ClasseController::class);
});