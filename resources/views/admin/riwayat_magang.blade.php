@extends('layout.template')

@section('content')
    <div class="w-full p-4 bg-white rounded-xl flex-col space-y-4">
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-medium">Riwayat Magang</div>
            <div class="flex gap-2">
                <a href="#" class="btn-primary bg-blue-500 hover:bg-blue-600">
                    <i class="ph ph-export text-lg"></i> Export Data
                </a>
            </div>
        </div>
        <form method="GET" action="{{ route('admin.kelola-magang.riwayat_magang') }}" id="searchForm"
            class="flex justify-end items-center gap-2">
            <input type="hidden" name="lowongan_id" value="{{ $currentLowongan }}">
            <x-search-input placeholder="Cari data magang..." name="search" value="{{ $currentSearch }}" id="searchInput" />
        </form>
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="w-fit px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="w-1/6 px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Nama Mahasiswa
                                    </th>
                                    <th scope="col"
                                        class="w-1/5 px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Judul Lowongan
                                    </th>
                                    <th scope="col"
                                        class="w-1/6 px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Nama Perusahaan
                                    </th>
                                    <th scope="col"
                                        class="w-1/6 px-3 py-1.5 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Dosen Pembimbing
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Sertifikat
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400 whitespace-nowrap">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse ($riwayatMagang as $item)
                                    <tr>
                                        <td
                                            class="px-3 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $item->id_magang }}
                                        </td>
                                        <td
                                            class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                            {{ $item->mahasiswa->user->name }}
                                        </td>
                                        <td
                                            class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-36 truncate">
                                            {{ $item->lowongan->judul_lowongan }}
                                        </td>
                                        <td
                                            class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                            {{ $item->lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                                        </td>
                                        <td
                                            class="px-3 py-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200 max-w-32 truncate">
                                            {{ $item->dosenPembimbing ? $item->dosenPembimbing->user->name : 'Belum ditambahkan' }}
                                        </td>
                                        <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                            <div class="flex justify-start gap-2">
                                                <a href="#"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-eye class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-blue-500 hover:bg-gray-200 focus:outline-hidden border border-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-download class="w-4 h-4 text-blue-500" />
                                                </a>
                                            </div>
                                        </td>
                                        <td class="px-6 py-1.5 whitespace-nowrap text-sm font-medium">
                                            <div class="flex justify-start gap-2">
                                                <a href="#"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-yellow-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </a>
                                                <a href="#"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-red-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">
                                            Tidak ada data magang yang tersedia.
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
        @if ($riwayatMagang->hasPages())
            <div class="flex items-center justify-end mt-8">
                {{ $riwayatMagang->links('custom.pagination') }}
            </div>
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Search functionality with debounce
            const searchInput = document.getElementById('searchInput');
            const searchForm = document.getElementById('searchForm');
            let searchTimeout;

            if (searchInput && searchForm) {
                searchInput.addEventListener('input', function () {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(function () {
                        searchForm.submit();
                    }, 500);
                });

                searchInput.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        clearTimeout(searchTimeout);
                        searchForm.submit();
                    }
                });
            }
        });
    </script>
@endsection