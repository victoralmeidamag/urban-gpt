<?php

use App\Http\Controllers\DeepSeekController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

    Route::get('/chat-gpt', function () {
        return view('gpt.chat');
    })->name('chat.gpt');

        Route::get('/login', function () {
        return view('login');
    })->name('login');

        Route::get('/register', function () {
        return view('register');
    })->name('register');

Route::post('/login', [UserController::class,'login'])->name('login-user');
Route::post('/register', [UserController::class,'register'])->name('register-user');
Route::post('/logout', [UserController::class,'logout'])->name('logout');