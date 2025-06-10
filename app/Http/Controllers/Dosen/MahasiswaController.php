<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\MagangModel;
use App\Models\LogAktivitasModel;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
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
