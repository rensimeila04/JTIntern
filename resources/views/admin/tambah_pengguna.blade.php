@extends('layout.template')

@section('content')
    <div class="p-6 space-y-6 bg-white rounded-lg">
        <h1 class="text-xl font-medium text-neutral-900">Tambah Pengguna</h1>
        <form id="userForm" action="{{ route('admin.pengguna.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label for="id_level" class="block text-sm font-medium mb-2 dark:text-white">Role Pengguna</label>
                        <select id="id_level" name="id_level"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Pilih role pengguna">
                            <option value="" disabled selected>Pilih role</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->id_level }}">{{ $level->nama_level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Nama Pengguna</label>
                        <input type="text" id="name" name="name"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Masukkan nama pengguna" aria-describedby="hs-input-helper-text">
                    </div>
                    <div class="w-full">
                        <label for="profile_photo" class="block text-sm font-medium mb-2 dark:text-white">Foto Profil</label>
                        <div class="flex items-center">
                            <div class="w-full relative">
                                <label for="profile_photo"
                                    class="flex items-center gap-2 w-full py-2.5 sm:py-3 px-4 border border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-gray-50 text-gray-600">
                                    <x-lucide-upload class="size-4 text-gray-500" />
                                    <span id="selected-file" class="text-sm text-gray-700">Unggah foto profil</span>
                                </label>
                                <input type="file" id="profile_photo" name="profile_photo" class="hidden"
                                    accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label for="email" class="block text-sm font-medium mb-2 dark:text-white">E-mail</label>
                        <input type="email" id="email" name="email"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Masukkan alamat e-mail" aria-describedby="hs-input-helper-text">
                    </div>
                    <div class="w-full">
                        <label for="password" class="block text-sm font-medium mb-2 dark:text-white">Kata Sandi</label>
                        <input type="password" id="password" name="password"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Masukkan kata sandi">
                    </div>
                    <div class="w-full">
                        <label for="password_confirmation" class="block text-sm font-medium mb-2 dark:text-white">Konfirmasi
                            Kata Sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Konfirmasi kata sandi">
                    </div>
                </div>
            </div>

            <div class="flex justify-end w-full">
                <button type="button" id="submitBtn" class="btn-primary">
                    Tambahkan Pengguna
                </button>
            </div>
        </form>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="confirmModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="confirmModal-label" class="font-bold text-gray-800 dark:text-white">
                        Konfirmasi Tambah Pengguna
                    </h3>
                    <button type="button" id="closeConfirmModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-user class="w-8 h-8 text-blue-600" />
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Konfirmasi Data Pengguna</h4>
                        <div class="text-left space-y-2 bg-gray-50 p-4 rounded-lg">
                            <div>
                                <span class="text-sm font-medium text-gray-600">Role Pengguna:</span>
                                <span id="confirmRole" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Nama Pengguna:</span>
                                <span id="confirmName" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">E-mail:</span>
                                <span id="confirmEmail" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Foto Profil:</span>
                                <span id="confirmPhoto" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Kata Sandi:</span>
                                <span class="text-sm text-gray-900 ml-2">********</span>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-gray-600">
                            Apakah Anda yakin ingin menambahkan pengguna ini?
                        </p>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="cancelConfirm"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800">
                        Batal
                    </button>
                    <button type="button" id="confirmSubmit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <span id="confirmButtonText">Ya, Tambahkan</span>
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
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Pengguna Berhasil Ditambahkan</h4>
                        <p class="text-sm text-gray-600 mb-4">
                            Pengguna <span id="successUserName" class="font-semibold text-gray-900"></span> telah berhasil
                            ditambahkan ke dalam sistem.
                        </p>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                            <div class="flex items-center">
                                <x-lucide-info class="w-4 h-4 text-green-600 mr-2" />
                                <p class="text-xs text-green-800">
                                    Pengguna dapat langsung login menggunakan email dan kata sandi yang telah dibuat.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="backToListBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800">
                        <x-lucide-list class="w-4 h-4" />
                        Kembali ke Daftar
                    </button>
                    <button type="button" id="addAnotherBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        <x-lucide-plus class="w-4 h-4" />
                        Tambah Lagi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let confirmModal = null;
        let successModal = null;

        // Validasi form
        function validateForm() {
            const requiredFields = [
                { id: 'id_level', name: 'Role Pengguna' },
                { id: 'name', name: 'Nama Pengguna' },
                { id: 'email', name: 'E-mail' },
                { id: 'password', name: 'Kata Sandi' },
                { id: 'password_confirmation', name: 'Konfirmasi Kata Sandi' }
            ];

            for (const field of requiredFields) {
                const element = document.getElementById(field.id);
                if (!element.value.trim()) {
                    alert(`${field.name} harus diisi!`);
                    element.focus();
                    return false;
                }
            }

            // Validasi email
            const email = document.getElementById('email').value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Format email tidak valid!');
                document.getElementById('email').focus();
                return false;
            }

            // Validasi kata sandi
            const password = document.getElementById('password').value;
            if (password.length < 8) {
                alert('Kata sandi harus minimal 8 karakter!');
                document.getElementById('password').focus();
                return false;
            }

            // Validasi kombinasi huruf dan angka
            if (!(/\d/.test(password) && /[a-zA-Z]/.test(password))) {
                alert('Kata sandi harus mengandung huruf dan angka!');
                document.getElementById('password').focus();
                return false;
            }

            // Validasi konfirmasi kata sandi
            const confirmPassword = document.getElementById('password_confirmation').value;
            if (password !== confirmPassword) {
                alert('Konfirmasi kata sandi tidak sesuai!');
                document.getElementById('password_confirmation').focus();
                return false;
            }

            return true;
        }

        // Menampilkan modal konfirmasi
        function showConfirmModal() {
            // Isi data konfirmasi
            const levelSelect = document.getElementById('id_level');
            const roleText = levelSelect.options[levelSelect.selectedIndex].text;
            const userName = document.getElementById('name').value;
            const userEmail = document.getElementById('email').value;
            const profilePhoto = document.getElementById('profile_photo').value ?
                document.getElementById('profile_photo').files[0].name : 'Menggunakan foto default';

            document.getElementById('confirmRole').textContent = roleText;
            document.getElementById('confirmName').textContent = userName;
            document.getElementById('confirmEmail').textContent = userEmail;
            document.getElementById('confirmPhoto').textContent = profilePhoto;

            confirmModal = new HSOverlay(document.getElementById('confirmModal'));
            confirmModal.open();
        }

        // Menutup modal konfirmasi
        function closeConfirmModal() {
            if (confirmModal) {
                confirmModal.close();
                confirmModal = null;
            }
        }

        // Menampilkan modal sukses
        function showSuccessModal(userName) {
            document.getElementById('successUserName').textContent = userName;

            successModal = new HSOverlay(document.getElementById('successModal'));
            successModal.open();
        }

        // Menutup modal sukses
        function closeSuccessModal() {
            if (successModal) {
                successModal.close();
                successModal = null;
            }
        }

        // Tunggu DOM selesai dimuat sebelum menambahkan event listener
        document.addEventListener('DOMContentLoaded', function () {
            // Check if there's a success message in the session
            @if(session('success'))
                const userName = '{{ session('user_name', 'pengguna') }}';

                // Delay showing modal to ensure everything is loaded
                setTimeout(function () {
                    showSuccessModal(userName);
                }, 500);
            @endif

            @if(session('error'))
                alert('{{ session('error') }}');
            @endif

            // Submit button event listener
            document.getElementById('submitBtn').addEventListener('click', function (e) {
                e.preventDefault();

                if (validateForm()) {
                    showConfirmModal();
                }
            });

            // Modal event listeners
            document.getElementById('closeConfirmModalBtn').addEventListener('click', closeConfirmModal);
            document.getElementById('cancelConfirm').addEventListener('click', closeConfirmModal);

            // Confirm submit
            document.getElementById('confirmSubmit').addEventListener('click', function () {
                const confirmBtn = this;
                const confirmText = document.getElementById('confirmButtonText');
                const confirmSpinner = document.getElementById('confirmSpinner');

                // Show loading state
                confirmBtn.disabled = true;
                confirmText.textContent = 'Menyimpan...';
                confirmSpinner.classList.remove('hidden');

                // Submit the form
                document.getElementById('userForm').submit();
            });

            // Success modal event listeners
            document.getElementById('closeSuccessModalBtn').addEventListener('click', closeSuccessModal);

            document.getElementById('backToListBtn').addEventListener('click', function () {
                window.location.href = '{{ route("admin.pengguna") }}';
            });

            document.getElementById('addAnotherBtn').addEventListener('click', function () {
                closeSuccessModal();
                // Reset form
                document.getElementById('userForm').reset();
                // Scroll to top
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Close modal when clicking outside
            document.getElementById('confirmModal').addEventListener('click', function (e) {
                const modalContent = this.querySelector('.bg-white');
                if (!modalContent.contains(e.target)) {
                    closeConfirmModal();
                }
            });

            // Close success modal when clicking outside
            document.getElementById('successModal').addEventListener('click', function (e) {
                const modalContent = this.querySelector('.bg-white');
                if (!modalContent.contains(e.target)) {
                    closeSuccessModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    if (confirmModal) {
                        closeConfirmModal();
                    } else if (successModal) {
                        closeSuccessModal();
                    }
                }
            });

            // Add file input display logic
            document.getElementById('profile_photo').addEventListener('change', function (e) {
                const fileName = e.target.files[0]?.name || 'Unggah foto profil';
                document.getElementById('selected-file').textContent = fileName;
            });
        });
    </script>
@endsection