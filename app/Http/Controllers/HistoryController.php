<?php

namespace App\Http\Controllers;

use App\Models\NewsHistory;

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
}