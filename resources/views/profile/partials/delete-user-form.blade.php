<section x-data="{ confirmOpen: false }">
    <p class="text-sm text-ink-500 dark:text-ink-400 mb-5 leading-relaxed">
        Setelah akun dihapus, semua data termasuk riwayat pengecekan, badge, dan informasi profil akan dihapus secara permanen dan tidak dapat dipulihkan.
    </p>

    <button type="button" @click="confirmOpen = true"
            class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all hover:-translate-y-0.5"
            style="background: rgba(239,68,68,0.10); color: #DC2626; border: 1px solid rgba(239,68,68,0.25);">
        <svg class="w-4 h-4 inline-block mr-1.5 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
        Hapus Akun Saya
    </button>

    {{-- Confirmation Modal --}}
    <div x-show="confirmOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 flex items-center justify-center z-50 px-4"
         style="background: rgba(0,0,0,0.6); backdrop-filter: blur(8px);">

        <div x-show="confirmOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="card p-8 max-w-md w-full" style="border: 1px solid rgba(239,68,68,0.2);">

            {{-- Icon --}}
            <div class="w-14 h-14 rounded-full flex items-center justify-center mb-6 mx-auto"
                 style="background: rgba(239,68,68,0.10);">
                <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>

            <h3 class="font-display font-black text-xl text-center text-ink-900 dark:text-ink-50 mb-2">Hapus Akun?</h3>
            <p class="text-sm text-ink-400 text-center mb-7 leading-relaxed">
                Tindakan ini <span class="font-semibold text-red-500">tidak dapat dibatalkan</span>. Semua data Anda akan dihapus permanen. Masukkan password untuk konfirmasi.
            </p>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-5">
                @csrf
                @method('delete')

                <div>
                    <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Password</label>
                    <input name="password" type="password"
                           placeholder="Masukkan password Anda..."
                           class="w-full px-4 py-3 rounded-xl text-sm border dark:bg-ink-800 dark:text-ink-100 dark:placeholder-ink-500 focus:outline-none transition-all"
                           style="border-color: rgba(239,68,68,0.3);"
                           onfocus="this.style.borderColor='#EF4444'; this.style.boxShadow='0 0 0 3px rgba(239,68,68,0.12)'"
                           onblur="this.style.borderColor='rgba(239,68,68,0.3)'; this.style.boxShadow=''">
                    @foreach($errors->userDeletion->get('password') as $e)
                        <p class="text-xs mt-1 text-red-500">{{ $e }}</p>
                    @endforeach
                </div>

                <div class="flex gap-3">
                    <button type="button" @click="confirmOpen = false" class="btn-secondary flex-1 text-sm">
                        Batal
                    </button>
                    <button type="submit" class="btn-danger flex-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Permanen
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>