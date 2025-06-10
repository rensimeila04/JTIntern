<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Dashboard', 'url' => route('dosen.dashboard')],
        ];
        $activeMenu = 'dashboard';

        return view('dosen.index', compact(
            'breadcrumb',
            'activeMenu',
        ));
    }
}
