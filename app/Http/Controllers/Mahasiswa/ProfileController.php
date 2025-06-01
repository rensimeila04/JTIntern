<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudiModel;
use App\Models\KompetensiModel;
use App\Models\JenisPerusahaanModel;
use App\Models\DokumenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Edit Profil Pengguna', 'url' => '#'],
        ];
        
        $activeMenu = '';
        
        $programStudi = ProgramStudiModel::all();
        $kompetensi = KompetensiModel::all();
        $jenisPerusahaan = JenisPerusahaanModel::all();

        // Ambil mahasiswa yang sedang login
        $mahasiswa = Auth::user()->mahasiswa;

        // Ambil dokumen milik mahasiswa
        $dokumen = [];
        if ($mahasiswa) {
            $dokumen = DokumenModel::with('jenisDokumen')
                ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                ->get()
                ->keyBy(fn($d) => strtolower($d->jenisDokumen->nama ?? ''));
        }

        return view('mahasiswa.edit_profile', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'programStudi' => $programStudi,
            'kompetensi' => $kompetensi,
            'jenisPerusahaan' => $jenisPerusahaan,
            'dokumen' => $dokumen,
        ]);
    }
}