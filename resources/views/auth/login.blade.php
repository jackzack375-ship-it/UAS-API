@extends('layouts.app')
@section('title', 'Login - HoaxChecker Indonesia')
@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12 relative overflow-hidden -mt-10">
    <!-- Background blobs - sesuai tema gold/ink -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 rounded-full blur-3xl animate-blob"
             style="background: radial-gradient(circle, rgba(212,175,55,0.18) 0%, rgba(240,208,96,0.08) 100%);"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 rounded-full blur-3xl animate-blob animation-delay-2000"
             style="background: radial-gradient(circle, rgba(212,175,55,0.12) 0%, rgba(180,148,30,0.06) 100%);"></div>
        <div class="absolute top-1/2 right-0 w-72 h-72 rounded-full blur-3xl animate-blob animation-delay-4000"
             style="background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, rgba(212,175,55,0.05) 100%);"></div>
    </div>

    <div class="relative z-10 w-full max-w-md">
        <!-- Card - pakai card class dari layout -->
        <div class="card rounded-3xl p-8 md:p-10 shadow-2xl"
             style="border: 1px solid rgba(212,175,55,0.15);">

            <!-- Logo & Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-4 shadow-lg"
                     style="background: linear-gradient(135deg, #D4AF37, #F0D060);">
                    <svg class="w-8 h-8 text-ink-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h1 class="font-display text-3xl md:text-4xl font-black text-ink-900 dark:text-ink-50 mb-2">
                    Selamat <span class="text-gradient">Datang</span>
                </h1>
                <p class="text-ink-500 dark:text-ink-400 text-sm md:text-base">Masuk ke HoaxChecker Anda</p>
            </div>

            <!-- Session Status -->
            @if(session('status'))
            <div class="mb-6 p-4 rounded-2xl flex items-center gap-2"
                 style="background: rgba(16,185,129,0.10); border: 1px solid rgba(16,185,129,0.30);">
                <svg class="w-5 h-5 flex-shrink-0 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                </svg>
                <p class="text-sm text-emerald-700 dark:text-emerald-300">{{ session('status') }}</p>
            </div>
            @endif

            <!-- Errors -->
            @if($errors->any())
            <div class="mb-6 p-4 rounded-2xl"
                 style="background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.25);">
                <p class="text-sm text-red-700 dark:text-red-400 font-semibold mb-2">Terjadi kesalahan!</p>
                <ul class="text-xs text-red-600 dark:text-red-400 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div class="group">
                    <label for="email" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-ink-400">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="nama@example.com"
                            class="w-full pl-11 pr-4 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 placeholder-ink-400 dark:placeholder-ink-500 focus:outline-none focus:ring-2 transition-all duration-200"
                            style="background: rgba(0,0,0,0.03); border: 1.5px solid rgba(0,0,0,0.10); color: inherit;"
                            onfocus="this.style.borderColor='#D4AF37'; this.style.background='rgba(212,175,55,0.04)';"
                            onblur="this.style.borderColor='rgba(0,0,0,0.10)'; this.style.background='rgba(0,0,0,0.03)';"
                        />
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="group">
                    <label for="password" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-ink-400">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full pl-11 pr-12 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 placeholder-ink-400 dark:placeholder-ink-500 focus:outline-none transition-all duration-200"
                            style="background: rgba(0,0,0,0.03); border: 1.5px solid rgba(0,0,0,0.10);"
                            onfocus="this.style.borderColor='#D4AF37'; this.style.background='rgba(212,175,55,0.04)';"
                            onblur="this.style.borderColor='rgba(0,0,0,0.10)'; this.style.background='rgba(0,0,0,0.03)';"
                        />
                        <button
                            type="button"
                            onclick="togglePassword(event)"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-ink-400 hover:text-ink-700 dark:hover:text-ink-200 transition-colors duration-200"
                        >
                            <svg class="w-4 h-4 toggle-show" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 cursor-pointer group/check">
                        <input
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded border-2 cursor-pointer accent-yellow-600"
                            style="border-color: rgba(0,0,0,0.20);"
                        />
                        <span class="text-ink-600 dark:text-ink-400 font-medium group-hover/check:text-ink-900 dark:group-hover/check:text-ink-200 transition-colors">
                            Ingat saya
                        </span>
                    </label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="font-semibold transition-colors duration-200 hover:underline"
                           style="color: var(--gold);">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-primary w-full py-3.5 text-base mt-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Masuk Sekarang
                </button>

                <!-- Divider -->
                <div class="relative flex items-center justify-center my-2">
                    <div class="absolute inset-x-0 h-px" style="background: linear-gradient(90deg, transparent, rgba(0,0,0,0.10), transparent);"></div>
                    <span class="relative px-3 text-xs font-semibold text-ink-400 bg-white dark:bg-ink-800">ATAU</span>
                </div>

                <!-- Social -->
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" class="btn-secondary py-3 text-sm gap-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        Google
                    </button>
                    <button type="button" class="btn-secondary py-3 text-sm gap-2">
                        <svg class="w-4 h-4" fill="#1877F2" viewBox="0 0 24 24">
                            <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5c-.563-.074-2.324-.235-4.113-.235-4.38 0-7.426 2.745-7.426 7.779v1.456z"/>
                        </svg>
                        Facebook
                    </button>
                </div>
            </form>

            <!-- Register link -->
            <p class="mt-6 text-center text-sm text-ink-500 dark:text-ink-400">
                Belum punya akun?
                <a href="{{ route('register') }}"
                   class="font-bold hover:underline transition-colors ml-1"
                   style="color: var(--gold);">
                    Daftar Sekarang
                </a>
            </p>
        </div>

        <p class="mt-6 text-center text-xs text-ink-400 px-4">
            Dengan masuk, Anda setuju dengan <a href="#" class="hover:underline" style="color: var(--gold);">Syarat & Ketentuan</a> kami
        </p>
    </div>
</div>

<style>
    @keyframes blob {
        0%, 100% { transform: translate(0,0) scale(1); }
        33% { transform: translate(30px,-50px) scale(1.1); }
        66% { transform: translate(-20px,20px) scale(0.9); }
    }
    .animate-blob { animation: blob 7s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }

    /* Dark mode input fix */
    .dark input[type="email"],
    .dark input[type="password"],
    .dark input[type="text"] {
        background: rgba(255,255,255,0.04) !important;
        border-color: rgba(255,255,255,0.10) !important;
        color: #EEEEDD;
    }
    .dark input:focus {
        border-color: #D4AF37 !important;
        background: rgba(212,175,55,0.06) !important;
    }
    .dark .btn-secondary {
        background: rgba(255,255,255,0.04);
    }
</style>

<script>
    function togglePassword(event) {
        event.preventDefault();
        const input = document.getElementById('password');
        const icon = event.currentTarget.querySelector('.toggle-show');
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.803m5.596-3.856a3 3 0 11-4.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
        } else {
            input.type = 'password';
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }
    }
</script>
@endsection