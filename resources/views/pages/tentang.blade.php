@extends('layouts.app')
@section('title', 'Tentang Kami - HoaxChecker Indonesia')
@section('content')

<div class="relative">

    {{-- ===== HERO ===== --}}
    <div class="text-center mb-20 relative">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-6"
             style="background: rgba(212,175,55,0.12); color: var(--gold); border: 1px solid rgba(212,175,55,0.25);">
            ✦ Tentang Kami
        </div>
        <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-black text-ink-900 dark:text-ink-50 leading-none mb-6">
            Kami Melawan<br>
            <span class="text-gradient">Misinformasi</span>
        </h1>
        <p class="text-lg text-ink-500 dark:text-ink-400 max-w-2xl mx-auto leading-relaxed">
            HoaxChecker Indonesia lahir dari keprihatinan terhadap maraknya hoaks yang meresahkan masyarakat. 
            Kami membangun platform berbasis AI untuk membantu Indonesia lebih cerdas dalam menyaring informasi.
        </p>
    </div>

    {{-- ===== STATS ===== --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-20">
        @foreach([
            ['10K+', 'Berita Dicek', '🔍'],
            ['98%', 'Akurasi AI', '🤖'],
            ['50K+', 'Pengguna Aktif', '👥'],
            ['2024', 'Tahun Berdiri', '📅'],
        ] as [$num, $label, $icon])
        <div class="card p-6 text-center">
            <div class="text-3xl mb-2">{{ $icon }}</div>
            <div class="font-display text-3xl font-black text-ink-900 dark:text-ink-50 mb-1">{{ $num }}</div>
            <div class="text-sm text-ink-500 dark:text-ink-400 font-medium">{{ $label }}</div>
        </div>
        @endforeach
    </div>

    {{-- ===== MISI & VISI ===== --}}
    <div class="grid md:grid-cols-2 gap-6 mb-20">
        <div class="card-premium p-8 rounded-2xl">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5 text-2xl"
                 style="background: rgba(212,175,55,0.15); border: 1px solid rgba(212,175,55,0.3);">🎯</div>
            <h3 class="font-display text-2xl font-bold text-ink-50 mb-3">Visi</h3>
            <p class="text-ink-400 leading-relaxed">
                Menjadi platform verifikasi berita terpercaya di Indonesia yang memberdayakan masyarakat untuk 
                membedakan fakta dari hoaks, demi terciptanya ruang digital yang sehat dan bertanggung jawab.
            </p>
        </div>
        <div class="card p-8">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5 text-2xl"
                 style="background: rgba(212,175,55,0.08); border: 1px solid rgba(212,175,55,0.2);">🚀</div>
            <h3 class="font-display text-2xl font-bold text-ink-900 dark:text-ink-50 mb-3">Misi</h3>
            <ul class="text-ink-500 dark:text-ink-400 space-y-2.5 leading-relaxed">
                <li class="flex items-start gap-2">
                    <span style="color: var(--gold);">✦</span>
                    Menyediakan alat verifikasi berita berbasis AI yang akurat dan cepat
                </li>
                <li class="flex items-start gap-2">
                    <span style="color: var(--gold);">✦</span>
                    Meningkatkan literasi digital masyarakat Indonesia
                </li>
                <li class="flex items-start gap-2">
                    <span style="color: var(--gold);">✦</span>
                    Membangun ekosistem informasi yang transparan dan terpercaya
                </li>
            </ul>
        </div>
    </div>

    {{-- ===== TIM KAMI ===== --}}
    <div class="mb-20">
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-4"
                 style="background: rgba(212,175,55,0.12); color: var(--gold); border: 1px solid rgba(212,175,55,0.25);">
                ✦ Tim Pengembang
            </div>
            <h2 class="font-display text-4xl md:text-5xl font-black text-ink-900 dark:text-ink-50">
                Orang-Orang di Balik<br><span class="text-gradient">HoaxChecker</span>
            </h2>
            <p class="mt-4 text-ink-500 dark:text-ink-400 max-w-xl mx-auto">
                Dikembangkan dengan penuh semangat oleh tim mahasiswa yang peduli akan kebenaran informasi.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Anggota 1 --}}
            <div class="team-card card rounded-2xl overflow-hidden group">
                {{-- Foto --}}
                <div class="relative h-64 overflow-hidden bg-gradient-to-br from-amber-50 to-yellow-100 dark:from-ink-800 dark:to-ink-700">
                    {{-- Ganti src dengan path foto sebenarnya, misalnya: asset('images/team/anggota1.jpg') --}}
                    <img 
                        src="{{ asset('images/team/anggota1.jpg') }}" 
                        alt="Foto Anggota 1"
                        class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                    />
                    {{-- Fallback avatar jika foto tidak tersedia --}}
                    <div class="absolute inset-0 items-center justify-center" style="display:none;">
                        <div class="w-28 h-28 rounded-full flex items-center justify-center text-5xl font-black text-ink-900"
                             style="background: linear-gradient(135deg, #D4AF37, #F0D060);">
                            A
                        </div>
                    </div>
                    {{-- Gold accent bar --}}
                    <div class="absolute bottom-0 left-0 right-0 h-1" style="background: linear-gradient(90deg, #D4AF37, #F0D060);"></div>
                </div>

                {{-- Info --}}
                <div class="p-6">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold mb-3"
                         style="background: rgba(212,175,55,0.12); color: var(--gold); border: 1px solid rgba(212,175,55,0.25);">
                        👑 Ketua Tim
                    </div>
                    <h3 class="font-display text-xl font-bold text-ink-900 dark:text-ink-50 mb-1">
                        Nama Anggota Satu
                    </h3>
                    <p class="text-sm font-mono font-semibold mb-3" style="color: var(--gold);">
                        NIM: 123456789
                    </p>
                    <p class="text-sm text-ink-500 dark:text-ink-400 leading-relaxed">
                        Bertanggung jawab atas arsitektur sistem dan pengembangan backend API.
                    </p>
                    {{-- Social links --}}
                    <div class="flex gap-2 mt-4">
                        <a href="#" class="w-8 h-8 rounded-lg border flex items-center justify-center text-ink-400 hover:text-yellow-600 hover:border-yellow-500 transition-all"
                           style="border-color: rgba(0,0,0,0.12);">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg border flex items-center justify-center text-ink-400 hover:text-yellow-600 hover:border-yellow-500 transition-all"
                           style="border-color: rgba(0,0,0,0.12);">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Anggota 2 --}}
            <div class="team-card card rounded-2xl overflow-hidden group">
                <div class="relative h-64 overflow-hidden bg-gradient-to-br from-amber-50 to-yellow-100 dark:from-ink-800 dark:to-ink-700">
                    <img 
                        src="{{ asset('images/team/anggota2.jpg') }}" 
                        alt="Foto Anggota 2"
                        class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                    />
                    <div class="absolute inset-0 items-center justify-center" style="display:none;">
                        <div class="w-28 h-28 rounded-full flex items-center justify-center text-5xl font-black text-ink-900"
                             style="background: linear-gradient(135deg, #D4AF37, #F0D060);">
                            B
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1" style="background: linear-gradient(90deg, #D4AF37, #F0D060);"></div>
                </div>

                <div class="p-6">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold mb-3"
                         style="background: rgba(59,130,246,0.10); color: #3B82F6; border: 1px solid rgba(59,130,246,0.25);">
                        🎨 Frontend Developer
                    </div>
                    <h3 class="font-display text-xl font-bold text-ink-900 dark:text-ink-50 mb-1">
                        Nama Anggota Dua
                    </h3>
                    <p class="text-sm font-mono font-semibold mb-3" style="color: var(--gold);">
                        NIM: 987654321
                    </p>
                    <p class="text-sm text-ink-500 dark:text-ink-400 leading-relaxed">
                        Bertanggung jawab atas desain UI/UX dan implementasi antarmuka pengguna yang responsif.
                    </p>
                    <div class="flex gap-2 mt-4">
                        <a href="#" class="w-8 h-8 rounded-lg border flex items-center justify-center text-ink-400 hover:text-yellow-600 hover:border-yellow-500 transition-all"
                           style="border-color: rgba(0,0,0,0.12);">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg border flex items-center justify-center text-ink-400 hover:text-yellow-600 hover:border-yellow-500 transition-all"
                           style="border-color: rgba(0,0,0,0.12);">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Anggota 3 --}}
            <div class="team-card card rounded-2xl overflow-hidden group">
                <div class="relative h-64 overflow-hidden bg-gradient-to-br from-amber-50 to-yellow-100 dark:from-ink-800 dark:to-ink-700">
                    <img 
                        src="{{ asset('images/team/anggota3.jpg') }}" 
                        alt="Foto Anggota 3"
                        class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                    />
                    <div class="absolute inset-0 items-center justify-center" style="display:none;">
                        <div class="w-28 h-28 rounded-full flex items-center justify-center text-5xl font-black text-ink-900"
                             style="background: linear-gradient(135deg, #D4AF37, #F0D060);">
                            C
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1" style="background: linear-gradient(90deg, #D4AF37, #F0D060);"></div>
                </div>

                <div class="p-6">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold mb-3"
                         style="background: rgba(16,185,129,0.10); color: #059669; border: 1px solid rgba(16,185,129,0.25);">
                        🤖 AI Engineer
                    </div>
                    <h3 class="font-display text-xl font-bold text-ink-900 dark:text-ink-50 mb-1">
                        Nama Anggota Tiga
                    </h3>
                    <p class="text-sm font-mono font-semibold mb-3" style="color: var(--gold);">
                        NIM: 112233445
                    </p>
                    <p class="text-sm text-ink-500 dark:text-ink-400 leading-relaxed">
                        Bertanggung jawab atas integrasi model AI dan pengembangan algoritma deteksi hoaks.
                    </p>
                    <div class="flex gap-2 mt-4">
                        <a href="#" class="w-8 h-8 rounded-lg border flex items-center justify-center text-ink-400 hover:text-yellow-600 hover:border-yellow-500 transition-all"
                           style="border-color: rgba(0,0,0,0.12);">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg border flex items-center justify-center text-ink-400 hover:text-yellow-600 hover:border-yellow-500 transition-all"
                           style="border-color: rgba(0,0,0,0.12);">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ===== TEKNOLOGI ===== --}}
    <div class="card-premium p-10 rounded-2xl text-center mb-20">
        <h2 class="font-display text-3xl font-bold text-ink-50 mb-4">Dibangun dengan Teknologi Terbaik</h2>
        <p class="text-ink-400 mb-8 max-w-xl mx-auto">Stack teknologi modern yang kami gunakan untuk membangun pengalaman terbaik.</p>
        <div class="flex flex-wrap justify-center gap-3">
            @foreach(['Laravel 11', 'PHP 8.3', 'Tailwind CSS', 'Alpine.js', 'OpenAI API', 'MySQL', 'Vite'] as $tech)
            <span class="px-4 py-2 rounded-full text-sm font-semibold"
                  style="background: rgba(212,175,55,0.12); color: var(--gold); border: 1px solid rgba(212,175,55,0.25);">
                {{ $tech }}
            </span>
            @endforeach
        </div>
    </div>

</div>

@endsection