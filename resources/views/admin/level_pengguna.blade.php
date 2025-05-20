@extends('layout.template')
@section('content')
    <div class="container mx-auto bg-white rounded-xl p-4">
        {{-- sec1 --}}
        <div class="gap-4 flex justify-between w-full items-center">
            <div>
                <h2 class="text-xl font-medium items-center">Level Pengguna</h2>
            </div>
            <div class="flex gap-x-3 ">
                <div class="relative w-100">
                    <input type="search" class="py-1.5 sm:py-2 px-3 pl-9 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-neutral-400 focus:ring-neutral-400 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Cari level...">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search text-gray-500"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                </div>

                <div class="flex">
                    <button type="button"
                        class="btn-primary">
                        <i class="ph-bold ph-plus text-lg"></i>
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
                                    <th scope="col" class="w-10 px-6 py-3 text-center text-xs font-medium text-gray-500">ID
                                    </th>
                                    <th scope="col" class="w-24 px-6 py-3 text-start text-xs font-medium text-gray-500">Kode
                                    </th>
                                    <th scope="col" class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Nama Level</th>
                                    <th scope="col" class="w-48 px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-100 gray:hover:bg-neutral-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-black">1
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-200 bg-white text-gray-500 shadow-2xs">ADM</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">Admin</td>
                                    <td class="gap-2 flex px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
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
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection