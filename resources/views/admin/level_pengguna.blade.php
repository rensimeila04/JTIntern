@extends('layout.template')
@section('content')
    <div class="container mx-auto bg-white rounded-xl p-4">
        {{-- sec1 --}}
        <div class="gap-4 flex justify-between w-full items-center">
            <div>
                <h2 class="text-xl font-medium items-center">Level Pengguna</h2>
            </div>
            <div class="flex gap-x-3 ">
                <div class="flex">
                    <button type="button" data-hs-overlay="#tambahLevelModal" class="btn-primary">
                        <i class="ph ph-plus"></i>
                        Tambah Level
                    </button>
                </div>
            </div>

        </div>

        <div class="flex flex-col mt-6">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden gray:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 gray:bg-neutral-800">
                                <tr>
                                    <th scope="col" class="w-10 px-6 py-3 text-center text-xs font-medium text-gray-500">
                                        ID
                                    </th>
                                    <th scope="col" class="w-24 px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Kode
                                    </th>
                                    <th scope="col" class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Nama Level</th>
                                    <th scope="col" class="w-48 px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($levels as $level)
                                    <tr class="hover:bg-gray-100 gray:hover:bg-neutral-700">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-black">
                                            {{ $level->id_level }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-200 bg-white text-gray-500 shadow-2xs">{{ $level->kode_level }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
                                            {{ $level->nama_level }}
                                        </td>
                                        <td class="gap-2 flex px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
                                            <button type="button" data-level-id="{{ $level->id_level }}" data-level-url="{{ route('admin.level.detail', $level->id_level) }}"
                                                class="detail-btn flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-files class="w-4 h-4 text-primary-500" />
                                            </button>
                                            <button type="button" data-level-id="{{ $level->id_level }}"
                                                class="edit-btn flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                            </button>
                                            <button type="button" data-hs-overlay="#deleteLevelModal" data-level-id="{{ $level->id_level }}"
                                                data-level-name="{{ $level->nama_level }}"
                                                class="delete-btn flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Level Pengguna -->
    <div id="tambahLevelModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        tabindex="-1" aria-labelledby="tambahLevelModalLabel">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto w-full max-w-md mx-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800 text-lg" id="tambahLevelModalLabel">
                        Tambah Level Pengguna
                    </h3>
                    <button type="button" data-hs-overlay="#tambahLevelModal"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <form action="{{ route('admin.level.store') }}" method="POST" class="p-6 space-y-5">
                    @csrf
                    <div>
                        <label for="kode_level" class="block text-sm font-medium mb-2 text-gray-700">Kode Level</label>
                        <input type="text" id="kode_level" name="kode_level"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500"
                            placeholder="Ex: ADM" required>
                        @error('kode_level')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="nama_level" class="block text-sm font-medium mb-2 text-gray-700">Nama Level</label>
                        <input type="text" id="nama_level" name="nama_level"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500"
                            placeholder="Ex: Admin" required>
                        @error('nama_level')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end gap-x-2 pt-2 border-t border-gray-100 mt-4">
                        <button type="button"
                            class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50"
                            data-hs-overlay="#tambahLevelModal">
                            Batal
                        </button>
                        <button type="submit" id="confirmModal"
                            class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700 focus:outline-hidden focus:bg-primary-700">
                            <x-lucide-plus class="w-4 h-4" />
                            Tambah Level
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal detail Level Pengguna -->
    <div id="detailLevelModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        tabindex="-1" aria-labelledby="detailLevelModalLabel">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800 text-lg" id="detailLevelModalLabel">
                        Detail Level Pengguna
                    </h3>
                    <button type="button" id="closeDetailLevelModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <span class="block text-xs text-gray-500 mb-1">ID Level</span>
                        <span id="detailIdLevel" class="font-semibold text-gray-800"></span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-500 mb-1">Kode Level</span>
                        <span id="detailKodeLevel" class="font-semibold text-gray-800"></span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-500 mb-1">Nama Level</span>
                        <span id="detailNamaLevel" class="font-semibold text-gray-800"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="editLevelModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        tabindex="-1" aria-labelledby="editLevelModalLabel">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto w-full max-w-md mx-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800 text-lg" id="editLevelModalLabel">
                        Edit Level Pengguna
                    </h3>
                    <button type="button" id="closeEditLevelModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <form id="editLevelForm" class="p-6 space-y-5">
                    <input type="hidden" id="editIdLevel" name="id_level">
                    <div>
                        <label for="editKodeLevel" class="block text-sm font-medium mb-2 text-gray-700">Kode Level</label>
                        <input type="text" id="editKodeLevel" name="kode_level"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500"
                            required>
                        <p class="text-xs text-red-600 mt-1" id="editKodeLevelError"></p>
                    </div>
                    <div>
                        <label for="editNamaLevel" class="block text-sm font-medium mb-2 text-gray-700">Nama Level</label>
                        <input type="text" id="editNamaLevel" name="nama_level"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500"
                            required>
                        <p class="text-xs text-red-600 mt-1" id="editNamaLevelError"></p>
                    </div>
                    <div class="flex justify-end gap-x-2 pt-2 border-t border-gray-100 mt-4">
                        <button type="button"
                            class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50"
                            id="cancelEditLevelBtn">
                            Batal
                        </button>
                        <button type="submit" id="submitEditLevelBtn"
                            class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700 focus:outline-hidden focus:bg-primary-700">
                            <x-lucide-save class="w-4 h-4" />
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editSuccessLevelModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="editSuccessLevelModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 id="editSuccessLevelModal-label" class="font-bold text-gray-800">
                        Berhasil Diperbarui!
                    </h3>
                    <button type="button" id="closeEditSuccessLevelModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200"
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
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Data Level Pengguna Berhasil Diperbarui</h4>
                        <p class="text-sm text-gray-600 mb-4">
                            Data level <span id="editSuccessLevelName" class="font-semibold text-gray-900"></span> telah
                            berhasil diperbarui.
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                    <button type="button" id="closeEditSuccessLevelBtn2"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteLevelModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="deleteLevelModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="deleteLevelModal-label" class="font-bold text-gray-800 dark:text-white">
                        Konfirmasi Hapus
                    </h3>
                    <button type="button" id="closeLevelModalBtn"
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
                        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Apakah Anda yakin ingin menghapus level pengguna <span id="levelName"
                                class="font-semibold"></span>?
                        </p>
                        <p class="mt-1 text-xs text-red-600">
                            Tindakan ini tidak dapat dibatalkan!
                        </p>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="cancelDeleteLevel"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800">
                        Batal
                    </button>
                    <button type="button" id="confirmDeleteLevelBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        <span id="deleteLevelButtonText">Hapus</span>
                        <div id="deleteLevelSpinner"
                            class="hidden animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full"
                            role="status" aria-label="loading">
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal untuk Level Pengguna -->
    <div id="successLevelModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="successLevelModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="successLevelModal-label" class="font-bold text-gray-800 dark:text-white">
                        Berhasil
                    </h3>
                    <button type="button" id="closeSuccessLevelModalBtn"
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
                        <p id="successLevelMessage" class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Data level pengguna berhasil dihapus!
                        </p>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="okSuccessLevelBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Tambah Level Pengguna -->
    <div id="confirmLevelModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="confirmLevelModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 id="confirmLevelModal-label" class="font-bold text-gray-800">
                        Konfirmasi Tambah Level Pengguna
                    </h3>
                    <button type="button" id="closeConfirmLevelModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-user-cog class="w-8 h-8 text-blue-600" />
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Konfirmasi Data Level Pengguna</h4>
                        <div class="text-left space-y-2 bg-gray-50 p-4 rounded-lg">
                            <div>
                                <span class="text-sm font-medium text-gray-600">Kode Level:</span>
                                <span id="confirmKodeLevel" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Nama Level:</span>
                                <span id="confirmNamaLevel" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-gray-600">
                            Apakah Anda yakin ingin menambahkan level pengguna ini?
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                    <button type="button" id="cancelConfirmLevel"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50">
                        Batal
                    </button>
                    <button type="button" id="confirmLevelSubmit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700">
                        <span id="confirmLevelButtonText">Ya, Tambahkan</span>
                        <div id="confirmLevelSpinner"
                            class="hidden animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full"
                            role="status" aria-label="loading"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sukses -->
    <div id="successLevelModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="successLevelModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 id="successLevelModal-label" class="font-bold text-gray-800">
                        Berhasil!
                    </h3>
                    <button type="button" id="closeSuccessLevelModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
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
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Level Pengguna Berhasil Ditambahkan</h4>
                        <p class="text-sm text-gray-600 mb-4">
                            Data level <span id="successLevelName" class="font-semibold text-gray-900"></span> telah
                            berhasil disimpan ke dalam sistem.
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                    <button type="button" id="closeSuccessLevelBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Error -->
    <div id="errorLevelModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="errorLevelModal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 id="errorLevelModal-label" class="font-bold text-gray-800">
                        Gagal!
                    </h3>
                    <button type="button" id="closeErrorLevelModalBtn"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200"
                        aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-x-circle class="w-8 h-8 text-red-600" />
                        </div>
                        <h4 id="errorLevelTitle" class="text-lg font-semibold text-gray-900 mb-2">Level Pengguna Gagal
                            Ditambahkan</h4>
                        <p class="text-sm text-gray-600 mb-4" id="errorLevelMessage">
                            Terjadi kesalahan saat menyimpan data. Silakan coba lagi.
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                    <button type="button" id="closeErrorLevelBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        let confirmLevelModal = null;
        let successLevelModal = null;
        let errorLevelModal = null;
        let detailLevelModal = null;
        let editLevelModal = null;
        let editSuccessLevelModal = null;

        // Tampilkan modal konfirmasi sebelum submit
        document.querySelector('form[action="{{ route('admin.level.store') }}"] button[type="submit"]').addEventListener('click', function (e) {
            e.preventDefault();

            // Ambil data input
            const kode = document.getElementById('kode_level').value.trim();
            const nama = document.getElementById('nama_level').value.trim();

            // Validasi sederhana
            if (!kode || !nama) {
                showErrorLevelModal('Kode Level dan Nama Level harus diisi!');
                return;
            }

            document.getElementById('confirmKodeLevel').textContent = kode;
            document.getElementById('confirmNamaLevel').textContent = nama;

            confirmLevelModal = new HSOverlay(document.getElementById('confirmLevelModal'));
            confirmLevelModal.open();
        });

        // Tutup modal konfirmasi
        function closeConfirmLevelModal() {
            if (confirmLevelModal) {
                confirmLevelModal.close();
                confirmLevelModal = null;
            }
        }
        document.getElementById('closeConfirmLevelModalBtn').onclick = closeConfirmLevelModal;
        document.getElementById('cancelConfirmLevel').onclick = closeConfirmLevelModal;
        document.getElementById('confirmLevelModal').addEventListener('click', function (e) {
            const modalContent = this.querySelector('.bg-white');
            if (!modalContent.contains(e.target)) closeConfirmLevelModal();
        });

        // Submit form setelah konfirmasi
        document.getElementById('confirmLevelSubmit').onclick = function () {
            const btn = this;
            const text = document.getElementById('confirmLevelButtonText');
            const spinner = document.getElementById('confirmLevelSpinner');
            btn.disabled = true;
            text.textContent = 'Menyimpan...';
            spinner.classList.remove('hidden');

            // Submit form via AJAX
            const form = document.querySelector('form[action="{{ route('admin.level.store') }}"]');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
                .then(async response => {
                    btn.disabled = false;
                    text.textContent = 'Ya, Tambahkan';
                    spinner.classList.add('hidden');
                    closeConfirmLevelModal();

                    if (response.ok) {
                        const data = await response.json();
                        showSuccessLevelModal(formData.get('nama_level'));
                        // Reset form
                        form.reset();
                    } else {
                        let msg = 'Terjadi kesalahan saat menyimpan data.';
                        try {
                            const err = await response.json();
                            if (err && err.message) msg = err.message;
                        } catch { }
                        showErrorLevelModal(msg, 'Level Pengguna Gagal Ditambahkan');
                    }
                })
                .catch(() => {
                    btn.disabled = false;
                    text.textContent = 'Ya, Tambahkan';
                    spinner.classList.add('hidden');
                    closeConfirmLevelModal();
                    showErrorLevelModal('Terjadi kesalahan jaringan.');
                });
        };

        document.querySelectorAll('.detail-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const url = this.getAttribute('href');
                fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(async response => {
                        if (response.ok) {
                            const json = await response.json();
                            // Jika responsenya {success: true, data: {...}}
                            const data = json.data ?? json;
                            document.getElementById('detailIdLevel').textContent = data.id_level ?? '-';
                            document.getElementById('detailKodeLevel').textContent = data.kode_level ?? '-';
                            document.getElementById('detailNamaLevel').textContent = data.nama_level ?? '-';
                            detailLevelModal = new HSOverlay(document.getElementById('detailLevelModal'));
                            detailLevelModal.open();
                        } else {
                            showErrorLevelModal('Gagal mengambil detail data.');
                        }
                    })
                    .catch(() => showErrorLevelModal('Terjadi kesalahan jaringan.'));
            });
        });

        // Modal detail
        document.addEventListener('click', function(e) {
            if (e.target.closest('.detail-btn')) {
                e.preventDefault();
                const btn = e.target.closest('.detail-btn');
                const url = btn.getAttribute('data-level-url');
                if (!url) return;
                
                fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(async response => {
                    if (response.ok) {
                        const json = await response.json();
                        // Jika responsenya {success: true, data: {...}}
                        const data = json.data ?? json;
                        document.getElementById('detailIdLevel').textContent = data.id_level ?? '-';
                        document.getElementById('detailKodeLevel').textContent = data.kode_level ?? '-';
                        document.getElementById('detailNamaLevel').textContent = data.nama_level ?? '-';
                        detailLevelModal = new HSOverlay(document.getElementById('detailLevelModal'));
                        detailLevelModal.open();
                    } else {
                        showErrorLevelModal('Gagal mengambil detail data.');
                    }
                })
                .catch(() => showErrorLevelModal('Terjadi kesalahan jaringan.'));
            }
        });

        function closeDetailLevelModal() {
            if (detailLevelModal) {
                detailLevelModal.close();
                detailLevelModal = null;
            }
        }
        document.getElementById('closeDetailLevelModalBtn').onclick = closeDetailLevelModal;
        document.getElementById('detailLevelModal').addEventListener('click', function (e) {
            const modalContent = this.querySelector('.bg-white');
            if (!modalContent.contains(e.target)) closeDetailLevelModal();
        });

        // Modal sukses
        function showSuccessLevelModal(nama) {
            document.getElementById('successLevelName').textContent = nama;
            successLevelModal = new HSOverlay(document.getElementById('successLevelModal'));
            successLevelModal.open();
        }
        function closeSuccessLevelModal() {
            if (successLevelModal) {
                successLevelModal.close();
                successLevelModal = null;
            }
        }
        document.getElementById('closeSuccessLevelModalBtn').onclick = closeSuccessLevelModal;
        document.getElementById('closeSuccessLevelBtn').onclick = closeSuccessLevelModal;
        document.getElementById('successLevelModal').addEventListener('click', function (e) {
            const modalContent = this.querySelector('.bg-white');
            if (!modalContent.contains(e.target)) closeSuccessLevelModal();
        });

        // Modal error
        function showErrorLevelModal(msg, title = 'Terjadi Kesalahan') {
            document.getElementById('errorLevelMessage').textContent = msg;
            document.getElementById('errorLevelTitle').textContent = title;
            errorLevelModal = new HSOverlay(document.getElementById('errorLevelModal'));
            errorLevelModal.open();
        }
        function closeErrorLevelModal() {
            if (errorLevelModal) {
                errorLevelModal.close();
                errorLevelModal = null;
            }
        }
        document.getElementById('closeErrorLevelModalBtn').onclick = closeErrorLevelModal;
        document.getElementById('closeErrorLevelBtn').onclick = closeErrorLevelModal;
        document.getElementById('errorLevelModal').addEventListener('click', function (e) {
            const modalContent = this.querySelector('.bg-white');
            if (!modalContent.contains(e.target)) closeErrorLevelModal();
        });

        // Hapus Level Pengguna
        let deleteLevelId = null;
        let deleteLevelModal = null;
        let successLevelModalDelete = null;

        // Event: klik tombol hapus pada tabel
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                deleteLevelId = this.getAttribute('data-level-id');
                const levelName = this.getAttribute('data-level-name');
                document.getElementById('levelName').textContent = levelName;

                deleteLevelModal = new HSOverlay(document.getElementById('deleteLevelModal'));
                deleteLevelModal.open();
            });
        });

        // Tutup modal hapus
        function closeDeleteLevelModal() {
            if (deleteLevelModal) {
                deleteLevelModal.close();
                deleteLevelModal = null;
            }
            deleteLevelId = null;
        }
        document.getElementById('closeLevelModalBtn').onclick = closeDeleteLevelModal;
        document.getElementById('cancelDeleteLevel').onclick = closeDeleteLevelModal;
        document.getElementById('deleteLevelModal').addEventListener('click', function (e) {
            const modalContent = this.querySelector('.bg-white');
            if (!modalContent.contains(e.target)) closeDeleteLevelModal();
        });

        // Modal sukses hapus
        function showSuccessLevelModalDelete(message) {
            document.getElementById('successLevelMessage').textContent = message;
            successLevelModalDelete = new HSOverlay(document.getElementById('successLevelModal'));
            successLevelModalDelete.open();
        }
        function closeSuccessLevelModalDelete() {
            if (successLevelModalDelete) {
                successLevelModalDelete.close();
                successLevelModalDelete = null;
            }
            window.location.reload();
        }
        document.getElementById('closeSuccessLevelModalBtn').onclick = closeSuccessLevelModalDelete;
        document.getElementById('okSuccessLevelBtn').onclick = closeSuccessLevelModalDelete;
        document.getElementById('successLevelModal').addEventListener('click', function (e) {
            const modalContent = this.querySelector('.bg-white');
            if (!modalContent.contains(e.target)) closeSuccessLevelModalDelete();
        });

        // Tombol konfirmasi hapus
        document.getElementById('confirmDeleteLevelBtn').addEventListener('click', function () {
            if (!deleteLevelId) return;

            const deleteBtn = this;
            const deleteText = document.getElementById('deleteLevelButtonText');
            const deleteSpinner = document.getElementById('deleteLevelSpinner');

            // Show loading state
            deleteBtn.disabled = true;
            deleteText.textContent = 'Menghapus...';
            deleteSpinner.classList.remove('hidden');

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/admin/level/${deleteLevelId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                closeDeleteLevelModal();
                
                if (data.success) {
                    showSuccessLevelModalDelete(data.message || 'Data level pengguna berhasil dihapus!');
                } else {
                    showErrorLevelModal(data.message || 'Gagal menghapus data.', 'Level Pengguna Gagal Dihapus');
                }
            })
            .catch(error => {
                closeDeleteLevelModal();
                showErrorLevelModal('Terjadi kesalahan saat menghapus level pengguna', 'Level Pengguna Gagal Dihapus');
            })
            .finally(() => {
                deleteBtn.disabled = false;
                deleteText.textContent = 'Hapus';
                deleteSpinner.classList.add('hidden');
            });
        });

        // Escape key untuk modal hapus
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeDeleteLevelModal();
                closeSuccessLevelModalDelete();
            }
        });

        // Escape key close
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeConfirmLevelModal();
                closeSuccessLevelModal();
                closeErrorLevelModal();
            }
        });

        // Perbaikan event listener untuk tombol hapus
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-btn')) {
                const btn = e.target.closest('.delete-btn');
                deleteLevelId = btn.getAttribute('data-level-id');
                const levelName = btn.getAttribute('data-level-name');
                document.getElementById('levelName').textContent = levelName;

                deleteLevelModal = new HSOverlay(document.getElementById('deleteLevelModal'));
                deleteLevelModal.open();
            }
        });

        // Perbaikan event listener untuk tombol edit
        document.addEventListener('click', function(e) {
            if (e.target.closest('.edit-btn')) {
                const btn = e.target.closest('.edit-btn');
                const id = btn.getAttribute('data-level-id');
                fetch(`/admin/level/${id}/edit`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(async response => {
                    if (response.ok) {
                        const json = await response.json();
                        const data = json.data;
                        document.getElementById('editIdLevel').value = data.id_level;
                        document.getElementById('editKodeLevel').value = data.kode_level;
                        document.getElementById('editNamaLevel').value = data.nama_level;
                        document.getElementById('editKodeLevelError').textContent = '';
                        document.getElementById('editNamaLevelError').textContent = '';
                        editLevelModal = new HSOverlay(document.getElementById('editLevelModal'));
                        editLevelModal.open();
                    } else {
                        showErrorLevelModal('Gagal mengambil data untuk edit.');
                    }
                })
                .catch(() => showErrorLevelModal('Terjadi kesalahan jaringan.'));
            }
        });

        // Tutup modal edit
        function closeEditLevelModal() {
            if (editLevelModal) {
                editLevelModal.close();
                editLevelModal = null;
            }
        }
        document.getElementById('closeEditLevelModalBtn').onclick = closeEditLevelModal;
        document.getElementById('cancelEditLevelBtn').onclick = closeEditLevelModal;
        document.getElementById('editLevelModal').addEventListener('click', function (e) {
            const modalContent = this.querySelector('.bg-white');
            if (!modalContent.contains(e.target)) closeEditLevelModal();
        });

        // Submit edit form
        document.getElementById('editLevelForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const id = document.getElementById('editIdLevel').value;
            const kode = document.getElementById('editKodeLevel').value.trim();
            const nama = document.getElementById('editNamaLevel').value.trim();

            // Reset error
            document.getElementById('editKodeLevelError').textContent = '';
            document.getElementById('editNamaLevelError').textContent = '';

            // Validasi sederhana
            if (!kode || !nama) {
                if (!kode) document.getElementById('editKodeLevelError').textContent = 'Kode Level harus diisi!';
                if (!nama) document.getElementById('editNamaLevelError').textContent = 'Nama Level harus diisi!';
                return;
            }

            const formData = new FormData();
            formData.append('kode_level', kode);
            formData.append('nama_level', nama);
            formData.append('_method', 'PUT');

            fetch(`/admin/level/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
                .then(async response => {
                    if (response.ok) {
                        const data = await response.json();
                        closeEditLevelModal();
                        showEditSuccessLevelModal(nama);
                    } else if (response.status === 422) {
                        const err = await response.json();
                        if (err.errors) {
                            if (err.errors.kode_level) document.getElementById('editKodeLevelError').textContent = err.errors.kode_level[0];
                            if (err.errors.nama_level) document.getElementById('editNamaLevelError').textContent = err.errors.nama_level[0];
                        } else {
                            showErrorLevelModal(err.message || 'Validasi gagal.');
                        }
                    } else {
                        showErrorLevelModal('Gagal memperbarui data.');
                    }
                })
                .catch(() => showErrorLevelModal('Terjadi kesalahan jaringan.'));
        });

        // Modal sukses edit
        function showEditSuccessLevelModal(nama) {
            document.getElementById('editSuccessLevelName').textContent = nama;
            editSuccessLevelModal = new HSOverlay(document.getElementById('editSuccessLevelModal'));
            editSuccessLevelModal.open();
        }
        function closeEditSuccessLevelModal() {
            if (editSuccessLevelModal) {
                editSuccessLevelModal.close();
                editSuccessLevelModal = null;
            }
            window.location.reload();
        }
        document.getElementById('closeEditSuccessLevelModalBtn').onclick = closeEditSuccessLevelModal;
        document.getElementById('closeEditSuccessLevelBtn2').onclick = closeEditSuccessLevelModal;
        document.getElementById('editSuccessLevelModal').addEventListener('click', function (e) {
            const modalContent = this.querySelector('.bg-white');
            if (!modalContent.contains(e.target)) closeEditSuccessLevelModal();
        });

        // Escape key untuk modal edit
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeEditLevelModal();
                closeEditSuccessLevelModal();
            }
        });
    </script>
@endsection