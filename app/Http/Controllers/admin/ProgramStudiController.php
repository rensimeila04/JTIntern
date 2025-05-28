<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudiModel;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Program Studi', 'url' => '#'],
        ];

        $activeMenu = 'program-studi';

        #Ambil data program studi:
        $programStudi = ProgramStudiModel::all();

        return view('admin.program_studi', [
            'breadcrumb' => $breadcrumb,
            'programStudi' => $programStudi, # Data program studi
            'activeMenu' => $activeMenu
        ]);
    }

    public function detailAdmin($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => '#'],
            ['label' => 'Detail Pengguna', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';
        
        return view('admin.detail_admin', [
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}