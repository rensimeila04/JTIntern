<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerusahaanMitraModel;
use App\Models\PeriodeMagangModel;
use App\Models\KompetensiModel;
use App\Models\LowonganModel;
use Illuminate\Support\Facades\Validator;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        // Query builder untuk lowongan dengan relasi
        $query = LowonganModel::with(['perusahaanMitra', 'periodeMagang', 'kompetensi']);

        // Filter berdasarkan periode
        if ($request->filled('periode') && $request->periode != 'all') {
            $query->where('id_periode_magang', $request->periode);
        }

        // Filter berdasarkan perusahaan
        if ($request->filled('perusahaan') && $request->perusahaan != 'all') {
            $query->where('id_perusahaan_mitra', $request->perusahaan);
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul_lowongan', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('perusahaanMitra', function($q) use ($searchTerm) {
                      $q->where('nama_perusahaan_mitra', 'LIKE', "%{$searchTerm}%");
                  })
                  ->orWhereHas('kompetensi', function($q) use ($searchTerm) {
                      $q->where('nama_kompetensi', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        $lowongan = $query->orderBy('created_at', 'desc')->paginate(5)->appends($request->query());
        
        // Data untuk dropdown filter
        $periodeList = PeriodeMagangModel::all();
        $perusahaanList = PerusahaanMitraModel::all();

        $data = [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'lowongan' => $lowongan,
            'periodeList' => $periodeList,
            'perusahaanList' => $perusahaanList,
            'currentPeriode' => $request->periode ?? 'all',
            'currentPerusahaan' => $request->perusahaan ?? 'all',
            'currentSearch' => $request->search ?? ''
        ];

        // Check if this is an AJAX request for live search
        if ($request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            // Return only the lowongan container content for AJAX requests
            return view('admin.lowongan', $data);
        }

        return view('admin.lowongan', $data);
    }

    public function detailLowongan($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => route('admin.lowongan')],
            ['label' => 'Detail Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        // Ambil data lowongan dengan relasi
        $lowongan = LowonganModel::with(['perusahaanMitra', 'periodeMagang', 'kompetensi'])
                                 ->findOrFail($id);

        return view('admin.detail_lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'lowongan' => $lowongan
        ]);
    }

    public function tambahLowongan()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => route('admin.lowongan')],
            ['label' => 'Tambah Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        $perusahaan = PerusahaanMitraModel::all();
        $periode = PeriodeMagangModel::all();
        $kompetensi = KompetensiModel::all();

        return view('admin.tambah_lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'perusahaan' => $perusahaan,
            'periode' => $periode,
            'kompetensi' => $kompetensi,
        ]);
    }

    public function storeLowongan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_perusahaan_mitra' => 'required|exists:perusahaan_mitra,id_perusahaan_mitra',
            'id_periode_magang' => 'required|exists:periode_magang,id_periode_magang',
            'judul_lowongan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'persyaratan' => 'required|string',
            'id_kompetensi' => 'required|exists:kompetensi,id_kompetensi',
            'jenis_magang' => 'required|in:wfo,remote,hybrid',
            'deadline_pendaftaran' => 'nullable|date',
            'test' => 'nullable|boolean',
            'informasi_test' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        LowonganModel::create([
            'id_perusahaan_mitra' => $request->id_perusahaan_mitra,
            'id_periode_magang' => $request->id_periode_magang,
            'judul_lowongan' => $request->judul_lowongan,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'id_kompetensi' => $request->id_kompetensi,
            'jenis_magang' => $request->jenis_magang,
            'status_pendaftaran' => true,
            'deadline_pendaftaran' => $request->deadline_pendaftaran,
            'test' => $request->test ? true : false,
            'informasi_test' => $request->informasi_test,
        ]);

        return redirect()->route('admin.lowongan.tambah')->with([
            'success' => true,
            'judul_lowongan' => $request->judul_lowongan
        ]);
    }

    public function editLowongan($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => route('admin.lowongan')],
            ['label' => 'Edit Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        // Get the lowongan data
        $lowongan = LowonganModel::with(['perusahaanMitra', 'periodeMagang', 'kompetensi'])
                                 ->findOrFail($id);

        // Get all data for dropdowns
        $perusahaan = PerusahaanMitraModel::all();
        $periode = PeriodeMagangModel::all();
        $kompetensi = KompetensiModel::all();

        return view('admin.edit_lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'lowongan' => $lowongan,
            'perusahaan' => $perusahaan,
            'periode' => $periode,
            'kompetensi' => $kompetensi,
        ]);
    }

    public function updateLowongan(Request $request, $id)
    {
        $lowongan = LowonganModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'id_perusahaan_mitra' => 'required|exists:perusahaan_mitra,id_perusahaan_mitra',
            'id_periode_magang' => 'required|exists:periode_magang,id_periode_magang',
            'judul_lowongan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'persyaratan' => 'required|string',
            'id_kompetensi' => 'required|exists:kompetensi,id_kompetensi',
            'jenis_magang' => 'required|in:wfo,remote,hybrid',
            'deadline_pendaftaran' => 'nullable|date',
            'test' => 'nullable|boolean',
            'informasi_test' => 'nullable|string',
            'status_pendaftaran' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $lowongan->update([
            'id_perusahaan_mitra' => $request->id_perusahaan_mitra,
            'id_periode_magang' => $request->id_periode_magang,
            'judul_lowongan' => $request->judul_lowongan,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'id_kompetensi' => $request->id_kompetensi,
            'jenis_magang' => $request->jenis_magang,
            'status_pendaftaran' => $request->status_pendaftaran ? true : false,
            'deadline_pendaftaran' => $request->deadline_pendaftaran,
            'test' => $request->test ? true : false,
            'informasi_test' => $request->informasi_test,
        ]);

        return redirect()->route('admin.lowongan.edit', $id)->with([
            'success' => true,
            'judul_lowongan' => $request->judul_lowongan,
            'message' => 'Data lowongan berhasil diperbarui'
        ]);
    }
}
