<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LogAktivitasModel;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $id_magang = $user->magang->id_magang ?? null;

        $logAktivitas = LogAktivitasModel::where('id_magang', $id_magang)
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

         $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Log Aktivitas', 'url' => 'mahasiswa.log_aktivitas'],
        ];

        $activeMenu = 'log_aktivitas';

        return view('mahasiswa.log_aktivitas', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'logAktivitas' => $logAktivitas,
        ]);
    }
}
