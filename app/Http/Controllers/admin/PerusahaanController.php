<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerusahaanMitraModel;
use App\Models\JenisPerusahaanModel;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan_mitra';
        $perusahaanMitra = PerusahaanMitraModel::with('jenisPerusahaan')->get();
        $jenisPerusahaan = JenisPerusahaanModel::all();
        return view('admin.perusahaan', [
            'breadcrumb' => $breadcrumb,
            'perusahaanMitra' => $perusahaanMitra,
            'jenisPerusahaan' => $jenisPerusahaan,
            'activeMenu' => $activeMenu
        ]);
    }

    public function detail($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => '#'],
            ['label' => 'Detail', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan-mitra';
        
        return view('admin.detail_perusahaan_mitra', [
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}
