@extends('layout.template')
@section('content')
    @php
    use Carbon\Carbon;
    @endphp
    <div class="space-y-4">
        {{-- Detail Perusahaan Mitra --}}
        <div class="bg-white h-fit p-6 rounded-lg space-y-6">
            <div class="flex justify-between items-center">
                <p class="text-xl font-medium text-neutral-900">Detail Perusahaan Mitra</p>
            </div>
            <div class="flex items-center gap-8">
                <img src="{{ $perusahaan->logo ? asset('storage/' . $perusahaan->logo) : asset('Images/placeholder_perusahaan.png') }}" 
                     alt="Logo Perusahaan" class="w-32 h-32 rounded-lg object-cover">
                <div class="flex flex-col gap-6">
                    <p class="text-lg font-medium text-neutral-900">{{ $perusahaan->nama_perusahaan_mitra }}</p>
                    <div class="flex gap-8">
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">Jenis Perusahaan</p>
                            <p class="text-sm font-semibold text-neutral-700">
                                {{ $perusahaan->jenisPerusahaan->nama_jenis_perusahaan ?? '-' }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">Bidang Industri</p>
                            <p class="text-sm font-semibold text-neutral-700">{{ $perusahaan->bidang_industri }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Deskripsi & Kontak --}}
        <div class="flex flex-row gap-4">
            <div class="w-1/2 p-6 bg-white rounded-xl flex flex-col gap-6">
                <div class="flex justify-between items-center">
                    <p class="text-xl font-medium text-neutral-900">Deskripsi</p>
                </div>
                <div class="flex gap-8">
                    <div class="flex flex-col gap-6">
                        <p class="text-sm font-normal text-neutral-400">
                            {{ $perusahaan->tentang ?? 'Deskripsi belum tersedia.' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-1/2 p-6 bg-white rounded-xl flex flex-col gap-6">
                <div class="flex justify-between items-center">
                    <p class="text-xl font-medium text-neutral-900">Kontak</p>
                </div>
                <div class="flex gap-6">
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <i class="ph ph-map-pin text-primary-500 text-2xl"></i>
                            <p class="align-top text-sm font-normal text-neutral-700">{{ $perusahaan->alamat }}</p>
                        </div>
                        @if($perusahaan->telepon)
                        <div class="flex items-center gap-2">
                            <i class="ph ph-phone text-primary-500 text-2xl"></i>
                            <p class="align-top text-sm font-normal text-neutral-700">{{ $perusahaan->telepon }}</p>
                        </div>
                        @endif
                        @if($perusahaan->email)
                        <div class="flex items-center gap-2">
                            <i class="ph ph-envelope text-primary-500 text-2xl"></i>
                            <p class="align-top text-sm font-normal text-neutral-700">{{ $perusahaan->email }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Fasilitas Perusahaan --}}
        <div class="bg-white h-fit p-6 rounded-lg space-y-6">
            <div class="flex justify-between items-center">
                <p class="text-xl font-medium text-neutral-900">Fasilitas Perusahaan</p>
            </div>
            @if($perusahaan->fasilitasPerusahaan->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($perusahaan->fasilitasPerusahaan as $fasilitasPerusahaan)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                                    @switch($fasilitasPerusahaan->fasilitas->nama_fasilitas)
                                        @case('Workstation/Laptop')
                                            <i class="ph ph-laptop text-primary-600 text-lg"></i>
                                            @break
                                        @case('Internet/Wifi')
                                            <i class="ph ph-wifi-high text-primary-600 text-lg"></i>
                                            @break
                                        @case('Ruang Kerja')
                                            <i class="ph ph-buildings text-primary-600 text-lg"></i>
                                            @break
                                        @case('Tunjangan Makan')
                                            <i class="ph ph-fork-knife text-primary-600 text-lg"></i>
                                            @break
                                        @case('Tunjangan Transport')
                                            <i class="ph ph-car text-primary-600 text-lg"></i>
                                            @break
                                        @case('Ruang Meeting')
                                            <i class="ph ph-users text-primary-600 text-lg"></i>
                                            @break
                                        @case('Mentoring')
                                            <i class="ph ph-chats-circle text-primary-600 text-lg"></i>
                                            @break
                                        @case('Sertifikat Magang')
                                            <i class="ph ph-certificate text-primary-600 text-lg"></i>
                                            @break
                                        @case('Training/Workshop')
                                            <i class="ph ph-graduation-cap text-primary-600 text-lg"></i>
                                            @break
                                        @case('Pantry/Coffee Corner')
                                            <i class="ph ph-coffee text-primary-600 text-lg"></i>
                                            @break
                                        @default
                                            <i class="ph ph-check-circle text-primary-600 text-lg"></i>
                                    @endswitch
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-neutral-900 truncate">
                                    {{ $fasilitasPerusahaan->fasilitas->nama_fasilitas }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="ph ph-buildings text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-sm text-gray-500">Belum ada fasilitas yang terdaftar</p>
                        <p class="text-xs text-gray-400 mt-1">Fasilitas akan ditampilkan setelah ditambahkan</p>
                    </div>
                </div>
            @endif
        </div>
        
        {{-- Lowongan Tersedia --}}
        <div class="h-fit rounded-lg space-y-3">
            <div class="flex justify-between items-center">
                <p class="text-xl font-medium text-neutral-900">Lowongan Tersedia</p>
            </div>
            <div class="space-y-4">
                @if($perusahaan->lowongan->count() > 0)
                    <div class="flex flex-col gap-6">
                        @foreach($perusahaan->lowongan as $lowongan)
                            <div class="bg-white h-fit w-full py-4 px-6 rounded-lg flex items-center gap-6">
                                <img src="{{ $perusahaan->logo ? asset('storage/' . $perusahaan->logo) : asset('Images/placeholder_perusahaan.png') }}" 
                                     alt="Logo Perusahaan" class="w-20 h-20 rounded-lg object-cover">
                                <div class="flex flex-col gap-4 flex-1">
                                    <div class="flex items-center gap-2">
                                        <p class="text-xl font-medium text-neutral-900">{{ $lowongan->judul_lowongan }}</p>
                                        @if($lowongan->jenis_magang)
                                            <span class="px-2 py-1 text-xs font-medium rounded-full 
                                                @switch($lowongan->jenis_magang)
                                                    @case('wfo')
                                                        bg-blue-100 text-blue-800
                                                        @break
                                                    @case('remote')
                                                        bg-green-100 text-green-800
                                                        @break
                                                    @case('hybrid')
                                                        bg-purple-100 text-purple-800
                                                        @break
                                                    @default
                                                        bg-gray-100 text-gray-800
                                                @endswitch
                                            ">
                                                {{ strtoupper($lowongan->jenis_magang) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-2">
                                            <x-lucide-calendar-days class="size-6 text-neutral-500" stroke-width="1.5" />
                                            <p class="align-top text-base font-normal text-neutral-700">
                                                {{ $lowongan->periodeMagang->nama_periode ?? 'Periode tidak tersedia' }}
                                            </p>
                                        </div>
                                        @if($lowongan->kompetensi)
                                            <div class="flex items-center gap-2">
                                                <x-lucide-tag class="size-6 text-neutral-500" stroke-width="1.5" />
                                                <p class="align-top text-base font-normal text-neutral-700">
                                                    {{ $lowongan->kompetensi->nama_kompetensi }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                    @if($lowongan->deadline_pendaftaran)
                                        <div class="flex items-center gap-2">
                                            <x-lucide-clock class="size-5 text-amber-500" stroke-width="1.5" />
                                            <p class="align-top text-sm font-normal text-neutral-600">
                                                Deadline: {{ \Carbon\Carbon::parse($lowongan->deadline_pendaftaran)->format('d M Y') }}
                                            </p>
                                            @if(\Carbon\Carbon::parse($lowongan->deadline_pendaftaran)->isPast())
                                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                                    Expired
                                                </span>
                                            @elseif(\Carbon\Carbon::parse($lowongan->deadline_pendaftaran)->diffInDays() <= 7)
                                                <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                                    Segera Berakhir
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col gap-2">
                                    @if(!$lowongan->status_pendaftaran)
                                        <span class="px-3 py-2 text-sm font-medium bg-gray-100 text-gray-500 rounded-lg text-center">
                                            Pendaftaran Ditutup
                                        </span>
                                    @else
                                        <a href="{{ route('admin.lowongan.detail', $lowongan->id_lowongan) }}" 
                                           class="btn-primary-lg">
                                            Lihat Detail
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white h-fit w-full py-8 px-6 rounded-lg">
                        <div class="text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <x-lucide-briefcase class="w-8 h-8 text-gray-400" />
                                </div>
                                <p class="text-sm text-gray-500">Belum ada lowongan tersedia</p>
                                <p class="text-xs text-gray-400 mt-1">Lowongan akan ditampilkan setelah perusahaan menambahkan lowongan baru</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
