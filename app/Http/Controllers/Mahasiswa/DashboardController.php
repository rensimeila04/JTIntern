<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisPerusahaanModel;
use App\Models\PerusahaanMitraModel;
use App\Models\LowonganModel;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Dashboard', 'url' => route('dosen.dashboard')],
        ];
        $activeMenu = 'dashboard';

        $userId = auth()->user()->id_mahasiswa; 


        $lowonganMagangSaya = \App\Models\LowonganModel::whereHas('magang', function($q) use ($userId) {
            $q->where('id_mahasiswa', $userId)
              ->where('status_magang', 'magang');
        })->with('perusahaanMitra')->get();


        $lowonganList = LowonganModel::orderBy('created_at', 'desc')->take(6)->get();

        return view('mahasiswa.index', compact(
            'breadcrumb',
            'activeMenu',
            'lowonganList',
            'lowonganMagangSaya'
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
