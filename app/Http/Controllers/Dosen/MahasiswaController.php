<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MagangModel;
use App\Models\LogAktivitasModel;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Mahasiswa', 'url' => '#'],
        ];

        $activeMenu = 'mahasiswa';

        // Get current logged in dosen
        $dosenId = Auth::user()->dosenPembimbing->id_dosen_pembimbing;

        $query = MagangModel::with([
            'mahasiswa.user',
            'lowongan.perusahaanMitra', 
            'dosenPembimbing.user'
        ])
        // Filter by dosen pembimbing
        ->where('id_dosen_pembimbing', $dosenId);

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

        $activeMenu = 'mahasiswa';

        // Get current logged in dosen
        $dosenId = Auth::user()->dosenPembimbing->id_dosen_pembimbing;

        // Fetch magang data with relationships including documents and feedback
        // Only allow access to students supervised by the logged-in dosen
        $magang = MagangModel::with([
            'mahasiswa.user',
            'mahasiswa.programStudi',
            'mahasiswa.dokumen.jenisDokumen',
            'lowongan.perusahaanMitra',
            'dosenPembimbing.user',
            'feedback',
            'logaktivitas'
        ])
        ->where('id_dosen_pembimbing', $dosenId)
        ->findOrFail($id);

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

    public function exportLogPdf(Request $request, $id)
    {
        $magang = \App\Models\MagangModel::with(['mahasiswa.user', 'mahasiswa.programStudi', 'lowongan.perusahaanMitra', 'dosenPembimbing.user'])
            ->findOrFail($id);

        // Ambil log yang dipilih, atau semua jika tidak ada yang dipilih
        $selectedLogs = $request->input('log_ids', []);
        $logsQuery = $magang->logAktivitas()->orderBy('tanggal');
        if (!empty($selectedLogs)) {
            $logsQuery->whereIn('id_log_aktivitas', $selectedLogs);
        }
        $logAktivitas = $logsQuery->get();

        // Render view ke HTML
        $html = view('dosen.export_log_mahasiswa', [
            'magang' => $magang,
            'logAktivitas' => $logAktivitas,
        ])->render();

        // PDF options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'logbook_' . $magang->mahasiswa->user->name . '_' . now()->format('Ymd_His') . '.pdf';
        return response($dompdf->output())
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "inline; filename=\"$filename\"");
    }
}
