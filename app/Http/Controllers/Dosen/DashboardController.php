<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\MagangModel;
use App\Models\LogAktivitasModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Dashboard', 'url' => route('dosen.dashboard')],
        ];
        $activeMenu = 'dashboard';

        $countMahasiswaBimbingan = MagangModel::where('id_dosen_pembimbing', auth()->user()->id_dosen_pembimbing)
            ->whereIn('status_magang', ['magang', 'diterima'])
            ->distinct('id_mahasiswa')
            ->count('id_mahasiswa');

        $countMagangAktif = MagangModel::where('id_dosen_pembimbing', auth()->user()->id_dosen_pembimbing)
            ->where('status_magang', 'magang')
            ->count();

        $countMenungguFeedback = LogAktivitasModel::where('status_feedback', 'menunggu')
            ->whereHas('magang', function ($query) {
                $query->where('id_dosen_pembimbing', auth()->user()->id_dosen_pembimbing);
            })
            ->count();

        $logAktivitasTerbaru = LogAktivitasModel::whereHas('magang', function ($query) {
            $query->where('id_dosen_pembimbing', auth()->user()->id_dosen_pembimbing);
        })
            ->with(['magang.mahasiswa']) 
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('dosen.index', compact(
            'breadcrumb',
            'activeMenu',
            'countMahasiswaBimbingan',
            'countMagangAktif',
            'countMenungguFeedback',
            'logAktivitasTerbaru'
        ));
    }
}
