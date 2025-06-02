<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TopsisService;

class TopsisController extends Controller
{
    protected $topsisService;

    public function __construct(TopsisService $topsisService)
    {
        $this->topsisService = $topsisService;
    }

    public function hitungTopsis()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => route('mahasiswa.lowongan')],
            ['label' => 'Hitung Rekomendasi TOPSIS', 'url' => route('mahasiswa.topsis.hitung')],
        ];

        $activeMenu = 'lowongan';

        $hasil = $this->topsisService->hitungRekomendasiTopsis();
        
        // Check if there's an error (incomplete profile or no data)
        if (isset($hasil['error']) && $hasil['error']) {
            return view('mahasiswa.hitung_topsis_error', compact('hasil', 'breadcrumb', 'activeMenu'));
        }
        
        return view('mahasiswa.hitung_topsis', compact('hasil', 'breadcrumb', 'activeMenu'));
    }
}
