<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->get('/profile', [UserController::class, 'profile'])->name('profile');
Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'logout'])->name('logout');
