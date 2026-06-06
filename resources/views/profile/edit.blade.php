{{-- ============================================================ --}}
{{-- FILE: resources/views/profile/edit.blade.php               --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Edit Profil')
@section('content')

<div class="max-w-2xl mx-auto space-y-6">
    <div>
        <div class="section-label mb-3">Pengaturan Akun</div>
        <h1 class="font-display text-2xl md:text-3xl font-black text-ink-900 dark:text-ink-50">Profil Saya</h1>
        <p class="text-sm text-ink-400 mt-1">Kelola informasi akun dan keamanan Anda</p>
    </div>

    {{-- Profile Info --}}
    <div class="card p-8">
        <div class="mb-6 pb-5 border-b" style="border-color: rgba(0,0,0,0.06);">
            <h2 class="font-display font-bold text-lg text-ink-900 dark:text-ink-50">Informasi Profil</h2>
            <p class="text-sm text-ink-400 mt-0.5">Perbarui nama dan alamat email akun Anda.</p>
        </div>
        @include('profile.partials.update-profile-information-form')
    </div>

    {{-- Password --}}
    <div class="card p-8">
        <div class="mb-6 pb-5 border-b" style="border-color: rgba(0,0,0,0.06);">
            <h2 class="font-display font-bold text-lg text-ink-900 dark:text-ink-50">Ubah Password</h2>
            <p class="text-sm text-ink-400 mt-0.5">Gunakan password panjang dan acak untuk keamanan akun.</p>
        </div>
        @include('profile.partials.update-password-form')
    </div>

    {{-- Delete Account --}}
    <div class="card p-8 border" style="border-color: rgba(239,68,68,0.2); background: rgba(239,68,68,0.02);">
        <div class="mb-6 pb-5 border-b" style="border-color: rgba(239,68,68,0.1);">
            <h2 class="font-display font-bold text-lg text-red-700 dark:text-red-400">Hapus Akun</h2>
            <p class="text-sm text-ink-400 mt-0.5">Hapus akun Anda secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        @include('profile.partials.delete-user-form')
    </div>
</div>

@endsection


{{-- ============================================================ --}}
{{-- FILE: resources/views/profile/partials/                     --}}
{{--   update-profile-information-form.blade.php                 --}}
{{-- ============================================================ --}}
{{--
PASTE KE FILE BARU: update-profile-information-form.blade.php

<form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

<form method="post" action="{{ route('profile.update') }}" class="space-y-5">
    @csrf @method('patch')

    @if($errors->any())
    <div class="p-3 rounded-xl text-sm" style="background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2); color: #DC2626;">
        @foreach($errors->get('name') as $e)<p>{{ $e }}</p>@endforeach
        @foreach($errors->get('email') as $e)<p>{{ $e }}</p>@endforeach
    </div>
    @endif

    <div>
        <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Nama Lengkap</label>
        <input type="text" name="name" required autofocus autocomplete="name"
               value="{{ old('name', $user->name) }}"
               class="w-full px-4 py-3 rounded-xl text-sm border dark:bg-ink-800 dark:text-ink-100 focus:outline-none transition-all"
               style="border-color: rgba(0,0,0,0.12);"
               onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
               onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">
    </div>

    <div>
        <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Alamat Email</label>
        <input type="email" name="email" required autocomplete="username"
               value="{{ old('email', $user->email) }}"
               class="w-full px-4 py-3 rounded-xl text-sm border dark:bg-ink-800 dark:text-ink-100 focus:outline-none transition-all"
               style="border-color: rgba(0,0,0,0.12);"
               onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
               onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="mt-2 p-3 rounded-lg text-xs" style="background: rgba(245,158,11,0.1); color: #B45309; border: 1px solid rgba(245,158,11,0.25);">
            ⚠ Email Anda belum diverifikasi.
            <button form="send-verification" class="underline font-semibold ml-1">Kirim ulang email verifikasi.</button>
            @if (session('status') === 'verification-link-sent')
                <span class="ml-1 font-semibold" style="color: #059669;">✓ Link terkirim!</span>
            @endif
        </div>
        @endif
    </div>

    <div class="flex items-center gap-4 pt-2">
        <button type="submit" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Simpan Perubahan
        </button>
        @if (session('status') === 'profile-updated')
            <p x-data="{show:true}" x-show="show" x-transition x-init="setTimeout(()=>show=false,2000)"
               class="text-sm" style="color: #059669;">✓ Tersimpan!</p>
        @endif
    </div>
</form>
--}}


{{-- ============================================================ --}}
{{-- FILE: update-password-form.blade.php                        --}}
{{-- ============================================================ --}}
{{--
<form method="post" action="{{ route('password.update') }}" class="space-y-5">
    @csrf @method('put')

    @foreach(['update_password_current_password' => ['current_password','Password Saat Ini'], 'update_password_password' => ['password','Password Baru'], 'update_password_password_confirmation' => ['password_confirmation','Konfirmasi Password Baru']] as $id => [$name, $label])
    <div>
        <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">{{ $label }}</label>
        <input id="{{ $id }}" name="{{ $name }}" type="password"
               class="w-full px-4 py-3 rounded-xl text-sm border dark:bg-ink-800 dark:text-ink-100 focus:outline-none transition-all"
               style="border-color: rgba(0,0,0,0.12);"
               onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
               onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">
        @foreach($errors->updatePassword->get($name) as $e)
            <p class="text-xs mt-1 text-red-500">{{ $e }}</p>
        @endforeach
    </div>
    @endforeach

    <div class="flex items-center gap-4 pt-2">
        <button type="submit" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            Ubah Password
        </button>
        @if (session('status') === 'password-updated')
            <p x-data="{show:true}" x-show="show" x-transition x-init="setTimeout(()=>show=false,2000)"
               class="text-sm" style="color: #059669;">✓ Password diperbarui!</p>
        @endif
    </div>
</form>
--}}


{{-- ============================================================ --}}
{{-- FILE: delete-user-form.blade.php                            --}}
{{-- ============================================================ --}}
{{--
<section x-data="{ confirm: false }">
    <p class="text-sm text-ink-500 dark:text-ink-400 mb-5">
        Setelah akun dihapus, semua data Anda akan dihapus secara permanen. Pastikan Anda telah mengunduh data yang ingin disimpan sebelum melanjutkan.
    </p>

    <button @click="confirm = true"
            class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all"
            style="background: rgba(239,68,68,0.12); color: #DC2626; border: 1px solid rgba(239,68,68,0.25);">
        Hapus Akun Saya
    </button>

    <div x-show="confirm" x-transition
         class="fixed inset-0 flex items-center justify-center z-50"
         style="background: rgba(0,0,0,0.5); backdrop-filter: blur(8px);">
        <div class="card p-8 max-w-md w-full mx-4 border" style="border-color: rgba(239,68,68,0.2);">
            <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5 mx-auto"
                 style="background: rgba(239,68,68,0.12);">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>
            <h3 class="font-display font-bold text-xl text-center text-ink-900 dark:text-ink-50 mb-2">Hapus Akun?</h3>
            <p class="text-sm text-ink-400 text-center mb-6">Masukkan password Anda untuk mengkonfirmasi penghapusan akun secara permanen.</p>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf @method('delete')
                <div>
                    <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Password</label>
                    <input name="password" type="password" placeholder="Masukkan password Anda..."
                           class="w-full px-4 py-3 rounded-xl text-sm border dark:bg-ink-800 dark:text-ink-100 focus:outline-none"
                           style="border-color: rgba(239,68,68,0.3);">
                    @foreach($errors->userDeletion->get('password') as $e)
                        <p class="text-xs mt-1 text-red-500">{{ $e }}</p>
                    @endforeach
                </div>
                <div class="flex gap-3">
                    <button type="button" @click="confirm = false" class="btn-secondary flex-1 text-sm">Batal</button>
                    <button type="submit" class="btn-danger flex-1">Hapus Permanen</button>
                </div>
            </form>
        </div>
    </div>
</section>
--}}