@extends('layout.template')
@section('content')
    <div class="flex flex-row items-center justify-between">
        <div>
            <h2 class="text-xl font-medium">Daftar Lowongan</h2>
        </div>
        <div class="flex-row">
            <div class="flex items-center gap-x-2">
                <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-500 text-white hover:bg-blue-700">
                    <i class="ph ph-export"></i>
                    Export
                </button>
                <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-700">
                    <i class="ph ph-arrow-square-in"></i>
                    Import
                </button>
                <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700">
                    <i class="ph ph-plus"></i>
                    Tambah Lowongan
                </button>
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
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>
                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden w-60 bg-white shadow-md rounded-lg mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                    <div class="p-1 space-y-0.5">
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Semua Periode
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Ganjil 2025
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Genap 2026
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
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
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>
                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden w-60 bg-white shadow-md rounded-lg mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                    <div class="p-1 space-y-0.5">
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Semua Perusahaan
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Ganjil 2025
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Genap 2026
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                            Ganjil 2026
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative flex items-center">
            <input type="text"
                class="py-1.5 sm:py-2 px-3 pl-10 block w-96 border-gray-200 rounded-lg sm:text-sm items-center"
                placeholder="Cari Lowongan...">
            <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                <i class="ph ph-magnifying-glass text-gray-400"></i>
            </span>
        </div>
    </div>

    @for ($i = 0; $i < 5; $i++)

        <div class="flex justify-between items-center mt-5 w-full bg-white p-4 rounded-md shadow-md">
            <div class="flex ">
                <img src="{{asset('Images/LOGOPT.png') }}">
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
                <button type="button" href="{{ route('admin.detail_lowongan') }}"
                    class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700 focus:outline-hidden focus:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                    Lihat Detail
                </button>
            </span>
        </div>
    @endfor

    <div class="flex justify-end mt-5">
        <nav class="flex items-center gap-x-1" aria-label="Pagination">
            <button type="button"
                class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                aria-label="Previous" disabled="">
                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"></path>
                </svg>
                <span>Sebelumnya</span>
            </button>
            <div class="flex items-center gap-x-1">
                <button type="button"
                    class="min-h-9.5 min-w-9.5 flex justify-center items-center bg-gray-200 text-gray-500 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none"
                    aria-current="page">1</button>
                <button type="button"
                    class="min-h-9.5 min-w-9.5 flex justify-center items-center text-gray-500 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">2</button>
                <button type="button"
                    class="min-h-9.5 min-w-9.5 flex justify-center items-center text-gray-500 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">3</button>
            </div>
            <button type="button"
                class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                aria-label="Next">
                <span>Selanjutnya</span>
                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </button>
        </nav>
    </div>

@endsection