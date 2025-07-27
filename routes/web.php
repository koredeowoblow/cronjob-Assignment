<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestingController;

Route::get('/', function () {
    return view('welcome');
});

Route::post("/send",[TestingController::class , "Notifies"]);
Route::post('/sign-up', [TestingController::class, 'signUp']);
