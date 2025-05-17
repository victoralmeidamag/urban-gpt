<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class GptService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;

    /**
     * Constructor para inicializar o cliente HTTP e configurações da API
     */
    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->baseUrl = config('services.openai.base_url', 'https://api.openai.com/v1');
        
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'timeout' => 60.0,
        ]);
    }

    /**
     * Método para gerar texto com base em um prompt
     * 
     * @param string $prompt
     * @param int $maxTokens
     * @param float $temperature
     * @param string $model
     * @return array
     * @throws \Exception
     */
    public function generateCompletion(
        string $prompt, 
        int $maxTokens = 1000, 
        float $temperature = 0.7, 
        string $model = 'gpt-4o'
    ): array {
        try {
            // Como a OpenAI migrou para o endpoint de chat, usamos ele mesmo para completions simples
            $response = $this->client->post('v1/chat/completions', [
                'json' => [
                    'model' => $model,
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'max_tokens' => $maxTokens,
                    'temperature' => $temperature,
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            
            return [
                'text' => $result['choices'][0]['message']['content'],
                'usage' => $result['usage'] ?? null,
                'model' => $result['model'] ?? $model,
            ];
        } catch (GuzzleException $e) {
            Log::error('Erro na API do GPT: ' . $e->getMessage());
            throw new \Exception('Falha ao comunicar com a API do OpenAI: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Erro desconhecido: ' . $e->getMessage());
            throw new \Exception('Erro ao processar a solicitação: ' . $e->getMessage());
        }
    }

    /**
     * Método para criar uma conversa completa com chat
     * 
     * @param array $messages
     * @param int $maxTokens
     * @param float $temperature
     * @param string $model
     * @return array
     * @throws \Exception
     */
    public function createChatCompletion(
        array $messages, 
        int $maxTokens = 1000, 
        float $temperature = 0.7, 
        string $model = 'gpt-4.1'
    ): array {
    try {
        // Definir instruções claras para o sistema
        $systemMessage = [
            'role' => 'system', 
            'content' => 'Você é um assistente especialista em zoneamento urbano no Brasil. Sua função é fornecer respostas completas, diretas e técnicas sobre o uso e ocupação do solo de qualquer endereço brasileiro informado. Consulte prioritariamente fontes oficiais e forneça dados precisos, sem placeholders. Responda apenas quando tiver informações concretas.'
        ];
        
        // Garantir que a mensagem do sistema seja a primeira
        array_unshift($messages, $systemMessage);

        $response = $this->client->post('v1/chat/completions', [
            'json' => [
                'model' => $model,
                'messages' => $messages,
                'max_tokens' => $maxTokens,
                'temperature' => $temperature,
            ]
        ]);

            $result = json_decode($response->getBody()->getContents(), true);
            
            return [
                'message' => $result['choices'][0]['message'],
                'usage' => $result['usage'] ?? null,
                'model' => $result['model'] ?? $model,
            ];
        } catch (GuzzleException $e) {
            Log::error('Erro na API do GPT (Chat): ' . $e->getMessage());
            throw new \Exception('Falha ao comunicar com a API do OpenAI: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Erro desconhecido: ' . $e->getMessage());
            throw new \Exception('Erro ao processar a solicitação de chat: ' . $e->getMessage());
        }
    }
}