<?php

namespace App\Services;

use App\Models\LowonganModel;
use App\Models\MahasiswaModel;
use App\Models\KriteriaModel;
use Illuminate\Support\Facades\Auth;

class MabacService
{
    protected $kriteria;
    
    public function __construct()
    {
        $this->kriteria = KriteriaModel::orderBy('id_kriteria')->get();
    }

    public function hitungRekomendasiMabac($mahasiswaId = null)
    {
        if (!$mahasiswaId) {
            $mahasiswaId = Auth::user()->mahasiswa->id_mahasiswa;
        }

        $mahasiswa = MahasiswaModel::with(['kompetensi', 'jenisPerusahaan'])->find($mahasiswaId);
        $lowonganList = LowonganModel::with([
            'perusahaanMitra.jenisPerusahaan',
            'perusahaanMitra.fasilitasPerusahaan',
            'kompetensi'
        ])->where('status_pendaftaran', true)->get();

        // 1. Penilaian Alternatif
        $alternatif = $this->penilaianAlternatif($mahasiswa, $lowonganList);
        
        // 2. Pembentukan Matriks Keputusan Awal (X)
        $matriksX = $this->pembentukanMatriksX($alternatif);
        
        // 3. Normalisasi Matriks Keputusan
        $matriksNormalisasi = $this->normalisasiMatriks($matriksX);
        
        // 4. Elemen Matriks Tertimbang (V)
        $matriksV = $this->elemenMatriksTertimbang($matriksNormalisasi);
        
        // 5. Matriks Area Perkiraan Batas (G)
        $matriksG = $this->matriksAreaPerkiraanBatas($matriksV);
        
        // 6. Elemen Matriks Jarak Alternatif (Q)
        $matriksQ = $this->elemenMatriksJarak($matriksV, $matriksG);
        
        // 7. Perankingan Alternatif (S)
        $ranking = $this->perangkinganAlternatif($matriksQ);

        return [
            'mahasiswa' => $mahasiswa,
            'alternatif' => $alternatif,
            'matriksX' => $matriksX,
            'matriksNormalisasi' => $matriksNormalisasi,
            'matriksV' => $matriksV,
            'matriksG' => $matriksG,
            'matriksQ' => $matriksQ,
            'ranking' => $ranking,
            'kriteria' => $this->kriteria
        ];
    }

    private function penilaianAlternatif($mahasiswa, $lowonganList)
    {
        $alternatif = [];
        
        foreach ($lowonganList as $lowongan) {
            $skor = [];
            
            // Jenis Perusahaan
            $skor['jenis_perusahaan'] = ($mahasiswa->id_jenis_perusahaan == $lowongan->perusahaanMitra->id_jenis_perusahaan) ? 2 : 1;
            
            // Kompetensi
            $skor['kompetensi'] = ($mahasiswa->id_kompetensi == $lowongan->id_kompetensi) ? 2 : 1;
            
            // Fasilitas
            $skor['fasilitas'] = $lowongan->perusahaanMitra->fasilitasPerusahaan->count();
            if ($skor['fasilitas'] == 0) $skor['fasilitas'] = 1; // Minimal 1
            
            // Jenis Magang
            $skor['jenis_magang'] = ($mahasiswa->jenis_magang == $lowongan->jenis_magang) ? 2 : 1;
            
            // Lokasi (jarak dalam km)
            $jarak = $this->hitungJarak(
                $mahasiswa->latitude_preferensi, 
                $mahasiswa->longitude_preferensi,
                $lowongan->perusahaanMitra->latitude,
                $lowongan->perusahaanMitra->longitude
            );
            $skor['lokasi'] = max(1, round($jarak, 2)); // Minimal 1 km
            
            $alternatif[] = [
                'lowongan' => $lowongan,
                'skor' => $skor
            ];
        }
        
        return $alternatif;
    }

    private function pembentukanMatriksX($alternatif)
    {
        $matriks = [];
        foreach ($alternatif as $alt) {
            $matriks[] = array_values($alt['skor']);
        }
        return $matriks;
    }

    private function normalisasiMatriks($matriksX)
    {
        $matriksNormalisasi = [];
        $jumlahKriteria = count($this->kriteria);
        
        // Hitung min dan max untuk setiap kriteria
        $minMax = [];
        for ($j = 0; $j < $jumlahKriteria; $j++) {
            $kolom = array_column($matriksX, $j);
            $minMax[$j] = [
                'min' => min($kolom),
                'max' => max($kolom)
            ];
        }
        
        // Normalisasi
        for ($i = 0; $i < count($matriksX); $i++) {
            $baris = [];
            for ($j = 0; $j < $jumlahKriteria; $j++) {
                $nilai = $matriksX[$i][$j];
                $min = $minMax[$j]['min'];
                $max = $minMax[$j]['max'];
                
                if ($this->kriteria[$j]->jenis == 'benefit') {
                    // Normalisasi benefit
                    $normalized = ($max == $min) ? 1 : ($nilai - $min) / ($max - $min);
                } else {
                    // Normalisasi cost
                    $normalized = ($max == $min) ? 1 : ($nilai - $max) / ($min - $max);
                }
                
                $baris[] = round($normalized, 4);
            }
            $matriksNormalisasi[] = $baris;
        }
        
        return $matriksNormalisasi;
    }

    private function elemenMatriksTertimbang($matriksNormalisasi)
    {
        $matriksV = [];
        
        for ($i = 0; $i < count($matriksNormalisasi); $i++) {
            $baris = [];
            for ($j = 0; $j < count($this->kriteria); $j++) {
                $bobot = $this->kriteria[$j]->bobot;
                $nilai = $matriksNormalisasi[$i][$j];
                $v = ($bobot * $nilai) + $bobot;
                $baris[] = round($v, 4);
            }
            $matriksV[] = $baris;
        }
        
        return $matriksV;
    }

    private function matriksAreaPerkiraanBatas($matriksV)
    {
        $matriksG = [];
        $jumlahAlternatif = count($matriksV);
        
        // Menggunakan rumus geometric mean: gi = (∏vij)^(1/m)
        // dimana m adalah jumlah alternatif
        for ($j = 0; $j < count($this->kriteria); $j++) {
            $kolom = array_column($matriksV, $j);
            
            // Hitung perkalian semua elemen dalam kolom
            $perkalian = 1;
            foreach ($kolom as $nilai) {
                $perkalian *= $nilai;
            }
            
            // Hitung akar pangkat m (geometric mean)
            $g = pow($perkalian, 1 / $jumlahAlternatif);
            $matriksG[] = round($g, 4);
        }
        
        return $matriksG;
    }

    private function elemenMatriksJarak($matriksV, $matriksG)
    {
        $matriksQ = [];
        
        for ($i = 0; $i < count($matriksV); $i++) {
            $baris = [];
            for ($j = 0; $j < count($this->kriteria); $j++) {
                $q = $matriksV[$i][$j] - $matriksG[$j];
                $baris[] = round($q, 4);
            }
            $matriksQ[] = $baris;
        }
        
        return $matriksQ;
    }

    private function perangkinganAlternatif($matriksQ)
    {
        $ranking = [];
        
        for ($i = 0; $i < count($matriksQ); $i++) {
            $s = array_sum($matriksQ[$i]);
            $ranking[] = [
                'alternatif_index' => $i,
                'nilai_s' => round($s, 4)
            ];
        }
        
        // Urutkan berdasarkan nilai S (descending)
        usort($ranking, function($a, $b) {
            return $b['nilai_s'] <=> $a['nilai_s'];
        });
        
        return $ranking;
    }

    private function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        if (!$lat1 || !$lon1 || !$lat2 || !$lon2) {
            return 100; // Default jarak jika koordinat tidak tersedia
        }

        $earthRadius = 6371; // Radius bumi dalam km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = $earthRadius * $c;

        return $distance;
    }
}