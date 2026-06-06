<?php

require __DIR__.'/auth.php';

use App\Http\Controllers\{
    HoaxCheckController,
    NewsController,
    EducationController,
    HistoryController,
    AdminController,
    VerifikatorController,
    ReportController,
    DashboardController
};

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// ----------------------------------------------
// Halaman depan (landing)
// ----------------------------------------------
Route::get('/', function () {
    return view('landing');
})->name('home');

// ----------------------------------------------
// Halaman statis (tidak perlu login)
// ----------------------------------------------
Route::view('/tentang', 'pages.tentang')->name('about');
Route::view('/kontak', 'pages.kontak')->name('contact');

// ----------------------------------------------
// Rute yang butuh login
// ----------------------------------------------
Route::middleware(['auth'])->group(function () {

    // =====================================
    // DASHBOARD
    // =====================================
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // =====================================
    // PROFILE (LENGKAP dengan update & destroy)
    // =====================================
    Route::get('/profile', function () {
        return view('profile.edit', ['user' => auth()->user()]);
    })->name('profile.edit');

    Route::patch('/profile', function (Request $request) {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);
        auth()->user()->update($request->only('name', 'email'));
        return back()->with('status', 'profile-updated');
    })->name('profile.update');

    Route::delete('/profile', function (Request $request) {
        $request->validate([
            'password' => 'required|current_password',
        ]);
        $user = auth()->user();
        auth()->logout();
        $user->delete();
        return redirect('/');
    })->name('profile.destroy');

    // =====================================
    // CEK HOAKS
    // =====================================
    Route::get('/cek-hoaks', [HoaxCheckController::class, 'index'])
        ->name('hoax.check');

    Route::post('/cek-hoaks', [HoaxCheckController::class, 'analyze'])
        ->name('hoax.analyze');

    Route::get('/hasil-cek/{id}', [HoaxCheckController::class, 'result'])
        ->name('hoax.result');

    // =====================================
    // BERITA
    // =====================================
    Route::get('/berita', [NewsController::class, 'index'])
        ->name('news.index');

    // =====================================
    // RIWAYAT
    // =====================================
    Route::get('/riwayat', [HistoryController::class, 'index'])
        ->name('history.index');

    // =====================================
    // EDUKASI
    // =====================================
    Route::get('/edukasi', [EducationController::class, 'index'])
        ->name('education.index');

    Route::get('/edukasi/video', [EducationController::class, 'videos'])
        ->name('education.videos');

    Route::get('/edukasi/{id}', [EducationController::class, 'show'])
        ->name('education.show');

    // =====================================
    // LAPOR BERITA
    // =====================================
    Route::get('/lapor', [ReportController::class, 'create'])
        ->name('report.create');

    Route::post('/lapor', [ReportController::class, 'store'])
        ->name('report.store');

    // =====================================
    // ADMIN
    // =====================================
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])
            ->name('users.delete');

        Route::delete('/news/{id}', [AdminController::class, 'deleteNews'])
            ->name('news.delete');

        Route::get('/educations', [AdminController::class, 'educations'])
            ->name('educations.index');

        Route::get('/educations/create', [AdminController::class, 'createEducation'])
            ->name('educations.create');

        Route::post('/educations', [AdminController::class, 'storeEducation'])
            ->name('educations.store');

        Route::get('/educations/{id}/edit', [AdminController::class, 'editEducation'])
            ->name('educations.edit');

        Route::put('/educations/{id}', [AdminController::class, 'updateEducation'])
            ->name('educations.update');

        Route::delete('/educations/{id}', [AdminController::class, 'deleteEducation'])
            ->name('educations.delete');
    });

    // =====================================
    // VERIFIKATOR
    // =====================================
    Route::middleware('role:verifikator')
        ->prefix('verifikator')
        ->name('verifikator.')
        ->group(function () {

        Route::get('/dashboard', [VerifikatorController::class, 'dashboard'])
            ->name('dashboard');

        Route::post('/laporan/{id}', [VerifikatorController::class, 'updateReport'])
            ->name('report.update');
    });

});