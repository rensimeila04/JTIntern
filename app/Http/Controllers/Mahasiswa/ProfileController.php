<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudiModel;
use App\Models\KompetensiModel;
use App\Models\JenisPerusahaanModel;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Edit Profil Pengguna', 'url' => '#'],
        ];
        
        $activeMenu = '';
        
        // Ambil data dari database
        $programStudi = ProgramStudiModel::all();
        $kompetensi = KompetensiModel::all();
        $jenisPerusahaan = JenisPerusahaanModel::all();

        return view('mahasiswa.edit_profile', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'programStudi' => $programStudi,
            'kompetensi' => $kompetensi,
            'jenisPerusahaan' => $jenisPerusahaan
        ]);
    }
}