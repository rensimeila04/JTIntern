@extends('layout.template')
@section('content')
    <div class="bg-white w-full flex flex-col p-4">
        <span class="font-medium text-xl">
            <h2>Edit Profil Pengguna</h2>
        </span>
        <div class="flex justify-between mt-6 gap-6">
            <div class="border border-neutral-200 rounded px-4 py-6 w-full">
                <h3 class="mb-6 font-medium text-xl">Data Pribadi</h3>
                <div class="flex flex-col items-center gap-4">
                    <img class="size-32 rounded-full items-center"
                        src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/avatar.svg') }}"
                        alt="User profile">
                    <a href="#" class="btn-outline text-primary-500 border-primary-500 hover:bg-primary-500 hover:text-white">
                        <x-lucide-pencil-line stroke-width="1.5" class="size-3.5" />
                        Ganti Foto Profil
                    </a>
                </div>
                <div class="flex flex-col gap-4 mt-10">
                    <div>
                        <label for="" class="text-sm font-semibold">Nama Lengkap</label>
                        <input type="text"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                        </input>
                    </div>
                    <div>
                        <label for="" class="text-sm font-semibold">NIP</label>
                        <input type="text"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                        </input>
                    </div>
                </div>
                <span class="flex justify-end mt-6">
                    <button type="button" id="submitBtn" class="btn-primary">
                        Perbarui Data Pribadi
                    </button>
                </span>
            </div>
            <div class="border border-neutral-200 rounded px-4 py-6 w-full max-h-max">
                <h3 class="mb-6 font-medium text-xl">Akun pengguna</h3>
                <div class="flex flex-col gap-4 mt-10">
                    <div>
                        <label for="" class="text-sm font-semibold">Email</label>
                        <input type="text"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                        </input>
                    </div>
                    <div>
                        <label for="" class="text-sm font-semibold">Kata Sandi</label>
                        <input type="text"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                        </input>
                    </div>
                    <div>
                        <label for="" class="text-sm font-semibold">Konfirmasi Kata Sandi</label>
                        <input type="text"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                        </input>
                    </div>
                </div>
                <span class="flex justify-end mt-6">
                    <button type="button" id="submitBtn" class="btn-primary">
                        Perbarui Akun
                    </button>
                </span>
            </div>
        </div>
    </div>
@endsection