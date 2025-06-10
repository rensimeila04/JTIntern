@extends('layout.template')

@section('content')
    <div class="w-full p-4 bg-white rounded-xl flex-col space-y-4">
        <!-- Header dan tombol aksi -->
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-medium">Magang Aktif</div>
            <div class="flex gap-2">
                <a href="{{ route('admin.kelola-magang.export-magang-aktif', request()->query()) }}"
                    class="btn-primary bg-blue-500 hover:bg-blue-600" target="_blank">
                    <i class="ph ph-export text-lg"></i> Export PDF
                </a>
                <!-- tombol lainnya -->
            </div>
        </div>

        <!-- Filter "Semua Status" & Search -->
        <div class="flex justify-between w-full items-center">
            <div class="flex items-start space-x-2">
                <!-- Status Filter -->
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-default" type="button"
                        class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-neutral-900 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        @if (request('status') == 'magang')
                            Magang
                        @elseif(request('status') == 'diterima')
                            Diterima
                        @else
                            Semua Status
                        @endif
                        <x-lucide-chevron-down class="hs-dropdown-open:rotate-180 size-4" />
                    </button>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                        <div class="p-1 space-y-0.5">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="{{ route('admin.kelola-magang.magang_aktif', ['pembimbing' => request('pembimbing'), 'search' => request('search')]) }}">
                                Semua Status
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="{{ route('admin.kelola-magang.magang_aktif', ['status' => 'magang', 'pembimbing' => request('pembimbing'), 'search' => request('search')]) }}">
                                Magang
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="{{ route('admin.kelola-magang.magang_aktif', ['status' => 'diterima', 'pembimbing' => request('pembimbing'), 'search' => request('search')]) }}">
                                Diterima
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Filter by Pembimbing -->
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-default1" type="button"
                        class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-neutral-900 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        @if (request('pembimbing') == 'dengan')
                            Dengan Dosen Pembimbing
                        @elseif(request('pembimbing') == 'tanpa')
                            Tanpa Dosen Pembimbing
                        @else
                            Semua Magang
                        @endif
                        <x-lucide-chevron-down class="hs-dropdown-open:rotate-180 size-4" />
                    </button>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default1">
                        <div class="p-1 space-y-0.5">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="{{ route('admin.kelola-magang.magang_aktif', ['status' => request('status'), 'search' => request('search')]) }}">
                                Semua Magang
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="{{ route('admin.kelola-magang.magang_aktif', ['pembimbing' => 'dengan', 'status' => request('status'), 'search' => request('search')]) }}">
                                Dengan Dosen Pembimbing
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="{{ route('admin.kelola-magang.magang_aktif', ['pembimbing' => 'tanpa', 'status' => request('status'), 'search' => request('search')]) }}">
                                Tanpa Dosen Pembimbing
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Input -->
            <form method="GET" action="{{ route('admin.kelola-magang.magang_aktif') }}" id="searchForm">
                <input type="hidden" name="status" value="{{ request('status') }}">
                <input type="hidden" name="pembimbing" value="{{ request('pembimbing') }}">
                <x-search-input placeholder="Cari data magang..." name="search" value="{{ request('search') }}"
                    id="searchInput" />
            </form>
        </div>

        <!-- Table Section -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <!-- Table Header -->
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="w-12 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        ID</th>
                                    <th scope="col"
                                        class="w-32 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Nama Mahasiswa</th>
                                    <th scope="col"
                                        class="w-40 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Judul Lowongan</th>
                                    <th scope="col"
                                        class="w-36 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Nama Perusahaan</th>
                                    <th scope="col"
                                        class="w-24 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Status</th>
                                    <th scope="col"
                                        class="w-36 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Dosen Pembimbing</th>
                                    <th scope="col"
                                        class="w-24 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400 whitespace-nowrap">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <!-- Table Body -->
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse ($aktiveMagang as $item)
                                    <tr>
                                        <td class="px-3 py-3 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $item->id_magang }}
                                        </td>
                                        <td class="px-3 py-3 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            <div class="truncate max-w-32">{{ $item->mahasiswa->user->name }}</div>
                                        </td>
                                        <td class="px-3 py-3 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            <div class="truncate max-w-40">{{ $item->lowongan->judul_lowongan }}</div>
                                        </td>
                                        <td class="px-3 py-3 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            <div class="truncate max-w-36">
                                                {{ $item->lowongan->perusahaanMitra->nama_perusahaan_mitra }}</div>
                                        </td>
                                        <td class="px-3 py-3 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            <span
                                                class="inline-flex items-center gap-x-1 py-1 px-2 rounded-md text-xs font-medium border {{ $item->status_magang === 'magang' ? 'border-blue-600 text-blue-600' : 'border-teal-500 text-teal-500' }}">
                                                {{ ucfirst($item->status_magang) }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-3 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            <div class="truncate max-w-36">
                                                {{ $item->dosenPembimbing ? $item->dosenPembimbing->user->name : 'Belum Ditambahkan' }}
                                            </div>
                                        </td>
                                        <td class="px-3 py-3 text-sm font-medium">
                                            <div class="flex justify-start gap-1">
                                                <a href="{{ route('admin.kelola-magang.detail', $item->id_magang) }}"
                                                    class="flex shrink-0 justify-center items-center size-9 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <button type="button" onclick="openEditModal({{ $item->id_magang }})"
                                                    class="flex shrink-0 justify-center items-center size-9 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500"
                                                    data-hs-overlay="#edit-modal">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </button>
                                                <button type="button"
                                                    onclick="confirmDeleteMagang({{ $item->id_magang }}, '{{ $item->mahasiswa->user->name }}')"
                                                    class="flex shrink-0 justify-center items-center size-9 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Tidak ada data magang aktif yang tersedia.
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
        @if ($aktiveMagang->hasPages())
            <div class="flex items-center justify-end mt-4">
                {{ $aktiveMagang->links('custom.pagination') }}
            </div>
        @endif
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
                        <h4 id="successModal-action-title" class="text-lg font-semibold text-gray-900 mb-2">Data Berhasil
                            Dihapus</h4>
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
                                <label for="edit-status-magang" class="block text-sm font-medium text-gray-700 mb-1">Status
                                    Magang</label>
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

@endsection

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

        // Global variables for modal handling
        let deleteMagangId = null;
        let currentEditId = null;

        // Define global functions
        window.confirmDeleteMagang = function (id, name) {
            deleteMagangId = id;
            document.getElementById('deleteMagangName').textContent = name;
            console.log('confirmDeleteMagang called for id:', id);
            try {
                HSOverlay.open(document.querySelector('#deleteModal'));
                console.log('Called HSOverlay.open("#deleteModal")');
            } catch (error) {
                console.error('Error opening delete modal:', error);
                document.getElementById('deleteModal').classList.remove('hidden');
                document.body.classList.add('hs-overlay-body-scrolling');
            }
        };

        window.openEditModal = function (magangId) {
            currentEditId = magangId;
            console.log('openEditModal called for id:', magangId);

            fetch(`{{ url('admin/kelola-magang') }}/${magangId}/edit`, {
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

            const successModalActionTitle = document.getElementById('successModal-action-title');
            if (successModalActionTitle) {
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
            closeSuccessBtn.addEventListener('click', function () {
                console.log('Success modal "Selesai" button clicked.');
                closeSuccessModal();
                window.location.reload();
            });
        }

        const closeSuccessModalBtnElement = document.getElementById('closeSuccessModalBtn');
        if (closeSuccessModalBtnElement) {
            closeSuccessModalBtnElement.addEventListener('click', function () {
                console.log('Success modal "X" button clicked.');
                closeSuccessModal();
                window.location.reload();
            });
        }

        // Delete confirmation button
        const confirmDeleteBtn = document.getElementById('confirmDelete');
        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', function () {
                if (!deleteMagangId) return;
                console.log('Confirm delete button clicked for id:', deleteMagangId);

                this.disabled = true;
                document.getElementById('deleteButtonText').textContent = 'Menghapus...';
                document.getElementById('deleteSpinner').classList.remove('hidden');

                fetch(`{{ url('admin/kelola-magang') }}/${deleteMagangId}`, {
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
                        showSuccessModal(data.message || 'Data berhasil dihapus.', 'Data Berhasil Dihapus');
                    })
                    .catch(error => {
                        console.error('Error during delete operation:', error);
                        alert('Gagal menghapus data: ' + error.message);
                        closeDeleteModal();
                    })
                    .finally(() => {
                        this.disabled = false;
                        document.getElementById('deleteButtonText').textContent = 'Hapus';
                        document.getElementById('deleteSpinner').classList.add('hidden');
                    });
            });
        }

        // Edit form submission
        const editForm = document.getElementById('editMagangForm');
        if (editForm) {
            editForm.addEventListener('submit', function (e) {
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
                                if (modalElement) modalElement.classList.add('hidden');
                                document.body.classList.remove('hs-overlay-body-scrolling');
                                const backdrop = document.querySelector('.hs-overlay-backdrop[data-hs-overlay-backdrop-template]');
                                if (backdrop) backdrop.remove();
                            }
                            console.log('Showing success modal with message:', data.message || 'Data berhasil diperbarui.');
                            showSuccessModal(data.message || 'Data berhasil diperbarui.', 'Data Berhasil Diperbarui');
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
            showSuccessModal('{{ session('message') }}', 'Berhasil!');
        @endif
    });
</script>