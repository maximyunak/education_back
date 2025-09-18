<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckToken;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::get('/refresh', 'refresh');
});

Route::group(['prefix' => 'theme', 'controller' => ThemeController::class], function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
});

// ! добавить мидлвар
Route::get('/users', [UserController::class, 'users']);

// только авторизованным
Route::middleware([CheckToken::class])->group(function () {
    Route::get('/me', [UserController::class, 'me']);

    Route::group(['prefix' => 'test', 'controller' => TestController::class], function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/all', 'all');
        Route::get('/mine', 'userTests');

        Route::put('/{test}', 'update');

        Route::get('/{test}', 'show');
    });

    Route::middleware('role:admin')->group(function () {

        Route::group(['prefix' => 'theme'], function () {
            Route::post('/', [ThemeController::class, 'store']);
            Route::delete('/{theme}', [ThemeController::class, 'destroy']);
            Route::patch('/{theme}', [ThemeController::class, 'update']);

            Route::group(['prefix' => 'user'], function () {
                Route::patch('/user/{user}', [UserController::class, 'changeRole']);
            });
        });

    });
});
