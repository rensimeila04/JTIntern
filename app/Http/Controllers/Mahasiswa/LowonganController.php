<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\JenisPerusahaanModel;
use App\Models\PerusahaanMitraModel;
use App\Models\LowonganModel;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => route('mahasiswa.lowongan')],
        ];

        $activeMenu = 'lowongan';
        
        // Fetch jenis perusahaan data
        $jenisPerusahaan = JenisPerusahaanModel::all();
        
        // Fetch unique company locations
        $lokasiPerusahaan = PerusahaanMitraModel::select('alamat')
            ->distinct()
            ->whereNotNull('alamat')
            ->where('alamat', '!=', '')
            ->orderBy('alamat')
            ->pluck('alamat');

        // Build query with filters
        $query = LowonganModel::with([
            'perusahaanMitra.jenisPerusahaan',
            'kompetensi',
            'periodeMagang',
            'magang'
        ])->where('status_pendaftaran', true);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('judul_lowongan', 'like', '%' . $searchTerm . '%')
                  ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%')
                  ->orWhere('persyaratan', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('perusahaanMitra', function ($subQ) use ($searchTerm) {
                      $subQ->where('nama_perusahaan_mitra', 'like', '%' . $searchTerm . '%')
                           ->orWhere('bidang_industri', 'like', '%' . $searchTerm . '%')
                           ->orWhere('alamat', 'like', '%' . $searchTerm . '%');
                  })
                  ->orWhereHas('kompetensi', function ($subQ) use ($searchTerm) {
                      $subQ->where('nama_kompetensi', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Filter by jenis magang (tipe magang)
        if ($request->filled('jenis_magang')) {
            $query->where('jenis_magang', $request->jenis_magang);
        }

        // Filter by jenis perusahaan
        if ($request->filled('jenis_perusahaan')) {
            $query->whereHas('perusahaanMitra', function ($q) use ($request) {
                $q->where('id_jenis_perusahaan', $request->jenis_perusahaan);
            });
        }

        // Filter by lokasi
        if ($request->filled('lokasi')) {
            $query->whereHas('perusahaanMitra', function ($q) use ($request) {
                $q->where('alamat', 'like', '%' . $request->lokasi . '%');
            });
        }

        $lowonganList = $query->orderBy('created_at', 'desc')->get();

        return view('mahasiswa.lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'jenisPerusahaan' => $jenisPerusahaan,
            'lokasiPerusahaan' => $lokasiPerusahaan,
            'lowonganList' => $lowonganList,
            'filters' => $request->only(['jenis_magang', 'jenis_perusahaan', 'lokasi', 'search'])
        ]);
    }
}
