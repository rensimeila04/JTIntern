@extends('layout.template')

@section('content')
<div class="container mx-auto">
    <div class="bg-white rounded-lg p-4">
        <h1 class="text-2xl font-bold mb-6 text-center">Perhitungan Rekomendasi MABAC</h1>
        
        @if(isset($hasil['profile_incomplete']) && $hasil['profile_incomplete'])
            <!-- Profile Incomplete Warning -->
            <div class="bg-red-50 border-l-4 border-red-400 p-6 rounded-lg mb-6">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 19.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-semibold text-red-800">Profil Belum Lengkap</h3>
                        <p class="text-red-700 mt-1">Anda perlu melengkapi profil terlebih dahulu sebelum dapat melakukan perhitungan rekomendasi MABAC.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg p-4 border border-red-200">
                    <h4 class="font-semibold text-red-800 mb-3">Data yang belum dilengkapi:</h4>
                    <ul class="list-disc list-inside text-red-700 space-y-1">
                        @foreach($hasil['missing_fields'] as $field)
                            <li>{{ $field }}</li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('mahasiswa.edit_profile') }}" 
                       class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Lengkapi Profil
                    </a>
                </div>
            </div>

            <!-- Current Profile Information -->
            <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">Profil Saat Ini</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p><strong>Nama:</strong> {{ $hasil['mahasiswa']->user->name }}</p>
                    <p><strong>NIM:</strong> {{ $hasil['mahasiswa']->nim }}</p>
                    <p><strong>Kompetensi:</strong> 
                        @if($hasil['mahasiswa']->kompetensi)
                            {{ $hasil['mahasiswa']->kompetensi->nama_kompetensi }}
                        @else
                            <span class="text-red-500 font-semibold">Belum diisi</span>
                        @endif
                    </p>
                    <p><strong>Jenis Perusahaan:</strong> 
                        @if($hasil['mahasiswa']->jenisPerusahaan)
                            {{ $hasil['mahasiswa']->jenisPerusahaan->nama_jenis_perusahaan }}
                        @else
                            <span class="text-red-500 font-semibold">Belum diisi</span>
                        @endif
                    </p>
                    <p><strong>Jenis Magang:</strong> 
                        @if($hasil['mahasiswa']->jenis_magang)
                            {{ ucfirst($hasil['mahasiswa']->jenis_magang) }}
                        @else
                            <span class="text-red-500 font-semibold">Belum diisi</span>
                        @endif
                    </p>
                    <p><strong>Lokasi Preferensi:</strong> 
                        @if($hasil['mahasiswa']->preferensi_lokasi)
                            {{ $hasil['mahasiswa']->preferensi_lokasi }}
                        @else
                            <span class="text-red-500 font-semibold">Belum diisi</span>
                        @endif
                    </p>
                </div>
            </div>
        @else
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
                <h3 class="text-lg font-semibold mb-4">2. Matriks Keputusan Awal (X)</h3>
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
                <h3 class="text-lg font-semibold mb-4">3. Matriks Normalisasi</h3>
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

            <!-- 4. Matriks Tertimbang (V) -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">4. Elemen Matriks Tertimbang (V)</h3>
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
                            @foreach($hasil['matriksV'] as $index => $baris)
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

            <!-- 5. Matriks Area Perkiraan Batas (G) -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">5. Matriks Area Perkiraan Batas (G)</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                @foreach($hasil['kriteria'] as $kriteria)
                                <th class="border border-gray-300 px-4 py-2">{{ $kriteria->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($hasil['matriksG'] as $nilai)
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $nilai }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 6. Matriks Jarak (Q) -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">6. Elemen Matriks Jarak Alternatif (Q)</h3>
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
                            @foreach($hasil['matriksQ'] as $index => $baris)
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

            <!-- 7. Ranking Alternatif -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">7. Perankingan Alternatif (S)</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Ranking</th>
                                <th class="border border-gray-300 px-4 py-2">Lowongan</th>
                                <th class="border border-gray-300 px-4 py-2">Perusahaan</th>
                                <th class="border border-gray-300 px-4 py-2">Nilai S</th>
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
                                <td class="border border-gray-300 px-4 py-2 text-center font-semibold">{{ $item['nilai_s'] }}</td>
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
                    <p><strong>Nilai MABAC:</strong> {{ $hasil['ranking'][0]['nilai_s'] }}</p>
                </div>
            </div>
            @endif
        @endif
    </div>
</div>
@endsection