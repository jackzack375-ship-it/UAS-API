<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}