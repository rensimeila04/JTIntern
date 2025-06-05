<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\JenisPerusahaanModel;
use App\Models\PerusahaanMitraModel;
use App\Models\LowonganModel;
use App\Models\MagangModel;
use App\Models\DokumenModel;
use App\Models\JenisDokumenModel;
use App\Services\MabacService;
use App\Services\TopsisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    protected $mabacService;
    protected $topsisService;

    public function __construct(MabacService $mabacService, TopsisService $topsisService)
    {
        $this->mabacService = $mabacService;
        $this->topsisService = $topsisService;
    }

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

        // Get MABAC recommendations
        $mabacRecommendations = [];
        try {
            if (Auth::user()->mahasiswa) {
                $hasilMabac = $this->mabacService->hitungRekomendasiMabac();
                
                // Extract lowongan IDs in ranking order
                $lowonganIds = [];
                foreach ($hasilMabac['ranking'] as $rank) {
                    $alternatif = $hasilMabac['alternatif'][$rank['alternatif_index']];
                    $lowonganIds[] = $alternatif['lowongan']->id_lowongan;
                }
                
                // Get lowongan in MABAC ranking order
                $mabacRecommendations = collect();
                foreach ($lowonganIds as $id) {
                    $lowongan = $lowonganList->where('id_lowongan', $id)->first();
                    if ($lowongan) {
                        $mabacRecommendations->push($lowongan);
                    }
                }
            }
        } catch (\Exception $e) {
            // Handle case where MABAC calculation fails (e.g., incomplete profile)
            $mabacRecommendations = collect();
        }

        // Get TOPSIS recommendations
        $topsisRecommendations = collect();
        try {
            if (Auth::user()->mahasiswa) {
                $hasilTopsis = $this->topsisService->hitungRekomendasiTopsis();
                
                // Check if TOPSIS calculation is successful
                if (!isset($hasilTopsis['error']) || !$hasilTopsis['error']) {
                    // Extract lowongan IDs in ranking order
                    $lowonganIds = [];
                    foreach ($hasilTopsis['ranking'] as $rank) {
                        $alternatif = $hasilTopsis['alternatif'][$rank['alternatif_index']];
                        $lowonganIds[] = $alternatif['lowongan']->id_lowongan;
                    }
                    
                    // Get lowongan in TOPSIS ranking order
                    foreach ($lowonganIds as $id) {
                        $lowongan = $lowonganList->where('id_lowongan', $id)->first();
                        if ($lowongan) {
                            $topsisRecommendations->push($lowongan);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Handle case where TOPSIS calculation fails
            $topsisRecommendations = collect();
        }

        return view('mahasiswa.lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'jenisPerusahaan' => $jenisPerusahaan,
            'lokasiPerusahaan' => $lokasiPerusahaan,
            'lowonganList' => $lowonganList,
            'mabacRecommendations' => $mabacRecommendations,
            'topsisRecommendations' => $topsisRecommendations,
            'filters' => $request->only(['jenis_magang', 'jenis_perusahaan', 'lokasi', 'search'])
        ]);
    }

    public function detail($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => route('mahasiswa.lowongan')],
            ['label' => 'Detail Lowongan', 'url' => ''],
        ];

        $activeMenu = 'lowongan';
        
        $lowongan = LowonganModel::with([
            'perusahaanMitra.jenisPerusahaan',
            'kompetensi',
            'periodeMagang',
            'magang'
        ])->findOrFail($id);

        // Get other lowongan (exclude current one) with limit 4
        $lowonganList = LowonganModel::with([
            'perusahaanMitra.jenisPerusahaan',
            'kompetensi',
            'periodeMagang',
            'magang'
        ])
        ->where('status_pendaftaran', true)
        ->where('id_lowongan', '!=', $id) // Exclude current lowongan
        ->orderBy('created_at', 'desc')
        ->limit(4) // Limit to 4 items
        ->get();

        // Check if student has already applied for this internship
        $hasApplied = false;
        if (Auth::user()->mahasiswa) {
            $hasApplied = MagangModel::where('id_mahasiswa', Auth::user()->mahasiswa->id_mahasiswa)
                ->where('id_lowongan', $id)
                ->exists();
        }

        return view('mahasiswa.detail_lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'lowongan' => $lowongan,
            'lowonganList' => $lowonganList,
            'hasApplied' => $hasApplied,
        ]);
    }

    public function checkDocuments(Request $request, $id)
    {
        try {
            $lowongan = LowonganModel::findOrFail($id);
            $mahasiswa = Auth::user()->mahasiswa;

            if (!$mahasiswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data mahasiswa tidak ditemukan.'
                ]);
            }

            // Get all required document types
            $requiredDocuments = JenisDokumenModel::all();
            
            // Get student's uploaded documents
            $studentDocuments = DokumenModel::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->get();
            
            // Check for missing documents
            $missingDocuments = [];
            foreach ($requiredDocuments as $requiredDoc) {
                $hasDocument = $studentDocuments->where('id_jenis_dokumen', $requiredDoc->id_jenis_dokumen)->isNotEmpty();
                if (!$hasDocument) {
                    $missingDocuments[] = $requiredDoc->nama;
                }
            }

            // Return document status
            if (!empty($missingDocuments)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dokumen belum lengkap',
                    'missing_documents' => $missingDocuments
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Dokumen lengkap'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
