<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VerifikatorController extends Controller
{
    /**
     * Dashboard verifikator: daftar laporan pending.
     */
    public function dashboard()
    {
        $reports = Report::where('status', 'pending')->paginate(10);
        return view('verifikator.dashboard', compact('reports'));
    }

    /**
     * Update status laporan (valid/hoaks/perlu verifikasi).
     */
    public function updateReport(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->update([
            'status'          => $request->status,
            'verifikator_id'  => auth()->id(),
            'reviewed_at'     => now(),
        ]);

        return back()->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * API: Get all reports for verifikator
     */
    public function getReportsApi(): JsonResponse
    {
        try {
            $reports = Report::with('user')
                ->where('status', 'pending')
                ->latest()
                ->get();

            return response()->json([
                'message' => 'Reports retrieved successfully',
                'data' => $reports,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve reports',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * API: Update report status
     */
    public function updateReportApi(Request $request, $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:valid,hoax,perlu verifikasi',
            ]);

            $report = Report::findOrFail($id);
            $report->update([
                'status'          => $validated['status'],
                'verifikator_id'  => auth()->id(),
                'reviewed_at'     => now(),
            ]);

            return response()->json([
                'message' => 'Report updated successfully',
                'data' => $report,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update report',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
