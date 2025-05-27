@extends('layout.template')

@section('content')
    <div class="w-full p-4 bg-white rounded-xl flex-col space-y-4">
        <!-- Header dan tombol aksi -->
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-medium">Permohonan Magang</div>
            <div class="flex gap-2">
                <a href="#" class="btn-primary bg-blue-500 hover:bg-blue-600">
                    <i class="ph ph-export text-lg"></i> Export Data
                </a>
            </div>
        </div>

        <!-- Filter "Semua Pengguna" & "Cari Pengguna" -->
        <div class="flex justify-end w-full items-center ">

            <x-search-input placeholder="Cari data magang..." />
        </div>

        <!-- Table Header -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="w-4 px-6 py-6 text-start text-xs font-medium text-gray-500  dark:text-neutral-400">
                                        ID</th>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500  dark:text-neutral-400">
                                        Nama Mahasiswa</th>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500  dark:text-neutral-400">
                                        Judul Lowongan</th>
                                    <th scope="col"
                                        class="w-auto  px-6 py-3 text-start text-xs font-medium text-gray-500  dark:text-neutral-400">
                                        Nama Perusahaan</th>
                                    <th scope="col"
                                        class="w-4 px-5 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400 whitespace-nowrap">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        1
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        Atthalaric Nero M
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        Machine Learning Trainer
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        Kementerian Komunikasi Digital
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap text-sm font-medium text-end">
                                        <div class="flex justify-end gap-2">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-files class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        2
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        Michelle Alexandra
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        Machine Learning 
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        Kementerian Komunikasi Digital
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap text-sm font-medium text-end">
                                        <div class="flex justify-end gap-2">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-files class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
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

        <!-- Pagination -->
        <div class="flex items-center justify-end mt-8">
            <!-- Pagination -->
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
            <!-- End Pagination -->
        </div>
    </div>
@endsection