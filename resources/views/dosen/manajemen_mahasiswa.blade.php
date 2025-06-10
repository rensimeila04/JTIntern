@extends('layout.template')
@section('content')
    <div class="w-full p-4 bg-white rounded-xl flex-col space-y-4">
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-medium">Manajemen Mahasiswa</div>
            <div class="flex gap-2">
                <a href="#" class="btn-primary bg-blue-500 hover:bg-blue-600">
                    <i class="ph ph-export text-lg"></i> Export Data
                </a>
            </div>
        </div>
        <div class="flex space-x-4">
            <div class="flex justify-between items-center w-full">
                <!-- Status Filter Dropdown -->
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-status" type="button"
                        class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        @if ($currentFilter == 'all')
                            Semua Status
                        @elseif($currentFilter == 'diterima')
                            Diterima
                        @elseif($currentFilter == 'magang')
                            Magang
                        @elseif($currentFilter == 'selesai')
                            Selesai
                        @endif
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
                                href="{{ route('dosen.mahasiswa', ['status' => 'all']) }}">
                                Semua Status
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="{{ route('dosen.mahasiswa', ['status' => 'diterima']) }}">
                                Diterima
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="{{ route('dosen.mahasiswa', ['status' => 'magang']) }}">
                                Magang
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="{{ route('dosen.mahasiswa', ['status' => 'selesai']) }}">
                                Selesai
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Search Form -->
                <form method="GET" action="{{ route('dosen.mahasiswa') }}" id="searchForm" class="flex items-center gap-2">
                    <input type="hidden" name="status" value="{{ $currentFilter }}">
                    <x-search-input placeholder="Cari data magang..." name="search" value="{{ $currentSearch }}"
                        id="searchInput" />
                </form>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col" class="w-4 px-6 py-3 text-start text-xs font-medium text-gray-500">ID
                                    </th>
                                    <th scope="col" class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Nama Mahasiswa</th>
                                    <th scope="col" class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Posisi</th>
                                    <th scope="col" class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Nama Perusahaan</th>
                                    <th scope="col" class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Status</th>
                                    <th scope="col" class="w-4 px-5 py-3 text-start text-xs font-medium text-gray-500">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse($magang as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $item->id_magang }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $item->mahasiswa->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $item->lowongan->judul_lowongan }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $item->lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            @if($item->status_magang == 'diterima')
                                                <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded-md border border-teal-700 bg-blue-50 text-teal-700">
                                                    Diterima
                                                </span>
                                            @elseif($item->status_magang == 'magang')
                                                <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded-md border border-blue-700 bg-blue-50 text-blue-700">
                                                    Magang
                                                </span>
                                            @elseif($item->status_magang == 'selesai')
                                                <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded-md border border-gray-700 bg-blue-50 text-gray-700">
                                                    Selesai
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 whitespace-nowrap text-sm font-medium text-end">
                                            <div class="flex justify-end gap-2">
                                                <a href="#"
                                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-green-600 hover:bg-green-700 rounded-md transition-colors duration-200">
                                                    Detail
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Tidak ada data magang
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="flex items-center justify-end mt-8">
                {{ $magang->links() }}
            </div>
        </div>
    </div>
@endsection