<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', mobileOpen: false, scrolled: false }"
      :class="darkMode && 'dark'"
      class="scroll-smooth"
      x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'HoaxChecker Indonesia'); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['DM Sans', 'system-ui', 'sans-serif'],
                        display: ['Playfair Display', 'Georgia', 'serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        gold: {
                            50: '#FFFBEB', 100: '#FEF3C7', 200: '#FDE68A',
                            300: '#FCD34D', 400: '#FBBF24', 500: '#F59E0B',
                            600: '#D97706', 700: '#B45309', 800: '#92400E', 900: '#78350F',
                        },
                        ink: {
                            50: '#F8F8F7', 100: '#EEEEDD', 200: '#D3D3C3',
                            300: '#AAAAAA', 400: '#888888', 500: '#555555',
                            600: '#3A3A3A', 700: '#2A2A2A', 800: '#1A1A1A', 900: '#0D0D0D',
                        }
                    }
                }
            }
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* ===== ROOT VARIABLES ===== */
        :root {
            --gold: #D4AF37;
            --gold-light: #F0D060;
            --electric: #3B82F6;
            --danger: #EF4444;
            --success: #10B981;
            --warn: #F59E0B;
        }

        /* ===== GLOBAL ===== */
        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #F8F8F7;
            color: #1A1A1A;
            transition: background 0.3s, color 0.3s;
        }
        .dark body, .dark {
            background: #0D0D0D;
            color: #EEEEDD;
        }

        /* ===== TYPOGRAPHY ===== */
        .font-display { font-family: 'Playfair Display', Georgia, serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        /* ===== GRADIENT TEXT ===== */
        .text-gradient {
            background: linear-gradient(135deg, #D4AF37 0%, #F0D060 40%, #D4AF37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .text-gradient-blue {
            background: linear-gradient(135deg, #3B82F6 0%, #60A5FA 50%, #93C5FD 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .text-gradient-danger {
            background: linear-gradient(135deg, #EF4444 0%, #F87171 50%, #FCA5A5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ===== CARDS ===== */
        .card {
            background: #FFFFFF;
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 16px;
            transition: all 0.35s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .dark .card {
            background: #1A1A1A;
            border-color: rgba(255,255,255,0.08);
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.10);
        }
        .dark .card:hover {
            box-shadow: 0 20px 60px rgba(0,0,0,0.40);
        }

        .card-premium {
            background: linear-gradient(145deg, #1A1A1A 0%, #2A2A2A 100%);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 16px;
            transition: all 0.35s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .card-premium:hover {
            border-color: rgba(212, 175, 55, 0.7);
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(212, 175, 55, 0.15);
        }

        /* ===== GLASS ===== */
        .glass {
            background: rgba(255,255,255,0.80);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.3);
        }
        .dark .glass {
            background: rgba(15,15,15,0.85);
            border-color: rgba(255,255,255,0.08);
        }

        /* ===== NAVIGATION ===== */
        .nav-floating {
            background: rgba(248,248,247,0.92);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            transition: all 0.3s ease;
        }
        .dark .nav-floating {
            background: rgba(10,10,10,0.92);
            border-bottom-color: rgba(255,255,255,0.08);
        }
        .nav-floating.scrolled {
            box-shadow: 0 8px 40px rgba(0,0,0,0.10);
        }
        .dark .nav-floating.scrolled {
            box-shadow: 0 8px 40px rgba(0,0,0,0.50);
        }

        .nav-link {
            position: relative;
            font-size: 0.875rem;
            font-weight: 500;
            color: #555555;
            text-decoration: none;
            padding: 0.25rem 0;
            transition: color 0.2s;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0;
            width: 0; height: 2px;
            background: var(--gold);
            transition: width 0.3s ease;
            border-radius: 2px;
        }
        .nav-link:hover { color: #1A1A1A; }
        .nav-link:hover::after { width: 100%; }
        .dark .nav-link { color: #AAAAAA; }
        .dark .nav-link:hover { color: #EEEEDD; }

        .nav-link-active {
            color: #1A1A1A;
            font-weight: 600;
        }
        .nav-link-active::after { width: 100%; }
        .dark .nav-link-active { color: #EEEEDD; }

        /* ===== BUTTONS ===== */
        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 0.75rem 1.75rem;
            background: linear-gradient(135deg, #D4AF37 0%, #F0D060 100%);
            color: #0D0D0D;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 0.02em;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(212, 175, 55, 0.40);
        }

        .btn-secondary {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 0.75rem 1.75rem;
            background: transparent;
            color: #1A1A1A;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 10px;
            border: 1.5px solid rgba(0,0,0,0.20);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .btn-secondary:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: rgba(212, 175, 55, 0.06);
        }
        .dark .btn-secondary { color: #EEEEDD; border-color: rgba(255,255,255,0.20); }
        .dark .btn-secondary:hover { border-color: var(--gold); color: var(--gold); }

        .btn-danger {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 0.65rem 1.25rem;
            background: linear-gradient(135deg, #EF4444, #DC2626);
            color: white;
            font-weight: 600; font-size: 0.85rem;
            border-radius: 8px; border: none; cursor: pointer;
            transition: all 0.3s ease; text-decoration: none;
        }
        .btn-danger:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(239,68,68,0.35); }

        /* ===== BADGES ===== */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 0.25rem 0.75rem;
            font-size: 0.78rem; font-weight: 600;
            border-radius: 9999px;
        }
        .badge-hoax {
            background: rgba(239,68,68,0.12); color: #DC2626;
            border: 1px solid rgba(239,68,68,0.25);
        }
        .dark .badge-hoax { background: rgba(239,68,68,0.20); color: #FCA5A5; border-color: rgba(239,68,68,0.30); }
        .badge-valid {
            background: rgba(16,185,129,0.12); color: #059669;
            border: 1px solid rgba(16,185,129,0.25);
        }
        .dark .badge-valid { background: rgba(16,185,129,0.20); color: #6EE7B7; border-color: rgba(16,185,129,0.30); }
        .badge-verify {
            background: rgba(245,158,11,0.12); color: #B45309;
            border: 1px solid rgba(245,158,11,0.25);
        }
        .dark .badge-verify { background: rgba(245,158,11,0.20); color: #FCD34D; border-color: rgba(245,158,11,0.30); }
        .badge-admin {
            background: rgba(212,175,55,0.15); color: #92400E;
            border: 1px solid rgba(212,175,55,0.35);
        }
        .dark .badge-admin { background: rgba(212,175,55,0.20); color: var(--gold-light); border-color: rgba(212,175,55,0.40); }

        /* ===== DECORATIVE LINES ===== */
        .divider-gold {
            display: block; width: 60px; height: 3px;
            background: linear-gradient(90deg, var(--gold), transparent);
            border-radius: 3px; margin: 1rem 0;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideRight {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes pulse-gold {
            0%, 100% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.4); }
            50% { box-shadow: 0 0 0 12px rgba(212, 175, 55, 0); }
        }

        .anim-up { animation: fadeUp 0.6s ease forwards; opacity: 0; }
        .anim-up-1 { animation-delay: 0.1s; }
        .anim-up-2 { animation-delay: 0.2s; }
        .anim-up-3 { animation-delay: 0.3s; }
        .anim-up-4 { animation-delay: 0.4s; }

        /* ===== STAT COUNTER ===== */
        .stat-number {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            line-height: 1;
        }

        /* ===== TABLE ===== */
        .table-elegant {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .table-elegant th {
            padding: 0.85rem 1.25rem;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #888888;
            background: #F8F8F7;
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }
        .dark .table-elegant th {
            background: #1A1A1A;
            color: #888888;
            border-bottom-color: rgba(255,255,255,0.06);
        }
        .table-elegant td {
            padding: 0.9rem 1.25rem;
            font-size: 0.875rem;
            border-bottom: 1px solid rgba(0,0,0,0.04);
        }
        .dark .table-elegant td {
            border-bottom-color: rgba(255,255,255,0.04);
        }
        .table-elegant tr:hover td {
            background: rgba(212,175,55,0.04);
        }

        /* ===== TOAST ===== */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .toast { animation: slideUp 0.4s ease forwards; }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.15); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.25); }
        .dark ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); }

        /* ===== PATTERN BG ===== */
        .pattern-dots {
            background-image: radial-gradient(rgba(0,0,0,0.06) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .dark .pattern-dots {
            background-image: radial-gradient(rgba(255,255,255,0.04) 1px, transparent 1px);
        }

        /* ===== SECTION LABEL ===== */
        .section-label {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold);
            background: rgba(212,175,55,0.10);
            border: 1px solid rgba(212,175,55,0.25);
            padding: 0.3rem 0.85rem;
            border-radius: 9999px;
        }
    </style>
</head>
<body>

    <!-- ===== NAVIGATION ===== -->
    <nav class="nav-floating fixed top-0 left-0 right-0 z-50" :class="scrolled && 'scrolled'"
         x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <!-- Logo -->
                <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 group">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center"
                         style="background: linear-gradient(135deg, #D4AF37, #F0D060);">
                        <svg class="w-5 h-5 text-ink-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L3.09 8.26L4 21h16l.91-12.74L12 2zm0 2.5l7.5 5L18.4 19H5.6L4.5 9.5 12 4.5zM11 10h2v5h-2zm0 6h2v2h-2z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-display font-bold text-lg leading-none text-ink-900 dark:text-ink-50">HoaxChecker</span>
                        <span class="block text-xs font-mono" style="color: var(--gold); letter-spacing: 0.05em;">INDONESIA</span>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="<?php echo e(route('news.index')); ?>" class="nav-link <?php echo e(request()->routeIs('news.*') ? 'nav-link-active' : ''); ?>">Berita</a>
                    <a href="<?php echo e(route('hoax.check')); ?>" class="nav-link <?php echo e(request()->routeIs('hoax.*') ? 'nav-link-active' : ''); ?>">Cek Hoaks</a>
                    <a href="<?php echo e(route('education.index')); ?>" class="nav-link <?php echo e(request()->routeIs('education.*') ? 'nav-link-active' : ''); ?>">Edukasi</a>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('history.index')); ?>" class="nav-link <?php echo e(request()->routeIs('history.*') ? 'nav-link-active' : ''); ?>">Riwayat</a>
                        <a href="<?php echo e(route('report.create')); ?>" class="nav-link" style="color: #EF4444;">⚑ Lapor</a>
                    <?php endif; ?>
                </div>

                <!-- Right Controls -->
                <div class="flex items-center gap-3">
                    <!-- Search form (hidden on small) -->
                    <form action="<?php echo e(route('news.index')); ?>" method="GET" class="hidden lg:flex">
                        <div class="relative">
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                                   placeholder="Cari berita..."
                                   class="w-48 text-sm pl-9 pr-4 py-2 rounded-lg border focus:outline-none focus:border-yellow-500 dark:bg-ink-800 dark:border-ink-600 dark:text-ink-100 dark:placeholder-ink-400"
                                   style="border-color: rgba(0,0,0,0.15); font-size: 0.85rem;">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </form>

                    <!-- Dark mode toggle -->
                    <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                            class="w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-200 hover:bg-black/05 dark:hover:bg-white/10"
                            :title="darkMode ? 'Mode Terang' : 'Mode Gelap'">
                        <svg x-show="!darkMode" class="w-5 h-5 text-ink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>

                    <?php if(auth()->guard()->check()): ?>
                        <!-- User dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                    class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-black/05 dark:hover:bg-white/10 transition-all">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-ink-900"
                                     style="background: linear-gradient(135deg, #D4AF37, #F0D060);">
                                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                                </div>
                                <span class="hidden sm:block text-sm font-medium text-ink-700 dark:text-ink-300"><?php echo e(auth()->user()->name); ?></span>
                                <svg class="w-4 h-4 text-ink-400 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.outside="open = false" x-transition
                                 class="absolute right-0 mt-2 w-52 card shadow-xl py-1 z-50">
                                <div class="px-4 py-2.5 border-b" style="border-color: rgba(0,0,0,0.06);">
                                    <p class="text-xs font-semibold text-ink-800 dark:text-ink-200"><?php echo e(auth()->user()->name); ?></p>
                                    <p class="text-xs text-ink-400"><?php echo e(auth()->user()->email); ?></p>
                                </div>
                                <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-2 px-4 py-2.5 text-sm text-ink-700 dark:text-ink-300 hover:bg-black/04 dark:hover:bg-white/06 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                    Dashboard
                                </a>
                                <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-2 px-4 py-2.5 text-sm text-ink-700 dark:text-ink-300 hover:bg-black/04 dark:hover:bg-white/06 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Profil Saya
                                </a>
                                <?php if(auth()->user()->role === 'admin'): ?>
                                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-2 px-4 py-2.5 text-sm transition-colors" style="color: var(--gold);">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                        Admin Panel
                                    </a>
                                <?php endif; ?>
                                <div class="border-t mt-1" style="border-color: rgba(0,0,0,0.06);">
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/15 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-sm font-semibold text-ink-700 dark:text-ink-300 hover:text-ink-900 dark:hover:text-ink-50 transition-colors">Masuk</a>
                        <a href="<?php echo e(route('register')); ?>" class="btn-primary text-sm px-5 py-2">Daftar Gratis</a>
                    <?php endif; ?>

                    <!-- Mobile menu toggle -->
                    <button @click="mobileOpen = !mobileOpen"
                            class="md:hidden w-9 h-9 rounded-lg flex items-center justify-center hover:bg-black/05 dark:hover:bg-white/10 transition-all">
                        <svg x-show="!mobileOpen" class="w-5 h-5 text-ink-600 dark:text-ink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileOpen" class="w-5 h-5 text-ink-600 dark:text-ink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileOpen" x-transition class="md:hidden border-t dark:border-ink-800" style="border-color: rgba(0,0,0,0.06);">
            <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
                <form action="<?php echo e(route('news.index')); ?>" method="GET" class="mb-3">
                    <input type="text" name="search" placeholder="Cari berita..."
                           class="w-full text-sm px-4 py-2.5 rounded-lg border dark:bg-ink-800 dark:border-ink-600 dark:text-ink-100 dark:placeholder-ink-400 focus:outline-none"
                           style="border-color: rgba(0,0,0,0.15);">
                </form>
                <a href="<?php echo e(route('news.index')); ?>" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-ink-700 dark:text-ink-300 hover:bg-black/04 dark:hover:bg-white/06 transition-colors">📰 Berita</a>
                <a href="<?php echo e(route('hoax.check')); ?>" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-ink-700 dark:text-ink-300 hover:bg-black/04 dark:hover:bg-white/06 transition-colors">🔍 Cek Hoaks</a>
                <a href="<?php echo e(route('education.index')); ?>" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-ink-700 dark:text-ink-300 hover:bg-black/04 dark:hover:bg-white/06 transition-colors">🎓 Edukasi</a>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('history.index')); ?>" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-ink-700 dark:text-ink-300 hover:bg-black/04 dark:hover:bg-white/06 transition-colors">📜 Riwayat</a>
                    <a href="<?php echo e(route('report.create')); ?>" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors">⚑ Laporkan Berita</a>
                    <div class="border-t pt-2 mt-2" style="border-color: rgba(0,0,0,0.06);">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="block w-full text-left px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors">
                                Keluar
                            </button>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="flex gap-2 pt-2">
                        <a href="<?php echo e(route('login')); ?>" class="flex-1 text-center py-2.5 text-sm font-semibold border border-ink-200 dark:border-ink-700 rounded-lg text-ink-700 dark:text-ink-300 transition-colors">Masuk</a>
                        <a href="<?php echo e(route('register')); ?>" class="flex-1 text-center py-2.5 text-sm font-bold rounded-lg text-ink-900" style="background: linear-gradient(135deg, #D4AF37, #F0D060);">Daftar</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="pt-16 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="mt-24 border-t border-ink-100 dark:border-ink-800 bg-[#F0EFE6] dark:bg-ink-900">
        <div></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #D4AF37, #F0D060);">
                            <svg class="w-5 h-5 text-ink-900" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L3.09 8.26L4 21h16l.91-12.74L12 2zm0 2.5l7.5 5L18.4 19H5.6L4.5 9.5 12 4.5zM11 10h2v5h-2zm0 6h2v2h-2z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-display font-bold text-lg text-ink-900 dark:text-ink-50 leading-none block">HoaxChecker</span>
                            <span class="text-xs font-mono" style="color: var(--gold); letter-spacing: 0.05em;">INDONESIA</span>
                        </div>
                    </div>
                    <p class="text-sm text-ink-500 dark:text-ink-400 leading-relaxed max-w-xs">
                        Platform verifikasi berita berbasis AI untuk melawan misinformasi dan hoaks demi Indonesia yang lebih cerdas.
                    </p>
                    <div class="flex gap-3 mt-5">
                        <a href="#" class="w-8 h-8 rounded-lg border border-ink-200 dark:border-ink-700 flex items-center justify-center text-ink-400 hover:border-yellow-500 hover:text-yellow-600 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg border border-ink-200 dark:border-ink-700 flex items-center justify-center text-ink-400 hover:border-yellow-500 hover:text-yellow-600 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest mb-4" style="color: var(--gold);">Produk</h4>
                    <ul class="space-y-2.5">
                        <?php $__currentLoopData = [['Cek Hoaks', 'hoax.check'], ['Berita Terkini', 'news.index'], ['Edukasi Digital', 'education.index'], ['Lapor Berita', 'report.create']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $route]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route($route)); ?>" class="text-sm text-ink-500 dark:text-ink-400 hover:text-ink-900 dark:hover:text-ink-100 transition-colors"><?php echo e($label); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest mb-4" style="color: var(--gold);">Perusahaan</h4>
                    <ul class="space-y-2.5">
                        <?php $__currentLoopData = [['Tentang Kami', 'about'], ['Hubungi Kami', 'contact']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $route]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route($route)); ?>" class="text-sm text-ink-500 dark:text-ink-400 hover:text-ink-900 dark:hover:text-ink-100 transition-colors"><?php echo e($label); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="#" class="text-sm text-ink-500 dark:text-ink-400 hover:text-ink-900 dark:hover:text-ink-100 transition-colors">Blog</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest mb-4" style="color: var(--gold);">Legal</h4>
                    <ul class="space-y-2.5">
                        <?php $__currentLoopData = ['Kebijakan Privasi', 'Syarat & Ketentuan', 'Cookie']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="#" class="text-sm text-ink-500 dark:text-ink-400 hover:text-ink-900 dark:hover:text-ink-100 transition-colors"><?php echo e($item); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>

            <div class="border-t border-ink-100 dark:border-ink-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-ink-400">
                    &copy; <?php echo e(date('Y')); ?> <span class="font-semibold text-ink-700 dark:text-ink-300">HoaxChecker Indonesia</span>. Semua hak cipta dilindungi.
                </p>
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-green-500" style="animation: pulse 2s infinite;"></div>
                    <span class="text-xs text-ink-400">Sistem berjalan normal</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- ===== TOAST NOTIFICATIONS ===== -->
    <?php if(session('success') || session('error') || session('warning')): ?>
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)"
         x-show="show" x-transition
         class="fixed bottom-6 right-6 z-50 space-y-3 max-w-sm">
        <?php if(session('success')): ?>
        <div class="toast flex items-start gap-3 px-5 py-4 rounded-xl shadow-2xl text-sm"
             style="background: #0D0D0D; border: 1px solid rgba(16,185,129,0.4); color: #6EE7B7;">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
            </svg>
            <span class="font-medium"><?php echo e(session('success')); ?></span>
        </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div class="toast flex items-start gap-3 px-5 py-4 rounded-xl shadow-2xl text-sm"
             style="background: #0D0D0D; border: 1px solid rgba(239,68,68,0.4); color: #FCA5A5;">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
            </svg>
            <span class="font-medium"><?php echo e(session('error')); ?></span>
        </div>
        <?php endif; ?>
        <?php if(session('warning')): ?>
        <div class="toast flex items-start gap-3 px-5 py-4 rounded-xl shadow-2xl text-sm"
             style="background: #0D0D0D; border: 1px solid rgba(245,158,11,0.4); color: #FCD34D;">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"/>
            </svg>
            <span class="font-medium"><?php echo e(session('warning')); ?></span>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Laporan Tugas Kuliah\SEMESTER 4\Pemrograman Web Lanjut\hoaxchecker\resources\views/layouts/app.blade.php ENDPATH**/ ?>