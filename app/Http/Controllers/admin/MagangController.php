<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    public function detailMagang($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => '#'],
            ['label' => 'Detail Magang', 'url' => '#'],
        ];

        $activeMenu = 'kelola-magang';
        
        return view('admin.detail_magang', [
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}
