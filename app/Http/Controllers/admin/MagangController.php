<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MagangModel;
use App\Models\LowonganModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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

        // Fetch magang data with relationships including documents and feedback
        $magang = MagangModel::with([
            'mahasiswa.user',
            'mahasiswa.programStudi',
            'mahasiswa.dokumen.jenisDokumen',
            'lowongan.perusahaanMitra',
            'dosenPembimbing.user',
            'feedback' // Add feedback relationship
        ])->findOrFail($id);

        // Get all document types for reference
        $jenisDokumen = \App\Models\JenisDokumenModel::all();

        // Get all dosen pembimbing for dropdown
        $dosenPembimbing = \App\Models\DosenPembimbingModel::with('user')->get();

        return view('admin.detail_magang', [
            'magang' => $magang,
            'jenisDokumen' => $jenisDokumen,
            'dosenPembimbing' => $dosenPembimbing,
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

    public function terimaMagang(Request $request, $id)
    {
        try {
            // Validate request
            $validator = Validator::make($request->all(), [
                'id_dosen_pembimbing' => 'nullable|exists:dosen_pembimbing,id_dosen_pembimbing'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Find magang record
            $magang = MagangModel::findOrFail($id);

            // Check if status is still pending
            if ($magang->status_magang !== 'menunggu') {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan magang sudah diproses sebelumnya'
                ], 400);
            }

            // Update magang status and dosen pembimbing
            $updateData = [
                'status_magang' => 'diterima',
                'tanggal_diterima' => now()
            ];

            // Add dosen pembimbing if selected
            if ($request->filled('id_dosen_pembimbing')) {
                $updateData['id_dosen_pembimbing'] = $request->id_dosen_pembimbing;
            }

            $magang->update($updateData);

            // Log the action
            Log::info('Magang application accepted', [
                'magang_id' => $id,
                'mahasiswa' => $magang->mahasiswa->user->name,
                'dosen_pembimbing_id' => $request->id_dosen_pembimbing,
                'admin' => auth()->user()->name
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan magang berhasil diterima',
                'data' => [
                    'status' => 'diterima',
                    'dosen_pembimbing' => $magang->dosenPembimbing ? $magang->dosenPembimbing->user->name : null
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error accepting magang application', [
                'magang_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pengajuan'
            ], 500);
        }
    }

    public function tolakMagang(Request $request, $id)
    {
        try {
            // Validate request
            $validator = Validator::make($request->all(), [
                'alasan_penolakan' => 'nullable|string|max:500'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Find magang record
            $magang = MagangModel::findOrFail($id);

            // Check if status is still pending
            if ($magang->status_magang !== 'menunggu') {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan magang sudah diproses sebelumnya'
                ], 400);
            }

            // Update magang status
            $magang->update([
                'status_magang' => 'ditolak',
                'tanggal_ditolak' => now(),
                'alasan_penolakan' => $request->alasan_penolakan
            ]);

            // Log the action
            Log::info('Magang application rejected', [
                'magang_id' => $id,
                'mahasiswa' => $magang->mahasiswa->user->name,
                'alasan' => $request->alasan_penolakan,
                'admin' => auth()->user()->name
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan magang berhasil ditolak',
                'data' => [
                    'status' => 'ditolak'
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error rejecting magang application', [
                'magang_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pengajuan'
            ], 500);
        }
    }
}
