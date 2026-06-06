<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HoaxAnalysisService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://api.groq.com/openai/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = env('GROQ_API_KEY', '');
    }

    public function analyze(string $title, ?string $content = null, ?string $url = null): array
    {
        $text = trim(($content ?? '') ?: $title);

        $prompt = <<<PROMPT
Anda adalah ASISTEN PEMERIKSA FAKTA yang sangat kritis. Analisis berita berikut.

**Judul:** {$title}
**Isi:** {$text}

Tentukan:
- status: salah satu dari "hoax", "valid", atau "perlu verifikasi"
- validity_score: angka 0-100 (0=pasti hoax, 100=pasti valid)
- clickbait_score: angka 0-100 (seberapa clickbait judulnya)
- provocation_score: angka 0-100 (seberapa provokatif kontennya)
- summary: penjelasan singkat dalam Bahasa Indonesia (2-3 kalimat)

Balas HANYA dengan JSON murni, tanpa markdown, tanpa penjelasan lain:
{"status":"...","validity_score":0,"clickbait_score":0,"provocation_score":0,"summary":"..."}
PROMPT;

        try {
            if (empty($this->apiKey)) {
                Log::warning('GROQ_API_KEY tidak diset, menggunakan fallback.');
                return $this->ruleBasedAnalysis($title, $text);
            }

            $response = Http::timeout(20)->withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ])->post($this->baseUrl, [
                'model'       => 'llama-3.1-8b-instant',
                'messages'    => [
                    [
                        'role'    => 'system',
                        'content' => 'Kamu adalah pemeriksa fakta profesional. Selalu balas HANYA dengan JSON murni tanpa markdown atau teks tambahan apapun.',
                    ],
                    [
                        'role'    => 'user',
                        'content' => $prompt,
                    ],
                ],
                'temperature' => 0.1,
                'max_tokens'  => 400,
            ]);

            if ($response->successful()) {
                $raw = $response->json('choices.0.message.content', '');
                $data = $this->parseJson($raw);

                if ($data) {
                    return $this->normalizeResult($data);
                }

                Log::warning('Groq: JSON tidak bisa diparsing.', ['raw' => $raw]);
            } else {
                Log::error('Groq API error.', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Groq exception: ' . $e->getMessage());
        }

        // Fallback jika API gagal
        return $this->ruleBasedAnalysis($title, $text);
    }

    /**
     * Parse JSON dari respons Groq yang mungkin kotor
     * (ada teks sebelum/sesudah {}, atau dibungkus ```json```)
     */
    private function parseJson(string $raw): ?array
    {
        $raw = trim($raw);

        // Coba langsung dulu
        $data = json_decode($raw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
            return $data;
        }

        // Bersihkan markdown ```json ... ```
        $raw = preg_replace('/```(?:json)?\s*/i', '', $raw);
        $raw = preg_replace('/```/', '', $raw);
        $raw = trim($raw);

        $data = json_decode($raw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
            return $data;
        }

        // Ekstrak bagian {...} pertama yang valid
        if (preg_match('/\{[^{}]*"status"[^{}]*\}/s', $raw, $m)) {
            $data = json_decode($m[0], true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                return $data;
            }
        }

        // Cari { ... } paling luar
        $start = strpos($raw, '{');
        $end   = strrpos($raw, '}');
        if ($start !== false && $end !== false && $end > $start) {
            $candidate = substr($raw, $start, $end - $start + 1);
            $data = json_decode($candidate, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                return $data;
            }
        }

        return null;
    }

    /**
     * Normalisasi dan validasi hasil dari AI
     */
    private function normalizeResult(array $data): array
    {
        $validStatuses = ['hoax', 'valid', 'perlu verifikasi'];

        $status = strtolower(trim($data['status'] ?? 'perlu verifikasi'));
        if (!in_array($status, $validStatuses)) {
            // Coba tebak dari kata kunci
            if (str_contains($status, 'hoax') || str_contains($status, 'palsu')) {
                $status = 'hoax';
            } elseif (str_contains($status, 'valid') || str_contains($status, 'benar')) {
                $status = 'valid';
            } else {
                $status = 'perlu verifikasi';
            }
        }

        $validityScore   = $this->clamp((int)($data['validity_score']   ?? 50));
        $clickbaitScore  = $this->clamp((int)($data['clickbait_score']  ?? 0));
        $provocationScore= $this->clamp((int)($data['provocation_score']?? 0));

        // Konsistensi: jika status hoax tapi skor validitas tinggi, koreksi
        if ($status === 'hoax' && $validityScore > 60) {
            $validityScore = rand(10, 39);
        } elseif ($status === 'valid' && $validityScore < 40) {
            $validityScore = rand(70, 95);
        }

        $summary = trim($data['summary'] ?? '');
        if (empty($summary)) {
            $summary = match($status) {
                'hoax'             => 'Berita ini terindikasi mengandung informasi yang tidak benar atau menyesatkan.',
                'valid'            => 'Berita ini terverifikasi valid berdasarkan analisis konten.',
                default            => 'Berita ini memerlukan verifikasi lebih lanjut dari sumber terpercaya.',
            };
        }

        return [
            'status'            => $status,
            'validity_score'    => $validityScore,
            'clickbait_score'   => $clickbaitScore,
            'provocation_score' => $provocationScore,
            'summary'           => $summary,
        ];
    }

    private function clamp(int $val, int $min = 0, int $max = 100): int
    {
        return max($min, min($max, $val));
    }

    /**
     * Fallback analisis berbasis aturan jika AI tidak tersedia.
     */
    private function ruleBasedAnalysis(string $title, string $text): array
    {
        $combined   = strtolower($title . ' ' . $text);
        $score      = 75;
        $clickbait  = 0;
        $provocation= 0;
        $reasons    = [];

        $clickbaitWords = [
            'mengejutkan', 'heboh', 'viral', 'anda tidak akan percaya',
            'rahasia', 'terbongkar', 'wow', 'luar biasa', 'gila', 'syok',
        ];
        foreach ($clickbaitWords as $word) {
            if (str_contains($combined, $word)) {
                $clickbait += 20;
                $reasons[] = "Mengandung kata clickbait \"$word\"";
            }
        }

        $provocationWords = [
            'bencana', 'kiamat', 'bubarkan', 'boikot', 'musuh',
            'ancaman', 'bahaya besar', 'harus ditangkap', 'pengkhianat',
        ];
        foreach ($provocationWords as $word) {
            if (str_contains($combined, $word)) {
                $provocation += 20;
                $reasons[] = "Mengandung kata provokatif \"$word\"";
            }
        }

        $supernaturalWords = ['alien', 'hantu', 'sihir', 'jin', 'ramalan', 'nujum'];
        foreach ($supernaturalWords as $word) {
            if (str_contains($combined, $word)) {
                $score -= 35;
                $reasons[] = "Klaim supernatural atau tidak ilmiah";
                break;
            }
        }

        $clickbait   = min(100, $clickbait);
        $provocation = min(100, $provocation);
        $score       = $this->clamp((int)($score - $clickbait * 0.4 - $provocation * 0.5));

        $status = match(true) {
            $score < 40 => 'hoax',
            $score < 70 => 'perlu verifikasi',
            default     => 'valid',
        };

        $summary = empty($reasons)
            ? 'Analisis dilakukan secara lokal (AI tidak tersedia). Hasilnya mungkin kurang akurat.'
            : 'Analisis lokal: ' . implode('. ', array_unique($reasons)) . '.';

        return [
            'status'            => $status,
            'validity_score'    => $score,
            'clickbait_score'   => $clickbait,
            'provocation_score' => $provocation,
            'summary'           => $summary,
        ];
    }
}