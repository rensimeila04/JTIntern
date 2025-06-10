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
                                {{ $magang->lowongan->perusahaan->nama_perusahaan_mitra }}
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
                <button type="button" class="btn-primary" aria-haspopup="dialog" aria-expanded="false"
                    aria-controls="hs-scale-animation-modal" data-hs-overlay="#hs-scale-animation-modal"
                    id="openMulaiMagangModal">
                    Mulai Magang
                </button>
            </div>
        @elseif ($magang && $magang->status_magang === 'magang')
            <div class="flex justify-end">
                <button type="button" class="btn-primary" aria-haspopup="dialog" aria-expanded="false"
                    aria-controls="selesaikan-magang-modal" data-hs-overlay="#selesaikan-magang-modal"
                    id="openSelesaiMagangModal">
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

        {{-- Modal Mulai Magang --}}
        <div id="hs-scale-animation-modal"
            class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
            <div
                class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
                <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto">
                    <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                        <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                            Mulai Magang Sekarang!
                        </h3>
                        <button type="button"
                            class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200"
                            aria-label="Close" data-hs-overlay="#hs-scale-animation-modal">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 overflow-y-auto flex flex-col items-center text-center">
                        <div class="mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-primary-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4" stroke="#16a34a"
                                    stroke-width="2" fill="none" />
                            </svg>
                        </div>
                        <p class="text-lg font-semibold text-gray-800 mb-2">
                            Selamat, kamu resmi diterima magang!
                        </p>
                        <p class="text-gray-600 mb-2">
                            Tekan <b>Mulai Magang</b> untuk mengubah status dan mulai aktivitas harianmu. Selamat menempuh
                            pengalaman baru!
                        </p>
                        <p class="text-primary-600 font-medium">
                            Jangan ragu untuk bertanya dan belajar sebanyak-banyaknya. Sukses selalu untuk langkah
                            pertamamu!
                        </p>
                    </div>
                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50"
                            data-hs-overlay="#hs-scale-animation-modal">
                            Batal
                        </button>
                        <form action="{{ route('mahasiswa.rincian.mulai-magang') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                    <circle cx="12" cy="12" r="10" />
                                </svg>
                                Mulai Magang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Selesaikan Magang --}}
        <div id="selesaikan-magang-modal"
            class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog" tabindex="-1" aria-labelledby="selesaikan-magang-modal-label">
            <div
                class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
                <div
                    class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto">
                    <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                        <h3 id="selesaikan-magang-modal-label" class="font-bold text-gray-800 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                            Selesaikan Magang
                        </h3>
                        <button type="button"
                            class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200"
                            aria-label="Close" data-hs-overlay="#selesaikan-magang-modal">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="{{ route('mahasiswa.rincian.selesaikan-magang') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="p-6 overflow-y-auto">
                            <div class="mb-4 flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-primary-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                        fill="#e0f2fe" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4"
                                        stroke="#16a34a" stroke-width="2" fill="none" />
                                </svg>
                            </div>
                            <p class="text-lg font-semibold text-gray-800 mb-2 text-center">
                                Upload Sertifikat Magang
                            </p>
                            <p class="text-gray-600 mb-4 text-center">
                                Unggah sertifikat magang sebagai bukti kamu telah menyelesaikan program magang.
                            </p>
                            <div class="mb-4">
                                <label for="fileSertifikat" class="block text-sm font-medium text-gray-700 mb-1">
                                    Sertifikat Magang <span class="text-red-500">*</span>
                                </label>
                                <div>
                                    <button type="button"
                                        class="relative flex w-full border overflow-hidden border-gray-200 shadow-2xs rounded-lg text-sm focus:outline-hidden focus:z-10 focus:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                        <span class="h-full py-3 px-4 bg-gray-100 text-nowrap">Pilih File</span>
                                        <span class="group grow flex overflow-hidden h-full py-3 px-4">
                                            <span id="fileSertifikatName" class="truncate">Belum ada file</span>
                                        </span>
                                        <input type="file" name="fileSertifikat" id="fileSertifikat"
                                            accept="application/pdf,image/*" required
                                            class="absolute inset-0 opacity-0 cursor-pointer w-full h-full"
                                            style="z-index:2;">
                                    </button>
                                </div>
                                <span class="text-xs text-gray-400 mt-1 block">Format: PDF/JPG/PNG, max 2MB</span>
                            </div>
                        </div>
                        <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                            <button type="button"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50"
                                data-hs-overlay="#selesaikan-magang-modal">
                                Batal
                            </button>
                            <button type="submit"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                    <circle cx="12" cy="12" r="10" />
                                </svg>
                                Selesaikan Magang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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

                const fileInput = document.getElementById('fileSertifikat');
                const fileNameSpan = document.getElementById('fileSertifikatName');
                if (fileInput && fileNameSpan) {
                    fileInput.addEventListener('change', function() {
                        if (this.files && this.files[0]) {
                            fileNameSpan.textContent = this.files[0].name;
                        } else {
                            fileNameSpan.textContent = 'Belum ada file';
                        }
                    });
                }
            });
        </script>

    </div>
@endsection
