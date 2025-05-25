<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PerusahaanController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\LowonganController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postRegister'])->name('register.post');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Admin Routes
    Route::middleware(['check.level:ADM'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');
        Route::get('/pengguna', [UserController::class, 'index'])
            ->name('admin.pengguna');
        Route::get('/level', [LevelController::class, 'index'])
            ->name('admin.level');
        Route::get('/dospem/{id}', [UserController::class, 'detailDospem'])
            ->name('admin.detail_dospem');
        Route::get('/mahasiswa/{id}', [UserController::class, 'detailMahasiswa'])
            ->name('admin.detail_mahasiswa');
        Route::get('/perusahaan', [PerusahaanController::class, 'index'])
            ->name('admin.perusahaan');
        Route::get('/periode-magang', [PeriodeController::class, 'index'])
            ->name('admin.periode_magang');
        Route::get('/lowongan', [LowonganController::class, 'index'])
            ->name('admin.lowongan');
    });

    // Dosen Routes
    Route::middleware(['check.level:DSP'])->prefix('dosen')->group(function () {
        Route::get('/dashboard', function () {
            return view('dosen.index');
        })->name('dosen.dashboard');
    });

    // Mahasiswa Routes
    Route::middleware(['check.level:MHS'])->prefix('mahasiswa')->group(function () {
        Route::get('/dashboard', function () {
            return view('mahasiswa.index');
        })->name('mahasiswa.dashboard');
    });
});