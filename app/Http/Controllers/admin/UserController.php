<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';

        # Ambil data pengguna
        $user = UserModel::with('level')->get();
        $level = LevelModel::all();

        # Hitung jumlah pengguna berlevel Mahasiswa
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
        ]);
    }

    public function detailDospem($id)
    {
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
}
