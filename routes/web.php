<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;

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
    Route::middleware(['check.level:ADM'])->group(function () {
        Route::get('/admin', function () {
            return view('admin.index');
        })->name('admin.dashboard');
        Route::get('/admin/dospem/{id}', [AdminController::class, 'detailDospem'])
            ->name('admin.detail_dospem');
        Route::get('/admin/perusahaan_mitra/', [AdminController::class, 'perusahaanMitra'])
            ->name('admin.perusahaan');
    });
    
    // Dosen Routes
    Route::middleware(['check.level:DSP'])->group(function () {
        Route::get('/dosen', function () {
            return view('dosen.index');
        })->name('dosen.dashboard');
    });
    
    // Mahasiswa Routes
    Route::middleware(['check.level:MHS'])->group(function () {
        Route::get('/mahasiswa', function () {
            return view('mahasiswa.index');
        })->name('mahasiswa.dashboard');
    });
});
