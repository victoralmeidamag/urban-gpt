<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;

class GeminiController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    /**
     * Processa uma única solicitação ao Gemini
     */
    public function generateResponse(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:4096',
        ]);

        $prompt = $request->input('prompt');
        $options = [
            'temperature' => $request->input('temperature', 0.7),
            'maxOutputTokens' => $request->input('maxTokens', 1024),
            'topK' => $request->input('topK', 40),
            'topP' => $request->input('topP', 0.95),
        ];

        $response = $this->geminiService->generateContent($prompt, $options);
        
        if (!$response) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar a solicitação à API Gemini'
            ], 500);
        }

        $text = $this->geminiService->extractResponseText($response);

        return response()->json([
            'success' => true,
            'response' => $text,
            'full_response' => $response
        ]);
    }

    /**
     * Processa uma conversa com múltiplas mensagens
     */
    public function chat(Request $request)
    {
        $request->validate([
            'messages' => 'required|array|min:1',
            'messages.*.role' => 'required|string|in:user,model',
            'messages.*.content' => 'required|string',
        ]);

        $messages = $request->input('messages');
        
        $response = $this->geminiService->chat($messages);
        
        if (!$response) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar a conversa com a API Gemini'
            ], 500);
        }

        $text = $this->geminiService->extractResponseText($response);

        return response()->json([
            'success' => true,
            'response' => $text,
            'full_response' => $response
        ]);
    }
}