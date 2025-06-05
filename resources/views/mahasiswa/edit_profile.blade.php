@extends('layout.template')
@section('content')
    <!-- Success Modal -->
    <div id="success-modal" 
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="success-modal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="success-modal-label" class="font-bold text-gray-800 dark:text-white">
                        Berhasil!
                    </h3>
                    <button type="button" data-hs-overlay="#success-modal"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 6-12 12" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ph ph-check text-green-600 text-2xl"></i>
                        </div>
                        <p id="success-message" class="mt-2 text-sm text-gray-600 dark:text-neutral-400"></p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="success-ok-btn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="error-modal" 
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="error-modal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="error-modal-label" class="font-bold text-gray-800 dark:text-white">
                        Terjadi Kesalahan
                    </h3>
                    <button type="button" data-hs-overlay="#error-modal"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 6-12 12" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ph ph-x text-red-600 text-2xl"></i>
                        </div>
                        <p id="error-message" class="mt-2 text-sm text-gray-600 dark:text-neutral-400"></p>
                        <div id="error-details" class="mt-3 text-sm text-gray-500 dark:text-neutral-500 hidden"></div>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" data-hs-overlay="#error-modal"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Delete Modal -->
    <div id="confirm-delete-modal" 
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="confirm-delete-modal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="confirm-delete-modal-label" class="font-bold text-gray-800 dark:text-white">
                        Konfirmasi Hapus
                    </h3>
                    <button type="button" data-hs-overlay="#confirm-delete-modal"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 6-12 12" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ph ph-warning text-yellow-600 text-2xl"></i>
                        </div>
                        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Apakah Anda yakin ingin menghapus dokumen ini?
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" data-hs-overlay="#confirm-delete-modal"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800">
                        Batal
                    </button>
                    <button type="button" id="confirm-delete-btn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white w-full flex flex-col p-4 space-y-6 rounded-2xl">
        <h2 class="font-medium text-xl">Edit Profil Pengguna</h2>
        <div class="border border-neutral-200 rounded-lg px-4 py-6 w-full space-y-6">
            <h3 class="font-medium text-xl">Data Pribadi</h3>
            <div class="flex items-start gap-10">
                <div class="flex flex-col gap-4 w-fit items-center">
                    <img id="profile-image" class="size-32 rounded-full object-cover"
                        src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/avatar.svg') }}"
                        alt="User profile">
                    <input type="file" id="profile-photo-upload" class="hidden" accept="image/*">
                    <button type="button" onclick="document.getElementById('profile-photo-upload').click()"
                        class="btn-outline w-fit text-primary-500 border-primary-500 hover:bg-primary-500 hover:text-white flex items-center gap-2 whitespace-nowrap px-3 py-2">
                        <x-lucide-pencil-line stroke-width="1.5" class="size-3.5" />
                        Ganti Foto Profil
                    </button>
                </div>
                <div class="flex flex-col gap-4  w-full">
                    <div>
                        <label for="nama_lengkap" class="text-sm font-semibold">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ Auth::user()->name }}"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    <div>
                        <label for="nim" class="text-sm font-semibold">NIM</label>
                        <input type="text" id="nim" name="nim"
                            value="{{ Auth::user()->mahasiswa->nim ?? '' }}"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    <div>
                        <label for="program_studi" class="text-sm font-semibold">Program Studi</label>
                        <select id="program_studi" name="program_studi"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="">Pilih Program Studi</option>
                            @foreach ($programStudi as $prodi)
                                <option value="{{ $prodi->id_program_studi }}"
                                    {{ (Auth::user()->mahasiswa->id_program_studi ?? '') == $prodi->id_program_studi ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <span class="flex justify-end mt-6">
                <button type="button" id="updateDataPribadiBtn" class="btn-primary">
                    Perbarui Data Pribadi
                </button>
            </span>
        </div>
        <hr class="border-neutral-200">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3=2 gap-4 w-full">
            <div class="border border-neutral-200 rounded-lg px-4 py-6 w-full max-h-max">
                <h3 class="mb-6 font-medium text-xl">Preferensi Magang</h3>
                <div class="flex flex-col gap-4">
                    <div>
                        <label for="jenis_magang" class="text-sm font-semibold">Jenis Magang</label>
                        <select id="jenis_magang" name="jenis_magang"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="">Pilih Jenis Magang</option>
                            <option value="wfo"
                                {{ (Auth::user()->mahasiswa->jenis_magang ?? '') == 'wfo' ? 'selected' : '' }}>Work From
                                Office (WFO)</option>
                            <option value="remote"
                                {{ (Auth::user()->mahasiswa->jenis_magang ?? '') == 'remote' ? 'selected' : '' }}>Remote
                            </option>
                            <option value="hybrid"
                                {{ (Auth::user()->mahasiswa->jenis_magang ?? '') == 'hybrid' ? 'selected' : '' }}>Hybrid
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="kompetensi" class="text-sm font-semibold">Kompetensi</label>
                        <select id="kompetensi" name="kompetensi"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="">Pilih Kompetensi</option>
                            @foreach ($kompetensi as $komp)
                                <option value="{{ $komp->id_kompetensi }}"
                                    {{ (Auth::user()->mahasiswa->id_kompetensi ?? '') == $komp->id_kompetensi ? 'selected' : '' }}>
                                    {{ $komp->nama_kompetensi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="jenis_perusahaan" class="text-sm font-semibold">Jenis Perusahaan</label>
                        <select id="jenis_perusahaan" name="jenis_perusahaan"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="">Pilih Jenis Perusahaan</option>
                            @foreach ($jenisPerusahaan as $jenis)
                                <option value="{{ $jenis->id_jenis_perusahaan }}"
                                    {{ (Auth::user()->mahasiswa->id_jenis_perusahaan ?? '') == $jenis->id_jenis_perusahaan ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="preferensi_lokasi" class="text-sm font-semibold">Preferensi Lokasi</label>
                        <div class="location-input-container relative">
                            <input type="text" id="preferensi_lokasi" name="preferensi_lokasi"
                                value="{{ Auth::user()->mahasiswa->preferensi_lokasi ?? '' }}"
                                placeholder="Ketik kota atau wilayah yang diinginkan..."
                                class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                                autocomplete="off">
                            <div id="location-suggestions"
                                class="absolute top-full left-0 right-0 bg-white border border-gray-200 rounded-lg shadow-lg max-h-60 overflow-y-auto z-50 hidden">
                            </div>
                        </div>
                        <input type="hidden" id="latitude-preferensi" name="latitude_preferensi"
                            value="{{ Auth::user()->mahasiswa->latitude_preferensi ?? '' }}">
                        <input type="hidden" id="longitude-preferensi" name="longitude_preferensi"
                            value="{{ Auth::user()->mahasiswa->longitude_preferensi ?? '' }}">
                    </div>
                </div>
                <span class="flex justify-end mt-6">
                    <button type="button" id="updatePreferensiBtn" class="btn-primary">
                        Perbarui Preferensi
                    </button>
                </span>
            </div>
            <div class="border border-neutral-200 rounded-lg px-4 py-6 w-full max-h-max">
                <h3 class="mb-6 font-medium text-xl">Akun pengguna</h3>
                <div class="flex flex-col gap-4">
                    <div>
                        <label for="email" class="text-sm font-semibold">Email</label>
                        <input type="email" id="email" name="email" value="{{ Auth::user()->email }}"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    <div>
                        <label for="password" class="text-sm font-semibold">Kata Sandi</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi baru (kosongkan jika tidak ingin mengubah)"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    <div>
                        <label for="password_confirmation" class="text-sm font-semibold">Konfirmasi Kata Sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Konfirmasi kata sandi"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                </div>
                <span class="flex justify-end mt-6">
                    <button type="button" id="updateAkunBtn" class="btn-primary">
                        Perbarui Akun
                    </button>
                </span>
            </div>
        </div>
        <hr class="border-neutral-200">
        <div class="w-full px-4 py-6 rounded-lg border border-neutral-200 flex flex-col gap-6">
            <div class="flex justify-between items-center w-full">
                <div class="text-neutral-900 text-xl font-semibold">Dokumen Pendukung</div>
            </div>
            <div class="flex gap-6 w-full">
                {{-- CV --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 w-full">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <x-lucide-file class="w-4 h-4 text-primary-600" />
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Curriculum Vitae</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs ">
                        @php $cv = $dokumen['curriculum vitae'] ?? null; @endphp
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">
                                {{ $cv ? $cv->created_at->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">
                                @if ($cv && $cv->path_dokumen)
                                    @php
                                        try {
                                            $fileSize = Storage::disk('public')->size($cv->path_dokumen);
                                            $fileSizeKB = number_format($fileSize / 1024, 0) . ' KB';
                                        } catch (\Exception $e) {
                                            $fileSizeKB = 'File tidak ditemukan';
                                        }
                                    @endphp
                                    {{ $fileSizeKB }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                    @if ($cv)
                        <div class="flex justify-start ">
                            <a href="{{ asset('storage/' . $cv->path_dokumen) }}" target="_blank"
                                class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-eye class="w-4 h-4 mr-2" />
                                Lihat Dokumen
                            </a>
                        </div>
                        <div class="flex gap-2">
                            <input type="file" id="cv-upload" class="hidden"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <button type="button" onclick="document.getElementById('cv-upload').click()"
                                class="inline-flex justify-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition flex-1">
                                Perbarui
                            </button>
                            <button type="button" onclick="hapusDokumen('curriculum vitae')"
                                class="inline-flex justify-center px-4 py-2 border border-red-600 rounded-lg text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-600 text-sm font-medium transition">
                                <x-lucide-trash-2 class="w-4 h-4" />
                            </button>
                        </div>
                    @else
                        <div class="flex items-center">
                            <input type="file" id="cv-upload" class="hidden"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <button type="button" onclick="document.getElementById('cv-upload').click()"
                                class="btn-primary justify-center inline-flex items-center py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-upload class="w-4 h-4 mr-2" />
                                Unggah
                            </button>
                        </div>
                    @endif
                </div>

                {{-- Portofolio --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 w-full">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <x-lucide-image class="w-4 h-4 text-primary-600" />
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Portofolio</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs ">
                        @php $portofolio = $dokumen['portofolio'] ?? null; @endphp
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">
                                {{ $portofolio ? $portofolio->created_at->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">
                                @if ($portofolio && $portofolio->path_dokumen)
                                    @php
                                        try {
                                            $fileSize = Storage::disk('public')->size($portofolio->path_dokumen);
                                            $fileSizeKB = number_format($fileSize / 1024, 0) . ' KB';
                                        } catch (\Exception $e) {
                                            $fileSizeKB = 'File tidak ditemukan';
                                        }
                                    @endphp
                                    {{ $fileSizeKB }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                    @if ($portofolio)
                        <div class="flex justify-start ">
                            <a href="{{ asset('storage/' . $portofolio->path_dokumen) }}" target="_blank"
                                class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-eye class="w-4 h-4 mr-2" />
                                Lihat Dokumen
                            </a>
                        </div>
                        <div class="flex gap-2">
                            <input type="file" id="portofolio-upload" class="hidden"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <button type="button" onclick="document.getElementById('portofolio-upload').click()"
                                class="inline-flex justify-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition flex-1">
                                Perbarui
                            </button>
                            <button type="button" onclick="hapusDokumen('portofolio')"
                                class="inline-flex justify-center px-4 py-2 border border-red-600 rounded-lg text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-600 text-sm font-medium transition">
                                <x-lucide-trash-2 class="w-4 h-4" />
                            </button>
                        </div>
                    @else
                        <div class="flex items-center">
                            <input type="file" id="portofolio-upload" class="hidden"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <button type="button" onclick="document.getElementById('portofolio-upload').click()"
                                class="btn-primary justify-center inline-flex items-center py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-upload class="w-4 h-4 mr-2" />
                                Unggah
                            </button>
                        </div>
                    @endif
                </div>

                {{-- Sertifikat --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 w-full">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="ph ph-medal w-4 h-4 text-primary-600"></i>
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Sertifikat</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs ">
                        @php $sertifikat = $dokumen['sertifikat'] ?? null; @endphp
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">
                                {{ $sertifikat ? $sertifikat->created_at->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">
                                @if ($sertifikat && $sertifikat->path_dokumen)
                                    @php
                                        try {
                                            $fileSize = Storage::disk('public')->size($sertifikat->path_dokumen);
                                            $fileSizeKB = number_format($fileSize / 1024, 0) . ' KB';
                                        } catch (\Exception $e) {
                                            $fileSizeKB = 'File tidak ditemukan';
                                        }
                                    @endphp
                                    {{ $fileSizeKB }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                    @if ($sertifikat)
                        <div class="flex justify-start ">
                            <a href="{{ asset('storage/' . $sertifikat->path_dokumen) }}" target="_blank"
                                class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-eye class="w-4 h-4 mr-2" />
                                Lihat Dokumen
                            </a>
                        </div>
                        <div class="flex gap-2">
                            <input type="file" id="sertifikat-upload" class="hidden"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <button type="button" onclick="document.getElementById('sertifikat-upload').click()"
                                class="inline-flex justify-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition flex-1">
                                Perbarui
                            </button>
                            <button type="button" onclick="hapusDokumen('sertifikat')"
                                class="inline-flex justify-center px-4 py-2 border border-red-600 rounded-lg text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-600 text-sm font-medium transition">
                                <x-lucide-trash-2 class="w-4 h-4" />
                            </button>
                        </div>
                    @else
                        <div class="flex items-center">
                            <input type="file" id="sertifikat-upload" class="hidden"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <button type="button" onclick="document.getElementById('sertifikat-upload').click()"
                                class="btn-primary justify-center inline-flex items-center py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-upload class="w-4 h-4 mr-2" />
                                Unggah
                            </button>
                        </div>
                    @endif
                </div>

                {{-- Surat Pengantar --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 w-full">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="ph ph-envelope-simple w-4 h-4 text-primary-600"></i>
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Surat Pengantar</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs ">
                        @php $suratPengantar = $dokumen['surat pengantar'] ?? null; @endphp
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">
                                {{ $suratPengantar ? $suratPengantar->created_at->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">
                                @if ($suratPengantar && $suratPengantar->path_dokumen)
                                    @php
                                        try {
                                            $fileSize = Storage::disk('public')->size($suratPengantar->path_dokumen);
                                            $fileSizeKB = number_format($fileSize / 1024, 0) . ' KB';
                                        } catch (\Exception $e) {
                                            $fileSizeKB = 'File tidak ditemukan';
                                        }
                                    @endphp
                                    {{ $fileSizeKB }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                    @if ($suratPengantar)
                        <div class="flex justify-start ">
                            <a href="{{ asset('storage/' . $suratPengantar->path_dokumen) }}" target="_blank"
                                class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-eye class="w-4 h-4 mr-2" />
                                Lihat Dokumen
                            </a>
                        </div>
                        <div class="flex gap-2">
                            <input type="file" id="surat-pengantar-upload" class="hidden"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <button type="button" onclick="document.getElementById('surat-pengantar-upload').click()"
                                class="inline-flex justify-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition flex-1">
                                Perbarui
                            </button>
                            <button type="button" onclick="hapusDokumen('surat pengantar')"
                                class="inline-flex justify-center px-4 py-2 border border-red-600 rounded-lg text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-600 text-sm font-medium transition">
                                <x-lucide-trash-2 class="w-4 h-4" />
                            </button>
                        </div>
                    @else
                        <div class="flex items-center">
                            <input type="file" id="surat-pengantar-upload" class="hidden"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <button type="button" onclick="document.getElementById('surat-pengantar-upload').click()"
                                class="btn-primary justify-center inline-flex items-center py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-upload class="w-4 h-4 mr-2" />
                                Unggah
                            </button>
                        </div>
                    @endif
                </div>

                {{-- Transkip Nilai --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 w-full">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="ph ph-chart-line w-4 h-4 text-primary-600"></i>
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Transkip Nilai</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs ">
                        @php $transkip = $dokumen['transkip nilai'] ?? null; @endphp
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">
                                {{ $transkip ? $transkip->created_at->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">
                                @if ($transkip && $transkip->path_dokumen)
                                    @php
                                        try {
                                            $fileSize = Storage::disk('public')->size($transkip->path_dokumen);
                                            $fileSizeKB = number_format($fileSize / 1024, 0) . ' KB';
                                        } catch (\Exception $e) {
                                            $fileSizeKB = 'File tidak ditemukan';
                                        }
                                    @endphp
                                    {{ $fileSizeKB }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                    @if ($transkip)
                        <div class="flex justify-start ">
                            <a href="{{ asset('storage/' . $transkip->path_dokumen) }}" target="_blank"
                                class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-eye class="w-4 h-4 mr-2" />
                                Lihat Dokumen
                            </a>
                        </div>
                        <div class="flex gap-2">
                            <input type="file" id="transkip-nilai-upload" class="hidden"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <button type="button" onclick="document.getElementById('transkip-nilai-upload').click()"
                                class="inline-flex justify-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition flex-1">
                                Perbarui
                            </button>
                            <button type="button" onclick="hapusDokumen('transkip nilai')"
                                class="inline-flex justify-center px-4 py-2 border border-red-600 rounded-lg text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-600 text-sm font-medium transition">
                                <x-lucide-trash-2 class="w-4 h-4" />
                            </button>
                        </div>
                    @else
                        <div class="flex items-center">
                            <input type="file" id="transkip-nilai-upload" class="hidden"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <button type="button" onclick="document.getElementById('transkip-nilai-upload').click()"
                                class="btn-primary justify-center inline-flex items-center py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-upload class="w-4 h-4 mr-2" />
                                Unggah
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    let debounceTimer;
    let currentDeleteAction = null;
    let shouldReloadOnClose = false;

    // Modal functions
    function showSuccessModal(message, noReload = false) {
        document.getElementById('success-message').textContent = message;
        shouldReloadOnClose = !noReload;
        HSOverlay.open(document.getElementById('success-modal'));
    }

    function showErrorModal(message, errors = null) {
        document.getElementById('error-message').textContent = message;
        const errorDetails = document.getElementById('error-details');

        if (errors) {
            let errorText = '';
            for (const [field, messages] of Object.entries(errors)) {
                errorText += `${field}: ${messages.join(', ')}\n`;
            }
            errorDetails.textContent = errorText;
            errorDetails.classList.remove('hidden');
        } else {
            errorDetails.classList.add('hidden');
        }

        HSOverlay.open(document.getElementById('error-modal'));
    }

    function showConfirmDeleteModal(callback) {
        currentDeleteAction = callback;
        HSOverlay.open(document.getElementById('confirm-delete-modal'));
    }

    // Success Modal OK Button Handler
    document.getElementById('success-ok-btn').addEventListener('click', function() {
        HSOverlay.close(document.getElementById('success-modal'));
        if (shouldReloadOnClose) {
            location.reload();
        }
    });

    // Confirm delete button handler
    document.getElementById('confirm-delete-btn').addEventListener('click', function() {
        if (currentDeleteAction) {
            currentDeleteAction();
            HSOverlay.close(document.getElementById('confirm-delete-modal'));
            currentDeleteAction = null;
        }
    });

    // Profile Photo Upload - Langsung upload dan tampilkan
    document.getElementById('profile-photo-upload').addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            
            // Validasi ukuran file (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                showErrorModal('Ukuran file tidak boleh lebih dari 2MB');
                e.target.value = ''; // Reset input
                return;
            }
            
            // Validasi tipe file
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                showErrorModal('Format file harus JPEG, PNG, JPG, atau GIF');
                e.target.value = ''; // Reset input
                return;
            }
            
            const formData = new FormData();
            formData.append('profile_photo', file);
            formData.append('_token', '{{ csrf_token() }}');

            // Preview image immediately
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-image').src = e.target.result;
            };
            reader.readAsDataURL(file);

            // Upload to server
            fetch('{{ route("mahasiswa.profile.upload-profile-photo") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update image with server URL to ensure it's the saved version
                    document.getElementById('profile-image').src = data.photo_url;
                    // Show success modal tanpa reload untuk foto profil
                    showSuccessModal(data.message, true);
                } else {
                    showErrorModal(data.message || 'Terjadi kesalahan saat mengunggah foto', data.errors);
                    // Restore original image if upload failed
                    document.getElementById('profile-image').src = '{{ Auth::user()->profile_photo ? asset("storage/" . Auth::user()->profile_photo) : asset("images/avatar.svg") }}';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorModal('Terjadi kesalahan saat mengunggah foto');
                // Restore original image if upload failed
                document.getElementById('profile-image').src = '{{ Auth::user()->profile_photo ? asset("storage/" . Auth::user()->profile_photo) : asset("images/avatar.svg") }}';
            });
            
            // Reset input untuk memungkinkan upload file yang sama
            e.target.value = '';
        }
    });

    // Update Data Pribadi
    document.getElementById('updateDataPribadiBtn').addEventListener('click', function() {
        const button = this;
        const originalText = button.textContent;
        
        // Disable button and show loading
        button.disabled = true;
        button.textContent = 'Memperbarui...';
        
        const formData = new FormData();
        formData.append('nama_lengkap', document.getElementById('nama_lengkap').value);
        formData.append('nim', document.getElementById('nim').value);
        formData.append('program_studi', document.getElementById('program_studi').value);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route("mahasiswa.profile.update-data-pribadi") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccessModal(data.message);
            } else {
                showErrorModal(data.message || 'Terjadi kesalahan', data.errors);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorModal('Terjadi kesalahan saat memperbarui data pribadi');
        })
        .finally(() => {
            // Re-enable button
            button.disabled = false;
            button.textContent = originalText;
        });
    });

    // Update Akun
    document.getElementById('updateAkunBtn').addEventListener('click', function() {
        const button = this;
        const originalText = button.textContent;
        
        // Disable button and show loading
        button.disabled = true;
        button.textContent = 'Memperbarui...';
        
        const formData = new FormData();
        formData.append('email', document.getElementById('email').value);
        formData.append('password', document.getElementById('password').value);
        formData.append('password_confirmation', document.getElementById('password_confirmation').value);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route("mahasiswa.profile.update-akun") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccessModal(data.message);
                // Clear password fields
                document.getElementById('password').value = '';
                document.getElementById('password_confirmation').value = '';
            } else {
                showErrorModal(data.message || 'Terjadi kesalahan', data.errors);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorModal('Terjadi kesalahan saat memperbarui akun');
        })
        .finally(() => {
            // Re-enable button
            button.disabled = false;
            button.textContent = originalText;
        });
    });

    // Update Preferensi
    document.getElementById('updatePreferensiBtn').addEventListener('click', function() {
        const button = this;
        const originalText = button.textContent;
        
        // Disable button and show loading
        button.disabled = true;
        button.textContent = 'Memperbarui...';
        
        const formData = new FormData();
        formData.append('jenis_magang', document.getElementById('jenis_magang').value);
        formData.append('kompetensi', document.getElementById('kompetensi').value);
        formData.append('jenis_perusahaan', document.getElementById('jenis_perusahaan').value);
        formData.append('preferensi_lokasi', document.getElementById('preferensi_lokasi').value);
        formData.append('latitude_preferensi', document.getElementById('latitude-preferensi').value);
        formData.append('longitude_preferensi', document.getElementById('longitude-preferensi').value);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route('mahasiswa.profile.update-preferensi') }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccessModal(data.message);
            } else {
                showErrorModal(data.message || 'Terjadi kesalahan', data.errors);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorModal('Terjadi kesalahan saat memperbarui preferensi');
        })
        .finally(() => {
            // Re-enable button
            button.disabled = false;
            button.textContent = originalText;
        });
    });

    // Location search functions...
    async function searchLocation(query) {
        if (query.length < 3) {
            hideSuggestions();
            return;
        }
        
        const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&countrycodes=id&limit=5&addressdetails=1&accept-language=id`;
        
        try {
            const response = await fetch(url, {
                headers: {
                    'Accept-Language': 'id-ID,id;q=0.9,en;q=0.8'
                }
            });
            const data = await response.json();
            
            showSuggestions(data);
        } catch (error) {
            console.error("Error fetching location data:", error);
            hideSuggestions();
        }
    }

    function showSuggestions(suggestions) {
        const suggestionsDiv = document.getElementById('location-suggestions');
        if (!suggestionsDiv) return;
        
        suggestionsDiv.innerHTML = '';
        
        if (suggestions.length > 0) {
            suggestions.forEach(place => {
                const item = document.createElement('div');
                item.className = 'px-4 py-3 cursor-pointer hover:bg-gray-50 border-b border-gray-100 last:border-b-0';
                
                const displayName = place.display_name;
                
                const typeMapping = {
                    'administrative': 'Wilayah Administratif',
                    'city': 'Kota',
                    'town': 'Kota',
                    'village': 'Desa',
                    'hamlet': 'Dusun',
                    'suburb': 'Kelurahan',
                    'neighbourhood': 'Lingkungan',
                    'road': 'Jalan',
                    'house': 'Rumah',
                    'building': 'Bangunan',
                    'commercial': 'Komersial',
                    'industrial': 'Industri',
                    'residential': 'Perumahan'
                };
                
                const typeInIndonesian = typeMapping[place.type] || place.class || 'Lokasi';
                
                item.innerHTML = `
                    <div class="text-sm font-medium text-gray-900">${displayName}</div>
                    <div class="text-xs text-gray-500">${typeInIndonesian}</div>
                `;
                
                item.onclick = function() {
                    document.getElementById('preferensi_lokasi').value = displayName;
                    document.getElementById('latitude-preferensi').value = place.lat;
                    document.getElementById('longitude-preferensi').value = place.lon;
                    hideSuggestions();
                };
                
                suggestionsDiv.appendChild(item);
            });
            
            suggestionsDiv.classList.remove('hidden');
        } else {
            const noResult = document.createElement('div');
            noResult.className = 'px-4 py-3 text-sm text-gray-500';
            noResult.textContent = 'Tidak ada lokasi yang ditemukan';
            suggestionsDiv.appendChild(noResult);
            suggestionsDiv.classList.remove('hidden');
        }
    }

    function hideSuggestions() {
        const suggestionsDiv = document.getElementById('location-suggestions');
        if (suggestionsDiv) {
            suggestionsDiv.classList.add('hidden');
        }
    }

    // Event listeners for location search
    const locationInput = document.getElementById('preferensi_lokasi');
    if (locationInput) {
        locationInput.addEventListener('input', function(e) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                searchLocation(e.target.value);
            }, 500);
        });

        locationInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
    }

    // Hide suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.location-input-container')) {
            hideSuggestions();
        }
    });

    // Document upload handlers
    function uploadDokumen(jenisDokumen, file) {
        const formData = new FormData();
        formData.append('dokumen', file);
        formData.append('jenis_dokumen', jenisDokumen);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route("mahasiswa.profile.upload-dokumen") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccessModal(data.message);
            } else {
                showErrorModal(data.message || 'Terjadi kesalahan saat mengunggah dokumen', data.errors);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorModal('Terjadi kesalahan saat mengunggah dokumen');
        });
    }

    // Event listeners untuk upload file
    const fileUploads = [
        'cv-upload',
        'portofolio-upload', 
        'sertifikat-upload',
        'surat-pengantar-upload',
        'transkip-nilai-upload'
    ];

    const documentTypes = {
        'cv-upload': 'curriculum vitae',
        'portofolio-upload': 'portofolio',
        'sertifikat-upload': 'sertifikat',
        'surat-pengantar-upload': 'surat pengantar',
        'transkip-nilai-upload': 'transkip nilai'
    };

    fileUploads.forEach(uploadId => {
        const element = document.getElementById(uploadId);
        if (element) {
            element.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    uploadDokumen(documentTypes[uploadId], e.target.files[0]);
                }
            });
        }
    });

    // Global function for delete confirmation
    window.hapusDokumen = function(jenisDokumen) {
        showConfirmDeleteModal(function() {
            fetch('{{ route("mahasiswa.profile.hapus-dokumen") }}', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    jenis_dokumen: jenisDokumen
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccessModal(data.message);
                } else {
                    showErrorModal(data.message || 'Terjadi kesalahan saat menghapus dokumen', data.errors);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorModal('Terjadi kesalahan saat menghapus dokumen');
            });
        });
    };
});
</script>
