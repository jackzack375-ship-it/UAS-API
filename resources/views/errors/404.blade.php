<!-- resources/views/errors/404.blade.php -->
@extends('layouts.app')
@section('title', '404 - Halaman Tidak Ditemukan')
@section('content')

<div class="min-h-screen flex items-center justify-center px-4 py-12 relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-1/4 -left-1/2 w-96 h-96 bg-gradient-to-br from-purple-500/20 to-pink-500/10 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-1/4 -right-1/2 w-96 h-96 bg-gradient-to-tl from-blue-500/20 to-purple-500/10 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
    </div>

    <div class="relative z-10 text-center max-w-md">
        <!-- Error Code with Animation -->
        <div class="mb-8 animate-bounce" style="animation-duration: 2s;">
            <div class="text-9xl font-black bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-pink-600">
                404
            </div>
        </div>

        <!-- Illustration -->
        <div class="mb-8">
            <svg class="w-40 h-40 mx-auto opacity-80" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="100" cy="100" r="95" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-300 dark:text-gray-600"/>
                <path d="M100 50V150M50 100H150" stroke="currentColor" stroke-width="3" class="text-indigo-500" stroke-linecap="round"/>
                <circle cx="80" cy="80" r="8" fill="currentColor" class="text-indigo-500"/>
                <circle cx="120" cy="120" r="8" fill="currentColor" class="text-indigo-500"/>
            </svg>
        </div>

        <!-- Message -->
        <h1 class="text-4xl md:text-5xl font-black text-gray-800 dark:text-white mb-3">
            Oops! Halaman Tidak Ditemukan
        </h1>
        <p class="text-gray-600 dark:text-gray-300 text-lg mb-8">
            Halaman yang Anda cari telah hilang di antara hoaks dan misinformasi. 😅
        </p>

        <!-- CTA Buttons -->
        <div class="space-y-3">
            <a href="{{ route('home') }}" class="block px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                Kembali ke Beranda
            </a>
            <a href="{{ route('hoax.check') }}" class="block px-8 py-3 bg-white/10 dark:bg-white/5 border-2 border-white/20 text-gray-800 dark:text-white font-bold rounded-xl hover:bg-white/20 dark:hover:bg-white/10 transition-all duration-300">
                Cek Berita Sekarang
            </a>
        </div>

        <!-- Helpful Links -->
        <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Navigasi cepat:</p>
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('news.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">📰 Berita</a>
                <a href="{{ route('education.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">🎓 Edukasi</a>
                <a href="{{ route('history.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">📜 Riwayat</a>
                <a href="{{ route('contact') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">📧 Hubungi Kami</a>
            </div>
        </div>
    </div>
</div>

<!-- ------- 403 - FORBIDDEN ------- -->
<!-- resources/views/errors/403.blade.php -->
<!-- 
Uncomment dan ganti bagian di atas dengan ini untuk error 403:

<div class="min-h-screen flex items-center justify-center px-4 py-12 relative overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="absolute top-1/4 -left-1/2 w-96 h-96 bg-gradient-to-br from-red-500/20 to-orange-500/10 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-1/4 -right-1/2 w-96 h-96 bg-gradient-to-tl from-orange-500/20 to-red-500/10 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
    </div>

    <div class="relative z-10 text-center max-w-md">
        <div class="mb-8">
            <div class="text-9xl font-black bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-orange-600">
                403
            </div>
        </div>

        <h1 class="text-4xl md:text-5xl font-black text-gray-800 dark:text-white mb-3">
            Akses Ditolak
        </h1>
        <p class="text-gray-600 dark:text-gray-300 text-lg mb-8">
            Anda tidak memiliki izin untuk mengakses halaman ini. Hubungi administrator jika merasa ini adalah kesalahan.
        </p>

        <div class="space-y-3">
            <a href="{{ route('home') }}" class="block px-8 py-3 bg-gradient-to-r from-red-600 to-orange-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                Kembali ke Beranda
            </a>
            <a href="{{ route('contact') }}" class="block px-8 py-3 bg-white/10 dark:bg-white/5 border-2 border-white/20 text-gray-800 dark:text-white font-bold rounded-xl hover:bg-white/20 dark:hover:bg-white/10 transition-all duration-300">
                Hubungi Support
            </a>
        </div>
    </div>
</div>
-->

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