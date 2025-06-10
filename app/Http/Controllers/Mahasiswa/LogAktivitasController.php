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

    public function store(Request $request)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        $magang = \App\Models\MagangModel::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->latest()->first();

        $validated = $request->validate([
            'tanggal_log' => 'required|date',
            'waktu_awal' => 'required|date_format:H:i',
            'waktu_akhir' => 'required|date_format:H:i|after:waktu_awal',
            'deskripsi' => 'required|string|max:100',
        ]);

        try {
            $log = new \App\Models\LogAktivitasModel();
            $log->id_magang = $magang->id_magang;
            $log->tanggal = $validated['tanggal_log'];
            $log->jam_masuk = $validated['waktu_awal'];
            $log->jam_pulang = $validated['waktu_akhir'];
            $log->kegiatan = $validated['deskripsi'];
            $log->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan log aktivitas.']);
        }
    }
}
