



<?php $__env->startSection('title', $education->title); ?>
<?php $__env->startSection('content'); ?>

<div class="max-w-3xl mx-auto">
    
    <div class="flex items-center gap-2 text-sm text-ink-400 mb-6">
        <a href="<?php echo e(route('education.index')); ?>" class="hover:text-ink-700 dark:hover:text-ink-200 transition-colors">Edukasi</a>
        <span>/</span>
        <span class="text-ink-700 dark:text-ink-200 truncate"><?php echo e(Str::limit($education->title, 40)); ?></span>
    </div>

    <article class="card overflow-hidden">
        
        <div class="h-1" style="background: linear-gradient(90deg, #D4AF37, #F0D060);"></div>

        <div class="p-8 md:p-10">
            
            <div class="flex items-center gap-3 mb-5">
                <span class="text-xs font-semibold px-3 py-1 rounded-full"
                      style="background: rgba(212,175,55,0.12); color: #B45309; border: 1px solid rgba(212,175,55,0.25);">
                    <?php echo e($education->category); ?>

                </span>
                <div class="flex items-center gap-1.5 text-xs text-ink-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <?php echo e(number_format($education->views)); ?> views
                </div>
            </div>

            
            <h1 class="font-display text-3xl md:text-4xl font-black text-ink-900 dark:text-ink-50 mb-6 leading-tight">
                <?php echo e($education->title); ?>

            </h1>

            
            <?php if($education->youtube_url): ?>
            <div class="rounded-xl overflow-hidden mb-8 border" style="border-color: rgba(0,0,0,0.08);">
                <div style="position: relative; padding-bottom: 56.25%; height: 0;">
                    <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                            src="https://www.youtube.com/embed/<?php echo e($education->youtube_url); ?>"
                            frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <?php endif; ?>

            
            <div class="border-t mb-8" style="border-color: rgba(0,0,0,0.06);"></div>

            
            <div class="prose prose-lg max-w-none" style="
                --tw-prose-body: #3A3A3A;
                --tw-prose-headings: #1A1A1A;
                --tw-prose-links: #D4AF37;
                color: var(--tw-prose-body);
                line-height: 1.8;
                font-size: 1rem;
            ">
                <?php echo nl2br(e($education->content)); ?>

            </div>

            
            <div class="mt-10 pt-6 border-t flex items-center justify-between" style="border-color: rgba(0,0,0,0.06);">
                <a href="<?php echo e(route('education.index')); ?>" class="btn-secondary text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                    Kembali ke Edukasi
                </a>
                <a href="<?php echo e(route('hoax.check')); ?>" class="btn-primary text-sm">
                    Cek Berita Sekarang
                </a>
            </div>
        </div>
    </article>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laporan Tugas Kuliah\SEMESTER 4\Pemrograman Web Lanjut\hoaxchecker\resources\views/education/show.blade.php ENDPATH**/ ?>