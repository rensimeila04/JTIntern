@extends('layout.template')

@section('content')
    <div class="w-full p-6 bg-white rounded-xl flex-col gap-6 shadow">
        <!-- Header dan tombol aksi -->
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-semibold">Perusahaan Mitra</div>
            <div class="flex gap-2">
                <button
                    class="px-4.5 py-2.5 bg-blue-500 rounded-lg flex items-center gap-2 text-white font-semibold text-base tracking-tight hover:bg-blue-600 transition">
                    <i class="ph ph-export text-lg"></i> Export
                </button>
                <button
                    class="px-4.5 py-2.5 bg-amber-500 rounded-lg flex items-center gap-2 text-white font-semibold text-base tracking-tight hover:bg-amber-600 transition">
                    <i class="ph ph-arrow-square-in"></i> Import
                </button>
                <button
                    class="px-4.5 py-2.5 bg-primary-500 rounded-lg flex items-center gap-2 text-white font-semibold text-base tracking-tight hover:bg-primary-600 transition">
                    <i class="ph ph-plus"></i> Tambah Perusahaan
                </button>
            </div>
        </div>

        <!-- Filter "Semua Pengguna" & "Cari Pengguna" -->
        <div class="flex justify-between mt-6 w-full">
            <div class="hs-dropdown relative inline-flex">
                <button id="hs-dropdown-default" type="button"
                    class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-neutral-400 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Semua Perusahaan
                    <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>

                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                    <div class="p-1 space-y-0.5">
                        @foreach ($jenisPerusahaan as $item)
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="#">
                                {{ $item->nama_jenis_perusahaan }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="flex items-end">
                <!-- SearchBox -->
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none pr-4">
                        <svg class="shrink-0 size-4 text-gray-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                    </div>
                    <input
                        class="py-3 block w-[400px] border-gray-200 rounded-lg sm:text-sm ps-12 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        type="text" role="combobox" aria-expanded="false" placeholder="Cari perusahaan..." value=""
                        data-hs-combo-box-input="">
                </div>
                <!-- End SearchBox -->
            </div>
        </div>

        <!-- Table Header -->
        <div class="w-full mt-4 border-1 border-gray-200 rounded-lg">
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div
                            class="border border-gray-200 rounded-lg shadow-xs overflow-hidden dark:border-neutral-700 dark:shadow-gray-900">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-gray-50 dark:bg-neutral-700">
                                    <tr>
                                        <th scope="col"
                                            class="px-5 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                            ID</th>
                                        <th scope="col"
                                            class="px-5 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                            Nama Perusahaan</th>
                                        <th scope="col"
                                            class="px-5 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                            Bidang Industri</th>
                                        <th scope="col"
                                            class="px-5 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                            Jenis Perusahaan</th>
                                        <th scope="col"
                                            class="px-5 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                            Lokasi</th>
                                        <th scope="col"
                                            class="px-5 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @foreach ($perusahaanMitra as $item)
                                        <tr>
                                            <td
                                                class="px-5 py-3 text-center whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $item->id_perusahaan_mitra }}
                                            </td>
                                            <td
                                                class="px-5 py-3 text-start whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                {{ $item->nama_perusahaan_mitra }}
                                            </td>
                                            <td
                                                class="px-5 py-3 text-start whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                {{ $item->bidang_industri }}
                                            </td>
                                            <td
                                                class="px-5 py-3 text-start whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                {{ $item->jenisPerusahaan->nama_jenis_perusahaan ?? '-' }}
                                            </td>
                                            <td
                                                class="px-5 py-3 text-start whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                {{ $item->alamat }}
                                            </td>
                                            <td class="px-5 py-3 text-start whitespace-nowrap text-sm font-medium">
                                                <button type="button"
                                                    class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-teal-500 text-teal-500 hover:border-teal-400 hover:text-teal-400 focus:outline-hidden focus:border-teal-400 focus:text-teal-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-teal-50 transition">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </button>
                                                <button type="button"
                                                    class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:outline-hidden focus:border-yellow-400 focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-50 transition">
                                                    <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                                                </button>
                                                <button type="button"
                                                    class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-red-50 transition">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-end items-center mt-8">
            <div class="rounded-lg flex items-center overflow-hidden">
                <div class="h-9 px-3 rounded-lg flex items-center gap-2">
                    <span class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">«</span>
                    <span
                        class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">Sebelumnya</span>
                </div>
                <div class="flex items-center">
                    <div class="w-9 h-9 bg-gray-200 rounded-lg flex justify-center items-center">
                        <span class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">1</span>
                    </div>
                    <div class="w-9 h-9 rounded-lg flex justify-center items-center">
                        <span class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">2</span>
                    </div>
                    <div class="w-9 h-9 rounded-lg flex justify-center items-center">
                        <span class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">3</span>
                    </div>
                    <div class="w-9 h-9 rounded-lg flex justify-center items-center">
                        <span class="text-center text-gray-500 text-xs font-medium leading-none tracking-tight">•••</span>
                    </div>
                    <div class="w-9 h-9 rounded-lg flex justify-center items-center">
                        <span
                            class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">10</span>
                    </div>
                </div>
                <div class="h-9 px-3 rounded-lg flex items-center gap-2">
                    <span
                        class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">Selanjutnya</span>
                    <span class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">»</span>
                </div>
            </div>
        </div>
    </div>

@endsection