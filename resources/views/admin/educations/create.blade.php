{{-- ============================================================ --}}
{{-- FILE: resources/views/admin/educations/create.blade.php    --}}
{{-- (Gunakan juga untuk edit, ganti route & tambah @method)    --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', isset($education) ? 'Edit Artikel' : 'Tambah Artikel')
@section('content')

<div class="max-w-2xl mx-auto">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-ink-400 mb-6">
        <a href="{{ route('admin.educations.index') }}" class="hover:text-ink-700 dark:hover:text-ink-200 transition-colors">Kelola Edukasi</a>
        <span>/</span>
        <span class="text-ink-700 dark:text-ink-200">{{ isset($education) ? 'Edit Artikel' : 'Tambah Artikel Baru' }}</span>
    </div>

    <div class="card p-8">
        {{-- Header --}}
        <div class="mb-8 pb-6 border-b" style="border-color: rgba(0,0,0,0.06);">
            <div class="section-label mb-3">{{ isset($education) ? 'Edit Konten' : 'Konten Baru' }}</div>
            <h1 class="font-display text-2xl font-black text-ink-900 dark:text-ink-50">
                {{ isset($education) ? 'Edit Artikel Edukasi' : 'Tambah Artikel Edukasi' }}
            </h1>
            <p class="text-sm text-ink-400 mt-1">Isi formulir di bawah untuk {{ isset($education) ? 'memperbarui' : 'menambah' }} artikel edukasi literasi digital.</p>
        </div>

        <form action="{{ isset($education) ? route('admin.educations.update', $education->id) : route('admin.educations.store') }}"
              method="POST" class="space-y-6">
            @csrf
            @if(isset($education)) @method('PUT') @endif

            {{-- Errors --}}
            @if($errors->any())
            <div class="p-4 rounded-xl text-sm" style="background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2); color: #EF4444;">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Title --}}
            <div>
                <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                <input type="text" name="title" required
                       value="{{ old('title', $education->title ?? '') }}"
                       placeholder="Masukkan judul artikel yang menarik..."
                       class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:outline-none focus:ring-2 dark:bg-ink-800 dark:text-ink-100 dark:placeholder-ink-500"
                       style="border-color: rgba(0,0,0,0.12);"
                       onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
                       onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="category" required
                       value="{{ old('category', $education->category ?? '') }}"
                       placeholder="Contoh: Teknik, Analisis, Edukasi..."
                       class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:outline-none dark:bg-ink-800 dark:text-ink-100 dark:placeholder-ink-500"
                       style="border-color: rgba(0,0,0,0.12);"
                       onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
                       onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">
            </div>

            {{-- Content --}}
            <div>
                <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Konten Artikel <span class="text-red-500">*</span></label>
                <textarea name="content" rows="8" required
                          placeholder="Tulis konten artikel edukasi di sini..."
                          class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:outline-none resize-y dark:bg-ink-800 dark:text-ink-100 dark:placeholder-ink-500"
                          style="border-color: rgba(0,0,0,0.12);"
                          onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
                          onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">{{ old('content', $education->content ?? '') }}</textarea>
            </div>

            {{-- YouTube URL --}}
            <div>
                <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-1">YouTube Video ID <span class="text-ink-400 font-normal">(opsional)</span></label>
                <p class="text-xs text-ink-400 mb-2">Masukkan ID video YouTube, contoh: <span class="font-mono" style="color: var(--gold);">dQw4w9WgXcQ</span></p>
                <input type="text" name="youtube_url"
                       value="{{ old('youtube_url', $education->youtube_url ?? '') }}"
                       placeholder="Video ID YouTube..."
                       class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:outline-none font-mono dark:bg-ink-800 dark:text-ink-100 dark:placeholder-ink-500"
                       style="border-color: rgba(0,0,0,0.12);"
                       onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
                       onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-4 pt-4 border-t" style="border-color: rgba(0,0,0,0.06);">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ isset($education) ? 'Simpan Perubahan' : 'Simpan Artikel' }}
                </button>
                <a href="{{ route('admin.educations.index') }}" class="btn-secondary text-sm">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection