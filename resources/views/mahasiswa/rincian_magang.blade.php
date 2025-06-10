@extends('layout.template')
@section('content')
    <div class="flex flex-col gap-6 w-full bg-white p-4 rounded-md">

        <div class="flex flex-col justify-start ">
            <div class="mb-4">
                <h2 class="text-xl font-medium text-black">Rincian Magang</h2>
            </div>

            @if (isset($message))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                    {{ $message }}
                </div>
            @elseif($magang)
                <div class="flex gap-9">
                    <img class="w-30 h-30 rounded-xl object-cover"
                        src="{{ $magang->lowongan->perusahaan->logo_perusahaan ?? asset('Images/placeholder_perusahaan.png') }}">
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col gap-4 items-start">
                            <div class="flex gap-4">
                                <h4 class="text-xl font-medium">{{ $magang->lowongan->judul_lowongan }}</h4>
                                @php
                                    $statusLabel = 'Menunggu';
                                    $statusColor = 'border-yellow-500 bg-white text-yellow-500';
                                    if ($magang->status_magang === 'diterima') {
                                        $statusLabel = 'Diterima';
                                        $statusColor = 'border-teal-500 bg-white text-teal-500';
                                    } elseif ($magang->status_magang === 'ditolak') {
                                        $statusLabel = 'Ditolak';
                                        $statusColor = 'border-red-500 bg-white text-red-500';
                                    } elseif ($magang->status_magang === 'magang') {
                                        $statusLabel = 'Magang';
                                        $statusColor = 'border-blue-500 bg-white text-blue-500';
                                    } elseif ($magang->status_magang === 'selesai') {
                                        $statusLabel = 'Selesai';
                                        $statusColor = 'border-gray-500 bg-white text-gray-500';
                                    }
                                @endphp
                                <span
                                    class="inline-flex text-center items-center gap-x-1.5 py-1.5 px-2.5 rounded-md text-xs font-medium border tracking-tighter {{ $statusColor }}">
                                    {{ $statusLabel }}
                                </span>
                            </div>
                            <p class="text-primary-500 text-base font-normal">
                                {{ $magang->lowongan->perusahaan->nama_perusahaan }}
                            </p>
                        </div>
                        <div class="flex flex-row items-center gap-10">
                            <div class="flex flex-col gap-2">
                                <span class="flex items-center gap-3 text-base text-neutral-700">
                                    <x-lucide-map-pin class="w-6 h-6 text-neutral-500 text-2xl" />
                                    <p>{{ $magang->lowongan->perusahaan->alamat }}</p>
                                </span>
                                <span class="flex items-center gap-3 text-base text-neutral-700">
                                    <x-lucide-calendar-days class="w-6 h-6 text-neutral-500 text-2xl" />
                                    <p>{{ $magang->lowongan->periode->nama_periode ?? 'Ganjil 2026' }}</p>
                                </span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <span class="flex items-center gap-3 text-base text-neutral-700">
                                    <x-lucide-laptop class="w-6 h-6 text-neutral-500 text-2xl" />
                                    <p>{{ $magang->lowongan->kompetensi->nama_kompetensi ?? 'Tidak tersedia' }}</p>
                                </span>
                                <span class="flex items-center gap-3 text-base text-neutral-700">
                                    <x-lucide-building-2 class="w-6 h-6 text-neutral-500 text-2xl" />
                                    <p>{{ $magang->lowongan->jenis_magang }}</p>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        @if ($magang)
            <div class="flex flex-col gap-6 w-full bg-white p-4 rounded-md border border-neutral-200 h-52">
                <h2 class="font-medium text-xl">Deskripsi Lowongan</h2>
                <div class="flex flex-col gap-2">
                    <p id="descText" class="text-neutral-400 text-sm line-clamp-3">
                        {{ $magang->lowongan->deskripsi }}
                    </p>
                    <button type="button" id="toggleDescBtn"
                        class="inline-flex items-center gap-x-2 text-sm font-medium rounded-lg text-primary-500 hover:underline w-fit mt-1">
                        <span id="toggleDescText">Lihat Lebih Banyak</span>
                        <svg id="toggleDescIcon" class="transition-transform size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        {{-- Button berdasarkan status magang --}}
        @if ($magang && $magang->status_magang === 'diterima')
            <div class="flex justify-end">
                <button type="button" id="openMulaiMagangModal"
                    class="btn-primary">
                    Mulai Magang
                </button>
            </div>
        @elseif ($magang && $magang->status_magang === 'magang')
            <div class="flex justify-end">
                <button type="button" id="openSelesaiMagangModal"
                    class="px-4 py-2 rounded-lg bg-primary-500 text-white font-semibold hover:bg-primary-600">
                    Selesaikan Magang
                </button>
            </div>
        @elseif ($magang && $magang->status_magang === 'ditolak')
            <div class="flex justify-end">
                <a href="{{ route('mahasiswa.lowongan') }}"
                    class="px-4 py-2 rounded-lg bg-red-500 text-white font-semibold hover:bg-red-600">
                    Ajukan Magang Lain
                </a>
            </div>
        @endif


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Toggle description functionality
                const toggleDescBtn = document.getElementById('toggleDescBtn');
                const descText = document.getElementById('descText');
                const toggleDescText = document.getElementById('toggleDescText');
                const toggleDescIcon = document.getElementById('toggleDescIcon');

                if (toggleDescBtn) {
                    toggleDescBtn.addEventListener('click', function() {
                        if (descText.classList.contains('line-clamp-3')) {
                            descText.classList.remove('line-clamp-3');
                            toggleDescText.textContent = 'Lihat Lebih Sedikit';
                            toggleDescIcon.style.transform = 'rotate(180deg)';
                        } else {
                            descText.classList.add('line-clamp-3');
                            toggleDescText.textContent = 'Lihat Lebih Banyak';
                            toggleDescIcon.style.transform = 'rotate(0deg)';
                        }
                    });
                }
            });
        </script>

    </div>
@endsection
