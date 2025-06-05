<div class="space-y-6">
    {{-- Filter Dropdowns --}}
    <div class="flex gap-2 relative z-50">
        {{-- Tipe Magang Dropdown --}}
        <div class="hs-dropdown relative inline-flex">
            <button id="hs-dropdown-tipe-magang" type="button"
                class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-md font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <span id="selected-tipe-magang">
                    @if(isset($filters['jenis_magang']))
                        {{ strtoupper($filters['jenis_magang']) }}
                    @else
                        Semua Tipe Magang
                    @endif
                </span>
                <x-lucide-chevron-down class="hs-dropdown-open:rotate-180 size-4" />
            </button>
            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white rounded-lg mt-2 shadow-lg border border-gray-200 z-[60] dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-tipe-magang">
                <div class="p-1 space-y-0.5">
                    <a class="filter-tipe-magang flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                        href="#" data-value="">
                        Semua Tipe Magang
                    </a>
                    <a class="filter-tipe-magang flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                        href="#" data-value="wfo">
                        WFO
                    </a>
                    <a class="filter-tipe-magang flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                        href="#" data-value="remote">
                        Remote
                    </a>
                    <a class="filter-tipe-magang flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                        href="#" data-value="hybrid">
                        Hybrid
                    </a>
                </div>
            </div>
        </div>

        {{-- Perusahaan Dropdown --}}
        <div class="hs-dropdown relative inline-flex">
            <button id="hs-dropdown-perusahaan" type="button"
                class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-md font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <span id="selected-perusahaan">
                    @if(isset($filters['jenis_perusahaan']))
                        @php
                            $selectedJenis = $jenisPerusahaan->where('id_jenis_perusahaan', $filters['jenis_perusahaan'])->first();
                        @endphp
                        {{ $selectedJenis ? $selectedJenis->nama_jenis_perusahaan : 'Semua Perusahaan' }}
                    @else
                        Semua Perusahaan
                    @endif
                </span>
                <x-lucide-chevron-down class="hs-dropdown-open:rotate-180 size-4" />
            </button>
            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white rounded-lg mt-2 shadow-lg border border-gray-200 z-[60] dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-perusahaan">
                <div class="p-1 space-y-0.5">
                    <a class="filter-perusahaan flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                        href="#" data-value="">
                        Semua Perusahaan
                    </a>
                    @foreach($jenisPerusahaan as $jenis)
                        <a class="filter-perusahaan flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#" data-value="{{ $jenis->id_jenis_perusahaan }}">
                            {{ $jenis->nama_jenis_perusahaan }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Lokasi Dropdown dengan Search --}}
        <div class="relative z-50">
            <select data-hs-select='{
                "hasSearch": true,
                "searchPlaceholder": "Cari lokasi...",
                "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-primary-500 focus:ring-primary-500 py-2 px-3 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500",
                "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
                "placeholder": "Pilih lokasi",
                "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"text-gray-800 dark:text-neutral-200\" data-title></span></button>",
                "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-1.5 sm:py-2 pl-4 pr-10 flex gap-x-2 text-nowrap w-auto cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-md font-medium focus:outline-hidden focus:ring-2 focus:ring-primary-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600 h-[38px]",
                "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-[70] min-w-max bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto shadow-lg [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                "optionTemplate": "<div class=\"flex items-center\"><div class=\"text-gray-800 dark:text-neutral-200\" data-title></div></div>",
                "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
            }' class="hidden" name="lokasi" id="lokasi-filter">
                <option value="">Semua Lokasi</option>
                @foreach($lokasiPerusahaan as $lokasi)
                    <option value="{{ $lokasi }}" {{ isset($filters['lokasi']) && $filters['lokasi'] == $lokasi ? 'selected' : '' }}>
                        {{ $lokasi }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Reset Button --}}
        @if(array_filter($filters ?? []))
            <a href="{{ route('mahasiswa.lowongan') }}" 
               class="py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-md font-medium rounded-lg border border-gray-200 bg-white text-red-600 hover:bg-red-50 focus:outline-hidden focus:bg-red-50 h-[38px]">
                <x-lucide-x class="size-4" />
                Reset Filter
            </a>
        @endif
    </div>

    {{-- Search Results Info --}}
    @if(isset($filters['search']) && $filters['search'])
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center gap-2">
                <x-lucide-search class="size-4 text-blue-600" />
                <span class="text-blue-800 text-sm">
                    Menampilkan hasil pencarian untuk: <strong>"{{ $filters['search'] }}"</strong>
                </span>
                @if($lowonganList->count() > 0)
                    <span class="text-blue-600 text-sm">
                        ({{ $lowonganList->count() }} lowongan ditemukan)
                    </span>
                @endif
            </div>
        </div>
    @endif

    {{-- Daftar Lowongan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-4 w-full relative z-10">
        @forelse ($lowonganList as $lowongan)
            @php
                $wibNow = now('Asia/Jakarta');
                $deadline = $lowongan->deadline_pendaftaran ? 
                    \Carbon\Carbon::parse($lowongan->deadline_pendaftaran)->setTimezone('Asia/Jakarta') : null;
                $daysLeft = $deadline ? $deadline->diffInDays($wibNow, false) : null;
                $applicantCount = $lowongan->magang()->count();
                $isExpired = $deadline && $deadline->isPast();
            @endphp
            <div class="bg-white flex-col rounded-xl flex py-6 px-4 gap-4 relative z-0 {{ $isExpired ? 'opacity-75' : '' }}">
                <div class="inline-flex items-center gap-6">
                    <img src="{{ $lowongan->perusahaanMitra->logo ? $lowongan->perusahaanMitra->logo_url : asset('images/placeholder_perusahaan.png') }}" 
                         alt="Logo {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}"
                         class="w-20 h-20 rounded-lg object-contain bg-gray-50">
                    <div class="flex flex-col flex-1 justify-start items-start gap-2 h-fill cursor-pointer" 
                         onclick="window.location.href='{{ route('mahasiswa.lowongan.detail', $lowongan->id_lowongan) }}'">
                        <div class="self-stretch inline-flex justify-start items-center gap-4">
                            <div class="justify-start text-black text-lg font-medium leading-none hover:text-primary-600 transition-colors">
                                {{ $lowongan->judul_lowongan }}
                            </div>
                        </div>
                        <div class="inline-flex justify-start items-center gap-2">
                            <span class="justify-start text-neutral-400 text-sm font-normal leading-none truncate max-w-[120px]">
                                {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                            </span>
                            <div class="w-1 h-1 bg-neutral-400 rounded-full flex-shrink-0"></div>
                            <span class="justify-start text-neutral-400 text-sm font-normal leading-none truncate max-w-[150px]">
                                {{ $lowongan->perusahaanMitra->alamat }}
                            </span>
                        </div>
                        <div class="inline-flex justify-start items-start gap-2">
                            <span class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">
                                {{ strtoupper($lowongan->jenis_magang) }}
                            </span>
                            <span class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">
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
                    @if($lowongan->deadline_pendaftaran)
                        <span class="justify-start text-neutral-400 text-sm font-normal leading-none">
                            @if($isExpired)
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
                @if(isset($filters['search']) && $filters['search'])
                    <div class="text-gray-500 text-lg">Tidak ada lowongan yang sesuai dengan pencarian "{{ $filters['search'] }}"</div>
                    <div class="text-gray-400 text-sm mt-2">Coba kata kunci lain atau <a href="{{ route('mahasiswa.lowongan') }}" class="text-primary-500 hover:underline">lihat semua lowongan</a></div>
                @else
                    <div class="text-gray-500 text-lg">Tidak ada lowongan yang sesuai dengan filter</div>
                    <div class="text-gray-400 text-sm mt-2">Coba ubah filter atau <a href="{{ route('mahasiswa.lowongan') }}" class="text-primary-500 hover:underline">reset semua filter</a></div>
                @endif
            </div>
        @endforelse
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle Tipe Magang filter
    document.querySelectorAll('.filter-tipe-magang').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            const value = this.getAttribute('data-value');
            const text = this.textContent.trim();
            
            // Update button text
            document.getElementById('selected-tipe-magang').textContent = text;
            
            // Apply filter
            applyFilter('jenis_magang', value);
        });
    });

    // Handle Perusahaan filter
    document.querySelectorAll('.filter-perusahaan').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            const value = this.getAttribute('data-value');
            const text = this.textContent.trim();
            
            // Update button text
            document.getElementById('selected-perusahaan').textContent = text;
            
            // Apply filter
            applyFilter('jenis_perusahaan', value);
        });
    });

    // Handle Lokasi filter
    document.getElementById('lokasi-filter').addEventListener('change', function() {
        const value = this.value;
        applyFilter('lokasi', value);
    });

    function applyFilter(filterName, filterValue) {
        const url = new URL(window.location);
        
        if (filterValue) {
            url.searchParams.set(filterName, filterValue);
        } else {
            url.searchParams.delete(filterName);
        }
        
        window.location.href = url.toString();
    }
});
</script>