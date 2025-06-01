<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackMagangController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Feedback Magang', 'url' => route('mahasiswa.feedback')],
        ];

        $activeMenu = 'feedback_magang';
        
        return view('mahasiswa.feedback_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
        ]);
    }
}
