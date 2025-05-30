<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\LevelModel;
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
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('level', function($q) use ($searchTerm) {
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

    public function detailDospem($id)
    {
        // Existing code unchanged
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => '#'],
            ['label' => 'Detail Pengguna', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';
        
        return view('admin.detail_dospem', [
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function detailMahasiswa($id)
    {
        // Existing code unchanged
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => '#'],
            ['label' => 'Detail Pengguna', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';
        
        return view('admin.detail_mahasiswa', [
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
    
    public function detailAdmin($id)
    {
        // Existing code unchanged
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => '#'],
            ['label' => 'Detail Pengguna', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';
        
        return view('admin.detail_admin', [
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}
