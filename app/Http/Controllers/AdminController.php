<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Mengembalikan halaman index admin
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home'],
            ['label' => 'Dashboard', 'url' => route('admin.index')],
        ];
        return view('admin.index', compact('breadcrumb'));
    }
}
