<?php

namespace App\Http\Controllers;

use App\Services\DeepSeekService;
use Illuminate\Http\Request;

class DeepSeekController extends Controller
{
    protected $deepSeekService;

    public function __construct(DeepSeekService $deepSeekService)
    {
        $this->deepSeekService = $deepSeekService;
    }

    public function ask(Request $request)
    {
        $question = $request->input('question');
        
        if (empty($question)) {
            return response()->json(['error' => 'Question is required'], 400);
        }

        $response = $this->deepSeekService->askQuestion($question);

        return response()->json($response);
    }
}