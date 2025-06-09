@extends('layout.template')
@section('content')
    <div class="space-y-4">
        <!-- Profile section remains unchanged -->
        <div class="bg-white h-fit p-4 rounded-lg space-y-4">
            <div class="flex justify-between items-start">
                <p class="text-xl font-medium text-neutral-900">Detail Pengguna</p>
                <a href="#" class=" outline-primary-500 text-primary-500 btn-outline-sm">
                    <x-lucide-lock class="size-6 " stroke-width="1.5" />
                    Atur Ulang Kata Sandi
                </a>
            </div>
            <div class="flex items-center gap-x-9">
                <div class="w-30 h-30 rounded-2xl overflow-hidden">
                    @if (isset($user->profile_photo) && $user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Picture"
                            class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('images/avatar.svg') }}" alt="Default Profile"
                            class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="space-y-6">
                    <p class="text-lg text-neutral-900 font-medium">{{ $user->name }}</p>
                    <div class="flex items-start gap-9">
                        <div class="space-y-2">
                            <p class="text-sm text-neutral-400 font-normal">NIP</p>
                            <p class="text-sm text-neutral-900 font-semibold">{{ $dosenPembimbing->nip }}</p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-sm text-neutral-400 font-normal">Email</p>
                            <p class="text-sm text-neutral-900 font-semibold">{{ $user->email }}</p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-sm text-neutral-400 font-normal">Bidang Minat</p>
                            <p class="text-sm text-neutral-900 font-semibold">{{ $dosenPembimbing->bidang_minat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mahasiswa Bimbingan section with pagination, filtering and search -->
        <div class="bg-white h-fit p-4 rounded-lg space-y-6">
            <div class="flex justify-between items-center">
                <p class="text-xl font-medium text-neutral-900">Mahasiswa Bimbingan</p>
                <a href="#" class="btn-primary bg-blue-500 text-white">
                    <i class="ph ph-export"></i>
                    Export
                </a>
            </div>

            <!-- Filter and Search -->
            <div class="flex items-center justify-between">
                <!-- Status filter dropdown -->
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-status" type="button"
                        class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        @if ($currentStatus == 'all')
                            Semua Status
                        @elseif($currentStatus == 'magang')
                            Magang
                        @elseif($currentStatus == 'diterima')
                            Diterima
                        @elseif($currentStatus == 'selesai')
                            Selesai
                        @else
                            Status
                        @endif
                        <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-status">
                        <div class="p-1 space-y-0.5">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 {{ $currentStatus == 'all' ? 'bg-gray-100' : '' }}"
                                href="{{ route('admin.pengguna.detail_dospem', ['id' => $user->id_user, 'status' => 'all', 'search' => $currentSearch]) }}">
                                Semua Status
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 {{ $currentStatus == 'magang' ? 'bg-gray-100' : '' }}"
                                href="{{ route('admin.pengguna.detail_dospem', ['id' => $user->id_user, 'status' => 'magang', 'search' => $currentSearch]) }}">
                                Magang
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 {{ $currentStatus == 'diterima' ? 'bg-gray-100' : '' }}"
                                href="{{ route('admin.pengguna.detail_dospem', ['id' => $user->id_user, 'status' => 'diterima', 'search' => $currentSearch]) }}">
                                Diterima
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 {{ $currentStatus == 'selesai' ? 'bg-gray-100' : '' }}"
                                href="{{ route('admin.pengguna.detail_dospem', ['id' => $user->id_user, 'status' => 'selesai', 'search' => $currentSearch]) }}">
                                Selesai
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Search input with form -->
                <form method="GET" action="{{ route('admin.pengguna.detail_dospem', $user->id_user) }}" class="relative">
                    <input type="hidden" name="status" value="{{ $currentStatus }}">
                    <div class="relative">
                        <input type="text" name="search" value="{{ $currentSearch }}"
                            class="py-2 px-4 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Cari mahasiswa...">
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                            <x-lucide-search class="h-4 w-4 text-gray-400" />
                        </div>
                        @if ($currentSearch)
                            <div class="absolute inset-y-0 end-0 flex items-center pe-4">
                                <a href="{{ route('admin.pengguna.detail_dospem', ['id' => $user->id_user, 'status' => $currentStatus]) }}"
                                    class="text-gray-500 hover:text-gray-700">
                                    <x-lucide-x class="h-4 w-4" />
                                </a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div>
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                    <!-- Table header remains the same -->
                                    <thead class="bg-gray-50 dark:bg-neutral-700">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-auto">
                                                NIM</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                Nama Mahasiswa</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                Judul Lowongan</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                Nama Perusahaan</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-auto">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                        @forelse($mahasiswaBimbingan as $magang)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 w-auto">
                                                    {{ $magang->mahasiswa->nim ?? 'N/A' }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $magang->mahasiswa->user->name ?? 'N/A' }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $magang->lowongan->judul_lowongan ?? 'N/A' }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $magang->lowongan->perusahaanMitra->nama_perusahaan_mitra ?? 'N/A' }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 w-auto">
                                                    @php
                                                        $statusClass = 'border-gray-500 text-gray-500';
                                                        $statusText = 'Selesai';

                                                        if ($magang->status_magang == 'magang') {
                                                            $statusClass = 'border-blue-600 text-blue-600';
                                                            $statusText = 'Magang';
                                                        } elseif ($magang->status_magang == 'diterima') {
                                                            $statusClass = 'border-teal-500 text-teal-500';
                                                            $statusText = 'Diterima';
                                                        }
                                                    @endphp
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border {{ $statusClass }}">
                                                        {{ $statusText }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                                    <div class="flex flex-col items-center py-5">
                                                        <x-lucide-users class="w-12 h-12 text-gray-300 mb-2" />
                                                        <p>Tidak ada mahasiswa bimbingan yang ditemukan</p>
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
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Menampilkan {{ $mahasiswaBimbingan->firstItem() ?? 0 }}-{{ $mahasiswaBimbingan->lastItem() ?? 0 }}
                    dari {{ $mahasiswaBimbingan->total() }} mahasiswa
                </div>

                <!-- Pagination links -->
                @if ($mahasiswaBimbingan->hasPages())
                    <nav class="flex items-center gap-x-1" aria-label="Pagination">
                        <!-- Previous page -->
                        <a href="{{ $mahasiswaBimbingan->previousPageUrl() }}"
                            class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 {{ $mahasiswaBimbingan->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}"
                            aria-label="Previous">
                            <x-lucide-chevron-left class="shrink-0 size-3.5" stroke-width="2" />
                            <span>Sebelumnya</span>
                        </a>

                        <!-- Page numbers -->
                        <div class="flex items-center gap-x-1">
                            @foreach ($mahasiswaBimbingan->getUrlRange(max($mahasiswaBimbingan->currentPage() - 2, 1), min($mahasiswaBimbingan->currentPage() + 2, $mahasiswaBimbingan->lastPage())) as $page => $url)
                                <a href="{{ $url }}"
                                    class="min-h-9.5 min-w-9.5 flex justify-center items-center {{ $page == $mahasiswaBimbingan->currentPage() ? 'bg-gray-200 text-gray-800' : 'text-gray-800 hover:bg-gray-100' }} py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none dark:{{ $page == $mahasiswaBimbingan->currentPage() ? 'bg-neutral-600 text-white' : 'text-white hover:bg-white/10' }} dark:focus:bg-{{ $page == $mahasiswaBimbingan->currentPage() ? 'neutral-500' : 'white/10' }}"
                                    {{ $page == $mahasiswaBimbingan->currentPage() ? 'aria-current="page"' : '' }}>
                                    {{ $page }}
                                </a>
                            @endforeach
                        </div>

                        <!-- Next page -->
                        <a href="{{ $mahasiswaBimbingan->nextPageUrl() }}"
                            class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 {{ $mahasiswaBimbingan->hasMorePages() ? '' : 'opacity-50 pointer-events-none' }}"
                            aria-label="Next">
                            <span>Selanjutnya</span>
                            <x-lucide-chevron-right class="shrink-0 size-3.5" stroke-width="2" />
                        </a>
                    </nav>
                @endif
            </div>
        </div>
    </div>
@endsection
