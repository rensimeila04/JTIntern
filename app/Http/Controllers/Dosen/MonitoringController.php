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

    public function detail($id_magang, $id_log_aktivitas)
    {

        $magang = MagangModel::with([
            'mahasiswa.user',
            'mahasiswa.programStudi',
            'lowongan.perusahaanMitra',
            'lowongan.periodeMagang',
            'lowongan.kompetensi',
            'dosenPembimbing.user'
        ])->findOrFail($id_magang);

        if ($magang->dosen_pembimbing_id != auth()->user()->id) {
            abort(403, 'Unauthorized access');
        }

        $logAktivitas = LogAktivitasModel::where('id_magang', $magang->id_magang)
            ->where('id_log_aktivitas', $id_log_aktivitas)
            ->firstOrFail();

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

    public function feedback(Request $request, $id_magang, $id_log_aktivitas)
    {
        $request->validate([
            'komentar' => 'required|string|max:100',
        ]);

        $logAktivitas = LogAktivitasModel::where('id_magang', $id_magang)
            ->where('id_log_aktivitas', $id_log_aktivitas)
            ->firstOrFail();

        $logAktivitas->feedback_dospem = $request->komentar;
        $logAktivitas->status_feedback = 'sudah_ada';
        $logAktivitas->save();

        return redirect()->back()->with('success', 'Feedback berhasil dikirim.');
    }
}
