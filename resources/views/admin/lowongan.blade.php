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
                <a href="{{ route('admin.lowongan.tambah') }}" class="btn-primary">
                    <i class="ph ph-plus"></i> Tambah Lowongan
                </a>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="mt-5 flex flex-row justify-between">
        <div class="flex gap-2">
            <!-- Filter Periode -->
            <form method="GET" action="{{ route('admin.lowongan') }}" class="inline">
                <input type="hidden" name="perusahaan" value="{{ $currentPerusahaan }}">
                <input type="hidden" name="search" value="{{ $currentSearch }}">
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-periode" type="button"
                        class="hs-dropdown-toggle py-2 px-4 inline-flex items-center gap-x-2 text-sm rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        {{ $currentPeriode == 'all' ? 'Semua Periode' : $periodeList->where('id_periode_magang', $currentPeriode)->first()?->nama_periode ?? 'Semua Periode' }}
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden w-60 bg-white shadow-md rounded-lg mt-2"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-periode">
                        <div class="p-1 space-y-0.5">
                            <button type="submit" name="periode" value="all"
                                class="w-full text-left flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                                Semua Periode
                            </button>
                            @foreach ($periodeList as $periode)
                                <button type="submit" name="periode" value="{{ $periode->id_periode_magang }}"
                                    class="w-full text-left flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                                    {{ $periode->nama_periode }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>

            <!-- Filter Perusahaan -->
            <form method="GET" action="{{ route('admin.lowongan') }}" class="inline">
                <input type="hidden" name="periode" value="{{ $currentPeriode }}">
                <input type="hidden" name="search" value="{{ $currentSearch }}">
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-perusahaan" type="button"
                        class="hs-dropdown-toggle py-2 px-4 inline-flex items-center gap-x-2 text-sm rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        {{ $currentPerusahaan == 'all' ? 'Semua Perusahaan' : $perusahaanList->where('id_perusahaan_mitra', $currentPerusahaan)->first()?->nama_perusahaan_mitra ?? 'Semua Perusahaan' }}
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden w-60 bg-white shadow-md rounded-lg mt-2"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-perusahaan">
                        <div class="p-1 space-y-0.5">
                            <button type="submit" name="perusahaan" value="all"
                                class="w-full text-left flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                                Semua Perusahaan
                            </button>
                            @foreach ($perusahaanList as $perusahaan)
                                <button type="submit" name="perusahaan" value="{{ $perusahaan->id_perusahaan_mitra }}"
                                    class="w-full text-left flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                                    {{ $perusahaan->nama_perusahaan_mitra }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.lowongan') }}" class="flex items-center">
            <input type="hidden" name="periode" value="{{ $currentPeriode }}">
            <input type="hidden" name="perusahaan" value="{{ $currentPerusahaan }}">
            <x-search-input placeholder="Cari lowongan..." name="search" value="{{ $currentSearch }}" />
        </form>
    </div>

    <!-- Lowongan List -->
    @if ($lowongan->count() > 0)
        @foreach ($lowongan as $item)
            <div class="flex justify-between items-center mt-5 w-full bg-white p-4 rounded-md">
                <div class="flex">
                    <img src="{{ $item->perusahaanMitra->logo ? Storage::url($item->perusahaanMitra->logo) : asset('Images/placeholder_perusahaan.png') }}"
                        alt="{{ $item->perusahaanMitra->nama_perusahaan_mitra }}" class="w-30 h-30 rounded-lg object-contain">
                    <div class="flex flex-col pl-6 gap-y-1">
                        <div class="flex gap-4 items-center">
                            <h4 class="font-semibold">{{ $item->judul_lowongan }}</h4>
                            <p
                                class="rounded-md border {{ $item->status_pendaftaran ? 'border-teal-500 text-teal-500' : 'border-red-500 text-red-500' }} p-1 text-xs">
                                {{ $item->status_pendaftaran ? 'Aktif Merekrut' : 'Tidak Aktif' }}
                            </p>
                        </div>
                        <p class="text-primary-500">
                            {{ $item->perusahaanMitra->nama_perusahaan_mitra }}
                        </p>
                        <span class="flex items-center gap-2">
                            <i class="ph ph-map-pin text-neutral-500"></i>
                            <p class="text-neutral-700">{{ $item->perusahaanMitra->alamat }}</p>
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="ph ph-calendar text-neutral-500"></i>
                            <p class="text-neutral-700">{{ $item->periodeMagang->nama_periode }}</p>
                        </span>
                    </div>
                </div>
                <span>
                    <a href="{{ route('admin.lowongan.detail', $item->id_lowongan) }}" class="btn-primary-lg">
                        Lihat Detail
                    </a>
                </span>
            </div>
        @endforeach
    @else
        <div class="flex justify-center items-center mt-10 w-full p-8 rounded-md">
            <div class="text-center">
                <i class="ph ph-folder-open text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-500 mb-2">Tidak ada lowongan ditemukan</h3>
                <p class="text-gray-400">Silakan coba filter atau pencarian yang berbeda</p>
            </div>
        </div>
    @endif

    <!-- Pagination -->
    @if ($lowongan->hasPages())
        <div class="flex items-center justify-end mt-5">
            {{ $lowongan->links('pagination::simple-tailwind') }}
        </div>
    @endif
@endsection
