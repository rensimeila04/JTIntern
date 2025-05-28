@extends('layout.template')

@section('content')
    <div class="flex flex-col space-y-4">
        <!-- Statistics Cards -->
        <div class="flex flex-row gap-4 w-full">
            <!-- Card 1 -->
            <div class="flex-1 min-w-0 p-4 bg-white rounded-lg flex flex-col items-center space-y-4">
                <div class="flex items-center justify-center gap-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-hourglass class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base font-medium text-neutral-400">Menunggu</span>
                </div>
                <div class="flex-1 flex items-center justify-center h-[44px] w-full">
                    <span class="text-4xl font-medium text-neutral-700">56</span>
                </div>
                <div class="flex-2 flex items-center justify-center">
                    <a class="text-base font-medium text-primary-500 underline " href="#">Lihat Detail</a>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="flex-1 min-w-0 p-4 bg-white rounded-lg flex flex-col items-center space-y-4">
                <div class="flex items-center justify-center gap-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-mail-check class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base font-medium text-neutral-400">Aktif</span>
                </div>
                <div class="flex-1 flex items-center justify-center h-[44px] w-full">
                    <span class="text-4xl font-medium text-neutral-700">120</span>
                </div>
                <div class="flex-2 flex items-center justify-center">
                    <a class="text-base font-medium text-primary-500 underline " href="#">Lihat Detail</a>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="flex-1 min-w-0 p-4 bg-white rounded-lg flex flex-col items-center space-y-4">
                <div class="flex items-center justify-center gap-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-mail-x class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base font-medium text-neutral-400">Ditolak</span>
                </div>
                <div class="flex-1 flex items-center justify-center h-[44px] w-full">
                    <span class="text-4xl font-medium text-neutral-700">35</span>
                </div>
                <div class="flex-2 flex items-center justify-center">
                    <a class="text-base font-medium text-primary-500 underline " href="#">Lihat Detail</a>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="flex-1 min-w-0 p-4 bg-white rounded-lg flex flex-col items-center space-y-4">
                <div class="flex items-center justify-center gap-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-file-check-2 class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base font-medium text-neutral-400">Selesai</span>
                </div>
                <div class="flex-1 flex items-center justify-center h-[44px] w-full">
                    <span class="text-4xl font-medium text-neutral-700">528</span>
                </div>
                <div class="flex-2 flex items-center justify-center">
                    <a class="text-base font-medium text-primary-500 underline " href="#">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="w-full p-4 bg-white rounded-2xl flex-col space-y-4">
            <!-- Header dan tombol aksi -->
            <div class="flex justify-between items-center w-full">
                <div class="text-neutral-900 text-xl font-medium">Data Magang</div>
                <div class="flex gap-2">
                    <a href="#" class="btn-primary bg-blue-500 hover:bg-blue-600">
                        <i class="ph ph-export text-lg"></i> Export Data
                    </a>
                </div>
            </div>

            <!-- Filter "Semua Pengguna" & "Cari Pengguna" -->
            <div class="flex justify-between space-x-4">
                <div class="w-[500px] flex justify-start items-center gap-2">
                    <div class="hs-dropdown relative inline-flex">
                        <button id="hs-dropdown-status" type="button"
                            class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                            Semua Status
                            <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </button>
                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                            role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-status">
                            <div class="p-1 space-y-0.5">
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    Semua Status
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    Diterima
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    Magang
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    Menunggu
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    Ditolak
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="hs-dropdown relative inline-flex">
                        <button id="hs-dropdown-status" type="button"
                            class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                            Semua Magang
                            <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </button>
                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                            role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-status">
                            <div class="p-1 space-y-0.5">
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    Semua Magang
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    Frontend Developer
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    Backend Developer
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    Mobile Developer
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    UI/UX Design Internship
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    Machine Learning Trainer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <x-search-input placeholder="Cari data magang..." />
            </div>
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 w-full inline-block align-middle">
                        <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                            <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-gray-50 dark:bg-neutral-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-12">ID</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-48">Nama Mahasiswa</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-56">Judul Lowongan</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-64">Nama Perusahaan</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-32">Status</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-52">Dosen Pembimbing</th>
                                        <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-36">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    <!-- 1 -->
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">1</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Atthalaric Nero M</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Machine Learning Trainer</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">PT Global Tiket Network</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500 dark:text-teal-500">Diterima</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-neutral-400 dark:text-neutral-200">Belum ditambahkan</td>
                                        <td class="px-6 py-4 text-end text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- 2 -->
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">2</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Chiko Abilla Basya</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Frontend Developer</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">PT PLN (Persero)</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-yellow-500 text-yellow-500 dark:text-yellow-500">Menunggu</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">-</td>
                                        <td class="px-6 py-4 text-end text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-gray-300 focus:outline-hidden border border-gray-300 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-gray-300" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 3 -->
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">3</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Leon Shan Yoedha Adjie</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Frontend Developer</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Illiyin Studio</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-yellow-500 text-yellow-500 dark:text-yellow-500">Menunggu</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">-</td>
                                        <td class="px-6 py-4 text-end text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-gray-300 focus:outline-hidden border border-gray-300 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-gray-300" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 4 -->
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">4</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Rafa Fadil Aras</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">System Analyst</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Kementrian Komunikasi dan Digital</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-yellow-500 text-yellow-500 dark:text-yellow-500">Menunggu</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">-</td>
                                        <td class="px-6 py-4 text-end text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-gray-300 focus:outline-hidden border border-gray-300 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-gray-300" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 5 -->
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">5</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Rensi Meila Yulvinata</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">UI/UX Design Internship</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">PT Telekomunikasi Indonesia</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500 dark:text-teal-500">Diterima</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-800">Andi Wijaya S.Kom. M.Kom</td>
                                        <td class="px-6 py-4 text-end text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 6 -->
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">6</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Triyana Dewi</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Frontend Developer</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Aksamedia</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-blue-500 text-blue-500 dark:text-blue-500">Magang</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-800">Andi Wijaya S.Kom. M.Kom</td>
                                        <td class="px-6 py-4 text-end text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 7 -->
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">7</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Naisya Najmi</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">System Analyst</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">CMlabs</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-500 text-neutral-500 dark:text-gray-500">Selesai</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-800">Jafar Hidayatullah S.Kom. M.Kom</td>
                                        <td class="px-6 py-4 text-end text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 8 -->
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">8</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Rendi Nicholas</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Backend Developer</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Bank Central Asia</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-red-500 text-red-500 dark:text-red-500">Ditolak</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">-</td>
                                        <td class="px-6 py-4 text-end text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 9 -->
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">9</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Aaron Dewangga</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Mobile Developer</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">PT Venturo</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-blue-500 text-blue-500 dark:text-blue-500">Magang</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-800">Ubaidillah S.Kom. M.Kom</td>
                                        <td class="px-6 py-4 text-end text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 10 -->
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">10</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Aprilia Dwi Cristyana</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">Mobile Developer</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">PT Telekomunikasi Indonesia</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-yellow-500 text-yellow-500 dark:text-yellow-500">Menunggu</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-neutral-400 dark:text-neutral-200">-</td>
                                        <td class="px-6 py-4 text-end text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-gray-300 focus:outline-hidden border border-gray-300 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-gray-300" />
                                                </a>
                                                <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <!-- Pagination -->
                <nav class="flex items-center gap-x-1" aria-label="Pagination">
                    <button type="button"
                        class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                        aria-label="Previous">
                        <x-lucide-chevron-left class="shrink-0 size-3.5" stroke-width="2" />
                        <span>Sebelumnya</span>
                    </button>
                    <div class="flex items-center gap-x-1">
                        <button type="button"
                            class="min-h-9.5 min-w-9.5 flex justify-center items-center bg-gray-200 text-gray-500 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-600 dark:text-white dark:focus:bg-neutral-500"
                            aria-current="page">1</button>
                        <button type="button"
                            class="min-h-9.5 min-w-9.5 flex justify-center items-center text-gray-500 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">2</button>
                        <button type="button"
                            class="min-h-9.5 min-w-9.5 flex justify-center items-center text-gray-500 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">3</button>
                        <button type="button:disabled"
                            class="min-h-9.5 min-w-9.5 flex justify-center items-center text-gray-500 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10 ">...</button>
                    </div>
                    <button type="button"
                        class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                        aria-label="Next">
                        <span>Selanjutnya</span>
                        <x-lucide-chevron-right class="shrink-0 size-3.5" stroke-width="2" />
                    </button>
                </nav>
                <!-- End Pagination -->
            </div>
        </div>
    </div>
@endsection
