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
                    <a href="#" class="btn-primary bg-blue-500 hover:bg-blue-600">
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
                            @if($currentFilter == 'all')
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
                            <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
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
                                @foreach($lowonganList as $lowongan)
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
                                                @if($item->status_magang == 'menunggu')
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
                                                @if($item->status_magang == 'ditolak' || $item->status_magang == 'menunggu')
                                                    -
                                                @elseif($item->status_magang == 'diterima')
                                                    <span class="text-neutral-400">Belum ditambahkan</span>
                                                @else
                                                    {{ $item->dosenPembimbing ? $item->dosenPembimbing->user->name : 'Belum ditambahkan' }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium">
                                                <div class="flex justify-start gap-2">
                                                    <a href="{{ route('admin.kelola-magang.detail', $item->id_magang) }}"
                                                        class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                        <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                    </a>

                                                    @if(in_array($item->status_magang, ['diterima', 'magang', 'selesai', 'ditolak']))
                                                        <a href="#" onclick="openEditModal({{ $item->id_magang }})"
                                                            class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                            <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                        </a>
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
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Data Berhasil Dihapus</h4>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Search functionality with debounce
            const searchInput = document.getElementById('searchInput');
            const searchForm = document.getElementById('searchForm');
            let searchTimeout;

            if (searchInput && searchForm) {
                searchInput.addEventListener('input', function () {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(function () {
                        searchForm.submit();
                    }, 500);
                });

                searchInput.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        clearTimeout(searchTimeout);
                        searchForm.submit();
                    }
                });
            }

            // Delete functionality
            let deleteMagangId = null;
            let deleteModal = null;
            let successModal = null;

            window.confirmDeleteMagang = function (id, name) {
                deleteMagangId = id;
                document.getElementById('deleteMagangName').textContent = name;

                try {
                    const modalElement = document.getElementById('deleteModal');

                    if (typeof HSOverlay === 'function') {
                        deleteModal = new HSOverlay(modalElement);
                        deleteModal.open();
                    } else if (typeof HSOverlay === 'object' && typeof HSOverlay.open === 'function') {
                        HSOverlay.open(modalElement);
                    } else {
                        modalElement.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    }
                } catch (error) {
                    console.error('Error opening delete modal:', error);
                    document.getElementById('deleteModal').classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                }
            }

            function closeDeleteModal() {
                try {
                    if (deleteModal && typeof deleteModal.close === 'function') {
                        deleteModal.close();
                    } else {
                        document.getElementById('deleteModal').classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                } catch (error) {
                    console.error('Error closing delete modal:', error);
                    document.getElementById('deleteModal').classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }

                deleteModal = null;
                deleteMagangId = null;
            }

            function showSuccessModal(message) {
                if (message) {
                    document.getElementById('successMessage').textContent = message;
                }

                try {
                    const modalElement = document.getElementById('successModal');

                    if (typeof HSOverlay === 'function') {
                        successModal = new HSOverlay(modalElement);
                        successModal.open();
                    } else if (typeof HSOverlay === 'object' && typeof HSOverlay.open === 'function') {
                        HSOverlay.open(modalElement);
                    } else {
                        modalElement.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    }
                } catch (error) {
                    console.error('Error opening success modal:', error);
                    document.getElementById('successModal').classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                }
            }

            function closeSuccessModal() {
                try {
                    if (successModal && typeof successModal.close === 'function') {
                        successModal.close();
                    } else {
                        document.getElementById('successModal').classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                } catch (error) {
                    console.error('Error closing success modal:', error);
                    document.getElementById('successModal').classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }

                successModal = null;
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
                closeSuccessBtn.addEventListener('click', function () {
                    closeSuccessModal();
                    window.location.reload();
                });
            }

            const closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');
            if (closeSuccessModalBtn) {
                closeSuccessModalBtn.addEventListener('click', function () {
                    closeSuccessModal();
                    window.location.reload();
                });
            }

            // Delete confirmation button
            const confirmDeleteBtn = document.getElementById('confirmDelete');
            if (confirmDeleteBtn) {
                confirmDeleteBtn.addEventListener('click', function () {
                    if (!deleteMagangId) return;

                    // Show loading state
                    this.disabled = true;
                    document.getElementById('deleteButtonText').textContent = 'Menghapus...';
                    document.getElementById('deleteSpinner').classList.remove('hidden');

                    // Send delete request
                    fetch(`{{ url('/admin/magang') }}/${deleteMagangId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Close delete modal first
                            closeDeleteModal();
                            // Show success modal
                            showSuccessModal(data.message);
                        })
                        .catch(error => {
                            console.error('Error:', error);

                            // Close the modal and show success message anyway since the deletion might have succeeded
                            closeDeleteModal();

                            // Check if we should reload
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        })
                        .finally(() => {
                            // Reset button state
                            this.disabled = false;
                            document.getElementById('deleteButtonText').textContent = 'Hapus';
                            document.getElementById('deleteSpinner').classList.add('hidden');
                        });
                });
            }

            // Check for success message from session
            @if(session('success') && session('message'))
                showSuccessModal('{{ session('message') }}');
            @endif
                });
    </script>
@endsection