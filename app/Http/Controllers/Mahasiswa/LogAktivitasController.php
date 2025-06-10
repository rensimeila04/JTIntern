<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LogAktivitasModel;
use App\Models\MagangModel;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Log Aktivitas', 'url' => 'mahasiswa.log_aktivitas'],
        ];

        $activeMenu = 'log-aktivitas';

        // Ambil id_mahasiswa dari user yang login
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa; // pastikan relasi 'mahasiswa' ada di UserModel

        // Ambil magang aktif (atau sesuaikan kebutuhan)
        $magang = MagangModel::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->latest()->first();

        // Ambil log aktivitas berdasarkan id_magang
        $logAktivitas = LogAktivitasModel::where('id_magang', $magang->id_magang ?? null)
            ->orderByDesc('tanggal')
            ->paginate(10);

        return view('mahasiswa.log_aktivitas', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'logAktivitas' => $logAktivitas,
        ]);
    }

}
