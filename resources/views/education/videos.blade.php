{{-- ============================================================ --}}
{{-- FILE: resources/views/education/videos.blade.php           --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Video Edukasi')
@section('content')

<div class="space-y-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <div class="section-label mb-3">Video Learning</div>
            <h1 class="font-display text-3xl md:text-4xl font-black text-ink-900 dark:text-ink-50">Video Edukasi Literasi Digital</h1>
            <p class="text-sm text-ink-400 mt-2">Pelajari cara mendeteksi hoaks melalui video-video edukatif pilihan</p>
        </div>
        <a href="{{ route('education.index') }}" class="btn-secondary text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
            Artikel Edukasi
        </a>
    </div>

    {{-- Search --}}
    <form action="{{ route('education.videos') }}" method="GET">
        <div class="flex gap-3">
            <div class="relative flex-1">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-ink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="q" value="{{ $query }}"
                       placeholder="Cari video edukasi literasi digital..."
                       class="w-full pl-12 pr-4 py-3.5 rounded-xl border text-sm dark:bg-ink-800 dark:text-ink-100 dark:placeholder-ink-500 focus:outline-none transition-all"
                       style="border-color: rgba(0,0,0,0.12);"
                       onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
                       onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">
            </div>
            <button type="submit" class="btn-primary px-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Cari
            </button>
        </div>
    </form>

    {{-- Grid Video --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($videos as $video)
            @php
                $videoId = $video['id']['videoId'] ?? $video['id'] ?? null;
                $snippet = $video['snippet'];
            @endphp
            @if($videoId)
            <div class="card overflow-hidden group">
                <div class="relative" style="padding-bottom: 56.25%; height: 0;">
                    <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                            src="https://www.youtube.com/embed/{{ $videoId }}"
                            frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="p-5">
                    <h2 class="font-display font-bold text-base text-ink-900 dark:text-ink-50 mb-2 line-clamp-2 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-colors">
                        {{ $snippet['title'] }}
                    </h2>
                    <p class="text-xs text-ink-400 line-clamp-2 mb-3 leading-relaxed">{{ $snippet['description'] }}</p>
                    <p class="text-xs text-ink-300 font-mono">
                        {{ \Carbon\Carbon::parse($snippet['publishedAt'])->diffForHumans() }}
                    </p>
                </div>
            </div>
            @endif
        @empty
            <div class="col-span-3 card p-16 text-center">
                <div class="text-4xl mb-4">🎬</div>
                <p class="font-semibold text-ink-700 dark:text-ink-200 mb-1">Tidak ada video ditemukan</p>
                <p class="text-sm text-ink-400">Tidak ada video untuk "<span class="font-medium text-ink-600 dark:text-ink-300">{{ $query }}</span>".</p>
            </div>
        @endforelse
    </div>
</div>

@endsection