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

        $activeMenu = 'log-aktivitas';

        return view('mahasiswa.log_aktivitas', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'logAktivitas' => $logAktivitas,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $id_magang = $user->magang->id_magang ?? null;

        if (!$id_magang) {
        return response()->json([
            'success' => false,
            'message' => 'Anda belum terdaftar pada magang manapun.'
        ], 403);
    }

        $validated = $request->validate([
            'tanggal_log' => 'required|date',
            'waktu_awal' => 'required',
            'waktu_akhir' => 'required|after:waktu_awal',
            'deskripsi' => 'required|string|max:100',
        ]);

        $validated['id_magang'] = $id_magang;

        $log = LogAktivitasModel::create($validated);

        return response()->json(['success' => true, 'data' => $log]);
    }
}
