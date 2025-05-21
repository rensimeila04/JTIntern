<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function detailDospem($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => '#'],
            ['label' => 'Detail Pengguna', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';

        return view('admin.detail_dospem', [
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function perusahaanMitra()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan_mitra';
        $perusahaanMitra = \App\Models\PerusahaanMitraModel::with('jenisPerusahaan')->get();
        $jenisPerusahaan = \App\Models\JenisPerusahaanModel::all();
        return view('admin.perusahaan', [
            'breadcrumb' => $breadcrumb,
            'perusahaanMitra' => $perusahaanMitra,
            'jenisPerusahaan' => $jenisPerusahaan,
            'activeMenu' => $activeMenu
        ]);
    }
}
