@extends('layout.template')
@section('content')
    <div class="bg-white py-6 px-4 rounded-lg">
        <div class="flex flex-row justify-between mb-4">
            <span class="font-medium text-xl">
                <h2>Log Aktivitas</h2>
            </span>
            <button type="button"
                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700">
                <i class="ph ph-plus"></i>
                Tambah Log Aktivitas
            </button>
        </div>
        <div class="hs-dropdown relative inline-flex">
            <button id="hs-dropdown-default" type="button"
                class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <x-lucide-calendar-days class="size-3.5 text-neutral-500" />
                <x-lucide-chevron-down class="size-5 text-neutral-500" />
            </button>
        </div>
        <div class="flex flex-col mt-4 mb-6">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <table class="min-w-full divide-y-2 divide-gray-200">
                            <thead class="bg-gray-50 divide-y-2">
                                <tr>
                                    <th scope="col" class="px-5 py-3 text-start text-xs font-medium text-gray-500 w-fit">
                                        Hari, Tanggal
                                    </th>
                                    <th scope="col" class="px-5 py-3 text-start text-xs font-medium text-gray-500 w-48">
                                        Waktu
                                    </th>
                                    <th scope="col" class="px-5 py-3 text-start text-xs font-medium text-gray-500 w-auto">
                                        Kegiatan
                                    </th>
                                    <th scope="col" class="px-5 py-3 text-start text-xs font-medium text-gray-500 w-44">
                                        Status Feedback
                                    </th>
                                    <th scope="col" class="px-5 py-3 text-start text-xs font-medium text-gray-500 w-48">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800">
                                        Jumat, 23 Mei 2025
                                    </td>
                                    <td class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800">
                                        08.00 - 15.30
                                    </td>
                                    <td class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800">
                                        Presentasi hasil kerja mingguan...
                                    </td>
                                    <td class="px-5 py-1.5 whitespace-nowrap text-sm text-gray-800">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">Dinilai
                                        </span>
                                    </td>
                                    <td class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-end max-w-43 w-fit ">
                                        <div class="flex justify-start gap-2.5">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-files class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800">
                                        Jumat, 23 Mei 2025
                                    </td>
                                    <td class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800">
                                        08.00 - 15.30
                                    </td>
                                    <td class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800">
                                        Presentasi hasil kerja mingguan...
                                    </td>
                                    <td class="px-5 py-1.5 whitespace-nowrap text-sm text-gray-800">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">Dinilai
                                        </span>
                                    </td>
                                    <td class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-end max-w-43 w-fit ">
                                        <div class="flex justify-start gap-2.5">
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-files class="w-4 h-4 text-primary-500" />
                                            </a>
                                            <a href="#"
                                                class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
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
@endsection