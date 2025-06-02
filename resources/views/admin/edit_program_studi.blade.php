@extends('layout.template')

@section('content')
    <div class="p-6 space-y-6 bg-white rounded-lg">
        <h1 class="text-xl font-medium text-neutral-900">Edit Program Studi</h1>
        <form id="prodiForm" action="{{ route('admin.program_studi.update', $programStudi->id_program_studi) }}" method="POST"
            class="space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-6">
                <div class="w-full">
                    <label for="kode_prodi" class="block text-sm font-medium mb-2">Kode Program Studi</label>
                    <input type="text" id="kode_prodi" name="kode_prodi"
                        value="{{ old('kode_prodi', $programStudi->kode_prodi) }}"
                        class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500"
                        required maxlength="50">
                    @error('kode_prodi')
                        <span class="text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full">
                    <label for="nama_prodi" class="block text-sm font-medium mb-2">Nama Program Studi</label>
                    <input type="text" id="nama_prodi" name="nama_prodi"
                        value="{{ old('nama_prodi', $programStudi->nama_prodi) }}"
                        class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500"
                        required maxlength="255">
                    @error('nama_prodi')
                        <span class="text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end w-full">
                <button type="button" id="submitBtn" class="btn-primary">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-auto">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800">
                        Konfirmasi Perubahan Program Studi
                    </h3>
                    <button type="button" id="closeConfirmModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-pencil class="w-8 h-8 text-blue-600" />
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Konfirmasi Perubahan Data</h4>
                        <div class="text-left space-y-2 bg-gray-50 p-4 rounded-lg">
                            <div>
                                <span class="text-sm font-medium text-gray-600">Kode Program Studi:</span>
                                <span id="confirmKode" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Nama Program Studi:</span>
                                <span id="confirmNama" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-gray-600">
                            Apakah Anda yakin ingin menyimpan perubahan ini?
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                    <button type="button" id="cancelConfirm"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50">
                        Batal
                    </button>
                    <button type="button" id="confirmSubmit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700">
                        <span id="confirmButtonText">Ya, Simpan</span>
                        <div id="confirmSpinner"
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
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-auto">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800">Berhasil!</h3>
                    <button type="button" id="closeSuccessModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-check class="w-8 h-8 text-green-600" />
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Program Studi Berhasil Diperbarui</h4>
                        <p class="text-sm text-gray-600 mb-4">
                            Program Studi <span id="successProdiName" class="font-semibold text-gray-900"></span> telah
                            berhasil diperbarui.
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                    <button type="button" id="backToListBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50">
                        <x-lucide-list class="w-4 h-4" />
                        Kembali ke Daftar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let confirmModal = null;
        let successModal = null;

        function validateForm() {
            const requiredFields = [{
                    id: 'kode_prodi',
                    name: 'Kode Program Studi'
                },
                {
                    id: 'nama_prodi',
                    name: 'Nama Program Studi'
                }
            ];

            for (const field of requiredFields) {
                const element = document.getElementById(field.id);
                if (!element.value.trim()) {
                    alert(`${field.name} harus diisi!`);
                    element.focus();
                    return false;
                }
            }

            return true;
        }

        function showConfirmModal() {
            document.getElementById('confirmKode').textContent = document.getElementById('kode_prodi').value;
            document.getElementById('confirmNama').textContent = document.getElementById('nama_prodi').value;

            confirmModal = new HSOverlay(document.getElementById('confirmModal'));
            confirmModal.open();
        }

        function closeConfirmModal() {
            if (confirmModal) {
                confirmModal.close();
                confirmModal = null;
            }
        }

        function showSuccessModal(prodiName) {
            document.getElementById('successProdiName').textContent = prodiName;
            successModal = new HSOverlay(document.getElementById('successModal'));
            successModal.open();
        }

        function closeSuccessModal() {
            if (successModal) {
                successModal.close();
                successModal = null;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showSuccessModal('{{ session('prodi_name', '') }}');
            @endif

            document.getElementById('submitBtn').addEventListener('click', function(e) {
                e.preventDefault();
                if (validateForm()) {
                    showConfirmModal();
                }
            });

            document.getElementById('closeConfirmModalBtn').addEventListener('click', closeConfirmModal);
            document.getElementById('cancelConfirm').addEventListener('click', closeConfirmModal);

            document.getElementById('confirmSubmit').addEventListener('click', function() {
                const confirmBtn = this;
                const confirmText = document.getElementById('confirmButtonText');
                const confirmSpinner = document.getElementById('confirmSpinner');

                confirmBtn.disabled = true;
                confirmText.textContent = 'Menyimpan...';
                confirmSpinner.classList.remove('hidden');

                const formData = new FormData(document.getElementById('prodiForm'));

                fetch('{{ route('admin.program_studi.update', $programStudi->id_program_studi) }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            closeConfirmModal();
                            showSuccessModal(data.prodi_name);
                        } else {
                            alert(data.message || 'Terjadi kesalahan saat menyimpan perubahan');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menyimpan perubahan');
                    })
                    .finally(() => {
                        confirmBtn.disabled = false;
                        confirmText.textContent = 'Ya, Simpan';
                        confirmSpinner.classList.add('hidden');
                    });
            });

            document.getElementById('closeSuccessModalBtn').addEventListener('click', function() {
                closeSuccessModal();
                window.location.href = '{{ route('admin.program_studi') }}';
            });

            document.getElementById('backToListBtn').addEventListener('click', function() {
                window.location.href = '{{ route('admin.program_studi') }}';
            });

            document.getElementById('confirmModal').addEventListener('click', function(e) {
                const modalContent = this.querySelector('.bg-white');
                if (!modalContent.contains(e.target)) {
                    closeConfirmModal();
                }
            });

            document.getElementById('successModal').addEventListener('click', function(e) {
                const modalContent = this.querySelector('.bg-white');
                if (!modalContent.contains(e.target)) {
                    closeSuccessModal();
                    window.location.href = '{{ route('admin.program_studi') }}';
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (confirmModal) {
                        closeConfirmModal();
                    } else if (successModal) {
                        closeSuccessModal();
                        window.location.href = '{{ route('admin.program_studi') }}';
                    }
                }
            });
        });
    </script>
@endsection
