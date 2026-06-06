{{-- ============================================================ --}}
{{-- FILE: resources/views/admin/educations/index.blade.php     --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Kelola Edukasi')
@section('content')

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <div class="section-label mb-2">Admin Panel</div>
            <h1 class="font-display text-2xl md:text-3xl font-black text-ink-900 dark:text-ink-50">Kelola Edukasi</h1>
            <p class="text-sm text-ink-400 mt-1">Kelola artikel dan konten edukasi literasi digital</p>
        </div>
        <a href="{{ route('admin.educations.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Artikel
        </a>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-elegant">
                <thead>
                    <tr>
                        <th>Judul Artikel</th>
                        <th>Kategori</th>
                        <th>Views</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($educations as $edu)
                    <tr>
                        <td class="font-medium text-ink-800 dark:text-ink-100">{{ $edu->title }}</td>
                        <td>
                            <span class="badge badge-verify">{{ $edu->category }}</span>
                        </td>
                        <td class="font-mono text-sm text-ink-500">{{ number_format($edu->views) }}</td>
                        <td class="text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.educations.edit', $edu->id) }}"
                                   class="text-sm font-semibold transition-colors" style="color: var(--gold);">Edit</a>
                                <form action="{{ route('admin.educations.delete', $edu->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-sm font-semibold text-red-500 hover:text-red-700 transition-colors">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t" style="border-color: rgba(0,0,0,0.06);">
            {{ $educations->links() }}
        </div>
    </div>
</div>

@endsection