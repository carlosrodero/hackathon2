<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SiteController;

// USER
Route::post('/register', [UserController::class, 'create']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/me', [UserController::class, 'me'])->middleware('auth:sanctum');

// SITE
Route::post('/site/register', [SiteController::class, 'create'])->middleware('auth:sanctum');
Route::post('/site/{id}/edit', [SiteController::class, 'edit'])->middleware('auth:sanctum');
