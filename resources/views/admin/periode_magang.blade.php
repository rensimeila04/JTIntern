@extends('layout.template')
@section('content')
    <div class="container mx-auto bg-white rounded-xl p-4">
        <div class="flex justify-between w-full items-center">
            <div>
                <h2 class="text-xl font-medium items-center">Periode Magang</h2>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.periode_magang.create') }}" class="btn-primary">
                    <x-lucide-plus class="size-4" /> Tambah Periode Magang
                </a>
            </div>
        </div>

        <div class="flex flex-col mt-6">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="w-10 px-6 py-3 text-center text-xs font-medium text-gray-500">ID
                                    </th>
                                    <th scope="col" class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Nama Periode</th>
                                    <th scope="col" class="w-32 px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Tanggal Mulai</th>
                                    <th scope="col" class="w-32 px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Tanggal Selesai</th>
                                    <th scope="col" class="w-48 px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Aksi</th>
                                </tr>
                            </thead>
                            @foreach ($periodeMagang as $item)
                                <tbody class="divide-y divide-gray-200">
                                    <tr class="hover:bg-gray-100 gray:hover:bg-neutral-700">

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-black">
                                            {{ $item->id_periode_magang }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
                                            {{ $item->nama_periode }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
                                            {{ $item->tanggal_mulai }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
                                            {{ $item->tanggal_selesai }}
                                        </td>
                                        <td class="gap-2 flex px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
                                            <a href="{{ route('admin.periode_magang.detail', $item->id_periode_magang) }}"
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
                                        </td>

                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection