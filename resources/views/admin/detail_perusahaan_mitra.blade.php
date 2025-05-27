@extends('layout.template')
@section('content')
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
        <div class="flex flex-row gap-6">
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
        {{-- Lowongan Tersedia - Hard coded untuk sementara --}}
        <div class="h-fit rounded-lg space-y-3">
            <div class="flex justify-between items-center">
                <p class="text-xl font-medium text-neutral-900">Lowongan Tersedia</p>
            </div>
            <div class="space-y-4">
                <div class="flex flex-col gap-6">
                    <div class="bg-white h-fit w-full py-4 px-6 rounded-lg flex items-center gap-6">
                        <img src="{{ $perusahaan->logo ? asset('storage/' . $perusahaan->logo) : asset('Images/placeholder_perusahaan.png') }}" 
                             alt="Logo Perusahaan" class="w-20 h-20 rounded-lg object-cover">
                        <div class="flex flex-col gap-4 flex-1">
                            <div class="flex items-center gap-2">
                                <p class="text-xl font-medium text-neutral-900">UI UX Designer</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-lucide-calendar-days class="size-6 text-neutral-500" stroke-width="1.5" />
                                <p class="align-top text-base font-normal text-neutral-700">Ganjil 2026</p>
                            </div>
                        </div>
                        <button type="button" class="btn-primary-lg">
                            Lihat Detail
                        </button>
                    </div>
                    <div class="bg-white h-fit w-full py-4 px-6 rounded-lg flex items-center gap-6">
                        <img src="{{ $perusahaan->logo ? asset('storage/' . $perusahaan->logo) : asset('Images/placeholder_perusahaan.png') }}" 
                             alt="Logo Perusahaan" class="w-20 h-20 rounded-lg object-cover">
                        <div class="flex flex-col gap-4 flex-1">
                            <div class="flex items-center gap-2">
                                <p class="text-xl font-medium text-neutral-900">UI UX Designer</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-lucide-calendar-days class="size-6 text-neutral-500" stroke-width="1.5" />
                                <p class="align-top text-base font-normal text-neutral-700">Ganjil 2026</p>
                            </div>
                        </div>
                        <button type="button" class="btn-primary-lg">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
