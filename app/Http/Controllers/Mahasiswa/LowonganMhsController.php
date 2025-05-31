<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LowonganMhsController extends Controller
{
    public function index() 
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        return view('mahasiswa.lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function detailLowongan()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            // ['label' => 'Lowongan', 'url' => route('/')],
            ['label' => 'Detail Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        return view('mahasiswa.detail_lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}
