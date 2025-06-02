<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;    
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index()
    {
         $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Log Aktivitas', 'url' => 'mahasiswa.log_aktivitas'],
        ];

        $activeMenu = 'log_aktivitas';

        return view('mahasiswa.log_aktivitas', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}
