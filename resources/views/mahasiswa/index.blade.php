@extends('layout.template')
@section('content')
    <div class="flex flex-col gap-6">
        <span class="text-xl font-medium">
            <h2>Selamat datang kembali, {{ Auth::user()->name }}</h2>
        </span>
        <div class="grid grid-cols-3 gap-4 w-full">
            <div class="bg-white rounded-lg p-4 ">
                <div class="flex flex-row gap-2.5">
                    <div class="flex flex-row gap-4 w-full items-center">
                        <div class="bg-primary-100 rounded-lg p-4">
                            <x-lucide-briefcase class="w-8 h-8 text-primary-600" />
                        </div>
                        <div class="flex flex-col gap-2.5">
                            <div class="flex gap-2.5 font-medium text-base">
                                @if ($magang)
                                    <p>{{ $magang->lowongan->judul_lowongan ?? '-' }}</p>
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-1 rounded-md text-[10px] font-medium border border-blue-400 bg-white text-blue-600">
                                        {{ $magang->status_magang == 'selesai' ? 'Selesai' : 'Magang Aktif' }}
                                    </span>
                                @else
                                    <p>Magang</p>
                                @endif
                            </div>
                            <p class="text-neutral-400 text-xs">
                                @if ($magang)
                                    {{ $magang->lowongan->perusahaanMitra->nama_perusahaan_mitra ?? '-' }}
                                @else
                                    Jelajahi lowongan magang
                                @endif
                            </p>
                        </div>
                        <a class="text-sm font-medium text-primary-500 underline ml-auto"
                            href="{{ route('mahasiswa.rincian') }}">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4">
                <div class="flex flex-row gap-2.5">
                    <div class="flex flex-row gap-4 w-full items-center">
                        <div class="bg-orange-100 rounded-lg p-4">
                            <x-lucide-book-open class="w-8 h-8 text-orange-600" />
                        </div>
                        <div class="flex flex-col gap-2.5">
                            <div class="flex gap-2.5 font-medium text-base">
                                <p>Log Aktivitas</p>
                                @if ($magang)
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-1 rounded-md text-[10px] font-medium border border-teal-400 bg-white text-teal-600">
                                        Wajib
                                    </span>
                                @endif
                            </div>
                            @if ($magang)
                                <p class="text-neutral-400 text-xs">Catat kegiatan magangmu</p>
                            @else
                                <p class="text-neutral-400 text-xs">Belum ada magang aktif</p>
                            @endif

                        </div>
                        <a class="text-sm font-medium text-primary-500 underline ml-auto"
                            href="{{ route('mahasiswa.log_aktivitas') }}">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4">
                <div class="flex flex-row gap-2.5">
                    <div class="flex flex-row gap-4 w-full items-center">
                        <div class="bg-blue-100 rounded-lg p-4">
                            <i class="ph ph-chat-teardrop-text text-[32px] text-blue-600"></i>
                        </div>
                        <div class="flex flex-col gap-2.5">
                            <div class="flex gap-2.5 font-medium text-base">
                                <p>Feedback Magang</p>
                                @if ($magang && $magang->status_magang == 'selesai')
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-1 rounded-md text-[10px] font-medium border border-teal-400 bg-white text-teal-600">
                                        Wajib
                                    </span>
                                @endif
                            </div>
                            @if ($magang && $magang->status_magang == 'selesai')
                                <p class="text-neutral-400 text-xs">Bagikan Pengalamanmu!</p>
                            @else
                                <p class="text-neutral-400 text-xs">Akses setelah selesai magang</p>
                            @endif
                        </div>
                        <a class="text-sm font-medium text-primary-500 underline ml-auto"
                            href="{{ route('mahasiswa.feedback') }}">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-between">
            <p class="text-xl font-medium">Lowongan Terbaru</p>
            <a href="{{ route('mahasiswa.lowongan') }}" id="lihat-semua-lowongan"
                class="text-base font-semibold text-primary-500">
                Lihat Semua
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-4 w-full relative z-10">
            @forelse ($lowonganList as $lowongan)
                @php
                    $wibNow = now('Asia/Jakarta');
                    $deadline = $lowongan->deadline_pendaftaran
                        ? \Carbon\Carbon::parse($lowongan->deadline_pendaftaran)->setTimezone('Asia/Jakarta')
                        : null;
                    $daysLeft = $deadline ? $deadline->diffInDays($wibNow, false) : null;
                    $applicantCount = $lowongan->magang()->count();
                    $isExpired = $deadline && $deadline->isPast();
                @endphp
                <div
                    class="bg-white flex-col rounded-xl flex py-6 px-4 gap-4 relative z-0 {{ $isExpired ? 'opacity-75' : '' }}">
                    <div class="inline-flex items-center gap-6">
                        <img src="{{ $lowongan->perusahaanMitra->logo ? $lowongan->perusahaanMitra->logo_url : asset('images/placeholder_perusahaan.png') }}"
                            alt="Logo {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}"
                            class="w-20 h-20 rounded-lg object-contain bg-gray-50">
                        <div class="flex flex-col flex-1 justify-start items-start gap-2 h-fill cursor-pointer"
                            onclick="window.location.href='{{ route('mahasiswa.lowongan.detail', $lowongan->id_lowongan) }}'">
                            <div class="self-stretch inline-flex justify-start items-center gap-4">
                                <div
                                    class="justify-start text-black text-lg font-medium leading-none hover:text-primary-600 transition-colors">
                                    {{ $lowongan->judul_lowongan }}
                                </div>
                            </div>
                            <div class="inline-flex justify-start items-center gap-2">
                                <span
                                    class="justify-start text-neutral-400 text-sm font-normal leading-none truncate max-w-[120px]">
                                    {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                                </span>
                                <div class="w-1 h-1 bg-neutral-400 rounded-full flex-shrink-0"></div>
                                <span
                                    class="justify-start text-neutral-400 text-sm font-normal leading-none truncate max-w-[150px]">
                                    {{ $lowongan->perusahaanMitra->alamat }}
                                </span>
                            </div>
                            <div class="inline-flex justify-start items-start gap-2">
                                <span
                                    class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">
                                    {{ strtoupper($lowongan->jenis_magang) }}
                                </span>
                                <span
                                    class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">
                                    {{ $lowongan->perusahaanMitra->jenisPerusahaan->nama_jenis_perusahaan }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('mahasiswa.lowongan.detail', $lowongan->id_lowongan) }}"
                            class="ml-auto py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-600 disabled:opacity-50 disabled:pointer-events-none {{ $isExpired ? 'bg-gray-400 hover:bg-gray-400 cursor-not-allowed pointer-events-none' : '' }}">
                            {{ $isExpired ? 'Tutup' : 'Lihat Detail' }}
                        </a>
                    </div>
                    <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">
                    <div class="self-stretch inline-flex justify-start items-center gap-2">
                        @if ($lowongan->deadline_pendaftaran)
                            <span class="justify-start text-neutral-400 text-sm font-normal leading-none">
                                @if ($isExpired)
                                    Pendaftaran ditutup
                                @else
                                    {{ abs($daysLeft) }} hari tersisa
                                @endif
                            </span>
                            <div class="w-1 h-1 bg-neutral-400 rounded-full"></div>
                        @endif
                        <span class="justify-start text-neutral-400 text-sm font-normal leading-none">
                            {{ $applicantCount }} Pelamar
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    @if (isset($filters['search']) && $filters['search'])
                        <div class="text-gray-500 text-lg">Tidak ada lowongan yang sesuai dengan pencarian
                            "{{ $filters['search'] }}"</div>
                        <div class="text-gray-400 text-sm mt-2">Coba kata kunci lain atau <a
                                href="{{ route('mahasiswa.lowongan') }}" class="text-primary-500 hover:underline">lihat
                                semua lowongan</a></div>
                    @else
                        <div class="text-gray-500 text-lg">Tidak ada lowongan yang sesuai dengan filter</div>
                        <div class="text-gray-400 text-sm mt-2">Coba ubah filter atau <a
                                href="{{ route('mahasiswa.lowongan') }}" class="text-primary-500 hover:underline">reset
                                semua filter</a></div>
                    @endif
                </div>
            @endforelse
        </div>
    @endsection

    @push('scripts')
        <script>
            document.getElementById('lihat-semua-lowongan').addEventListener('click', function(e) {
                e.preventDefault();
                let btn = this;
                btn.innerText = 'Memuat...';
                fetch('{{ route('mahasiswa.semua-lowongan') }}')
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('content-lowongan-terbaru').style.display = 'none';
                        document.getElementById('content-semua-lowongan').innerHTML = html;
                        document.getElementById('content-semua-lowongan').style.display = 'block';
                    });
            });
        </script>
    @endpush
