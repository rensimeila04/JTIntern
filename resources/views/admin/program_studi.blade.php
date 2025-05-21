@extends('layout.template')

@section('content')
<div class="w-full p-6 bg-white rounded-xl flex-col gap-6 shadow">
    <!-- Header dan tombol aksi -->
    <div class="flex justify-between items-center w-full">
        <div class="text-neutral-900 text-xl font-semibold">Program Studi</div>
        <div class="flex gap-2">
            <button class="w-[213] h-[38px] px-4.5 py-2.5 bg-primary-500 rounded-lg flex items-center gap-2 text-white font-semibold text-base tracking-tight hover:bg-primary-600 transition">
                <i class="ph ph-plus"></i> Tambah Program Studi
            </button>
        </div>
    </div>

    <!-- Table Responsive -->
    <div class="flex flex-col mt-8">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="border border-gray-200 rounded-lg shadow-xs overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="w-[52px] px-4 py-3 text-start text-xs font-medium text-gray-500">ID</th>
                                <th scope="col" class="w-[79px] px-5 py-3 text-center text-xs font-medium text-gray-500">Kode</th>
                                <th scope="col" class="w-[815px] px-5 py-3 text-start text-xs font-medium text-gray-500">Program Studi</th>
                                <th scope="col" class="w-[174px] px-[20px] py-3 text-start text-xs font-medium text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-800">1</td>
                                <td class="px-5 py-3 justify-center flex whitespace-nowrap text-sm text-gray-800">
                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-300 text-gray-500">TI</span>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap text-sm text-gray-800">D-IV Teknik Informatika</td>
                                <td class="px-5 py-3 whitespace-nowrap text-sm font-medium flex gap-2">
                                    <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-primary-500 text-primary-500 hover:border-primary-400 hover:text-primary-400 focus:outline-hidden focus:border-primary-400 focus:text-primary-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-teal-50 transition">
                                        <x-lucide-files class="w-4 h-4 text-primary-500" />
                                    </button>
                                    <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:outline-hidden focus:border-yellow-400 focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-50 transition">
                                        <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                                    </button>
                                    <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-red-50 transition">
                                        <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-800">2</td>
                                <td class="px-5 py-3 justify-center flex whitespace-nowrap text-sm text-gray-800">
                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-300 text-gray-500">SIB</span>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap text-sm text-gray-800">D-IV Sistem Informasi Bisnis</td>
                                <td class="px-5 py-3 whitespace-nowrap text-sm font-medium flex gap-2">
                                    <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-primary-500 text-primary-500 hover:border-primary-400 hover:text-primary-400 focus:outline-hidden focus:border-primary-400 focus:text-primary-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-teal-50 transition">
                                        <x-lucide-files class="w-4 h-4 text-primary-500" />
                                    </button>
                                    <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:outline-hidden focus:border-yellow-400 focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-50 transition">
                                        <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                                    </button>
                                    <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-red-50 transition">
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