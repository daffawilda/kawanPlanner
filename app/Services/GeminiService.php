<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('AIzaSyBq85u4oYhe-jPclB2sZzwL8y2T7PBSKug'); // Ambil API key dari .env
    }
   

    public function generateReason($mataPelajaran, $percentage)
    {
        $prompt = "Jelaskan mengapa seseorang cocok untuk mata pelajaran '$mataPelajaran' jika mereka memiliki kecocokan sebesar $percentage%.";

        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateText", [
            'prompt' => $prompt,
            'temperature' => 0.7,
            'maxOutputTokens' => 100,
            'key' => $this->apiKey,
        ]);

        if ($response->successful()) {
            return $response->json()['candidates'][0]['output'] ?? "Alasan tidak tersedia.";
        }

        return "Terjadi kesalahan dalam mendapatkan alasan.";
    }
}
