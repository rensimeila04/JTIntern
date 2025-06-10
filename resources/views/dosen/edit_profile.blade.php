@extends('layout.template')
@section('content')
    <div class="bg-white w-full flex flex-col p-4">
        <span class="font-medium text-xl">
            <h2>Edit Profil Pengguna</h2>
        </span>
        <div class="flex justify-between mt-6 gap-6">
            <form method="POST" action="{{ route('dosen.update_profile') }}" enctype="multipart/form-data" class="border border-neutral-200 rounded px-4 py-6 w-full">
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
                        <input type="text" name="nip" id="nip" value="{{ Auth::user()->dosenPembimbing->nip ?? '' }}"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    <div>
                        <label for="nip" class="text-sm font-semibold">Bidang Minat</label>
                        <input type="text" name="bidang_minat" id="bidang_minat" value="{{ Auth::user()->dosenPembimbing->bidang_minat ?? '' }}"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                </div>
                <span class="flex justify-end mt-6">
                    <button type="submit" class="btn-primary">
                        Perbarui Data Pribadi
                    </button>
                </span>
            </form>
            <form method="POST" action="{{ route('dosen.update_account') }}" class="border border-neutral-200 rounded px-4 py-6 w-full max-h-max">
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
        @if(session('success'))
        <div id="editSuccessModal" class="fixed top-4 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded pointer-events-auto" role="alert">
            <div class="flex items-center">
                <span class="mr-2">
                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </span>
                <strong class="font-medium">{{ session('success') }}</strong>
                <button type="button" class="ml-4" id="closeEditSuccessModalBtn" aria-label="Close">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        @endif
    </div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Preview foto profil
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

    // Handle success message modal
    const modal = document.getElementById('editSuccessModal');
    const closeBtn = document.getElementById('closeEditSuccessModalBtn');
    
    if (modal && closeBtn) {
        // Close modal when clicking the close button
        closeBtn.addEventListener('click', function() {
            modal.remove();
        });

        // Auto hide after 3 seconds
        setTimeout(function() {
            modal.remove();
        }, 3000);
    }
});
</script>
@endsection