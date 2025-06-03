@extends('layout.template')
@section('content')
    <div class="flex flex-col gap-6 w-full bg-white p-4 rounded-md">
        <div class="flex gap-2 mb-4">
            <a href="{{ route('mahasiswa.rincian_diterima') }}"
                class="px-4 py-2 rounded-lg text-sm font-medium border border-primary-500 bg-primary-50 text-primary-600">
                Diterima
            </a>
            <a href="{{ route('mahasiswa.rincian_ditolak') }}"
                class="px-4 py-2 rounded-lg text-sm font-medium border border-red-500 text-red-600 bg-red-50 hover:bg-red-100 transition">
                Ditolak
            </a>
            <a href="{{ route('mahasiswa.rincian_magang') }}"
                class="px-4 py-2 rounded-lg text-sm font-medium border border-blue-500 text-blue-600 bg-blue-50 hover:bg-blue-100 transition">
                Magang
            </a>
        </div>
        <div class="flex flex-col justify-start ">
            <div class="mb-4">
                <h2 class="text-xl font-medium text-black">Rincian Magang</h2>
            </div>
            <div class="flex gap-9">
                <img class="w-30 h-30" src="{{ asset('Images/LOGOPT.png') }}">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-4 items-start">
                        <div class="flex gap-4">
                            <h4 class="text-xl font-medium">UI UX Designer</h4>
                            @php
                                $statusLabel = 'Menunggu';
                                $statusColor = 'border-yellow-500 bg-white text-yellow-500';
                                if ($status === 'diterima') {
                                    $statusLabel = 'Diterima';
                                    $statusColor = 'border-teal-500 bg-white text-teal-500';
                                } elseif ($status === 'ditolak') {
                                    $statusLabel = 'Ditolak';
                                    $statusColor = 'border-red-500 bg-white text-red-500';
                                } elseif ($status === 'magang') {
                                    $statusLabel = 'Magang';
                                    $statusColor = 'border-blue-500 bg-white text-blue-500';
                                } elseif ($status === 'selesai') {
                                    $statusLabel = 'Selesai';
                                    $statusColor = 'border-gray-500 bg-white text-gray-500';
                                }

                            @endphp
                            <span
                                class="inline-flex text-center items-center gap-x-1.5 py-1.5 px-2.5 rounded-md text-xs font-medium border tracking-tighter{{ $statusColor }}">
                                {{ $statusLabel }}
                            </span>
                        </div>
                        <p class="text-primary-500 text-base font-normal">
                            PT. Quantum Technology Nusantara
                        </p>
                    </div>
                    <div class="flex flex-row items-center gap-10">
                        <div class="flex flex-col gap-2">
                            <span class="flex items-center gap-3 text-base text-neutral-700">
                                <x-lucide-map-pin class="w-6 h-6 text-neutral-500 text-2xl" />
                                <p>Jakarta Selatan, DKI Jakarta, Indonesia</p>
                            </span>
                            <span class="flex items-center gap-3 text-base text-neutral-700">
                                <x-lucide-calendar-days class="w-6 h-6 text-neutral-500 text-2xl" />
                                <p>Ganjil 2026</p>
                            </span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <span class="flex items-center gap-3 text-base text-neutral-700">
                                <x-lucide-laptop class="w-6 h-6 text-neutral-500 text-2xl" />
                                <p>UI/UX Design</p>
                            </span>
                            <span class="flex items-center gap-3 text-base text-neutral-700">
                                <x-lucide-building-2 class="w-6 h-6 text-neutral-500 text-2xl" />
                                <p>WFO</p>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-6 w-full bg-white p-4 rounded-md border border-neutral-200 h-52">
            <h2 class="font-medium text-xl">Deskripsi Lowongan</h2>
            <div class="flex flex-col gap-2">
                <p id="descText" class="text-neutral-400 text-sm line-clamp-3">
                    We are seeking a skilled and detail-focused UI/UX Designer to develop engaging, user-friendly interfaces
                    and intuitive digital experiences. You will collaborate closely with product managers, developers, and
                    stakeholders to transform requirements into wireframes, prototypes, and polished designs that meet both
                    user needs and business objectives. As part of our team, you will also conduct user research, create
                    user flows, and ensure design consistency across all platforms. Your creativity and attention to detail
                    will help shape the future of our digital products.
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
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var expanded = false;
                        var btn = document.getElementById('toggleDescBtn');
                        var text = document.getElementById('descText');
                        var label = document.getElementById('toggleDescText');
                        var icon = document.getElementById('toggleDescIcon');
                        btn.addEventListener('click', function() {
                            expanded = !expanded;
                            if (expanded) {
                                text.classList.remove('line-clamp-3');
                                label.textContent = 'Lihat Lebih Sedikit';
                                icon.classList.add('rotate-180');
                            } else {
                                text.classList.add('line-clamp-3');
                                label.textContent = 'Lihat Lebih Banyak';
                                icon.classList.remove('rotate-180');
                            }
                        });
                    });
                </script>
            </div>
        </div>
        <div class="flex gap-3 mt-4 justify-end">
            <a href="{{ route('mahasiswa.rincian_magang') }}"
                class="px-4 py-3.5 rounded-lg text-sm font-semibold bg-primary-500 text-white hover:bg-primary-600 transition {{ $status === 'diterima' ? '' : 'hidden' }}">Mulai
                Magang</a>
            <button type="button" id="openSelesaiMagangModal"
                class="px-4 py-3.5 rounded-lg text-sm font-semibold bg-primary-500 text-white hover:bg-primary-600 transition {{ $status === 'magang' ? '' : 'hidden' }}">Selesaikan
                Magang</button>
            <a href="{{ route('mahasiswa.lowongan') }}"
                class="px-4 py-3.5 rounded-lg text-sm font-semibold bg-primary-500 text-white hover:bg-primary-600 transition {{ $status === 'ditolak' ? '' : 'hidden' }}">Ajukan
                Magang Lain</a>
        </div>

        <!-- Modal Selesaikan Magang -->
        <div id="selesaikanMagangModal" class="fixed inset-0 z-50 items-center justify-center hidden">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md mx-auto relative">
                <div class="p-6 inline-flex items-center justify-between">
                    <button type="button" id="closeSelesaiMagangModal"
                        class="absolute top-7 right-6 text-gray-400 hover:text-gray-600">
                        <span class="sr-only">Tutup</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <h3 class="text-lg font-semibold">Selesaikan Magang</h3>
                </div>
                <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700 w-full">
                <div class="p-6 gap-4">
                    <p class="text-sm text-gray-700 mb-2">Selesaikan magang dengan mengunggah sertifikat magang yang telah
                        Anda
                        dapatkan.</p>
                    <p class="text-sm text-red-500 font-medium mb-4">Tindakan ini tidak dapat dibatalkan!</p>
                    <form>
                        <label class="block text-sm font-medium mb-1">Unggah Sertifikat Magang</label>
                        <div class="flex items-center gap-2">
                            <label for="fileSertifikat"
                                class="flex items-center gap-2 px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 cursor-pointer hover:bg-gray-100 text-gray-500 text-sm w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12" />
                                </svg>
                                <span id="fileSertifikatLabel">Unggah Sertifikat Magang</span>
                                <input id="fileSertifikat" name="fileSertifikat" type="file" class="hidden"
                                    accept="application/pdf,image/*">
                            </label>
                        </div>
                </div>
                <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700 w-full">
                <div class="flex justify-end gap-2 p-6">
                    <button type="button" id="batalSelesaiMagang"
                        class="px-4 py-2 rounded-lg border items-center border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-medium">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-primary-500 text-white font-semibold hover:bg-primary-600"
                        id="submitSelesaiMagangBtn">Selesaikan Magang</button>
                </div>
                </form>
            </div>
        </div>
        <script>
            // Modal logic
            document.addEventListener('DOMContentLoaded', function() {
                var openBtn = document.getElementById('openSelesaiMagangModal');
                var modal = document.getElementById('selesaikanMagangModal');
                var closeBtn = document.getElementById('closeSelesaiMagangModal');
                var batalBtn = document.getElementById('batalSelesaiMagang');
                var fileInput = document.getElementById('fileSertifikat');
                var fileLabel = document.getElementById('fileSertifikatLabel');
                var submitBtn = document.getElementById('submitSelesaiMagangBtn');
                if (openBtn && modal) {
                    openBtn.addEventListener('click', function() {
                        modal.classList.remove('hidden');
                    });
                }
                if (closeBtn && modal) {
                    closeBtn.addEventListener('click', function() {
                        modal.classList.add('hidden');
                    });
                }
                if (batalBtn && modal) {
                    batalBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        modal.classList.add('hidden');
                    });
                }
                if (fileInput && fileLabel) {
                    fileInput.addEventListener('change', function() {
                        if (fileInput.files.length > 0) {
                            fileLabel.textContent = fileInput.files[0].name;
                        } else {
                            fileLabel.textContent = 'Unggah Sertifikat Magang';
                        }
                    });
                }
                if (submitBtn) {
                    submitBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        window.location.href = "{{ route('mahasiswa.rincian_selesai') }}";
                    });
                }
            });
        </script>
    </div>
@endsection
