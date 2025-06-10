<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MagangModel;

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
}
