<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/sign-up', [TestingController::class, 'signUp']);
Route::post('/login', [TestingController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/follow/{userId}', [FanController::class, 'follow']);
    Route::delete('/unfollow/{userId}', [FanController::class, 'unfollow']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::post('/send-notification', [TestingController::class, 'sendNotification']);
    Route::post('/logout', [TestingController::class, 'logout']);
});
