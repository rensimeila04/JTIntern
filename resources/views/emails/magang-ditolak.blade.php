<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pengajuan Magang</title>
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
        <div class="bg-gradient-to-r from-orange-500 to-red-600 px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white mb-2">📋 Informasi Pengajuan</h1>
                    <p class="text-orange-100">Update status pengajuan magang Anda</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                    <span class="text-white font-semibold text-sm">TIDAK DITERIMA</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-8 py-6">
            <!-- Greeting -->
            <div class="mb-6">
                <p class="text-gray-800 text-lg">Halo <strong class="text-primary-600">{{ $magang->mahasiswa->user->name }}</strong>,</p>
                <p class="text-gray-600 mt-2 leading-relaxed">
                    Terima kasih atas minat Anda untuk magang. Setelah melalui proses evaluasi yang teliti, 
                    kami informasikan bahwa pengajuan magang Anda untuk saat ini belum dapat kami terima.
                </p>
            </div>

            <!-- Status Badge -->
            <div class="flex items-center gap-3 p-4 bg-red-50 border border-red-200 rounded-lg mb-6">
                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                <span class="text-red-800 font-semibold">Status: Tidak Diterima</span>
                <span class="ml-auto text-red-600 text-sm">
                    {{ $magang->tanggal_ditolak ? \Carbon\Carbon::parse($magang->tanggal_ditolak)->setTimezone('Asia/Jakarta')->format('d F Y H:i') . ' WIB' : '' }}
                </span>
            </div>

            <!-- Detail Pengajuan -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                    Detail Pengajuan
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
                            <p class="text-sm font-medium text-gray-500">Tanggal Pengajuan</p>
                            <p class="text-gray-800 font-semibold">{{ $magang->created_at->setTimezone('Asia/Jakarta')->format('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Status</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Tidak Diterima
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alasan Penolakan -->
            @if($magang->alasan_penolakan)
            <div class="bg-red-50 border border-red-200 rounded-xl p-6 mb-6">
                <h3 class="text-lg font-semibold text-red-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Alasan Penolakan
                </h3>
                <div class="relative">
                    <svg class="absolute top-0 left-0 w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z"/>
                    </svg>
                    <p class="text-red-700 leading-relaxed pl-8 italic bg-white p-4 rounded-lg border-l-4 border-red-300 ml-2">
                        {{ $magang->alasan_penolakan }}
                    </p>
                </div>
            </div>
            @endif

            <!-- Encouragement Section -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Jangan Menyerah!
                </h3>
                <p class="text-blue-700 mb-4">Keputusan ini bukan akhir dari perjalanan Anda. Berikut beberapa saran untuk langkah selanjutnya:</p>
                <ul class="space-y-2">
                    <li class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                        <span class="text-blue-700">Tinjau dan perbaiki dokumen pendukung Anda</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                        <span class="text-blue-700">Cari lowongan magang lain yang sesuai dengan profil Anda</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                        <span class="text-blue-700">Tingkatkan keterampilan yang relevan dengan posisi yang diinginkan</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                        <span class="text-blue-700">Konsultasikan dengan dosen pembimbing untuk masukan</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                        <span class="text-blue-700">Jangan ragu untuk mencoba lagi di kesempatan berikutnya</span>
                    </li>
                </ul>
            </div>

            <!-- CTA Button -->
            <div class="text-center mb-6">
                <a href="{{ route('mahasiswa.lowongan') }}" 
                   class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari Lowongan Lain
                </a>
            </div>

            <!-- Closing Message -->
            <div class="text-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-gray-700 leading-relaxed">
                    Kami yakin dengan dedikasi dan persiapan yang tepat, Anda akan menemukan kesempatan magang yang sesuai. Tetap semangat!
                </p>
                <p class="text-gray-800 font-semibold mt-2">
                    Terima kasih atas pengertian Anda.
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