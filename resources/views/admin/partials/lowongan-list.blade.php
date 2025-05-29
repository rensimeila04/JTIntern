<!-- Lowongan List -->
@if ($lowongan->count() > 0)
    @foreach ($lowongan as $item)
        <div class="flex justify-between items-center mt-5 w-full bg-white p-4 rounded-md">
            <div class="flex">
                <img src="{{ $item->perusahaanMitra->logo ? Storage::url($item->perusahaanMitra->logo) : asset('Images/placeholder_perusahaan.png') }}"
                    alt="{{ $item->perusahaanMitra->nama_perusahaan_mitra }}" class="w-30 h-30 rounded-lg object-contain">
                <div class="flex flex-col pl-6 gap-y-4">
                    <div class="flex flex-col space-y-1">
                        <div class="flex gap-4 items-center">
                            <h4 class="font-semibold">{{ $item->judul_lowongan }}</h4>
                            <p
                                class="rounded-md border {{ $item->status_pendaftaran ? 'border-teal-500 text-teal-500' : 'border-red-500 text-red-500' }} p-1 text-xs">
                                {{ $item->status_pendaftaran ? 'Aktif Merekrut' : 'Tidak Aktif' }}
                            </p>
                        </div>
                        <a href="{{ route('admin.perusahaan.detail', $item->perusahaanMitra->id_perusahaan_mitra) }}" 
                           class="text-primary-500 hover:text-primary-700 hover:underline transition-colors duration-200 w-fit">
                            {{ $item->perusahaanMitra->nama_perusahaan_mitra }}
                        </a>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <span class="flex items-center gap-2">
                            <x-lucide-map-pin class="text-neutral-500 size-6" stroke-width="1.5" />
                            <p class="text-neutral-700">{{ $item->perusahaanMitra->alamat }}</p>
                        </span>
                        <span class="flex items-center gap-2">
                            <x-lucide-calendar-days class="text-neutral-500 size-6" stroke-width="1.5" />
                            <p class="text-neutral-700">{{ $item->periodeMagang->nama_periode }}</p>
                        </span>
                    </div>
                </div>
            </div>
            <span>
                <a href="{{ route('admin.lowongan.detail', $item->id_lowongan) }}" class="btn-primary-lg">
                    Lihat Detail
                </a>
            </span>
        </div>
    @endforeach
@else
    <div class="flex justify-center items-center mt-10 w-full p-8 rounded-md">
        <div class="text-center">
            <i class="ph ph-folder-open text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-500 mb-2">Tidak ada lowongan ditemukan</h3>
            <p class="text-gray-400">Silakan coba filter atau pencarian yang berbeda</p>
        </div>
    </div>
@endif

<!-- Pagination -->
@if ($lowongan->hasPages())
    <div class="flex items-center justify-end mt-5">
        {{ $lowongan->links('pagination::simple-tailwind') }}
    </div>
@endif