<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\LowonganModel;
use Illuminate\Http\Request;

class RincianController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Rincian Magang', 'url' => '#'],
        ];

        $activeMenu = 'rincian-magang';

        return view('mahasiswa.rincian_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'status' => null
        ]);
    }

    public function rincianDiterima()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Rincian Diterima', 'url' => '#'],
        ];
        $activeMenu = 'rincian-diterima';
        return view('mahasiswa.rincian_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'status' => 'diterima'
        ]);
    }

    public function rincianDitolak()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Rincian Ditolak', 'url' => '#'],
        ];
        $activeMenu = 'rincian-ditolak';
        return view('mahasiswa.rincian_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'status' => 'ditolak'
        ]);
    }

    public function rincianMagang()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Rincian Magang', 'url' => '#'],
        ];
        $activeMenu = 'rincian-magang';
        return view('mahasiswa.rincian_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'status' => 'magang'
        ]);
    }

    public function rincianSelesai()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Rincian Magang', 'url' => '#'],
        ];
        $activeMenu = 'rincian-magang';
        return view('mahasiswa.rincian_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'status' => 'selesai'
        ]);
    }
}
