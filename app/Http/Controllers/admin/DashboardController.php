<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KompetensiModel;
use Illuminate\Http\Request;
use App\Models\MagangModel;
use App\Models\UserModel;
use App\Models\LevelModel;
use App\Models\PerusahaanMitraModel;
use App\Models\LowonganModel;
use App\Models\MahasiswaModel;
use App\Models\FeedbackModel;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Dashboard', 'url' => '#'],
        ];

        $activeMenu = 'dashboard';

        // Count total user, perusahaan, lowongan, and magang

        // Count Mahasiswa
        $countMahasiswa = UserModel::whereHas('level', function ($query) {
            $query->where('kode_level', 'MHS');
        })->count();

        // Count Dosen Pembimbing
        $countDosenPembimbing = UserModel::whereHas('level', function ($query) {
            $query->where('kode_level', 'DSP');
        })->count();

        // Count Perusahaan Mitra
        $countPerusahaanMitra = PerusahaanMitraModel::count();

        // Count Lowongan
        $countLowongan = LowonganModel::count();

        // Count Tren Peminatan - Dengan semua kompetensi termasuk yang jumlah mahasiswanya 0
        $trenPeminatan = KompetensiModel::select('kompetensi.id_kompetensi', 'kompetensi.nama_kompetensi', DB::raw('COUNT(mahasiswa.id_mahasiswa) as total'))
            ->leftJoin('mahasiswa', 'kompetensi.id_kompetensi', '=', 'mahasiswa.id_kompetensi')
            ->groupBy('kompetensi.id_kompetensi', 'kompetensi.nama_kompetensi')
            ->orderBy('total', 'desc')
            ->get();

        // Ambil label dan data langsung dari hasil query
        $trenPeminatanLabel = $trenPeminatan->pluck('nama_kompetensi');
        $trenPeminatanData = $trenPeminatan->pluck('total');

        // Count feedback berdasarkan kepuasan rekomendasi
        $feedbackKepuasanRekomendasi = FeedbackModel::select('kepuasan_rekomendasi', DB::raw('COUNT(*) as total'))
            ->groupBy('kepuasan_rekomendasi')
            ->get();

        // Count feedback berdasarkan kesesuaian rekomendasi
        $feedbackKesesuaianRekomendasi = FeedbackModel::select('kesesuaian_rekomendasi', DB::raw('COUNT(*) as total'))
            ->groupBy('kesesuaian_rekomendasi')
            ->get();

        // Hitung total feedback kepuasan
        $totalFeedbackKepuasan = $feedbackKepuasanRekomendasi->sum('total');

        // Hitung total feedback kesesuaian
        $totalFeedbackKesesuaian = $feedbackKesesuaianRekomendasi->sum('total');

        $feedbackKepuasanLabel = [
            'Sangat Puas' => 'Sangat Puas',
            'Puas' => 'Puas',
            'Netral' => 'Netral',
            'Tidak Puas' => 'Tidak Puas',
            'Sangat Tidak Puas' => 'Sangat Tidak Puas',
        ];

        $feedbackKesesuaianLabel = [
            'Sangat Sesuai' => 'Sangat Sesuai',
            'Sesuai' => 'Sesuai',
            'Cukup Sesuai' => 'Cukup Sesuai',
            'Kurang Sesuai' => 'Kurang Sesuai',
            'Tidak Sesuai' => 'Tidak Sesuai',
        ];

        // Inisialisasi array untuk feedback kepuasan
        $feedbackKepuasanData = [];

        // Inisialisasi array untuk feedback kesesuaian
        $feedbackKesesuaianData = [];


        foreach ($feedbackKepuasanLabel as $nilai => $label) {
            $feedbackKepuasanData[$nilai] = [
                'label' => $label,
                'total' => 0,
                'persentase' => 0,
            ];
        }

        foreach ($feedbackKesesuaianLabel as $nilai => $label) {
            $feedbackKesesuaianData[$nilai] = [
                'label' => $label,
                'total' => 0,
                'persentase' => 0,
            ];
        }


        // Hitung total feedback kepuasan
        foreach ($feedbackKepuasanRekomendasi as $item) {
            $nilai = $item->kepuasan_rekomendasi;
            if (isset($feedbackKepuasanData[$nilai])) {
                $feedbackKepuasanData[$nilai]['total'] = $item->total;
                $feedbackKepuasanData[$nilai]['persentase'] = $totalFeedbackKepuasan > 0 ? round(($item->total / $totalFeedbackKepuasan) * 100, 2) : 0;
            }
        }

        foreach ($feedbackKesesuaianRekomendasi as $item) {
            $nilai = $item->kesesuaian_rekomendasi;
            if (isset($feedbackKesesuaianData[$nilai])) {
                $feedbackKesesuaianData[$nilai]['total'] = $item->total;
                $feedbackKesesuaianData[$nilai]['persentase'] = $totalFeedbackKesesuaian > 0 ? round(($item->total / $totalFeedbackKesesuaian) * 100, 2) : 0;
            }
        }

        return view('admin.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'countMahasiswa' => $countMahasiswa,
            'countDosenPembimbing' => $countDosenPembimbing,
            'countPerusahaanMitra' => $countPerusahaanMitra,
            'countLowongan' => $countLowongan,
            'trenPeminatanLabel' => $trenPeminatanLabel,
            'trenPeminatanData' => $trenPeminatanData,
            'feedbackKepuasanData' => $feedbackKepuasanData,
            'totalFeedbackKepuasan' => $totalFeedbackKepuasan,
            'feedbackKesesuaianData' => $feedbackKesesuaianData,
            'totalFeedbackKesesuaian' => $totalFeedbackKesesuaian,
        ]);
    }
}
