<?php

namespace App\Http\Controllers;

use App\Services\NewsApiService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    public function index(Request $request, NewsApiService $newsApi)
    {
        $category = $request->query('category');
        $articles = $newsApi->getTopHeadlines($category);
        $categories = ['nasional', 'teknologi', 'kesehatan', 'pendidikan', 'politik'];

        return view('news.index', compact('articles', 'category', 'categories'));
    }

    /**
     * API: Get news from NewsAPI
     */
    public function indexApi(Request $request, NewsApiService $newsApi): JsonResponse
    {
        try {
            $category = $request->query('category');
            $articles = $newsApi->getTopHeadlines($category);

            return response()->json([
                'message' => 'News retrieved successfully',
                'data' => $articles,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve news',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * API: Analyze with NewsAPI
     */
    public function analyzeWithNewsApiApi(Request $request, NewsApiService $newsApi): JsonResponse
    {
        try {
            $validated = $request->validate([
                'query' => 'required|string|max:255',
            ]);

            $articles = $newsApi->getTopHeadlines($validated['query']);

            return response()->json([
                'message' => 'News analysis successful',
                'data' => $articles,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to analyze news',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
