<?php

use App\Http\Controllers\DeepSeekController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/chat-gpt', function () {
        return view('gpt.chat');
    })->name('chat.gpt');

        Route::get('/login', function () {
        return view('login');
    })->name('login');

        Route::get('/register', function () {
        return view('register');
    })->name('register');

