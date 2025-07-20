<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/teste', [UsersController::class, 'teste']);
// Route::apiResource('users', UsersController::class);
// Route::apiResource('transactions', TransactionsController::class);