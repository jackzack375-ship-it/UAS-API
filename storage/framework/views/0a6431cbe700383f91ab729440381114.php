



<?php $__env->startSection('title', 'Riwayat Pengecekan'); ?>
<?php $__env->startSection('content'); ?>

<div class="space-y-6">
    <div>
        <div class="section-label mb-3">Akun Saya</div>
        <h1 class="font-display text-2xl md:text-3xl font-black text-ink-900 dark:text-ink-50">Riwayat Pengecekan</h1>
        <p class="text-sm text-ink-400 mt-1">Semua berita yang pernah Anda verifikasi</p>
    </div>

    
    <div class="hidden md:block card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-elegant">
                <thead>
                    <tr>
                        <th>Judul Berita</th>
                        <th>Status</th>
                        <th class="text-center">Skor</th>
                        <th class="text-right">Tanggal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="max-w-xs lg:max-w-md">
                            <p class="text-sm font-medium text-ink-800 dark:text-ink-100 line-clamp-2"><?php echo e($h->title); ?></p>
                        </td>
                        <td class="whitespace-nowrap">
                            <span class="badge badge-<?php echo e($h->status === 'hoax' ? 'hoax' : ($h->status === 'valid' ? 'valid' : 'verify')); ?>">
                                <?php echo e($h->status === 'perlu verifikasi' ? 'Perlu Verifikasi' : ucfirst($h->status)); ?>

                            </span>
                        </td>
                        <td class="text-center whitespace-nowrap">
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full text-xs font-bold font-mono"
                                  style="
                                    background: <?php echo e($h->validity_score >= 70 ? 'rgba(16,185,129,0.12)' : ($h->validity_score >= 40 ? 'rgba(245,158,11,0.12)' : 'rgba(239,68,68,0.12)')); ?>;
                                    color: <?php echo e($h->validity_score >= 70 ? '#059669' : ($h->validity_score >= 40 ? '#B45309' : '#DC2626')); ?>;
                                    border: 1px solid <?php echo e($h->validity_score >= 70 ? 'rgba(16,185,129,0.25)' : ($h->validity_score >= 40 ? 'rgba(245,158,11,0.25)' : 'rgba(239,68,68,0.25)')); ?>;
                                  ">
                                <?php echo e($h->validity_score); ?>

                            </span>
                        </td>
                        <td class="text-right whitespace-nowrap">
                            <p class="text-sm text-ink-600 dark:text-ink-300"><?php echo e($h->created_at->format('d M Y')); ?></p>
                            <p class="text-xs font-mono text-ink-400"><?php echo e($h->created_at->format('H:i')); ?></p>
                        </td>
                        <td class="text-right whitespace-nowrap">
                            <a href="<?php echo e(route('hoax.result', $h->id)); ?>"
                               class="text-sm font-semibold transition-colors" style="color: var(--gold);">
                                Detail →
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t" style="border-color: rgba(0,0,0,0.06);">
            <?php echo e($histories->links()); ?>

        </div>
    </div>

    
    <div class="md:hidden space-y-4">
        <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card p-5">
            <div class="flex justify-between items-start mb-3">
                <span class="badge badge-<?php echo e($h->status === 'hoax' ? 'hoax' : ($h->status === 'valid' ? 'valid' : 'verify')); ?>">
                    <?php echo e($h->status === 'perlu verifikasi' ? 'Perlu Verifikasi' : ucfirst($h->status)); ?>

                </span>
                <span class="text-xs font-mono text-ink-400"><?php echo e($h->created_at->format('d M Y H:i')); ?></span>
            </div>
            <p class="text-sm font-semibold text-ink-900 dark:text-ink-50 line-clamp-2 mb-4"><?php echo e($h->title); ?></p>
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="text-xs text-ink-400">Skor:</span>
                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-bold font-mono"
                          style="
                            background: <?php echo e($h->validity_score >= 70 ? 'rgba(16,185,129,0.12)' : ($h->validity_score >= 40 ? 'rgba(245,158,11,0.12)' : 'rgba(239,68,68,0.12)')); ?>;
                            color: <?php echo e($h->validity_score >= 70 ? '#059669' : ($h->validity_score >= 40 ? '#B45309' : '#DC2626')); ?>;
                          ">
                        <?php echo e($h->validity_score); ?>

                    </span>
                </div>
                <a href="<?php echo e(route('hoax.result', $h->id)); ?>"
                   class="text-sm font-semibold" style="color: var(--gold);">Detail →</a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="mt-4"><?php echo e($histories->links()); ?></div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laporan Tugas Kuliah\SEMESTER 4\Pemrograman Web Lanjut\hoaxchecker\resources\views/history/index.blade.php ENDPATH**/ ?>