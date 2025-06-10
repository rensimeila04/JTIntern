<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = [];
        $activeMenu = 'dashboard';

        return view('dosen.index', compact(
            'breadcrumb',
            'activeMenu',
        ));
    }
}
