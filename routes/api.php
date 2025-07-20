<?php

use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [UsersController::class, 'login']);
Route::apiResource('users', UsersController::class);
Route::apiResource('transactions', TransactionsController::class);
Route::get('/transactionsUser/{id}', [TransactionsController::class, 'getTransactionsUser']);
Route::get('/transactionsType/{id}/{type}', [TransactionsController::class, 'getTransactionsType']);
Route::get('/transactionsRange/{id}/{start}/{end}', [TransactionsController::class, 'getTransactionsRange']);
Route::get('/transactionById/{id}', [TransactionsController::class, 'getTransactionById']);