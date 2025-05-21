<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Dashboard', 'url' => '#'],
        ];

        $activeMenu = 'dashboard';

        return view('admin.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}
