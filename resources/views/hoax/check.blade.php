@extends('layouts.app')
@section('title', 'Cek Hoaks - HoaxChecker Indonesia')
@section('content')

<div class="max-w-3xl mx-auto">

    {{-- ===== HEADER ===== --}}
    <div class="text-center mb-10">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-5"
             style="background: rgba(212,175,55,0.12); color: var(--gold); border: 1px solid rgba(212,175,55,0.25);">
            ✦ Verifikasi Berita
        </div>
        <h1 class="font-display text-4xl md:text-5xl font-black text-ink-900 dark:text-ink-50 mb-4">
            Cek <span class="text-gradient">Hoaks</span> Sekarang
        </h1>
        <p class="text-ink-500 dark:text-ink-400 max-w-lg mx-auto leading-relaxed">
            Masukkan judul dan isi berita yang ingin Anda verifikasi. AI Groq kami akan menganalisis dalam hitungan detik.
        </p>
    </div>

    {{-- ===== FORM CARD ===== --}}
    <div class="card rounded-2xl overflow-hidden mb-8" style="border: 1px solid rgba(212,175,55,0.15);">
        <div class="h-1" style="background: linear-gradient(90deg, #D4AF37, #F0D060);"></div>

        <div class="p-8">

            {{-- ERROR MESSAGES --}}
            @if($errors->any())
            <div class="mb-6 p-4 rounded-xl" style="background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.25);">
                <p class="text-sm font-semibold text-red-600 dark:text-red-400 mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                    Harap perbaiki kesalahan berikut:
                </p>
                @foreach($errors->all() as $error)
                    <p class="text-xs text-red-600 dark:text-red-400 ml-6">• {{ $error }}</p>
                @endforeach
            </div>
            @endif

            {{--
                =====================================================
                FIX UTAMA:
                1. action → route('hoax.analyze')  [POST /cek-hoaks]
                2. Ada field 'title' (required di controller)
                3. Field 'content' jadi opsional sesuai controller
                =====================================================
            --}}
            <form method="POST" action="{{ route('hoax.analyze') }}" id="hoaxForm">
                @csrf

                {{-- ① JUDUL BERITA — required oleh controller --}}
                <div class="mb-5">
                    <label for="title" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">
                        Judul Berita <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-ink-400 pointer-events-none">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
                            required
                            maxlength="255"
                            placeholder="Masukkan judul berita yang ingin dicek..."
                            class="gold-input w-full pl-11 pr-4 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 focus:outline-none transition-all duration-200"
                        />
                    </div>
                    @error('title')
                        <p class="mt-1.5 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ② ISI BERITA — nullable di controller --}}
                <div class="mb-5">
                    <label for="content" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">
                        Isi Berita / Klaim
                        <span class="font-normal text-ink-400">(opsional, tapi disarankan untuk hasil lebih akurat)</span>
                    </label>
                    <div class="relative">
                        <textarea
                            name="content"
                            id="content"
                            rows="6"
                            placeholder="Tempel isi lengkap berita di sini untuk analisis yang lebih akurat..."
                            class="gold-input w-full px-4 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 focus:outline-none transition-all duration-200 resize-none leading-relaxed"
                            oninput="updateCharCount()"
                        >{{ old('content') }}</textarea>
                        <div class="absolute bottom-3 right-4 text-xs font-mono text-ink-400" id="charCount">0 karakter</div>
                    </div>
                    @error('content')
                        <p class="mt-1.5 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ③ URL SUMBER — nullable di controller --}}
                <div class="mb-6">
                    <label for="url" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">
                        URL Sumber <span class="font-normal text-ink-400">(opsional)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-ink-400 pointer-events-none">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </div>
                        <input
                            type="url"
                            name="url"
                            id="url"
                            value="{{ old('url') }}"
                            placeholder="https://contoh-berita.com/artikel"
                            class="gold-input w-full pl-11 pr-4 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 focus:outline-none transition-all duration-200"
                        />
                    </div>
                    @error('url')
                        <p class="mt-1.5 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- KATEGORI --}}
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-3">Kategori Berita</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Semua', 'Politik', 'Kesehatan', 'Teknologi', 'Bencana', 'Sosial', 'Ekonomi'] as $cat)
                        <label class="cursor-pointer">
                            <input type="radio" name="category" value="{{ $cat }}" class="sr-only peer" {{ $cat === 'Semua' ? 'checked' : '' }}>
                            <span class="category-chip inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200 cursor-pointer peer-checked:text-ink-900"
                                  style="border: 1.5px solid rgba(0,0,0,0.10); background: transparent; color: #555555;">
                                {{ $cat }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- SUBMIT --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" id="submitBtn" class="btn-primary flex-1 py-3.5 text-base">
                        <svg id="btnIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span id="btnText">Analisis Sekarang</span>
                    </button>
                    <button type="reset" class="btn-secondary px-6 py-3.5"
                            onclick="document.getElementById('charCount').textContent='0 karakter'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== CARA PAKAI ===== --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach([
            ['1', 'Isi Judul', 'Masukkan judul berita yang ingin dicek kebenarannya.', '📝'],
            ['2', 'Analisis AI', 'AI Groq memproses dan menganalisis konten secara mendalam.', '🤖'],
            ['3', 'Lihat Hasil', 'Halaman hasil menampilkan verdict, skor, dan ringkasan AI.', '✅'],
        ] as [$num, $title, $desc, $icon])
        <div class="card p-5 rounded-xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-black text-ink-900"
                     style="background: linear-gradient(135deg, #D4AF37, #F0D060);">{{ $num }}</div>
                <span class="text-xl">{{ $icon }}</span>
            </div>
            <h4 class="font-bold text-ink-800 dark:text-ink-200 mb-1 text-sm">{{ $title }}</h4>
            <p class="text-xs text-ink-500 dark:text-ink-400 leading-relaxed">{{ $desc }}</p>
        </div>
        @endforeach
    </div>

</div>

<style>
.gold-input {
    background: rgba(0,0,0,0.03);
    border: 1.5px solid rgba(0,0,0,0.10);
    color: inherit;
}
.gold-input:focus {
    border-color: #D4AF37;
    background: rgba(212,175,55,0.04);
    box-shadow: 0 0 0 3px rgba(212,175,55,0.10);
}
.dark .gold-input {
    background: rgba(255,255,255,0.04);
    border-color: rgba(255,255,255,0.10);
    color: #EEEEDD;
}
.dark .gold-input:focus {
    border-color: #D4AF37;
    background: rgba(212,175,55,0.06);
    box-shadow: 0 0 0 3px rgba(212,175,55,0.12);
}
.dark .gold-input::placeholder { color: #888888; }

input[type="radio"].sr-only:checked + .category-chip {
    background: linear-gradient(135deg, #D4AF37, #F0D060) !important;
    border-color: #D4AF37 !important;
    color: #0D0D0D !important;
    font-weight: 700;
}
.category-chip:hover {
    border-color: #D4AF37 !important;
    color: #D4AF37 !important;
}
</style>

<script>
function updateCharCount() {
    const len = document.getElementById('content').value.length;
    document.getElementById('charCount').textContent = len.toLocaleString() + ' karakter';
}

document.getElementById('hoaxForm').addEventListener('submit', function() {
    const btn  = document.getElementById('submitBtn');
    const icon = document.getElementById('btnIcon');
    const txt  = document.getElementById('btnText');
    btn.disabled = true;
    btn.style.opacity = '0.85';
    txt.textContent = 'Sedang Menganalisis...';
    icon.innerHTML = `
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
              style="animation: spin 1s linear infinite; transform-origin: center;"/>
    `;
});
</script>

@endsection