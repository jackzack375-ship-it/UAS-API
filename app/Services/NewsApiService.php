<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class NewsApiService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://gnews.io/api/v4/';

    public function __construct()
    {
        $this->apiKey = env('GNEWS_API_KEY');
    }

    /**
     * Ambil berita terkini berdasarkan kategori & negara.
     */
    public function getTopHeadlines(?string $category = null, string $country = 'id'): array
    {
        $cacheKey = "gnews_headlines_{$country}_" . ($category ?? 'all');

        return Cache::remember($cacheKey, 3600, function () use ($category, $country) {
            $params = [
                'token'   => $this->apiKey,
                'lang'    => 'id',
                'country' => $country,
                'max'     => 10,
            ];

            if ($category) {
                $params['q'] = $category; // GNews menggunakan parameter 'q' untuk topik
            }

            try {
                $response = Http::timeout(10)
                    ->get($this->baseUrl . 'top-headlines', $params);

                if ($response->successful() && !empty($response->json()['articles'])) {
                    return $this->transformArticles($response->json()['articles']);
                }
            } catch (\Exception $e) {
                // Bila gagal, lanjut ke fallback
            }

            return $this->getDummyNews($category);
        });
    }

    /**
     * Pencarian berita.
     */
    public function searchNews(string $query): array
    {
        $cacheKey = 'gnews_search_' . md5($query);

        return Cache::remember($cacheKey, 3600, function () use ($query) {
            $params = [
                'token' => $this->apiKey,
                'q'     => $query,
                'lang'  => 'id',
                'max'   => 10,
            ];

            try {
                $response = Http::timeout(10)
                    ->get($this->baseUrl . 'search', $params);

                if ($response->successful()) {
                    return $this->transformArticles($response->json()['articles']);
                }
            } catch (\Exception $e) {
                // fallback
            }

            return $this->getDummyNews();
        });
    }

    /**
     * Transformasi artikel GNews ke format yang sudah dipakai di view.
     */
    private function transformArticles(array $articles): array
    {
        return collect($articles)
            ->map(function ($article) {
                return [
                    'title'       => $article['title'],
                    'description' => $article['description'] ?? '',
                    'source'      => ['name' => $article['source']['name'] ?? 'Sumber tidak dikenal'],
                    'publishedAt' => $article['publishedAt'],
                    'urlToImage'  => $article['image'] ?? null,
                    'url'         => $article['url'],
                ];
            })
            ->all();
    }

    /**
     * Data dummy sebagai pengganti jika API tidak bisa dijangkau.
     */
    private function getDummyNews(?string $category = null): array
    {
        $allNews = [
            'nasional' => [
                [
                    'title'       => 'Pemerintah Luncurkan Program Anti Hoaks Nasional',
                    'description' => 'Program ini bertujuan meningkatkan literasi digital masyarakat.',
                    'source'      => ['name' => 'Kominfo News'],
                    'publishedAt' => now()->subHour()->toISOString(),
                    'urlToImage'  => null,
                    'url'         => '#',
                ],
                [
                    'title'       => 'Presiden Ajak Masyarakat Verifikasi Informasi',
                    'description' => 'Dalam pidato kenegaraan, Presiden menekankan pentingnya cek fakta.',
                    'source'      => ['name' => 'Sekretariat Kabinet'],
                    'publishedAt' => now()->subHours(2)->toISOString(),
                    'urlToImage'  => null,
                    'url'         => '#',
                ],
            ],
            'teknologi' => [
                [
                    'title'       => 'AI Detektor Hoaks Karya Anak Bangsa Raih Penghargaan',
                    'description' => 'Startup Indonesia ciptakan AI pendeteksi clickbait.',
                    'source'      => ['name' => 'TechIna'],
                    'publishedAt' => now()->subHour()->toISOString(),
                    'urlToImage'  => null,
                    'url'         => '#',
                ],
                [
                    'title'       => 'Tips Mengamankan Akun Medsos dari Phishing',
                    'description' => 'Pakar keamanan siber bagikan langkah mudah lindungi data pribadi.',
                    'source'      => ['name' => 'CyberNews'],
                    'publishedAt' => now()->subHours(3)->toISOString(),
                    'urlToImage'  => null,
                    'url'         => '#',
                ],
            ],
            'kesehatan' => [
                [
                    'title'       => 'Kemenkes Bantah Kabar Vaksin Palsu Beredar',
                    'description' => 'Kementerian Kesehatan tegaskan semua vaksin telah melalui uji klinis.',
                    'source'      => ['name' => 'Sehat Negeriku'],
                    'publishedAt' => now()->subHour()->toISOString(),
                    'urlToImage'  => null,
                    'url'         => '#',
                ],
                [
                    'title'       => 'Peneliti Temukan Manfaat Baru Daun Kelor',
                    'description' => 'Studi terbaru ungkap potensi daun kelor untuk imunitas tubuh.',
                    'source'      => ['name' => 'Healthline Indonesia'],
                    'publishedAt' => now()->subHours(2)->toISOString(),
                    'urlToImage'  => null,
                    'url'         => '#',
                ],
            ],
            'pendidikan' => [
                [
                    'title'       => 'Kampus Merdeka Buka Kelas Literasi Digital',
                    'description' => 'Mahasiswa bisa ambil SKS tambahan untuk belajar deteksi hoaks.',
                    'source'      => ['name' => 'Dikti News'],
                    'publishedAt' => now()->subHour()->toISOString(),
                    'urlToImage'  => null,
                    'url'         => '#',
                ],
            ],
            'politik' => [
                [
                    'title'       => 'DPR Sahkan UU Perlindungan Data Pribadi',
                    'description' => 'Undang-undang baru beri sanksi tegas penyebar hoaks.',
                    'source'      => ['name' => 'DPR RI'],
                    'publishedAt' => now()->subHour()->toISOString(),
                    'urlToImage'  => null,
                    'url'         => '#',
                ],
            ],
        ];

        if ($category && isset($allNews[$category])) {
            return $allNews[$category];
        }

        return array_merge(...array_values($allNews));
    }
}