<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerusahaanMitraModel;
use App\Models\JenisPerusahaanModel;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan_mitra';
        $perusahaanMitra = PerusahaanMitraModel::with('jenisPerusahaan')->get();
        $jenisPerusahaan = JenisPerusahaanModel::all();
        return view('admin.perusahaan', [
            'breadcrumb' => $breadcrumb,
            'perusahaanMitra' => $perusahaanMitra,
            'jenisPerusahaan' => $jenisPerusahaan,
            'activeMenu' => $activeMenu
        ]);
    }

    public function detail($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => '#'],
            ['label' => 'Detail', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan-mitra';
        
        return view('admin.detail_perusahaan_mitra', [
            'id' => $id,
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
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jenis_perusahaan_id' => 'required|exists:jenis_perusahaan,id',
            'website' => 'nullable|url|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        
        PerusahaanMitraModel::create($validated);
        
        return redirect()->route('admin.perusahaan')
            ->with('success', 'Perusahaan mitra berhasil ditambahkan');
    }
}
