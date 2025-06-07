<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MagangModel;
use App\Models\LowonganModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MagangController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => '#'],
        ];

        $activeMenu = 'kelola-magang';

        // Query builder for magang - FIXED relationship name
        $query = MagangModel::with([
            'mahasiswa.user',
            'lowongan.perusahaanMitra', // Correct relationship name
            'dosenPembimbing.user'
        ]);

        // Filter by status
        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status_magang', $request->status);
        }

        // Filter by lowongan title
        if ($request->filled('lowongan_id') && $request->lowongan_id != 'all') {
            $query->where('id_lowongan', $request->lowongan_id);
        }

        // Search functionality - FIXED field names
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('mahasiswa.user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
                ->orWhereHas('lowongan', function ($q) use ($search) {
                    $q->where('judul_lowongan', 'like', "%$search%"); // Fixed field name
                })
                ->orWhereHas('lowongan.perusahaanMitra', function ($q) use ($search) { // Fixed relationship name
                    $q->where('nama_perusahaan_mitra', 'like', "%$search%");
                });
        }

        // Get magang data with pagination
        $magang = $query->latest()->paginate(10)->appends($request->query());

        // Get statistics counts
        $menungguCount = MagangModel::where('status_magang', 'menunggu')->count();
        $diterimaCount = MagangModel::where('status_magang', 'diterima')->count();
        $magangCount = MagangModel::where('status_magang', 'magang')->count();
        $aktifCount = $magangCount + $diterimaCount;
        $ditolakCount = MagangModel::where('status_magang', 'ditolak')->count();
        $selesaiCount = MagangModel::where('status_magang', 'selesai')->count();

        // Get all lowongan for filter dropdown - FIXED field name
        $lowonganList = LowonganModel::select('id_lowongan', 'judul_lowongan')->orderBy('judul_lowongan')->get();

        return view('admin.kelola_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'magang' => $magang,
            'currentSearch' => $request->search ?? '',
            'currentFilter' => $request->status ?? 'all',
            'currentLowongan' => $request->lowongan_id ?? 'all',
            'lowonganList' => $lowonganList,
            'counts' => [
                'menunggu' => $menungguCount,
                'diterima' => $diterimaCount,
                'aktif' => $aktifCount,
                'ditolak' => $ditolakCount,
                'selesai' => $selesaiCount
            ]
        ]);
    }

    public function detailMagang($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => route('admin.kelola-magang')],
            ['label' => 'Detail Magang', 'url' => '#'],
        ];

        $activeMenu = 'kelola-magang';

        // Fetch magang data with relationships including documents
        $magang = MagangModel::with([
            'mahasiswa.user',
            'mahasiswa.programStudi',
            'mahasiswa.dokumen.jenisDokumen', // Load documents with their types
            'lowongan.perusahaanMitra',
            'dosenPembimbing.user'
        ])->findOrFail($id);

        // Get all document types for reference
        $jenisDokumen = \App\Models\JenisDokumenModel::all();

        return view('admin.detail_magang', [
            'magang' => $magang,
            'jenisDokumen' => $jenisDokumen,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function pengajuanDitolak()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => route('admin.kelola-magang')],
            ['label' => 'Pengajuan Ditolak', 'url' => '#'],
        ];

        // Query builder for magang - FIXED relationship name
        $query = MagangModel::with([
            'mahasiswa.user',
            'lowongan.perusahaanMitra', // Correct relationship name
            'dosenPembimbing.user'
        ])->where('status_magang', 'ditolak');

        // Search functionality - FIXED field names
        if (request()->filled('search')) {
            $search = request()->search;
            $query->whereHas('mahasiswa.user', function($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
            ->orWhereHas('lowongan', function($q) use ($search) {
                $q->where('judul_lowongan', 'like', "%$search%"); // Fixed field name
            })
            ->orWhereHas('lowongan.perusahaanMitra', function($q) use ($search) { // Fixed relationship name
                $q->where('nama_perusahaan_mitra', 'like', "%$search%");
            });
        }

        // Get magang data with pagination
        $magangDitolak = $query->latest()->paginate(10)->appends(request()->query());
        $lowonganList = LowonganModel::select('id_lowongan', 'judul_lowongan')->orderBy('judul_lowongan')->get();
        $currentSearch = request()->search ?? '';
        $currentLowongan = request()->lowongan_id ?? 'all';



        $activeMenu = 'kelola-magang';

        return view('admin.pengajuan_ditolak', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'magangDitolak' => $magangDitolak,
            'currentSearch' => $currentSearch,
            'currentLowongan' => $currentLowongan,
            'lowonganList' => $lowonganList,
        ]);
    }

    public function riwayatMagang()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => route('admin.kelola-magang')],
            ['label' => 'Riwayat Magang', 'url' => '#'],
        ];

        $activeMenu = 'kelola-magang';
        
        // Query builder for magang - FIXED relationship name
        $query = MagangModel::with([
            'mahasiswa.user',
            'lowongan.perusahaanMitra', // Correct relationship name
            'dosenPembimbing.user'
        ])->where('status_magang', 'selesai');

        // Search functionality - FIXED field names
        if (request()->filled('search')) {
            $search = request()->search;
            $query->whereHas('mahasiswa.user', function($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
            ->orWhereHas('lowongan', function($q) use ($search) {
                $q->where('judul_lowongan', 'like', "%$search%"); // Fixed field name
            })
            ->orWhereHas('lowongan.perusahaanMitra', function($q) use ($search) { // Fixed relationship name
                $q->where('nama_perusahaan_mitra', 'like', "%$search%");
            });
        }

        // Get magang data with pagination
        $riwayatMagang = $query->latest()->paginate(10)->appends(request()->query());
        $lowonganList = LowonganModel::select('id_lowongan', 'judul_lowongan')->orderBy('judul_lowongan')->get();
        $currentSearch = request()->search ?? '';
        $currentLowongan = request()->lowongan_id ?? 'all';
        

        return view('admin.riwayat_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'riwayatMagang' => $riwayatMagang,
            'currentSearch' => $currentSearch,
            'currentLowongan' => $currentLowongan,
            'lowonganList' => $lowonganList,
        ]);
    }

    public function permohonanMagang(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => '#'],
            ['label' => 'Permohonan Magang', 'url' => '#'],
        ];

        $activeMenu = 'kelola-magang';

        // Query builder for magang applications
        $query = MagangModel::with([
            'mahasiswa.user',
            'lowongan.perusahaanMitra',
            'dosenPembimbing.user'
        ])->where('status_magang', 'menunggu');

        // Filter by lowongan title
        if ($request->filled('lowongan_id') && $request->lowongan_id != 'all') {
            $query->where('id_lowongan', $request->lowongan_id);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('mahasiswa.user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                    ->orWhereHas('lowongan', function ($q) use ($search) {
                        $q->where('judul_lowongan', 'like', "%$search%");
                    })
                    ->orWhereHas('lowongan.perusahaanMitra', function ($q) use ($search) {
                        $q->where('nama_perusahaan_mitra', 'like', "%$search%");
                    });
            });
        }

        // Get pending applications with pagination
        $permohonan = $query->latest()->paginate(10)->appends($request->query());

        // Get all lowongan for filter dropdown
        $lowonganList = LowonganModel::select('id_lowongan', 'judul_lowongan')
            ->orderBy('judul_lowongan')
            ->get();

        return view('admin.permohonan_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'permohonan' => $permohonan,
            'currentSearch' => $request->search ?? '',
            'currentLowongan' => $request->lowongan_id ?? 'all',
            'lowonganList' => $lowonganList
        ]);
    }

    public function magangAktif(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Kelola Magang', 'url' => '#'],
            ['label' => 'Magang Aktif', 'url' => '#'],
        ];

        $activeMenu = 'kelola-magang';

        // Query for active internships (status: magang or diterima)
        $query = MagangModel::with([
            'mahasiswa.user',
            'lowongan.perusahaanMitra',
            'dosenPembimbing.user'
        ])->whereIn('status_magang', ['magang', 'diterima']);

        // Filter by status if specified
        if ($request->filled('status') && in_array($request->status, ['magang', 'diterima'])) {
            $query->where('status_magang', $request->status);
        }

        // Filter by pembimbing status
        if ($request->filled('pembimbing')) {
            if ($request->pembimbing === 'dengan') {
                $query->whereNotNull('id_dosen_pembimbing');
            } elseif ($request->pembimbing === 'tanpa') {
                $query->whereNull('id_dosen_pembimbing');
            }
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('mahasiswa.user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                    ->orWhereHas('lowongan', function ($q) use ($search) {
                        $q->where('judul_lowongan', 'like', "%$search%");
                    })
                    ->orWhereHas('lowongan.perusahaanMitra', function ($q) use ($search) {
                        $q->where('nama_perusahaan_mitra', 'like', "%$search%");
                    });
            });
        }

        // Get data with pagination
        $aktiveMagang = $query->latest()->paginate(10)->appends($request->query());

        return view('admin.magang_aktif', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'aktiveMagang' => $aktiveMagang
        ]);
    }
}
