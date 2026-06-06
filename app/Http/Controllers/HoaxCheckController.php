<?php

namespace App\Http\Controllers;

use App\Models\NewsHistory;
use App\Services\HoaxAnalysisService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class HoaxCheckController extends Controller
{
    /**
     * Tampilkan form cek hoaks.
     */
    public function index()
    {
        return view('hoax.check');
    }

    /**
     * Proses analisis berita dan redirect ke halaman hasil.
     */
    public function analyze(Request $request, HoaxAnalysisService $analyzer)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string|max:10000',
            'url'     => 'nullable|url|max:500',
        ]);

        try {
            // Panggil service AI (Groq)
            $analysis = $analyzer->analyze(
                $request->title,
                $request->content,
                $request->url
            );

            // Pastikan semua field ada sebelum simpan
            $status        = $analysis['status']            ?? 'perlu verifikasi';
            $validityScore = $analysis['validity_score']    ?? 50;
            $clickbait     = $analysis['clickbait_score']   ?? 0;
            $provocation   = $analysis['provocation_score'] ?? 0;
            $summary       = $analysis['summary']           ?? 'Tidak ada ringkasan.';

            // Simpan ke news_histories
            $history = NewsHistory::create([
                'user_id'        => auth()->id(),
                'title'          => $request->title,
                'content'        => $request->content,
                'url'            => $request->url,
                'status'         => $status,
                'validity_score' => $validityScore,
                'ai_analysis'    => $analysis,
            ]);

            // Simpan detail ke hoax_checks
            $history->hoaxCheck()->create([
                'clickbait_score'    => $clickbait,
                'provocation_score'  => $provocation,
                'source_credibility' => max(0, 100 - (int)(($clickbait + $provocation) / 2)),
                'summary'            => $summary,
            ]);

            return redirect()->route('hoax.result', $history->id)
                ->with('success', 'Analisis berhasil dilakukan!');

        } catch (\Exception $e) {
            Log::error('HoaxCheckController@analyze error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->withErrors(['general' => 'Terjadi kesalahan saat menganalisis: ' . $e->getMessage()]);
        }
    }

    /**
     * Tampilkan hasil analisis.
     */
    public function result($id)
    {
        $history = NewsHistory::with('hoaxCheck')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('hoax.result', compact('history'));
    }

    /**
     * API: Analyze title only
     */
    public function analyzeTitleApi(Request $request, HoaxAnalysisService $analyzer): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
            ]);

            $analysis = $analyzer->analyze($validated['title'], null, null);

            $history = NewsHistory::create([
                'user_id'        => auth()->id(),
                'title'          => $validated['title'],
                'content'        => null,
                'url'            => null,
                'status'         => $analysis['status'] ?? 'perlu verifikasi',
                'validity_score' => $analysis['validity_score'] ?? 50,
                'ai_analysis'    => $analysis,
            ]);

            $history->hoaxCheck()->create([
                'clickbait_score'    => $analysis['clickbait_score'] ?? 0,
                'provocation_score'  => $analysis['provocation_score'] ?? 0,
                'source_credibility' => max(0, 100 - (int)((($analysis['clickbait_score'] ?? 0) + ($analysis['provocation_score'] ?? 0)) / 2)),
                'summary'            => $analysis['summary'] ?? 'Analisis berdasarkan judul',
            ]);

            return response()->json([
                'message' => 'Analysis successful',
                'data' => [
                    'id' => $history->id,
                    'title' => $history->title,
                    'status' => $history->status,
                    'validity_score' => $history->validity_score,
                    'analysis' => $history->ai_analysis,
                ]
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('HoaxCheckController@analyzeTitleApi error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Analysis failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * API: Analyze content
     */
    public function analyzeContentApi(Request $request, HoaxAnalysisService $analyzer): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string|max:10000',
            ]);

            $analysis = $analyzer->analyze($validated['title'], $validated['content'], null);

            $history = NewsHistory::create([
                'user_id'        => auth()->id(),
                'title'          => $validated['title'],
                'content'        => $validated['content'],
                'url'            => null,
                'status'         => $analysis['status'] ?? 'perlu verifikasi',
                'validity_score' => $analysis['validity_score'] ?? 50,
                'ai_analysis'    => $analysis,
            ]);

            $history->hoaxCheck()->create([
                'clickbait_score'    => $analysis['clickbait_score'] ?? 0,
                'provocation_score'  => $analysis['provocation_score'] ?? 0,
                'source_credibility' => max(0, 100 - (int)((($analysis['clickbait_score'] ?? 0) + ($analysis['provocation_score'] ?? 0)) / 2)),
                'summary'            => $analysis['summary'] ?? 'Analisis berdasarkan konten',
            ]);

            return response()->json([
                'message' => 'Analysis successful',
                'data' => [
                    'id' => $history->id,
                    'title' => $history->title,
                    'content' => substr($history->content, 0, 100) . '...',
                    'status' => $history->status,
                    'validity_score' => $history->validity_score,
                    'analysis' => $history->ai_analysis,
                ]
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('HoaxCheckController@analyzeContentApi error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Analysis failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * API: Analyze with link
     */
    public function analyzeLinkApi(Request $request, HoaxAnalysisService $analyzer): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'url'   => 'required|url|max:500',
            ]);

            $analysis = $analyzer->analyze($validated['title'], null, $validated['url']);

            $history = NewsHistory::create([
                'user_id'        => auth()->id(),
                'title'          => $validated['title'],
                'content'        => null,
                'url'            => $validated['url'],
                'status'         => $analysis['status'] ?? 'perlu verifikasi',
                'validity_score' => $analysis['validity_score'] ?? 50,
                'ai_analysis'    => $analysis,
            ]);

            $history->hoaxCheck()->create([
                'clickbait_score'    => $analysis['clickbait_score'] ?? 0,
                'provocation_score'  => $analysis['provocation_score'] ?? 0,
                'source_credibility' => max(0, 100 - (int)((($analysis['clickbait_score'] ?? 0) + ($analysis['provocation_score'] ?? 0)) / 2)),
                'summary'            => $analysis['summary'] ?? 'Analisis dari link sumber',
            ]);

            return response()->json([
                'message' => 'Analysis successful',
                'data' => [
                    'id' => $history->id,
                    'title' => $history->title,
                    'url' => $history->url,
                    'status' => $history->status,
                    'validity_score' => $history->validity_score,
                    'analysis' => $history->ai_analysis,
                ]
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('HoaxCheckController@analyzeLinkApi error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Analysis failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * API: Analyze with OpenAI integration
     */
    public function analyzeWithOpenAiApi(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'OpenAI analysis endpoint ready',
            'status' => 'placeholder',
        ], 200);
    }
}
