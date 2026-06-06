{{-- ============================================================ --}}
{{-- FILE: resources/views/education/index.blade.php            --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Edukasi Literasi Digital')
@section('content')

<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <div class="section-label mb-3">Pusat Edukasi</div>
            <h1 class="font-display text-3xl md:text-4xl font-black text-ink-900 dark:text-ink-50">Edukasi Literasi Digital</h1>
            <p class="text-sm text-ink-400 mt-2">Tingkatkan kemampuan kritis Anda dalam membaca dan memverifikasi informasi</p>
        </div>
        <a href="{{ route('education.videos') }}"
           class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all hover:-translate-y-0.5"
           style="background: rgba(239,68,68,0.12); color: #EF4444; border: 1px solid rgba(239,68,68,0.25);">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0C.488 3.45.029 5.804 0 12c.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0C23.512 20.55 23.971 18.196 24 12c-.029-6.185-.484-8.549-4.385-8.816zM9 16V8l8 4-8 4z"/>
            </svg>
            Video Edukasi
        </a>
    </div>

    {{-- Grid Artikel --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($educations as $edu)
        <div class="card overflow-hidden flex flex-col group">
            {{-- Color accent top --}}
            <div class="h-1" style="background: linear-gradient(90deg, #D4AF37, #F0D060);"></div>
            <div class="p-6 flex-1 flex flex-col">
                <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full mb-4 self-start"
                      style="background: rgba(212,175,55,0.12); color: #B45309; border: 1px solid rgba(212,175,55,0.25);">
                    {{ $edu->category }}
                </span>
                <h2 class="font-display font-bold text-lg text-ink-900 dark:text-ink-50 mb-3 line-clamp-2 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-colors duration-200">
                    {{ $edu->title }}
                </h2>
                <p class="text-sm text-ink-500 dark:text-ink-400 leading-relaxed line-clamp-3 flex-1">
                    {{ Str::limit(strip_tags($edu->content), 120) }}
                </p>
            </div>
            <div class="px-6 pb-5 flex justify-between items-center border-t pt-4" style="border-color: rgba(0,0,0,0.05);">
                <div class="flex items-center gap-1.5 text-xs text-ink-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    {{ number_format($edu->views) }} views
                </div>
                <a href="{{ route('education.show', $edu->id) }}"
                   class="flex items-center gap-1 text-sm font-semibold transition-colors duration-200"
                   style="color: var(--gold);">
                    Baca Artikel
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div>{{ $educations->links() }}</div>
</div>

@endsection