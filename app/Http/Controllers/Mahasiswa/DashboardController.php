<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisPerusahaanModel;
use App\Models\PerusahaanMitraModel;
use App\Models\LowonganModel;
use App\Models\MagangModel;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Dashboard', 'url' => route('dosen.dashboard')],
        ];
        $activeMenu = 'dashboard';

        // Ambil ID mahasiswa dari user yang login
        $mahasiswa = auth()->user()->mahasiswa; // Asumsi ada relasi mahasiswa() di User model
        
        $magang = null;
        if ($mahasiswa) {
            $magang = MagangModel::with(['lowongan.perusahaanMitra'])
                ->where('id_mahasiswa', $mahasiswa->id_mahasiswa) // Sesuaikan dengan status yang menunjukkan magang aktif
                ->orderByDesc('created_at')
                ->first();
        }

        $lowonganList = LowonganModel::orderBy('created_at', 'desc')->take(6)->get();

        return view('mahasiswa.index', compact(
            'breadcrumb',
            'activeMenu',
            'lowonganList',
            'magang'
        ));
    }

    public function edit()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Edit Profil Pengguna', 'url' => '#'],
        ];
        
        $activeMenu = '';

        return view('mahasiswa.edit_profile', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function show()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Semua Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        $jenisPerusahaan = JenisPerusahaanModel::all();

        $lokasiPerusahaan = PerusahaanMitraModel::select('alamat')
            ->distinct()
            ->whereNotNull('alamat')
            ->where('alamat', '!=', '')
            ->orderBy('alamat')
            ->pluck('alamat');

        $lowonganList = LowonganModel::with([
            'perusahaanMitra.jenisPerusahaan',
            'kompetensi',
            'periodeMagang',
            'magang'
        ])
        ->where('status_pendaftaran', true)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('mahasiswa.partials.semua_lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'jenisPerusahaan' => $jenisPerusahaan,
            'lokasiPerusahaan' => $lokasiPerusahaan,
            'lowonganList' => $lowonganList,
            'filters' => []
        ]);
    }
}
