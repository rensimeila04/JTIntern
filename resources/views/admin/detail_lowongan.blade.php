@extends('layout.template')
@section('content')
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-medium">Detail Lowongan</h2>
        </div>
        <div>
            <a href="{{ route('admin.lowongan.edit', $lowongan->id_lowongan) }}" 
               class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-primary-500 text-primary-500 hover:border-primary-700 hover:text-primary-700 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                <i class="ph ph-note-pencil"></i>
                Edit Lowongan
            </a>
        </div>
    </div>

    <!-- Company and Job Info -->
    <div class="flex justify-start items-center mt-5 w-full bg-white p-4 rounded-md">
        <div class="flex">
            <img src="{{ $lowongan->perusahaanMitra->logo ? Storage::url($lowongan->perusahaanMitra->logo) : asset('Images/LOGOPT.png') }}" 
                 alt="{{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}"
                 class="w-20 h-20 object-contain">
            <div class="flex flex-col pl-6 gap-y-2.5">
                <div class="flex gap-4 items-center">
                    <h4 class="font-semibold">{{ $lowongan->judul_lowongan }}</h4>
                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border {{ $lowongan->status_pendaftaran ? 'border-teal-500 bg-white text-teal-500' : 'border-red-500 bg-white text-red-500' }}">
                        {{ $lowongan->status_pendaftaran ? 'Aktif Merekrut' : 'Tidak Aktif' }}
                    </span>
                </div>
                <p class="text-primary-500 text-sm">
                    {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                </p>
                <div class="flex flex-col gap-1">
                    <span class="flex items-center gap-2 text-sm text-neutral-700">
                        <i class="ph ph-map-pin text-neutral-500 text-xl"></i>
                        <p>{{ $lowongan->perusahaanMitra->alamat }}</p>
                    </span>
                    <span class="flex items-center gap-2 text-sm text-neutral-700">
                        <i class="ph ph-calendar text-neutral-500 text-xl"></i>
                        <p>{{ $lowongan->periodeMagang->nama_periode }}</p>
                    </span>
                    <span class="flex items-center gap-2 text-sm text-neutral-700">
                        <i class="ph ph-briefcase text-neutral-500 text-xl"></i>
                        <p>{{ ucfirst($lowongan->jenis_magang) }}</p>
                    </span>
                    <span class="flex items-center gap-2 text-sm text-neutral-700">
                        <i class="ph ph-code text-neutral-500 text-xl"></i>
                        <p>{{ $lowongan->kompetensi->nama_kompetensi }}</p>
                    </span>
                    @if($lowongan->deadline_pendaftaran)
                        <span class="flex items-center gap-2 text-sm text-neutral-700">
                            <i class="ph ph-clock text-neutral-500 text-xl"></i>
                            <p>Deadline: {{ \Carbon\Carbon::parse($lowongan->deadline_pendaftaran)->format('d M Y') }}</p>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Job Description -->
    <div class="w-full bg-white p-4 rounded-md mt-5">
        <h4 class="font-semibold">Deskripsi</h4>
        <div class="mt-2">
            <div id="short-description" class="text-neutral-400 text-sm line-clamp-3 whitespace-pre-line">
                {{ Str::limit($lowongan->deskripsi, 200) }}
            </div>
            <div id="full-description" class="text-neutral-400 text-sm hidden whitespace-pre-line">
                {!! nl2br(e($lowongan->deskripsi)) !!}
            </div>
            @if(strlen($lowongan->deskripsi) > 200)
                <button id="read-more-btn" class="mt-2 text-primary-500 text-sm font-medium hover:text-primary-700 focus:outline-none flex items-center gap-1">
                    <span>Lebih banyak</span>
                    <i class="ph ph-caret-down"></i>
                </button>
            @endif
        </div>
    </div>

    <!-- Job Requirements -->
    <div class="w-full bg-white p-4 rounded-md mt-5">
        <h4 class="font-semibold">Persyaratan</h4>
        <div class="mt-2 text-neutral-400 text-sm whitespace-pre-line">
            {!! nl2br(e($lowongan->persyaratan)) !!}
        </div>
    </div>

    <!-- Test Information -->
    @if($lowongan->test && $lowongan->informasi_test)
        <div class="w-full bg-white p-4 rounded-md mt-5">
            <h4 class="font-semibold">Informasi Test</h4>
            <div class="mt-2 text-neutral-400 text-sm whitespace-pre-line">
                {!! nl2br(e($lowongan->informasi_test)) !!}
            </div>
        </div>
    @endif

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