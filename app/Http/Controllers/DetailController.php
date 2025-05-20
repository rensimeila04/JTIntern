<?php

namespace App\Http\Controllers;

use App\Models\DetailModel;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Detail Pengguna',
            'list' => ['Home', 'Pengguna']
        ];

        $page = (object) [
            'title' => 'Detail Pengguna',
        ];

        // $detail = DetailModel::all();
        $activeMenu = 'pengguna';

        return view('admin.detail_mahasiswa', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            // 'detail' => $detail,
            'activeMenu' => $activeMenu
        ]);
    }
}
