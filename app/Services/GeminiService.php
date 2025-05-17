<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $apiKey;
    protected $baseUrl;
    protected $model;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
        $this->baseUrl = 'https://generativelanguage.googleapis.com/v1beta';
        $this->model = 'gemini-2.0-flash'; // Ou outro modelo disponível
    }

    /**
     * Envia uma solicitação de texto para a API do Gemini
     *
     * @param string $prompt O texto de entrada para o modelo
     * @param array $options Opções adicionais para a API
     * @return array|null Resposta da API ou null em caso de erro
     */
    public function generateContent(string $prompt, array $options = [])
    {
        $endpoint = "{$this->baseUrl}/models/{$this->model}:generateContent";
        
        $payload = [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ];
        
        // Adiciona opções como temperatura, tokens máximos, etc.
        if (!empty($options)) {
            $payload['generationConfig'] = $options;
        }
        
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->withQueryParameters([
                'key' => $this->apiKey
            ])->post($endpoint, $payload);
            
            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('Erro na API Gemini: ' . $response->body());
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Exceção ao chamar API Gemini: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Extrai o texto de resposta da estrutura JSON retornada
     *
     * @param array $response Resposta completa da API
     * @return string|null Texto da resposta ou null
     */
    public function extractResponseText(array $response)
    {
        if (isset($response['candidates'][0]['content']['parts'][0]['text'])) {
            return $response['candidates'][0]['content']['parts'][0]['text'];
        }
        
        return null;
    }
    
    /**
     * Realiza uma conversa em vários turnos com o modelo
     *
     * @param array $messages Array de mensagens com formato ['role' => 'user|model', 'content' => 'texto']
     * @return array|null Resposta da API
     */
    public function chat(array $messages)
    {
        $endpoint = "{$this->baseUrl}/models/{$this->model}:generateContent";
        
        $contents = [];
        foreach ($messages as $message) {
            $contents[] = [
                'role' => $message['role'],
                'parts' => [
                    ['text' => $message['content']]
                ]
            ];
        }
        
        $payload = [
            'contents' => $contents
        ];
        
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->withQueryParameters([
                'key' => $this->apiKey
            ])->post($endpoint, $payload);
            
            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('Erro na API Gemini (chat): ' . $response->body());
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Exceção ao chamar API Gemini (chat): ' . $e->getMessage());
            return null;
        }
    }
}