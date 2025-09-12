<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckToken;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/refresh', [AuthController::class, 'refresh']);

Route::middleware([CheckToken::class])->group(function () {
    Route::get('/user', [AuthController::class, 'user']);

    Route::middleware('role:admin')->group(function () {});

});
