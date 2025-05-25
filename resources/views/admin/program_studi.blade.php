@extends('layout.template')

@section('content')
<div class="w-full p-6 bg-white rounded-xl flex-col space-y-4 ">
    <div class="flex justify-between items-center w-full">
        <div class="text-neutral-900 text-xl font-semibold">Program Studi</div>
        <div class="flex gap-2">
            <button class="btn-primary-lg">
                <i class="ph ph-plus"></i> Tambah Program Studi
            </button>
        </div>
    </div>
    <div class="flex flex-col mt-6">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 w-full inline-block align-middle">
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="w-10 px-6 py-3 text-center text-xs font-medium text-gray-500">ID</th>
                                <th scope="col" class="w-24 px-6 py-3 text-start text-xs font-medium text-gray-500">Kode</th>
                                <th scope="col" class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">Program Studi</th>
                                <th scope="col" class="w-48 px-6 py-3 text-start text-xs font-medium text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-100 gray:hover:bg-neutral-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-black">1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-200 bg-white text-gray-500 shadow-2xs">TI</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">D-IV Teknik Informatika</td>
                                <td class="gap-2 flex px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
                                    <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                        <x-lucide-files class="w-4 h-4 text-primary-500" />
                                    </a>
                                    <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                        <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                                    </a>
                                    <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                        <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                    </a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-100 gray:hover:bg-neutral-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-black">2</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-200 bg-white text-gray-500 shadow-2xs">SIB</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">D-IV Sistem Informasi Bisnis</td>
                                <td class="gap-2 flex px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
                                    <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                        <x-lucide-files class="w-4 h-4 text-primary-500" />
                                    </a>
                                    <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                        <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                                    </a>
                                    <a href="#" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                        <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                    </a>
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