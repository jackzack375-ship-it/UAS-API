<?php

namespace App\Http\Controllers;

use App\Models\NewsHistory;
use App\Services\HoaxAnalysisService;
use Illuminate\Http\Request;
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
}