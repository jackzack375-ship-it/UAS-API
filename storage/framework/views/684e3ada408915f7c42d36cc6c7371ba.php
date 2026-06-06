
<?php $__env->startSection('title', 'Hasil Analisis — HoaxChecker'); ?>
<?php $__env->startSection('content'); ?>

<div class="max-w-3xl mx-auto">

    <?php
        $status      = $history->status;                              // 'hoax' | 'valid' | 'perlu verifikasi'
        $score       = $history->validity_score ?? 0;                 // 0–100
        $isHoax      = $status === 'hoax';
        $isValid     = $status === 'valid';
        $accent      = $isHoax ? '#EF4444' : ($isValid ? '#10B981' : '#F59E0B');
        $accentLight = $isHoax ? '#FCA5A5' : ($isValid ? '#6EE7B7' : '#FCD34D');
        $badgeClass  = $isHoax ? 'badge-hoax' : ($isValid ? 'badge-valid' : 'badge-verify');
        $verdict     = $isHoax ? 'HOAKS' : ($isValid ? 'VALID' : 'PERLU VERIFIKASI');
        $emoji       = $isHoax ? '⚠' : ($isValid ? '✓' : '?');
        $check       = $history->hoaxCheck;
        $clickbait   = $check->clickbait_score ?? 0;
        $provokasi   = $check->provocation_score ?? 0;
        $kredibilitas= $check->source_credibility ?? (100 - ($clickbait + $provokasi) / 2);
        $summary     = $check->summary ?? null;
    ?>

    
    <div class="flex items-center gap-2 text-sm text-ink-400 mb-6">
        <a href="<?php echo e(route('hoax.check')); ?>" class="hover:text-ink-700 dark:hover:text-ink-200 transition-colors flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Cek Hoaks
        </a>
        <span>/</span>
        <span class="text-ink-700 dark:text-ink-200">Hasil Analisis</span>
    </div>

    
    <div class="relative rounded-2xl overflow-hidden p-8 mb-6 text-center"
         style="background: linear-gradient(135deg, #0D0D0D, #1A1A1A); border: 1px solid <?php echo e($accent); ?>30;">
        <div class="absolute top-0 left-0 right-0 h-px"
             style="background: linear-gradient(90deg, transparent, <?php echo e($accent); ?>, transparent);"></div>
        <div class="absolute bottom-0 left-0 right-0 h-px"
             style="background: linear-gradient(90deg, transparent, <?php echo e($accent); ?>50, transparent);"></div>

        
        <div class="w-20 h-20 rounded-2xl flex items-center justify-center text-4xl mx-auto mb-5"
             style="background: <?php echo e($accent); ?>20; border: 2px solid <?php echo e($accent); ?>35;">
            <?php echo e($emoji); ?>

        </div>

        <p class="text-xs font-mono mb-2 uppercase tracking-widest" style="color: <?php echo e($accent); ?>;">
            Hasil Verifikasi AI
        </p>
        <h1 class="font-display text-5xl md:text-6xl font-black mb-3" style="color: <?php echo e($accent); ?>;">
            <?php echo e($verdict); ?>

        </h1>
        <p class="text-ink-400 text-sm max-w-sm mx-auto leading-relaxed">
            <?php if($isHoax): ?>
                Berita ini terindikasi kuat mengandung informasi yang tidak benar atau menyesatkan.
            <?php elseif($isValid): ?>
                Berita ini terverifikasi valid berdasarkan analisis konten dan sumber oleh AI.
            <?php else: ?>
                Berita ini memerlukan verifikasi lebih lanjut dari sumber terpercaya.
            <?php endif; ?>
        </p>
        <p class="text-xs font-mono mt-4" style="color: #555555;">
            <?php echo e($history->created_at->format('d M Y • H:i')); ?> WIB
        </p>
    </div>

    
    <div class="grid grid-cols-3 gap-4 mb-6">
        <?php $__currentLoopData = [
            ['Validitas', $score,       '#D4AF37', '/100', 'Skor validitas berita'],
            ['Clickbait', $clickbait,   '#F59E0B', '%',    'Indikasi clickbait'],
            ['Provokasi', $provokasi,   '#EF4444', '%',    'Tingkat provokasi'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $val, $col, $unit, $tooltip]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card p-5 text-center group" title="<?php echo e($tooltip); ?>">
            <p class="text-xs font-semibold text-ink-400 mb-3 uppercase tracking-wider"><?php echo e($label); ?></p>
            <div class="font-display font-black text-4xl leading-none mb-1" style="color: <?php echo e($col); ?>;">
                <?php echo e($val); ?>

            </div>
            <p class="text-xs text-ink-400 font-mono mb-3"><?php echo e($unit); ?></p>
            <div class="h-1.5 rounded-full" style="background: rgba(0,0,0,0.08);">
                <div class="h-full rounded-full transition-all duration-700"
                     style="width: <?php echo e(min(100, $val)); ?>%; background: <?php echo e($col); ?>;"></div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="card overflow-hidden mb-6">
        <div class="h-1.5" style="background: linear-gradient(90deg, <?php echo e($accent); ?>, <?php echo e($accentLight); ?>);"></div>

        <div class="p-8 space-y-6">

            
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-semibold text-ink-700 dark:text-ink-300">Tingkat Kepercayaan</span>
                    <span class="text-2xl font-black font-mono" style="color: <?php echo e($accent); ?>;"><?php echo e($score); ?>%</span>
                </div>
                <div class="h-4 rounded-full overflow-hidden" style="background: rgba(0,0,0,0.08);">
                    <div class="h-full rounded-full relative overflow-hidden transition-all duration-1000"
                         style="width: <?php echo e($score); ?>%; background: linear-gradient(90deg, <?php echo e($accent); ?>, <?php echo e($accentLight); ?>);">
                        <div class="absolute inset-0"
                             style="background: repeating-linear-gradient(45deg, transparent, transparent 4px, rgba(255,255,255,0.12) 4px, rgba(255,255,255,0.12) 8px);"></div>
                    </div>
                </div>
                <div class="flex justify-between text-xs text-ink-300 mt-1.5 font-mono">
                    <span>0 — Hoaks</span>
                    <span>50 — Tidak Jelas</span>
                    <span>100 — Valid</span>
                </div>
            </div>

            
            <div class="p-4 rounded-xl" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.07);">
                <p class="text-xs font-semibold text-ink-400 mb-1.5 uppercase tracking-wider flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    Berita yang Dianalisis
                </p>
                <p class="text-sm font-semibold text-ink-800 dark:text-ink-100 leading-relaxed">
                    <?php echo e($history->title); ?>

                </p>
                <?php if($history->url): ?>
                <a href="<?php echo e($history->url); ?>" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-1 text-xs mt-2 transition-colors"
                   style="color: var(--gold);">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat sumber asli
                </a>
                <?php endif; ?>
            </div>

            
            <?php if($summary): ?>
            <div>
                <h3 class="text-sm font-bold text-ink-800 dark:text-ink-100 mb-3 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg flex items-center justify-center text-base"
                          style="background: rgba(212,175,55,0.15);">🤖</span>
                    Ringkasan Analisis AI (Groq)
                </h3>
                <div class="p-5 rounded-xl text-sm text-ink-700 dark:text-ink-300 leading-relaxed"
                     style="background: rgba(212,175,55,0.05); border: 1px solid rgba(212,175,55,0.15);">
                    <?php echo e($summary); ?>

                </div>
            </div>
            <?php else: ?>
            
            <div class="p-4 rounded-xl text-sm text-ink-400" style="background: rgba(0,0,0,0.03); border: 1px dashed rgba(0,0,0,0.10);">
                <p class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Ringkasan AI tidak tersedia untuk analisis ini.
                </p>
            </div>
            <?php endif; ?>

            
            <?php
                $checks = [
                    ['Validitas berita tinggi',           $score >= 70],
                    ['Tidak terindikasi clickbait',        $clickbait < 50],
                    ['Tidak mengandung provokasi berlebih', $provokasi < 50],
                    ['Kredibilitas sumber memadai',        $kredibilitas >= 50],
                ];
            ?>
            <div>
                <h3 class="text-sm font-bold text-ink-800 dark:text-ink-100 mb-3 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg flex items-center justify-center text-base"
                          style="background: rgba(212,175,55,0.15);">📋</span>
                    Ringkasan Pemeriksaan
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <?php $__currentLoopData = $checks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $pass]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center gap-3 p-3 rounded-xl"
                         style="background: <?php echo e($pass ? 'rgba(16,185,129,0.06)' : 'rgba(239,68,68,0.06)'); ?>; border: 1px solid <?php echo e($pass ? 'rgba(16,185,129,0.18)' : 'rgba(239,68,68,0.18)'); ?>;">
                        <div class="w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0"
                             style="background: <?php echo e($pass ? 'rgba(16,185,129,0.15)' : 'rgba(239,68,68,0.15)'); ?>;">
                            <?php if($pass): ?>
                                <svg class="w-3.5 h-3.5" style="color:#10B981;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                </svg>
                            <?php else: ?>
                                <svg class="w-3.5 h-3.5" style="color:#EF4444;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"/>
                                </svg>
                            <?php endif; ?>
                        </div>
                        <span class="text-xs font-medium text-ink-700 dark:text-ink-300"><?php echo e($label); ?></span>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

        </div>
    </div>

    
    <div class="flex flex-col sm:flex-row gap-3">
        <a href="<?php echo e(route('hoax.check')); ?>" class="btn-primary flex-1 justify-center py-3.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Cek Berita Lain
        </a>
        <a href="<?php echo e(route('report.create')); ?>" class="btn-secondary flex-1 justify-center py-3.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
            </svg>
            Laporkan Berita Ini
        </a>
        <a href="<?php echo e(route('history.index')); ?>" class="btn-secondary px-6 py-3.5 justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Riwayat
        </a>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laporan Tugas Kuliah\SEMESTER 4\Pemrograman Web Lanjut\hoaxchecker\resources\views/hoax/result.blade.php ENDPATH**/ ?>