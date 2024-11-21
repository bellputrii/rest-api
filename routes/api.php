<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GreetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/info', [InfoController::class, 'index'])->name('info');

Route::get('/greet', [GreetController::class, 'greet'])->name('greet');

Route::get('/gallery', [GalleryController::class, 'gallery'])->name('gallery');
