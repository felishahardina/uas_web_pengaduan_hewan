<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FelishaCategoryController;
use App\Http\Controllers\FelishaLocationController;
use App\Http\Controllers\FelishaAnimalController;
// User/Public Controllers
use App\Http\Controllers\FelishaReportController;
use App\Http\Controllers\HomepageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| File ini berisi semua definisi rute untuk aplikasi.
|
*/

// =======================
// AUTH & PUBLIC ROUTES
// =======================
Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/laporan/{report}', [HomepageController::class, 'show'])->name('laporan.detail');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =======================
// USER ROUTES (Memerlukan Login sebagai User)
// =======================
// PERBAIKAN: Menggunakan path lengkap untuk middleware dan memastikan sintaks ->group() benar.
Route::middleware(['auth', \App\Http\Middleware\IsUser::class])->group(function () {
    Route::get('/dashboard', [FelishaReportController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/lapor', [FelishaReportController::class, 'create'])->name('lapor');
    Route::post('/lapor', [FelishaReportController::class, 'store']);
    Route::get('/laporan-saya', [FelishaReportController::class, 'userReports'])->name('laporan.saya');
});


// ===================================================
// ADMIN ROUTES (Memerlukan Login sebagai Admin)
// ===================================================
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])
    ->prefix('admin') // Semua URL diawali dengan /admin/...
    ->name('admin.')   // Semua nama rute diawali dengan admin. ...
    ->group(function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Penuh untuk Kategori
    Route::resource('categories', FelishaCategoryController::class);

    // Admin hanya bisa melihat daftar Lokasi
    // Route::get('locations', [FelishaLocationController::class, 'index'])->name('locations.index');

    // Admin hanya bisa melihat daftar Hewan
    Route::get('animals', [FelishaAnimalController::class, 'index'])->name('animals.index');

    // Manajemen Laporan oleh Admin
    Route::get('reports', [FelishaReportController::class, 'indexAdmin'])->name('reports.index');
    Route::get('reports/{report}', [FelishaReportController::class, 'showAdmin'])->name('reports.show');
    Route::patch('reports/{report}/approve', [FelishaReportController::class, 'approve'])->name('reports.approve');
    Route::patch('reports/{report}/reject', [FelishaReportController::class, 'reject'])->name('reports.reject');
    Route::delete('reports/{report}', [FelishaReportController::class, 'destroyAdmin'])->name('reports.destroy');

});
