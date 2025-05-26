@extends('layout.template')

@section('content')
    <div class="w-full p-4 bg-white rounded-2xl flex-col space-y-4">
        <!-- Header dan tombol aksi -->
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-medium">Pengguna</div>
            <div class="flex gap-2">
                <a href="#" class="btn-primary bg-blue-500 hover:bg-blue-600">
                    <i class="ph ph-export text-lg"></i> Export
                </a>
                <a href="#" class="btn-primary bg-amber-500 hover:bg-amber-600">
                    <i class="ph ph-arrow-square-in"></i> Import
                </a>
                <a href="#" class="btn-primary">
                    <i class="ph ph-plus"></i> Tambah Pengguna
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[16px]">
            <!-- Card 1 -->
            <div
                class="self-stretch p-4 bg-white rounded-lg outline-1 outline-offset-[-1px] outline-gray-200 flex flex-col items-center gap-2">
                <div class="flex items-center justify-center gap-[8px] mb-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-user-check class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base text-neutral-400 font-medium">Mahasiswa</span>
                </div>
                <div class="flex-1 flex items-center justify-center">
                    <span class="text-4xl font-medium text-neutral-900">{{ $jumlahMahasiswa }}</span>
                </div>
            </div>
            <!-- Card 2 -->
            <div
                class="self-stretch p-4 bg-white rounded-lg outline-1 outline-offset-[-1px] outline-gray-200 flex flex-col items-center gap-2">
                <div class="flex items-center justify-center gap-[8px] mb-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-square-user-round class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base text-neutral-400 font-medium">Dosen Pembimbing</span>
                </div>
                <div class="flex-1 flex items-center justify-center">
                    <span class="text-4xl font-medium text-neutral-900">{{ $jumlahDosen }}</span>
                </div>
            </div>
            <!-- Card 3 -->
            <div
                class="self-stretch p-4 bg-white rounded-lg outline-1 outline-offset-[-1px] outline-gray-200 flex flex-col items-center gap-2">
                <div class="flex items-center justify-center gap-[8px] mb-2">
                    <div class="bg-primary-50 rounded-sm p-2 w-fit h-fit flex items-center justify-center">
                        <x-lucide-user-round-cog class="size-5 text-primary-600" stroke-width="1.5" />
                    </div>
                    <span class="text-base text-neutral-400 font-medium">Admin</span>
                </div>
                <div class="flex-1 flex items-center justify-center">
                    <span class="text-4xl font-medium text-neutral-900">{{ $jumlahAdmin }}</span>
                </div>
            </div>
        </div>

        <!-- Filter "Semua Pengguna" & "Cari Pengguna" -->
        <div class="flex justify-between space-x-4">
            <div class="hs-dropdown relative inline-flex">
                <button id="hs-dropdown-status" type="button"
                    class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Semua Pengguna
                    <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>

                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-status">
                    <div class="p-1 space-y-0.5">
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            Semua Pengguna
                        </a>
                        @foreach ($level as $item )
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            {{ $item->nama_level }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <x-search-input placeholder="Cari pengguna..." />
        </div>

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
                                        Level</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Email</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-full">
                                        Nama Pengguna</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 whitespace-nowrap">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                <!-- 1 -->
                                @foreach ($user as $item)
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $item->id_user }}
                                        </td>
                                        @if ($item->level->kode_level == 'ADM')
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-blue-600 text-blue-600 dark:text-blue-500">{{ $item->level->nama_level }}</span>
                                        </td>
                                        @elseif ($item->level->kode_level == 'DSP')
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">{{ $item->level->nama_level }}</span>
                                        </td>
                                        @else
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-yellow-500 text-yellow-500">{{ $item->level->nama_level }}</span>
                                            </td>
                                        @endif 
                                        
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->email }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-end">
                                            <div class="flex justify-end gap-2">
                                                <a href="#"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <a href="#"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </a>
                                                <a href="#"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end">
            <!-- Pagination -->
            <nav class="flex items-center gap-x-1" aria-label="Pagination">
                @if ($user->onFirstPage())
                    <button type="button" disabled
                        class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-400 bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-500 dark:bg-neutral-800">
                        <x-lucide-chevron-left class="shrink-0 size-3.5" stroke-width="2" />
                        <span>Sebelumnya</span>
                    </button>
                @else
                    <a href="{{ $user->previousPageUrl() }}"
                        class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                        <x-lucide-chevron-left class="shrink-0 size-3.5" stroke-width="2" />
                        <span>Sebelumnya</span>
                    </a>
                @endif
                
                <div class="flex items-center gap-x-1">
                    @for ($i = 1; $i <= $user->lastPage(); $i++)
                        @if ($i == $user->currentPage())
                            <button type="button"
                                class="min-h-9.5 min-w-9.5 flex justify-center items-center bg-gray-200 text-gray-800 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-600 dark:text-white dark:focus:bg-neutral-500"
                                aria-current="page">{{ $i }}</button>
                        @else
                            <a href="{{ $user->url($i) }}"
                                class="min-h-9.5 min-w-9.5 flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-gray-100 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                                {{ $i }}
                            </a>
                        @endif
                    @endfor
                </div>
                
                @if ($user->hasMorePages())
                    <a href="{{ $user->nextPageUrl() }}"
                        class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                        <span>Selanjutnya</span>
                        <x-lucide-chevron-right class="shrink-0 size-3.5" stroke-width="2" />
                    </a>
                @else
                    <button type="button" disabled
                        class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-400 bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-500 dark:bg-neutral-800">
                        <span>Selanjutnya</span>
                        <x-lucide-chevron-right class="shrink-0 size-3.5" stroke-width="2" />
                    </button>
                @endif
            </nav>
            <!-- End Pagination -->
        </div>
    </div>
@endsection