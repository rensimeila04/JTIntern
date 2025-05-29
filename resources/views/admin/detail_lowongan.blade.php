@extends('layout.template')
@section('content')
    <div class="space-y-4">
        <div class="flex flex-row items-center justify-between">
            <div>
                <h2 class="text-xl font-medium">Detail Lowongan</h2>
            </div>
            <div>
                <a href="{{ route('admin.lowongan.edit', $lowongan->id_lowongan) }}"
                    class="btn-outline text-primary-500 border-primary-500 hover:bg-primary-500 hover:text-white">
                    <x-lucide-pencil-line stroke-width="1.5" class="size-3.5" />
                    Edit Lowongan
                </a>
            </div>
        </div>

        <!-- Company and Job Info -->
        <div class="flex justify-start items-center w-full bg-white p-4 rounded-md">
            <div class="flex">
                <img src="{{ $lowongan->perusahaanMitra->logo ? Storage::url($lowongan->perusahaanMitra->logo) : asset('Images/placeholder_perusahaan.png') }}"
                    alt="{{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}"
                    class="w-30 h-30 rounded-2xl object-contain">
                <div class="flex flex-col pl-6 gap-y-6">
                    <div class="space-y-2">
                        <div class="flex gap-4 items-center">
                            <p class="font-semibold">{{ $lowongan->judul_lowongan }}</p>
                            <span
                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border {{ $lowongan->status_pendaftaran ? 'border-teal-500 bg-white text-teal-500' : 'border-red-500 bg-white text-red-500' }}">
                                {{ $lowongan->status_pendaftaran ? 'Aktif Merekrut' : 'Tidak Aktif' }}
                            </span>
                        </div>
                        <a href="{{ route('admin.perusahaan.detail', $lowongan->perusahaanMitra->id_perusahaan_mitra) }}"
                            class="text-primary-500 text-base font-normal hover:text-primary-700 hover:underline transition-colors duration-200 w-fit block">
                            {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                        </a>
                    </div>
                    <div class="flex flex-row gap-10 items-start">
                        <div class="flex flex-col gap-2">
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-map-pin class="text-neutral-500 size-6" stroke-width="1.5" />
                                <p>{{ $lowongan->perusahaanMitra->alamat }}</p>
                            </span>
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-calendar-days class="text-neutral-500 size-6" stroke-width="1.5" />
                                <p>{{ $lowongan->periodeMagang->nama_periode }}</p>
                            </span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-briefcase class="text-neutral-500 size-6" stroke-width="1.5" />
                                <p>{{ ucfirst($lowongan->jenis_magang) }}</p>
                            </span>
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-laptop class="text-neutral-500 size-6" stroke-width="1.5" />
                                <p>{{ $lowongan->kompetensi->nama_kompetensi }}</p>
                            </span>
                        </div>
                        @if ($lowongan->deadline_pendaftaran)
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-clock class="text-neutral-500 size-6" stroke-width="1.5" />
                                <p>Deadline: {{ \Carbon\Carbon::parse($lowongan->deadline_pendaftaran)->format('d M Y') }}
                                </p>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Description -->
        <div class="w-full bg-white p-4 rounded-md space-y-2">
            <p class="font-medium text-xl">Deskripsi</p>
            <div id="short-description" class="text-neutral-400 text-sm font-normal line-clamp-3 whitespace-pre-line">
                {{ Str::limit($lowongan->deskripsi, 200) }}
            </div>
            <div id="full-description" class="text-neutral-400 text-sm hidden whitespace-pre-line">
                {!! nl2br(e($lowongan->deskripsi)) !!}
            </div>
            @if (strlen($lowongan->deskripsi) > 200)
                <button id="read-more-btn"
                    class="mt-2 text-primary-500 text-sm font-medium hover:text-primary-700 focus:outline-none flex items-center gap-1">
                    <span>Lebih banyak</span>
                    <i class="ph ph-caret-down"></i>
                </button>
            @endif
        </div>

        <!-- Job Requirements -->
        <div class="w-full bg-white p-4 rounded-md">
            <p class="font-medium text-xl">Persyaratan</p>
            <div class="mt-2 text-neutral-400 text-sm whitespace-pre-line">
                {!! nl2br(e($lowongan->persyaratan)) !!}
            </div>
        </div>

        <!-- Test Information -->
        @if ($lowongan->test && $lowongan->informasi_test)
            <div class="w-full bg-white p-4 rounded-md">
                <p class="font-medium text-xl">Informasi Test</p>
                <div class="mt-2 text-neutral-400 text-sm whitespace-pre-line">
                    {!! nl2br(e($lowongan->informasi_test)) !!}
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const readMoreBtn = document.getElementById('read-more-btn');

            if (readMoreBtn) {
                const shortDescription = document.getElementById('short-description');
                const fullDescription = document.getElementById('full-description');

                readMoreBtn.addEventListener('click', function() {
                    if (shortDescription.classList.contains('hidden')) {
                        // Show less
                        shortDescription.classList.remove('hidden');
                        fullDescription.classList.add('hidden');
                        readMoreBtn.innerHTML = '<span>Lebih banyak</span><i class="ph ph-caret-down"></i>';
                    } else {
                        // Show more
                        shortDescription.classList.add('hidden');
                        fullDescription.classList.remove('hidden');
                        readMoreBtn.innerHTML = '<span>Lebih sedikit</span><i class="ph ph-caret-up"></i>';
                    }
                });
            }
        });
    </script>
@endsection
