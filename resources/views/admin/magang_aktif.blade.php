@extends('layout.template')

@section('content')
    <div class="w-full p-4 bg-white rounded-xl flex-col space-y-4">
        <!-- Header dan tombol aksi -->
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-medium">Magang Aktif</div>
            <div class="flex gap-2">
                <a href="#" class="btn-primary bg-blue-500 hover:bg-blue-600">
                    <i class="ph ph-export text-lg"></i> Export Data
                </a>
            </div>
        </div>

        <!-- Filter "Semua Status" & Search -->
        <div class="flex justify-between w-full items-center">
            <div class="flex items-start space-x-2">
                <!-- Status Filter -->
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-default" type="button"
                        class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-neutral-900 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        {{ request('status', 'Semua Status') }}
                        <x-lucide-chevron-down class="hs-dropdown-open:rotate-180 size-4" />
                    </button>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                        <div class="p-1 space-y-0.5">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="{{ route('admin.kelola-magang.magang_aktif', ['status' => 'magang']) }}">
                                Magang
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="{{ route('admin.kelola-magang.magang_aktif', ['status' => 'diterima']) }}">
                                Diterima
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Filter by Pembimbing -->
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-default1" type="button"
                        class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-neutral-900 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        {{ request('pembimbing', 'Semua Magang') }}
                        <x-lucide-chevron-down class="hs-dropdown-open:rotate-180 size-4" />
                    </button>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default1">
                        <div class="p-1 space-y-0.5">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="{{ route('admin.kelola-magang.magang_aktif', ['pembimbing' => 'dengan']) }}">
                                Dengan Dosen Pembimbing
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="{{ route('admin.kelola-magang.magang_aktif', ['pembimbing' => 'tanpa']) }}">
                                Tanpa Dosen Pembimbing
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Input -->
            <form method="GET" action="{{ route('admin.kelola-magang.magang_aktif') }}">
                <input type="hidden" name="status" value="{{ request('status') }}">
                <input type="hidden" name="pembimbing" value="{{ request('pembimbing') }}">
                <x-search-input placeholder="Cari data magang..." name="search" value="{{ request('search') }}" />
            </form>
        </div>

        <!-- Table Section -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <!-- Table Header -->
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="w-12 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        ID</th>
                                    <th scope="col"
                                        class="w-32 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Nama Mahasiswa</th>
                                    <th scope="col"
                                        class="w-40 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Judul Lowongan</th>
                                    <th scope="col"
                                        class="w-36 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Nama Perusahaan</th>
                                    <th scope="col"
                                        class="w-24 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Status</th>
                                    <th scope="col"
                                        class="w-36 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Dosen Pembimbing</th>
                                    <th scope="col"
                                        class="w-24 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400 whitespace-nowrap">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <!-- Table Body -->
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse ($aktiveMagang as $item)
                                    <tr>
                                        <td class="px-3 py-3 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $item->id_magang }}
                                        </td>
                                        <td class="px-3 py-3 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            <div class="truncate max-w-32">{{ $item->mahasiswa->user->name }}</div>
                                        </td>
                                        <td class="px-3 py-3 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            <div class="truncate max-w-40">{{ $item->lowongan->judul_lowongan }}</div>
                                        </td>
                                        <td class="px-3 py-3 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            <div class="truncate max-w-36">{{ $item->lowongan->perusahaanMitra->nama_perusahaan_mitra }}</div>
                                        </td>
                                        <td class="px-3 py-3 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            <span class="inline-flex items-center gap-x-1 py-1 px-2 rounded-md text-xs font-medium border {{ $item->status_magang === 'magang' ? 'border-blue-600 text-blue-600' : 'border-teal-500 text-teal-500' }}">
                                                {{ ucfirst($item->status_magang) }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-3 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            <div class="truncate max-w-36">
                                                {{ $item->dosenPembimbing ? $item->dosenPembimbing->user->name : 'Belum Ditambahkan' }}
                                            </div>
                                        </td>
                                        <td class="px-3 py-3 text-sm font-medium">
                                            <div class="flex justify-start gap-1">
                                                <a href="{{ route('admin.kelola-magang.detail', $item->id_magang) }}" 
                                                   class="flex shrink-0 justify-center items-center size-9 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="{{ route('admin.kelola-magang', $item->id_magang) }}"
                                                   class="flex shrink-0 justify-center items-center size-9 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </a>
                                                <button onclick="confirmDelete({{ $item->id_magang }})"
                                                        class="flex shrink-0 justify-center items-center size-9 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Tidak ada data magang aktif yang tersedia.
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
        @if ($aktiveMagang->hasPages())
            <div class="flex items-center justify-end mt-4">
                {{ $aktiveMagang->links('custom.pagination') }}
            </div>
        @endif
    </div>

@endsection

@push('scripts')
<script>
    function confirmDelete(id) {
    }
</script>
@endpush
