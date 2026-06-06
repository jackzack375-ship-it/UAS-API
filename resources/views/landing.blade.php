@extends('layouts.app')
@section('title', 'HoaxChecker Indonesia — Verifikasi Berita dengan AI')
@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="relative min-h-[88vh] flex items-center -mt-10 md:-mt-14 pt-10">
    {{-- Background pattern --}}
    <div class="absolute inset-0 -z-10 pattern-dots opacity-60"></div>
    {{-- Gold accent line --}}
    <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, #D4AF37, transparent);"></div>

    <div class="w-full max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Left: Text Content --}}
            <div>
                <div class="section-label anim-up anim-up-1">✦ Teknologi AI Terdepan</div>

                <h1 class="font-display text-5xl md:text-7xl font-black mt-6 mb-6 leading-tight anim-up anim-up-2">
                    <span class="text-gradient">Lawan Hoaks.</span><br>
                    <span class="text-ink-900 dark:text-ink-50">Lindungi</span><br>
                    <span class="text-ink-900 dark:text-ink-50">Kebenaran.</span>
                </h1>

                <p class="text-lg text-ink-500 dark:text-ink-400 max-w-lg leading-relaxed mb-10 anim-up anim-up-3">
                    Platform verifikasi berita berbasis AI yang membantu Anda mendeteksi hoaks, clickbait, dan misinformasi dengan akurasi tinggi — secara gratis, untuk semua.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 mb-14 anim-up anim-up-4">
                    <a href="{{ route('hoax.check') }}" class="btn-primary text-base">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cek Berita Sekarang
                    </a>
                    <a href="{{ route('education.index') }}" class="btn-secondary text-base">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Pelajari Lebih Lanjut
                    </a>
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-6 anim-up" style="animation-delay: 0.5s;">
                    @foreach([['15K+', 'Berita Dianalisis', 'text-gradient'], ['92%', 'Akurasi Deteksi', 'text-gradient-blue'], ['8K+', 'Pengguna Aktif', 'text-gradient-danger']] as [$num, $label, $class])
                    <div>
                        <div class="stat-number text-3xl md:text-4xl {{ $class }}">{{ $num }}</div>
                        <p class="text-xs text-ink-400 mt-1 font-medium">{{ $label }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Visual Card --}}
            <div class="hidden lg:block anim-up" style="animation-delay: 0.3s;">
                <div class="relative">
                    {{-- Main card --}}
                    <div class="card-premium p-8 relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <p class="text-xs font-mono" style="color: var(--gold); letter-spacing: 0.1em;">ANALISIS SELESAI</p>
                                <h3 class="text-white font-display font-bold text-xl mt-1">Hasil Verifikasi</h3>
                            </div>
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: rgba(16,185,129,0.2); border: 1px solid rgba(16,185,129,0.4);">
                                <svg class="w-5 h-5" style="color: #10B981;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                </svg>
                            </div>
                        </div>

                        <div class="space-y-3 mb-6">
                            @foreach([['Sumber terverifikasi', true], ['Tidak ada manipulasi gambar', true], ['Konteks sesuai fakta', true], ['Tidak ada clickbait terdeteksi', true]] as [$text, $pass])
                            <div class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0"
                                     style="background: {{ $pass ? 'rgba(16,185,129,0.2)' : 'rgba(239,68,68,0.2)' }};">
                                    <div class="w-2 h-2 rounded-full" style="background: {{ $pass ? '#10B981' : '#EF4444' }};"></div>
                                </div>
                                <span class="text-sm text-ink-200">{{ $text }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="pt-5 border-t" style="border-color: rgba(255,255,255,0.1);">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs text-ink-400 font-medium">Skor Kepercayaan</span>
                                <span class="text-lg font-bold font-mono" style="color: #10B981;">94%</span>
                            </div>
                            <div class="h-2 rounded-full" style="background: rgba(255,255,255,0.1);">
                                <div class="h-2 rounded-full" style="width: 94%; background: linear-gradient(90deg, #10B981, #34D399);"></div>
                            </div>
                            <p class="text-xs text-ink-400 mt-2 text-right">Status: <span style="color: #10B981;" class="font-semibold">BERITA VALID</span></p>
                        </div>
                    </div>

                    {{-- Floating badges --}}
                    <div class="absolute -top-6 -right-6 card px-4 py-3 shadow-xl z-20">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            <span class="text-sm font-semibold text-ink-800 dark:text-ink-100">AI Aktif</span>
                        </div>
                    </div>
                    <div class="absolute -bottom-6 -left-6 card px-4 py-3 shadow-xl z-20">
                        <p class="text-xs text-ink-400 mb-0.5">Analisis selesai dalam</p>
                        <p class="font-display font-bold text-ink-900 dark:text-ink-50">1.2 detik</p>
                    </div>

                    {{-- Decorative elements --}}
                    <div class="absolute top-1/2 -right-3 w-6 h-24 rounded-full opacity-40" style="background: linear-gradient(180deg, #D4AF37, transparent);"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== SCROLLING TICKER ===== --}}
<div class="relative overflow-hidden py-4 border-y" style="border-color: rgba(0,0,0,0.06); margin: 0 -2rem;">
    <div class="absolute left-0 top-0 bottom-0 w-16 z-10" style="background: linear-gradient(90deg, #F8F8F7, transparent);"></div>
    <div class="absolute right-0 top-0 bottom-0 w-16 z-10" style="background: linear-gradient(-90deg, #F8F8F7, transparent);"></div>
    <div class="dark:hidden"></div>
    <div class="flex gap-12 whitespace-nowrap" style="animation: ticker 30s linear infinite;">
        @foreach(['🛡️ Lawan Hoaks', '✦ 92% Akurasi AI', '🔍 Verifikasi Instan', '📚 Edukasi Digital', '🏆 8K+ Pengguna', '⚡ Real-time Analysis', '🤖 AI Canggih', '🌟 Gratis Selamanya'] as $item)
            <span class="text-sm font-medium text-ink-400 dark:text-ink-500 shrink-0">{{ $item }}</span>
        @endforeach
        @foreach(['🛡️ Lawan Hoaks', '✦ 92% Akurasi AI', '🔍 Verifikasi Instan', '📚 Edukasi Digital', '🏆 8K+ Pengguna', '⚡ Real-time Analysis', '🤖 AI Canggih', '🌟 Gratis Selamanya'] as $item)
            <span class="text-sm font-medium text-ink-400 dark:text-ink-500 shrink-0">{{ $item }}</span>
        @endforeach
    </div>
</div>

{{-- ===== FEATURES ===== --}}
<section class="py-24 md:py-32">
    <div class="text-center mb-16">
        <div class="section-label">Fitur Platform</div>
        <h2 class="font-display text-4xl md:text-5xl font-black mt-5 mb-4 text-ink-900 dark:text-ink-50">
            Senjata Melawan<br><span class="text-gradient">Misinformasi</span>
        </h2>
        <p class="text-ink-500 dark:text-ink-400 max-w-xl mx-auto">Dilengkapi teknologi AI terdepan untuk pengalaman verifikasi berita terbaik dan terpercaya</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php $features = [
            ['icon' => '🤖', 'title' => 'AI Canggih', 'desc' => 'Analisis otomatis menggunakan model machine learning terkini dengan akurasi 92%.', 'color' => '#3B82F6'],
            ['icon' => '⚡', 'title' => 'Real-Time', 'desc' => 'Hasil verifikasi instan dalam hitungan detik. Tidak perlu menunggu lama.', 'color' => '#D4AF37'],
            ['icon' => '📚', 'title' => 'Edukasi Digital', 'desc' => 'Artikel, video, dan tips literasi digital untuk meningkatkan kemampuan kritis Anda.', 'color' => '#10B981'],
            ['icon' => '📰', 'title' => 'Berita Terkini', 'desc' => 'Akses berita dari ratusan sumber terpercaya yang telah dikurasi oleh tim ahli.', 'color' => '#8B5CF6'],
            ['icon' => '🏆', 'title' => 'Gamifikasi', 'desc' => 'Kumpulkan badge dan naik level. Jadilah pahlawan kebenaran digital.', 'color' => '#F59E0B'],
            ['icon' => '🛡️', 'title' => 'Komunitas', 'desc' => 'Bergabung dengan komunitas verifikator profesional yang peduli kebenaran.', 'color' => '#EF4444'],
        ]; @endphp

        @foreach($features as $f)
        <div class="card p-7 group">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl mb-5 transition-transform duration-300 group-hover:scale-110"
                 style="background: {{ $f['color'] }}18; border: 1px solid {{ $f['color'] }}30;">
                {{ $f['icon'] }}
            </div>
            <h3 class="font-display font-bold text-lg text-ink-900 dark:text-ink-50 mb-2">{{ $f['title'] }}</h3>
            <p class="text-sm text-ink-500 dark:text-ink-400 leading-relaxed">{{ $f['desc'] }}</p>
            <div class="mt-4 h-0.5 w-0 group-hover:w-full transition-all duration-500 rounded-full" style="background: linear-gradient(90deg, {{ $f['color'] }}, transparent);"></div>
        </div>
        @endforeach
    </div>
</section>

{{-- ===== HOW IT WORKS ===== --}}
<section class="py-24 md:py-32 relative">
    <div class="absolute inset-0 -z-10 rounded-3xl" style="background: linear-gradient(135deg, #0D0D0D 0%, #1A1A1A 100%);"></div>
    <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, rgba(212,175,55,0.5), transparent);"></div>
    <div class="absolute bottom-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, rgba(212,175,55,0.5), transparent);"></div>

    <div class="text-center mb-16">
        <div class="section-label">Proses Mudah</div>
        <h2 class="font-display text-4xl md:text-5xl font-black mt-5 mb-4 text-white">
            Cara Kerjanya
        </h2>
        <p class="text-ink-400 max-w-xl mx-auto">Hanya 3 langkah untuk memverifikasi berita dan mendapat hasil akurat</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto relative">
        {{-- connector line --}}
        <div class="hidden md:block absolute top-12 left-1/3 right-1/3 h-px" style="background: linear-gradient(90deg, transparent, rgba(212,175,55,0.4), transparent);"></div>

        @php $steps = [
            ['num' => '01', 'icon' => '📝', 'title' => 'Masukkan Berita', 'desc' => 'Tempel judul, isi, atau link berita yang ingin Anda verifikasi.'],
            ['num' => '02', 'icon' => '🔬', 'title' => 'AI Menganalisis', 'desc' => 'Algoritma AI menganalisis pola bahasa, sumber, dan fakta secara mendalam.'],
            ['num' => '03', 'icon' => '✅', 'title' => 'Lihat Hasil', 'desc' => 'Dapatkan laporan lengkap dengan skor kepercayaan dan penjelasan detail.'],
        ]; @endphp

        @foreach($steps as $step)
        <div class="text-center group">
            <div class="relative inline-block mb-6">
                <div class="w-24 h-24 rounded-2xl flex items-center justify-center text-4xl mx-auto transition-all duration-300 group-hover:scale-110"
                     style="background: rgba(212,175,55,0.10); border: 1px solid rgba(212,175,55,0.25);">
                    {{ $step['icon'] }}
                </div>
                <div class="absolute -top-3 -right-3 w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold font-mono"
                     style="background: linear-gradient(135deg, #D4AF37, #F0D060); color: #0D0D0D;">
                    {{ $step['num'] }}
                </div>
            </div>
            <h3 class="font-display font-bold text-xl text-white mb-3">{{ $step['title'] }}</h3>
            <p class="text-sm text-ink-400 max-w-xs mx-auto leading-relaxed">{{ $step['desc'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="text-center mt-12">
        <a href="{{ route('hoax.check') }}" class="btn-primary">
            Coba Sekarang — Gratis
        </a>
    </div>
</section>

{{-- ===== TESTIMONIALS ===== --}}
<section class="py-24 md:py-32">
    <div class="text-center mb-16">
        <div class="section-label">Testimoni</div>
        <h2 class="font-display text-4xl md:text-5xl font-black mt-5 mb-4 text-ink-900 dark:text-ink-50">
            Dipercaya <span class="text-gradient">Ribuan</span><br>Pengguna
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @php $testimonials = [
            ['name' => 'Budi Santoso', 'role' => 'Jurnalis Independen', 'comment' => 'HoaxChecker benar-benar membantu saya memverifikasi informasi sebelum menerbitkan artikel. Akurasi AI-nya sangat mengesankan dan menghemat banyak waktu penelitian.', 'initial' => 'BS'],
            ['name' => 'Siti Nurhaliza', 'role' => 'Content Creator', 'comment' => 'Saya gunakan setiap hari sebelum membuat konten. Fitur edukasi digitalnya juga luar biasa — membuat audiens saya lebih kritis terhadap informasi.', 'initial' => 'SN'],
            ['name' => 'Ahmad Wijaya', 'role' => 'Guru SMA', 'comment' => 'Sempurna untuk diajarkan ke siswa. Mereka jadi lebih sadar akan hoaks dan misinformasi. Tool edukasi terbaik yang pernah saya gunakan di kelas.', 'initial' => 'AW'],
        ]; @endphp

        @foreach($testimonials as $t)
        <div class="card p-8">
            {{-- Stars --}}
            <div class="flex gap-1 mb-5">
                @for($i = 0; $i < 5; $i++)
                    <svg class="w-4 h-4 fill-current" style="color: #D4AF37;" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                    </svg>
                @endfor
            </div>
            <p class="text-ink-600 dark:text-ink-300 text-sm leading-relaxed mb-6 italic">
                "{{ $t['comment'] }}"
            </p>
            <div class="flex items-center gap-3 pt-5 border-t" style="border-color: rgba(0,0,0,0.06);">
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold text-ink-900" style="background: linear-gradient(135deg, #D4AF37, #F0D060);">
                    {{ $t['initial'] }}
                </div>
                <div>
                    <p class="font-semibold text-sm text-ink-900 dark:text-ink-50">{{ $t['name'] }}</p>
                    <p class="text-xs text-ink-400">{{ $t['role'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ===== FAQ ===== --}}
<section class="py-24 md:py-28 max-w-3xl mx-auto">
    <div class="text-center mb-12">
        <div class="section-label">FAQ</div>
        <h2 class="font-display text-4xl font-black mt-5 text-ink-900 dark:text-ink-50">Pertanyaan Umum</h2>
    </div>

    <div class="space-y-3">
        @php $faqs = [
            ['q' => 'Apa itu HoaxChecker?', 'a' => 'HoaxChecker adalah platform verifikasi berita berbasis AI yang membantu masyarakat membedakan informasi benar dan hoaks secara cepat dan akurat.'],
            ['q' => 'Apakah hasil analisis selalu akurat?', 'a' => 'Akurasi sistem kami mencapai 92%, namun kami tetap menyarankan pengguna untuk melakukan verifikasi manual pada isu-isu kritis.'],
            ['q' => 'Bagaimana cara melaporkan berita mencurigakan?', 'a' => 'Klik menu "Lapor" di navigasi dan isi formulir singkat. Tim verifikator profesional kami akan meninjau laporan dalam 24 jam.'],
            ['q' => 'Apakah HoaxChecker gratis?', 'a' => 'Ya! HoaxChecker 100% gratis untuk seluruh masyarakat Indonesia. Kami berkomitmen untuk terus menyediakan layanan ini secara bebas biaya.'],
        ]; @endphp

        @foreach($faqs as $faq)
        <div x-data="{ open: false }" class="card overflow-hidden">
            <button @click="open = !open"
                    class="w-full flex justify-between items-center p-6 text-left font-semibold text-ink-800 dark:text-ink-100 hover:bg-black/02 dark:hover:bg-white/03 transition-colors">
                <span>{{ $faq['q'] }}</span>
                <svg :class="open && 'rotate-180'" class="w-5 h-5 text-ink-400 flex-shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-transition class="px-6 pb-6 text-sm text-ink-500 dark:text-ink-400 leading-relaxed border-t" style="border-color: rgba(0,0,0,0.06);">
                <p class="pt-4">{{ $faq['a'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ===== PARTNERS ===== --}}
<section class="py-20 border-y" style="border-color: rgba(0,0,0,0.06);">
    <p class="text-center text-xs font-bold uppercase tracking-widest text-ink-400 mb-10">Dipercaya & Berkolaborasi Dengan</p>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
        @foreach([['Kominfo', '🏛️'], ['Cyber Lab', '🧪'], ['Media Watch', '📡'], ['EduTech Foundation', '🎓']] as [$name, $icon])
        <div class="card p-5 text-center group hover:border-yellow-300 dark:hover:border-yellow-600">
            <div class="text-3xl mb-2 transition-transform duration-300 group-hover:scale-110">{{ $icon }}</div>
            <p class="text-sm font-semibold text-ink-700 dark:text-ink-300">{{ $name }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ===== CTA ===== --}}
<section class="py-24 md:py-32">
    <div class="relative rounded-3xl overflow-hidden p-16 text-center" style="background: linear-gradient(135deg, #0D0D0D 0%, #1A1A1A 100%);">
        <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, #D4AF37, transparent);"></div>
        <div class="absolute -top-px left-1/4 right-1/4 h-px" style="background: #D4AF37;"></div>

        <div class="section-label mb-6">Mulai Sekarang</div>
        <h2 class="font-display text-4xl md:text-5xl font-black text-white mb-5">
            Siap Melawan Hoaks<br>bersama Kami?
        </h2>
        <p class="text-ink-400 max-w-xl mx-auto mb-10">
            Bergabunglah dengan ribuan pengguna yang telah meningkatkan literasi digital mereka. Gratis, mudah, dan efektif.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('hoax.check') }}" class="btn-primary text-base px-8 py-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Mulai Cek Sekarang
            </a>
            <a href="{{ route('register') }}" class="btn-secondary text-base px-8 py-4" style="color: white; border-color: rgba(255,255,255,0.2);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                Daftar Gratis
            </a>
        </div>

        {{-- decorative corners --}}
        <div class="absolute bottom-6 left-6 w-12 h-12 rounded-full border opacity-20" style="border-color: #D4AF37;"></div>
        <div class="absolute top-6 right-6 w-6 h-6 rounded-full border opacity-20" style="border-color: #D4AF37;"></div>
    </div>
</section>

{{-- ===== REPORT CTA ===== --}}
<section class="mb-10">
    <div class="relative rounded-2xl overflow-hidden p-10 text-center border" style="border-color: rgba(239,68,68,0.25); background: rgba(239,68,68,0.04);">
        <h2 class="font-display text-2xl md:text-3xl font-black text-ink-900 dark:text-ink-50 mb-3">
            Temukan Berita Mencurigakan?
        </h2>
        <p class="text-ink-500 dark:text-ink-400 max-w-md mx-auto mb-6 text-sm">
            Laporkan langsung ke tim verifikator kami. Setiap laporan membantu melawan misinformasi di Indonesia.
        </p>
        <a href="{{ route('report.create') }}" class="btn-danger">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
            Laporkan Berita Sekarang
        </a>
    </div>
</section>

<style>
@keyframes ticker { from { transform: translateX(0); } to { transform: translateX(-50%); } }
</style>

@endsection