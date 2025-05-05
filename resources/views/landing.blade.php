<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('images/logo_icon.png') }}" type="image/png" />
    <title>JTIntern - Magang JTI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css" />
</head>

<body>
    {{-- Navbar --}}
    <nav class="flex items-center justify-between bg-white px-20 py-6">
        {{-- logo --}}
        <img src="{{ asset('Images/logo.svg') }}" alt="Logo" class="h-8">
        {{-- menu --}}
        <ul class="flex space-x-8 text-base">
            <li><a href="#" class="text-primary-500 font-semibold">Beranda</a></li>
            <li><a href="#"
                    class="text-neutral-500 font-normal hover:text-primary-500 hover:font-semibold">Tentang</a></li>
            <li><a href="#"
                    class="text-neutral-500 font-normal hover:text-primary-500 hover:font-semibold">Fitur</a></li>
            <li><a href="#"
                    class="text-neutral-500 font-normal hover:text-primary-500 hover:font-semibold">Panduan</a></li>
        </ul>
        {{-- button --}}
        <div class="flex space-x-4">
            <a href="#"
                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-500 text-gray-500 hover:border-gray-800 hover:text-gray-800 focus:outline-hidden focus:border-gray-800 focus:text-gray-800 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-400 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hover:border-neutral-300">
                Masuk
            </a>
            <a href="#"
                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                Mulai Sekarang
            </a>
        </div>
    </nav>

    {{-- Hero --}}
    <div
        class="bg-gradient-to-b from-[#DEECE200] to-[#BEDCC6] h-screen w-full flex flex-col items-center mt-24 overflow-hidden">
        <p class="text-4xl font-semibold text-center text-neutral-900 animate-fade-in-up delay-100">
            Temukan <span class="text-primary-500">Rekomendasi Magang</span> yang Paling Sesuai dengan<br>Minat,
            Keahlian, dan Tujuan Kariermu
        </p>
        <p class="text-base text-neutral-500 font-medium text-center mt-6 animate-fade-in-up delay-200">Dapatkan
            rekomendasi magang yang
            dipersonalisasi berdasarkan minat, keahlian,<br>dan rencana kariermu untuk membantumu berkembang di
            jalur
            yang tepat.</p>
        <a href="#"
            class="mt-6 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none transition duration-700 ease-in-out hover:scale-105 animate-fade-in-up delay-300">
            Mulai Sekarang
        </a>
        <div class="mt-15 p-3 outline-1 rounded-3xl outline-primary-200 animate-fade-in-up delay-500">
            <img src="{{ asset('images/konten_dashboard.png') }}" alt="Hero Illustration"
                class="h-auto object-center object-cover w-[903px] border-1 rounded-3xl border-primary-200">
        </div>
    </div>

    {{-- Tentang --}}
    <div class="bg-white h-screen w-full flex justify-between items-center px-20">
        <div class="space-y-6 w-[521px]">
            <p class="font-semibold text-4xl text-neutral-900"><span class="text-primary-500">Temukan, Lamar, dan
                    Mulai</span>
                <br>Magangmu dengan Lebih<br>Mudah
            </p>
            <p class="font-normal text-base text-neutral-500">Dengan JTIntern, menemukan tempat magang yang sesuai jadi
                lebih cepat dan tepat. Nikmati pengalaman mencari magang yang lebih praktis lewat rekomendasi berbasis
                profilmu. Pantau setiap langkah perjalananmu, dapatkan insight untuk berkembang, dan siapkan diri
                menyambut dunia kerja dengan lebih percaya diri.</p>
        </div>
        <div class="w-[627px] h-[627px] bg-neutral-50 rounded-2xl"></div>
    </div>

    {{-- Fitur --}}
    <div class="bg-white h-fit w-full px-20 py-24 space-y-22">
        <div class="space-y-4 flex flex-col items-center">
            <div class="space-x-2 flex items-center w-fit rounded-full outline-1 outline-primary-200  px-6 py-2">
                <i class="ph-fill ph-lightning text-primary-500 text-xl"></i>
                <p class="text-base text-neutral-900">Fitur Unggulan</p>
            </div>
            <p class="text-4xl text-neutral-900 font-semibold text-center">Persiapkan magangmu dengan fitur pintar!</p>
            <p class="text-center text-base text-neutral-500">Sistem terintegrasi untuk pencarian,
                pengelolaan, dan evaluasi magang, memungkinkan mahasiswa menemukan peluang yang sesuai, mengajukan
                lamaran dengan mudah, serta memantau perkembangan dalam satu platform.</p>
        </div>
        {{-- show fitur --}}
        @php
            $firstRow = [
                [
                    'title' => 'Rekomendasi Magang',
                    'desc' => 'Sistem pendukung keputusan mempermudah pencarian magang sesuai keahlian.',
                ],
                [
                    'title' => 'Manajemen Pengajuan Magang',
                    'desc' => 'Ajukan lamaran, pantau status, dan terima notifikasi dalam satu platform.',
                ],
            ];

            $secondRow = [
                [
                    'title' => 'Monitoring & Evaluasi Magang',
                    'desc' => 'Catat progres, isi log aktivitas, dan dapatkan evaluasi dari dosen pembimbing.',
                ],
                [
                    'title' => 'Platform Kolaborasi',
                    'desc' => 'Mahasiswa, dosen, dan koordinator magang terhubung untuk komunikasi efektif.',
                ],
                [
                    'title' => 'Analisis & Laporan',
                    'desc' => 'Pantau efektivitas magang dengan data terintegrasi dan laporan.',
                ],
            ];
        @endphp

        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                @foreach ($firstRow as $item)
                    <div class="w-full h-110 bg-neutral-50 rounded-2xl py-6 px-6">
                        <p class="font-medium text-2xl text-neutral-900">{{ $item['title'] }}</p>
                        <p class="font-normal text-base text-neutral-500">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-3 gap-4">
                @foreach ($secondRow as $item)
                    <div class="w-full h-110 bg-neutral-50 rounded-2xl py-6 px-6 flex flex-col justify-end">
                        <p class="font-medium text-2xl text-neutral-900">{{ $item['title'] }}</p>
                        <p class="font-normal text-base text-neutral-500">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
