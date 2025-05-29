@extends('layout.template')
@section('content')
    <!-- Header section remains the same -->
    <div class="flex flex-row items-center justify-between">
        <div>
            <h2 class="text-xl font-medium">Daftar Lowongan</h2>
        </div>
        <div class="flex-row">
            <div class="flex gap-2">
                <a href="#" class="btn-primary bg-blue-500 hover:bg-blue-600">
                    <i class="ph ph-export text-lg"></i> Export
                </a>
                <a href="#" class="btn-primary bg-amber-500 hover:bg-amber-600">
                    <i class="ph ph-arrow-square-in"></i> Import
                </a>
                <a href="{{ route('admin.lowongan.tambah') }}" class="btn-primary">
                    <i class="ph ph-plus"></i> Tambah Lowongan
                </a>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="mt-5 flex flex-row justify-between">
        <div class="flex gap-2">
            <!-- Filter Periode -->
            <form method="GET" action="{{ route('admin.lowongan') }}" class="inline" id="filter-periode-form">
                <input type="hidden" name="perusahaan" value="{{ $currentPerusahaan }}">
                <input type="hidden" name="search" value="{{ $currentSearch }}">
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-periode" type="button"
                        class="hs-dropdown-toggle py-2 px-4 inline-flex items-center gap-x-2 text-sm rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        {{ $currentPeriode == 'all' ? 'Semua Periode' : $periodeList->where('id_periode_magang', $currentPeriode)->first()?->nama_periode ?? 'Semua Periode' }}
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden w-60 bg-white shadow-md rounded-lg mt-2"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-periode">
                        <div class="p-1 space-y-0.5">
                            <button type="submit" name="periode" value="all"
                                class="w-full text-left flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                                Semua Periode
                            </button>
                            @foreach ($periodeList as $periode)
                                <button type="submit" name="periode" value="{{ $periode->id_periode_magang }}"
                                    class="w-full text-left flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                                    {{ $periode->nama_periode }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>

            <!-- Filter Perusahaan -->
            <form method="GET" action="{{ route('admin.lowongan') }}" class="inline" id="filter-perusahaan-form">
                <input type="hidden" name="periode" value="{{ $currentPeriode }}">
                <input type="hidden" name="search" value="{{ $currentSearch }}">
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-perusahaan" type="button"
                        class="hs-dropdown-toggle py-2 px-4 inline-flex items-center gap-x-2 text-sm rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        {{ $currentPerusahaan == 'all' ? 'Semua Perusahaan' : $perusahaanList->where('id_perusahaan_mitra', $currentPerusahaan)->first()?->nama_perusahaan_mitra ?? 'Semua Perusahaan' }}
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden w-60 bg-white shadow-md rounded-lg mt-2"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-perusahaan">
                        <div class="p-1 space-y-0.5">
                            <button type="submit" name="perusahaan" value="all"
                                class="w-full text-left flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                                Semua Perusahaan
                            </button>
                            @foreach ($perusahaanList as $perusahaan)
                                <button type="submit" name="perusahaan" value="{{ $perusahaan->id_perusahaan_mitra }}"
                                    class="w-full text-left flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                                    {{ $perusahaan->nama_perusahaan_mitra }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Live Search Form -->
        <div class="flex items-center gap-2">
            <form method="GET" action="{{ route('admin.lowongan') }}" id="searchForm" class="flex items-center gap-2">
                <x-search-input 
                    name="search" 
                    value="{{ $currentSearch }}" 
                    placeholder="Cari lowongan..."
                    id="live-search-input"
                    class="py-3 px-4 pl-11 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                />
                <input type="hidden" name="periode" value="{{ $currentPeriode }}">
                <input type="hidden" name="perusahaan" value="{{ $currentPerusahaan }}">
                
                <!-- Loading indicator -->
                <div id="search-loading" class="hidden">
                    <div class="animate-spin h-4 w-4 border-2 border-primary-500 border-t-transparent rounded-full"></div>
                </div>
            </form>
        </div>
    </div>

    <!-- Loading overlay for content -->
    <div id="content-loading" class="hidden">
        <div class="flex justify-center items-center mt-10 w-full p-8 rounded-md">
            <div class="text-center">
                <div class="animate-spin h-8 w-8 border-4 border-primary-500 border-t-transparent rounded-full mx-auto mb-4"></div>
                <p class="text-gray-500">Mencari lowongan...</p>
            </div>
        </div>
    </div>

    <!-- Lowongan List Container -->
    <div id="lowongan-container">
        @include('admin.partials.lowongan-list', ['lowongan' => $lowongan])
    </div>

    <script>
        let searchTimeout;
        const searchInput = document.getElementById('live-search-input');
        const searchLoading = document.getElementById('search-loading');
        const contentLoading = document.getElementById('content-loading');
        const lowonganContainer = document.getElementById('lowongan-container');
        
        // Current filter values
        let currentPeriode = '{{ $currentPeriode }}';
        let currentPerusahaan = '{{ $currentPerusahaan }}';

        // Live search function
        function performSearch(searchTerm) {
            // Show loading indicators
            searchLoading.classList.remove('hidden');
            contentLoading.classList.remove('hidden');
            lowonganContainer.classList.add('hidden');
            
            // Build URL with current filters
            const url = new URL('{{ route("admin.lowongan") }}', window.location.origin);
            const params = new URLSearchParams();
            
            if (currentPeriode !== 'all') {
                params.append('periode', currentPeriode);
            }
            if (currentPerusahaan !== 'all') {
                params.append('perusahaan', currentPerusahaan);
            }
            if (searchTerm.trim()) {
                params.append('search', searchTerm.trim());
            }
            
            url.search = params.toString();
            
            // Update browser URL without reload
            window.history.replaceState({}, '', url.toString());
            
            // Perform AJAX request
            fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
            .then(response => response.text())
            .then(html => {
                // Parse the response to get only the lowongan container content
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.getElementById('lowongan-container');
                
                if (newContent) {
                    lowonganContainer.innerHTML = newContent.innerHTML;
                }
                
                // Hide loading indicators
                searchLoading.classList.add('hidden');
                contentLoading.classList.add('hidden');
                lowonganContainer.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Search error:', error);
                // Hide loading indicators
                searchLoading.classList.add('hidden');
                contentLoading.classList.add('hidden');
                lowonganContainer.classList.remove('hidden');
            });
        }

        // Search input event listener
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value;
            
            // Clear previous timeout
            clearTimeout(searchTimeout);
            
            // Set new timeout for 300ms delay
            searchTimeout = setTimeout(() => {
                performSearch(searchTerm);
            }, 300);
        });

        // Update current filter values when form submissions occur
        document.addEventListener('DOMContentLoaded', function() {
            // Update periode filter
            const periodeForm = document.getElementById('filter-periode-form');
            if (periodeForm) {
                periodeForm.addEventListener('submit', function(e) {
                    const formData = new FormData(e.target);
                    currentPeriode = formData.get('periode') || 'all';
                });
            }

            // Update perusahaan filter  
            const perusahaanForm = document.getElementById('filter-perusahaan-form');
            if (perusahaanForm) {
                perusahaanForm.addEventListener('submit', function(e) {
                    const formData = new FormData(e.target);
                    currentPerusahaan = formData.get('perusahaan') || 'all';
                });
            }
        });
    </script>
@endsection
