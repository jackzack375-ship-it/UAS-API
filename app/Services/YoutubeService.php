<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class YoutubeService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://www.googleapis.com/youtube/v3/';

    public function __construct()
    {
        $this->apiKey = env('YOUTUBE_API_KEY');
    }

    /**
     * Cari video YouTube berdasarkan query.
     */
    public function searchVideos(string $query, int $maxResults = 6): array
    {
        $cacheKey = 'youtube_search_' . md5($query . $maxResults);

        return Cache::remember($cacheKey, 86400, function () use ($query, $maxResults) {
            $response = Http::get($this->baseUrl . 'search', [
                'part'             => 'snippet',
                'q'                => $query,
                'maxResults'       => $maxResults,
                'type'             => 'video',
                'key'              => $this->apiKey,
                'relevanceLanguage'=> 'id',
                'regionCode'       => 'ID',
            ]);

            if ($response->successful()) {
                return $response->json()['items'] ?? [];
            }

            return [];
        });
    }
}