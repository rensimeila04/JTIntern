<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\MagangModel;
use App\Models\LowonganModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\LogAktivitasModel;

class RincianController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Rincian Magang', 'url' => '#'],
        ];

        $activeMenu = 'rincian-magang';

        // Ambil data magang mahasiswa yang sedang login
        $userId = Auth::id();

        // Ambil data magang dengan relasi lowongan dan perusahaan
        $magang = MagangModel::with(['lowongan.perusahaan', 'lowongan.periode', 'mahasiswa'])
            ->whereHas('mahasiswa', function ($query) use ($userId) {
                $query->where('id_user', $userId);
            })
            ->orderByDesc('created_at') // atau ->orderByDesc('tanggal_diterima') jika ingin berdasarkan tanggal diterima
            ->first();

        $query = LogAktivitasModel::where('id_magang', $magang->id_magang);
        $logAktivitas = $query->orderByDesc('tanggal')->paginate(100);

        // Jika tidak ada data magang, redirect atau tampilkan pesan
        if (!$magang) {
            return view('mahasiswa.rincian_magang', [
                'breadcrumb' => $breadcrumb,
                'activeMenu' => $activeMenu,
                'magang' => null,
                'message' => 'Anda belum memiliki data magang.'
            ]);
        }

        return view('mahasiswa.rincian_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'magang' => $magang,
            'status' => $magang->status_magang,
            'logAktivitas' => $logAktivitas,
        ]);
    }

    public function selesaikanMagang(Request $request)
    {
        $request->validate([
            'fileSertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        $userId = Auth::id();

        $magang = MagangModel::whereHas('mahasiswa', function ($query) use ($userId) {
            $query->where('id_user', $userId);
        })
            ->where('status_magang', 'magang')
            ->orderByDesc('created_at')
            ->first();

        if (!$magang) {
            return redirect()->back()->with('error', 'Data magang tidak ditemukan atau status tidak valid.');
        }

        if ($request->hasFile('fileSertifikat')) {
            $file = $request->file('fileSertifikat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('sertifikat', $filename, 'public');

            $magang->update([
                'status_magang' => 'selesai',
                'path_sertifikat' => $path
            ]);

            // Debug: pastikan session tersimpan
            Log::info('Session success_selesai set');

            return redirect()->back()
                ->with('success_selesai', true)
                ->with('show_success_modal', true);
        }

        return redirect()->back()->with('error', 'Gagal mengunggah sertifikat.');
    }

    public function mulaiMagang(Request $request)
    {
        $userId = Auth::id();
        $magang = MagangModel::whereHas('mahasiswa', function ($query) use ($userId) {
            $query->where('id_user', $userId);
        })->orderByDesc('created_at')->first();

        if (!$magang || $magang->status_magang !== 'diterima') {
            return redirect()->back()->with('error', 'Status magang tidak valid untuk dimulai.');
        }

        $magang->update(['status_magang' => 'magang']);
        return redirect()->back()->with('success', 'Status magang berhasil diubah. Selamat memulai perjalanan magang!');
    }
}
