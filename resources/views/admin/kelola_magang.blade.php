@extends('layout.template')

@section('content')
    <div class="flex flex-col space-y-4">
        <!-- Statistics Cards -->
        <div class="flex flex-row gap-4 w-full">
            <!-- Card 1 - Menunggu -->
            <div class="flex-1 min-w-0 p-4 bg-white rounded-lg flex flex-col items-center space-y-4">
                <div class="flex items-center justify-center gap-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-hourglass class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base font-medium text-neutral-400">Menunggu</span>
                </div>
                <div class="flex-1 flex items-center justify-center h-[44px] w-full">
                    <span class="text-4xl font-medium text-neutral-700">{{ $counts['menunggu'] }}</span>
                </div>
                <div class="flex-2 flex items-center justify-center">
                    <a class="text-base font-medium text-primary-500 underline"
                        href="{{ route('admin.kelola-magang.permohonan_magang') }}">Lihat Detail</a>
                </div>
            </div>

            <!-- Card 2 - Aktif (Magang) -->
            <div class="flex-1 min-w-0 p-4 bg-white rounded-lg flex flex-col items-center space-y-4">
                <div class="flex items-center justify-center gap-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-mail-check class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base font-medium text-neutral-400">Aktif</span>
                </div>
                <div class="flex-1 flex items-center justify-center h-[44px] w-full">
                    <span class="text-4xl font-medium text-neutral-700">{{ $counts['aktif'] }}</span>
                </div>
                <div class="flex-2 flex items-center justify-center">
                    <a class="text-base font-medium text-primary-500 underline"
                        href="{{ route('admin.kelola-magang.magang_aktif') }}">Lihat Detail</a>
                </div>
            </div>

            <!-- Card 3 - Ditolak -->
            <div class="flex-1 min-w-0 p-4 bg-white rounded-lg flex flex-col items-center space-y-4">
                <div class="flex items-center justify-center gap-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-mail-x class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base font-medium text-neutral-400">Ditolak</span>
                </div>
                <div class="flex-1 flex items-center justify-center h-[44px] w-full">
                    <span class="text-4xl font-medium text-neutral-700">{{ $counts['ditolak'] }}</span>
                </div>
                <div class="flex-2 flex items-center justify-center">
                    <a class="text-base font-medium text-primary-500 underline"
                        href="{{ route('admin.kelola-magang.pengajuan_ditolak') }}">Lihat Detail</a>
                </div>
            </div>

            <!-- Card 4 - Selesai -->
            <div class="flex-1 min-w-0 p-4 bg-white rounded-lg flex flex-col items-center space-y-4">
                <div class="flex items-center justify-center gap-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-file-check-2 class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base font-medium text-neutral-400">Selesai</span>
                </div>
                <div class="flex-1 flex items-center justify-center h-[44px] w-full">
                    <span class="text-4xl font-medium text-neutral-700">{{ $counts['selesai'] }}</span>
                </div>
                <div class="flex-2 flex items-center justify-center">
                    <a class="text-base font-medium text-primary-500 underline"
                        href="{{ route('admin.kelola-magang.riwayat_magang') }}">Lihat Detail</a>
                </div>
            </div>
        </div>

        <div class="w-full p-4 bg-white rounded-2xl flex-col space-y-4">
            <!-- Header dan tombol aksi -->
            <div class="flex justify-between items-center w-full">
                <div class="text-neutral-900 text-xl font-medium">Data Magang</div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.kelola-magang.export') }}" class="btn-primary bg-blue-500 hover:bg-blue-600" target="_blank">
                        <i class="ph ph-export text-lg"></i> Export Data
                    </a>
                </div>
            </div>

            <!-- Filter & Search -->
            <div class="flex justify-between space-x-4">
                <div class="w-[500px] flex justify-start items-center gap-2">
                    <!-- Status Filter Dropdown -->
                    <div class="hs-dropdown relative inline-flex">
                        <button id="hs-dropdown-status" type="button"
                            class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                            @if ($currentFilter == 'all')
                                Semua Status
                            @elseif($currentFilter == 'menunggu')
                                Menunggu
                            @elseif($currentFilter == 'diterima')
                                Diterima
                            @elseif($currentFilter == 'magang')
                                Magang
                            @elseif($currentFilter == 'selesai')
                                Selesai
                            @elseif($currentFilter == 'ditolak')
                                Ditolak
                            @endif
                            <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </button>
                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                            role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-status">
                            <div class="p-1 space-y-0.5">
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="{{ route('admin.kelola-magang', ['status' => 'all']) }}">
                                    Semua Status
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="{{ route('admin.kelola-magang', ['status' => 'diterima']) }}">
                                    Diterima
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="{{ route('admin.kelola-magang', ['status' => 'magang']) }}">
                                    Magang
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="{{ route('admin.kelola-magang', ['status' => 'menunggu']) }}">
                                    Menunggu
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="{{ route('admin.kelola-magang', ['status' => 'ditolak']) }}">
                                    Ditolak
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="{{ route('admin.kelola-magang', ['status' => 'selesai']) }}">
                                    Selesai
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Lowongan Filter Dropdown -->
                    <div class="hs-dropdown relative inline-flex">
                        <button id="hs-dropdown-lowongan" type="button"
                            class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                            {{ $currentLowongan == 'all' ? 'Semua Magang' : $lowonganList->firstWhere('id_lowongan', $currentLowongan)?->judul_lowongan ?? 'Semua Magang' }}
                            <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </button>
                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                            role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-lowongan">
                            <div class="p-1 space-y-0.5">
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="{{ route('admin.kelola-magang', ['lowongan_id' => 'all', 'status' => $currentFilter]) }}">
                                    Semua Magang
                                </a>
                                @foreach ($lowonganList as $lowongan)
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        href="{{ route('admin.kelola-magang', ['lowongan_id' => $lowongan->id_lowongan, 'status' => $currentFilter]) }}">
                                        {{ $lowongan->judul_lowongan }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Form -->
                <form method="GET" action="{{ route('admin.kelola-magang') }}" id="searchForm"
                    class="flex items-center gap-2">
                    <input type="hidden" name="status" value="{{ $currentFilter }}">
                    <input type="hidden" name="lowongan_id" value="{{ $currentLowongan }}">
                    <x-search-input placeholder="Cari data magang..." name="search" value="{{ $currentSearch }}"
                        id="searchInput" />
                </form>
            </div>

            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 w-full inline-block align-middle">
                        <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                            <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-gray-50 dark:bg-neutral-700">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-12">
                                            ID</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-48">
                                            Nama Mahasiswa</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-56">
                                            Judul Lowongan</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-64">
                                            Nama Perusahaan</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-32">
                                            Status</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-52">
                                            Dosen Pembimbing</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-36">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @forelse ($magang as $item)
                                        <tr>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $item->id_magang }}
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $item->mahasiswa->user->name }}
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $item->lowongan->judul_lowongan }}
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $item->lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                @if ($item->status_magang == 'menunggu')
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-yellow-500 text-yellow-500">Menunggu</span>
                                                @elseif($item->status_magang == 'diterima')
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">Diterima</span>
                                                @elseif($item->status_magang == 'magang')
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-blue-500 text-blue-500">Magang</span>
                                                @elseif($item->status_magang == 'selesai')
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-500 text-neutral-500">Selesai</span>
                                                @elseif($item->status_magang == 'ditolak')
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-red-500 text-red-500">Ditolak</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $item->dosenPembimbing ? $item->dosenPembimbing->user->name : 'Belum ditambahkan' }}
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium">
                                                <div class="flex justify-start gap-2">
                                                    <a href="{{ route('admin.kelola-magang.detail', $item->id_magang) }}"
                                                        class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                        <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                    </a>

                                                    @if (in_array($item->status_magang, ['diterima', 'magang', 'selesai', 'ditolak']))
                                                        <button type="button"
                                                            onclick="openEditModal({{ $item->id_magang }})"
                                                            class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none"
                                                            data-hs-overlay="#edit-modal">
                                                            <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                        </button>
                                                    @else
                                                        <span
                                                            class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-gray-300 focus:outline-hidden border border-gray-300 disabled:opacity-50 disabled:pointer-events-none cursor-not-allowed">
                                                            <x-lucide-file-edit class="w-4 h-4 text-gray-300" />
                                                        </span>
                                                    @endif

                                                    <button type="button"
                                                        onclick="confirmDeleteMagang({{ $item->id_magang }}, '{{ $item->mahasiswa->user->name }}')"
                                                        class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                        <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">
                                                Tidak ada data magang yang tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            @if ($magang->hasPages())
                <div class="flex items-center justify-end mt-4">
                    {{ $magang->links('custom.pagination') }}
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="deleteModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="deleteModal-label" class="font-bold text-gray-800 dark:text-white">
                        Konfirmasi Hapus
                    </h3>
                    <button type="button" id="closeDeleteModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-trash-2 class="w-8 h-8 text-red-600" />
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Hapus Data Magang</h4>
                        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Apakah Anda yakin ingin menghapus data magang mahasiswa <span id="deleteMagangName"
                                class="font-semibold"></span>?
                        </p>
                        <p class="mt-1 text-xs text-red-600">
                            Tindakan ini tidak dapat dibatalkan!
                        </p>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="cancelDelete"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800">
                        Batal
                    </button>
                    <button type="button" id="confirmDelete"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        <span id="deleteButtonText">Hapus</span>
                        <div id="deleteSpinner"
                            class="hidden animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full"
                            role="status" aria-label="loading">
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="successModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="successModal-label" class="font-bold text-gray-800 dark:text-white">
                        Berhasil!
                    </h3>
                    <button type="button" id="closeSuccessModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-check class="w-8 h-8 text-green-600" />
                        </div>
                        <h4 id="successModal-action-title" class="text-lg font-semibold text-gray-900 mb-2">Data Berhasil Dihapus</h4>
                        <p id="successMessage" class="text-sm text-gray-600 mb-4">
                            Data magang telah berhasil dihapus.
                        </p>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="closeSuccessBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        <x-lucide-check class="w-4 h-4" />
                        Selesai
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="edit-modal-label">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div
                class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="edit-modal-label" class="font-bold text-gray-800 dark:text-white">
                        Edit Data Magang
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#edit-modal">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <form id="editMagangForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-4 overflow-y-auto">
                        <div class="space-y-4">
                            <!-- Mahasiswa Info (Read Only) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mahasiswa</label>
                                <input type="text" id="edit-mahasiswa-name"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600"
                                    readonly>
                            </div>

                            <!-- Lowongan Info (Read Only) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Lowongan</label>
                                <input type="text" id="edit-lowongan-title"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600"
                                    readonly>
                            </div>

                            <!-- Status Magang -->
                            <div>
                                <label for="edit-status-magang"
                                    class="block text-sm font-medium text-gray-700 mb-1">Status Magang</label>
                                <select name="status_magang" id="edit-status-magang"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    <option value="menunggu">Menunggu</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="magang">Magang</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>

                            <!-- Dosen Pembimbing -->
                            <div>
                                <label for="edit-dosen-pembimbing"
                                    class="block text-sm font-medium text-gray-700 mb-1">Dosen Pembimbing</label>
                                <select name="id_dosen_pembimbing" id="edit-dosen-pembimbing"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    <option value="">-- Pilih Dosen Pembimbing --</option>
                                    @foreach ($dosenList ?? [] as $dosen)
                                        <option value="{{ $dosen->id_dosen_pembimbing }}">{{ $dosen->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                            data-hs-overlay="#edit-modal">
                            Batal
                        </button>
                        <button type="submit" id="saveEditBtn"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 focus:outline-hidden focus:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                            <span id="saveEditText">Simpan Perubahan</span>
                            <div id="saveEditSpinner"
                                class="hidden animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full"
                                role="status" aria-label="loading"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality with debounce
            const searchInput = document.getElementById('searchInput');
            const searchForm = document.getElementById('searchForm');
            let searchTimeout;

            if (searchInput && searchForm) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(function() {
                        searchForm.submit();
                    }, 500);
                });

                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        clearTimeout(searchTimeout);
                        searchForm.submit();
                    }
                });
            }

            // Delete functionality
            let deleteMagangId = null;
            // let deleteModal = null; // Consider refactoring to use HSOverlay.getInstance if issues arise
            // let successModal = null; // Consider refactoring to use HSOverlay.getInstance

            // It's generally better to get HSOverlay instances when needed rather than storing them globally
            // if they are re-initialized or if HSOverlay manages them internally.

            window.confirmDeleteMagang = function(id, name) {
                deleteMagangId = id;
                document.getElementById('deleteMagangName').textContent = name;
                console.log('confirmDeleteMagang called for id:', id);
                try {
                    // const modalElement = document.getElementById('deleteModal');
                    // const deleteModalInstance = HSOverlay.getInstance(modalElement, true); 
                    // if (deleteModalInstance && typeof deleteModalInstance.open === 'function') {
                    //     deleteModalInstance.open();
                    // } else {
                    //     console.warn('HSOverlay instance for #deleteModal not found or open is not a function. Using static open.');
                    //     HSOverlay.open(document.querySelector('#deleteModal'));
                    // }
                    HSOverlay.open(document.querySelector('#deleteModal'));
                    console.log('Called HSOverlay.open("#deleteModal")');
                } catch (error) {
                    console.error('Error opening delete modal:', error);
                    document.getElementById('deleteModal').classList.remove('hidden');
                    document.body.classList.add('hs-overlay-body-scrolling'); 
                }
            }

            function closeDeleteModal() {
                console.log('closeDeleteModal called');
                try {
                    HSOverlay.close(document.querySelector('#deleteModal'));
                    console.log('Called HSOverlay.close("#deleteModal")');
                } catch (error) {
                    console.error('Error closing delete modal:', error);
                    document.getElementById('deleteModal').classList.add('hidden');
                    document.body.classList.remove('hs-overlay-body-scrolling');
                    const backdrop = document.querySelector('.hs-overlay-backdrop[data-hs-overlay-backdrop-template]');
                    if (backdrop) backdrop.remove();
                }
                deleteMagangId = null;
            }

            function showSuccessModal(message, title = 'Berhasil!') { 
                const successModalLabel = document.getElementById('successModal-label');
                if (successModalLabel) {
                    successModalLabel.textContent = title;
                }

                const successModalActionTitle = document.getElementById('successModal-action-title'); // Get the h4 element
                if (successModalActionTitle) { // Set its text to the same main title
                    successModalActionTitle.textContent = title;
                }

                if (message) {
                    const successMessageElement = document.getElementById('successMessage');
                    if (successMessageElement) { 
                        successMessageElement.textContent = message;
                    } else {
                        console.error('#successMessage element not found');
                    }
                }
                console.log('Attempting to show success modal with title:', title, 'and message:', message);
                try {
                    HSOverlay.open(document.querySelector('#successModal'));
                    console.log('Called HSOverlay.open("#successModal")');
                } catch (error) {
                    console.error('Error opening success modal:', error);
                    const modalElement = document.getElementById('successModal');
                    if (modalElement) { 
                         modalElement.classList.remove('hidden');
                         document.body.classList.add('hs-overlay-body-scrolling'); 
                    }
                }
            }

            function closeSuccessModal() {
                console.log('Attempting to close success modal.');
                try {
                    // const modalElement = document.getElementById('successModal');
                    // const successModalInstance = HSOverlay.getInstance(modalElement);
                    // if (successModalInstance && typeof successModalInstance.close === 'function') {
                    //     successModalInstance.close();
                    // } else {
                    //     console.warn('HSOverlay instance for #successModal not found or close is not a function. Using static close. Element:', modalElement, 'Instance:', successModalInstance);
                    //     HSOverlay.close(modalElement); // Try with element
                    // }
                    HSOverlay.close(document.querySelector('#successModal'));
                    console.log('Called HSOverlay.close("#successModal")');
                } catch (error) {
                    console.error('Error closing success modal:', error);
                    const modalElement = document.getElementById('successModal');
                    if (modalElement) { 
                        modalElement.classList.add('hidden');
                        document.body.classList.remove('hs-overlay-body-scrolling');
                        const backdrop = document.querySelector('.hs-overlay-backdrop[data-hs-overlay-backdrop-template]');
                        if (backdrop) backdrop.remove();
                    }
                }
            }

            // Set up event listeners for delete functionality
            const cancelDeleteBtn = document.getElementById('cancelDelete');
            if (cancelDeleteBtn) {
                cancelDeleteBtn.addEventListener('click', closeDeleteModal);
            }

            const closeDeleteModalBtn = document.getElementById('closeDeleteModalBtn');
            if (closeDeleteModalBtn) {
                closeDeleteModalBtn.addEventListener('click', closeDeleteModal);
            }

            // Success modal buttons
            const closeSuccessBtn = document.getElementById('closeSuccessBtn');
            if (closeSuccessBtn) {
                closeSuccessBtn.addEventListener('click', function() {
                    console.log('Success modal "Selesai" button clicked.');
                    closeSuccessModal();
                    window.location.reload();
                });
            }

            const closeSuccessModalBtnElement = document.getElementById('closeSuccessModalBtn');
            if (closeSuccessModalBtnElement) {
                closeSuccessModalBtnElement.addEventListener('click', function() {
                    console.log('Success modal "X" button clicked.');
                    closeSuccessModal();
                    window.location.reload(); // Or just closeSuccessModal(); if reload is not desired for 'X'
                });
            }

            // Delete confirmation button
            const confirmDeleteBtn = document.getElementById('confirmDelete');
            if (confirmDeleteBtn) {
                confirmDeleteBtn.addEventListener('click', function() {
                    // ... (existing delete confirmation logic, ensure HSOverlay.getInstance is used if needed)
                    if (!deleteMagangId) return;
                    console.log('Confirm delete button clicked for id:', deleteMagangId);

                    this.disabled = true;
                    document.getElementById('deleteButtonText').textContent = 'Menghapus...';
                    document.getElementById('deleteSpinner').classList.remove('hidden');

                    fetch(`{{ url('admin/kelola-magang') }}/${deleteMagangId}`, { // Use url() for consistency
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                        })
                        .then(response => {
                            console.log('Delete response:', response);
                            if (!response.ok) {
                                return response.json().then(errData => {
                                    console.error('Delete error response data:', errData);
                                    throw new Error(errData.message || `HTTP error! status: ${response.status}`);
                                }).catch(() => {
                                    throw new Error(`HTTP error! status: ${response.status} and response was not valid JSON.`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Delete success data:', data);
                            closeDeleteModal();
                            showSuccessModal(data.message || 'Data berhasil dihapus.', 'Data Berhasil Dihapus'); // Updated call
                        })
                        .catch(error => {
                            console.error('Error during delete operation:', error);
                            alert('Gagal menghapus data: ' + error.message);
                            closeDeleteModal(); // Still close modal on error
                        })
                        .finally(() => {
                            this.disabled = false;
                            document.getElementById('deleteButtonText').textContent = 'Hapus';
                            document.getElementById('deleteSpinner').classList.add('hidden');
                        });
                });
            }

            // Edit Modal functionality
            let currentEditId = null;

            window.openEditModal = function(magangId) {
                currentEditId = magangId;
                console.log('openEditModal called for id:', magangId);

                fetch(`{{ url('admin/kelola-magang') }}/${magangId}/edit`, { // Use url() for consistency
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        console.log('Fetch magang data for edit response:', response);
                        if (!response.ok) {
                             return response.json().then(errData => {
                                console.error('Fetch edit data error response data:', errData);
                                throw new Error(errData.message || `HTTP error! status: ${response.status}`);
                            }).catch(() => {
                                throw new Error(`HTTP error! status: ${response.status} and response was not valid JSON.`);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Fetched magang data for edit:', data);
                        if (data.success) {
                            const magang = data.magang;
                            document.getElementById('edit-mahasiswa-name').value = magang.mahasiswa.user.name;
                            document.getElementById('edit-lowongan-title').value = magang.lowongan.judul_lowongan;
                            document.getElementById('edit-status-magang').value = magang.status_magang;
                            document.getElementById('edit-dosen-pembimbing').value = magang.id_dosen_pembimbing || '';
                            // The form action is already set in the HTML, but if you need to dynamically set it:
                            // document.getElementById('editMagangForm').action = `{{ url('admin/kelola-magang') }}/${magangId}`;
                        } else {
                            console.error('Failed to load magang data for edit:', data.message);
                            alert('Gagal memuat data magang: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching magang data for edit:', error);
                        alert('Gagal memuat data magang: ' + error.message);
                    });
            };

            const editForm = document.getElementById('editMagangForm');
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    console.log('Edit form submitted');

                    const saveEditBtn = document.getElementById('saveEditBtn');
                    const saveEditText = document.getElementById('saveEditText');
                    const saveEditSpinner = document.getElementById('saveEditSpinner');

                    saveEditBtn.disabled = true;
                    saveEditText.classList.add('hidden');
                    saveEditSpinner.classList.remove('hidden');
                    console.log('Loading state shown for edit save');

                    const formData = new FormData(this);
                    const actionUrl = `{{ url('admin/kelola-magang') }}/${currentEditId}`;
                    console.log('Edit Action URL:', actionUrl);

                    fetch(actionUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'X-HTTP-Method-Override': 'PUT'
                        },
                        body: formData
                    })
                    .then(response => {
                        console.log('Edit fetch response received:', response);
                        if (!response.ok) {
                            return response.json().then(errData => {
                                console.error('Edit fetch error response data:', errData);
                                throw new Error(errData.message || `HTTP error! status: ${response.status}`);
                            }).catch(() => {
                                throw new Error(`HTTP error! status: ${response.status} and response was not valid JSON.`);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Edit response data (JSON):', data);
                        if (data.success) {
                            console.log('Edit operation successful, attempting to close edit modal.');
                            try {
                                HSOverlay.close(document.querySelector('#edit-modal'));
                                console.log('Called HSOverlay.close("#edit-modal")');
                            } catch (closeError) {
                                console.error('Error closing edit modal:', closeError);
                                const modalElement = document.getElementById('edit-modal');
                                if (modalElement) modalElement.classList.add('hidden'); // Fallback
                                document.body.classList.remove('hs-overlay-body-scrolling');
                                const backdrop = document.querySelector('.hs-overlay-backdrop[data-hs-overlay-backdrop-template]');
                                if (backdrop) backdrop.remove();
                            }
                            console.log('Showing success modal with message:', data.message || 'Data berhasil diperbarui.');
                            showSuccessModal(data.message || 'Data berhasil diperbarui.', 'Data Berhasil Diperbarui'); // Updated call
                        } else {
                            let errorMessage = data.message || 'Gagal memperbarui data.';
                            if (data.errors) {
                                const errorMessages = Object.values(data.errors).flat();
                                errorMessage += '\n- ' + errorMessages.join('\n- ');
                            }
                            console.error('Edit operation failed:', errorMessage);
                            alert(errorMessage);
                        }
                    })
                    .catch(error => {
                        console.error('Error during edit form submission (fetch catch):', error);
                        alert('Terjadi kesalahan saat menyimpan data: ' + error.message);
                    })
                    .finally(() => {
                        console.log('Edit finally block: Resetting button state.');
                        saveEditBtn.disabled = false;
                        saveEditText.classList.remove('hidden');
                        saveEditSpinner.classList.add('hidden');
                    });
                });
            }

            // Check for success message from session
            @if (session('success') && session('message'))
                console.log('Session success message found, showing modal.');
                showSuccessModal('{{ session('message') }}', 'Berhasil!'); // Updated call
            @endif
        });
    </script>
@endsection
