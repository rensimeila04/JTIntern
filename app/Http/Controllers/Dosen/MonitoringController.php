<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MagangModel;
use App\Models\LogAktivitasModel;

class MonitoringController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Monitoring', 'url' => '#'],
        ];
        $activeMenu = 'monitoring';

        // Get current logged in dosen - using same pattern as MahasiswaController
        $dosenId = auth()->user()->dosenPembimbing->id_dosen_pembimbing;

        $query = LogAktivitasModel::whereHas('magang', function ($query) use ($dosenId) {
                $query->where('id_dosen_pembimbing', $dosenId);
            })
            ->with(['magang.mahasiswa.user'])
            ->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status_feedback', $request->status);
        }

        $logAktivitas = $query->paginate(10)->appends($request->query());

        return view('dosen.monitoring_log_aktivitas', compact(
            'breadcrumb',
            'activeMenu',
            'logAktivitas',
        ));
    }

    public function detail($id_magang, $id_log_aktivitas)
    {
        // Get current logged in dosen - using same pattern as MahasiswaController
        $dosenId = auth()->user()->dosenPembimbing->id_dosen_pembimbing;

        $magang = MagangModel::with([
            'mahasiswa.user',
            'mahasiswa.programStudi',
            'lowongan.perusahaanMitra',
            'lowongan.periodeMagang',
            'lowongan.kompetensi',
            'dosenPembimbing.user'
        ])->where('id_dosen_pembimbing', $dosenId)
          ->findOrFail($id_magang);

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

        // Get current logged in dosen - using same pattern as MahasiswaController
        $dosenId = auth()->user()->dosenPembimbing->id_dosen_pembimbing;

        // Verify that this magang belongs to the logged-in lecturer
        $magang = MagangModel::where('id_dosen_pembimbing', $dosenId)
                            ->where('id_magang', $id_magang)
                            ->firstOrFail();

        $logAktivitas = LogAktivitasModel::where('id_magang', $id_magang)
            ->where('id_log_aktivitas', $id_log_aktivitas)
            ->firstOrFail();

        $logAktivitas->feedback_dospem = $request->komentar;
        $logAktivitas->status_feedback = 'sudah_ada';
        $logAktivitas->save();

        return redirect()->back()->with('success', 'Feedback berhasil dikirim.');
    }
}
