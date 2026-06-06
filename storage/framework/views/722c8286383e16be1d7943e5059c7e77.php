
<?php $__env->startSection('title', 'Lapor Berita - HoaxChecker Indonesia'); ?>
<?php $__env->startSection('content'); ?>

<div class="max-w-2xl mx-auto">

    
    <div class="text-center mb-10">
        
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-5"
             style="background: rgba(239,68,68,0.10); color: #DC2626; border: 1px solid rgba(239,68,68,0.25);">
            ⚑ Laporan Hoaks
        </div>
        <h1 class="font-display text-4xl md:text-5xl font-black text-ink-900 dark:text-ink-50 mb-4">
            Lapor <span class="text-gradient-danger">Berita Hoaks</span>
        </h1>
        <p class="text-ink-500 dark:text-ink-400 max-w-lg mx-auto leading-relaxed">
            Temukan berita yang mencurigakan? Laporkan ke tim kami untuk ditindaklanjuti dan membantu komunitas terbebas dari misinformasi.
        </p>
    </div>

    
    <div class="flex items-start gap-4 p-5 rounded-2xl mb-8"
         style="background: rgba(239,68,68,0.06); border: 1px solid rgba(239,68,68,0.20);">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
             style="background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.25);">
            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-sm font-semibold text-red-700 dark:text-red-400 mb-1">Panduan Pelaporan</p>
            <p class="text-xs text-red-600 dark:text-red-500 leading-relaxed">
                Laporan akan ditinjau oleh tim moderator dalam <strong>1×24 jam</strong>. 
                Pastikan informasi yang Anda berikan akurat untuk mempercepat proses verifikasi.
            </p>
        </div>
    </div>

    
    <div class="card rounded-2xl overflow-hidden" style="border: 1px solid rgba(212,175,55,0.15);">

        
        <div class="h-1.5" style="background: linear-gradient(90deg, #DC2626 0%, #D4AF37 50%, #DC2626 100%);"></div>

        <div class="p-8">

            <?php if(session('success')): ?>
            <div class="mb-6 p-4 rounded-2xl flex items-center gap-3"
                 style="background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.25);">
                <svg class="w-5 h-5 flex-shrink-0 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                </svg>
                <p class="text-sm font-medium text-emerald-700 dark:text-emerald-400"><?php echo e(session('success')); ?></p>
            </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
            <div class="mb-6 p-4 rounded-2xl" style="background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.25);">
                <p class="text-sm font-semibold text-red-700 dark:text-red-400 mb-2">Periksa kembali form Anda:</p>
                <ul class="text-xs text-red-600 dark:text-red-400 space-y-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>• <?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('report.store')); ?>" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>

                
                <div>
                    <label for="title" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">
                        Judul Berita <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-ink-400">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="<?php echo e(old('title')); ?>"
                            required
                            placeholder="Masukkan judul berita yang dilaporkan"
                            class="gold-input w-full pl-11 pr-4 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 placeholder-ink-400 focus:outline-none transition-all duration-200"
                        />
                    </div>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1.5 text-xs text-red-500"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label for="source_url" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">
                        URL Sumber Berita <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-ink-400">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </div>
                        <input
                            type="url"
                            name="source_url"
                            id="source_url"
                            value="<?php echo e(old('source_url')); ?>"
                            required
                            placeholder="https://sumber-berita.com/artikel-hoaks"
                            class="gold-input w-full pl-11 pr-4 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 placeholder-ink-400 focus:outline-none transition-all duration-200"
                        />
                    </div>
                    <?php $__errorArgs = ['source_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1.5 text-xs text-red-500"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label for="content" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">
                        Isi Berita / Klaim <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        name="content"
                        id="content"
                        rows="5"
                        required
                        placeholder="Salin isi berita atau klaim yang dianggap hoaks..."
                        class="gold-input w-full px-4 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 placeholder-ink-400 focus:outline-none transition-all duration-200 resize-none leading-relaxed"
                    ><?php echo e(old('content')); ?></textarea>
                    <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1.5 text-xs text-red-500"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label for="category" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-ink-400 pointer-events-none">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <select
                            name="category"
                            id="category"
                            required
                            class="gold-input w-full pl-11 pr-4 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 focus:outline-none transition-all duration-200 appearance-none"
                        >
                            <option value="" disabled <?php echo e(!old('category') ? 'selected' : ''); ?>>Pilih kategori...</option>
                            <?php $__currentLoopData = ['Politik', 'Kesehatan', 'Teknologi', 'Bencana Alam', 'Sosial & Budaya', 'Ekonomi', 'Agama', 'Lainnya']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat); ?>" <?php echo e(old('category') === $cat ? 'selected' : ''); ?>><?php echo e($cat); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-ink-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1.5 text-xs text-red-500"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-3">
                        Tingkat Urgensi
                    </label>
                    <div class="grid grid-cols-3 gap-3">
                        <?php $__currentLoopData = [
                            ['low', 'Rendah', '📢', 'rgba(16,185,129,0.10)', 'rgba(16,185,129,0.30)', '#059669'],
                            ['medium', 'Sedang', '⚠️', 'rgba(245,158,11,0.10)', 'rgba(245,158,11,0.30)', '#B45309'],
                            ['high', 'Tinggi', '🚨', 'rgba(239,68,68,0.10)', 'rgba(239,68,68,0.30)', '#DC2626'],
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$val, $label, $icon, $bg, $border, $color]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="cursor-pointer">
                            <input type="radio" name="urgency" value="<?php echo e($val); ?>" class="sr-only peer" <?php echo e(old('urgency', 'medium') === $val ? 'checked' : ''); ?>>
                            <div class="urgency-card flex flex-col items-center gap-1.5 p-4 rounded-xl text-center transition-all duration-200 cursor-pointer border-2"
                                 style="border-color: rgba(0,0,0,0.08);"
                                 data-bg="<?php echo e($bg); ?>" data-border="<?php echo e($border); ?>" data-color="<?php echo e($color); ?>">
                                <span class="text-xl"><?php echo e($icon); ?></span>
                                <span class="text-xs font-bold" style="color: <?php echo e($color); ?>;"><?php echo e($label); ?></span>
                            </div>
                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
                <div>
                    <label for="evidence" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">
                        Bukti Tambahan <span class="font-normal text-ink-400">(screenshot / gambar, opsional)</span>
                    </label>
                    <label for="evidence"
                           class="flex flex-col items-center justify-center gap-3 px-6 py-8 rounded-xl cursor-pointer transition-all duration-200 hover:scale-[1.01]"
                           style="background: rgba(0,0,0,0.02); border: 2px dashed rgba(0,0,0,0.12);"
                           id="dropZone">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                             style="background: rgba(212,175,55,0.10); border: 1px solid rgba(212,175,55,0.20);">
                            <svg class="w-6 h-6" style="color: var(--gold);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                        </div>
                        <div class="text-center">
                            <p class="text-sm font-semibold text-ink-700 dark:text-ink-200">Klik untuk upload atau drag & drop</p>
                            <p class="text-xs text-ink-400 mt-1">PNG, JPG, PDF hingga 5MB</p>
                        </div>
                        <span id="fileName" class="text-xs font-mono text-ink-500 hidden"></span>
                        <input type="file" name="evidence" id="evidence" class="sr-only" accept="image/*,.pdf"
                               onchange="showFileName(this)">
                    </label>
                    <?php $__errorArgs = ['evidence'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1.5 text-xs text-red-500"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label for="description" class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">
                        Keterangan Tambahan <span class="font-normal text-ink-400">(opsional)</span>
                    </label>
                    <textarea
                        name="description"
                        id="description"
                        rows="3"
                        placeholder="Ceritakan mengapa Anda curiga berita ini adalah hoaks..."
                        class="gold-input w-full px-4 py-3.5 rounded-xl text-ink-800 dark:text-ink-100 placeholder-ink-400 focus:outline-none transition-all duration-200 resize-none"
                    ><?php echo e(old('description')); ?></textarea>
                </div>

                
                <div class="h-px" style="background: linear-gradient(90deg, transparent, rgba(239,68,68,0.20), rgba(212,175,55,0.20), transparent);"></div>

                
                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    
                    <button type="submit" id="submitBtn"
                            class="flex-1 inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-xl font-bold text-white transition-all duration-300 hover:scale-105"
                            style="background: linear-gradient(135deg, #DC2626 0%, #B91C1C 50%, #991B1B 100%); box-shadow: 0 8px 32px rgba(220,38,38,0.25);"
                            onmouseover="this.style.boxShadow='0 12px 40px rgba(220,38,38,0.40)'"
                            onmouseout="this.style.boxShadow='0 8px 32px rgba(220,38,38,0.25)'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                        </svg>
                        <span id="btnText">Kirim Laporan</span>
                    </button>
                    <a href="<?php echo e(route('hoax.check')); ?>" class="btn-secondary px-6 py-3.5 text-sm text-center">
                        Batal
                    </a>
                </div>

                
                <p class="text-xs text-center text-ink-400 leading-relaxed">
                    🔒 Laporan Anda bersifat anonim dan hanya digunakan untuk keperluan verifikasi berita.
                    Laporan palsu dapat dikenakan sanksi.
                </p>
            </form>
        </div>
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
    .dark .gold-input option { background: #1A1A1A; }

    /* Urgency card checked state */
    input[type="radio"].sr-only:checked + .urgency-card {
        transform: scale(1.03);
    }

    /* Drop zone hover */
    #dropZone:hover {
        border-color: #D4AF37 !important;
        background: rgba(212,175,55,0.04) !important;
    }
    .dark #dropZone {
        background: rgba(255,255,255,0.02) !important;
        border-color: rgba(255,255,255,0.10) !important;
    }
    .dark #dropZone:hover {
        border-color: #D4AF37 !important;
    }
</style>

<script>
    // Urgency card selection styling
    document.querySelectorAll('input[name="urgency"]').forEach(function(radio) {
        function updateCard(r) {
            const card = r.nextElementSibling;
            if (r.checked) {
                card.style.borderColor = card.dataset.border;
                card.style.background = card.dataset.bg;
            } else {
                card.style.borderColor = 'rgba(0,0,0,0.08)';
                card.style.background = 'transparent';
            }
        }
        radio.addEventListener('change', function() {
            document.querySelectorAll('input[name="urgency"]').forEach(updateCard);
        });
        updateCard(radio);
    });

    function showFileName(input) {
        const label = document.getElementById('fileName');
        if (input.files && input.files[0]) {
            label.textContent = '📎 ' + input.files[0].name;
            label.classList.remove('hidden');
        }
    }

    document.querySelector('form').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        document.getElementById('btnText').textContent = 'Mengirim...';
        btn.style.opacity = '0.8';
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laporan Tugas Kuliah\SEMESTER 4\Pemrograman Web Lanjut\hoaxchecker\resources\views/report/create.blade.php ENDPATH**/ ?>