@extends('layout.template')

@section('content')
<div class="container mx-auto">
    <div class="bg-white rounded-lg p-4">
        <h1 class="text-2xl font-bold mb-6 text-center">Perhitungan Rekomendasi TOPSIS</h1>
        
        <!-- Informasi Mahasiswa -->
        <div class="mb-6 bg-blue-50 p-4 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Profil Mahasiswa</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <p><strong>Nama:</strong> {{ $hasil['mahasiswa']->user->name }}</p>
                <p><strong>NIM:</strong> {{ $hasil['mahasiswa']->nim }}</p>
                <p><strong>Kompetensi:</strong> {{ $hasil['mahasiswa']->kompetensi->nama_kompetensi ?? 'Tidak ada' }}</p>
                <p><strong>Jenis Perusahaan:</strong> {{ $hasil['mahasiswa']->jenisPerusahaan->nama_jenis_perusahaan ?? 'Tidak ada' }}</p>
                <p><strong>Jenis Magang:</strong> {{ ucfirst($hasil['mahasiswa']->jenis_magang) }}</p>
                <p><strong>Lokasi Preferensi:</strong> {{ $hasil['mahasiswa']->preferensi_lokasi ?? 'Tidak ada' }}</p>
            </div>
        </div>

        <!-- Kriteria dan Bobot -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-4">Kriteria dan Bobot</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Kriteria</th>
                            <th class="border border-gray-300 px-4 py-2">Jenis</th>
                            <th class="border border-gray-300 px-4 py-2">Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil['kriteria'] as $kriteria)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $kriteria->nama_kriteria }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ ucfirst($kriteria->jenis) }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $kriteria->bobot }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 1. Penilaian Alternatif -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-4">1. Penilaian Alternatif</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Lowongan</th>
                            <th class="border border-gray-300 px-4 py-2">Jenis Perusahaan</th>
                            <th class="border border-gray-300 px-4 py-2">Kompetensi</th>
                            <th class="border border-gray-300 px-4 py-2">Fasilitas</th>
                            <th class="border border-gray-300 px-4 py-2">Jenis Magang</th>
                            <th class="border border-gray-300 px-4 py-2">Lokasi (km)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil['alternatif'] as $index => $alt)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">
                                <div>
                                    <strong>{{ $alt['lowongan']->judul_lowongan }}</strong><br>
                                    <small class="text-gray-600">{{ $alt['lowongan']->perusahaanMitra->nama_perusahaan_mitra }}</small>
                                </div>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $alt['skor']['jenis_perusahaan'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $alt['skor']['kompetensi'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $alt['skor']['fasilitas'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $alt['skor']['jenis_magang'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $alt['skor']['lokasi'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 2. Matriks Keputusan Awal (X) -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-4">2. Pembentukan Matriks Keputusan Awal (X)</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Alternatif</th>
                            @foreach($hasil['kriteria'] as $kriteria)
                            <th class="border border-gray-300 px-4 py-2">{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil['matriksX'] as $index => $baris)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">A{{ $index + 1 }}</td>
                            @foreach($baris as $nilai)
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $nilai }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 3. Matriks Normalisasi -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-4">3. Normalisasi Matriks Keputusan</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Alternatif</th>
                            @foreach($hasil['kriteria'] as $kriteria)
                            <th class="border border-gray-300 px-4 py-2">{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil['matriksNormalisasi'] as $index => $baris)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">A{{ $index + 1 }}</td>
                            @foreach($baris as $nilai)
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $nilai }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 4. Matriks Ternormalisasi Terbobot (Y) -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-4">4. Matriks Ternormalisasi Terbobot (Y)</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Alternatif</th>
                            @foreach($hasil['kriteria'] as $kriteria)
                            <th class="border border-gray-300 px-4 py-2">{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil['matriksY'] as $index => $baris)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">A{{ $index + 1 }}</td>
                            @foreach($baris as $nilai)
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $nilai }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 5. Solusi Ideal Positif (A+) dan Negatif (A-) -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-4">5. Solusi Ideal Positif (A+) dan Negatif (A-)</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Solusi</th>
                            @foreach($hasil['kriteria'] as $kriteria)
                            <th class="border border-gray-300 px-4 py-2">{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-green-50">
                            <td class="border border-gray-300 px-4 py-2 font-semibold text-green-800">A+ (Positif)</td>
                            @foreach($hasil['solusiIdealPositif'] as $nilai)
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $nilai }}</td>
                            @endforeach
                        </tr>
                        <tr class="bg-red-50">
                            <td class="border border-gray-300 px-4 py-2 font-semibold text-red-800">A- (Negatif)</td>
                            @foreach($hasil['solusiIdealNegatif'] as $nilai)
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $nilai }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 6. Jarak dari Solusi Ideal -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-4">6. Jarak antara Y terhadap A+ dan A-</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Alternatif</th>
                            <th class="border border-gray-300 px-4 py-2">D+ (Jarak ke A+)</th>
                            <th class="border border-gray-300 px-4 py-2">D- (Jarak ke A-)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil['alternatif'] as $index => $alt)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">A{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $hasil['jarakPositif'][$index] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $hasil['jarakNegatif'][$index] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 7. Ranking Alternatif -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-4">7. Nilai Preferensi (V) dan Perankingan</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Ranking</th>
                            <th class="border border-gray-300 px-4 py-2">Lowongan</th>
                            <th class="border border-gray-300 px-4 py-2">Perusahaan</th>
                            <th class="border border-gray-300 px-4 py-2">D+</th>
                            <th class="border border-gray-300 px-4 py-2">D-</th>
                            <th class="border border-gray-300 px-4 py-2">Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil['ranking'] as $rank => $item)
                        @php
                            $alternatif = $hasil['alternatif'][$item['alternatif_index']];
                        @endphp
                        <tr class="{{ $rank < 3 ? 'bg-yellow-50' : '' }}">
                            <td class="border border-gray-300 px-4 py-2 text-center font-semibold">{{ $rank + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $alternatif['lowongan']->judul_lowongan }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $alternatif['lowongan']->perusahaanMitra->nama_perusahaan_mitra }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $hasil['jarakPositif'][$item['alternatif_index']] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $hasil['jarakNegatif'][$item['alternatif_index']] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center font-semibold">{{ $item['nilai_preferensi'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Rekomendasi Terbaik -->
        @if(count($hasil['ranking']) > 0)
        @php
            $terbaik = $hasil['alternatif'][$hasil['ranking'][0]['alternatif_index']];
        @endphp
        <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded">
            <h3 class="text-lg font-semibold text-green-800 mb-2">🏆 Rekomendasi Terbaik</h3>
            <div class="text-green-700">
                <p><strong>Lowongan:</strong> {{ $terbaik['lowongan']->judul_lowongan }}</p>
                <p><strong>Perusahaan:</strong> {{ $terbaik['lowongan']->perusahaanMitra->nama_perusahaan_mitra }}</p>
                <p><strong>Nilai TOPSIS:</strong> {{ $hasil['ranking'][0]['nilai_preferensi'] }}</p>
            </div>
        </div>
        @endif

        <!-- Tombol Kembali -->
        <div class="mt-6 text-center">
            <a href="{{ route('mahasiswa.lowongan') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Lowongan
            </a>
        </div>
    </div>
</div>
@endsection