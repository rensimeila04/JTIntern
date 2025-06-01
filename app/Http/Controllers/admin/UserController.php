<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\LevelModel;
use App\Models\DokumenModel;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';

        // Query builder for users
        $query = UserModel::with('level');

        // Filter based on level
        if ($request->filled('level_id') && $request->level_id != 'all') {
            $query->where('id_level', $request->level_id);
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('level', function ($q) use ($searchTerm) {
                        $q->where('nama_level', 'LIKE', "%{$searchTerm}%");
                    });
            });
        }

        $user = $query->paginate(10)->appends($request->query());
        $level = LevelModel::all();

        # Hitung jumlah pengguna sesuai dengan levelnya
        $mahasiswaLevelId = LevelModel::where('kode_level', 'MHS')->value('id_level');
        $jumlahMahasiswa = UserModel::where('id_level', $mahasiswaLevelId)->count();

        $dosenLevelId = LevelModel::where('kode_level', 'DSP')->value('id_level');
        $jumlahDosen = UserModel::where('id_level', $dosenLevelId)->count();

        $adminLevelId = LevelModel::where('kode_level', 'ADM')->value('id_level');
        $jumlahAdmin = UserModel::where('id_level', $adminLevelId)->count();

        return view('admin.pengguna', [
            'breadcrumb' => $breadcrumb,
            'user' => $user,
            'level' => $level,
            'jumlahMahasiswa' => $jumlahMahasiswa,
            'jumlahDosen' => $jumlahDosen,
            'jumlahAdmin' => $jumlahAdmin,
            'activeMenu' => $activeMenu,
            'currentFilter' => $request->level_id ?? 'all',
            'currentSearch' => $request->search ?? ''
        ]);
    }

    public function detailDospem(Request $request, $id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => route('admin.pengguna')],
            ['label' => 'Detail Dosen Pembimbing', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';

        // Load the user with dosen_pembimbing relationship
        $user = UserModel::with(['dosenPembimbing'])->findOrFail($id);

        if (!$user || !$user->dosenPembimbing) {
            return redirect()->route('admin.pengguna')
                ->with('error', 'Pengguna tidak ditemukan atau bukan dosen pembimbing.');
        }

        // Build query for mahasiswa bimbingan
        $query = \App\Models\MagangModel::with([
                'mahasiswa.user',
                'lowongan.perusahaanMitra'
            ])
            ->where('id_dosen_pembimbing', $user->dosenPembimbing->id_dosen_pembimbing);
        
        // Filter by status
        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status_magang', $request->status);
        }
        
        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                // Search in mahasiswa's name or NIM
                $q->whereHas('mahasiswa', function($subQ) use ($searchTerm) {
                    $subQ->where('nim', 'LIKE', "%{$searchTerm}%")
                        ->orWhereHas('user', function($userQ) use ($searchTerm) {
                            $userQ->where('name', 'LIKE', "%{$searchTerm}%");
                        });
                })
                // Or search in lowongan title
                ->orWhereHas('lowongan', function($subQ) use ($searchTerm) {
                    $subQ->where('judul_lowongan', 'LIKE', "%{$searchTerm}%")
                        // Or search in perusahaan name
                        ->orWhereHas('perusahaanMitra', function($companyQ) use ($searchTerm) {
                            $companyQ->where('nama_perusahaan_mitra', 'LIKE', "%{$searchTerm}%");
                        });
                });
            });
        }
        
        // Paginate results
        $mahasiswaBimbingan = $query->paginate(10)->appends($request->query());

        return view('admin.detail_dospem', [
            'user' => $user,
            'dosenPembimbing' => $user->dosenPembimbing,
            'mahasiswaBimbingan' => $mahasiswaBimbingan,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'currentStatus' => $request->status ?? 'all',
            'currentSearch' => $request->search ?? ''
        ]);
    }

    public function detailMahasiswa($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => route('admin.pengguna')],
            ['label' => 'Detail Mahasiswa', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';

        // Load user with mahasiswa relationship and all related data
        $user = UserModel::with([
            'mahasiswa.programStudi',
            'mahasiswa.kompetensi',
            'mahasiswa.jenisPerusahaan',
            'mahasiswa.magang.lowongan.perusahaanMitra',
            'mahasiswa.magang.dosenPembimbing.user'
        ])->findOrFail($id);

        if (!$user || !$user->mahasiswa) {
            return redirect()->route('admin.pengguna')
                ->with('error', 'Pengguna tidak ditemukan atau bukan mahasiswa.');
        }

        // Get all documents uploaded by this student
        $dokumen = DokumenModel::with('jenisDokumen')
            ->where('id_mahasiswa', $user->mahasiswa->id_mahasiswa)
            ->get();

        // Get latest internship if any
        $latestMagang = $user->mahasiswa->magang()->latest()->first();

        return view('admin.detail_mahasiswa', [
            'user' => $user,
            'mahasiswa' => $user->mahasiswa,
            'dokumen' => $dokumen,
            'latestMagang' => $latestMagang,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function detailAdmin($id)
    {
        // Existing code unchanged
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => route('admin.pengguna')],
            ['label' => 'Detail Pengguna', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';


        $user = UserModel::with('admin')->findOrFail($id);

        if (!$user || !$user->admin) {
            return redirect()->route('admin.pengguna')
                ->with('error', 'Pengguna tidak ditemukan atau bukan admin.');
        }

        return view('admin.detail_admin', [
            'user' => $user,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function edit() 
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Edit Pengguna', 'url' => '#'],
        ];

        $activeMenu = '';

        return view('admin.edit_profile', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}
