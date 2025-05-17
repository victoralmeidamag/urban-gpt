<?php

namespace App\Http\Controllers;

use App\Services\GptService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GptController extends Controller
{
    protected $gptService;

    /**
     * Constructor para injetar o serviço do GPT
     * 
     * @param GptService $gptService
     */
    public function __construct(GptService $gptService)
    {
        $this->gptService = $gptService;
    }

    /**
     * Método para processar uma nova solicitação ao GPT
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function generateResponse(Request $request): JsonResponse
    {
        // Validar os dados recebidos
        $validated = $request->validate([
            'prompt' => 'required|string',
            'max_tokens' => 'integer|nullable',
            'temperature' => 'numeric|between:0,2|nullable',
            'model' => 'string|nullable'
        ]);

        try {
            // Obter a resposta do serviço do GPT
            $response = $this->gptService->generateCompletion(
                $validated['prompt'],
                $validated['max_tokens'] ?? 1000,
                $validated['temperature'] ?? 0.7,
                $validated['model'] ?? 'gpt-4o'
            );

            return response()->json([
                'success' => true,
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar a solicitação ao GPT',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Método para gerar um chat completo com histórico
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function chatCompletion(Request $request): JsonResponse
    {
        // Validar os dados recebidos
    $validated = $request->validate([
        'messages' => 'required|array',
        'messages.*.role' => 'required|string|in:system,user,assistant',
        'messages.*.content' => 'required|string',
        'max_tokens' => 'integer|nullable',
        'temperature' => 'numeric|between:0,2|nullable',
        'model' => 'string|in:gpt-4o,gpt-4-turbo,gpt-3.5-turbo' // Validar modelos
    ]);

        try {
            // Obter a resposta do serviço do GPT
            $response = $this->gptService->createChatCompletion(
                $validated['messages'],
                $validated['max_tokens'] ?? 1000,
                $validated['temperature'] ?? 0.7,
                $validated['model'] ?? 'gpt-4o'
            );

            return response()->json([
                'success' => true,
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar o chat com GPT',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}