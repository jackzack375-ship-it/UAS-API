<?php $__env->startSection('title', 'Dashboard Saya — HoaxChecker'); ?>
<?php $__env->startSection('content'); ?>


<div class="relative rounded-2xl overflow-hidden p-8 md:p-10 mb-8" style="background: linear-gradient(135deg, #0D0D0D 0%, #1A1A1A 100%);">
    
    <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, #D4AF37, transparent);"></div>
    
    <div class="absolute right-8 top-1/2 -translate-y-1/2 hidden md:block opacity-10">
        <svg class="w-32 h-32" fill="currentColor" style="color: #D4AF37;" viewBox="0 0 24 24">
            <path d="M12 2L3.09 8.26L4 21h16l.91-12.74L12 2zm0 2.5l7.5 5L18.4 19H5.6L4.5 9.5 12 4.5zM11 10h2v5h-2zm0 6h2v2h-2z"/>
        </svg>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative">
        <div>
            <p class="text-xs font-mono mb-2" style="color: #D4AF37; letter-spacing: 0.1em;">SELAMAT DATANG KEMBALI</p>
            <h1 class="font-display text-3xl md:text-4xl font-black text-white mb-2">
                <?php echo e(auth()->user()->name); ?>

            </h1>
            <p class="text-ink-400 text-sm">Mari lanjutkan perjalanan Anda dalam melawan hoaks dan misinformasi</p>
        </div>
        <a href="<?php echo e(route('hoax.check')); ?>" class="btn-primary flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Cek Berita Baru
        </a>
    </div>
</div>


<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <?php
        $stats = [
            ['label' => 'Total Pengecekan', 'value' => auth()->user()->newsHistories->count(), 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'color' => '#3B82F6', 'sub' => 'pengecekan total'],
            ['label' => 'Hoaks Terdeteksi', 'value' => auth()->user()->newsHistories->where('status', 'hoax')->count(), 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z', 'color' => '#EF4444', 'sub' => 'berita hoaks ditemukan'],
            ['label' => 'Berita Valid', 'value' => auth()->user()->newsHistories->where('status', 'valid')->count(), 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => '#10B981', 'sub' => 'berita terpercaya'],
            ['label' => 'Badge Anda', 'value' => auth()->user()->badge ?? 'Pemula', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'color' => '#D4AF37', 'sub' => auth()->user()->badge_description ?? 'Mulai perjalananmu', 'is_text' => true],
        ];
    ?>

    <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="card p-5 group">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-semibold text-ink-400 uppercase tracking-wider"><?php echo e($stat['label']); ?></p>
            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-110"
                 style="background: <?php echo e($stat['color']); ?>15; border: 1px solid <?php echo e($stat['color']); ?>25;">
                <svg class="w-4 h-4" style="color: <?php echo e($stat['color']); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($stat['icon']); ?>"/>
                </svg>
            </div>
        </div>
        <div class="stat-number <?php echo e(isset($stat['is_text']) ? 'text-xl' : 'text-3xl'); ?> mb-1" style="color: <?php echo e($stat['color']); ?>;">
            <?php echo e($stat['value']); ?>

        </div>
        <p class="text-xs text-ink-400"><?php echo e($stat['sub']); ?></p>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    
    <div class="lg:col-span-2 space-y-6">

        
        <div class="card p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="font-display font-bold text-lg text-ink-900 dark:text-ink-50">Aktivitas Minggu Ini</h2>
                    <p class="text-xs text-ink-400 mt-0.5">Riwayat pengecekan berita 7 hari terakhir</p>
                </div>
                <span class="section-label text-xs">📈 Live</span>
            </div>
            <div class="relative h-56">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>

        
        <div class="card p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="font-display font-bold text-lg text-ink-900 dark:text-ink-50">Pengecekan Terbaru</h2>
                    <p class="text-xs text-ink-400 mt-0.5">5 pengecekan terakhir Anda</p>
                </div>
                <?php if(auth()->user()->newsHistories()->count() > 0): ?>
                    <a href="<?php echo e(route('history.index')); ?>" class="text-xs font-semibold transition-colors" style="color: var(--gold);">
                        Lihat semua →
                    </a>
                <?php endif; ?>
            </div>

            <?php $recentChecks = auth()->user()->newsHistories()->latest()->take(5)->get(); ?>

            <div class="divide-y" style="--tw-divide-opacity: 1; border-color: rgba(0,0,0,0.04);">
                <?php $__empty_1 = true; $__currentLoopData = $recentChecks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="py-3.5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 -mx-2 px-2 rounded-lg hover:bg-black/02 dark:hover:bg-white/03 transition-colors duration-200">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-ink-800 dark:text-ink-100 truncate text-sm">
                            <?php echo e(Str::limit($check->title, 55)); ?>

                        </p>
                        <p class="text-xs text-ink-400 mt-0.5"><?php echo e($check->created_at->diffForHumans()); ?></p>
                    </div>
                    <div class="flex items-center gap-3 flex-shrink-0">
                        <span class="badge badge-<?php echo e($check->status == 'hoax' ? 'hoax' : ($check->status == 'valid' ? 'valid' : 'verify')); ?>">
                            <?php echo e($check->status == 'hoax' ? '⚠ Hoaks' : ($check->status == 'valid' ? '✓ Valid' : '? Perlu Verifikasi')); ?>

                        </span>
                        <a href="<?php echo e(route('hoax.result', $check->id)); ?>"
                           class="text-xs font-semibold text-ink-400 hover:text-ink-800 dark:hover:text-ink-100 transition-colors">
                            Detail →
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="py-10 text-center">
                    <div class="text-3xl mb-3">🔍</div>
                    <p class="text-sm text-ink-400">Belum ada pengecekan.</p>
                    <a href="<?php echo e(route('hoax.check')); ?>" class="text-sm font-semibold transition-colors" style="color: var(--gold);">Mulai sekarang →</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="space-y-6">

        
        <div class="card p-6">
            <h2 class="font-display font-bold text-lg text-ink-900 dark:text-ink-50 mb-5">Koleksi Badge</h2>

            <?php
                $badges = [
                    ['name' => 'Pemula', 'icon' => '🌟', 'desc' => '0–10 pengecekan', 'unlocked' => true, 'color' => '#10B981'],
                    ['name' => 'Fact Checker', 'icon' => '🔍', 'desc' => '11–50 pengecekan', 'unlocked' => auth()->user()->newsHistories->count() >= 11, 'color' => '#3B82F6'],
                    ['name' => 'Anti Hoaks', 'icon' => '🛡️', 'desc' => '51–100 pengecekan', 'unlocked' => auth()->user()->newsHistories->count() >= 51, 'color' => '#8B5CF6'],
                    ['name' => 'Digital Guardian', 'icon' => '👑', 'desc' => '100+ pengecekan', 'unlocked' => auth()->user()->newsHistories->count() >= 100, 'color' => '#D4AF37'],
                ];
            ?>

            <div class="space-y-3">
                <?php $__currentLoopData = $badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center gap-3 p-3 rounded-xl transition-all duration-200 <?php echo e($badge['unlocked'] ? '' : 'opacity-40'); ?>"
                     style="<?php echo e($badge['unlocked'] ? 'background: ' . $badge['color'] . '10; border: 1px solid ' . $badge['color'] . '25;' : 'background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);'); ?>">
                    <div class="text-2xl w-10 h-10 flex items-center justify-center rounded-lg"
                         style="<?php echo e($badge['unlocked'] ? 'background: ' . $badge['color'] . '20;' : 'background: rgba(0,0,0,0.05);'); ?>">
                        <?php echo e($badge['icon']); ?>

                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-ink-800 dark:text-ink-100"><?php echo e($badge['name']); ?></p>
                        <p class="text-xs text-ink-400"><?php echo e($badge['desc']); ?></p>
                    </div>
                    <?php if($badge['unlocked']): ?>
                    <svg class="w-5 h-5 flex-shrink-0" style="color: <?php echo e($badge['color']); ?>;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                    </svg>
                    <?php else: ?>
                    <svg class="w-5 h-5 flex-shrink-0 text-ink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="card p-6">
            <h2 class="font-display font-bold text-lg text-ink-900 dark:text-ink-50 mb-5">Baca untuk Anda</h2>
            <div class="space-y-3">
                <?php $__currentLoopData = [['Cara Mendeteksi Hoaks', 'Teknik', '🔎', '#3B82F6'], ['Media Literacy 101', 'Edukasi', '📖', '#10B981'], ['Clickbait & Misinformasi', 'Analisis', '⚠️', '#EF4444']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$title, $cat, $icon, $color]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('education.index')); ?>"
                   class="flex items-center gap-3 p-3.5 rounded-xl border transition-all duration-200 group"
                   style="border-color: rgba(0,0,0,0.06);"
                   onmouseover="this.style.borderColor='<?php echo e($color); ?>40'"
                   onmouseout="this.style.borderColor='rgba(0,0,0,0.06)'">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center text-lg flex-shrink-0"
                         style="background: <?php echo e($color); ?>15;">
                        <?php echo e($icon); ?>

                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-ink-800 dark:text-ink-100 truncate group-hover:text-ink-900 dark:group-hover:text-white transition-colors"><?php echo e($title); ?></p>
                        <p class="text-xs text-ink-400"><?php echo e($cat); ?></p>
                    </div>
                    <svg class="w-4 h-4 text-ink-300 group-hover:text-ink-600 dark:group-hover:text-ink-300 transition-colors flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <?php $actions = [
        ['route' => 'hoax.check', 'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z', 'title' => 'Cek Berita Baru', 'sub' => 'Analisis berita dengan AI', 'color' => '#D4AF37', 'bg' => '0D0D0D'],
        ['route' => 'education.index', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'title' => 'Pelajari Lebih', 'sub' => 'Tingkatkan literasi digital', 'color' => '#3B82F6', 'bg' => '042C53'],
        ['route' => 'history.index', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'title' => 'Riwayat Lengkap', 'sub' => 'Lihat semua pengecekan Anda', 'color' => '#10B981', 'bg' => '04342C'],
    ]; ?>

    <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route($action['route'])); ?>"
       class="relative rounded-2xl overflow-hidden p-7 group transition-all duration-300 hover:-translate-y-1"
       style="background: #<?php echo e($action['bg']); ?>; border: 1px solid <?php echo e($action['color']); ?>25;">
        <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, <?php echo e($action['color']); ?>60, transparent);"></div>
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 transition-transform duration-300 group-hover:scale-110"
             style="background: <?php echo e($action['color']); ?>20; border: 1px solid <?php echo e($action['color']); ?>30;">
            <svg class="w-5 h-5" style="color: <?php echo e($action['color']); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($action['icon']); ?>"/>
            </svg>
        </div>
        <h3 class="font-display font-bold text-white text-lg mb-1"><?php echo e($action['title']); ?></h3>
        <p class="text-sm text-ink-400"><?php echo e($action['sub']); ?></p>
        <div class="absolute bottom-4 right-5 transition-all duration-300 group-hover:translate-x-1">
            <svg class="w-5 h-5 text-ink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </div>
    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
const isDark = document.documentElement.classList.contains('dark');
const gridColor = isDark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.06)';
const tickColor = isDark ? '#888888' : '#AAAAAA';

const ctx = document.getElementById('weeklyChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        datasets: [{
            label: 'Pengecekan',
            data: [2, 5, 3, 8, 4, 6, 5],
            borderColor: '#D4AF37',
            backgroundColor: 'rgba(212,175,55,0.08)',
            tension: 0.4, fill: true,
            pointBackgroundColor: '#D4AF37',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 5,
            pointHoverRadius: 8,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: {
            legend: { labels: { color: tickColor, font: { family: 'DM Sans', size: 12 } } }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { color: tickColor, font: { family: 'DM Sans' } },
                grid: { color: gridColor }
            },
            x: {
                ticks: { color: tickColor, font: { family: 'DM Sans' } },
                grid: { display: false }
            }
        }
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laporan Tugas Kuliah\SEMESTER 4\Pemrograman Web Lanjut\hoaxchecker\resources\views/dashboard.blade.php ENDPATH**/ ?>