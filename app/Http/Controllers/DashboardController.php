<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    /**
     * Redirect ke dashboard sesuai role.
     */
    public function index()
    {
        $user = auth()->user();

        // Admin diarahkan ke dashboard admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Verifikator diarahkan ke dashboard verifikator
        if ($user->role === 'verifikator') {
            return redirect()->route('verifikator.dashboard');
        }

        // User biasa tetap di dashboard user
        return view('dashboard');
    }

    /**
     * API: Get dashboard data
     */
    public function indexApi(): JsonResponse
    {
        try {
            $user = auth()->user();

            return response()->json([
                'message' => 'Dashboard data retrieved successfully',
                'user' => $user,
                'role' => $user->role,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve dashboard data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
