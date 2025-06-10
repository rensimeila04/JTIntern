<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitasModel;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = [];
        $activeMenu = 'dashboard';

        return view('dosen.index', compact(
            'breadcrumb',
            'activeMenu',
        ));
    }

    public function monitoring(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Monitoring', 'url' => '#'],
        ];
        $activeMenu = 'monitoring';

        $query = LogAktivitasModel::whereHas('magang', function ($query) {
                $query->where('id_dosen_pembimbing', auth()->user()->id_dosen_pembimbing);
            })
            ->with(['magang.mahasiswa'])
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
}