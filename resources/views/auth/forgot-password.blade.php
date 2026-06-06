@extends('layouts.app')
@section('title', 'Lupa Password - HoaxChecker')
@section('content')

<div class="min-h-screen flex items-center justify-center px-4 py-12 relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 right-1/3 w-96 h-96 bg-gradient-to-br from-amber-500/30 to-orange-500/20 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-0 left-1/3 w-96 h-96 bg-gradient-to-tl from-yellow-500/20 to-amber-500/30 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
    </div>

    <div class="relative z-10 w-full max-w-md">
        <!-- Card -->
        <div class="backdrop-blur-xl bg-white/10 dark:bg-white/5 border border-white/20 dark:border-white/10 rounded-3xl p-8 md:p-10 shadow-2xl">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-black bg-clip-text text-transparent bg-gradient-to-r from-amber-600 to-orange-600 mb-2">
                    Reset Password
                </h1>
                <p class="text-gray-600 dark:text-gray-300 text-sm">Masukkan email Anda untuk menerima link reset</p>
            </div>

            <!-- Status Message -->
            @if(session('status'))
            <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 rounded-2xl backdrop-blur-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                    </svg>
                    <p class="text-sm text-green-700 dark:text-green-300">{{ session('status') }}</p>
                </div>
            </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div class="group">
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">
                        📧 Email Address
                    </label>
                    <div class="relative">
                        <input 
                            type="email" 
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="nama@example.com"
                            class="w-full px-4 py-3.5 bg-white/10 dark:bg-white/5 border border-white/20 dark:border-white/10 rounded-xl text-gray-800 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent focus:bg-white/20 dark:focus:bg-white/10 transition-all duration-300 backdrop-blur-sm"
                        />
                        <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-amber-500 opacity-0 group-focus-within:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @error('email')
                        <p class="mt-2 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button 
                    type="submit"
                    class="w-full py-3.5 px-4 bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2 group relative overflow-hidden"
                >
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Kirim Link Reset
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-600 to-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
            </form>

            <!-- Back Link -->
            <p class="mt-6 text-center text-gray-600 dark:text-gray-400">
                Ingat passwordnya? 
                <a 
                    href="{{ route('login') }}" 
                    class="font-bold text-amber-600 dark:text-amber-400 hover:text-amber-700 dark:hover:text-amber-300 hover:underline transition-colors duration-300"
                >
                    Kembali ke Login
                </a>
            </p>
        </div>
    </div>
</div>

<style>
    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }
</style>

@endsection