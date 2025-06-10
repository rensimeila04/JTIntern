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

        @if ($magang->status_magang === 'selesai')
            <div class="flex flex-col mb-8">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y-2 divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 w-fit">
                                            Hari, Tanggal
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 w-48">
                                            Waktu
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 w-auto">
                                            Kegiatan
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 w-44">
                                            Status Feedback
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse($logAktivitas as $log)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                                {{ \Carbon\Carbon::parse($log->tanggal)->translatedFormat('l, d F Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                                @if ($log->jam_masuk && $log->jam_pulang)
                                                    {{ \Carbon\Carbon::parse($log->jam_masuk)->format('H:i') }} -
                                                    {{ \Carbon\Carbon::parse($log->jam_pulang)->format('H:i') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-800">
                                                {{ $log->kegiatan }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if ($log->feedback_dospem)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">
                                                        Dinilai
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-400 text-gray-400">
                                                        Belum Dinilai
                                                    </span>
                                                @endif
                                            </td>
                                            
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-6 text-gray-500">Belum ada data log
                                                aktivitas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                <div
                    class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto">
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
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

        {{-- Modal Success Selesai Magang - New Version --}}
        <div id="success-selesai-modal"
            class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none bg-black/50 dark:bg-neutral-900/80"
            role="dialog" tabindex="-1" aria-labelledby="success-selesai-modal-label">
            <div
                class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
                <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70"
                    id="success-modal-content">
                    <div
                        class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                        <h3 id="success-selesai-modal-label"
                            class="font-bold text-gray-800 dark:text-white flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4" />
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                            Magang Selesai
                        </h3>
                        <button type="button" onclick="closeSuccessModal()"
                            class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                            aria-label="Close" data-hs-overlay="#success-selesai-modal">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 overflow-y-auto">
                        <div class="mb-4 flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-14 w-14 text-green-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                    fill="#dcfce7" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4" stroke="#16a34a"
                                    stroke-width="3" fill="none" />
                            </svg>
                        </div>
                        <p class="text-gray-800 dark:text-neutral-300 text-center mb-2">
                            Magang kamu telah berhasil diselesaikan dan sertifikat berhasil diunggah.
                        </p>
                    </div>
                    <div
                        class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                        <button type="button" onclick="closeSuccessModal()"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                            Tutup
                        </button>
                        <a href="{{ route('mahasiswa.dashboard') }}"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-600 disabled:opacity-50 disabled:pointer-events-none">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function closeSuccessModal() {
                const modal = document.getElementById('success-selesai-modal');
                const content = document.getElementById('success-modal-content');
                const animTarget = modal.querySelector('.hs-overlay-animation-target');
                content.style.transform = 'scale(0.95)';
                content.style.opacity = '0';
                if (animTarget) {
                    animTarget.classList.remove('opacity-100', 'scale-100');
                    animTarget.classList.add('opacity-0', 'scale-95');
                }
                setTimeout(function() {
                    modal.classList.add('hidden');
                    modal.classList.add('pointer-events-none');
                }, 300);
            }

            function showSuccessModal() {
                const modal = document.getElementById('success-selesai-modal');
                const content = document.getElementById('success-modal-content');
                const animTarget = modal.querySelector('.hs-overlay-animation-target');
                modal.classList.remove('hidden');
                modal.classList.remove('pointer-events-none');
                if (animTarget) {
                    animTarget.classList.remove('opacity-0', 'scale-95');
                    animTarget.classList.add('opacity-100', 'scale-100');
                }
                setTimeout(function() {
                    content.style.transform = 'scale(1)';
                    content.style.opacity = '1';
                }, 50);
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Debug: check if session exists
                console.log('Page loaded');
                @if (session('success_selesai'))
                    console.log('Success session found!');
                    // Show modal immediately
                    showSuccessModal();
                @endif

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

                // Close modal on backdrop click
                document.getElementById('success-selesai-modal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeSuccessModal();
                    }
                });
            });
        </script>

    </div>
@endsection
