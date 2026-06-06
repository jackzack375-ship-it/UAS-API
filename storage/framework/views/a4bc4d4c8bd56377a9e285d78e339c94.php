
<?php $__env->startSection('title', 'Admin Dashboard'); ?>
<?php $__env->startSection('content'); ?>

<div class="space-y-6">
    
    <div class="relative rounded-2xl overflow-hidden p-8 md:p-10" style="background: linear-gradient(135deg, #0D0D0D 0%, #1A1A1A 100%);">
        <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, #D4AF37, transparent);"></div>
        <div class="absolute right-8 top-1/2 -translate-y-1/2 hidden md:block opacity-8">
            <svg class="w-28 h-28 opacity-10" fill="currentColor" style="color: #D4AF37;" viewBox="0 0 24 24">
                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-5">
            <div>
                <p class="text-xs font-mono mb-2" style="color: #D4AF37; letter-spacing: 0.1em;">PANEL ADMINISTRASI</p>
                <h1 class="font-display text-3xl md:text-4xl font-black text-white mb-1">Dashboard Admin</h1>
                <p class="text-ink-400 text-sm">Monitoring & kontrol penuh sistem HoaxChecker</p>
                <?php if(session('success')): ?>
                    <p class="text-sm mt-2 px-3 py-1 rounded-lg inline-block" style="background: rgba(16,185,129,0.15); color: #6EE7B7;">✓ <?php echo e(session('success')); ?></p>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <p class="text-sm mt-2 px-3 py-1 rounded-lg inline-block" style="background: rgba(239,68,68,0.15); color: #FCA5A5;">✗ <?php echo e(session('error')); ?></p>
                <?php endif; ?>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="<?php echo e(route('admin.educations.index')); ?>" class="btn-primary text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Kelola Edukasi
                </a>
                <a href="?days=7" class="px-4 py-2 rounded-lg text-xs font-semibold transition-all" style="<?php echo e(request('days', 7) == 7 ? 'background: rgba(212,175,55,0.2); color: #D4AF37; border: 1px solid rgba(212,175,55,0.4);' : 'background: rgba(255,255,255,0.08); color: #888; border: 1px solid rgba(255,255,255,0.1);'); ?>">7 Hari</a>
                <a href="?days=30" class="px-4 py-2 rounded-lg text-xs font-semibold transition-all" style="<?php echo e(request('days') == 30 ? 'background: rgba(212,175,55,0.2); color: #D4AF37; border: 1px solid rgba(212,175,55,0.4);' : 'background: rgba(255,255,255,0.08); color: #888; border: 1px solid rgba(255,255,255,0.1);'); ?>">30 Hari</a>
            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php $__currentLoopData = [
            ['label' => 'Total User', 'value' => $totalUsers, 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'color' => '#3B82F6'],
            ['label' => 'Total Pengecekan', 'value' => $totalChecks, 'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z', 'color' => '#D4AF37'],
            ['label' => 'Hoaks Terdeteksi', 'value' => $hoaxDetected, 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z', 'color' => '#EF4444'],
            ['label' => 'Laporan Pending', 'value' => $pendingReports, 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => '#F59E0B'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card p-5 group">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-semibold uppercase tracking-wider text-ink-400"><?php echo e($stat['label']); ?></p>
                <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-110"
                     style="background: <?php echo e($stat['color']); ?>15; border: 1px solid <?php echo e($stat['color']); ?>25;">
                    <svg class="w-4 h-4" style="color: <?php echo e($stat['color']); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($stat['icon']); ?>"/>
                    </svg>
                </div>
            </div>
            <div class="stat-number text-3xl" style="color: <?php echo e($stat['color']); ?>;"><?php echo e($stat['value']); ?></div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 card p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="font-display font-bold text-lg text-ink-900 dark:text-ink-50">Tren Pengecekan</h3>
                    <p class="text-xs text-ink-400 mt-0.5"><?php echo e($daysFilter); ?> hari terakhir</p>
                </div>
                <span class="section-label text-xs">📈 Live</span>
            </div>
            <div class="relative h-60">
                <canvas id="trendChart"></canvas>
            </div>
        </div>
        <div class="card p-6">
            <div class="mb-5">
                <h3 class="font-display font-bold text-lg text-ink-900 dark:text-ink-50">Distribusi Status</h3>
                <p class="text-xs text-ink-400 mt-0.5">Proporsi hasil pengecekan</p>
            </div>
            <div class="relative h-48">
                <canvas id="pieChart"></canvas>
            </div>
            <div class="flex justify-center gap-4 mt-4 text-xs text-ink-500">
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-red-500 inline-block"></span>Hoaks</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span>Valid</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-yellow-500 inline-block"></span>Verifikasi</span>
            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card p-6">
            <h3 class="font-display font-bold text-lg text-ink-900 dark:text-ink-50 mb-5">Top 5 User Teraktif</h3>
            <ul class="space-y-3">
                <?php $__currentLoopData = $topUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="flex items-center justify-between p-3 rounded-xl transition-colors hover:bg-black/02 dark:hover:bg-white/03">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-ink-900 flex-shrink-0"
                             style="background: <?php echo e($index === 0 ? 'linear-gradient(135deg,#D4AF37,#F0D060)' : ($index === 1 ? 'rgba(156,163,175,0.3)' : 'rgba(212,175,55,0.15)')); ?>; color: <?php echo e($index === 0 ? '#0D0D0D' : ''); ?>;">
                            <?php echo e($index + 1); ?>

                        </div>
                        <span class="text-sm font-medium text-ink-800 dark:text-ink-100"><?php echo e($user->name); ?></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="h-1.5 rounded-full" style="width: <?php echo e(min(100, ($user->news_histories_count / max(1, $topUsers->first()->news_histories_count)) * 80)); ?>px; background: linear-gradient(90deg, #D4AF37, #F0D060);"></div>
                        <span class="text-xs font-semibold text-ink-400"><?php echo e($user->news_histories_count); ?> cek</span>
                    </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>

        <div class="card p-6">
            <h3 class="font-display font-bold text-lg text-ink-900 dark:text-ink-50 mb-5">Aktivitas Terbaru</h3>
            <ul class="space-y-2 max-h-64 overflow-y-auto">
                <?php $__currentLoopData = $recentActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="flex items-center justify-between py-2.5 border-b" style="border-color: rgba(0,0,0,0.04);">
                    <span class="text-sm text-ink-700 dark:text-ink-300 truncate max-w-[55%]"><?php echo e(Str::limit($activity->title, 38)); ?></span>
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <span class="badge badge-<?php echo e($activity->status === 'hoax' ? 'hoax' : ($activity->status === 'valid' ? 'valid' : 'verify')); ?>">
                            <?php echo e($activity->status); ?>

                        </span>
                        <form action="<?php echo e(route('admin.news.delete', $activity->id)); ?>" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="w-7 h-7 rounded-lg flex items-center justify-center text-red-400 hover:bg-red-50 dark:hover:bg-red-900/15 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>

    
    <div class="card overflow-hidden">
        <div class="p-6 border-b" style="border-color: rgba(0,0,0,0.06);">
            <h3 class="font-display font-bold text-lg text-ink-900 dark:text-ink-50">Manajemen User</h3>
            <p class="text-xs text-ink-400 mt-0.5">Kelola seluruh akun pengguna platform</p>
        </div>
        <div class="overflow-x-auto">
            <table class="table-elegant">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Total Cek</th>
                        <th>Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="--divide-color: rgba(0,0,0,0.04);">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="font-medium text-ink-800 dark:text-ink-100"><?php echo e($user->name); ?></td>
                        <td class="text-ink-500 dark:text-ink-400"><?php echo e($user->email); ?></td>
                        <td>
                            <span class="badge badge-<?php echo e($user->role === 'admin' ? 'hoax' : ($user->role === 'verifikator' ? 'verify' : 'valid')); ?>">
                                <?php echo e($user->role); ?>

                            </span>
                        </td>
                        <td class="text-ink-600 dark:text-ink-300 font-mono text-sm"><?php echo e($user->news_histories_count ?? 0); ?></td>
                        <td class="text-ink-400 text-xs"><?php echo e($user->created_at->format('d M Y')); ?></td>
                        <td>
                            <form action="<?php echo e(route('admin.users.delete', $user->id)); ?>" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-xs font-semibold text-red-500 hover:text-red-700 transition-colors">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t" style="border-color: rgba(0,0,0,0.06);">
            <?php echo e($users->links()); ?>

        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
const isDark = document.documentElement.classList.contains('dark');
const tickColor = isDark ? '#888888' : '#AAAAAA';
const gridColor = isDark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.06)';

new Chart(document.getElementById('trendChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: <?php echo json_encode($days, 15, 512) ?>,
        datasets: [
            { label: 'Hoaks', data: <?php echo json_encode($hoaxCounts, 15, 512) ?>, borderColor: '#EF4444', backgroundColor: 'rgba(239,68,68,0.08)', tension: 0.4, fill: true, pointBackgroundColor: '#EF4444', pointRadius: 4 },
            { label: 'Valid', data: <?php echo json_encode($validCounts, 15, 512) ?>, borderColor: '#10B981', backgroundColor: 'rgba(16,185,129,0.08)', tension: 0.4, fill: true, pointBackgroundColor: '#10B981', pointRadius: 4 }
        ]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { labels: { color: tickColor, font: { family: 'DM Sans', size: 12 } } } },
        scales: {
            y: { beginAtZero: true, ticks: { color: tickColor }, grid: { color: gridColor } },
            x: { ticks: { color: tickColor }, grid: { display: false } }
        }
    }
});

new Chart(document.getElementById('pieChart').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($pieLabels, 15, 512) ?>,
        datasets: [{ data: <?php echo json_encode($pieData, 15, 512) ?>, backgroundColor: ['#EF4444','#10B981','#F59E0B'], borderColor: 'transparent', borderWidth: 0 }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        cutout: '70%'
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laporan Tugas Kuliah\SEMESTER 4\Pemrograman Web Lanjut\hoaxchecker\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>