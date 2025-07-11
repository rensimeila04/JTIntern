@extends('layout.template')
@section('content')
    <div class="space-y-4 w-full">
        <div class="bg-white rounded-lg space-y-6 p-6 w-full">
            <p class="font-medium text-xl text-neutral-900">Detail Lowongan</p>
            <div class="flex flex-row gap-9 w-full">
                <img src="{{ $lowongan->perusahaanMitra->logo ? Storage::url($lowongan->perusahaanMitra->logo) : asset('Images/placeholder_perusahaan.png') }}"
                    alt="{{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}" class="w-30 h-30 object-cover rounded-2xl">
                <div class="space-y-4 w-full">
                    <div class="flex flex-row justify-between w-full items-start">
                        <div class="space-y-4">
                            <div class="flex flex-row gap-4">
                                <p class="font-medium text-xl text-neutral-900">{{ $lowongan->judul_lowongan }}</p>
                                <span
                                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border {{ $lowongan->status_pendaftaran ? 'border-teal-500 bg-white text-teal-500' : 'border-red-500 bg-white text-red-500' }}">
                                    {{ $lowongan->status_pendaftaran ? 'Aktif Merekrut' : 'Tidak Aktif' }}
                                </span>
                            </div>
                            <a href="#"
                                class="text-base font-normal text-primary-500">{{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}</a>
                        </div>
                        <div class="self-start">
                            @if ($hasApplied && $canApply == false)
                                <button disabled id="check-documents-btn" class="btn-primary-lg">
                                    <x-lucide-briefcase class="w-5 h-5 mr-2" /> Ajukan Magang
                                </button>
                            @elseif(!$lowongan->status_pendaftaran)
                                <button disabled id="check-documents-btn" class="btn-primary-lg">
                                    <x-lucide-briefcase class="w-5 h-5 mr-2" /> Ajukan Magang
                                </button>
                            @elseif($lowongan->deadline_pendaftaran && now() > $lowongan->deadline_pendaftaran)
                                <button disabled id="check-documents-btn" class="btn-primary-lg">
                                    <x-lucide-briefcase class="w-5 h-5 mr-2" /> Ajukan Magang
                                </button>
                            @elseif(!$canApply)
                                <button disabled id="check-documents-btn" class="btn-primary-lg">
                                    <x-lucide-briefcase class="w-5 h-5 mr-2" /> Ajukan Magang
                                </button>
                            @else
                                <button id="check-documents-btn" class="btn-primary-lg">
                                    <x-lucide-briefcase class="w-5 h-5 mr-2" /> Ajukan Magang
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-row gap-10">
                        <div class="space-y-2">
                            <div class="flex flex-row items-center gap-2">
                                <x-lucide-map-pin class="w-5 h-5 inline-block text-neutral-500" stroke-width="1.5" />
                                <p class="text-base font-normal text-neutral-700">{{ $lowongan->perusahaanMitra->alamat }}
                                </p>
                            </div>
                            <div class="flex flex-row items-center gap-2">
                                <x-lucide-calendar-days class="w-5 h-5 inline-block text-neutral-500" stroke-width="1.5" />
                                <p class="text-base font-normal text-neutral-700">
                                    {{ $lowongan->periodeMagang->nama_periode }}</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex flex-row items-center gap-2">
                                <x-lucide-laptop class="w-5 h-5 inline-block text-neutral-500" stroke-width="1.5" />
                                <p class="text-base font-normal text-neutral-700">{{ strtoupper($lowongan->jenis_magang) }}
                                </p>
                            </div>
                            <div class="flex flex-row items-center gap-2">
                                <x-lucide-building-2 class="w-5 h-5 inline-block text-neutral-500" stroke-width="1.5" />
                                <p class="text-base font-normal text-neutral-700">
                                    {{ $lowongan->kompetensi->nama_kompetensi }}</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            @if ($lowongan->deadline_pendaftaran)
                                <span class="flex items-center gap-2 text-sm text-neutral-700">
                                    <x-lucide-clock class="text-neutral-500 size-6" stroke-width="1.5" />
                                    <p class="text-base font-normal text-neutral-800">Deadline:
                                        {{ \Carbon\Carbon::parse($lowongan->deadline_pendaftaran)->format('d M Y') }}
                                    </p>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

        <div class="w-full bg-white p-6 rounded-md">
            <p class="font-medium text-xl">Persyaratan</p>
            <div class="mt-2 text-neutral-400 text-sm whitespace-pre-line">
                {!! nl2br(e($lowongan->persyaratan)) !!}
            </div>
        </div>

        @if ($lowongan->test && $lowongan->informasi_test)
            <div class="w-full bg-white p-6 rounded-md">
                <p class="font-medium text-xl">Informasi Test</p>
                <div class="mt-2 text-neutral-400 text-sm whitespace-pre-line">
                    {!! nl2br(e($lowongan->informasi_test)) !!}
                </div>
            </div>
        @endif

        <div class="w-full bg-white p-6 rounded-md space-y-6">
            <h1 class="font-medium text-xl text-start">
                Tentang Perusahaan
            </h1>
            <div class="gap-9 w-full flex flex-row">
                <img src="{{ $lowongan->perusahaanMitra->logo ? Storage::url($lowongan->perusahaanMitra->logo) : asset('Images/placeholder_perusahaan.png') }}"
                    alt="{{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}"
                    class="w-30 h-30 object-cover rounded-2xl">
                <div class="space-y-4 w-full">
                    <h1 class="text-lg font-medium text-neutral-900">
                        {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}</h1>
                    <div class="flex flex-row gap-9">
                        <div class="flex flex-col gap-2">
                            <p class="text-base font-normal text-neutral-400">Jenis Perusahaan</p>
                            <p class="text-base font-normal text-neutral-700">
                                {{ $lowongan->perusahaanMitra->jenisPerusahaan->nama_jenis_perusahaan }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-base font-normal text-neutral-400">Bidang Industri</p>
                            <p class="text-base font-normal text-neutral-700">
                                {{ $lowongan->perusahaanMitra->bidang_industri }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fles flex-col gap-2">
                <p class="text-xl font-medium text-neutral-900">Deskripsi</p>
                <p class="text-base font-normal text-neutral-400 whitespace-pre-line">
                    {{ $lowongan->perusahaanMitra->tentang ? $lowongan->perusahaanMitra->tentang : 'Tidak ada deskripsi' }}
                </p>
            </div>
        </div>

        <div class="space-y-4">
            <h1 class="font-medium text-xl text-start">
                Lowongan Lainya
            </h1>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-4 w-full relative z-10">
                @forelse ($lowonganList as $item)
                    @php
                        $wibNow = now('Asia/Jakarta');
                        $deadline = $item->deadline_pendaftaran
                            ? \Carbon\Carbon::parse($item->deadline_pendaftaran)->setTimezone('Asia/Jakarta')
                            : null;
                        $daysLeft = $deadline ? $deadline->diffInDays($wibNow, false) : null;
                        $applicantCount = $item->magang()->count();
                        $isExpired = $deadline && $deadline->isPast();
                    @endphp
                    <div class="bg-white flex-col rounded-xl flex py-6 px-4 gap-4 relative z-0 {{ $isExpired ? 'opacity-75' : '' }}">
                        <div class="inline-flex items-center gap-6">
                            <img src="{{ $item->perusahaanMitra->logo ? $item->perusahaanMitra->logo_url : asset('images/placeholder_perusahaan.png') }}"
                                alt="Logo {{ $item->perusahaanMitra->nama_perusahaan_mitra }}"
                                class="w-20 h-20 rounded-lg object-contain bg-gray-50">
                            <div class="flex flex-col flex-1 justify-start items-start gap-2 h-fill cursor-pointer"
                                onclick="window.location.href='{{ route('mahasiswa.lowongan.detail', $item->id_lowongan) }}'">
                                <div class="self-stretch inline-flex justify-start items-center gap-4">
                                    <div
                                        class="justify-start text-black text-lg font-medium leading-none hover:text-primary-600 transition-colors">
                                        {{ $item->judul_lowongan }}
                                    </div>
                                </div>
                                <div class="inline-flex justify-start items-center gap-2">
                                    <span
                                        class="justify-start text-neutral-400 text-sm font-normal leading-none truncate max-w-[120px]">
                                        {{ $item->perusahaanMitra->nama_perusahaan_mitra }}
                                    </span>
                                    <div class="w-1 h-1 bg-neutral-400 rounded-full flex-shrink-0"></div>
                                    <span
                                        class="justify-start text-neutral-400 text-sm font-normal leading-none truncate max-w-[150px]">
                                        {{ $item->perusahaanMitra->alamat }}
                                    </span>
                                </div>
                                <div class="inline-flex justify-start items-start gap-2">
                                    <span
                                        class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">
                                        {{ strtoupper($item->jenis_magang) }}
                                    </span>
                                    <span
                                        class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">
                                        {{ $item->perusahaanMitra->jenisPerusahaan->nama_jenis_perusahaan }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('mahasiswa.lowongan.detail', $item->id_lowongan) }}"
                                class="ml-auto py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-600 disabled:opacity-50 disabled:pointer-events-none {{ $isExpired ? 'bg-gray-400 hover:bg-gray-400 cursor-not-allowed pointer-events-none' : '' }}">
                                {{ $isExpired ? 'Tutup' : 'Lihat Detail' }}
                            </a>
                        </div>
                        <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">
                        <div class="self-stretch inline-flex justify-start items-center gap-2">
                            @if ($item->deadline_pendaftaran)
                                <span class="justify-start text-neutral-400 text-sm font-normal leading-none">
                                    @if ($isExpired)
                                        Pendaftaran ditutup
                                    @else
                                        {{ abs($daysLeft) }} hari tersisa
                                    @endif
                                </span>
                                <div class="w-1 h-1 bg-neutral-400 rounded-full"></div>
                            @endif
                            <span class="justify-start text-neutral-400 text-sm font-normal leading-none">
                                {{ $applicantCount }} Pelamar
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        @if (isset($filters['search']) && $filters['search'])
                            <div class="text-gray-500 text-lg">Tidak ada lowongan yang sesuai dengan pencarian
                                "{{ $filters['search'] }}"</div>
                            <div class="text-gray-400 text-sm mt-2">Coba kata kunci lain atau <a
                                    href="{{ route('mahasiswa.lowongan') }}"
                                    class="text-primary-500 hover:underline">lihat semua lowongan</a></div>
                        @else
                            <div class="text-gray-500 text-lg">Tidak ada lowongan yang sesuai dengan filter</div>
                            <div class="text-gray-400 text-sm mt-2">Coba ubah filter atau <a
                                    href="{{ route('mahasiswa.lowongan') }}"
                                    class="text-primary-500 hover:underline">reset semua filter</a></div>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Success Modal -->
    <div id="success-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="success-modal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all max-w-fit w-auto m-3 mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="success-modal-label" class="font-bold text-neutral-900 dark:text-white">
                        <div class="flex items-center gap-2">
                            Lamar posisi {{ $lowongan->judul_lowongan }}
                        </div>
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#success-modal">
                        <span class="sr-only">Close</span>
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 6-12 12" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-start mb-6">
                        <p id="success-message" class="mt-2 text-lg text-neutral-900 font-medium dark:text-neutral-900">

                        </p>
                    </div>

                    <!-- Documents List Container -->
                    <div id="documents-container" class="space-y-4">
                        <!-- Documents will be populated here via JavaScript -->
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800"
                        data-hs-overlay="#success-modal">
                        Tutup
                    </button>
                    <button id="continue-application-btn" type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                        Lanjutkan Pendaftaran
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="error-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="error-modal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="error-modal-label" class="font-bold text-red-800 dark:text-white">
                        <div class="flex items-center gap-2">
                            Dokumen Belum Lengkap
                        </div>
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#error-modal">
                        <span class="sr-only">Close</span>
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 6-12 12" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-x-circle class="h-8 w-8 text-red-600" />
                        </div>
                        <div id="error-message" class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            <p class="mb-3">Dokumen Anda belum lengkap untuk mendaftar magang ini.</p>
                            <div id="missing-documents-list"
                                class="bg-red-50 border border-red-200 rounded-lg p-3 text-left">
                                <!-- Missing documents will be populated here -->
                            </div>
                            <p class="mt-3 text-sm text-gray-600">Silakan lengkapi dokumen di halaman profil terlebih
                                dahulu.</p>
                        </div>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800"
                        data-hs-overlay="#error-modal">
                        Tutup
                    </button>
                    <button id="go-to-profile-btn" type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        Ke Halaman Profil
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Test Upload Modal -->
    <div id="test-upload-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="test-upload-modal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="test-upload-modal-label" class="font-bold text-neutral-900 dark:text-white">
                        <div class="flex items-center gap-2">
                            <x-lucide-file class="w-5 h-5 text-primary-600" />
                            Upload File Test
                        </div>
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#test-upload-modal">
                        <span class="sr-only">Close</span>
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 6-12 12" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
                <form id="test-upload-form" enctype="multipart/form-data">
                    <div class="p-4 overflow-y-auto">
                        <div class="text-center mb-6">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <x-lucide-cloud-upload class="h-8 w-8 text-blue-600" />
                            </div>
                            <p class="text-sm text-gray-600 dark:text-neutral-400 mb-4">
                                Silakan upload file test yang diperlukan untuk posisi ini.
                            </p>
                        </div>

                        <!-- File Upload Area -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-center w-full">
                                <label for="test-file-input"
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <x-lucide-cloud-upload class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" />
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PDF, DOC, DOCX, JPG, PNG (MAX.
                                            5MB)</p>
                                    </div>
                                    <input id="test-file-input" name="test_file" type="file" class="hidden"
                                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required />
                                </label>
                            </div>

                            <!-- Selected file display -->
                            <div id="selected-file-info" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <div class="flex items-center gap-3">
                                    <x-lucide-cloud-upload class="w-5 h-5 text-blue-600" />
                                    <div class="flex-1">
                                        <p id="file-name" class="text-sm font-medium text-blue-900"></p>
                                        <p id="file-size" class="text-xs text-blue-600"></p>
                                    </div>
                                    <button type="button" id="remove-file" class="text-gray-500 hover:text-gray-700">
                                        <x-lucide-x class="w-4 h-4" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800"
                            data-hs-overlay="#test-upload-modal">
                            Batal
                        </button>
                        <button id="submit-application-btn" type="submit"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-600 disabled:opacity-50 disabled:pointer-events-none">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Ajukan Magang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let hasTest = false; // Kembali ke nama asli yang lebih mudah dipahami
        const currentLowonganId = {{ $lowongan->id_lowongan }};

        document.addEventListener('DOMContentLoaded', function() {
            const checkDocumentsBtn = document.getElementById('check-documents-btn');

            if (checkDocumentsBtn) {
                checkDocumentsBtn.addEventListener('click', function() {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memeriksa...';
                    this.disabled = true;

                    fetch(`/mahasiswa/lowongan/${currentLowonganId}/check-documents`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // has_test dari controller: true jika test = 1 (ADA test)
                                hasTest = data.has_test;

                                console.log('Data dari server:', {
                                    has_test: data.has_test,
                                    hasTest: hasTest
                                });

                                // Update button text based on test requirement
                                const continueBtn = document.getElementById('continue-application-btn');
                                if (hasTest) {
                                    console.log('ADA TEST - Perlu upload file test');
                                    // ADA test (test = 1) - perlu upload file
                                    continueBtn.innerHTML = `
                                    <x-lucide-upload class="w-4 h-4 mr-2" />
                                    Lanjutkan dengan Upload Test
                                `;
                                } else {
                                    console.log('TIDAK ADA TEST - Langsung apply');
                                    // TIDAK ADA test (test = 0) - langsung apply
                                    continueBtn.innerHTML = `
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Ajukan Magang
                                `;
                                }

                                // Success Modal - Documents Complete
                                document.getElementById('success-message').textContent = data.message;

                                // Populate documents list
                                const documentsContainer = document.getElementById('documents-container');
                                if (data.documents && data.documents.length > 0) {
                                    let html = '';

                                    // Group documents in rows of 2
                                    for (let i = 0; i < data.documents.length; i += 2) {
                                        const doc1 = data.documents[i];
                                        const doc2 = data.documents[i + 1];

                                        if (doc2) {
                                            html += `
                                            <div class="flex flex-row gap-4">
                                                ${createDocumentCard(doc1)}
                                                ${createDocumentCard(doc2)}
                                            </div>
                                        `;
                                        } else {
                                            html += `
                                            <div class="flex flex-row gap-4">
                                                ${createDocumentCard(doc1)}
                                            </div>
                                        `;
                                        }
                                    }

                                    documentsContainer.innerHTML = html;
                                }

                                showModal('success-modal');
                            } else {
                                // Error Modal - Documents Incomplete
                                document.getElementById('error-message').querySelector('p').textContent = data.message;

                                const missingDocsList = document.getElementById('missing-documents-list');
                                if (data.missing_documents && data.missing_documents.length > 0) {
                                    missingDocsList.innerHTML = `
                                    <p class="font-medium text-red-800 mb-2">Dokumen yang masih diperlukan:</p>
                                    <ul class="list-disc list-inside text-red-700 space-y-1">
                                        ${data.missing_documents.map(doc => `<li>${doc}</li>`).join('')}
                                    </ul>
                                `;
                                } else {
                                    missingDocsList.innerHTML = '';
                                }

                                showModal('error-modal');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            document.getElementById('error-message').querySelector('p').textContent =
                                'Terjadi kesalahan saat memeriksa dokumen. Silakan coba lagi.';
                            document.getElementById('missing-documents-list').innerHTML = '';
                            showModal('error-modal');
                        })
                        .finally(() => {
                            this.innerHTML = originalText;
                            this.disabled = false;
                        });
                });
            }

            // Handle continue application button
            document.getElementById('continue-application-btn').addEventListener('click', function() {
                console.log('Continue button clicked, hasTest:', hasTest);
                
                // Close success modal
                HSOverlay.close(document.getElementById('success-modal'));

                if (hasTest) {
                    console.log('Showing test upload modal');
                    // ADA test (test = 1) - tampilkan modal upload
                    showModal('test-upload-modal');
                } else {
                    console.log('Applying directly without test upload');
                    // TIDAK ADA test (test = 0) - langsung apply
                    applyInternship();
                }
            });

            // Handle test file upload form
            document.getElementById('test-upload-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const fileInput = document.getElementById('test-file-input');
                if (!fileInput.files[0]) {
                    alert('Silakan pilih file test terlebih dahulu.');
                    return;
                }

                console.log('Submitting with file:', fileInput.files[0].name);
                applyInternship(new FormData(this));
            });

            // Handle file input change
            document.getElementById('test-file-input').addEventListener('change', function(e) {
                const file = e.target.files[0];
                const fileInfo = document.getElementById('selected-file-info');
                const fileName = document.getElementById('file-name');
                const fileSize = document.getElementById('file-size');

                if (file) {
                    fileName.textContent = file.name;
                    fileSize.textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB`;
                    fileInfo.classList.remove('hidden');
                } else {
                    fileInfo.classList.add('hidden');
                }
            });

            // Handle remove file
            document.getElementById('remove-file').addEventListener('click', function() {
                document.getElementById('test-file-input').value = '';
                document.getElementById('selected-file-info').classList.add('hidden');
            });

            // Handle go to profile button
            document.getElementById('go-to-profile-btn').addEventListener('click', function() {
                window.location.href = '{{ route('mahasiswa.edit_profile') }}';
            });

            function showModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal && window.HSOverlay) {
                    HSOverlay.open(modal);
                } else {
                    modal.classList.remove('hidden');
                    modal.classList.add('hs-overlay-open');
                }
            }

            function applyInternship(formData = null) {
                const submitBtn = document.getElementById('submit-application-btn');
                const originalText = submitBtn ? submitBtn.innerHTML : '';

                console.log('applyInternship called with formData:', formData ? 'Yes' : 'No');

                if (submitBtn) {
                    submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...';
                    submitBtn.disabled = true;
                }

                const fetchOptions = {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                };

                if (formData) {
                    fetchOptions.body = formData;
                } else {
                    fetchOptions.headers['Content-Type'] = 'application/json';
                }

                fetch(`/mahasiswa/lowongan/${currentLowonganId}/apply`, fetchOptions)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Apply response:', data);
                        if (data.success) {
                            if (hasTest) {
                                HSOverlay.close(document.getElementById('test-upload-modal'));
                            }
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Apply error:', error);
                        alert('Terjadi kesalahan saat mengajukan magang. Silakan coba lagi.');
                    })
                    .finally(() => {
                        if (submitBtn) {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }
                    });
            }
        });

        // Helper function to create document card (tetap sama)
        function createDocumentCard(doc) {
            const capitalizedDocType = doc.jenis_dokumen.charAt(0).toUpperCase() + doc.jenis_dokumen.slice(1);

            return `
                <div class="flex flex-col gap-3 rounded-xl bg-neutral-50 p-4" style="width: 220px;">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="text-neutral-900 text-sm font-medium truncate flex-1">${capitalizedDocType}</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500 truncate">${doc.tanggal_upload}</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500 truncate">${doc.ukuran_file}</span>
                        </div>
                    </div>
                    <div class="flex justify-start">
                        <a href="${doc.url_dokumen}" target="_blank"
                            class="inline-flex items-center justify-center w-full px-4 py-2 border border-primary-500 rounded-lg text-primary-500 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm font-medium transition">
                            <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat Dokumen
                        </a>
                    </div>
                </div>
            `;
        }
    </script>
@endsection
