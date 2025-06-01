@extends('layout.template')
@section('content')
    @php
    use Carbon\Carbon;
    @endphp
    <div class="space-y-4">
        {{-- Detail Periode Magang --}}
        <div class="bg-white h-fit p-6 rounded-lg space-y-6">
            <div class="flex justify-between items-center">
                <p class="text-xl font-medium text-neutral-900">Detail Periode Magang</p>
            </div>
            <div class="flex items-center gap-8">
                <div class="flex items-center justify-center w-32 h-32 rounded-lg bg-primary-50">
                    <x-lucide-calendar-days class="w-16 h-16 text-primary-500" stroke-width="1.5" />
                </div>
                <div class="flex flex-col gap-6">
                    <p class="text-lg font-medium text-neutral-900">{{ $periodeMagang->nama_periode }}</p>
                    <div class="flex gap-8">
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">Tanggal Mulai</p>
                            <p class="text-sm font-semibold text-neutral-700">
                                {{ Carbon::parse($periodeMagang->tanggal_mulai)->format('d M Y') }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">Tanggal Selesai</p>
                            <p class="text-sm font-semibold text-neutral-700">
                                {{ Carbon::parse($periodeMagang->tanggal_selesai)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Informasi Periode --}}
        <div class="flex flex-row gap-4">
            <div class="w-1/2 p-6 bg-white rounded-xl flex flex-col gap-6">
                <div class="flex justify-between items-center">
                    <p class="text-xl font-medium text-neutral-900">Durasi</p>
                </div>
                <div class="flex gap-8">
                    <div class="flex flex-col gap-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                                <x-lucide-clock class="w-5 h-5 text-primary-600" stroke-width="1.5" />
                            </div>
                            <div>
                                <p class="text-lg font-medium text-neutral-900">
                                    {{ Carbon::parse($periodeMagang->tanggal_mulai)->diffInDays(Carbon::parse($periodeMagang->tanggal_selesai)) + 1 }} Hari
                                </p>
                                <p class="text-sm font-normal text-neutral-400">
                                    {{ Carbon::parse($periodeMagang->tanggal_mulai)->diffInWeeks(Carbon::parse($periodeMagang->tanggal_selesai)) }} Minggu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/2 p-6 bg-white rounded-xl flex flex-col gap-6">
                <div class="flex justify-between items-center">
                    <p class="text-xl font-medium text-neutral-900">Status</p>
                </div>
                <div class="flex gap-8">
                    <div class="flex flex-col gap-6">
                        <div class="flex items-center gap-3">
                            @php
                                $today = Carbon::now();
                                $startDate = Carbon::parse($periodeMagang->tanggal_mulai);
                                $endDate = Carbon::parse($periodeMagang->tanggal_selesai);
                                
                                if ($today->lt($startDate)) {
                                    $status = 'Akan Datang';
                                    $statusClass = 'bg-blue-100 text-blue-800';
                                    $iconClass = 'text-blue-600';
                                } elseif ($today->gt($endDate)) {
                                    $status = 'Selesai';
                                    $statusClass = 'bg-gray-100 text-gray-800';
                                    $iconClass = 'text-gray-600';
                                } else {
                                    $status = 'Sedang Berlangsung';
                                    $statusClass = 'bg-green-100 text-green-800';
                                    $iconClass = 'text-green-600';
                                }
                            @endphp
                            
                            <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                                @if ($status === 'Akan Datang')
                                    <x-lucide-hourglass class="w-5 h-5 {{ $iconClass }}" stroke-width="1.5" />
                                @elseif ($status === 'Sedang Berlangsung')
                                    <x-lucide-play class="w-5 h-5 {{ $iconClass }}" stroke-width="1.5" />
                                @else
                                    <x-lucide-check class="w-5 h-5 {{ $iconClass }}" stroke-width="1.5" />
                                @endif
                            </div>
                            <div>
                                <p class="text-lg font-medium text-neutral-900">
                                    <span class="px-3 py-1 text-sm font-medium rounded-full {{ $statusClass }}">
                                        {{ $status }}
                                    </span>
                                </p>
                                @if ($status === 'Akan Datang')
                                    <p class="text-sm font-normal text-neutral-400 mt-1">
                                        Dimulai dalam {{ $today->diffInDays($startDate) }} hari
                                    </p>
                                @elseif ($status === 'Sedang Berlangsung')
                                    <p class="text-sm font-normal text-neutral-400 mt-1">
                                        Berakhir dalam {{ $today->diffInDays($endDate) }} hari
                                    </p>
                                @else
                                    <p class="text-sm font-normal text-neutral-400 mt-1">
                                        Berakhir {{ $today->diffInDays($endDate) }} hari yang lalu
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Lowongan Terkait --}}
        <div class="h-fit rounded-lg space-y-3">
            <div class="flex justify-between items-center">
                <p class="text-xl font-medium text-neutral-900">Lowongan Terkait</p>
            </div>
            <div class="space-y-4">
                @if($periodeMagang->lowongan->count() > 0)
                    <div class="flex flex-col gap-6">
                        @foreach($periodeMagang->lowongan as $lowongan)
                            <div class="bg-white h-fit w-full py-4 px-6 rounded-lg flex items-center gap-6">
                                <img src="{{ $lowongan->perusahaanMitra->logo ? asset('storage/' . $lowongan->perusahaanMitra->logo) : asset('Images/placeholder_perusahaan.png') }}" 
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
                                    <div class="flex items-center gap-2">
                                        <x-lucide-building-2 class="size-5 text-neutral-500" stroke-width="1.5" />
                                        <p class="align-top text-base font-normal text-neutral-700">
                                            {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                                        </p>
                                    </div>
                                    @if($lowongan->kompetensi)
                                        <div class="flex items-center gap-2">
                                            <x-lucide-tag class="size-5 text-neutral-500" stroke-width="1.5" />
                                            <p class="align-top text-base font-normal text-neutral-700">
                                                {{ $lowongan->kompetensi->nama_kompetensi }}
                                            </p>
                                        </div>
                                    @endif
                                    @if($lowongan->deadline_pendaftaran)
                                        <div class="flex items-center gap-2">
                                            <x-lucide-clock class="size-5 text-amber-500" stroke-width="1.5" />
                                            <p class="align-top text-sm font-normal text-neutral-600">
                                                Deadline: {{ Carbon::parse($lowongan->deadline_pendaftaran)->format('d M Y') }}
                                            </p>
                                            @if(Carbon::parse($lowongan->deadline_pendaftaran)->isPast())
                                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                                    Expired
                                                </span>
                                            @elseif(Carbon::parse($lowongan->deadline_pendaftaran)->diffInDays() <= 7)
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
                                <p class="text-sm text-gray-500">Belum ada lowongan terkait periode ini</p>
                                <p class="text-xs text-gray-400 mt-1">Lowongan akan ditampilkan setelah perusahaan menambahkan lowongan untuk periode ini</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        {{-- Timeline --}}
        <div class="bg-white h-fit p-6 rounded-lg space-y-6">
            <div class="flex justify-between items-center">
                <p class="text-xl font-medium text-neutral-900">Timeline</p>
            </div>
            <div class="flex justify-center">
                <ol class="relative border-s border-gray-200 mx-4">
                    <li class="mb-10 ms-6">
                        <span class="absolute flex items-center justify-center w-8 h-8 bg-primary-100 rounded-full -start-4">
                            <x-lucide-calendar-plus class="w-4 h-4 text-primary-600" />
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">Dibuat</h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400">
                            {{ Carbon::parse($periodeMagang->created_at)->format('d M Y, H:i') }}
                        </time>
                    </li>
                    <li class="mb-10 ms-6">
                        <span class="absolute flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full -start-4">
                            <x-lucide-play class="w-4 h-4 text-blue-800" />
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">Mulai Periode</h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400">
                            {{ Carbon::parse($periodeMagang->tanggal_mulai)->format('d M Y') }}
                        </time>
                    </li>
                    <li class="ms-6">
                        <span class="absolute flex items-center justify-center w-8 h-8 bg-green-100 rounded-full -start-4">
                            <x-lucide-check class="w-4 h-4 text-green-800" />
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">Selesai Periode</h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400">
                            {{ Carbon::parse($periodeMagang->tanggal_selesai)->format('d M Y') }}
                        </time>
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection