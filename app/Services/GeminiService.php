<?php

namespace App\Services;

use Gemini\Laravel\Facades\Gemini;

class GeminiService
{

    public function generateReason($mataPelajaran, $percentage)
    {
        $prompt = "Jelaskan mengapa seseorang cocok untuk mata pelajaran '$mataPelajaran' jika mereka memiliki kecocokan sebesar $percentage%. Jelaskan dalam maksimal 200 kata. dan jelaskan dalam satu text paragraf saja";

        try {
            $response = Gemini::geminiPro()->generateContent($prompt);
            return $response->text();
        } catch (\Throwable $th) {
            return 'Terjadi Kesalahan';
        }
    }
}
