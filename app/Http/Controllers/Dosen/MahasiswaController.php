<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MagangModel;
use App\Models\LogAktivitasModel;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Mahasiswa', 'url' => '#'],
        ];

        $activeMenu = 'mahasiswa';

        $query = MagangModel::with([
            'mahasiswa.user',
            'lowongan.perusahaanMitra', 
            'dosenPembimbing.user'
        ]);

        // Filter by status
        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status_magang', $request->status);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('mahasiswa.user', function ($subQ) use ($search) {
                    $subQ->where('name', 'like', "%$search%");
                })
                ->orWhereHas('lowongan', function ($subQ) use ($search) {
                    $subQ->where('judul_lowongan', 'like', "%$search%");
                })
                ->orWhereHas('lowongan.perusahaanMitra', function ($subQ) use ($search) {
                    $subQ->where('nama_perusahaan_mitra', 'like', "%$search%");
                });
            });
        }

        // Execute query to get the data with pagination
        $magang = $query->latest()->paginate(10)->appends($request->query());

        return view('dosen.manajemen_mahasiswa', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'magang' => $magang,
            'currentFilter' => $request->status ?? 'all',
            'currentSearch' => $request->search ?? '',
        ]);
    }

    public function detailMahasiswa($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Mahasiswa', 'url' => '#'],
            ['label' => 'Detail Mahasiswa', 'url' => route('dosen.detail_mahasiswa.id', ['id' => $id])],
        ];

        $activeMenu = 'kelola-magang';

        // Fetch magang data with relationships including documents and feedback
        $magang = MagangModel::with([
            'mahasiswa.user',
            'mahasiswa.programStudi',
            'mahasiswa.dokumen.jenisDokumen',
            'lowongan.perusahaanMitra',
            'dosenPembimbing.user',
            'feedback',
            'logaktivitas'
        ])->findOrFail($id);

        // Get log aktivitas with pagination (latest first)
        $logAktivitas = LogAktivitasModel::where('id_magang', $id)
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Get all document types for reference
        $jenisDokumen = \App\Models\JenisDokumenModel::all();

        // Get all dosen pembimbing for dropdown
        $dosenPembimbing = \App\Models\DosenPembimbingModel::with('user')->get();

        return view('dosen.detail_mahasiswa', [
            'magang' => $magang,
            'jenisDokumen' => $jenisDokumen,
            'dosenPembimbing' => $dosenPembimbing,
            'logAktivitas' => $logAktivitas,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}
