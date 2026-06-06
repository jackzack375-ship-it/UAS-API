<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function create()
    {
        return view('report.create');
    }

    public function store(Request $request)
    {
        // Validasi sesuai persis dengan field required di form
        $request->validate([
            'title'       => 'required|string|max:255',
            'source_url'  => 'required|url|max:500',
            'content'     => 'required|string|max:10000',
            'category'    => 'required|string|max:100',
            'urgency'     => 'nullable|string|in:low,medium,high',
            'evidence'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'description' => 'nullable|string|max:5000',
        ], [
            // Pesan error dalam Bahasa Indonesia
            'title.required'      => 'Judul berita wajib diisi.',
            'source_url.required' => 'URL sumber berita wajib diisi.',
            'source_url.url'      => 'URL sumber harus berupa link yang valid (contoh: https://...).',
            'content.required'    => 'Isi berita wajib diisi.',
            'category.required'   => 'Kategori wajib dipilih.',
            'evidence.mimes'      => 'File bukti harus berupa gambar (JPG, PNG) atau PDF.',
            'evidence.max'        => 'Ukuran file bukti maksimal 5MB.',
        ]);

        try {
            // Handle upload bukti jika ada
            $evidencePath = null;
            if ($request->hasFile('evidence') && $request->file('evidence')->isValid()) {
                $evidencePath = $request->file('evidence')->store('reports/evidence', 'public');
            }

            // Map urgency value ke label Indonesia
            $urgencyLabel = match($request->urgency) {
                'high'   => 'Tinggi',
                'medium' => 'Sedang',
                'low'    => 'Rendah',
                default  => 'Sedang',
            };

            // Gabungkan semua info ke description
            // (agar tidak perlu tambah kolom baru di tabel reports)
            $descParts = [];
            $descParts[] = "URL Sumber: {$request->source_url}";
            $descParts[] = "Kategori: {$request->category}";
            $descParts[] = "Urgensi: {$urgencyLabel}";
            $descParts[] = "Isi Berita:\n{$request->content}";
            if ($request->description) {
                $descParts[] = "Keterangan Tambahan:\n{$request->description}";
            }
            if ($evidencePath) {
                $descParts[] = "Bukti: {$evidencePath}";
            }

            Report::create([
                'user_id'     => auth()->id(),
                'title'       => $request->title,
                'description' => implode("\n\n", $descParts),
                'status'      => 'pending',
            ]);

            return redirect()->route('report.create')
                ->with('success', 'Laporan berhasil dikirim! Tim verifikator kami akan meninjaunya dalam 1×24 jam.');

        } catch (\Exception $e) {
            Log::error('ReportController@store: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['general' => 'Terjadi kesalahan saat mengirim laporan. Silakan coba lagi.']);
        }
    }
}