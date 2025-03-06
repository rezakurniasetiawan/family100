<?php

use App\Http\Controllers\MatchGameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/match', [MatchGameController::class, 'index'])->name('index');