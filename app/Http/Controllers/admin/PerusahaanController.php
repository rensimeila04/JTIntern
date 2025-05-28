<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerusahaanMitraModel;
use App\Models\JenisPerusahaanModel;
use App\Models\FasilitasModel;
use App\Models\FasilitasPerusahaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $perusahaan = PerusahaanMitraModel::with(['jenisPerusahaan', 'fasilitasPerusahaan.fasilitas'])
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
        $fasilitas = FasilitasModel::all();
        
        return view('admin.tambah_perusahaan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'jenisPerusahaan' => $jenisPerusahaan,
            'fasilitas' => $fasilitas
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
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'exists:fasilitas,id_fasilitas',
        ]);

        try {
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

            // Create the company
            $perusahaan = PerusahaanMitraModel::create($data);
            
            // Save facilities if selected
            if (!empty($validated['fasilitas'])) {
                foreach ($validated['fasilitas'] as $fasilitasId) {
                    FasilitasPerusahaanModel::create([
                        'id_perusahaan_mitra' => $perusahaan->id_perusahaan_mitra,
                        'id_fasilitas' => $fasilitasId,
                    ]);
                }
            }
            
            return redirect()->route('admin.perusahaan.create')
                ->with([
                    'success' => true,
                    'company_name' => $validated['nama_perusahaan'],
                    'message' => 'Perusahaan mitra berhasil ditambahkan'
                ]);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => route('admin.perusahaan')],
            ['label' => 'Edit', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan_mitra';
        
        // Ambil data perusahaan dengan relasi fasilitas
        $perusahaan = PerusahaanMitraModel::with('fasilitasPerusahaan')->findOrFail($id);
        $jenisPerusahaan = JenisPerusahaanModel::all();
        $fasilitas = FasilitasModel::all();
        
        // Ambil ID fasilitas yang sudah dipilih
        $selectedFasilitas = $perusahaan->fasilitasPerusahaan->pluck('id_fasilitas')->toArray();
        
        return view('admin.edit_perusahaan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'perusahaan' => $perusahaan,
            'jenisPerusahaan' => $jenisPerusahaan,
            'fasilitas' => $fasilitas,
            'selectedFasilitas' => $selectedFasilitas
        ]);
    }

    public function update(Request $request, $id)
    {
        $perusahaan = PerusahaanMitraModel::findOrFail($id);
        
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
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'exists:fasilitas,id_fasilitas',
        ]);

        // Handle logo upload
        $logoPath = $perusahaan->logo; // Keep existing logo by default
        
        if ($request->hasFile('logo_perusahaan')) {
            // Delete old logo if it exists and is not a placeholder
            if ($perusahaan->logo && !str_starts_with($perusahaan->logo, 'images/')) {
                Storage::disk('public')->delete($perusahaan->logo);
            }
            
            // Upload new logo
            $file = $request->file('logo_perusahaan');
            $filename = time() . '_' . $file->getClientOriginalName();
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

        // Update the company
        $perusahaan->update($data);
        
        // Update facilities
        // Delete existing facilities
        FasilitasPerusahaanModel::where('id_perusahaan_mitra', $id)->delete();
        
        // Save new facilities if selected
        if (!empty($validated['fasilitas'])) {
            foreach ($validated['fasilitas'] as $fasilitasId) {
                FasilitasPerusahaanModel::create([
                    'id_perusahaan_mitra' => $id,
                    'id_fasilitas' => $fasilitasId,
                ]);
            }
        }
        
        return redirect()->route('admin.perusahaan')
            ->with('success', 'Perusahaan mitra berhasil diperbarui');
    }

    public function destroy($id)
    {
        try {
            $perusahaan = PerusahaanMitraModel::findOrFail($id);
            
            // Check if company has active internships/lowongan
            if ($perusahaan->lowongan()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Perusahaan tidak dapat dihapus karena masih memiliki lowongan aktif'
                ], 422);
            }
            
            // Delete associated facilities first
            FasilitasPerusahaanModel::where('id_perusahaan_mitra', $id)->delete();
            
            // Delete logo file if exists and is not a placeholder
            if ($perusahaan->logo && !str_starts_with($perusahaan->logo, 'images/')) {
                Storage::disk('public')->delete($perusahaan->logo);
            }
            
            // Delete the company
            $perusahaan->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Perusahaan mitra berhasil dihapus'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus perusahaan: ' . $e->getMessage()
            ], 500);
        }
    }
}
