<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Magang Diterima</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-xl overflow-hidden my-8">
        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white mb-2">🎉 Selamat!</h1>
                    <p class="text-primary-100">Pengajuan magang Anda telah disetujui</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                    <span class="text-white font-semibold text-sm">DITERIMA</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-8 py-6">
            <!-- Greeting -->
            <div class="mb-6">
                <p class="text-gray-800 text-lg">Halo <strong class="text-primary-600">{{ $magang->mahasiswa->user->name }}</strong>,</p>
                <p class="text-gray-600 mt-2 leading-relaxed">
                    Kami dengan senang hati mengabarkan bahwa pengajuan magang Anda telah <strong class="text-green-600">disetujui</strong>! 
                    Selamat atas pencapaian ini.
                </p>
            </div>

            <!-- Status Badge -->
            <div class="flex items-center gap-3 p-4 bg-green-50 border border-green-200 rounded-lg mb-6">
                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-green-800 font-semibold">Status: Diterima</span>
                <span class="ml-auto text-green-600 text-sm">
                    {{ $magang->tanggal_diterima ? \Carbon\Carbon::parse($magang->tanggal_diterima)->setTimezone('Asia/Jakarta')->format('d F Y H:i') . ' WIB' : '' }}
                </span>
            </div>

            <!-- Detail Magang -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                    Detail Magang
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Posisi</p>
                            <p class="text-gray-800 font-semibold">{{ $magang->lowongan->judul_lowongan }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Perusahaan</p>
                            <p class="text-gray-800 font-semibold">{{ $magang->lowongan->perusahaanMitra->nama_perusahaan_mitra }}</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Dosen Pembimbing</p>
                            <p class="text-gray-800 font-semibold">{{ $magang->dosenPembimbing->user->name ?? 'Akan ditentukan' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Periode</p>
                            <p class="text-gray-800 font-semibold">{{ $magang->lowongan->periodeMagang->nama_periode ?? 'Tidak tersedia' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Langkah Selanjutnya
                </h3>
                <ul class="space-y-2">
                    <li class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                        <span class="text-blue-700">Hubungi dosen pembimbing yang telah ditugaskan</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                        <span class="text-blue-700">Koordinasi dengan perusahaan untuk jadwal mulai magang</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                        <span class="text-blue-700">Siapkan dokumen yang diperlukan untuk memulai magang</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                        <span class="text-blue-700">Pastikan mengisi log aktivitas harian selama magang</span>
                    </li>
                </ul>
            </div>

            <!-- CTA Button -->
            <div class="text-center mb-6">
                <a href="{{ route('mahasiswa.dashboard') }}" 
                   class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    Lihat Dashboard
                </a>
            </div>

            <!-- Closing Message -->
            <div class="text-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-gray-700 leading-relaxed">
                    Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi koordinator magang atau dosen pembimbing.
                </p>
                <p class="text-gray-800 font-semibold mt-2">
                    Selamat dan sukses untuk perjalanan magang Anda!
                </p>
                <p class="text-primary-600 font-bold mt-1">Tim JTIntern</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-100 px-8 py-4 border-t border-gray-200">
            <p class="text-center text-sm text-gray-600">
                Email ini dikirim secara otomatis dari sistem JTIntern.<br>
                Jangan balas email ini. Untuk pertanyaan, hubungi admin sistem.
            </p>
        </div>
    </div>
</body>
</html>