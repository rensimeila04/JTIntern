<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

// Auth Controllers
use App\Http\Controllers\AuthController;

// Admin Controllers
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PerusahaanController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\LowonganController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\MagangController;

// Mahasiswa Controllers
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\LowonganController as MahasiswaLowonganController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\Mahasiswa\TopsisController;
use App\Http\Controllers\Mahasiswa\MabacController;
use App\Http\Controllers\Mahasiswa\RincianController as MahasiswaRincianController;
use App\Http\Controllers\mahasiswa\FeedbackMagangController;
use App\Http\Controllers\mahasiswa\LogAktivitasController;

// Dosen Controllers
use App\Http\Controllers\Dosen\DashboardController as DosenDashboardController;
use App\Http\Controllers\Dosen\MahasiswaController as DosenMahasiswaController;

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

Route::get('/test-email', function () {
    try {
        Mail::raw('Test email dari JTIntern System', function ($message) {
            $message->to('mail@example.com')
                ->subject('Test Email Configuration');
        });
        return 'Email berhasil dikirim!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

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
        Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('admin.update_profile');
        Route::post('/update-account', [UserController::class, 'updateAccount'])->name('admin.update_account');



        // User management routes
        Route::prefix('pengguna')->name('admin.pengguna')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('');
            Route::get('/import', [UserController::class, 'importForm'])->name('.import');
            Route::get('/template', [UserController::class, 'downloadTemplate'])->name('.template');
            Route::post('/import', [UserController::class, 'importStore'])->name('.import.store');
            Route::get('/export', [UserController::class, 'export'])->name('.export');
            Route::get('/dospem/{id}', [UserController::class, 'detailDospem'])->name('.detail_dospem');
            Route::get('/mahasiswa/{id}', [UserController::class, 'detailMahasiswa'])->name('.detail_mahasiswa');
            Route::get('/admin/{id}', [UserController::class, 'detailAdmin'])->name('.detail_admin');
            Route::get('/tambah', [UserController::class, 'create'])->name('.create');
            Route::post('/tambah', [UserController::class, 'store'])->name('.store');
            Route::put('/{id}', [UserController::class, 'update'])->name('.update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('.destroy');
        });


        // Perusahaan routes - reordered for proper route matching
        Route::prefix('perusahaan')->name('admin.perusahaan')->group(function () {
            Route::get('/', [PerusahaanController::class, 'index'])->name('');
            Route::get('/tambah', [PerusahaanController::class, 'create'])->name('.create');
            Route::post('/tambah', [PerusahaanController::class, 'store'])->name('.store');
            Route::get('/import', [PerusahaanController::class, 'importForm'])->name('.import');
            Route::get('/template', [PerusahaanController::class, 'downloadTemplate'])->name('.template');
            Route::post('/import', [PerusahaanController::class, 'importStore'])->name('.import.store');
            Route::get('/export', [PerusahaanController::class, 'export'])->name('.export');
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
            Route::get('/export', [MagangController::class, 'export'])->name('.export');
            Route::get('/permohonan-magang/export', [MagangController::class, 'exportPermohonanMagang'])->name('.export-permohonan-magang');
            Route::get('/magang-aktif/export', [MagangController::class, 'exportMagangAktif'])->name('.export-magang-aktif');
            Route::get('/pengajuan-ditolak/export', [MagangController::class, 'exportPengajuanDitolak'])->name('.export-pengajuan-ditolak');
            Route::get('/riwayat-magang/export', [MagangController::class, 'exportRiwayatMagang'])->name('.export-riwayat-magang');
            Route::get('/{id}', [MagangController::class, 'detailMagang'])->name('.detail');
            Route::post('/{id}/terima', [MagangController::class, 'terimaMagang'])->name('.terima-magang');
            Route::post('/{id}/tolak', [MagangController::class, 'tolakMagang'])->name('.tolak-magang');

            // Add these new routes for edit functionality
            Route::get('/{id}/edit', [MagangController::class, 'edit'])->name('.edit');
            Route::put('/{id}', [MagangController::class, 'update'])->name('.update');
            Route::delete('/{id}', [MagangController::class, 'destroy'])->name('.destroy');

            Route::get('/{id}/sertifikat', [MagangController::class, 'lihatSertifikat'])->name('.lihat-sertifikat');
            Route::get('/{id}/sertifikat/download', [MagangController::class, 'downloadSertifikat'])->name('.download-sertifikat');
        });


        Route::prefix('lowongan')->name('admin.lowongan')->group(function () {
            Route::get('/', [LowonganController::class, 'index']);
            Route::get('/tambah', [LowonganController::class, 'tambahLowongan'])->name('.tambah');
            Route::post('/tambah', [LowonganController::class, 'storeLowongan'])->name('.store');
            Route::get('/import', [LowonganController::class, 'importForm'])->name('.import');
            Route::get('/template', [LowonganController::class, 'downloadTemplate'])->name('.template');
            Route::post('/import', [LowonganController::class, 'importStore'])->name('.import.store');
            Route::get('/export', [LowonganController::class, 'export'])->name('.export');
            Route::get('/{id}', [LowonganController::class, 'detailLowongan'])->name('.detail');
            Route::get('/{id}/edit', [LowonganController::class, 'editLowongan'])->name('.edit');
            Route::put('/{id}', [LowonganController::class, 'updateLowongan'])->name('.update');
            Route::delete('/{id}', [LowonganController::class, 'destroyLowongan'])->name('.destroy');
        });



        Route::prefix('level')->name('admin.level')->group(function () {
            Route::get('/', [LevelController::class, 'index'])->name('');
            Route::get('/tambah', [LevelController::class, 'create'])->name('.create');
            Route::post('/tambah', [LevelController::class, 'store'])->name('.store');
            Route::get('/{id}/edit', [LevelController::class, 'edit'])->name('.edit');
            Route::put('/{id}', [LevelController::class, 'update'])->name('.update');
            Route::delete('/{id}', [LevelController::class, 'destroy'])->name('.destroy');
            Route::get('/{id}', [LevelController::class, 'detail'])->name('.detail');
        });

        Route::prefix('program-studi')->name('admin.program_studi')->group(function () {
            Route::get('/', [ProgramStudiController::class, 'index'])->name('');
            Route::get('/tambah', [ProgramStudiController::class, 'create'])->name('.create');
            Route::post('/tambah', [ProgramStudiController::class, 'store'])->name('.store');
            Route::get('/{id}/edit', [ProgramStudiController::class, 'edit'])->name('.edit');
            Route::put('/{id}', [ProgramStudiController::class, 'update'])->name('.update');
            Route::delete('/{id}', [ProgramStudiController::class, 'destroy'])->name('.destroy');
            Route::get('/{id}', [ProgramStudiController::class, 'detail'])->name('.detail');
        });
    });

    // Dosen Routes
    Route::middleware(['check.level:DSP'])->prefix('dosen')->group(function () {
        Route::get('/dashboard', [DosenDashboardController::class, 'index'])
            ->name('dosen.dashboard');
        Route::get('/edit', [DosenDashboardController::class, 'edit'])
            ->name('dosen.edit_profile');
        Route::post('/update-profile', [DosenDashboardController::class, 'updateProfile'])->name('dosen.update_profile');
        Route::post('/update-account', [DosenDashboardController::class, 'updateAccount'])->name('dosen.update_account');

        Route::get('/mahasiswa', [DosenMahasiswaController::class, 'index'])
            ->name('dosen.mahasiswa');

        Route::get('/detail-mahasiswa/{id}', [DosenMahasiswaController::class, 'detailMahasiswa'])
            ->name('dosen.detail_mahasiswa.id');
    });
});

// Mahasiswa Routes
Route::middleware(['check.level:MHS'])->prefix('mahasiswa')->group(function () {
    // Dashboard
    Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])
        ->name('mahasiswa.dashboard');
    Route::get('/semua-lowongan', [MahasiswaDashboardController::class, 'show'])
        ->name('mahasiswa.semua-lowongan');

    // Lowongan
    Route::get('/lowongan', [MahasiswaLowonganController::class, 'index'])
        ->name('mahasiswa.lowongan');
    Route::get('/lowongan/{id}', [MahasiswaLowonganController::class, 'detail'])
        ->name('mahasiswa.lowongan.detail');
    Route::post('/lowongan/{id}/check-documents', [MahasiswaLowonganController::class, 'checkDocuments'])
        ->name('mahasiswa.lowongan.check-documents');
    Route::post('/lowongan/{id}/apply', [MahasiswaLowonganController::class, 'applyInternship'])
        ->name('mahasiswa.lowongan.apply');

    // Profile Management
    Route::prefix('profile')->group(function () {
        Route::get('/edit', [MahasiswaProfileController::class, 'edit'])
            ->name('mahasiswa.edit_profile');
        Route::post('/update-preferensi', [MahasiswaProfileController::class, 'updatePreferensi'])
            ->name('mahasiswa.profile.update-preferensi');
        Route::post('/upload-dokumen', [MahasiswaProfileController::class, 'uploadDokumen'])
            ->name('mahasiswa.profile.upload-dokumen');
        Route::delete('/hapus-dokumen', [MahasiswaProfileController::class, 'hapusDokumen'])
            ->name('mahasiswa.profile.hapus-dokumen');
        Route::post('/upload-profile-photo', [MahasiswaProfileController::class, 'uploadProfilePhoto'])
            ->name('mahasiswa.profile.upload-profile-photo');
        Route::post('/update-data-pribadi', [MahasiswaProfileController::class, 'updateDataPribadi'])
            ->name('mahasiswa.profile.update-data-pribadi');
        Route::post('/update-akun', [MahasiswaProfileController::class, 'updateAkun'])
            ->name('mahasiswa.profile.update-akun');
    });

    // Decision Support System
    Route::prefix('decision')->group(function () {
        Route::get('/mabac/hitung', [MabacController::class, 'hitungMabac'])
            ->name('mahasiswa.mabac.hitung');
        Route::get('/topsis/hitung', [TopsisController::class, 'hitungTopsis'])
            ->name('mahasiswa.topsis.hitung');
    });

        // Rincian Management
        Route::prefix('rincian')->group(function () {
            Route::get('/', [MahasiswaRincianController::class, 'index'])
                ->name('mahasiswa.rincian');
            Route::post('/selesaikan-magang', [MahasiswaRincianController::class, 'selesaikanMagang'])
                ->name('mahasiswa.rincian.selesaikan-magang');
            Route::post('/mulai-magang', [MahasiswaRincianController::class, 'mulaiMagang'])->name('mahasiswa.rincian.mulai-magang');
        });

    // Feedback
    Route::prefix('feedback')->group(function () {
        Route::get('/', [FeedbackMagangController::class, 'index'])
            ->name('mahasiswa.feedback');
        Route::post('/store', [FeedbackMagangController::class, 'store'])
            ->name('mahasiswa.feedback.store');
    });

        // Log Aktivitas
        Route::prefix('log-aktivitas')->group(function () {
            Route::get('/', [LogAktivitasController::class, 'index'])
                ->name('mahasiswa.log_aktivitas');
            Route::post('/', [LogAktivitasController::class, 'store'])
                ->name('mahasiswa.log_aktivitas.store');
            Route::put('/{id}', [LogAktivitasController::class, 'update'])
                ->name('mahasiswa.log_aktivitas.update');
            Route::get('/{id}', [LogAktivitasController::class, 'show'])
                ->name('mahasiswa.log_aktivitas.show');
            Route::delete('/{id}', [LogAktivitasController::class, 'destroy'])
                ->name('mahasiswa.log_aktivitas.destroy');
        });
    });
});
