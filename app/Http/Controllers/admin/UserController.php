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

        # ambil parameter level_id dari url, jika tidak ada maka akan bernilai null
        $levelId = $request->query('level_id');

        # melakukan pengecekan apakah level_id ada di dalam request
        if ($levelId) { # paginate di sini digunakan untuk membatasi jumlah data yang ditampilkan per halaman
            $user = UserModel::with('level')->where('id_level', $levelId)->paginate(10);
            $labelFilter = LevelModel::find($levelId)->nama_level ?? 'Semua Pengguna'; # maksud dari ?? (Null Coalescing) disini adalah sebagai penentu nilai mana yang dikembalikan
                                                                                           # kalau nama_level nya gak ditemukan, maka akan mengembalikan 'Semua Pengguna'
                                                                                           # kalau ada ya nama_level nya yang dikembalikan
        } else {
            $user = UserModel::with('level')->paginate(10);
            $labelFilter = 'Semua Pengguna';
        }

        # tujuannya agar di halaman yang lain, filter masih bisa digunakan
        $user->appends($request->query());

        
        # Ambil data level
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
            'labelFilter' => $labelFilter,
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
