<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    public function detailMagang($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => '#'],
            ['label' => 'Detail Magang', 'url' => '#'],
        ];

        $activeMenu = 'kelola-magang';
        
        return view('admin.detail_magang', [
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => '#'],
        ];

        $activeMenu = 'kelola-magang';
        
        return view('admin.kelola_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function pengajuanDitolak()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => '#'],
            ['label' => 'Pengajuan Ditolak', 'url' => '#'],
        ];

        $activeMenu = 'kelola-magang';
        
        return view('admin.pengajuan_ditolak', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function riwayatMagang()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => '#'],
            ['label' => 'Riwayat Magang', 'url' => '#'],
        ];

        $activeMenu = 'kelola-magang';
        
        return view('admin.riwayat_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}