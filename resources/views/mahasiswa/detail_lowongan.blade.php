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
                            <a href="" class="btn-primary-lg">
                                <x-lucide-briefcase class="w-5 h-5 mr-2" /> Ajukan Magang
                            </a>
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
@endsection
