@extends('layout.template')

@section('content')
    <div class="w-full p-4 bg-white rounded-xl flex-col space-y-4">
        <!-- Header dan tombol aksi -->
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-medium">Perusahaan Mitra</div>
            <div class="flex gap-2">
                <a href="#" class="btn-primary bg-blue-500 hover:bg-blue-600">
                    <x-lucide-download class="size-4" /> Export
                </a>
                <a href="#" class="btn-primary bg-amber-500 hover:bg-amber-600">
                    <x-lucide-upload class="size-4" /> Import
                </a>
                <a href="{{ route('admin.perusahaan.create') }}" class="btn-primary">
                    <x-lucide-plus class="size-4" /> Tambah Perusahaan
                </a>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="flex justify-between w-full items-center">
            <div class="hs-dropdown relative inline-flex">
                <button id="hs-dropdown-default" type="button"
                    class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-neutral-900 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    @if($currentFilter == 'all')
                        Semua Perusahaan
                    @else
                        {{ $jenisPerusahaan->where('id_jenis_perusahaan', $currentFilter)->first()->nama_jenis_perusahaan ?? 'Semua Perusahaan' }}
                    @endif
                    <x-lucide-chevron-down class="hs-dropdown-open:rotate-180 size-4" />
                </button>

                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                    <div class="p-1 space-y-0.5">
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 {{ $currentFilter == 'all' ? 'bg-gray-100' : '' }}"
                            href="{{ route('admin.perusahaan', ['search' => $currentSearch]) }}">
                            Semua Perusahaan
                        </a>
                        @foreach ($jenisPerusahaan as $item)
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 {{ $currentFilter == $item->id_jenis_perusahaan ? 'bg-gray-100' : '' }}"
                                href="{{ route('admin.perusahaan', ['jenis_perusahaan' => $item->id_jenis_perusahaan, 'search' => $currentSearch]) }}">
                                {{ $item->nama_jenis_perusahaan }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Search dengan komponen search-input -->
            <div class="flex items-center gap-2">
                <form method="GET" action="{{ route('admin.perusahaan') }}" id="searchForm" class="flex items-center gap-2">
                    <x-search-input 
                        name="search" 
                        value="{{ $currentSearch }}" 
                        placeholder="Cari perusahaan..." 
                        id="searchInput"
                        class="py-3 px-4 pl-11 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" />
                    <input type="hidden" name="jenis_perusahaan" value="{{ $currentFilter }}">
                </form>
            </div>
        </div>

        <!-- Results Info -->
        @if($currentSearch || $currentFilter != 'all')
            <div class="text-sm text-gray-600">
                Menampilkan {{ $perusahaanMitra->count() }} dari {{ $perusahaanMitra->total() }} hasil
                @if($currentSearch)
                    untuk pencarian "<strong>{{ $currentSearch }}</strong>"
                @endif
                @if($currentFilter != 'all')
                    dengan filter "<strong>{{ $jenisPerusahaan->where('id_jenis_perusahaan', $currentFilter)->first()->nama_jenis_perusahaan ?? '' }}</strong>"
                @endif
            </div>
        @endif

        <!-- Table -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        ID</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Nama Perusahaan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Bidang Industri</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Jenis Perusahaan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-full">
                                        Lokasi</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 whitespace-nowrap">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse ($perusahaanMitra as $item)
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $item->id_perusahaan_mitra }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->nama_perusahaan_mitra }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->bidang_industri }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->jenisPerusahaan->nama_jenis_perusahaan ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->alamat }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-end">
                                            <div class="flex justify-end gap-2">
                                                <a href="#"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-edit class="w-4 h-4 text-yellow-500" />
                                                </a>
                                                <a href="#"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <x-lucide-search class="w-12 h-12 text-gray-300 mb-4" />
                                                <p>Tidak ada perusahaan yang ditemukan</p>
                                                @if($currentSearch || $currentFilter != 'all')
                                                    <a href="{{ route('admin.perusahaan') }}" class="text-blue-600 hover:text-blue-500 mt-2">
                                                        Reset pencarian
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if($perusahaanMitra->hasPages())
            <div class="flex items-center justify-end mt-8">
                {{ $perusahaanMitra->links() }}
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchForm = document.getElementById('searchForm');
            let searchTimeout;

            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    searchForm.submit();
                }, 500); // Delay 500ms setelah user berhenti mengetik
            });

            // Submit form ketika user menekan Enter
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    searchForm.submit();
                }
            });
        });
    </script>
@endsection
