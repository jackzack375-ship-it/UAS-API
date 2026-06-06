<?php

namespace App\Http\Controllers;

use App\Models\{User, NewsHistory, Report, Education};
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ==================== DASHBOARD ADMIN ====================
    public function dashboard(Request $request)
    {
        // Filter tanggal (opsional)
        $daysFilter = $request->input('days', 7);

        // Statistik Utama
        $totalUsers        = User::count();
        $totalChecks       = NewsHistory::count();
        $hoaxDetected      = NewsHistory::where('status', 'hoax')->count();
        $validNews         = NewsHistory::where('status', 'valid')->count();
        $pendingReports    = Report::where('status', 'pending')->count();
        $totalEducations   = Education::count();
        $totalReports      = Report::count();

        // User teraktif
        $topUsers = User::withCount('newsHistories')
            ->orderBy('news_histories_count', 'desc')
            ->take(5)
            ->get();

        // Grafik hoaks 7/30 hari terakhir
        $days  = [];
        $hoaxCounts = [];
        $validCounts = [];
        for ($i = $daysFilter - 1; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $days[] = $date->format('d M');
            $hoaxCounts[] = NewsHistory::whereDate('created_at', $date)
                                ->where('status', 'hoax')->count();
            $validCounts[] = NewsHistory::whereDate('created_at', $date)
                                ->where('status', 'valid')->count();
        }

        // Distribusi status berita (pie chart)
        $pendingCount = NewsHistory::where('status', 'perlu verifikasi')->count();
        $pieLabels = ['Hoax', 'Valid', 'Perlu Verifikasi'];
        $pieData   = [$hoaxDetected, $validNews, $pendingCount];

        // Aktivitas terbaru
        $recentActivity = NewsHistory::with('user')->latest()->take(10)->get();

        // Laporan pending
        $reports = Report::with('user')->where('status', 'pending')->latest()->paginate(5);

        // Daftar user (untuk manajemen)
        $users = User::withCount('newsHistories')->latest()->paginate(10);

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalChecks',
            'hoaxDetected',
            'validNews',
            'pendingReports',
            'totalEducations',
            'totalReports',
            'topUsers',
            'days',
            'hoaxCounts',
            'validCounts',
            'pieLabels',
            'pieData',
            'recentActivity',
            'reports',
            'users',
            'daysFilter'
        ));
    }

    // ==================== MANAJEMEN USER ====================
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        // Jangan hapus admin sendiri (opsional)
        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak dapat menghapus admin.');
        }
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    // ==================== MANAJEMEN BERITA ====================
    public function deleteNews($id)
    {
        $news = NewsHistory::findOrFail($id);
        $news->delete();
        return back()->with('success', 'Berita berhasil dihapus.');
    }

    // ==================== CRUD EDUKASI ====================
    public function educations()
    {
        $educations = Education::latest()->paginate(10);
        return view('admin.educations.index', compact('educations'));
    }

    public function createEducation()
    {
        return view('admin.educations.create');
    }

    public function storeEducation(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category'    => 'required|string|max:100',
            'youtube_url' => 'nullable|string|max:255',
        ]);

        Education::create($request->only('title', 'content', 'category', 'youtube_url'));

        return redirect()
            ->route('admin.educations.index')
            ->with('success', 'Artikel edukasi berhasil ditambahkan!');
    }

    public function editEducation($id)
    {
        $education = Education::findOrFail($id);
        return view('admin.educations.edit', compact('education'));
    }

    public function updateEducation(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category'    => 'required|string|max:100',
            'youtube_url' => 'nullable|string|max:255',
        ]);

        $education = Education::findOrFail($id);
        $education->update($request->only('title', 'content', 'category', 'youtube_url'));

        return redirect()
            ->route('admin.educations.index')
            ->with('success', 'Artikel edukasi berhasil diperbarui!');
    }

    public function deleteEducation($id)
    {
        Education::findOrFail($id)->delete();

        return back()->with('success', 'Artikel edukasi berhasil dihapus.');
    }
}