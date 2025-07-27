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

// Public routes
Route::post('/sign-up', [TestingController::class, 'signUp']);
Route::post('/login', [TestingController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); // OR Auth::user();
});

// Protected routes - requires Sanctum token
Route::middleware('auth:sanctum')->group(function () {

    // Follow and unfollow
    Route::post('/follow/{userId}', [FanController::class, 'follow']);
    Route::delete('/unfollow/{userId}', [FanController::class, 'unfollow']);

    // Create post
    Route::post('/posts', [PostController::class, 'store']);

    // Send notification
    Route::post('/send-notification', [TestingController::class, 'sendNotification']);

    // Logout (optional)
    Route::post('/logout', [TestingController::class, 'logout']);
});
