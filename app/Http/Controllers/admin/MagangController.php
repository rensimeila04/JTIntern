<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MagangModel;
use App\Models\LowonganModel;
use App\Models\DosenPembimbingModel; // Add this import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\MagangDiterimaMail;
use App\Mail\MagangDitolakMail;

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
        
        // Add dosen list for edit modal
        $dosenList = DosenPembimbingModel::with('user')->get();

        return view('admin.kelola_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'magang' => $magang,
            'currentSearch' => $request->search ?? '',
            'currentFilter' => $request->status ?? 'all',
            'currentLowongan' => $request->lowongan_id ?? 'all',
            'lowonganList' => $lowonganList,
            'dosenList' => $dosenList, // Add this line
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
            // Validate request - Make dosen_pembimbing required
            $validator = Validator::make($request->all(), [
                'id_dosen_pembimbing' => 'required|exists:dosen_pembimbing,id_dosen_pembimbing'
            ], [
                'id_dosen_pembimbing.required' => 'Dosen pembimbing wajib dipilih',
                'id_dosen_pembimbing.exists' => 'Dosen pembimbing yang dipilih tidak valid'
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

            // Update magang status and dosen pembimbing with WIB timezone
            $updateData = [
                'status_magang' => 'diterima',
                'tanggal_diterima' => \Carbon\Carbon::now('Asia/Jakarta'),
                'id_dosen_pembimbing' => $request->id_dosen_pembimbing,
                'tanggal_ditolak' => null,
                'alasan_penolakan' => null
            ];

            $magang->update($updateData);

            // Reload relationship to get updated data
            $magang->load('dosenPembimbing.user', 'mahasiswa.user', 'lowongan.perusahaanMitra', 'lowongan.periodeMagang');

            // Send email notification
            try {
                Mail::to($magang->mahasiswa->user->email)->send(new MagangDiterimaMail($magang));
                Log::info('Email penerimaan magang berhasil dikirim', [
                    'magang_id' => $id,
                    'email' => $magang->mahasiswa->user->email,
                    'mahasiswa' => $magang->mahasiswa->user->name,
                    'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
                ]);
            } catch (\Exception $emailError) {
                Log::error('Gagal mengirim email penerimaan magang', [
                    'magang_id' => $id,
                    'email' => $magang->mahasiswa->user->email,
                    'error' => $emailError->getMessage(),
                    'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
                ]);
                // Continue process even if email fails
            }

            // Log the action
            Log::info('Magang application accepted', [
                'magang_id' => $id,
                'mahasiswa' => $magang->mahasiswa->user->name,
                'dosen_pembimbing_id' => $request->id_dosen_pembimbing,
                'dosen_pembimbing_name' => $magang->dosenPembimbing->user->name,
                'admin' => auth()->user()->name,
                'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan magang berhasil diterima dan email notifikasi telah dikirim. Dosen pembimbing: ' . $magang->dosenPembimbing->user->name,
                'data' => [
                    'status' => 'diterima',
                    'dosen_pembimbing' => $magang->dosenPembimbing->user->name,
                    'tanggal_diterima' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i') . ' WIB'
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error accepting magang application', [
                'magang_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
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

            // Update magang status with WIB timezone
            $magang->update([
                'status_magang' => 'ditolak',
                'tanggal_ditolak' => \Carbon\Carbon::now('Asia/Jakarta'),
                'alasan_penolakan' => $request->alasan_penolakan,
                'tanggal_diterima' => null,
                'id_dosen_pembimbing' => null
            ]);

            // Reload relationships for email
            $magang->load('mahasiswa.user', 'lowongan.perusahaanMitra');

            // Send email notification
            try {
                Mail::to($magang->mahasiswa->user->email)->send(new MagangDitolakMail($magang));
                Log::info('Email penolakan magang berhasil dikirim', [
                    'magang_id' => $id,
                    'email' => $magang->mahasiswa->user->email,
                    'mahasiswa' => $magang->mahasiswa->user->name,
                    'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
                ]);
            } catch (\Exception $emailError) {
                Log::error('Gagal mengirim email penolakan magang', [
                    'magang_id' => $id,
                    'email' => $magang->mahasiswa->user->email,
                    'error' => $emailError->getMessage(),
                    'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
                ]);
                // Continue process even if email fails
            }

            // Log the action
            Log::info('Magang application rejected', [
                'magang_id' => $id,
                'mahasiswa' => $magang->mahasiswa->user->name,
                'alasan' => $request->alasan_penolakan,
                'admin' => auth()->user()->name,
                'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan magang berhasil ditolak dan email notifikasi telah dikirim',
                'data' => [
                    'status' => 'ditolak',
                    'tanggal_ditolak' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i') . ' WIB'
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error rejecting magang application', [
                'magang_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pengajuan'
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $magang = MagangModel::with([
                'mahasiswa.user',
                'lowongan.perusahaanMitra',
                'dosenPembimbing.user'
            ])->findOrFail($id);

            // Get all dosen pembimbing for dropdown
            $dosenList = DosenPembimbingModel::with('user')->get();

            return response()->json([
                'success' => true,
                'magang' => $magang,
                'dosenList' => $dosenList
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching magang data for edit', [
                'magang_id' => $id,
                'error' => $e->getMessage(),
                'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data magang'
            ], 500);
        }
    }

    /**
     * Update magang data
     */
    public function update(Request $request, $id)
    {
        try {
            // Debug log untuk melihat data yang diterima
            Log::info('Update magang request received', [
                'magang_id' => $id,
                'request_data' => $request->all(),
                'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
            ]);

            // Validate request
            $validator = Validator::make($request->all(), [
                'status_magang' => 'required|in:menunggu,diterima,magang,selesai,ditolak',
                'id_dosen_pembimbing' => 'nullable|exists:dosen_pembimbing,id_dosen_pembimbing'
            ], [
                'status_magang.required' => 'Status magang wajib dipilih',
                'status_magang.in' => 'Status magang tidak valid',
                'id_dosen_pembimbing.exists' => 'Dosen pembimbing tidak valid'
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed for magang update', [
                    'magang_id' => $id,
                    'errors' => $validator->errors()->toArray(),
                    'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid: ' . $validator->errors()->first(),
                    'errors' => $validator->errors()
                ], 422);
            }

            // Find magang record
            $magang = MagangModel::findOrFail($id);
            
            // Store old data for comparison
            $oldStatus = $magang->status_magang;
            $oldDosenId = $magang->id_dosen_pembimbing;

            // Prepare update data
            $updateData = [
                'status_magang' => $request->status_magang,
            ];

            // Handle dosen pembimbing
            if ($request->has('id_dosen_pembimbing')) {
                if ($request->id_dosen_pembimbing === '' || $request->id_dosen_pembimbing === null) {
                    $updateData['id_dosen_pembimbing'] = null;
                } else {
                    $updateData['id_dosen_pembimbing'] = $request->id_dosen_pembimbing;
                }
            }

            // Set timestamps based on status changes
            if ($oldStatus !== $request->status_magang) {
                switch ($request->status_magang) {
                    case 'diterima':
                        if (!$magang->tanggal_diterima) {
                            $updateData['tanggal_diterima'] = \Carbon\Carbon::now('Asia/Jakarta');
                        }
                        $updateData['tanggal_ditolak'] = null;
                        $updateData['alasan_penolakan'] = null;
                        break;
                    case 'ditolak':
                        if (!$magang->tanggal_ditolak) {
                            $updateData['tanggal_ditolak'] = \Carbon\Carbon::now('Asia/Jakarta');
                        }
                        $updateData['tanggal_diterima'] = null;
                        // Only clear dosen if status is changing to ditolak
                        if ($oldStatus !== 'ditolak') {
                            $updateData['id_dosen_pembimbing'] = null;
                        }
                        break;
                    case 'menunggu':
                        $updateData['tanggal_diterima'] = null;
                        $updateData['tanggal_ditolak'] = null;
                        $updateData['alasan_penolakan'] = null;
                        break;
                }
            }

            // Perform database transaction to ensure consistency
            DB::beginTransaction();
            
            try {
                // Update magang
                $magang->update($updateData);
                
                // Reload relationships
                $magang->load('mahasiswa.user', 'lowongan.perusahaanMitra', 'dosenPembimbing.user');
                
                DB::commit();
                
                // Log the successful action
                Log::info('Magang data updated successfully', [
                    'magang_id' => $id,
                    'mahasiswa' => $magang->mahasiswa->user->name,
                    'old_status' => $oldStatus,
                    'new_status' => $request->status_magang,
                    'old_dosen_id' => $oldDosenId,
                    'new_dosen_id' => $magang->id_dosen_pembimbing,
                    'admin' => auth()->user()->name,
                    'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
                ]);

                $message = 'Data magang berhasil diperbarui';
                if ($oldStatus !== $request->status_magang) {
                    $message .= '. Status berubah dari ' . ucfirst($oldStatus) . ' menjadi ' . ucfirst($request->status_magang);
                }
                if ($oldDosenId !== $magang->id_dosen_pembimbing) {
                    if ($magang->dosenPembimbing) {
                        $message .= '. Dosen pembimbing: ' . $magang->dosenPembimbing->user->name;
                    } else {
                        $message .= '. Dosen pembimbing dihapus';
                    }
                }

                // Pastikan response adalah JSON yang valid dengan header yang benar
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'data' => [
                        'status' => $request->status_magang,
                        'dosen_pembimbing' => $magang->dosenPembimbing ? $magang->dosenPembimbing->user->name : null,
                        'id_dosen_pembimbing' => $magang->id_dosen_pembimbing
                    ]
                ], 200, [
                    'Content-Type' => 'application/json; charset=utf-8'
                ]);
                
            } catch (\Exception $dbError) {
                DB::rollback();
                throw $dbError;
            }

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Magang not found', [
                'magang_id' => $id,
                'error' => $e->getMessage(),
                'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Data magang tidak ditemukan'
            ], 404, [
                'Content-Type' => 'application/json; charset=utf-8'
            ]);

        } catch (\Exception $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollback();
            }
            
            Log::error('Error updating magang data', [
                'magang_id' => $id,
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
                'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500, [
                'Content-Type' => 'application/json; charset=utf-8'
            ]);
        }
    }

    /**
     * Delete magang record
     */
    public function destroy($id)
    {
        try {
            $magang = MagangModel::with('mahasiswa.user')->findOrFail($id);
            
            // Store mahasiswa name for logging
            $mahasiswaName = $magang->mahasiswa->user->name;
            
            // Delete the record
            $magang->delete();

            // Log the deletion
            Log::info('Magang data deleted', [
                'magang_id' => $id,
                'mahasiswa' => $mahasiswaName,
                'admin' => auth()->user()->name,
                'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data magang berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting magang data', [
                'magang_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'timestamp_wib' => \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data'
            ], 500);
        }
    }
}
