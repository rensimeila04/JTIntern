@extends('layout.template')
@section('content')
    <div class="space-y-4">
        <div class="bg-white h-fit p-4 rounded-lg space-y-4">
            <div class="flex justify-between items-start">
                <p class="text-xl font-medium text-neutral-900">Detail Pengguna</p>
                <a href="#" class=" outline-primary-500 text-primary-500 btn-outline-sm">
                    <x-lucide-lock class="size-6 " stroke-width="1.5" />
                    Atur Ulang Kata Sandi
                </a>
            </div>
            <div class="flex items-center gap-x-9">
                <div class="w-30 h-30 rounded-2xl overflow-hidden">
                    <img src="https://i.pinimg.com/736x/65/5c/20/655c20e238a664fac643bef9ff9f7f5a.jpg" alt="profile pict"
                        class="w-full h-full object-cover">
                </div>
                <div class="space-y-6">
                    <p class="text-lg text-neutral-900 font-medium">Ayu Maharani</p>
                    <div class="flex items-start gap-9">
                        <div class="space-y-2">
                            <p class="text-sm text-neutral-400 font-normal">NIP</p>
                            <p class="text-sm text-neutral-900 font-semibold">198907152203123</p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-sm text-neutral-400 font-normal">Email</p>
                            <p class="text-sm text-neutral-900 font-semibold">ayu@polinema.ac.id</p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-sm text-neutral-400 font-normal">Bidang Minat</p>
                            <p class="text-sm text-neutral-900 font-semibold">Machine Learning</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white h-fit p-4 rounded-lg space-y-6">
            <div class="flex justify-between items-center">
                <p class="text-xl font-medium text-neutral-900">Mahasiswa Bimbingan</p>
                <a href="#" class="btn-primary bg-blue-500 text-white">
                    <i class="ph ph-export"></i>
                    Export
                </a>
            </div>
            <div class="flex items-center justify-between">
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-status" type="button"
                        class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        Semua Status
                        <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
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
                                Magang
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="#">
                                Diterima
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="#">
                                Selesai
                            </a>
                        </div>
                    </div>
                </div>

                <x-search-input placeholder="Cari mahasiswa..." />
            </div>
            <div>
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead class="bg-gray-50 dark:bg-neutral-700">
                                                <tr>
                                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-auto">NIM</th>
                                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Nama Mahasiswa</th>
                                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Judul Lowongan</th>
                                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Nama Perusahaan</th>
                                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-auto">Status</th>
                                                </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                                <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 w-auto">2141720001</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">Budi Santoso</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">Machine Learning Engineer</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">PT Digital Solusi</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 w-auto">
                                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-blue-600 text-blue-600 dark:text-blue-500">Magang</span>
                                                        </td>
                                                </tr>

                                                <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 w-auto">2141720002</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">Siti Rahma</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">Web Developer</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">PT Maju Bersama</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 w-auto">
                                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">Diterima</span>
                                                        </td>
                                                </tr>

                                                <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 w-auto">2141720003</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">Ahmad Faisal</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">Data Analyst</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">PT Data Nusantara</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 w-auto">
                                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-500 text-gray-500 dark:text-neutral-400">Selesai</span>
                                                        </td>
                                                </tr>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end">
                <!-- Pagination -->
                <nav class="flex items-center gap-x-1" aria-label="Pagination">
                    <button type="button" class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10" aria-label="Previous">
                        <x-lucide-chevron-left class="shrink-0 size-3.5" stroke-width="2" />
                        <span>Sebelumnya</span>
                    </button>
                    <div class="flex items-center gap-x-1">
                        <button type="button" class="min-h-9.5 min-w-9.5 flex justify-center items-center bg-gray-200 text-gray-800 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-600 dark:text-white dark:focus:bg-neutral-500" aria-current="page">1</button>
                        <button type="button" class="min-h-9.5 min-w-9.5 flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">2</button>
                        <button type="button" class="min-h-9.5 min-w-9.5 flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">3</button>
                    </div>
                    <button type="button" class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10" aria-label="Next">
                        <span>Selanjutnya</span>
                        <x-lucide-chevron-right class="shrink-0 size-3.5" stroke-width="2" />
                    </button>
                </nav>
                <!-- End Pagination -->
            </div>
        </div>
    </div>
@endsection
