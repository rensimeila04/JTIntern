<?php

namespace App\Services;

use App\Models\LowonganModel;
use App\Models\MahasiswaModel;
use App\Models\KriteriaModel;
use Illuminate\Support\Facades\Auth;

class TopsisService
{
    protected $kriteria;
    
    public function __construct()
    {
        $this->kriteria = KriteriaModel::orderBy('id_kriteria')->get();
    }

    public function hitungRekomendasiTopsis($mahasiswaId = null)
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
        
        // 4. Matriks Ternormalisasi Terbobot (Y)
        $matriksY = $this->matriksTernormalisasiTerbobot($matriksNormalisasi);
        
        // 5. Solusi Ideal Positif (A+)
        $solusiIdealPositif = $this->solusiIdealPositif($matriksY);
        
        // 6. Solusi Ideal Negatif (A-)
        $solusiIdealNegatif = $this->solusiIdealNegatif($matriksY);
        
        // 7. Jarak terhadap A+
        $jarakPositif = $this->hitungJarakPositif($matriksY, $solusiIdealPositif);
        
        // 8. Jarak terhadap A-
        $jarakNegatif = $this->hitungJarakNegatif($matriksY, $solusiIdealNegatif);
        
        // 9. Nilai Preferensi (V)
        $nilaiPreferensi = $this->hitungNilaiPreferensi($jarakPositif, $jarakNegatif);
        
        // 10. Perankingan
        $ranking = $this->perangkinganAlternatif($nilaiPreferensi);

        return [
            'mahasiswa' => $mahasiswa,
            'alternatif' => $alternatif,
            'matriksX' => $matriksX,
            'matriksNormalisasi' => $matriksNormalisasi,
            'matriksY' => $matriksY,
            'solusiIdealPositif' => $solusiIdealPositif,
            'solusiIdealNegatif' => $solusiIdealNegatif,
            'jarakPositif' => $jarakPositif,
            'jarakNegatif' => $jarakNegatif,
            'nilaiPreferensi' => $nilaiPreferensi,
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
        
        // Hitung sum of squares untuk setiap kriteria
        $sumSquares = [];
        for ($j = 0; $j < $jumlahKriteria; $j++) {
            $kolom = array_column($matriksX, $j);
            $sumSquares[$j] = sqrt(array_sum(array_map(function($x) { return $x * $x; }, $kolom)));
        }
        
        // Normalisasi dengan formula: xij / sqrt(sum(xij^2))
        for ($i = 0; $i < count($matriksX); $i++) {
            $baris = [];
            for ($j = 0; $j < $jumlahKriteria; $j++) {
                $normalized = $sumSquares[$j] > 0 ? $matriksX[$i][$j] / $sumSquares[$j] : 0;
                $baris[] = round($normalized, 4);
            }
            $matriksNormalisasi[] = $baris;
        }
        
        return $matriksNormalisasi;
    }

    private function matriksTernormalisasiTerbobot($matriksNormalisasi)
    {
        $matriksY = [];
        
        for ($i = 0; $i < count($matriksNormalisasi); $i++) {
            $baris = [];
            for ($j = 0; $j < count($this->kriteria); $j++) {
                $bobot = $this->kriteria[$j]->bobot;
                $nilai = $matriksNormalisasi[$i][$j];
                $y = $bobot * $nilai;
                $baris[] = round($y, 4);
            }
            $matriksY[] = $baris;
        }
        
        return $matriksY;
    }

    private function solusiIdealPositif($matriksY)
    {
        $solusiIdeal = [];
        
        for ($j = 0; $j < count($this->kriteria); $j++) {
            $kolom = array_column($matriksY, $j);
            
            if ($this->kriteria[$j]->jenis == 'benefit') {
                $solusiIdeal[] = max($kolom);
            } else {
                $solusiIdeal[] = min($kolom);
            }
        }
        
        return $solusiIdeal;
    }

    private function solusiIdealNegatif($matriksY)
    {
        $solusiIdeal = [];
        
        for ($j = 0; $j < count($this->kriteria); $j++) {
            $kolom = array_column($matriksY, $j);
            
            if ($this->kriteria[$j]->jenis == 'benefit') {
                $solusiIdeal[] = min($kolom);
            } else {
                $solusiIdeal[] = max($kolom);
            }
        }
        
        return $solusiIdeal;
    }

    private function hitungJarakPositif($matriksY, $solusiIdealPositif)
    {
        $jarak = [];
        
        for ($i = 0; $i < count($matriksY); $i++) {
            $sumSquares = 0;
            for ($j = 0; $j < count($this->kriteria); $j++) {
                $diff = $matriksY[$i][$j] - $solusiIdealPositif[$j];
                $sumSquares += $diff * $diff;
            }
            $jarak[] = round(sqrt($sumSquares), 4);
        }
        
        return $jarak;
    }

    private function hitungJarakNegatif($matriksY, $solusiIdealNegatif)
    {
        $jarak = [];
        
        for ($i = 0; $i < count($matriksY); $i++) {
            $sumSquares = 0;
            for ($j = 0; $j < count($this->kriteria); $j++) {
                $diff = $matriksY[$i][$j] - $solusiIdealNegatif[$j];
                $sumSquares += $diff * $diff;
            }
            $jarak[] = round(sqrt($sumSquares), 4);
        }
        
        return $jarak;
    }

    private function hitungNilaiPreferensi($jarakPositif, $jarakNegatif)
    {
        $nilaiPreferensi = [];
        
        for ($i = 0; $i < count($jarakPositif); $i++) {
            $totalJarak = $jarakPositif[$i] + $jarakNegatif[$i];
            $nilai = $totalJarak > 0 ? $jarakNegatif[$i] / $totalJarak : 0;
            $nilaiPreferensi[] = round($nilai, 4);
        }
        
        return $nilaiPreferensi;
    }

    private function perangkinganAlternatif($nilaiPreferensi)
    {
        $ranking = [];
        
        for ($i = 0; $i < count($nilaiPreferensi); $i++) {
            $ranking[] = [
                'alternatif_index' => $i,
                'nilai_preferensi' => $nilaiPreferensi[$i]
            ];
        }
        
        // Urutkan berdasarkan nilai preferensi (descending)
        usort($ranking, function($a, $b) {
            return $b['nilai_preferensi'] <=> $a['nilai_preferensi'];
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