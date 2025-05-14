<?php

use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::resource('tasks',TaskController::class);
    Route::resource('users',UserController::class);
    Route::post('logout', [AuthController::class, 'logout']);
}) ;

Route::middleware('auth:sanctum','can:manage-statuses')->group(function(){
    Route::resource('statuses',StatusController::class);
});