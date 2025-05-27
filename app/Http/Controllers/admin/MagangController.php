<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => '#'],
        ];

        $activeMenu = 'kelola-magang';

        return view('admin.kelola_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
        ]);
    }

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

    public function permohonanMagang()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => '#'],
        ];

        $activeMenu = 'kelola-magang';

        return view('admin.permohonan_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function magangAktif()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => '#'],
        ];

        $activeMenu = 'kelola-magang';

        return view('admin.magang_aktif', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
        ]);
    }
}
