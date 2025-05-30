<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeriodeMagangModel;

class PeriodeController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Periode Magang', 'url' => '#'],
        ];

        $activeMenu = 'periode-magang';

        $periodeMagang = PeriodeMagangModel::all();

        return view('admin.periode_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'periodeMagang' => $periodeMagang,
        ]);
    }

    public function detail($id) 
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Periode Magang', 'url' => route('admin.periode_magang')],
            ['label' => 'Detail Periode', 'url' => '#'],
        ];

        $activeMenu = 'periode-magang';

        // Load periode_magang with its lowongan relationship
        $periodeMagang = PeriodeMagangModel::with('lowongan.perusahaanMitra', 'lowongan.kompetensi')
                         ->findOrFail($id);

        return view('admin.detail_periode_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'periodeMagang' => $periodeMagang,
        ]);
    }

}
