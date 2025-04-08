<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;




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



Route::group(['prefix'=> 'posts','middleware'=>['auth:sanctum']], function () {

    //Posts Routes
    Route::get('', [PostController::class,'index']);
    Route::post('', [PostController::class,'store']);
    Route::get('/{id}', [PostController::class,'show']);
    Route::put('/{id}', [PostController::class ,'update']);
    Route::delete('/{id}', [PostController::class,'delete']);
    // Posts Routes
});


Route::group(['prefix'=> 'auth'], function () {
    Route::post('register' , [AuthController::class,'register']);
    Route::post('login' , [AuthController::class,'login']);
    Route::post('logout' , [AuthController::class,'logout'])->middleware('auth:sanctum');
    Route::get('profile' , [AuthController::class,'getProfile'])->middleware('auth:sanctum');;

});


