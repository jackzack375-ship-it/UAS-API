<?php

namespace App\Http\Controllers;

use App\Services\NewsApiService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request, NewsApiService $newsApi)
    {
        $category = $request->query('category');
        $articles = $newsApi->getTopHeadlines($category);
        $categories = ['nasional', 'teknologi', 'kesehatan', 'pendidikan', 'politik'];

        return view('news.index', compact('articles', 'category', 'categories'));
    }
}