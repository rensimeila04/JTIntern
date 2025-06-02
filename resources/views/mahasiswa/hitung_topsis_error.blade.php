@extends('layout.template')

@section('content')
<div class="container mx-auto">
    <div class="bg-white rounded-lg p-4">
        <h1 class="text-2xl font-bold mb-6 text-center">Perhitungan Rekomendasi TOPSIS</h1>
        
        <!-- Informasi Mahasiswa -->
        <div class="mb-6 bg-blue-50 p-4 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Profil Mahasiswa</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <p><strong>Nama:</strong> {{ $hasil['mahasiswa']->user->nama }}</p>
                <p><strong>NIM:</strong> {{ $hasil['mahasiswa']->nim }}</p>
                <p><strong>Kompetensi:</strong> {{ $hasil['mahasiswa']->kompetensi->nama_kompetensi ?? 'Belum diisi' }}</p>
                <p><strong>Jenis Perusahaan:</strong> {{ $hasil['mahasiswa']->jenisPerusahaan->nama_jenis_perusahaan ?? 'Belum diisi' }}</p>
                <p><strong>Jenis Magang:</strong> {{ ucfirst($hasil['mahasiswa']->jenis_magang) ?? 'Belum diisi' }}</p>
                <p><strong>Lokasi Preferensi:</strong> {{ $hasil['mahasiswa']->preferensi_lokasi ?? 'Belum diisi' }}</p>
            </div>
        </div>

        <!-- Error Message -->
        <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-6">
            <div class="flex items-center mb-4">
                <svg class="w-8 h-8 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.728-.833-2.498 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-red-800">Tidak Dapat Menghitung Rekomendasi TOPSIS</h3>
            </div>
            
            <div class="text-red-700 mb-4">
                <p class="mb-3"><strong>{{ $hasil['message'] }}</strong></p>
                
                @if(isset($hasil['missing_fields']) && !empty($hasil['missing_fields']))
                    <p class="mb-2">Data yang belum lengkap:</p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        @foreach($hasil['missing_fields'] as $field)
                            <li>{{ $field }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                <h4 class="text-yellow-800 font-semibold mb-2">📋 Untuk menggunakan fitur TOPSIS, lengkapi data berikut:</h4>
                <ul class="text-yellow-700 space-y-1 text-sm">
                    <li>✓ Kompetensi yang dikuasai</li>
                    <li>✓ Preferensi jenis perusahaan</li>
                    <li>✓ Jenis magang yang diinginkan</li>
                    <li>✓ Preferensi lokasi magang</li>
                    <li>✓ Koordinat lokasi preferensi</li>
                </ul>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('mahasiswa.edit_profile') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Lengkapi Profil
                </a>
                <a href="{{ route('mahasiswa.lowongan') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Lowongan
                </a>
            </div>
        </div>

        <!-- Informasi TOPSIS -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h4 class="text-blue-800 font-semibold mb-3">ℹ️ Tentang Metode TOPSIS</h4>
            <div class="text-blue-700 text-sm space-y-2">
                <p><strong>TOPSIS (Technique for Order of Preference by Similarity to Ideal Solution)</strong> adalah metode pengambilan keputusan yang membantu Anda menemukan lowongan magang terbaik berdasarkan:</p>
                <ul class="list-disc list-inside ml-4 space-y-1">
                    <li>Kesesuaian kompetensi dengan kebutuhan lowongan</li>
                    <li>Preferensi jenis perusahaan</li>
                    <li>Fasilitas yang tersedia di perusahaan</li>
                    <li>Jenis magang yang sesuai dengan minat</li>
                    <li>Kedekatan lokasi dengan preferensi Anda</li>
                </ul>
                <p class="mt-3 font-medium">Setelah profil lengkap, sistem akan menghitung nilai preferensi dan memberikan ranking lowongan yang paling sesuai untuk Anda.</p>
            </div>
        </div>
    </div>
</div>
@endsection