@extends('layout.template')
@section('content')
    <div class="flex flex-col gap-6">
        <div>
            <h2 class="text-xl font-medium">Daftar Lowongan</h2>
        </div>
        <div class="flex items-center">
            <div class="flex gap-2.5 flex-1">
                <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                    <button type="button"
                        class="hs-tab-active:bg-primary-500 hs-tab-active:text-white dark:hs-tab-active:bg-primary-60 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm font-medium text-center text-gray-500 rounded-lg hover:text-primary-600 focus:outline-hidden focus:text-primary-600 disabled:opacity-50 disabled:pointer-events-none active"
                        id="semua-lowongan" aria-selected="true" data-hs-tab="#semua-lowongan"
                        aria-controls="semua-lowongan" role="tab">
                        Semua Lowongan
                    </button>
                    <button type="button"
                        class="hs-tab-active:bg-primary-500 hs-tab-active:text-white dark:hs-tab-active:bg-primary-60 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm font-medium text-center text-gray-500 rounded-lg hover:text-primary-600 focus:outline-hidden focus:text-primary-600 disabled:opacity-50 disabled:pointer-events-none"
                        id="rekomendasi-mabac" aria-selected="true" data-hs-tab="#rekomendasi-mabac"
                        aria-controls="rekomendasi-mabac" role="tab">
                        Rekomendasi MABAC
                    </button>
                    <button type="button"
                        class="hs-tab-active:bg-primary-500 hs-tab-active:text-white dark:hs-tab-active:bg-primary-60 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm font-medium text-center text-gray-500 rounded-lg hover:text-primary-600 focus:outline-hidden focus:text-primary-600 disabled:opacity-50 disabled:pointer-events-none"
                        id="rekomendasi-topsis" aria-selected="true" data-hs-tab="#rekomendasi-topsis"
                        aria-controls="rekomendasi-topsis" role="tab">
                        Rekomendasi Topsis
                    </button>
                </nav>
                <div class="flex justify-end items-center gap-2 flex-1">
                    <form method="GET" action="" id="searchForm" class="flex items-center gap-2">
                        <x-search-input name="search" placeholder="Cari lowongan..." id="searchInput"
                            class="py-3 px-4 pl-11 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" />
                        <input type="hidden" name="jenis_perusahaan">
                    </form>
                </div>
            </div>

        </div>
        <div>
            <div class="hs-dropdown relative inline-flex">
                <button id="hs-dropdown-status" type="button"
                    class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-md font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Semua Tipe Magang
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
                            Semua Tipe Magang
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            WFO
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            Remote
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            Hybrid
                        </a>
                    </div>
                </div>
            </div>
            <div class="hs-dropdown relative inline-flex">
                <button id="hs-dropdown-status" type="button"
                    class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-md font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Semua Perusahaan
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
                            Semua Perusahaan
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            BUMN
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            Pemerintah
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            Software House
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            Studio
                        </a>
                    </div>
                </div>
            </div>
            <div class="hs-dropdown relative inline-flex">
                <button id="hs-dropdown-status" type="button"
                    class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-md font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Semua Lokasi
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
                            Semua Lokasi
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            < 5 Km </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    > 5 Km
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    > 10 Km
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#">
                                    Jauh pokok e
                                </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Daftar Lowongan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3=2 gap-4 w-full">
            @for ($i = 1; $i <= 6; $i++)
                <div class="bg-white flex-col rounded-xl flex py-6 px-4 gap-4">
                    <div class="inline-flex items-center gap-6">
                        <img src="https://placehold.co/80x80?text=Logo" alt="Logo"
                            class="w-20 h-20 rounded-lg object-contain bg-gray-50">
                        <div class="flex flex-col flex-1 justify-start items-start gap-2 h-fill">
                            <div class="self-stretch inline-flex justify-start items-center gap-4">
                                <div class="justify-start text-black text-lg font-medium leading-none">
                                    UI UX Designer</div>
                            </div>
                            <div class="inline-flex justify-start items-center gap-2">
                                <a class="justify-start text-neutral-400 text-sm font-normal leading-none">
                                    PT. Quantum</a>
                                <div class="w-1 h-1 bg-neutral-400 rounded-full"></div>
                                <a class="justify-start text-neutral-400 text-sm font-normal leading-none">
                                    Jakarta Pusat</a>
                            </div>
                            <div class="inline-flex justify-start items-start gap-2">
                                <span
                                    class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">WFO</span>
                                <span
                                    class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">Software
                                    House</span>
                            </div>
                        </div>
                        <button type="button"
                            class="ml-auto py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-600 disabled:opacity-50 disabled:pointer-events-none">
                            Ajukan Magang
                        </button>
                    </div>
                    <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">
                    <div class="self-stretch inline-flex justify-start items-center gap-2">
                        <a class="justify-start text-neutral-400 text-sm font-normal leading-none">
                            23 hari tersisa</a>
                        <div class="w-1 h-1 bg-neutral-400 rounded-full"></div>
                        <a class="justify-start text-neutral-400 text-sm font-normal leading-none">
                            30 Pelamar</a>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    </script>
@endsection
