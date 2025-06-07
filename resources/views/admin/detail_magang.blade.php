@extends('layout.template')
@section('content')
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <p class="text-xl font-medium text-neutral-900">Detail Magang</p>
        </div>
        <div class="bg-white h-fit p-6 rounded-lg space-y-6">
            <div class="flex items-center gap-8">
                <img src="{{ $magang->mahasiswa->user->profile_photo ? asset('storage/' . $magang->mahasiswa->user->profile_photo) : asset('Images/avatar.svg') }}"
                    alt="Profile Picture" class="w-30 h-30 rounded-lg object-cover">
                <div class="flex flex-col gap-6">
                    <p class="text-lg font-medium text-neutral-900">{{ $magang->mahasiswa->user->name }}</p>
                    <div class="flex gap-8">
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">NIM</p>
                            <p class="text-sm font-semibold text-neutral-700">{{ $magang->mahasiswa->nim }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">Email</p>
                            <p class="text-sm font-semibold text-neutral-700">{{ $magang->mahasiswa->user->email }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">Program Studi</p>
                            <p class="text-sm font-semibold text-neutral-700">
                                {{ $magang->mahasiswa->programStudi->nama_prodi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full p-4 bg-white rounded-2xl flex flex-col gap-6">
            <div class="flex justify-between items-center w-full">
                <div class="text-neutral-900 text-xl font-medium">Dokumen Pendukung</div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                {{-- CV --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <x-lucide-file class="w-4 h-4 text-primary-600" />
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Curriculum Vitae</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs mt-auto">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">5 Mei 2025</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">234 KB</span>
                        </div>
                    </div>
                    <div class="flex justify-start mt-auto">
                        <a href="#" target="_blank"
                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-primary-500 rounded-lg text-primary-500 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </a>
                    </div>
                </div>
                {{-- Portofolio --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 ">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <x-lucide-image class="w-4 h-4 text-primary-600" />
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Portofolio</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs mt-auto">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">5 Mei 2025</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">234 KB</span>
                        </div>
                    </div>
                    <div class="flex justify-start mt-auto">
                        <a href="#" target="_blank"
                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-primary-500 rounded-lg text-primary-500 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </a>
                    </div>
                </div>
                {{-- Sertifikat --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="ph ph-medal w-4 h-4 text-primary-600"></i>
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Sertifikat</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs mt-auto">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">5 Mei 2025</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">234 KB</span>
                        </div>
                    </div>
                    <div class="flex justify-start mt-auto">
                        <a href="#" target="_blank"
                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-primary-500 rounded-lg text-primary-500 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </a>
                    </div>
                </div>
                {{-- Surat Pengantar --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 ">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="ph ph-envelope-simple w-4 h-4 text-primary-600"></i>
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Surat Pengantar</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs mt-auto">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">5 Mei 2025</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">234 KB</span>
                        </div>
                    </div>
                    <div class="flex justify-start mt-auto">
                        <a href="#" target="_blank"
                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-primary-500 rounded-lg text-primary-500 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </a>
                    </div>
                </div>
                {{-- Transkrip Nilai --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 ">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="ph ph-chart-line w-4 h-4 text-primary-600"></i>
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Transkrip Nilai</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs mt-auto">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">5 Mei 2025</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">234 KB</span>
                        </div>
                    </div>
                    <div class="flex justify-start mt-auto">
                        <a href="#" target="_blank"
                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-primary-500 rounded-lg text-primary-500 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Pengajuan Magang --}}
        <div class="h-fit rounded-lg space-y-3">
            <div class="space-y-4">
                <div class="bg-white h-fit w-full py-4 px-6 rounded-lg flex flex-col gap-6">
                    <div class="flex align-middle items-center gap-4">
                        <p class="text-xl font-medium text-neutral-900">Pengajuan Magang</p>
                        <div id="status-badge">
                            <span id="status-text"
                                class="inline-flex items-center h-[28px] gap-x-1.5 py-1 px-2 rounded-md text-xs font-medium 
                                @if ($magang->status_magang == 'menunggu') border border-yellow-500 text-yellow-500
                                @elseif($magang->status_magang == 'diterima') border border-green-500 text-green-500
                                @elseif($magang->status_magang == 'ditolak') border border-red-500 text-red-500
                                @elseif($magang->status_magang == 'magang') border border-blue-500 text-blue-500
                                @elseif($magang->status_magang == 'selesai') border border-gray-500 text-gray-500 @endif">
                                {{ ucfirst($magang->status_magang) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex gap-8">
                        <img src="{{ $magang->lowongan->perusahaanMitra->logo_perusahaan ? asset('storage/' . $magang->lowongan->perusahaanMitra->logo_perusahaan) : asset('Images/placeholder_perusahaan.png') }}"
                            alt="Company Logo" class="w-30 h-30 rounded-lg object-cover">
                        <div class="flex flex-col gap-6">
                            <div class="flex flex-col gap-3">
                                <p class="text-xl font-medium text-neutral-900">{{ $magang->lowongan->judul_lowongan }}</p>
                                <p class="text-base font-normal text-primary-500">
                                    {{ $magang->lowongan->perusahaanMitra->nama_perusahaan_mitra }}</p>
                                <div class="flex items-center gap-2">
                                    <x-lucide-map-pin class="w-6 h-6 text-neutral-500" stroke-width="1.5" />
                                    <p class="align-top text-base font-normal text-neutral-700">
                                        {{ $magang->lowongan->perusahaanMitra->alamat ?? 'Tidak Tersedia' }}</p>
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <x-lucide-calendar-days class="w-6 h-6 text-neutral-500" stroke-width="1.5"/>
                                    <p class="align-top text-base font-normal text-neutral-700">
                                        {{ $magang->lowongan->periodeMagang->nama_periode ?? 'Tidak tersedia' }}</p>
                                </div>
                            </div>
                            @if ($magang->status_magang == 'menunggu')
                                <div class="flex gap-2">
                                    <button type="button" id="btn-terima"
                                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700 focus:outline-hidden focus:bg-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                        Terima
                                    </button>
                                    <button type="button" id="btn-tolak"
                                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:bg-red-400 hover:text-white focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none">
                                        Tolak
                                    </button>
                                    <button type="button" id="btn-detail-lowongan"
                                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:bg-blue-400 hover:text-white focus:outline-hidden focus:border-blue-500 focus:text-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                        Detail Lowongan
                                    </button>
                                </div>
                            @endif
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const statusText = document.getElementById('status-text');
                                    const btnTerima = document.getElementById('btn-terima');
                                    const btnTolak = document.getElementById('btn-tolak');
                                    const btnDetail = document.getElementById('btn-detail-lowongan');

                                    btnTerima?.addEventListener('click', function() {
                                        statusText.textContent = 'Diterima';
                                        statusText.className =
                                            'inline-flex items-center h-[28px] gap-x-1.5 py-1 px-2 rounded-md text-xs font-medium border border-green-500 text-green-500';
                                    });
                                    btnTolak?.addEventListener('click', function() {
                                        statusText.textContent = 'Ditolak';
                                        statusText.className =
                                            'inline-flex items-center h-[28px] gap-x-1.5 py-1 px-2 rounded-md text-xs font-medium border border-red-500 text-red-500';
                                    });
                                    btnDetail?.addEventListener('click', function() {
                                        window.location.href = '/detail-lowongan/{{ $magang->lowongan->id_lowongan }}';
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
