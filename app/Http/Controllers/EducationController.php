<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Services\YoutubeService;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Daftar artikel edukasi.
     */
    public function index()
    {
        $educations = Education::latest()->paginate(9);
        return view('education.index', compact('educations'));
    }

    /**
     * Detail satu artikel edukasi.
     */
    public function show($id)
    {
        $education = Education::findOrFail($id);
        $education->increment('views');
        return view('education.show', compact('education'));
    }

    /**
     * Pencarian video edukasi dari YouTube.
     */
    public function videos(Request $request, YoutubeService $youtube)
    {
        $query = $request->input('q', 'cara verifikasi berita');
        $videos = $youtube->searchVideos($query);

        return view('education.videos', compact('videos', 'query'));
    }
}