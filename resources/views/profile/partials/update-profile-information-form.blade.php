<form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

<form method="post" action="{{ route('profile.update') }}" class="space-y-5">
    @csrf
    @method('patch')

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
               class="w-full px-4 py-3 rounded-xl text-sm border dark:bg-ink-800 dark:text-ink-100 dark:placeholder-ink-500 focus:outline-none transition-all"
               style="border-color: rgba(0,0,0,0.12);"
               onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
               onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">
    </div>

    <div>
        <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Alamat Email</label>
        <input type="email" name="email" required autocomplete="username"
               value="{{ old('email', $user->email) }}"
               class="w-full px-4 py-3 rounded-xl text-sm border dark:bg-ink-800 dark:text-ink-100 dark:placeholder-ink-500 focus:outline-none transition-all"
               style="border-color: rgba(0,0,0,0.12);"
               onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
               onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="mt-2 p-3 rounded-lg text-xs" style="background: rgba(245,158,11,0.10); color: #B45309; border: 1px solid rgba(245,158,11,0.25);">
            ⚠ Email Anda belum diverifikasi.
            <button form="send-verification" class="underline font-semibold ml-1">Kirim ulang verifikasi.</button>
            @if (session('status') === 'verification-link-sent')
                <span class="ml-1 font-semibold" style="color: #059669;">✓ Link terkirim!</span>
            @endif
        </div>
        @endif
    </div>

    <div class="flex items-center gap-4 pt-2">
        <button type="submit" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Simpan Perubahan
        </button>
        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition
               x-init="setTimeout(() => show = false, 2000)"
               class="text-sm font-medium" style="color: #059669;">✓ Tersimpan!</p>
        @endif
    </div>
</form>