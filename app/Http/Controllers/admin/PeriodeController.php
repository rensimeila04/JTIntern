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
}
