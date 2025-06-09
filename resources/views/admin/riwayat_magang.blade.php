@extends('layout.template')

@section('content')
    <div class="w-full p-4 bg-white rounded-xl flex-col space-y-4">
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-medium">Riwayat Magang</div>
            <div class="flex gap-2">
                <a href="#" class="btn-primary bg-blue-500 hover:bg-blue-600">
                    <i class="ph ph-export text-lg"></i> Export Data
                </a>
            </div>
        </div>
        <form method="GET" action="{{ route('admin.kelola-magang.riwayat_magang') }}" id="searchForm"
            class="flex justify-end items-center gap-2">
            <input type="hidden" name="lowongan_id" value="{{ $currentLowongan }}">
            <x-search-input placeholder="Cari data magang..." name="search" value="{{ $currentSearch }}" id="searchInput" />
        </form>
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="w-fit px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="w-1/6 px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Nama Mahasiswa
                                    </th>
                                    <th scope="col"
                                        class="w-1/5 px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Judul Lowongan
                                    </th>
                                    <th scope="col"
                                        class="w-1/6 px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Nama Perusahaan
                                    </th>
                                    <th scope="col"
                                        class="w-1/6 px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Dosen Pembimbing
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Sertifikat
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400 whitespace-nowrap">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse ($riwayatMagang as $item)
                                    <tr>
                                        <td
                                            class="px-3 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $item->id_magang }}
                                        </td>
                                        <td
                                            class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                            {{ $item->mahasiswa->user->name }}
                                        </td>
                                        <td
                                            class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-36 truncate">
                                            {{ $item->lowongan->judul_lowongan }}
                                        </td>
                                        <td
                                            class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                            {{ $item->lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                                        </td>
                                        <td
                                            class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                            {{ $item->dosenPembimbing ? $item->dosenPembimbing->user->name : 'Belum ditambahkan' }}
                                        </td>
                                        <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                            <div class="flex justify-start gap-2">
                                                @if ($item->path_sertifikat)
                                                    <a href="{{ route('admin.kelola-magang.lihat-sertifikat', $item->id_magang) }}" target="_blank"
                                                        class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none"
                                                        title="Lihat Sertifikat">
                                                        <x-lucide-eye class="w-4 h-4 text-primary-500" />
                                                    </a>
                                                    <a href="{{ route('admin.kelola-magang.download-sertifikat', $item->id_magang) }}"
                                                        class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-blue-500 hover:bg-gray-200 focus:outline-hidden border border-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                                        title="Download Sertifikat">
                                                        <x-lucide-download class="w-4 h-4 text-blue-500" />
                                                    </a>
                                                @else
                                                    <button disabled
                                                        class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-gray-100 text-gray-400 border border-gray-200 cursor-not-allowed"
                                                        title="Sertifikat belum tersedia">
                                                        <x-lucide-eye class="w-4 h-4" />
                                                    </button>
                                                    <button disabled
                                                        class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-gray-100 text-gray-400 border border-gray-200 cursor-not-allowed"
                                                        title="Sertifikat belum tersedia">
                                                        <x-lucide-download class="w-4 h-4" />
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                            <div class="flex justify-start gap-2">
                                                <a href="{{ route('admin.kelola-magang.detail', $item->id_magang) }}"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <button type="button"
                                                    onclick="openEditModal({{ $item->id_magang }})"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-yellow-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none"
                                                    data-hs-overlay="#edit-modal">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </button>
                                                <button type="button"
                                                    onclick="confirmDeleteMagang({{ $item->id_magang }}, '{{ $item->mahasiswa->user->name }}')"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-red-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
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
        @if ($riwayatMagang->hasPages())
            <div class="flex items-center justify-end mt-8">
                {{ $riwayatMagang->links('custom.pagination') }}
            </div>
        @endif
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

            window.confirmDeleteMagang = function(id, name) {
                deleteMagangId = id;
                document.getElementById('deleteMagangName').textContent = name;
                HSOverlay.open(document.querySelector('#deleteModal'));
            }

            function closeDeleteModal() {
                HSOverlay.close(document.querySelector('#deleteModal'));
                deleteMagangId = null;
            }

            function showSuccessModal(message, title = 'Berhasil!') { 
                document.getElementById('successModal-label').textContent = title;
                document.getElementById('successModal-action-title').textContent = title;
                if (message) {
                    document.getElementById('successMessage').textContent = message;
                }
                HSOverlay.open(document.querySelector('#successModal'));
            }

            function closeSuccessModal() {
                HSOverlay.close(document.querySelector('#successModal'));
            }

            // Set up event listeners for delete functionality
            document.getElementById('cancelDelete').addEventListener('click', closeDeleteModal);
            document.getElementById('closeDeleteModalBtn').addEventListener('click', closeDeleteModal);

            // Success modal buttons
            document.getElementById('closeSuccessBtn').addEventListener('click', function() {
                closeSuccessModal();
                window.location.reload();
            });
            document.getElementById('closeSuccessModalBtn').addEventListener('click', function() {
                closeSuccessModal();
                window.location.reload();
            });

            // Delete confirmation button
            document.getElementById('confirmDelete').addEventListener('click', function() {
                if (!deleteMagangId) return;
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
                        if (!response.ok) {
                            return response.json().then(errData => {
                                throw new Error(errData.message || `HTTP error! status: ${response.status}`);
                            }).catch(() => {
                                throw new Error(`HTTP error! status: ${response.status} and response was not valid JSON.`);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        closeDeleteModal();
                        showSuccessModal(data.message || 'Data berhasil dihapus.', 'Data Berhasil Dihapus');
                    })
                    .catch(error => {
                        alert('Gagal menghapus data: ' + error.message);
                        closeDeleteModal();
                    })
                    .finally(() => {
                        this.disabled = false;
                        document.getElementById('deleteButtonText').textContent = 'Hapus';
                        document.getElementById('deleteSpinner').classList.add('hidden');
                    });
            });

            // Edit Modal functionality
            let currentEditId = null;

            window.openEditModal = function(magangId) {
                currentEditId = magangId;
                fetch(`{{ url('admin/kelola-magang') }}/${magangId}/edit`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(errData => {
                                throw new Error(errData.message || `HTTP error! status: ${response.status}`);
                            }).catch(() => {
                                throw new Error(`HTTP error! status: ${response.status} and response was not valid JSON.`);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const magang = data.magang;
                            document.getElementById('edit-mahasiswa-name').value = magang.mahasiswa.user.name;
                            document.getElementById('edit-lowongan-title').value = magang.lowongan.judul_lowongan;
                            document.getElementById('edit-status-magang').value = magang.status_magang;
                            document.getElementById('edit-dosen-pembimbing').value = magang.id_dosen_pembimbing || '';
                        } else {
                            alert('Gagal memuat data magang: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        alert('Gagal memuat data magang: ' + error.message);
                    });
            };

            document.getElementById('editMagangForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const saveEditBtn = document.getElementById('saveEditBtn');
                const saveEditText = document.getElementById('saveEditText');
                const saveEditSpinner = document.getElementById('saveEditSpinner');

                saveEditBtn.disabled = true;
                saveEditText.classList.add('hidden');
                saveEditSpinner.classList.remove('hidden');

                const formData = new FormData(this);
                const actionUrl = `{{ url('admin/kelola-magang') }}/${currentEditId}`;

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
                    if (!response.ok) {
                        return response.json().then(errData => {
                            throw new Error(errData.message || `HTTP error! status: ${response.status}`);
                        }).catch(() => {
                            throw new Error(`HTTP error! status: ${response.status} and response was not valid JSON.`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        HSOverlay.close(document.querySelector('#edit-modal'));
                        showSuccessModal(data.message || 'Data berhasil diperbarui.', 'Data Berhasil Diperbarui');
                    } else {
                        let errorMessage = data.message || 'Gagal memperbarui data.';
                        if (data.errors) {
                            const errorMessages = Object.values(data.errors).flat();
                            errorMessage += '\n- ' + errorMessages.join('\n- ');
                        }
                        alert(errorMessage);
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan saat menyimpan data: ' + error.message);
                })
                .finally(() => {
                    saveEditBtn.disabled = false;
                    saveEditText.classList.remove('hidden');
                    saveEditSpinner.classList.add('hidden');
                });
            });

            // Show success modal if session has message
            @if (session('success') && session('message'))
                showSuccessModal('{{ session('message') }}', 'Berhasil!');
            @endif
        });
    </script>

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
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-700">
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

    <!-- ...tambahkan script JS seperti di kelola_magang/pengajuan_ditolak... -->
@endsection