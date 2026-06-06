<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Services\YoutubeService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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
     * API: Get all educations
     */
    public function indexApi(): JsonResponse
    {
        try {
            $educations = Education::latest()->get();

            return response()->json([
                'message' => 'Educations retrieved successfully',
                'data' => $educations,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve educations',
                'error' => $e->getMessage(),
            ], 500);
        }
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
     * API: Get single education
     */
    public function showApi($id): JsonResponse
    {
        try {
            $education = Education::findOrFail($id);
            $education->increment('views');

            return response()->json([
                'message' => 'Education retrieved successfully',
                'data' => $education,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Education not found',
                'error' => $e->getMessage(),
            ], 404);
        }
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

    /**
     * API: Store education (admin only)
     */
    public function storeApi(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title'       => 'required|string|max:255',
                'content'     => 'required|string',
                'category'    => 'required|string|max:100',
                'youtube_url' => 'nullable|string|max:255',
            ]);

            $education = Education::create($validated);

            return response()->json([
                'message' => 'Education created successfully',
                'data' => $education,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create education',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * API: Update education (admin only)
     */
    public function updateApi(Request $request, $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title'       => 'required|string|max:255',
                'content'     => 'required|string',
                'category'    => 'required|string|max:100',
                'youtube_url' => 'nullable|string|max:255',
            ]);

            $education = Education::findOrFail($id);
            $education->update($validated);

            return response()->json([
                'message' => 'Education updated successfully',
                'data' => $education,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update education',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * API: Delete education (admin only)
     */
    public function destroyApi($id): JsonResponse
    {
        try {
            Education::findOrFail($id)->delete();

            return response()->json([
                'message' => 'Education deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete education',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * API: Add YouTube video
     */
    public function addYouTubeVideoApi(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title'       => 'required|string|max:255',
                'content'     => 'required|string',
                'category'    => 'required|string|max:100',
                'youtube_url' => 'required|string|max:255',
            ]);

            $education = Education::create($validated);

            return response()->json([
                'message' => 'YouTube video added successfully',
                'data' => $education,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to add YouTube video',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
