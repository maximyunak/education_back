<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get("/user", [AuthController::class, "register"]);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'user']);
Route::get('/refresh', [AuthController::class, 'refresh']);

Route::middleware([CheckToken::class])->group(function () {

    Route::get('/user', [AuthController::class, 'user']);

});
