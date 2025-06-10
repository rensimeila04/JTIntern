@extends('layout.template')

@section('content')
    <div class="w-full p-4 bg-white rounded-xl flex-col space-y-4">
        <!-- Header dan tombol aksi -->
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-medium">Permohonan Magang</div>
            <div class="flex gap-2">
                <a href="{{ route('admin.kelola-magang.export-permohonan-magang') }}" class="btn-primary bg-blue-500 hover:bg-blue-600" target="_blank">
                    <i class="ph ph-export text-lg"></i> Export Data
                </a>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="flex justify-end items-center w-full gap-4">
            <!-- Search -->
            <div class="w-1/3">
                <form action="{{ route('admin.kelola-magang.permohonan_magang') }}" method="GET">
                    <input type="hidden" name="lowongan_id" value="{{ $currentLowongan }}">
                    <x-search-input placeholder="Cari data magang..." name="search" value="{{ $currentSearch }}" />
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col" class="w-4 px-6 py-6 text-start text-xs font-medium text-gray-500">ID</th>
                                    <th scope="col" class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">Nama Mahasiswa</th>
                                    <th scope="col" class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">Judul Lowongan</th>
                                    <th scope="col" class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">Nama Perusahaan</th>
                                    <th scope="col" class="w-4 px-5 py-3 text-start text-xs font-medium text-gray-500">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse($permohonan as $item)
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
                                        <td class="px-5 py-4 whitespace-nowrap text-sm font-medium text-end">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.kelola-magang.detail', $item->id_magang) }}"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <button type="button"
                                                    onclick="confirmDeleteMagang('{{ $item->id_magang }}', '{{ $item->mahasiswa->user->name }}')"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Tidak ada data permohonan magang
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
        <div class="flex items-center justify-end mt-8">
            {{ $permohonan->links() }}
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="deleteModal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
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
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Hapus Permohonan Magang</h4>
                        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Apakah Anda yakin ingin menghapus permohonan magang mahasiswa <span id="deleteMagangName"
                                class="font-semibold"></span>?
                        </p>
                        <p class="mt-1 text-xs text-red-600">
                            Tindakan ini tidak dapat dibatalkan!
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
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
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
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
                        <h4 id="successModal-action-title" class="text-lg font-semibold text-gray-900 mb-2">Permohonan Berhasil Dihapus</h4>
                        <p id="successMessage" class="text-sm text-gray-600 mb-4">
                            Permohonan magang telah berhasil dihapus.
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
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
        document.addEventListener('DOMContentLoaded', function() {
            let deleteMagangId = null;

            window.confirmDeleteMagang = function(id, name) {
                deleteMagangId = id;
                document.getElementById('deleteMagangName').textContent = name;
                try {
                    HSOverlay.open(document.querySelector('#deleteModal'));
                } catch (error) {
                    document.getElementById('deleteModal').classList.remove('hidden');
                    document.body.classList.add('hs-overlay-body-scrolling');
                }
            };

            function closeDeleteModal() {
                try {
                    HSOverlay.close(document.querySelector('#deleteModal'));
                } catch (error) {
                    document.getElementById('deleteModal').classList.add('hidden');
                    document.body.classList.remove('hs-overlay-body-scrolling');
                    const backdrop = document.querySelector('.hs-overlay-backdrop[data-hs-overlay-backdrop-template]');
                    if (backdrop) backdrop.remove();
                }
                deleteMagangId = null;
            }

            function showSuccessModal(message, title = 'Berhasil!') {
                document.getElementById('successModal-label').textContent = title;
                document.getElementById('successModal-action-title').textContent = title;
                document.getElementById('successMessage').textContent = message;
                try {
                    HSOverlay.open(document.querySelector('#successModal'));
                } catch (error) {
                    document.getElementById('successModal').classList.remove('hidden');
                    document.body.classList.add('hs-overlay-body-scrolling');
                }
            }

            function closeSuccessModal() {
                try {
                    HSOverlay.close(document.querySelector('#successModal'));
                } catch (error) {
                    document.getElementById('successModal').classList.add('hidden');
                    document.body.classList.remove('hs-overlay-body-scrolling');
                    const backdrop = document.querySelector('.hs-overlay-backdrop[data-hs-overlay-backdrop-template]');
                    if (backdrop) backdrop.remove();
                }
            }

            // Event listeners
            document.getElementById('cancelDelete').onclick = closeDeleteModal;
            document.getElementById('closeDeleteModalBtn').onclick = closeDeleteModal;
            document.getElementById('closeSuccessBtn').onclick = function() {
                closeSuccessModal();
                window.location.reload();
            };
            document.getElementById('closeSuccessModalBtn').onclick = function() {
                closeSuccessModal();
                window.location.reload();
            };

            document.getElementById('confirmDelete').onclick = function() {
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
                    showSuccessModal(data.message || 'Permohonan berhasil dihapus.', 'Permohonan Berhasil Dihapus');
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
            };
        });
    </script>
@endsection
