@extends('layouts.app')
@section('title', 'Daftar - HoaxChecker Indonesia')
@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12 relative overflow-hidden -mt-10">
    <!-- Background blobs - tema gold -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-0 right-1/4 w-96 h-96 rounded-full blur-3xl animate-blob"
             style="background: radial-gradient(circle, rgba(212,175,55,0.18) 0%, rgba(240,208,96,0.06) 100%);"></div>
        <div class="absolute bottom-0 left-1/4 w-96 h-96 rounded-full blur-3xl animate-blob animation-delay-2000"
             style="background: radial-gradient(circle, rgba(180,148,30,0.12) 0%, rgba(212,175,55,0.05) 100%);"></div>
        <div class="absolute top-1/3 left-0 w-72 h-72 rounded-full blur-3xl animate-blob animation-delay-4000"
             style="background: radial-gradient(circle, rgba(59,130,246,0.06) 0%, rgba(212,175,55,0.04) 100%);"></div>
    </div>

    <div class="relative z-10 w-full max-w-md">
        <div class="card rounded-3xl p-8 md:p-10 shadow-2xl" style="border: 1px solid rgba(212,175,55,0.15);">

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-4 shadow-lg"
                     style="background: linear-gradient(135deg, #D4AF37, #F0D060);">
                    <svg class="w-8 h-8 text-ink-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h1 class="font-display text-3xl md:text-4xl font-black text-ink-900 dark:text-ink-50 mb-2">
                    <span class="text-gradient">Bergabung</span> Bersama Kami
                </h1>
                <p class="text-ink-500 dark:text-ink-400 text-sm md:text-base">Mulai lawan hoaks bersama komunitas kami</p>
            </div>

            <!-- Error Alert -->
            @if($errors->any())
            <div class="mb-6 p-4 rounded-2xl" style="background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.25);">
                <p class="text-sm text-red-700 dark:text-red-400 font-semibold mb-2">Validasi Gagal!</p>
                <ul class="text-xs text-red-600 dark:text-red-400 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5" id="registerForm">
                @csrf

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-ink-400">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                               placeholder="Nama Anda"
                               class="gold-input w-full pl-11 pr-4 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 placeholder-ink-400 dark:placeholder-ink-500 focus:outline-none transition-all duration-200"/>
                    </div>
                    @error('name')<p class="mt-1.5 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>@enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-ink-400">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="username"
                               placeholder="nama@example.com"
                               class="gold-input w-full pl-11 pr-4 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 placeholder-ink-400 dark:placeholder-ink-500 focus:outline-none transition-all duration-200"/>
                    </div>
                    @error('email')<p class="mt-1.5 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>@enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-ink-400">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" required autocomplete="new-password"
                               placeholder="Minimal 8 karakter"
                               class="gold-input w-full pl-11 pr-12 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 placeholder-ink-400 dark:placeholder-ink-500 focus:outline-none transition-all duration-200"
                               oninput="checkPasswordStrength()"/>
                        <button type="button" onclick="togglePassword(event,'password')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-ink-400 hover:text-ink-700 dark:hover:text-ink-200 transition-colors">
                            <svg class="w-4 h-4 toggle-show" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <!-- Strength bar -->
                    <div class="mt-2 h-1.5 rounded-full overflow-hidden" style="background: rgba(0,0,0,0.08);">
                        <div id="passwordStrength" class="h-full w-0 transition-all duration-300 rounded-full" style="background: #EF4444;"></div>
                    </div>
                    <p id="strengthText" class="text-xs mt-1" style="color: #EF4444;">Sangat lemah</p>
                    @error('password')<p class="mt-1.5 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>@enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-ink-400">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                               placeholder="Ulangi password Anda"
                               class="gold-input w-full pl-11 pr-12 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 placeholder-ink-400 dark:placeholder-ink-500 focus:outline-none transition-all duration-200"/>
                        <button type="button" onclick="togglePassword(event,'password_confirmation')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-ink-400 hover:text-ink-700 dark:hover:text-ink-200 transition-colors">
                            <svg class="w-4 h-4 toggle-show" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')<p class="mt-1.5 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>@enderror
                </div>

                <!-- Terms -->
                <div class="pt-1">
                    <label class="flex items-start gap-3 cursor-pointer group">
                        <input type="checkbox" name="terms" required
                               class="w-4 h-4 mt-0.5 rounded cursor-pointer accent-yellow-600 flex-shrink-0"
                               style="border-color: rgba(0,0,0,0.20);"/>
                        <span class="text-xs text-ink-500 dark:text-ink-400">
                            Saya setuju dengan
                            <a href="#" class="font-bold hover:underline" style="color: var(--gold);">Syarat & Ketentuan</a>
                            dan
                            <a href="#" class="font-bold hover:underline" style="color: var(--gold);">Kebijakan Privasi</a>
                        </span>
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-primary w-full py-3.5 text-base mt-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Buat Akun Sekarang
                </button>

                <!-- Divider -->
                <div class="relative flex items-center justify-center">
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

            <p class="mt-6 text-center text-sm text-ink-500 dark:text-ink-400">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold hover:underline ml-1" style="color: var(--gold);">Masuk Di Sini</a>
            </p>
        </div>

        <p class="mt-6 text-center text-xs text-ink-400">🎯 Gratis &nbsp;•&nbsp; 🔒 Aman &nbsp;•&nbsp; ⚡ Cepat</p>
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

    @keyframes blob {
        0%,100% { transform: translate(0,0) scale(1); }
        33% { transform: translate(30px,-50px) scale(1.1); }
        66% { transform: translate(-20px,20px) scale(0.9); }
    }
    .animate-blob { animation: blob 7s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
</style>

<script>
    function togglePassword(event, fieldId) {
        event.preventDefault();
        const input = document.getElementById(fieldId);
        const icon = event.currentTarget.querySelector('.toggle-show');
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.803m5.596-3.856a3 3 0 11-4.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
        } else {
            input.type = 'password';
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }
    }

    function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const bar = document.getElementById('passwordStrength');
        const text = document.getElementById('strengthText');
        let strength = 0;
        if (password.length >= 8)  strength += 20;
        if (password.length >= 12) strength += 20;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 20;
        if (/[0-9]/.test(password)) strength += 20;
        if (/[^a-zA-Z0-9]/.test(password)) strength += 20;
        bar.style.width = strength + '%';
        if (strength < 40) {
            bar.style.background = '#EF4444'; text.textContent = '❌ Sangat Lemah'; text.style.color = '#EF4444';
        } else if (strength < 60) {
            bar.style.background = '#F59E0B'; text.textContent = '⚠️ Lemah'; text.style.color = '#F59E0B';
        } else if (strength < 80) {
            bar.style.background = '#D4AF37'; text.textContent = '✓ Cukup Kuat'; text.style.color = '#D4AF37';
        } else {
            bar.style.background = '#10B981'; text.textContent = '✅ Sangat Kuat'; text.style.color = '#10B981';
        }
    }
</script>
@endsection