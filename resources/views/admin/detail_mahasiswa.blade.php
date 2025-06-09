@extends('layout.template')

@section('content')
    <div class="flex flex-col gap-4">
        {{-- Detail Pengguna --}}
        <div class="w-full p-4 bg-white rounded-2xl flex flex-col gap-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center w-full gap-3">
                <div class="text-neutral-900 text-xl font-medium">Detail Pengguna</div>
                <a href="#" class="outline-primary-500 text-primary-500 btn-outline-sm">
                    <x-lucide-lock class="size-6" stroke-width="1.5" />
                    Atur Ulang Kata Sandi
                </a>
            </div>
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6 md:gap-9">
                <div class="w-28 h-28 rounded-2xl overflow-hidden flex-shrink-0 bg-neutral-100 flex items-center justify-center">
                    @if(isset($user->profile_photo) && $user->profile_photo)
                        <img class="w-28 h-28 object-cover"
                            src="{{ asset('Images/' . $user->profile_photo) }}"
                            alt="Foto Mahasiswa" />
                    @else
                        <img class="w-28 h-28 object-cover"
                            src="{{ asset('Images/avatar.svg') }}"
                            alt="Default Avatar" />
                    @endif
                </div>
                <div class="flex flex-col gap-6">
                    <div class="text-neutral-900 text-lg font-medium">{{ $user->name }}</div>
                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-9">
                        <div class="flex flex-col gap-1">
                            <div class="text-neutral-400 text-sm">NIM</div>
                            <div class="text-neutral-700 text-sm font-semibold">{{ $mahasiswa->nim }}</div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <div class="text-neutral-400 text-sm">Email</div>
                            <div class="text-neutral-700 text-sm font-semibold">{{ $user->email }}</div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <div class="text-neutral-400 text-sm">Program Studi</div>
                            <div class="text-neutral-700 text-sm font-semibold">{{ $mahasiswa->programStudi->nama_prodi ?? 'Tidak tersedia' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Dokumen Pendukung --}}
        <div class="w-full p-4 bg-white rounded-2xl flex flex-col gap-6">
            <div class="flex justify-between items-center w-full">
                <div class="text-neutral-900 text-xl font-medium">Dokumen Pendukung</div>
            </div>
            
            @if($dokumen->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                    @foreach($dokumen as $doc)
                        <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                                    @php
                                        $jenisDokumen = strtolower($doc->jenisDokumen->nama ?? '');
                                    @endphp
                                    
                                    @if(Str::contains($jenisDokumen, 'cv') || Str::contains($jenisDokumen, 'curriculum vitae'))
                                        <x-lucide-file class="w-4 h-4 text-primary-600" />
                                    @elseif(Str::contains($jenisDokumen, 'portfolio') || Str::contains($jenisDokumen, 'portofolio'))
                                        <x-lucide-image class="w-4 h-4 text-primary-600" />
                                    @elseif(Str::contains($jenisDokumen, 'sertifikat'))
                                        <i class="ph ph-medal w-4 h-4 text-primary-600"></i>
                                    @elseif(Str::contains($jenisDokumen, 'surat'))
                                        <i class="ph ph-envelope-simple w-4 h-4 text-primary-600"></i>
                                    @elseif(Str::contains($jenisDokumen, 'transkrip') || Str::contains($jenisDokumen, 'nilai'))
                                        <i class="ph ph-chart-line w-4 h-4 text-primary-600"></i>
                                    @else
                                        <x-lucide-file class="w-4 h-4 text-primary-600" />
                                    @endif
                                </div>
                                <div class="text-neutral-900 text-base font-medium">
                                    {{ $doc->jenisDokumen->nama ?? 'Dokumen' }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-1 text-xs mt-auto">
                                <div class="flex flex-row items-center gap-1">
                                    <span class="text-neutral-900 font-medium">Diunggah:</span>
                                    <span class="text-neutral-500">
                                        {{ \Carbon\Carbon::parse($doc->created_at)->format('d M Y') }}
                                    </span>
                                </div>
                                <div class="flex flex-row items-center gap-1">
                                    <span class="text-neutral-900 font-medium">Ukuran:</span>
                                    @php
                                        $filesize = 'N/A';
                                        if (isset($doc->path_dokumen) && Storage::exists('public/' . $doc->path_dokumen)) {
                                            $size = Storage::size('public/' . $doc->path_dokumen);
                                            $filesize = number_format($size / 1024, 0) . ' KB';
                                        }
                                    @endphp
                                    <span class="text-neutral-500">{{ $filesize }}</span>
                                </div>
                            </div>
                            <div class="flex justify-start mt-auto">
                                <a href="{{ asset('storage/' . $doc->path_dokumen) }}" target="_blank"
                                    class="inline-flex items-center justify-center w-full px-4 py-2 border border-primary-500 rounded-lg text-primary-500 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm font-medium transition">
                                    <x-lucide-eye class="w-4 h-4 mr-2" />
                                    Lihat Dokumen
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-8">
                    <x-lucide-file-x class="w-12 h-12 text-neutral-300 mb-3"/>
                    <div class="text-neutral-500 text-sm">Tidak ada dokumen yang diunggah</div>
                </div>
            @endif
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Preferensi & Profil Magang --}}
            <div class="w-full p-6 bg-white rounded-xl flex flex-col gap-6">
                <div class="flex justify-between items-center w-full">
                    <div class="text-neutral-900 text-xl font-medium">Preferensi & Profil Magang</div>
                </div>
                <div class="flex items-start gap-6">
                    <div class="flex flex-col gap-2 text-sm">
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
                    <div class="flex flex-col gap-2 text-sm">
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-500">
                                @if($mahasiswa->jenis_magang == 'wfo')
                                    WFO (Work From Office)
                                @elseif($mahasiswa->jenis_magang == 'remote')
                                    Remote
                                @elseif($mahasiswa->jenis_magang == 'hybrid')
                                    Hybrid
                                @else
                                    {{ $mahasiswa->jenis_magang ?? 'Tidak tersedia' }}
                                @endif
                            </span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-500">{{ $mahasiswa->kompetensi->nama_kompetensi ?? 'Tidak tersedia' }}</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-500">{{ $mahasiswa->preferensi_lokasi ?? 'Tidak tersedia' }}</span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-500">{{ $mahasiswa->jenisPerusahaan->nama_jenis_perusahaan ?? 'Tidak tersedia' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Riwayat Pengajuan Magang --}}
            <div class="w-full p-6 bg-white rounded-xl flex flex-col gap-6">
                <div class="flex justify-between items-center w-full">
                    <div class="text-neutral-900 text-xl font-medium">Riwayat Pengajuan Magang</div>
                    @if($latestMagang)
                        @php
                            $statusClass = 'border-gray-500 text-gray-500';
                            $statusText = 'Selesai';
                            
                            if($latestMagang->status_magang == 'magang') {
                                $statusClass = 'border-blue-600 text-blue-600';
                                $statusText = 'Magang';
                            } elseif($latestMagang->status_magang == 'diterima') {
                                $statusClass = 'border-teal-500 text-teal-500';
                                $statusText = 'Diterima';
                            } elseif($latestMagang->status_magang == 'menunggu') {
                                $statusClass = 'border-amber-500 text-amber-500';
                                $statusText = 'Menunggu';
                            } elseif($latestMagang->status_magang == 'ditolak') {
                                $statusClass = 'border-red-500 text-red-500';
                                $statusText = 'Ditolak';
                            }
                        @endphp
                        <div class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border {{ $statusClass }}">
                            {{ $statusText }}
                        </div>
                    @else
                        <div class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-500 text-gray-500">
                            Belum Daftar
                        </div>
                    @endif
                </div>
                
                @if($latestMagang)
                    <div class="flex items-start gap-6">
                        <div class="flex flex-col gap-2 text-sm">
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
                        <div class="flex flex-col gap-2 text-sm">
                            <div class="flex flex-row items-center gap-1">
                                <span class="text-neutral-500">{{ $latestMagang->lowongan->judul_lowongan ?? 'Tidak tersedia' }}</span>
                            </div>
                            <div class="flex flex-row items-center gap-1">
                                <span class="text-neutral-500">{{ $latestMagang->lowongan->perusahaanMitra->nama_perusahaan_mitra ?? 'Tidak tersedia' }}</span>
                            </div>
                            <div class="flex flex-row items-center gap-1">
                                <span class="text-neutral-500">
                                    {{ $latestMagang->dosenPembimbing->user->name ?? 'Belum ditentukan' }}
                                </span>
                            </div>
                            <div class="flex flex-row items-center gap-1">
                                @if(isset($latestMagang->path_sertifikat) && $latestMagang->path_sertifikat)
                                    <a href="{{ asset('storage/' . $latestMagang->path_sertifikat) }}" target="_blank" class="text-primary-500 hover:underline">
                                        Lihat sertifikat
                                    </a>
                                @else
                                    <span class="text-neutral-500">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center justify-center py-4">
                        <div class="text-neutral-500 text-sm">Mahasiswa belum mendaftar magang</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
