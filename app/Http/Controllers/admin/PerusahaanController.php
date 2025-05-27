<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerusahaanMitraModel;
use App\Models\JenisPerusahaanModel;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan_mitra';
        
        // Query builder untuk perusahaan mitra
        $query = PerusahaanMitraModel::with('jenisPerusahaan');
        
        // Filter berdasarkan jenis perusahaan
        if ($request->filled('jenis_perusahaan') && $request->jenis_perusahaan != 'all') {
            $query->where('id_jenis_perusahaan', $request->jenis_perusahaan);
        }
        
        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_perusahaan_mitra', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('bidang_industri', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('alamat', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('jenisPerusahaan', function($q) use ($searchTerm) {
                      $q->where('nama_jenis_perusahaan', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }
        
        $perusahaanMitra = $query->paginate(10)->appends($request->query());
        $jenisPerusahaan = JenisPerusahaanModel::all();
        
        return view('admin.perusahaan', [
            'breadcrumb' => $breadcrumb,
            'perusahaanMitra' => $perusahaanMitra,
            'jenisPerusahaan' => $jenisPerusahaan,
            'activeMenu' => $activeMenu,
            'currentFilter' => $request->jenis_perusahaan ?? 'all',
            'currentSearch' => $request->search ?? ''
        ]);
    }

    public function detail($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => route('admin.perusahaan')],
            ['label' => 'Detail', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan_mitra';
        
        // Ambil data perusahaan dengan relasi
        $perusahaan = PerusahaanMitraModel::with('jenisPerusahaan')
            ->findOrFail($id);
        
        return view('admin.detail_perusahaan_mitra', [
            'perusahaan' => $perusahaan,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => route('admin.perusahaan')],
            ['label' => 'Tambah', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan_mitra';
        $jenisPerusahaan = JenisPerusahaanModel::all();
        
        return view('admin.tambah_perusahaan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'jenisPerusahaan' => $jenisPerusahaan
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'email_perusahaan' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'alamat_perusahaan' => 'required|string',
            'jenis_perusahaan_id' => 'required|exists:jenis_perusahaan,id_jenis_perusahaan',
            'bidang_industri' => 'required|string|max:255',
            'tentang_perusahaan' => 'nullable|string',
            'logo_perusahaan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat_latitude' => 'nullable|numeric',
            'alamat_longitude' => 'nullable|numeric',
        ]);

        // Handle logo upload
        $logoPath = null;
        
        if ($request->hasFile('logo_perusahaan')) {
            // Create custom filename with timestamp
            $file = $request->file('logo_perusahaan');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Store in public/storage/logo_perusahaan directory
            $logoPath = $file->storeAs('logo_perusahaan', $filename, 'public');
        }

        // Map form fields to database fields
        $data = [
            'nama_perusahaan_mitra' => $validated['nama_perusahaan'],
            'email' => $validated['email_perusahaan'],
            'telepon' => $validated['nomor_telepon'],
            'alamat' => $validated['alamat_perusahaan'],
            'id_jenis_perusahaan' => $validated['jenis_perusahaan_id'],
            'bidang_industri' => $validated['bidang_industri'],
            'tentang' => $validated['tentang_perusahaan'] ?? null,
            'logo' => $logoPath,
            'latitude' => $validated['alamat_latitude'] ?? null,
            'longitude' => $validated['alamat_longitude'] ?? null,
        ];

        PerusahaanMitraModel::create($data);
        
        return redirect()->route('admin.perusahaan')
            ->with('success', 'Perusahaan mitra berhasil ditambahkan');
    }
}
