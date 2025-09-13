<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckToken;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/refresh', [AuthController::class, 'refresh']);

Route::get('/theme/all', [ThemeController::class, 'index']);
Route::get('/theme/{id}', [ThemeController::class, 'show']);

// ! добавить мидлвар
Route::get('/users', [UserController::class, 'users']);

Route::middleware([CheckToken::class])->group(function () {
    Route::get('/me', [UserController::class, 'me']);

    Route::middleware('role:admin')->group(function () {
        Route::post('/theme', [ThemeController::class, 'store']);
        Route::delete('/theme/{theme}', [ThemeController::class, 'destroy']);
        Route::patch('/theme/{theme}', [ThemeController::class, 'update']);

    });

});
