@extends('layout.template')
@section('content')
    <div class="bg-white w-full flex flex-col p-4 gap-6">
        <span class="font-medium text-xl">
            <h2>Edit Profil Pengguna</h2>
        </span>
        <div class="flex flex-col mt-6 gap-6">
            <div class="border border-neutral-200 rounded px-4 py-6 w-full">
                <h3 class="mb-6 font-medium text-xl">Data Pribadi</h3>
                <div class="flex items-center gap-4">
                    <div class="flex flex-col gap-4 mt-10">
                        <img class="size-32 rounded-full items-center"
                            src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/avatar.svg') }}"
                            alt="User profile">
                        <a href="#"
                            class="btn-outline text-primary-500 border-primary-500 hover:bg-primary-500 hover:text-white">
                            <x-lucide-pencil-line stroke-width="1.5" class="size-3.5" />
                            Ganti Foto Profil
                        </a>
                    </div>
                    <div class="flex flex-col gap-4 mt-10 w-full">
                        <div>
                            <label for="" class="text-sm font-semibold">Nama Lengkap</label>
                            <input type="text"
                                class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            </input>
                        </div>
                        <div>
                            <label for="" class="text-sm font-semibold">NIM</label>
                            <input type="text"
                                class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            </input>
                        </div>
                        <div>
                            <label for="" class="text-sm font-semibold">Program Studi</label>
                            <input type="text"
                                class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            </input>
                        </div>
                    </div>
                </div>
                <span class="flex justify-end mt-6">
                    <button type="button" id="submitBtn" class="btn-primary">
                        Perbarui Data Pribadi
                    </button>
                </span>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3=2 gap-4 w-full">
            <div class="border border-neutral-200 rounded px-4 py-6 w-full max-h-max">
                <h3 class="mb-6 font-medium text-xl">Preferensi Magang</h3>
                <div class="flex flex-col gap-4 mt-10">
                    <div>
                        <label for="" class="text-sm font-semibold">Jenis Magang</label>
                        <input type="text"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                        </input>
                    </div>
                    <div>
                        <label for="" class="text-sm font-semibold">Kompetensi</label>
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
                        Perbarui Preferensi
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
        <div class="w-full p-6 bg-white rounded-xl flex flex-col gap-6 shadow">
            <div class="flex justify-between items-center w-full">
                <div class="text-neutral-900 text-xl font-semibold">Dokumen Pendukung</div>
            </div>
            <div class="flex gap-6 w-full">
                {{-- CV --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <x-lucide-file class="w-4 h-4 text-primary-600" />
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Curriculum Vitae</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs mt-auto">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">5 Mei 2025</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">234 KB</span>
                        </div>
                    </div>
                    <div class="flex justify-start mt-auto">
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </button>
                    </div>
                </div>
                {{-- Portofolio --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <x-lucide-image class="w-4 h-4 text-primary-600" />
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Portofolio</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs mt-auto">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">5 Mei 2025</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">234 KB</span>
                        </div>
                    </div>
                    <div class="flex justify-start mt-auto">
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </button>
                    </div>
                </div>
                {{-- Sertifikat --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="ph ph-medal w-4 h-4 text-primary-600"></i>
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Sertifikat</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs mt-auto">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">5 Mei 2025</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">234 KB</span>
                        </div>
                    </div>
                    <div class="flex justify-start mt-auto">
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </button>
                    </div>
                </div>
                {{-- Surat Pengantar --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="ph ph-envelope-simple w-4 h-4 text-primary-600"></i>
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Surat Pengantar</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs mt-auto">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">5 Mei 2025</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">234 KB</span>
                        </div>
                    </div>
                    <div class="flex justify-start mt-auto">
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </button>
                    </div>
                </div>
                {{-- Transkip Nilai --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="ph ph-chart-line w-4 h-4 text-primary-600"></i>
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Transkip Nilai</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs mt-auto">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">5 Mei 2025</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">234 KB</span>
                        </div>
                    </div>
                    <div class="flex justify-start mt-auto">
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
