




<?php $__env->startSection('title', isset($education) ? 'Edit Artikel' : 'Tambah Artikel'); ?>
<?php $__env->startSection('content'); ?>

<div class="max-w-2xl mx-auto">
    
    <div class="flex items-center gap-2 text-sm text-ink-400 mb-6">
        <a href="<?php echo e(route('admin.educations.index')); ?>" class="hover:text-ink-700 dark:hover:text-ink-200 transition-colors">Kelola Edukasi</a>
        <span>/</span>
        <span class="text-ink-700 dark:text-ink-200"><?php echo e(isset($education) ? 'Edit Artikel' : 'Tambah Artikel Baru'); ?></span>
    </div>

    <div class="card p-8">
        
        <div class="mb-8 pb-6 border-b" style="border-color: rgba(0,0,0,0.06);">
            <div class="section-label mb-3"><?php echo e(isset($education) ? 'Edit Konten' : 'Konten Baru'); ?></div>
            <h1 class="font-display text-2xl font-black text-ink-900 dark:text-ink-50">
                <?php echo e(isset($education) ? 'Edit Artikel Edukasi' : 'Tambah Artikel Edukasi'); ?>

            </h1>
            <p class="text-sm text-ink-400 mt-1">Isi formulir di bawah untuk <?php echo e(isset($education) ? 'memperbarui' : 'menambah'); ?> artikel edukasi literasi digital.</p>
        </div>

        <form action="<?php echo e(isset($education) ? route('admin.educations.update', $education->id) : route('admin.educations.store')); ?>"
              method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php if(isset($education)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

            
            <?php if($errors->any()): ?>
            <div class="p-4 rounded-xl text-sm" style="background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2); color: #EF4444;">
                <ul class="list-disc list-inside space-y-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endif; ?>

            
            <div>
                <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                <input type="text" name="title" required
                       value="<?php echo e(old('title', $education->title ?? '')); ?>"
                       placeholder="Masukkan judul artikel yang menarik..."
                       class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:outline-none focus:ring-2 dark:bg-ink-800 dark:text-ink-100 dark:placeholder-ink-500"
                       style="border-color: rgba(0,0,0,0.12);"
                       onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
                       onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">
            </div>

            
            <div>
                <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="category" required
                       value="<?php echo e(old('category', $education->category ?? '')); ?>"
                       placeholder="Contoh: Teknik, Analisis, Edukasi..."
                       class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:outline-none dark:bg-ink-800 dark:text-ink-100 dark:placeholder-ink-500"
                       style="border-color: rgba(0,0,0,0.12);"
                       onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
                       onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">
            </div>

            
            <div>
                <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">Konten Artikel <span class="text-red-500">*</span></label>
                <textarea name="content" rows="8" required
                          placeholder="Tulis konten artikel edukasi di sini..."
                          class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:outline-none resize-y dark:bg-ink-800 dark:text-ink-100 dark:placeholder-ink-500"
                          style="border-color: rgba(0,0,0,0.12);"
                          onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
                          onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''"><?php echo e(old('content', $education->content ?? '')); ?></textarea>
            </div>

            
            <div>
                <label class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-1">YouTube Video ID <span class="text-ink-400 font-normal">(opsional)</span></label>
                <p class="text-xs text-ink-400 mb-2">Masukkan ID video YouTube, contoh: <span class="font-mono" style="color: var(--gold);">dQw4w9WgXcQ</span></p>
                <input type="text" name="youtube_url"
                       value="<?php echo e(old('youtube_url', $education->youtube_url ?? '')); ?>"
                       placeholder="Video ID YouTube..."
                       class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:outline-none font-mono dark:bg-ink-800 dark:text-ink-100 dark:placeholder-ink-500"
                       style="border-color: rgba(0,0,0,0.12);"
                       onfocus="this.style.borderColor='#D4AF37'; this.style.boxShadow='0 0 0 3px rgba(212,175,55,0.12)'"
                       onblur="this.style.borderColor='rgba(0,0,0,0.12)'; this.style.boxShadow=''">
            </div>

            
            <div class="flex items-center gap-4 pt-4 border-t" style="border-color: rgba(0,0,0,0.06);">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <?php echo e(isset($education) ? 'Simpan Perubahan' : 'Simpan Artikel'); ?>

                </button>
                <a href="<?php echo e(route('admin.educations.index')); ?>" class="btn-secondary text-sm">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laporan Tugas Kuliah\SEMESTER 4\Pemrograman Web Lanjut\hoaxchecker\resources\views/admin/educations/create.blade.php ENDPATH**/ ?>