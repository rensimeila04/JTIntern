@extends('layout.template')

@section('content')
    <div class="w-full p-4 bg-white rounded-xl flex-col space-y-4">
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-medium">Riwayat Magang</div>
            <div class="flex gap-2">
                <a href="#" class="btn-primary bg-blue-500 hover:bg-blue-600">
                    <i class="ph ph-export text-lg"></i> Export Data
                </a>
            </div>
        </div>
        <div class="flex justify-end w-full items-center">
            <x-search-input placeholder="Cari data magang..." />
        </div>
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="w-fit px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="w-1/6 px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Nama Mahasiswa
                                    </th>
                                    <th scope="col"
                                        class="w-1/5 px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Judul Lowongan
                                    </th>
                                    <th scope="col"
                                        class="w-1/6 px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Nama Perusahaan
                                    </th>
                                    <th scope="col"
                                        class="w-1/6 px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Dosen Pembimbing
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Sertifikat
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400 whitespace-nowrap">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                <tr>
                                    <td class="px-3 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        1
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        Atthalaric Nero M
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-36 truncate">
                                        Machine Learning Trainer
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        PT Global Tiket Network
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        Belum ditambahkan
                                    </td>
                                    <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-start gap-2">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-eye class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-blue-500 hover:bg-gray-200 focus:outline-hidden border border-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-download class="w-4 h-4 text-blue-500" />
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-start gap-2">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-files class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-yellow-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-red-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        2
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        Chiko Abilla Basya
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-36 truncate">
                                        Frontend Developer
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        PT PLN (Persero)
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        Belum ditambahkan
                                    </td>
                                    <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-start gap-2">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-eye class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-blue-500 hover:bg-gray-200 focus:outline-hidden border border-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-download class="w-4 h-4 text-blue-500" />
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-start gap-2">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-files class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-yellow-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-red-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        3
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        Leon Shan Yoedha Adjie
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-36 truncate">
                                        Frontend Developer
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        Illiyin Studio
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        Ubaidillah S.Kom. M.Kom
                                    </td>
                                    <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-start gap-2">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-eye class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-blue-500 hover:bg-gray-200 focus:outline-hidden border border-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-download class="w-4 h-4 text-blue-500" />
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-start gap-2">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-files class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-yellow-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-red-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        4
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        Rafa Fadil Aras
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-36 truncate">
                                        System Analyst
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        Kementrian Komunikasi dan Digital
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        Andi Wijaya S.Kom. M.Kom
                                    </td>
                                    <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-start gap-2">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-eye class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-blue-500 hover:bg-gray-200 focus:outline-hidden border border-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-download class="w-4 h-4 text-blue-500" />
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-start gap-2">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-files class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-yellow-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-red-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        5
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        Rensi Meila Yulvinata
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-36 truncate">
                                        UI/UX Design Internship
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        PT Telekomunikasi Indonesia
                                    </td>
                                    <td class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                        Jafar Hidayatullah S.Kom. M.Kom
                                    </td>
                                    <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-start gap-2">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-eye class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-blue-500 hover:bg-gray-200 focus:outline-hidden border border-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-download class="w-4 h-4 text-blue-500" />
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-start gap-2">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-files class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-yellow-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-red-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
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
        <div class="flex items-center justify-end mt-8">
            <nav class="flex items-center gap-x-1" aria-label="Pagination">
                <button type="button"
                    class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                    aria-label="Previous">
                    <x-lucide-chevron-left class="shrink-0 size-3.5" stroke-width="2" />
                    <span>Sebelumnya</span>
                </button>
                <div class="flex items-center gap-x-1">
                    <button type="button"
                        class="min-h-9.5 min-w-9.5 flex justify-center items-center bg-gray-200 text-gray-800 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-600 dark:text-white dark:focus:bg-neutral-500"
                        aria-current="page">1</button>
                    <button type="button"
                        class="min-h-9.5 min-w-9.5 flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">2</button>
                    <button type="button"
                        class="min-h-9.5 min-w-9.5 flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">3</button>
                </div>
                <button type="button"
                    class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                    aria-label="Next">
                    <span>Selanjutnya</span>
                    <x-lucide-chevron-right class="shrink-0 size-3.5" stroke-width="2" />
                </button>
            </nav>
        </div>
    </div>
@endsection
