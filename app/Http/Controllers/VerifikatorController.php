<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

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
}