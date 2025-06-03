@extends('layout.template')
@section('content')
    <div class="bg-white w-full flex flex-col p-4">
        <span class="font-medium text-xl">
            <h2>Edit Profil Pengguna</h2>
        </span>
        <div class="flex justify-between mt-6 gap-6">
            <form method="POST" action="{{ route('admin.update_profile') }}" enctype="multipart/form-data" class="border border-neutral-200 rounded px-4 py-6 w-full">
                @csrf
                @method('POST')
                <h3 class="mb-6 font-medium text-xl">Data Pribadi</h3>
                <div class="flex flex-col items-center gap-4">
                    @php
                        // Ambil path foto dari session jika baru upload, jika tidak pakai dari database
                        $profilePhoto = session('profile_photo') ?? Auth::user()->profile_photo;
                    @endphp
                    <img class="size-32 rounded-full items-center" id="profilePhotoPreview"
                        src="{{ $profilePhoto ? asset('storage/' . $profilePhoto) : asset('images/avatar.svg') }}"
                        alt="User profile">
                    <label class="btn-outline text-primary-500 border-primary-500 hover:bg-primary-500 hover:text-white cursor-pointer">
                        <x-lucide-pencil-line stroke-width="1.5" class="size-3.5" />
                        Ganti Foto Profil
                        <input type="file" name="profile_photo" class="hidden" accept="image/*">
                    </label>
                </div>
                <div class="flex flex-col gap-4 mt-10">
                    <div>
                        <label for="name" class="text-sm font-semibold">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    <div>
                        <label for="nip" class="text-sm font-semibold">NIP</label>
                        <input type="text" name="nip" id="nip" value="{{ Auth::user()->admin->nip ?? '' }}"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                </div>
                <span class="flex justify-end mt-6">
                    <button type="submit" class="btn-primary">
                        Perbarui Data Pribadi
                    </button>
                </span>
            </form>
            <form method="POST" action="{{ route('admin.update_account') }}" class="border border-neutral-200 rounded px-4 py-6 w-full max-h-max">
                @csrf
                @method('POST')
                <h3 class="mb-6 font-medium text-xl">Akun pengguna</h3>
                <div class="flex flex-col gap-4 mt-10">
                    <div>
                        <label for="email" class="text-sm font-semibold">Email</label>
                        <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    <div>
                        <label for="password" class="text-sm font-semibold">Kata Sandi</label>
                        <input type="password" name="password" id="password" minlength="8" placeholder="Ubah kata sandi"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500" autocomplete="new-password" required>
                    </div>
                    <div>
                        <label for="password_confirmation" class="text-sm font-semibold">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" minlength="8" placeholder="Ubah kata sandi"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500" autocomplete="new-password" required>
                    </div>
                </div>
                <span class="flex justify-end mt-6">
                    <button type="submit" class="btn-primary">
                        Perbarui Akun
                    </button>
                </span>
            </form>
        </div>
        <div id="editSuccessModal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="editSuccessModal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="editSuccessModal-label" class="font-bold text-gray-800 dark:text-white">
                        Berhasil Diperbarui!
                    </h3>
                    <button type="button" id="closeEditSuccessModalBtn" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.querySelector('input[name="profile_photo"]');
    const img = document.getElementById('profilePhotoPreview');
    if (input && img) {
        input.addEventListener('change', function (e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    img.src = ev.target.result;
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    }
});
</script>
@endsection