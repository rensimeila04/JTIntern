@extends('layout.template')

@section('content')
    <div class="w-full p-4 bg-white rounded-xl flex-col space-y-4 ">
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-semibold">Program Studi</div>
            <div class="flex gap-2">
                <a href="{{ route('admin.program_studi.create') }}" class="btn-primary">
                    <i class="ph ph-plus"></i> Tambah Program Studi
                </a>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="w-10 px-6 py-3 text-center text-xs font-medium text-gray-500">
                                        ID</th>
                                    <th scope="col" class="w-24 px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Kode</th>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Program Studi</th>
                                    <th scope="col" class="w-48 px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($programStudi as $item)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-black">
                                            {{ $item->id_program_studi }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-200 bg-white text-gray-500 shadow-2xs">
                                                {{ $item->kode_prodi }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
                                            {{ $item->nama_prodi }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.program_studi.detail', $item->id_program_studi) }}"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 border border-primary-500">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="{{ route('admin.program_studi.edit', $item->id_program_studi) }}"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 border border-yellow-500">
                                                    <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                                                </a>
                                                <button type="button"
                                                    onclick="confirmDelete('{{ $item->id_program_studi }}', '{{ $item->nama_prodi }}')"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-s m font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 border border-red-500">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <x-lucide-calendar-x class="w-12 h-12 text-gray-300 mb-4" />
                                                <p>Tidak ada program studi yang ditemukan</p>
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
@endsection

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal"
    class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
    role="dialog" tabindex="-1" aria-labelledby="deleteModal-label">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
        <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto">
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                <h3 id="deleteModal-label" class="font-bold text-gray-800">
                    Konfirmasi Hapus
                </h3>
                <button type="button" id="closeModalBtn"
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200"
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
                    <p class="mt-2 text-sm text-gray-600">
                        Apakah Anda yakin ingin menghapus program studi <span id="prodiName"
                            class="font-semibold"></span>?
                    </p>
                    <p class="mt-1 text-xs text-red-600">
                        Tindakan ini tidak dapat dibatalkan!
                    </p>
                </div>
            </div>
            <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                <button type="button" id="cancelDelete"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700">
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

<!-- Modal Sukses -->
<div id="successModal"
    class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
    role="dialog" tabindex="-1" aria-labelledby="successModal-label">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
        <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto">
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                <h3 id="successModal-label" class="font-bold text-gray-800">
                    Berhasil
                </h3>
                <button type="button" id="closeSuccessModalBtn"
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200"
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
                    <p id="successMessage" class="mt-2 text-sm text-gray-600">
                        Data program studi berhasil dihapus!
                    </p>
                </div>
            </div>
            <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                <button type="button" id="okSuccessBtn"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteModalElement = null;
    let successModalElement = null;
    let deleteProdiId = null;
    let currentModal = null;
    let successModal = null;

    document.addEventListener('DOMContentLoaded', function() {
        deleteModalElement = document.getElementById('deleteModal');
        successModalElement = document.getElementById('successModal');
    });

    function confirmDelete(id, name) {
        deleteProdiId = id;
        document.getElementById('prodiName').textContent = name;
        currentModal = new HSOverlay(deleteModalElement);
        currentModal.open();
    }

    function closeModal() {
        if (currentModal) {
            currentModal.close();
            currentModal = null;
        }
        deleteProdiId = null;
    }

    function showSuccessModal(message) {
        document.getElementById('successMessage').textContent = message || 'Data program studi berhasil dihapus!';
        successModal = new HSOverlay(successModalElement);
        successModal.open();
    }

    function closeSuccessModal() {
        if (successModal) {
            successModal.close();
            successModal = null;
        }
    }

    document.getElementById('closeModalBtn').addEventListener('click', closeModal);
    document.getElementById('cancelDelete').addEventListener('click', closeModal);

    document.getElementById('closeSuccessModalBtn').addEventListener('click', function() {
        closeSuccessModal();
        window.location.reload();
    });
    document.getElementById('okSuccessBtn').addEventListener('click', function() {
        closeSuccessModal();
        window.location.reload();
    });

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        const modalContent = this.querySelector('.bg-white');
        if (!modalContent.contains(e.target)) {
            closeModal();
        }
    });

    document.getElementById('successModal').addEventListener('click', function(e) {
        const modalContent = this.querySelector('.bg-white');
        if (!modalContent.contains(e.target)) {
            closeSuccessModal();
            window.location.reload();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (currentModal) {
                closeModal();
            } else if (successModal) {
                closeSuccessModal();
                window.location.reload();
            }
        }
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!deleteProdiId) return;

        const deleteBtn = this;
        const deleteText = document.getElementById('deleteButtonText');
        const deleteSpinner = document.getElementById('deleteSpinner');

        deleteBtn.disabled = true;
        deleteText.textContent = 'Menghapus...';
        deleteSpinner.classList.remove('hidden');

        fetch(`{{ route('admin.program_studi') }}/${deleteProdiId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeModal();
                    showSuccessModal(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus program studi');
            })
            .finally(() => {
                deleteBtn.disabled = false;
                deleteText.textContent = 'Hapus';
                deleteSpinner.classList.add('hidden');
            });
    });
</script>
