@extends('layout.template')
@section('content')
    <div class="flex flex-row items-center justify-between">
        <div>
            <h2 class="text-xl font-medium">Daftar Lowongan</h2>
        </div>
        <div class="flex-row">
            <div class="flex gap-2">
                <a href="#" class="btn-primary bg-blue-500 hover:bg-blue-600">
                    <i class="ph ph-export text-lg"></i> Export
                </a>
                <a href="#" class="btn-primary bg-amber-500 hover:bg-amber-600">
                    <i class="ph ph-arrow-square-in"></i> Import
                </a>
                <a href="#" class="btn-primary">
                    <i class="ph ph-plus"></i> Tambah Lowongan
                </a>
            </div>
        </div>
    </div>
    <div class="mt-5 flex flex-row justify-between">
        <div>
            <div class="hs-dropdown relative inline-flex">
                <button id="hs-dropdown-default" type="button"
                    class="hs-dropdown-toggle py-2 px-4 inline-flex items-center gap-x-2 text-sm rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Semua Periode
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>
                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden w-60 bg-white shadow-md rounded-lg mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                    <div class="p-1 space-y-0.5">
                        <a
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Semua Periode
                        </a>
                        <a
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Ganjil 2025
                        </a>
                        <a
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Genap 2026
                        </a>
                        <a
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Ganjil 2026
                        </a>
                    </div>
                </div>
            </div>
            <div class="hs-dropdown relative inline-flex">
                <button id="hs-dropdown-default" type="button"
                    class="hs-dropdown-toggle py-2 px-4 inline-flex items-center gap-x-2 text-sm rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Semua Perusahaan
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>
                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden w-60 bg-white shadow-md rounded-lg mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                    <div class="p-1 space-y-0.5">
                        <a
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Semua Perusahaan
                        </a>
                        <a
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Ganjil 2025
                        </a>
                        <a
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Genap 2026
                        </a>
                        <a
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Ganjil 2026
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <x-search-input placeholder="Cari lowongan..." />
    </div>

    @for ($i = 0; $i < 5; $i++)
        <div class="flex justify-between items-center mt-5 w-full bg-white p-4 rounded-md">
            <div class="flex ">
                <img src="{{ asset('Images/LOGOPT.png') }}">
                <div class="flex flex-col pl-6 gap-y-1 ">
                    <div class="flex gap-4 items-center">
                        <h4 class="font-semibold">UI UX DESIGNER</h4>
                        <p class="rounded-md border border-teal-500 text-teal-500 p-1 text-xs">Aktif Merekrut</p>
                    </div>
                    <p class="text-primary-500">
                        PT. Quantum Technology Nusantara
                    </p>
                    <span class="flex items-center gap-2">
                        <i class="ph ph-map-pin text-neutral-500"></i>
                        <p class="text-neutral-700">Jakarta Selatan, DKI Jakarta, Indonesia</p>
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="ph ph-calendar text-neutral-500"></i>
                        <p class="text-neutral-700">Ganjil 2026</p>
                    </span>
                </div>
            </div>
            <span>
                <button type="button" href="#" class="btn-primary-lg">
                    Lihat Detail
                </button>
            </span>
        </div>
    @endfor

    <div class="flex items-center justify-end mt-5">
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
@endsection
