<?php

use App\Http\Controllers\DeepSeekController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.user')->group(function () {

    Route::get('/home', function () {
        return view('welcome');
    })->name('home');

    Route::get('/chat-gpt', function () {
        return view('gpt.chat');
    })->name('chat.gpt');

    
    Route::post('/logout', [UserController::class,'logout'])->name('logout');
});

Route::middleware('permission.user')->group(function () {
    Route::get('/register', function () {
        return view('register');
    })->name('register');

    Route::post('/register', [UserController::class,'register'])->name('register-user');

});

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class,'login'])->name('login-user');
