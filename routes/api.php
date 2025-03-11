<?php

use App\Http\Controllers\MatchGameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/general/{id}', [MatchGameController::class, 'general'])->name('general');
Route::get('/checking', [MatchGameController::class, 'checking'])->name('checking');
Route::get('/rangking', [MatchGameController::class, 'rangking'])->name('rangking');
Route::get('/segment', [MatchGameController::class, 'segment'])->name('segment');