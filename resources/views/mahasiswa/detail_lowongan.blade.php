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
                            @if($hasApplied)
                                <button disabled class="btn-secondary-lg cursor-not-allowed">
                                    <x-lucide-check class="w-5 h-5 mr-2" /> Sudah Diajukan
                                </button>
                            @elseif(!$lowongan->status_pendaftaran)
                                <button disabled class="btn-secondary-lg cursor-not-allowed">
                                    <x-lucide-x class="w-5 h-5 mr-2" /> Tidak Aktif
                                </button>
                            @elseif($lowongan->deadline_pendaftaran && now() > $lowongan->deadline_pendaftaran)
                                <button disabled class="btn-secondary-lg cursor-not-allowed">
                                    <x-lucide-clock class="w-5 h-5 mr-2" /> Deadline Lewat
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
                    <h1 class="text-lg font-medium text-neutral-900">{{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}</h1>
                    <div class="flex flex-row gap-9">
                        <div class="flex flex-col gap-2">
                            <p class="text-base font-normal text-neutral-400">Jenis Perusahaan</p>
                            <p class="text-base font-normal text-neutral-700">{{ $lowongan->perusahaanMitra->jenisPerusahaan->nama_jenis_perusahaan}}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-base font-normal text-neutral-400">Bidang Industri</p>
                            <p class="text-base font-normal text-neutral-700">{{ $lowongan->perusahaanMitra->bidang_industri }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fles flex-col gap-2">
                <p class="text-xl font-medium text-neutral-900">Deskripsi</p>
                <p class="text-base font-normal text-neutral-400 whitespace-pre-line">
                    {{ $lowongan->perusahaanMitra->tentang ? $lowongan->perusahaanMitra-> tentang : 'Tidak ada deskripsi' }}
                </p>
            </div>
        </div>

        <div class="space-y-4">
            <h1 class="font-medium text-xl text-start">
                Lowongan Lainya
            </h1>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-4 w-full relative z-10">
                @forelse ($lowonganList as $lowongan)
                    @php
                        $wibNow = now('Asia/Jakarta');
                        $deadline = $lowongan->deadline_pendaftaran ? 
                            \Carbon\Carbon::parse($lowongan->deadline_pendaftaran)->setTimezone('Asia/Jakarta') : null;
                        $daysLeft = $deadline ? $deadline->diffInDays($wibNow, false) : null;
                        $applicantCount = $lowongan->magang()->count();
                        $isExpired = $deadline && $deadline->isPast();
                    @endphp
                    <div class="bg-white flex-col rounded-xl flex py-6 px-4 gap-4 relative z-0 {{ $isExpired ? 'opacity-75' : '' }}">
                        <div class="inline-flex items-center gap-6">
                            <img src="{{ $lowongan->perusahaanMitra->logo ? $lowongan->perusahaanMitra->logo_url : asset('images/placeholder_perusahaan.png') }}" 
                                 alt="Logo {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}"
                                 class="w-20 h-20 rounded-lg object-contain bg-gray-50">
                            <div class="flex flex-col flex-1 justify-start items-start gap-2 h-fill cursor-pointer" 
                                 onclick="window.location.href='{{ route('mahasiswa.lowongan.detail', $lowongan->id_lowongan) }}'">
                                <div class="self-stretch inline-flex justify-start items-center gap-4">
                                    <div class="justify-start text-black text-lg font-medium leading-none hover:text-primary-600 transition-colors">
                                        {{ $lowongan->judul_lowongan }}
                                    </div>
                                </div>
                                <div class="inline-flex justify-start items-center gap-2">
                                    <span class="justify-start text-neutral-400 text-sm font-normal leading-none truncate max-w-[120px]">
                                        {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                                    </span>
                                    <div class="w-1 h-1 bg-neutral-400 rounded-full flex-shrink-0"></div>
                                    <span class="justify-start text-neutral-400 text-sm font-normal leading-none truncate max-w-[150px]">
                                        {{ $lowongan->perusahaanMitra->alamat }}
                                    </span>
                                </div>
                                <div class="inline-flex justify-start items-start gap-2">
                                    <span class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">
                                        {{ strtoupper($lowongan->jenis_magang) }}
                                    </span>
                                    <span class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">
                                        {{ $lowongan->perusahaanMitra->jenisPerusahaan->nama_jenis_perusahaan }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('mahasiswa.lowongan.detail', $lowongan->id_lowongan) }}"
                                class="ml-auto py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-600 disabled:opacity-50 disabled:pointer-events-none {{ $isExpired ? 'bg-gray-400 hover:bg-gray-400 cursor-not-allowed pointer-events-none' : '' }}">
                                {{ $isExpired ? 'Tutup' : 'Lihat Detail' }}
                            </a>
                        </div>
                        <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">
                        <div class="self-stretch inline-flex justify-start items-center gap-2">
                            @if($lowongan->deadline_pendaftaran)
                                <span class="justify-start text-neutral-400 text-sm font-normal leading-none">
                                    @if($isExpired)
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
                        @if(isset($filters['search']) && $filters['search'])
                            <div class="text-gray-500 text-lg">Tidak ada lowongan yang sesuai dengan pencarian "{{ $filters['search'] }}"</div>
                            <div class="text-gray-400 text-sm mt-2">Coba kata kunci lain atau <a href="{{ route('mahasiswa.lowongan') }}" class="text-primary-500 hover:underline">lihat semua lowongan</a></div>
                        @else
                            <div class="text-gray-500 text-lg">Tidak ada lowongan yang sesuai dengan filter</div>
                            <div class="text-gray-400 text-sm mt-2">Coba ubah filter atau <a href="{{ route('mahasiswa.lowongan') }}" class="text-primary-500 hover:underline">reset semua filter</a></div>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Success Modal -->
    <div id="success-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="success-modal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="success-modal-label" class="font-bold text-green-800 dark:text-white">
                        <div class="flex items-center gap-2">
                            Dokumen Lengkap
                        </div>
                    </h3>
                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#success-modal">
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
                            <svg class="h-8 w-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p id="success-message" class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Semua dokumen telah lengkap. Anda dapat melanjutkan proses pendaftaran magang.
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800" data-hs-overlay="#success-modal">
                        Tutup
                    </button>
                    <button id="continue-application-btn" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        Lanjutkan Pendaftaran
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="error-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="error-modal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="error-modal-label" class="font-bold text-red-800 dark:text-white">
                        <div class="flex items-center gap-2">
                            Dokumen Belum Lengkap
                        </div>
                    </h3>
                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#error-modal">
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
                            <svg class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div id="error-message" class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            <p class="mb-3">Dokumen Anda belum lengkap untuk mendaftar magang ini.</p>
                            <div id="missing-documents-list" class="bg-red-50 border border-red-200 rounded-lg p-3 text-left">
                                <!-- Missing documents will be populated here -->
                            </div>
                            <p class="mt-3 text-sm text-gray-600">Silakan lengkapi dokumen di halaman profil terlebih dahulu.</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800" data-hs-overlay="#error-modal">
                        Tutup
                    </button>
                    <button id="go-to-profile-btn" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        Ke Halaman Profil
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkDocumentsBtn = document.getElementById('check-documents-btn');

            if (checkDocumentsBtn) {
                checkDocumentsBtn.addEventListener('click', function() {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memeriksa...';
                    this.disabled = true;

                    fetch(`{{ route('mahasiswa.lowongan.check-documents', $lowongan->id_lowongan) }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Success Modal - Documents Complete
                            document.getElementById('success-message').textContent = data.message;
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
                        document.getElementById('error-message').querySelector('p').textContent = 'Terjadi kesalahan saat memeriksa dokumen. Silakan coba lagi.';
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
                // Close modal first
                const successModal = document.getElementById('success-modal');
                if (successModal.classList.contains('hs-overlay-open')) {
                    // You can add logic here to proceed with the application
                    // For now, just close the modal
                    HSOverlay.close(successModal);
                }
                // Add your application logic here
                console.log('Proceeding with application...');
            });

            // Handle go to profile button
            document.getElementById('go-to-profile-btn').addEventListener('click', function() {
                // Redirect to profile page
                window.location.href = '{{ route("mahasiswa.edit_profile") }}';
            });

            function showModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal && window.HSOverlay) {
                    HSOverlay.open(modal);
                } else {
                    // Fallback if HSOverlay is not available
                    modal.classList.remove('hidden');
                    modal.classList.add('hs-overlay-open');
                }
            }
        });
    </script>
@endsection
