<?php

namespace App\Http\Controllers;

use App\Models\NewsHistory;
use Illuminate\Http\JsonResponse;

class HistoryController extends Controller
{
    /**
     * Tampilkan riwayat pengecekan milik user yang sedang login.
     */
    public function index()
    {
        $histories = NewsHistory::with('hoaxCheck')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('history.index', compact('histories'));
    }

    /**
     * API: Get all history for authenticated user
     */
    public function indexApi(): JsonResponse
    {
        try {
            $histories = NewsHistory::with('hoaxCheck')
                ->where('user_id', auth()->id())
                ->latest()
                ->get();

            return response()->json([
                'message' => 'History retrieved successfully',
                'data' => $histories,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve history',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * API: Get single history
     */
    public function showApi($id): JsonResponse
    {
        try {
            $history = NewsHistory::with('hoaxCheck')
                ->where('user_id', auth()->id())
                ->findOrFail($id);

            return response()->json([
                'message' => 'History retrieved successfully',
                'data' => $history,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'History not found',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * API: Delete history
     */
    public function destroyApi($id): JsonResponse
    {
        try {
            $history = NewsHistory::where('user_id', auth()->id())
                ->findOrFail($id);

            $history->delete();

            return response()->json([
                'message' => 'History deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete history',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
