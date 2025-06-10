<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MagangModel;
use App\Models\LogAktivitasModel;

class MonitoringController extends Controller
{
    public function index() 
    {
        
    }

    public function detail($id)
    {
        // Get data magang dengan relasi yang diperlukan
        $magang = MagangModel::with([
            'mahasiswa.user',
            'mahasiswa.programStudi',
            'lowongan.perusahaanMitra',
            'lowongan.periodeMagang',
            'lowongan.kompetensi',
            'dosenPembimbing.user'
        ])->findOrFail($id);

        // Pastikan dosen hanya bisa melihat mahasiswa yang dibimbingnya
        if ($magang->dosen_pembimbing_id != auth()->user()->id) {
            abort(403, 'Unauthorized access');
        }

        // Get log aktivitas mahasiswa berdasarkan id_mahasiswa
        $logAktivitas = LogAktivitasModel::where('mahasiswa_id', $magang->mahasiswa->id_mahasiswa)
            ->orderBy('tanggal_aktivitas', 'desc');

        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Monitoring', 'url' => '#'],
            ['label' => 'Detail Aktivitas', 'url' => '#'],
        ];

        $activeMenu = 'monitoring';

        return view('dosen.detail_monitoring', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'magang' => $magang,
            'mahasiswa' => $magang->mahasiswa,
            'user' => $magang->mahasiswa->user,
            'lowongan' => $magang->lowongan, 
            'logAktivitas' => $logAktivitas,
        ]);
    }
}
