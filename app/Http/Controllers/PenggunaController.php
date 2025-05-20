<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Pengguna',
            'list' => ['Home', 'Pengguna']
        ];

        $page = (object) [
            'title' => 'Pengguna',
        ];

        // $detail = PenggunaModel::all();
        $activeMenu = 'pengguna';

        return view('admin.pengguna', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            // 'pengguna' => $pengguna,
            'activeMenu' => $activeMenu
        ]);
    }
}