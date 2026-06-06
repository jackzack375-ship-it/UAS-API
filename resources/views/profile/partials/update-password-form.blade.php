{{-- ============================================================ --}}
{{-- FILE: resources/views/profile/partials/                     --}}
{{--   update-password-form.blade.php                            --}}
{{-- ============================================================ --}}
<form method="post" action="{{ route('password.update') }}" class="space-y-5">
    @csrf
    @method('put')

    <div>
        <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Password Saat Ini</label>
        <input id="update_password_current_password" name="current_password" type="password"
               autocomplete="current-password"
               class="w-full px-4 py-3 rounded-xl text-sm border dark:bg-ink-800 dark:text-ink-100 focus:outline-none transition-all"
               style="border-color: rgba(0,0,0,0.12);"
               onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
               onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">
        @foreach($errors->updatePassword->get('current_password') as $e)
            <p class="text-xs mt-1 text-red-500">{{ $e }}</p>
        @endforeach
    </div>

    <div>
        <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Password Baru</label>
        <input id="update_password_password" name="password" type="password"
               autocomplete="new-password"
               class="w-full px-4 py-3 rounded-xl text-sm border dark:bg-ink-800 dark:text-ink-100 focus:outline-none transition-all"
               style="border-color: rgba(0,0,0,0.12);"
               onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
               onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">
        @foreach($errors->updatePassword->get('password') as $e)
            <p class="text-xs mt-1 text-red-500">{{ $e }}</p>
        @endforeach
    </div>

    <div>
        <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Konfirmasi Password Baru</label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
               autocomplete="new-password"
               class="w-full px-4 py-3 rounded-xl text-sm border dark:bg-ink-800 dark:text-ink-100 focus:outline-none transition-all"
               style="border-color: rgba(0,0,0,0.12);"
               onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
               onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">
        @foreach($errors->updatePassword->get('password_confirmation') as $e)
            <p class="text-xs mt-1 text-red-500">{{ $e }}</p>
        @endforeach
    </div>

    <div class="flex items-center gap-4 pt-2">
        <button type="submit" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            Ubah Password
        </button>
        @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition
               x-init="setTimeout(() => show = false, 2000)"
               class="text-sm font-medium" style="color: #059669;">✓ Password diperbarui!</p>
        @endif
    </div>
</form>