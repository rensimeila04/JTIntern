<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MabacService;

class MabacController extends Controller
{
    protected $mabacService;

    public function __construct(MabacService $mabacService)
    {
        $this->mabacService = $mabacService;
    }

    public function hitungMabac()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => route('mahasiswa.lowongan')],
        ];

        $activeMenu = 'lowongan';

        $hasil = $this->mabacService->hitungRekomendasiMabac();
        
        return view('mahasiswa.hitung_mabac', compact('hasil', 'breadcrumb', 'activeMenu'));
    }
}