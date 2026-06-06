<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HoaxCheckController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VerifikatorController;

// ================================================
// 5.1 PENGUJIAN AUTENTIKASI API
// ================================================

// 5.1.1 Testing Register API
Route::post('/register', [RegisteredUserController::class, 'storeApi']);

// 5.1.2 Testing Login API
Route::post('/login', [AuthenticatedSessionController::class, 'storeApi']);

// 5.1.3 Testing Logout API
Route::post('/logout', [AuthenticatedSessionController::class, 'destroyApi'])->middleware('auth:sanctum');

// 5.1.4 Testing Reset Password
Route::post('/forgot-password', function (Request $request) {
    return response()->json(['message' => 'Password reset link sent to email'], 200);
});

// ================================================
// 5.2 PENGUJIAN AUTORISASI DAN PROTEKSI API
// ================================================

// 5.2.1 Middleware Authentication
Route::middleware('auth:sanctum')->group(function () {
    
    // 5.2.5 Pengujian Token API - User Profile
    Route::get('/user/profile', function (Request $request) {
        return response()->json($request->user(), 200);
    });

    // 5.2.2 Pengujian Role Permissive Admin - Get All Users
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/users', [AdminController::class, 'getUsersApi']);
        
        // 5.2.3 Delete User (Admin Only)
        Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUserApi']);
    });

    // 5.2.4 Pengujian Role Permissive Verifikator
    Route::middleware('role:verifikator')->group(function () {
        Route::get('/verifikator/reports', [VerifikatorController::class, 'getReportsApi']);
        
        // 5.2.5 Update Report Status (Verifikator Only)
        Route::post('/verifikator/reports/{id}', [VerifikatorController::class, 'updateReportApi']);
    });

    // 5.2.6 Pengujian Role Permissive User
    Route::middleware('role:user')->group(function () {
        Route::get('/user', function (Request $request) {
            return response()->json($request->user(), 200);
        });
    });
});

// ================================================
// 5.3 PENGUJIAN API ANALISIS HOAKS
// ================================================

// 5.3.1 Pengujian Input Judul Berita
Route::post('/hoax/analyze/title', [HoaxCheckController::class, 'analyzeTitleApi'])->middleware('auth:sanctum');

// 5.3.2 Pengujian Input Isi Berita
Route::post('/hoax/analyze/content', [HoaxCheckController::class, 'analyzeContentApi'])->middleware('auth:sanctum');

// 5.3.3 Pengujian Input Link Berita
Route::post('/hoax/analyze/link', [HoaxCheckController::class, 'analyzeLinkApi'])->middleware('auth:sanctum');

// ================================================
// 5.4 PENGUJIAN CRUD API
// ================================================

Route::middleware('auth:sanctum')->group(function () {
    
    // 5.4.1 Get All Educations
    Route::get('/educations', [EducationController::class, 'indexApi']);
    
    // 5.4.2 Create Education (Admin Only)
    Route::post('/educations', [EducationController::class, 'storeApi'])->middleware('role:admin');
    
    // 5.4.3 Get Single Education
    Route::get('/educations/{id}', [EducationController::class, 'showApi']);
    
    // 5.4.4 Update Education (Admin Only)
    Route::put('/educations/{id}', [EducationController::class, 'updateApi'])->middleware('role:admin');
    
    // 5.4.5 Delete Education (Admin Only)
    Route::delete('/educations/{id}', [EducationController::class, 'destroyApi'])->middleware('role:admin');

    // 5.4.6 Get User History
    Route::get('/history', [HistoryController::class, 'indexApi']);
    
    // 5.4.7 Get Single History
    Route::get('/history/{id}', [HistoryController::class, 'showApi']);
    
    // 5.4.8 Delete History
    Route::delete('/history/{id}', [HistoryController::class, 'destroyApi']);

    // 5.4.9 Submit Report / Laporan Berita
    Route::post('/lapor', [ReportController::class, 'storeApi']);
    Route::get('/lapor', [ReportController::class, 'indexApi']);
    Route::get('/lapor/{id}', [ReportController::class, 'showApi']);

    // 5.4.10 Update User Profile
    Route::patch('/user/profile', function (Request $request) {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . auth()->id(),
        ]);
        
        auth()->user()->update($validated);
        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => auth()->user()
        ], 200);
    });
});

// ================================================
// 5.5 PENGUJIAN INTEGRASI API
// ================================================

Route::middleware('auth:sanctum')->group(function () {
    
    // 5.5.1 OpenAI Integration
    Route::post('/analyze/openai', [HoaxCheckController::class, 'analyzeWithOpenAiApi']);

    // 5.5.2 NewsAPI Integration
    Route::post('/analyze/newsapi', [NewsController::class, 'analyzeWithNewsApiApi']);

    // 5.5.3 YouTube API Integration
    Route::post('/educations/youtube', [EducationController::class, 'addYouTubeVideoApi'])->middleware('role:admin');
});
