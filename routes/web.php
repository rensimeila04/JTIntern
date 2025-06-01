<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PerusahaanController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\LowonganController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\MagangController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\LowonganController as MahasiswaLowonganController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;


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
        Route::get('/level', [LevelController::class, 'index'])
            ->name('admin.level');
        Route::get('/dospem/{id}', [UserController::class, 'detailDospem'])
            ->name('admin.detail_dospem');
        Route::get('/mahasiswa/{id}', [UserController::class, 'detailMahasiswa'])
            ->name('admin.detail_mahasiswa');
        Route::get('/admin/{id}', [UserController::class, 'detailAdmin'])
            ->name('admin.detail_admin');
        Route::get('/edit', [UserController::class, 'edit'])
            ->name('admin.edit_profile');



        // User management routes
        Route::prefix('pengguna')->name('admin.pengguna')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('');
            Route::get('/dospem/{id}', [UserController::class, 'detailDospem'])->name('.detail_dospem');
            Route::get('/mahasiswa/{id}', [UserController::class, 'detailMahasiswa'])->name('.detail_mahasiswa');
            Route::get('/admin/{id}', [UserController::class, 'detailAdmin'])->name('.detail_admin');
        });


        // Perusahaan routes - reordered for proper route matching
        Route::prefix('perusahaan')->name('admin.perusahaan')->group(function () {
            Route::get('/', [PerusahaanController::class, 'index'])->name('');
            Route::get('/tambah', [PerusahaanController::class, 'create'])->name('.create');
            Route::post('/tambah', [PerusahaanController::class, 'store'])->name('.store');
            Route::get('/{id}/edit', [PerusahaanController::class, 'edit'])->name('.edit');
            Route::put('/{id}', [PerusahaanController::class, 'update'])->name('.update');
            Route::delete('/{id}', [PerusahaanController::class, 'destroy'])->name('.destroy');
            Route::get('/{id}', [PerusahaanController::class, 'detail'])->name('.detail');
        });



        Route::prefix('periode-magang')->name('admin.periode_magang')->group(function () {
            Route::get('/', [PeriodeController::class, 'index']);
            Route::get('/tambah', [PeriodeController::class, 'create'])->name('.create');
            Route::post('/tambah', [PeriodeController::class, 'store'])->name('.store');
            Route::get('/{id}/edit', [PeriodeController::class, 'edit'])->name('.edit');
            Route::put('/{id}', [PeriodeController::class, 'update'])->name('.update');
            Route::delete('/{id}', [PeriodeController::class, 'destroy'])->name('.destroy');
            Route::get('/{id}', [PeriodeController::class, 'detail'])->name('.detail');
        });

        Route::prefix('kelola-magang')->name('admin.kelola-magang')->group(function () {
            Route::get('/', [MagangController::class, 'index']);
            Route::get('/permohonan-magang', [MagangController::class, 'permohonanMagang'])->name('.permohonan_magang');
            Route::get('/magang-aktif', [MagangController::class, 'magangAktif'])->name('.magang_aktif');
            Route::get('/pengajuan-ditolak', [MagangController::class, 'pengajuanDitolak'])->name('.pengajuan_ditolak');
            Route::get('/riwayat-magang', [MagangController::class, 'riwayatMagang'])->name('.riwayat_magang');
            Route::get('/{id}', [MagangController::class, 'detailMagang'])->name('.detail');
        });


        Route::prefix('lowongan')->name('admin.lowongan')->group(function () {
            Route::get('/', [LowonganController::class, 'index']);
            Route::get('/tambah', [LowonganController::class, 'tambahLowongan'])->name('.tambah');
            Route::post('/tambah', [LowonganController::class, 'storeLowongan'])->name('.store');
            Route::get('/{id}', [LowonganController::class, 'detailLowongan'])->name('.detail');
            Route::get('/{id}/edit', [LowonganController::class, 'editLowongan'])->name('.edit');
            Route::put('/{id}', [LowonganController::class, 'updateLowongan'])->name('.update');
            Route::delete('/{id}', [LowonganController::class, 'destroyLowongan'])->name('.destroy');
        });


        Route::get('/program-studi', [ProgramStudiController::class, 'index'])
            ->name('admin.program_studi');

        Route::prefix('level')->name('admin.level')->group(function () {
            Route::get('/', [LevelController::class, 'index'])->name('');
            Route::get('/tambah', [LevelController::class, 'create'])->name('.create');
            Route::post('/tambah', [LevelController::class, 'store'])->name('.store');
            Route::get('/{id}/edit', [LevelController::class, 'edit'])->name('.edit');
            Route::put('/{id}', [LevelController::class, 'update'])->name('.update');
            Route::delete('/{id}', [LevelController::class, 'destroy'])->name('.destroy');
            Route::get('/{id}', [LevelController::class, 'detail'])->name('.detail');
        });
    });

    // Dosen Routes
    Route::middleware(['check.level:DSP'])->prefix('dosen')->group(function () {
        Route::get('/dashboard', function () {
            return view('dosen.index');
        })->name('dosen.dashboard');
    });


    // Mahasiswa Routes
    Route::middleware(['check.level:MHS'])->prefix('mahasiswa')->group(function () {
        Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])
            ->name('mahasiswa.dashboard');
        Route::get('/lowongan', [MahasiswaLowonganController::class, 'index'])
            ->name('mahasiswa.lowongan');
        Route::get('/edit', [MahasiswaProfileController::class, 'edit'])
            ->name('mahasiswa.edit_profile');
    });
});
