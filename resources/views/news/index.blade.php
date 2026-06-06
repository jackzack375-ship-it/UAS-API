{{-- ============================================================ --}}
{{-- FILE: resources/views/news/index.blade.php                 --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Berita Terkini')
@section('content')

<div class="space-y-8">
    <div>
        <div class="section-label mb-3">Portal Berita</div>
        <h1 class="font-display text-3xl md:text-4xl font-black text-ink-900 dark:text-ink-50">Berita Terkini</h1>
        <p class="text-sm text-ink-400 mt-2">Berita terpercaya dari sumber-sumber terverifikasi</p>
    </div>

    {{-- Category Filter --}}
    <div class="flex flex-wrap gap-2">
        @foreach($categories as $cat)
        <a href="?category={{ $cat }}"
           class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200"
           style="{{ request('category') == $cat
               ? 'background: linear-gradient(135deg, #D4AF37, #F0D060); color: #0D0D0D; font-weight: 700;'
               : 'background: rgba(0,0,0,0.04); color: #555555; border: 1px solid rgba(0,0,0,0.08);' }}">
            {{ ucfirst($cat) }}
        </a>
        @endforeach
    </div>

    {{-- News Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($articles as $article)
        <div class="card overflow-hidden flex flex-col group">
            {{-- Image --}}
            @if($article['urlToImage'])
                <div class="relative overflow-hidden" style="height: 200px;">
                    <img src="{{ $article['urlToImage'] }}" alt="{{ $article['title'] }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.3), transparent);"></div>
                </div>
            @else
                <div class="flex items-center justify-center" style="height: 200px; background: linear-gradient(135deg, #1A1A1A, #2A2A2A);">
                    <div class="font-display font-bold text-lg opacity-30" style="color: #D4AF37;">HoaxChecker</div>
                </div>
            @endif

            <div class="p-5 flex-1 flex flex-col">
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-xs font-semibold text-ink-400">{{ $article['source']['name'] }}</span>
                    <span class="w-1 h-1 rounded-full bg-ink-300"></span>
                    <span class="text-xs text-ink-400">{{ \Carbon\Carbon::parse($article['publishedAt'])->format('d M Y') }}</span>
                </div>
                <h2 class="font-display font-bold text-base text-ink-900 dark:text-ink-50 line-clamp-2 mb-2 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-colors">
                    {{ $article['title'] }}
                </h2>
                <p class="text-sm text-ink-500 dark:text-ink-400 line-clamp-3 leading-relaxed flex-1">{{ $article['description'] }}</p>
                <a href="{{ $article['url'] }}" target="_blank" rel="noopener noreferrer"
                   class="flex items-center gap-1.5 text-sm font-semibold mt-4 transition-colors pt-4 border-t"
                   style="color: var(--gold); border-color: rgba(0,0,0,0.05);">
                    Baca Selengkapnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            </div>
        </div>
        @empty
            <div class="col-span-3 card p-16 text-center">
                <div class="text-4xl mb-4">📰</div>
                <p class="font-semibold text-ink-700 dark:text-ink-200">Tidak ada berita</p>
                <p class="text-sm text-ink-400 mt-1">Tidak ada berita untuk kategori ini.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection