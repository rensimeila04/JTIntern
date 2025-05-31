@extends('layout.template')
@section('content')
    <div class="w-full p-4 bg-white rounded-xl flex-col space-y-4">
        <!-- Header dan tombol aksi -->
        <div class="flex justify-between w-full items-center">
            <div class="text-neutral-900 text-xl font-medium">Periode Magang</div>
            <div class="flex gap-2">
                <a href="{{ route('admin.periode_magang.create') }}" class="btn-primary">
                    <x-lucide-plus class="size-4" /> Tambah Periode Magang
                </a>
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
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        No</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Nama Periode</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Tanggal Mulai</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Tanggal Selesai</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse ($periodeMagang as $item)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $item->id_periode_magang }}</td>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->nama_periode }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            @php
                                                $date = \Carbon\Carbon::parse($item->tanggal_mulai);
                                                $monthNames = [
                                                    'Januari',
                                                    'Februari',
                                                    'Maret',
                                                    'April',
                                                    'Mei',
                                                    'Juni',
                                                    'Juli',
                                                    'Agustus',
                                                    'September',
                                                    'Oktober',
                                                    'November',
                                                    'Desember'
                                                ];
                                                echo $date->format('d') . ' ' . $monthNames[$date->format('n') - 1] . ' ' . $date->format('Y');
                                            @endphp
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            @php
                                                $date = \Carbon\Carbon::parse($item->tanggal_selesai);
                                                echo $date->format('d') . ' ' . $monthNames[$date->format('n') - 1] . ' ' . $date->format('Y');
                                            @endphp
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.periode_magang.detail', $item->id_periode_magang) }}"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="{{ route('admin.periode_magang.edit', $item->id_periode_magang) }}"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </a>
                                                <button type="button"
                                                    onclick="confirmDelete('{{ $item->id_periode_magang }}', '{{ $item->nama_periode }}')"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <x-lucide-calendar-x class="w-12 h-12 text-gray-300 mb-4" />
                                                <p>Tidak ada periode magang yang ditemukan</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                    <button type="button" id="closeModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-calendar-x class="w-8 h-8 text-red-600" />
                        </div>
                        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Apakah Anda yakin ingin menghapus periode <span id="periodName" class="font-semibold"></span>?
                        </p>
                        <p class="mt-1 text-xs text-red-600">
                            Tindakan ini tidak dapat dibatalkan!
                        </p>
                        <div id="lowonganWarning"
                            class="hidden mt-3 p-3 bg-amber-50 border border-amber-200 rounded-lg text-sm text-amber-800">
                            <div class="flex items-center">
                                <x-lucide-alert-triangle class="w-4 h-4 text-amber-600 mr-2 flex-shrink-0" />
                                <p>Menghapus periode ini akan menghapus semua lowongan yang terkait.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="cancelDelete"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800">
                        Batal
                    </button>
                    <button type="button" id="confirmDeleteBtn"
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
                        Berhasil
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
                        <p id="successMessage" class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Data periode magang berhasil dihapus!
                        </p>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="okSuccessBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize variables at script scope
        let deleteModalElement = null;
        let successModalElement = null;
        let deletePeriodeId = null;
        let currentModal = null;
        let successModal = null;

        document.addEventListener('DOMContentLoaded', function () {
            // Store references to DOM elements
            deleteModalElement = document.getElementById('deleteModal');
            successModalElement = document.getElementById('successModal');

            // Check for success message from session
            @if(session('success'))
                showSuccessModal('{{ session('message') }}');
            @endif
            });

        function confirmDelete(id, name) {
            deletePeriodeId = id;
            document.getElementById('periodName').textContent = name;

            // Show modal immediately - just like in perusahaan.blade.php
            currentModal = new HSOverlay(deleteModalElement);
            currentModal.open();

            // Hide warning by default
            document.getElementById('lowonganWarning').classList.add('hidden');

            // Then fetch the related data after modal is already visible
            fetch(`{{ route('admin.periode_magang') }}/check/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.hasLowongan) {
                        document.getElementById('lowonganWarning').classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function closeModal() {
            if (currentModal) {
                currentModal.close();
                currentModal = null;
            }
            deletePeriodeId = null;
        }

        function showSuccessModal(message) {
            document.getElementById('successMessage').textContent = message || 'Data periode magang berhasil dihapus!';
            successModal = new HSOverlay(successModalElement);
            successModal.open();
        }

        function closeSuccessModal() {
            if (successModal) {
                successModal.close();
                successModal = null;
            }
        }

        // Event listeners for delete modal - no changes needed
        document.getElementById('closeModalBtn').addEventListener('click', closeModal);
        document.getElementById('cancelDelete').addEventListener('click', closeModal);

        // Event listeners for success modal - no changes needed
        document.getElementById('closeSuccessModalBtn').addEventListener('click', function () {
            closeSuccessModal();
            window.location.reload();
        });
        document.getElementById('okSuccessBtn').addEventListener('click', function () {
            closeSuccessModal();
            window.location.reload();
        });

        // Event listener for clicking outside modal - no changes needed
        document.getElementById('deleteModal').addEventListener('click', function (e) {
            const modalContent = this.querySelector('.bg-white');
            if (!modalContent.contains(e.target)) {
                closeModal();
            }
        });

        // Event listener for success modal click outside - no changes needed
        document.getElementById('successModal').addEventListener('click', function (e) {
            const modalContent = this.querySelector('.bg-white');
            if (!modalContent.contains(e.target)) {
                closeSuccessModal();
                window.location.reload();
            }
        });

        // Event listener for Escape key - no changes needed
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                if (currentModal) {
                    closeModal();
                } else if (successModal) {
                    closeSuccessModal();
                    window.location.reload();
                }
            }
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (!deletePeriodeId) return;

            const deleteBtn = this;
            const deleteText = document.getElementById('deleteButtonText');
            const deleteSpinner = document.getElementById('deleteSpinner');

            // Show loading state
            deleteBtn.disabled = true;
            deleteText.textContent = 'Menghapus...';
            deleteSpinner.classList.remove('hidden');

            fetch(`{{ route('admin.periode_magang') }}/${deletePeriodeId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Close delete modal first
                        closeModal();
                        // Show success modal
                        showSuccessModal(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus periode magang');
                })
                .finally(() => {
                    // Reset button state
                    deleteBtn.disabled = false;
                    deleteText.textContent = 'Hapus';
                    deleteSpinner.classList.add('hidden');
                });
        });
    </script>
@endsection