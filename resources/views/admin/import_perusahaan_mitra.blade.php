@extends('layout.template')

@section('content')
    <div class="p-6 space-y-6 bg-white rounded-lg">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-medium text-neutral-900">Import Perusahaan Mitra</h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.perusahaan') }}" class="btn-secondary">
                    <i class="ph ph-arrow-left text-lg"></i> Kembali
                </a>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <i class="ph ph-info text-xl text-blue-600 mt-0.5 mr-3 flex-shrink-0"></i>
                <div>
                    <h3 class="font-medium text-blue-800 mb-1">Panduan Import Perusahaan Mitra</h3>
                    <ul class="list-disc ml-5 text-sm text-blue-700 space-y-1">
                        <li>Unduh template Excel terlebih dahulu untuk format yang benar</li>
                        <li>Isi data perusahaan sesuai format yang telah disediakan</li>
                        <li>Kolom <strong>nama_perusahaan_mitra</strong>, <strong>email</strong>, <strong>telepon</strong>,
                            <strong>alamat</strong>, <strong>id_jenis_perusahaan</strong>, dan
                            <strong>bidang_industri</strong> wajib diisi
                        </li>
                        <li>Format email harus valid (contoh: nama@domain.com)</li>
                        <li>id_jenis_perusahaan harus diisi dengan ID yang tersedia di <strong>(1. BUMN 2. Startup 3.
                                Software House 4. Studio Desain)</strong></li>
                    </ul>
                </div>
            </div>
        </div>

        <div
            class="flex flex-col items-center justify-center py-8 px-4 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50">
            <i class="ph ph-file-excel text-4xl text-gray-400 mb-4"></i>
            <h3 class="mb-2 text-lg font-medium text-gray-900">Import Data Perusahaan Mitra</h3>
            <p class="mb-6 text-sm text-gray-600 text-center max-w-md">
                Unduh template Excel terlebih dahulu, isi data perusahaan, kemudian unggah file Excel yang telah diisi.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 w-full max-w-md justify-center">
                <a href="{{ route('admin.perusahaan.template') }}" class="btn-secondary flex items-center justify-center">
                    <i class="ph ph-download text-lg mr-2"></i>
                    Unduh Template Excel
                </a>

                <button id="uploadFileBtn" class="btn-primary flex items-center justify-center">
                    <i class="ph ph-upload text-lg mr-2"></i>
                    Unggah File Excel
                </button>
            </div>
        </div>

    </div>

    <!-- Upload File Modal -->
    <div id="uploadModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="uploadModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 id="uploadModal-label" class="font-bold text-gray-800">
                        Unggah File Excel
                    </h3>
                    <button type="button" id="closeUploadModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <i class="ph ph-x size-4"></i>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <form id="uploadForm" action="{{ route('admin.perusahaan.import.store') }}" method="POST"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="ph ph-file-excel text-2xl text-blue-600"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Unggah File</h4>
                            <p class="text-sm text-gray-600 mb-4">
                                Pilih file (.xlsx, .xls, atau .csv) yang berisi data perusahaan mitra yang ingin diimport.
                            </p>
                        </div>

                        <!-- Tambahkan info untuk troubleshooting -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4 text-xs text-yellow-800">
                            <strong>Catatan:</strong> Jika mengalami masalah saat upload file CSV, pastikan:
                            <ul class="list-disc ml-5 mt-1">
                                <li>File CSV menggunakan format UTF-8</li>
                                <li>Kolom dipisahkan dengan koma (,)</li>
                                <li>Baris pertama adalah header (nama_perusahaan_mitra, email, telepon, alamat,
                                    id_jenis_perusahaan, bidang_industri, tentang)</li>
                            </ul>
                        </div>

                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4">
                            <div class="flex flex-col items-center justify-center">
                                <label for="excel_file"
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-white hover:bg-gray-50">
                                    <div id="dropArea" class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="ph ph-upload text-3xl text-gray-400 mb-2"></i>
                                        <p class="mb-2 text-sm text-gray-600 text-center">
                                            <span class="font-semibold">Klik untuk unggah</span> atau tarik dan letakkan
                                        </p>
                                        <p id="selectedFileName" class="text-xs text-gray-500">.xlsx, .xls atau .csv</p>
                                    </div>
                                </label>
                                <input type="file" id="excel_file" name="excel_file" accept=".xlsx,.xls,.csv" class="hidden"
                                    required />
                            </div>
                        </div>

                        <div class="flex flex-col space-y-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="skipHeader" name="skip_header"
                                    class="shrink-0 mt-0.5 border-gray-200 rounded text-primary-600 focus:ring-primary-500 checked:bg-primary-600 disabled:opacity-50 disabled:pointer-events-none"
                                    checked>
                                <label for="skipHeader" class="text-sm text-gray-600 ms-2">Lewati baris pertama
                                    (header)</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                    <button type="button" id="cancelUpload"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                        Batal
                    </button>
                    <button type="button" id="confirmUpload"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <span id="uploadButtonText">Import Data</span>
                        <div id="uploadSpinner"
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
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 id="successModal-label" class="font-bold text-gray-800">
                        Berhasil!
                    </h3>
                    <button type="button" id="closeSuccessModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <i class="ph ph-x size-4"></i>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ph ph-check-circle text-2xl text-green-600"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Import Berhasil</h4>
                        <p class="text-sm text-gray-600 mb-4">
                            <span id="successCount" class="font-semibold">0</span> data perusahaan mitra berhasil diimport
                            ke dalam
                            sistem.
                        </p>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                            <div class="flex items-center">
                                <i class="ph ph-info text-lg text-green-600 mr-2"></i>
                                <p class="text-xs text-green-800">
                                    Data perusahaan mitra telah ditambahkan ke dalam sistem dan siap untuk digunakan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                    <button type="button" id="backToListBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                        <i class="ph ph-list text-lg"></i>
                        Kembali ke Daftar
                    </button>
                    <button type="button" id="importMoreBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        <i class="ph ph-upload text-lg"></i>
                        Import Lagi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="errorModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 id="errorModal-label" class="font-bold text-gray-800">
                        Terjadi Kesalahan
                    </h3>
                    <button type="button" id="closeErrorModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <i class="ph ph-x size-4"></i>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ph ph-warning text-2xl text-red-600"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Import Gagal</h4>
                        <p id="errorMessage" class="text-sm text-gray-600 mb-2">
                            Terjadi kesalahan saat mengimport data perusahaan mitra.
                        </p>
                        <div id="errorDetails" class="bg-red-50 border border-red-200 rounded-lg p-3 mt-4 text-left">
                            <h5 class="text-xs font-semibold text-red-800 mb-1">Detail Kesalahan:</h5>
                            <ul id="errorList" class="text-xs text-red-700 list-disc ml-5 space-y-1">
                                <!-- Error details will be populated here -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                    <button type="button" id="closeErrorBtn"
                        class="py-2 px-3 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gray-600 text-white hover:bg-gray-700 focus:outline-hidden focus:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none w-full">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let uploadModal = null;
        let successModal = null;
        let errorModal = null;

        document.addEventListener('DOMContentLoaded', function () {
            // Open modals function with Preline HS Overlay support
            function openModal(modalId) {
                const modalElement = document.getElementById(modalId);

                if (typeof HSOverlay === 'function') {
                    const modal = new HSOverlay(modalElement);
                    modal.open();
                    return modal;
                } else {
                    // Fallback
                    modalElement.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                    return {
                        close: function () {
                            modalElement.classList.add('hidden');
                            document.body.classList.remove('overflow-hidden');
                        }
                    };
                }
            }

            function closeModal(modal, modalId) {
                if (modal && typeof modal.close === 'function') {
                    modal.close();
                } else {
                    document.getElementById(modalId).classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
                return null;
            }

            // Upload file modal
            document.getElementById('uploadFileBtn').addEventListener('click', function () {
                uploadModal = openModal('uploadModal');
            });

            document.getElementById('closeUploadModalBtn').addEventListener('click', function () {
                uploadModal = closeModal(uploadModal, 'uploadModal');
            });

            document.getElementById('cancelUpload').addEventListener('click', function () {
                uploadModal = closeModal(uploadModal, 'uploadModal');
            });

            // Success modal management
            document.getElementById('closeSuccessModalBtn').addEventListener('click', function () {
                successModal = closeModal(successModal, 'successModal');
            });

            document.getElementById('backToListBtn').addEventListener('click', function () {
                window.location.href = "{{ route('admin.perusahaan') }}";
            });

            document.getElementById('importMoreBtn').addEventListener('click', function () {
                successModal = closeModal(successModal, 'successModal');

                // Reset the upload form
                document.getElementById('uploadForm').reset();
                document.getElementById('selectedFileName').textContent = '.xlsx, .xls atau .csv';

                // Re-open upload modal
                uploadModal = openModal('uploadModal');
            });

            // Error modal management
            document.getElementById('closeErrorModalBtn').addEventListener('click', function () {
                errorModal = closeModal(errorModal, 'errorModal');
            });

            document.getElementById('closeErrorBtn').addEventListener('click', function () {
                errorModal = closeModal(errorModal, 'errorModal');
            });

            // Handle file selection for upload
            document.getElementById('excel_file').addEventListener('change', function (e) {
                const fileName = e.target.files[0]?.name || '.xlsx, .xls atau .csv';
                document.getElementById('selectedFileName').textContent = fileName;
            });

            // Handle drag and drop functionality
            const dropArea = document.getElementById('dropArea');
            const fileInput = document.getElementById('excel_file');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropArea.classList.add('border-blue-500', 'bg-blue-50');
            }

            function unhighlight() {
                dropArea.classList.remove('border-blue-500', 'bg-blue-50');
            }

            dropArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;

                const fileName = files[0]?.name || '.xlsx, .xls atau .csv';
                document.getElementById('selectedFileName').textContent = fileName;
            }

            // Handle import form submission
            document.getElementById('confirmUpload').addEventListener('click', function () {
                const fileInput = document.getElementById('excel_file');

                if (!fileInput.files || fileInput.files.length === 0) {
                    alert('Silakan pilih file Excel terlebih dahulu.');
                    return;
                }

                // Show loading state
                this.disabled = true;
                document.getElementById('uploadButtonText').textContent = 'Memproses...';
                document.getElementById('uploadSpinner').classList.remove('hidden');

                // Submit the form
                const form = document.getElementById('uploadForm');

                // Use fetch API for AJAX submission
                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        // Reset button state
                        document.getElementById('confirmUpload').disabled = false;
                        document.getElementById('uploadButtonText').textContent = 'Import Data';
                        document.getElementById('uploadSpinner').classList.add('hidden');

                        // Close upload modal
                        uploadModal = closeModal(uploadModal, 'uploadModal');

                        // Check if import was successful
                        if (data.success) {
                            // Show success modal
                            document.getElementById('successCount').textContent = data.count || 0;
                            successModal = openModal('successModal');
                        } else {
                            // Show error modal
                            document.getElementById('errorMessage').textContent = data.message || 'Terjadi kesalahan saat mengimport data.';

                            // Clear previous errors
                            const errorList = document.getElementById('errorList');
                            errorList.innerHTML = '';

                            // Add error details if available
                            if (data.errors && Array.isArray(data.errors)) {
                                data.errors.forEach(error => {
                                    const li = document.createElement('li');
                                    li.textContent = error;
                                    errorList.appendChild(li);
                                });
                                document.getElementById('errorDetails').classList.remove('hidden');
                            } else {
                                document.getElementById('errorDetails').classList.add('hidden');
                            }

                            errorModal = openModal('errorModal');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);

                        // Reset button state
                        document.getElementById('confirmUpload').disabled = false;
                        document.getElementById('uploadButtonText').textContent = 'Import Data';
                        document.getElementById('uploadSpinner').classList.add('hidden');

                        // Close upload modal
                        uploadModal = closeModal(uploadModal, 'uploadModal');

                        // Show error modal
                        document.getElementById('errorMessage').textContent = 'Terjadi kesalahan saat menghubungi server.';
                        document.getElementById('errorDetails').classList.add('hidden');
                        errorModal = openModal('errorModal');
                    });
            });

            // Check for session messages
            @if(session('success'))
                document.getElementById('successCount').textContent = "{{ session('count', 0) }}";
                successModal = openModal('successModal');
            @endif

            @if(session('error'))
                document.getElementById('errorMessage').textContent = "{{ session('error') }}";

                @if(session('errors') && count(session('errors')) > 0)
                    const errorList = document.getElementById('errorList');
                    errorList.innerHTML = '';

                    @foreach(session('errors') as $error)
                        const li = document.createElement('li');
                        li.textContent = "{{ $error }}";
                        errorList.appendChild(li);
                    @endforeach

                    document.getElementById('errorDetails').classList.remove('hidden');
                @else
                    document.getElementById('errorDetails').classList.add('hidden');
                @endif

                errorModal = openModal('errorModal');
            @endif
                    });
    </script>
@endsection