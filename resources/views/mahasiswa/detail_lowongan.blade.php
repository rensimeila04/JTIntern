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
                            // Success Alert - Documents Complete
                            showAlert('success', data.message);
                        } else {
                            // Error Alert - Documents Incomplete
                            let errorMessage = data.message;
                            
                            if (data.missing_documents && data.missing_documents.length > 0) {
                                errorMessage += '\n\nDokumen yang masih diperlukan:';
                                errorMessage += '\n• ' + data.missing_documents.join('\n• ');
                                errorMessage += '\n\nSilakan lengkapi dokumen di halaman profil.';
                            }
                            
                            showAlert('error', errorMessage);
                        }
                    })
                    .catch(error => {
                        showAlert('error', 'Terjadi kesalahan saat memeriksa dokumen. Silakan coba lagi.');
                    })
                    .finally(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                    });
                });
            }

            function showAlert(type, message) {
                const alertDiv = document.createElement('div');
                alertDiv.className = `fixed top-4 right-4 max-w-sm p-4 rounded-lg shadow-lg z-50 ${
                    type === 'success' 
                        ? 'bg-green-100 border border-green-400 text-green-700' 
                        : 'bg-red-100 border border-red-400 text-red-700'
                }`;
                
                alertDiv.innerHTML = `
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            ${type === 'success' 
                                ? '<svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>'
                                : '<svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>'
                            }
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium whitespace-pre-line">${message}</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <button class="inline-flex text-gray-400 hover:text-gray-600" onclick="this.parentElement.parentElement.parentElement.remove()">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
                
                document.body.appendChild(alertDiv);
                
                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.remove();
                    }
                }, 5000);
            }
        });
    </script>
@endsection
