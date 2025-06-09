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
                <a href="{{ route('admin.pengguna.create') }}" class="btn-primary">
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

        <!-- Filter & Search -->
        <div class="flex justify-between w-full items-center">
            <div class="hs-dropdown relative inline-flex">
                <button id="hs-dropdown-default" type="button"
                    class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-neutral-900 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    @if ($currentFilter == 'all')
                        Semua Pengguna
                    @else
                        {{ $level->where('id_level', $currentFilter)->first()->nama_level ?? 'Semua Pengguna' }}
                    @endif
                    <x-lucide-chevron-down class="hs-dropdown-open:rotate-180 size-4" />
                </button>

                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                    <div class="p-1 space-y-0.5">
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 {{ $currentFilter == 'all' ? 'bg-gray-100' : '' }}"
                            href="{{ route('admin.pengguna', ['search' => $currentSearch]) }}">
                            Semua Pengguna
                        </a>
                        @foreach ($level as $item)
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 {{ $currentFilter == $item->id_level ? 'bg-gray-100' : '' }}"
                                href="{{ route('admin.pengguna', ['level_id' => $item->id_level, 'search' => $currentSearch]) }}">
                                {{ $item->nama_level }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Search dengan komponen search-input -->
            <div class="flex items-center gap-2">
                <form method="GET" action="{{ route('admin.pengguna') }}" id="searchForm" class="flex items-center gap-2">
                    <x-search-input name="search" value="{{ $currentSearch }}" placeholder="Cari pengguna..." id="searchInput"
                        class="py-3 px-4 pl-11 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" />
                    <input type="hidden" name="level_id" value="{{ $currentFilter }}">
                </form>
            </div>
        </div>

        <!-- Results Info -->
        @if ($currentSearch || $currentFilter != 'all')
            <div class="text-sm text-gray-600">
                Menampilkan {{ $user->count() }} dari {{ $user->total() }} hasil
                @if ($currentSearch)
                    untuk pencarian "<strong>{{ $currentSearch }}</strong>"
                @endif
                @if ($currentFilter != 'all')
                    dengan filter
                    "<strong>{{ $level->where('id_level', $currentFilter)->first()->nama_level ?? '' }}</strong>"
                @endif
            </div>
        @endif

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
                                @forelse ($user as $item)
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
                                            {{ $item->email }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-end">
                                            <div class="flex justify-end gap-2">
                                                @if ($item->level->kode_level == 'MHS')
                                                    <a href="{{ route('admin.pengguna.detail_mahasiswa', $item->id_user) }}"
                                                        class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                        <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                    </a>
                                                @elseif ($item->level->kode_level == 'DSP')
                                                    <a href="{{ route('admin.pengguna.detail_dospem', $item->id_user) }}"
                                                        class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                        <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                    </a>
                                                @elseif ($item->level->kode_level == 'ADM')
                                                    <a href="{{ route('admin.pengguna.detail_admin', $item->id_user) }}"
                                                        class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                        <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                    </a>
                                                @else
                                                    <a href="#"
                                                        class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none opacity-50 pointer-events-none">
                                                        <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                    </a>
                                                @endif
                                                <button type="button"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none"
                                                    onclick="openEditModal('{{ $item->id_user }}', '{{ $item->name }}', '{{ $item->email }}', '{{ $item->profile_photo }}')">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </button>
                                                <button type="button"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none"
                                                    onclick="confirmDeleteUser('{{ $item->id_user }}', '{{ $item->name }}')">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <x-lucide-search class="w-12 h-12 text-gray-300 mb-4" />
                                                <p>Tidak ada pengguna yang ditemukan</p>
                                                @if ($currentSearch || $currentFilter != 'all')
                                                    <a href="{{ route('admin.pengguna') }}"
                                                        class="text-blue-600 hover:text-blue-500 mt-2">
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
        @if ($user->hasPages())
            <div class="flex items-center justify-end mt-8">
                {{ $user->links('custom.pagination') }}
            </div>
        @endif
    </div>

    <!-- Edit User Modal -->
    <div id="editModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="editModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="editModal-label" class="font-bold text-gray-800 dark:text-white">
                        Edit Pengguna
                    </h3>
                    <button type="button" id="closeEditModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <form id="editUserForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_user_id" name="edit_user_id">

                        <div class="w-full">
                            <label for="edit_name" class="block text-sm font-medium mb-2 dark:text-white">Nama
                                Pengguna</label>
                            <input type="text" id="edit_name" name="name"
                                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukkan nama pengguna">
                        </div>

                        <div class="w-full">
                            <label for="edit_email" class="block text-sm font-medium mb-2 dark:text-white">E-mail</label>
                            <input type="email" id="edit_email" name="email"
                                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukkan alamat e-mail">
                        </div>

                        <div class="w-full">
                            <label for="edit_profile_photo" class="block text-sm font-medium mb-2 dark:text-white">Foto
                                Profil</label>
                            <div class="flex items-center">
                                <div class="w-full relative">
                                    <label for="edit_profile_photo"
                                        class="flex items-center gap-2 w-full py-2.5 sm:py-3 px-4 border border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-gray-50 text-gray-600">
                                        <x-lucide-upload class="size-4 text-gray-500" />
                                        <span id="edit-selected-file" class="text-sm text-gray-700">Unggah foto
                                            profil</span>
                                    </label>
                                    <input type="file" id="edit_profile_photo" name="profile_photo" class="hidden"
                                        accept="image/*">
                                </div>
                            </div>
                            <div id="current-photo-container" class="mt-2 flex items-center gap-2">
                                <div id="current-photo" class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden">
                                    <!-- Image will be inserted here via JS -->
                                </div>
                                <span class="text-xs text-gray-500">Foto profil saat ini</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div
                    class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="cancelEdit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800">
                        Batal
                    </button>
                    <button type="button" id="updateUser"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-600 disabled:opacity-50 disabled:pointer-events-none">
                        <span id="updateButtonText">Perbarui Data</span>
                        <div id="updateSpinner"
                            class="hidden animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full"
                            role="status" aria-label="loading">
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Update Modal -->
    <div id="successUpdateModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="successUpdateModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="successUpdateModal-label" class="font-bold text-gray-800 dark:text-white">
                        Berhasil!
                    </h3>
                    <button type="button" id="closeSuccessUpdateModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-check class="w-8 h-8 text-green-600" />
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Pengguna Berhasil Diperbarui</h4>
                        <p class="text-sm text-gray-600 mb-4">
                            Data pengguna <span id="successUpdateUserName" class="font-semibold text-gray-900"></span> telah
                            berhasil
                            diperbarui.
                        </p>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="closeUpdateSuccessBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        <x-lucide-check class="w-4 h-4" />
                        Selesai
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteUserModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="deleteUserModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="deleteUserModal-label" class="font-bold text-gray-800 dark:text-white">
                        Konfirmasi Hapus
                    </h3>
                    <button type="button" id="closeDeleteModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-trash-2 class="w-8 h-8 text-red-600" />
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Hapus Pengguna</h4>
                        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Apakah Anda yakin ingin menghapus pengguna <span id="deleteUserName"
                                class="font-semibold"></span>?
                        </p>
                        <p class="mt-1 text-xs text-red-600">
                            Tindakan ini akan menghapus semua data terkait dan tidak dapat dibatalkan!
                        </p>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="cancelDeleteUser"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800">
                        Batal
                    </button>
                    <button type="button" id="confirmDeleteUser"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        <span id="deleteUserButtonText">Hapus</span>
                        <div id="deleteUserSpinner"
                            class="hidden animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full"
                            role="status" aria-label="loading">
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Delete Modal -->
    <div id="successDeleteModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="successDeleteModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="successDeleteModal-label" class="font-bold text-gray-800 dark:text-white">
                        Berhasil!
                    </h3>
                    <button type="button" id="closeSuccessDeleteModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-check class="w-8 h-8 text-green-600" />
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Pengguna Berhasil Dihapus</h4>
                        <p id="successDeleteMessage" class="text-sm text-gray-600 mb-4">
                            Data pengguna telah berhasil dihapus.
                        </p>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="closeDeleteSuccessBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        <x-lucide-check class="w-4 h-4" />
                        Selesai
                    </button>
                </div>
            </div>
        </div>

        <script>
            // Define these functions in the global scope
            let editModal = null;
            let successUpdateModal = null;
            let deleteUserModal = null;

            function openEditModal(userId, name, email, profilePhoto) {
                console.log('Opening modal for user:', userId);

                // Set form values
                document.getElementById('edit_user_id').value = userId;
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit-selected-file').textContent = 'Unggah foto profil';

                // Set action for form
                document.getElementById('editUserForm').action = `/admin/pengguna/${userId}`;

                // Display current profile photo if exists
                const currentPhotoContainer = document.getElementById('current-photo');
                currentPhotoContainer.innerHTML = '';

                if (profilePhoto) {
                    const img = document.createElement('img');
                    img.src = "{{ asset('Images') }}/" + profilePhoto; // Use asset helper like in detail_admin
                    img.alt = 'Profile Photo';
                    img.className = 'w-full h-full object-cover';
                    currentPhotoContainer.appendChild(img);
                    document.getElementById('current-photo-container').classList.remove('hidden');
                } else {
                    // If no photo, show placeholder or default avatar
                    const img = document.createElement('img');
                    img.src = "{{ asset('Images/avatar.svg') }}"; // Default avatar like in detail_admin
                    img.alt = 'Default Avatar';
                    img.className = 'w-full h-full object-cover';
                    currentPhotoContainer.appendChild(img);
                    document.getElementById('current-photo-container').classList.remove('hidden');
                }

                try {
                    // Try using HSOverlay from Preline UI
                    const modalElement = document.getElementById('editModal');

                    if (typeof HSOverlay === 'function') {
                        console.log('Using HSOverlay constructor');
                        if (!editModal) {
                            editModal = new HSOverlay(modalElement);
                        }
                        editModal.open();
                    } else if (typeof HSOverlay === 'object' && typeof HSOverlay.open === 'function') {
                        console.log('Using HSOverlay object');
                        HSOverlay.open(modalElement);
                    } else {
                        // Fallback method
                        console.log('Using fallback method to show modal');
                        modalElement.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    }
                } catch (error) {
                    console.error('Error opening modal:', error);

                    // Fallback if HSOverlay fails
                    const modalElement = document.getElementById('editModal');
                    modalElement.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                }
            }

            function closeEditModal() {
                try {
                    if (editModal && typeof editModal.close === 'function') {
                        editModal.close();
                    } else {
                        document.getElementById('editModal').classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                } catch (error) {
                    console.error('Error closing modal:', error);
                    document.getElementById('editModal').classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }

                editModal = null;
            }

            function showSuccessUpdateModal(userName) {
                document.getElementById('successUpdateUserName').textContent = userName;

                try {
                    const modalElement = document.getElementById('successUpdateModal');

                    if (typeof HSOverlay === 'function') {
                        successUpdateModal = new HSOverlay(modalElement);
                        successUpdateModal.open();
                    } else if (typeof HSOverlay === 'object' && typeof HSOverlay.open === 'function') {
                        HSOverlay.open(modalElement);
                    } else {
                        modalElement.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    }
                } catch (error) {
                    console.error('Error opening success modal:', error);
                    document.getElementById('successUpdateModal').classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                }
            }

            function closeSuccessUpdateModal() {
                try {
                    if (successUpdateModal && typeof successUpdateModal.close === 'function') {
                        successUpdateModal.close();
                    } else {
                        document.getElementById('successUpdateModal').classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                } catch (error) {
                    console.error('Error closing success modal:', error);
                    document.getElementById('successUpdateModal').classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }

                successUpdateModal = null;
            }

            // Variables for delete modals
            let deleteUserId = null;
            let deleteModal = null;
            let successDeleteModal = null;

            function confirmDeleteUser(userId, userName) {
                deleteUserId = userId;
                document.getElementById('deleteUserName').textContent = userName;

                try {
                    const modalElement = document.getElementById('deleteUserModal');

                    if (typeof HSOverlay === 'function') {
                        deleteModal = new HSOverlay(modalElement);
                        deleteModal.open();
                    } else if (typeof HSOverlay === 'object' && typeof HSOverlay.open === 'function') {
                        HSOverlay.open(modalElement);
                    } else {
                        modalElement.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    }
                } catch (error) {
                    console.error('Error opening delete modal:', error);
                    document.getElementById('deleteUserModal').classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                }
            }

            function closeDeleteModal() {
                try {
                    if (deleteModal && typeof deleteModal.close === 'function') {
                        deleteModal.close();
                    } else {
                        document.getElementById('deleteUserModal').classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                } catch (error) {
                    console.error('Error closing delete modal:', error);
                    document.getElementById('deleteUserModal').classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }

                deleteModal = null;
                deleteUserId = null;
            }

            function showSuccessDeleteModal(message) {
                if (message) {
                    document.getElementById('successDeleteMessage').textContent = message;
                }

                try {
                    const modalElement = document.getElementById('successDeleteModal');

                    if (typeof HSOverlay === 'function') {
                        successDeleteModal = new HSOverlay(modalElement);
                        successDeleteModal.open();
                    } else if (typeof HSOverlay === 'object' && typeof HSOverlay.open === 'function') {
                        HSOverlay.open(modalElement);
                    } else {
                        modalElement.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    }
                } catch (error) {
                    console.error('Error opening success modal:', error);
                    document.getElementById('successDeleteModal').classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                }
            }

            function closeSuccessDeleteModal() {
                try {
                    if (successDeleteModal && typeof successDeleteModal.close === 'function') {
                        successDeleteModal.close();
                    } else {
                        document.getElementById('successDeleteModal').classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                } catch (error) {
                    console.error('Error closing success modal:', error);
                    document.getElementById('successDeleteModal').classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }

                successDeleteModal = null;
            }

            // Document ready event listeners
            document.addEventListener('DOMContentLoaded', function () {
                // Initialize Preline UI if available
                if (typeof HSStaticMethods !== 'undefined' && typeof HSStaticMethods.autoInit === 'function') {
                    HSStaticMethods.autoInit();
                }

                // Edit photo file input change handler
                const profilePhotoInput = document.getElementById('edit_profile_photo');
                if (profilePhotoInput) {
                    profilePhotoInput.addEventListener('change', function (e) {
                        const fileName = e.target.files[0]?.name || 'Unggah foto profil';
                        document.getElementById('edit-selected-file').textContent = fileName;
                    });
                }

                // Cancel edit button
                const cancelEditBtn = document.getElementById('cancelEdit');
                if (cancelEditBtn) {
                    cancelEditBtn.addEventListener('click', closeEditModal);
                }

                const closeEditModalBtn = document.getElementById('closeEditModalBtn');
                if (closeEditModalBtn) {
                    closeEditModalBtn.addEventListener('click', closeEditModal);
                }

                // Update user button
                const updateUserBtn = document.getElementById('updateUser');
                if (updateUserBtn) {
                    updateUserBtn.addEventListener('click', function () {
                        // Validate form
                        const name = document.getElementById('edit_name').value;
                        const email = document.getElementById('edit_email').value;

                        if (!name.trim()) {
                            alert('Nama pengguna harus diisi!');
                            return;
                        }

                        if (!email.trim()) {
                            alert('Email harus diisi!');
                            return;
                        }

                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(email)) {
                            alert('Format email tidak valid!');
                            return;
                        }

                        // Show loading state
                        this.disabled = true;
                        document.getElementById('updateButtonText').textContent = 'Memperbarui...';
                        document.getElementById('updateSpinner').classList.remove('hidden');

                        // Get the form and prepare for submission
                        const form = document.getElementById('editUserForm');
                        const userId = document.getElementById('edit_user_id').value;

                        // Set the correct action URL with the user ID
                        form.action = "{{ route('admin.pengguna.update', '') }}/" + userId;
                        // Make sure it's a POST form with _method=PUT for Laravel
                        form.method = 'POST';

                        // Check if the hidden PUT method field exists, add if not
                        let methodInput = form.querySelector('input[name="_method"]');
                        if (!methodInput) {
                            methodInput = document.createElement('input');
                            methodInput.type = 'hidden';
                            methodInput.name = '_method';
                            form.appendChild(methodInput);
                        }
                        methodInput.value = 'PUT';

                        // Submit the form
                        form.submit();
                    });
                }

                // Close success modal buttons
                const closeUpdateSuccessBtn = document.getElementById('closeUpdateSuccessBtn');
                if (closeUpdateSuccessBtn) {
                    closeUpdateSuccessBtn.addEventListener('click', function () {
                        closeSuccessUpdateModal();
                        window.location.reload();
                    });
                }

                const closeSuccessUpdateModalBtn = document.getElementById('closeSuccessUpdateModalBtn');
                if (closeSuccessUpdateModalBtn) {
                    closeSuccessUpdateModalBtn.addEventListener('click', function () {
                        closeSuccessUpdateModal();
                        window.location.reload();
                    });
                }

                // Show success modal if there's a session message
                @if(session('success') && session('user_name'))
                    showSuccessUpdateModal('{{ session('user_name') }}');
                @endif

                        // Delete modal buttons
                        const cancelDeleteUserBtn = document.getElementById('cancelDeleteUser');
                if (cancelDeleteUserBtn) {
                    cancelDeleteUserBtn.addEventListener('click', closeDeleteModal);
                }

                const closeDeleteModalBtn = document.getElementById('closeDeleteModalBtn');
                if (closeDeleteModalBtn) {
                    closeDeleteModalBtn.addEventListener('click', closeDeleteModal);
                }

                // Success delete modal buttons
                const closeDeleteSuccessBtn = document.getElementById('closeDeleteSuccessBtn');
                if (closeDeleteSuccessBtn) {
                    closeDeleteSuccessBtn.addEventListener('click', function () {
                        closeSuccessDeleteModal();
                        window.location.reload();
                    });
                }

                const closeSuccessDeleteModalBtn = document.getElementById('closeSuccessDeleteModalBtn');
                if (closeSuccessDeleteModalBtn) {
                    closeSuccessDeleteModalBtn.addEventListener('click', function () {
                        closeSuccessDeleteModal();
                        window.location.reload();
                    });
                }

                // Delete confirmation button
                const confirmDeleteUserBtn = document.getElementById('confirmDeleteUser');
                if (confirmDeleteUserBtn) {
                    confirmDeleteUserBtn.addEventListener('click', function () {
                        if (!deleteUserId) return;

                        // Show loading state
                        this.disabled = true;
                        document.getElementById('deleteUserButtonText').textContent = 'Menghapus...';
                        document.getElementById('deleteUserSpinner').classList.remove('hidden');

                        // Send delete request
                        fetch(`{{ route('admin.pengguna') }}/${deleteUserId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                        })
                            .then(response => {
                                // Check if response is ok (status in 200-299 range)
                                if (!response.ok) {
                                    throw new Error(`HTTP error! Status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                // Close delete modal first
                                closeDeleteModal();
                                // Show success modal
                                showSuccessDeleteModal(data.message);
                            })
                            .catch(error => {
                                console.error('Error:', error);

                                // Close the modal and show success message anyway since the deletion might have succeeded
                                closeDeleteModal();

                                // Check if we should reload - the delete probably worked but had response issues
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1000);
                            })
                            .finally(() => {
                                // Reset button state
                                this.disabled = false;
                                document.getElementById('deleteUserButtonText').textContent = 'Hapus';
                                document.getElementById('deleteUserSpinner').classList.add('hidden');
                            });
                    });
                }

                // Check for success message from session (for delete success)
                @if(session('success') && session('message'))
                showSuccessDeleteModal('{{ session('message') }}');
                @endif
                    });
        </script>
@endsection