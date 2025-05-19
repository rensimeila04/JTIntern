@extends('layout.template')

@section('content')
    <div class="flex flex-col gap-6">
        {{-- Detail Pengguna --}}
        <div class="w-full p-6 bg-white rounded-xl flex flex-col gap-6 shadow">
            <div class="flex justify-between items-center w-full">
                <div class="text-neutral-900 text-xl font-semibold">Detail Pengguna</div>
                <button type="button"
                    class="inline-flex items-center px-4 py-2 border border-primary-500 rounded-lg text-primary-500 bg-white hover:bg-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-medium transition">
                    <x-lucide-lock class="w-4 h-4 mr-2" />
                    Atur Ulang Kata Sandi
                </button>
            </div>
            <div class="flex items-center gap-9">
                <div
                    class="w-28 h-28 rounded-2xl overflow-hidden flex-shrink-0 bg-neutral-100 flex items-center justify-center">
                    <img class="w-28 h-28 object-cover" src="{{ asset('Images/DindaSafira.png') }}"
                        alt="Foto Dinda Safira" />
                </div>
                <div class="flex flex-col gap-6">
                    <div class="text-neutral-900 text-lg font-semibold">Dinda Safira</div>
                    <div class="flex gap-9">
                        <div class="flex flex-col gap-1">
                            <div class="text-neutral-400 text-sm">NIM</div>
                            <div class="text-neutral-700 text-sm font-semibold">2341720001</div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <div class="text-neutral-400 text-sm">Email</div>
                            <div class="text-neutral-700 text-sm font-semibold">2341720001@student.polinema.ac.id</div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <div class="text-neutral-400 text-sm">Program Studi</div>
                            <div class="text-neutral-700 text-sm font-semibold">D-IV Teknik Informatika</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Dokumen Pendukung --}}
        <div class="w-full p-6 bg-white rounded-xl flex flex-col gap-6 shadow">
            <div class="flex justify-between items-center w-full">
                <div class="text-neutral-900 text-xl font-semibold">Dokumen Pendukung</div>
            </div>
            <div class="flex gap-6">
                {{-- CV --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 shadow-sm">
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
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </button>
                    </div>
                </div>
                {{-- Portofolio --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 shadow-sm">
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
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </button>
                    </div>
                </div>
                {{-- Sertifikat --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 shadow-sm">
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
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </button>
                    </div>
                </div>
                {{-- Surat Pengantar --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 shadow-sm">
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
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </button>
                    </div>
                </div>
                {{-- Transkip Nilai --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="ph ph-chart-line w-4 h-4 text-primary-600"></i>
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Transkip Nilai</div>
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
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition">
                            <x-lucide-eye class="w-4 h-4 mr-2" />
                            Lihat Dokumen
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row gap-6">
            {{-- Preferensi & Profil Magang --}}
            <div class="w-1/2 p-6 bg-white rounded-xl flex flex-col gap-6 shadow">
                <div class="flex justify-between items-center w-full">
                    <div class="text-neutral-900 text-xl font-semibold">Preferensi & Profil Magang</div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex flex-col gap-2 text-xs">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Jenis Magang</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Kompetensi</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Preferensi Lokasi</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Jenis Perusahaan</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 text-xs">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-500">WFO</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-500">UI/UX Design</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-500">Jakarta Selatan</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-500">BUMN</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Riwayat Pengajuan Magang --}}
            <div class="w-1/2 p-6 bg-white rounded-xl flex flex-col gap-6 shadow">
                <div class="flex justify-between items-center w-full">
                    <div class="text-neutral-900 text-xl font-semibold">Riwayat Pengajuan Magang</div>
                    <div class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500"> 
                        Diterima
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex flex-col gap-2 text-xs">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Nama Lowongan</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Nama Perusahaan</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Dosen Pembimbing</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Sertifikat Magang</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 text-xs">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-500">UI/UX Design</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-500">PT Telekomunikasi Indonesia</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-500">Ayu Maharani S.Kom M.Kom</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-500">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
