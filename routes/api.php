<?php

use App\Http\Controllers\GeminiController;
use Illuminate\Support\Facades\Route;

Route::post('/gemini/generate', [GeminiController::class, 'generateResponse']);
Route::post('/gemini/chat', [GeminiController::class, 'chat']);
Route::post('/gpt/completion', [App\Http\Controllers\GptController::class, 'generateResponse']);
Route::post('/gpt/chat', [App\Http\Controllers\GptController::class, 'chatCompletion'])->name('api.gpt');