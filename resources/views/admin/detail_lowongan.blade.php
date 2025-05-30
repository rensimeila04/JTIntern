@extends('layout.template')
@section('content')
    <div class="space-y-4">
        <div class="flex flex-row items-center justify-between">
            <div>
                <h2 class="text-xl font-medium">Detail Lowongan</h2>
            </div>
            <div class="flex gap-2">
                <button
                    onclick="confirmDeleteLowongan({{ $lowongan->id_lowongan }}, '{{ $lowongan->judul_lowongan }}', '{{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}')"
                    class="btn-outline text-red-500 border-red-500 hover:bg-red-500 hover:text-white">
                    <x-lucide-trash-2 stroke-width="1.5" class="size-3.5" />
                    Hapus Lowongan
                </button>
                <a href="{{ route('admin.lowongan.edit', $lowongan->id_lowongan) }}"
                    class="btn-outline text-primary-500 border-primary-500 hover:bg-primary-500 hover:text-white">
                    <x-lucide-pencil-line stroke-width="1.5" class="size-3.5" />
                    Edit Lowongan
                </a>
            </div>
        </div>

        <!-- Company and Job Info -->
        <div class="flex justify-start items-center w-full bg-white p-4 rounded-md">
            <div class="flex">
                <img src="{{ $lowongan->perusahaanMitra->logo ? Storage::url($lowongan->perusahaanMitra->logo) : asset('Images/placeholder_perusahaan.png') }}"
                    alt="{{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}"
                    class="w-30 h-30 rounded-2xl object-contain">
                <div class="flex flex-col pl-6 gap-y-6">
                    <div class="space-y-2">
                        <div class="flex gap-4 items-center">
                            <p class="font-semibold">{{ $lowongan->judul_lowongan }}</p>
                            <span
                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border {{ $lowongan->status_pendaftaran ? 'border-teal-500 bg-white text-teal-500' : 'border-red-500 bg-white text-red-500' }}">
                                {{ $lowongan->status_pendaftaran ? 'Aktif Merekrut' : 'Tidak Aktif' }}
                            </span>
                        </div>
                        <a href="{{ route('admin.perusahaan.detail', $lowongan->perusahaanMitra->id_perusahaan_mitra) }}"
                            class="text-primary-500 text-base font-normal hover:text-primary-700 hover:underline transition-colors duration-200 w-fit block">
                            {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                        </a>
                    </div>
                    <div class="flex flex-row gap-10 items-start">
                        <div class="flex flex-col gap-2">
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-map-pin class="text-neutral-500 size-6" stroke-width="1.5" />
                                <p>{{ $lowongan->perusahaanMitra->alamat }}</p>
                            </span>
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-calendar-days class="text-neutral-500 size-6" stroke-width="1.5" />
                                <p>{{ $lowongan->periodeMagang->nama_periode }}</p>
                            </span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-briefcase class="text-neutral-500 size-6" stroke-width="1.5" />
                                <p>{{ ucfirst($lowongan->jenis_magang) }}</p>
                            </span>
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-laptop class="text-neutral-500 size-6" stroke-width="1.5" />
                                <p>{{ $lowongan->kompetensi->nama_kompetensi }}</p>
                            </span>
                        </div>
                        @if ($lowongan->deadline_pendaftaran)
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-clock class="text-neutral-500 size-6" stroke-width="1.5" />
                                <p>Deadline: {{ \Carbon\Carbon::parse($lowongan->deadline_pendaftaran)->format('d M Y') }}
                                </p>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Description -->
        <div class="w-full bg-white p-4 rounded-md space-y-2">
            <p class="font-medium text-xl">Deskripsi</p>
            <div id="short-description" class="text-neutral-400 text-sm font-normal line-clamp-3 whitespace-pre-line">
                {{ Str::limit($lowongan->deskripsi, 200) }}
            </div>
            <div id="full-description" class="text-neutral-400 text-sm hidden whitespace-pre-line">
                {!! nl2br(e($lowongan->deskripsi)) !!}
            </div>
            @if (strlen($lowongan->deskripsi) > 200)
                <button id="read-more-btn"
                    class="mt-2 text-primary-500 text-sm font-medium hover:text-primary-700 focus:outline-none flex items-center gap-1">
                    <span>Lebih banyak</span>
                    <i class="ph ph-caret-down"></i>
                </button>
            @endif
        </div>

        <!-- Job Requirements -->
        <div class="w-full bg-white p-4 rounded-md">
            <p class="font-medium text-xl">Persyaratan</p>
            <div class="mt-2 text-neutral-400 text-sm whitespace-pre-line">
                {!! nl2br(e($lowongan->persyaratan)) !!}
            </div>
        </div>

        <!-- Test Information -->
        @if ($lowongan->test && $lowongan->informasi_test)
            <div class="w-full bg-white p-4 rounded-md">
                <p class="font-medium text-xl">Informasi Test</p>
                <div class="mt-2 text-neutral-400 text-sm whitespace-pre-line">
                    {!! nl2br(e($lowongan->informasi_test)) !!}
                </div>
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
                        Konfirmasi Hapus Lowongan
                    </h3>
                    <button type="button" id="closeDeleteModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m18 6-12 12" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ph ph-trash text-red-600 text-2xl"></i>
                        </div>
                        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Apakah Anda yakin ingin menghapus lowongan <span id="deleteLowonganTitle"
                                class="font-semibold"></span>
                            dari <span id="deleteLowonganCompany" class="font-semibold"></span>?
                        </p>
                        <p class="mt-1 text-xs text-red-600">
                            Tindakan ini tidak dapat dibatalkan!
                        </p>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="cancelDeleteBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800">
                        Batal
                    </button>
                    <button type="button" id="confirmDeleteBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        <span id="deleteButtonText">Hapus</span>
                        <div id="deleteSpinner"
                            class="hidden animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full"
                            role="status" aria-label="loading"></div>
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
                        Berhasil Dihapus!
                    </h3>
                    <button type="button" id="closeSuccessModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m18 6-12 12" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ph ph-check-circle text-green-600 text-2xl"></i>
                        </div>
                        <p id="successMessage" class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Lowongan berhasil dihapus!
                        </p>
                        <p class="mt-1 text-xs text-gray-500">
                            Anda akan diarahkan ke halaman daftar lowongan.
                        </p>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="okSuccessBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        <i class="ph ph-arrow-left text-sm"></i>
                        Kembali ke Daftar Lowongan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let deleteLowonganId = null;
        let deleteModal = null;
        let successModal = null;

        // Delete lowongan functions
        function confirmDeleteLowongan(id, title, company) {
            deleteLowonganId = id;
            document.getElementById('deleteLowonganTitle').textContent = title;
            document.getElementById('deleteLowonganCompany').textContent = company;

            deleteModal = new HSOverlay(document.getElementById('deleteModal'));
            deleteModal.open();
        }

        function closeDeleteModal() {
            if (deleteModal) {
                deleteModal.close();
                deleteModal = null;
            }
            deleteLowonganId = null;
        }

        function showSuccessModal(message) {
            console.log('Showing success modal:', message);
            document.getElementById('successMessage').textContent = message;

            successModal = new HSOverlay(document.getElementById('successModal'));
            successModal.open();
        }

        function closeSuccessModal() {
            if (successModal) {
                successModal.close();
                successModal = null;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const readMoreBtn = document.getElementById('read-more-btn');

            if (readMoreBtn) {
                const shortDescription = document.getElementById('short-description');
                const fullDescription = document.getElementById('full-description');

                readMoreBtn.addEventListener('click', function () {
                    if (shortDescription.classList.contains('hidden')) {
                        // Show less
                        shortDescription.classList.remove('hidden');
                        fullDescription.classList.add('hidden');
                        readMoreBtn.innerHTML = '<span>Lebih banyak</span><i class="ph ph-caret-down"></i>';
                    } else {
                        // Show more
                        shortDescription.classList.add('hidden');
                        fullDescription.classList.remove('hidden');
                        readMoreBtn.innerHTML = '<span>Lebih sedikit</span><i class="ph ph-caret-up"></i>';
                    }
                });
            }

            // Delete modal event listeners
            document.getElementById('closeDeleteModalBtn').addEventListener('click', closeDeleteModal);
            document.getElementById('cancelDeleteBtn').addEventListener('click', closeDeleteModal);

            // Success modal event listeners
            document.getElementById('closeSuccessModalBtn').addEventListener('click', function () {
                closeSuccessModal();
                window.location.href = '{{ route("admin.lowongan") }}';
            });

            document.getElementById('okSuccessBtn').addEventListener('click', function () {
                closeSuccessModal();
                window.location.href = '{{ route("admin.lowongan") }}';
            });

            // Confirm delete
            document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
                if (!deleteLowonganId) return;

                const deleteBtn = this;
                const deleteText = document.getElementById('deleteButtonText');
                const deleteSpinner = document.getElementById('deleteSpinner');

                // Show loading state
                deleteBtn.disabled = true;
                deleteText.textContent = 'Menghapus...';
                deleteSpinner.classList.remove('hidden');

                // Buat FormData dengan method spoofing
                const formData = new FormData();
                formData.append('_method', 'DELETE');
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                fetch(`{{ route('admin.lowongan') }}/${deleteLowonganId}`, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            closeDeleteModal();
                            showSuccessModal(data.message);
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus lowongan');
                    })
                    .finally(() => {
                        // Reset button state
                        deleteBtn.disabled = false;
                        deleteText.textContent = 'Hapus';
                        deleteSpinner.classList.add('hidden');
                    });
            });

            // Close modal when clicking outside
            document.getElementById('deleteModal').addEventListener('click', function (e) {
                const modalContent = this.querySelector('.bg-white');
                if (!modalContent.contains(e.target)) {
                    closeDeleteModal();
                }
            });

            // Close success modal when clicking outside
            document.getElementById('successModal').addEventListener('click', function (e) {
                const modalContent = this.querySelector('.bg-white');
                if (!modalContent.contains(e.target)) {
                    closeSuccessModal();
                    window.location.href = '{{ route("admin.lowongan") }}';
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    if (deleteModal) {
                        closeDeleteModal();
                    } else if (successModal) {
                        closeSuccessModal();
                        window.location.href = '{{ route("admin.lowongan") }}';
                    }
                }
            });
        });
    </script>
@endsection