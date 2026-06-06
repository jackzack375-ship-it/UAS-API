
<?php $__env->startSection('title', 'Verifikator Dashboard'); ?>
<?php $__env->startSection('content'); ?>

<div class="space-y-6">

    
    <div class="relative rounded-2xl overflow-hidden p-8 md:p-10"
         style="background: linear-gradient(135deg, #0D0D0D 0%, #1A1A1A 100%);">
        <div class="absolute top-0 left-0 right-0 h-px"
             style="background: linear-gradient(90deg, transparent, #D4AF37, transparent);"></div>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-5">
            <div>
                <p class="text-xs font-mono mb-2" style="color: #D4AF37; letter-spacing: 0.1em;">PANEL VERIFIKATOR</p>
                <h1 class="font-display text-3xl md:text-4xl font-black text-white mb-1">Verifikasi Laporan</h1>
                <p class="text-ink-400 text-sm">Tinjau dan validasi laporan berita dari pengguna</p>
            </div>
            <div class="px-5 py-3 rounded-xl flex-shrink-0"
                 style="background: rgba(245,158,11,0.15); border: 1px solid rgba(245,158,11,0.3);">
                <p class="text-xs text-ink-400 mb-0.5">Menunggu</p>
                <p class="font-display font-bold text-2xl" style="color: #F59E0B;"><?php echo e($reports->total()); ?></p>
                <p class="text-xs" style="color: #F59E0B;">laporan</p>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
    <div class="flex items-center gap-3 p-4 rounded-xl"
         style="background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.25);">
        <svg class="w-5 h-5 flex-shrink-0" style="color:#10B981;" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
        </svg>
        <p class="text-sm font-medium" style="color:#059669;"><?php echo e(session('success')); ?></p>
    </div>
    <?php endif; ?>

    
    <div class="hidden md:block card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-elegant">
                <thead>
                    <tr>
                        <th class="w-1/4">Judul & Sumber</th>
                        <th>Pelapor</th>
                        <th>Kategori & Urgensi</th>
                        <th>Isi Laporan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $desc    = $report->description ?? '';
                        $srcUrl  = null; $cat = null; $urgency = null;
                        $content = null; $keterangan = null;

                        if (preg_match('/URL Sumber:\s*(.+)/i', $desc, $m))      $srcUrl     = trim($m[1]);
                        if (preg_match('/Kategori:\s*(.+)/i', $desc, $m))        $cat        = trim($m[1]);
                        if (preg_match('/Urgensi:\s*(.+)/i', $desc, $m))         $urgency    = trim($m[1]);
                        if (preg_match('/Isi Berita:\s*([\s\S]+?)(?:\n\n|$)/i', $desc, $m))          $content    = trim($m[1]);
                        if (preg_match('/Keterangan Tambahan:\s*([\s\S]+?)(?:\n\n|$)/i', $desc, $m)) $keterangan = trim($m[1]);

                        $uc = match(strtolower($urgency ?? '')) {
                            'tinggi' => ['#EF4444','rgba(239,68,68,0.12)','rgba(239,68,68,0.25)','🚨'],
                            'sedang' => ['#F59E0B','rgba(245,158,11,0.12)','rgba(245,158,11,0.25)','⚠️'],
                            default  => ['#10B981','rgba(16,185,129,0.12)','rgba(16,185,129,0.25)','📢'],
                        };
                    ?>
                    <tr>
                        <td>
                            <p class="text-sm font-semibold text-ink-800 dark:text-ink-100 line-clamp-2 mb-1"><?php echo e($report->title); ?></p>
                            <?php if($srcUrl): ?>
                            <a href="<?php echo e($srcUrl); ?>" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-1 text-xs transition-colors" style="color:var(--gold);">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Lihat sumber
                            </a>
                            <?php endif; ?>
                            <p class="text-xs text-ink-400 mt-1"><?php echo e($report->created_at->diffForHumans()); ?></p>
                        </td>

                        <td class="whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-ink-900 flex-shrink-0"
                                     style="background: linear-gradient(135deg,#D4AF37,#F0D060);">
                                    <?php echo e(strtoupper(substr($report->user->name ?? 'U', 0, 1))); ?>

                                </div>
                                <div>
                                    <p class="text-sm font-medium text-ink-700 dark:text-ink-300"><?php echo e($report->user->name ?? 'Unknown'); ?></p>
                                    <p class="text-xs text-ink-400"><?php echo e($report->user->email ?? ''); ?></p>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="space-y-1.5">
                                <?php if($cat): ?>
                                <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full"
                                      style="background:rgba(212,175,55,0.10); color:#B45309; border:1px solid rgba(212,175,55,0.25);">
                                    <?php echo e($cat); ?>

                                </span>
                                <?php endif; ?>
                                <?php if($urgency): ?>
                                <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full"
                                      style="color:<?php echo e($uc[0]); ?>; background:<?php echo e($uc[1]); ?>; border:1px solid <?php echo e($uc[2]); ?>;">
                                    <?php echo e($uc[3]); ?> <?php echo e($urgency); ?>

                                </span>
                                <?php endif; ?>
                                <?php if(!$cat && !$urgency): ?><span class="text-xs text-ink-400">—</span><?php endif; ?>
                            </div>
                        </td>

                        <td class="max-w-xs" x-data="{ open: false }">
                            <?php if($content || $keterangan): ?>
                            <button @click="open = !open"
                                    class="text-xs font-semibold flex items-center gap-1 mb-1 transition-colors" style="color:var(--gold);">
                                <svg :class="open && 'rotate-180'" class="w-3.5 h-3.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                                <span x-text="open ? 'Sembunyikan' : 'Lihat detail'"></span>
                            </button>
                            <div x-show="open" x-transition class="space-y-2 mt-1">
                                <?php if($content): ?>
                                <div class="p-2.5 rounded-lg text-xs text-ink-600 dark:text-ink-400 leading-relaxed"
                                     style="background:rgba(0,0,0,0.03); border:1px solid rgba(0,0,0,0.06); max-height:100px; overflow-y:auto;">
                                    <?php echo e(Str::limit($content, 250)); ?>

                                </div>
                                <?php endif; ?>
                                <?php if($keterangan): ?>
                                <div class="p-2.5 rounded-lg text-xs text-ink-500 dark:text-ink-400 leading-relaxed italic"
                                     style="background:rgba(212,175,55,0.04); border:1px solid rgba(212,175,55,0.10);">
                                    "<?php echo e(Str::limit($keterangan, 150)); ?>"
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php else: ?>
                                <span class="text-xs text-ink-400">Tidak ada detail</span>
                            <?php endif; ?>
                        </td>

                        <td class="text-center whitespace-nowrap">
                            <span class="badge badge-<?php echo e($report->status === 'pending' ? 'verify' : ($report->status === 'valid' ? 'valid' : 'hoax')); ?>">
                                <?php echo e($report->status === 'pending' ? '⏳ Pending' : ($report->status === 'valid' ? '✓ Valid' : '✗ Hoaks')); ?>

                            </span>
                            <?php if($report->reviewed_at): ?>
                            <p class="text-xs text-ink-400 mt-1"><?php echo e(\Carbon\Carbon::parse($report->reviewed_at)->diffForHumans()); ?></p>
                            <?php endif; ?>
                        </td>

                        <td class="text-center whitespace-nowrap">
                            <?php if($report->status === 'pending'): ?>
                            <div class="flex justify-center gap-2">
                                <form method="POST" action="<?php echo e(route('verifikator.report.update', $report->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="status" value="valid">
                                    <button type="submit"
                                            class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all hover:-translate-y-0.5"
                                            style="background:rgba(16,185,129,0.12); color:#10B981; border:1px solid rgba(16,185,129,0.3);"
                                            onclick="return confirm('Tandai sebagai VALID?')">
                                        ✓ Valid
                                    </button>
                                </form>
                                <form method="POST" action="<?php echo e(route('verifikator.report.update', $report->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="status" value="hoax">
                                    <button type="submit"
                                            class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all hover:-translate-y-0.5"
                                            style="background:rgba(239,68,68,0.12); color:#EF4444; border:1px solid rgba(239,68,68,0.3);"
                                            onclick="return confirm('Tandai sebagai HOAKS?')">
                                        ✗ Hoaks
                                    </button>
                                </form>
                            </div>
                            <?php else: ?>
                            <span class="text-xs text-ink-400">Selesai</span>
                            <?php if(isset($report->verifikator) && $report->verifikator): ?>
                            <p class="text-xs text-ink-300 mt-0.5">oleh <?php echo e($report->verifikator->name); ?></p>
                            <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="py-20 text-center">
                            <div class="text-5xl mb-4">🎉</div>
                            <p class="font-display font-bold text-lg text-ink-700 dark:text-ink-200 mb-1">Tidak ada laporan menunggu</p>
                            <p class="text-sm text-ink-400">Semua laporan sudah ditinjau. Kerja bagus!</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t" style="border-color:rgba(0,0,0,0.06);">
            <?php echo e($reports->links()); ?>

        </div>
    </div>

    
    <div class="md:hidden space-y-4">
        <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $desc = $report->description ?? '';
            $srcUrl = null; $cat = null; $urgency = null; $content = null;
            if (preg_match('/URL Sumber:\s*(.+)/i', $desc, $m))   $srcUrl  = trim($m[1]);
            if (preg_match('/Kategori:\s*(.+)/i', $desc, $m))     $cat     = trim($m[1]);
            if (preg_match('/Urgensi:\s*(.+)/i', $desc, $m))      $urgency = trim($m[1]);
            if (preg_match('/Isi Berita:\s*([\s\S]+?)(?:\n\n|$)/i', $desc, $m)) $content = trim($m[1]);
            $uc = match(strtolower($urgency ?? '')) {
                'tinggi' => ['#EF4444','🚨'], 'sedang' => ['#F59E0B','⚠️'], default => ['#10B981','📢'],
            };
        ?>
        <div class="card overflow-hidden">
            <div class="h-1" style="background: <?php echo e($uc[0]); ?>;"></div>
            <div class="p-5">
                <div class="flex justify-between items-start mb-3">
                    <span class="badge badge-<?php echo e($report->status === 'pending' ? 'verify' : ($report->status === 'valid' ? 'valid' : 'hoax')); ?>">
                        <?php echo e($report->status === 'pending' ? '⏳ Pending' : ($report->status === 'valid' ? '✓ Valid' : '✗ Hoaks')); ?>

                    </span>
                    <span class="text-xs text-ink-400"><?php echo e($report->created_at->diffForHumans()); ?></span>
                </div>

                <h3 class="font-semibold text-ink-900 dark:text-ink-50 text-sm leading-snug mb-2"><?php echo e($report->title); ?></h3>

                <div class="flex flex-wrap gap-1.5 mb-3">
                    <?php if($cat): ?>
                    <span class="text-xs px-2 py-0.5 rounded-full"
                          style="background:rgba(212,175,55,0.10); color:#B45309; border:1px solid rgba(212,175,55,0.20);">
                        <?php echo e($cat); ?>

                    </span>
                    <?php endif; ?>
                    <?php if($urgency): ?>
                    <span class="text-xs px-2 py-0.5 rounded-full font-semibold"
                          style="color:<?php echo e($uc[0]); ?>; background:<?php echo e($uc[0]); ?>18; border:1px solid <?php echo e($uc[0]); ?>30;">
                        <?php echo e($uc[1]); ?> <?php echo e($urgency); ?>

                    </span>
                    <?php endif; ?>
                </div>

                <?php if($content): ?>
                <p class="text-xs text-ink-400 leading-relaxed mb-3 line-clamp-2"><?php echo e($content); ?></p>
                <?php endif; ?>

                <?php if($srcUrl): ?>
                <a href="<?php echo e($srcUrl); ?>" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-1 text-xs mb-3 transition-colors" style="color:var(--gold);">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat sumber
                </a>
                <?php endif; ?>

                <div class="flex items-center justify-between pt-3 border-t" style="border-color:rgba(0,0,0,0.06);">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-ink-900"
                             style="background:linear-gradient(135deg,#D4AF37,#F0D060);">
                            <?php echo e(strtoupper(substr($report->user->name ?? 'U', 0, 1))); ?>

                        </div>
                        <span class="text-xs text-ink-500"><?php echo e($report->user->name ?? 'Unknown'); ?></span>
                    </div>
                    <?php if($report->status === 'pending'): ?>
                    <div class="flex gap-2">
                        <form method="POST" action="<?php echo e(route('verifikator.report.update', $report->id)); ?>">
                            <?php echo csrf_field(); ?> <input type="hidden" name="status" value="valid">
                            <button class="px-3 py-1.5 rounded-lg text-xs font-semibold"
                                    style="background:rgba(16,185,129,0.12); color:#10B981; border:1px solid rgba(16,185,129,0.25);">✓ Valid</button>
                        </form>
                        <form method="POST" action="<?php echo e(route('verifikator.report.update', $report->id)); ?>">
                            <?php echo csrf_field(); ?> <input type="hidden" name="status" value="hoax">
                            <button class="px-3 py-1.5 rounded-lg text-xs font-semibold"
                                    style="background:rgba(239,68,68,0.12); color:#EF4444; border:1px solid rgba(239,68,68,0.25);">✗ Hoaks</button>
                        </form>
                    </div>
                    <?php else: ?>
                    <span class="text-xs text-ink-400">Selesai</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="card p-16 text-center">
            <div class="text-5xl mb-4">🎉</div>
            <p class="font-display font-bold text-lg text-ink-700 dark:text-ink-200">Tidak ada laporan</p>
        </div>
        <?php endif; ?>
        <div class="mt-4"><?php echo e($reports->links()); ?></div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laporan Tugas Kuliah\SEMESTER 4\Pemrograman Web Lanjut\hoaxchecker\resources\views/verifikator/dashboard.blade.php ENDPATH**/ ?>