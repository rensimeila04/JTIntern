@extends('layout.template')
@section('content')
    <div class="p-6 space-y-6 bg-white rounded-lg">
        <h1 class="text-xl font-medium text-neutral-900">Tambah Lowongan</h1>
        <form action="{{ route('admin.lowongan.tambah') }}" method="POST" class="space-y-4">
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label for="" class="block text-sm font-medium mb-2">Perusahaan</label>
                        <select data-hs-select='{
                            "hasSearch": true,
                            "minSearchLength": 3,
                            "searchPlaceholder": "Search...",
                            "searchClasses": "block w-full sm:text-sm border-gray-200 rounded-lg focus:border-primary-500 focus:ring-primary-500 before:absolute before:inset-0 before:z-1 py-1.5 sm:py-2 px-3",
                            "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0",
                            "placeholder": "Pilih perusahaan",
                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 \" data-title></span></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-hidden focus:ring-2 focus:ring-primary-500",
                            "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
                            "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100",
                            "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 \" data-title></div></div></div>",
                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/></svg></div>"
                            }' class="hidden">
                            <option value="">Choose</option>
                            <option value="AF"
                                data-hs-select-option='{}'>
                                Afghanistan
                            </option>
                            <option value="US"
                                data-hs-select-option='{}'>
                                United States of America
                            </option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="" class="block text-sm font-medium mb-2">Periode Magang</label>
                        <select id="" name=""
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="Pilih periode magang">
                            <option value="" disabled selected>Pillih periode magang</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="" class="block text-sm font-medium mb-2">Judul Lowongan</label>
                        <input type="text" id="" name=""
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="ex: Frontend Developer" aria-describedby="hs-input-helper-text">
                    </div>
                    <div class="w-full">
                        <label for="" class="block text-sm font-medium mb-2">Deskripsi</label>
                        <textarea id="" name=""
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none"
                            rows="3" placeholder="Tambahkan deskripsi lowongan..."></textarea>
                    </div>
                    <div class="w-full">
                        <label for="" class="block text-sm font-medium mb-2">Persyaratan</label>
                        <textarea id="" name=""
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none"
                            rows="3" placeholder="Tambahkan persyaratan..."></textarea>
                    </div>
                </div>
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label for="" class="block text-sm font-medium mb-2">Kompetensi</label>
                        <select id="" name=""
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="Pilih kompetensi">
                            <option value="" disabled selected>Pillih kompetensi</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="" class="block text-sm font-medium mb-2">Jenis Magang</label>
                        <select id="" name=""
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="Pilih jenis magang">
                            <option value="" disabled selected>Pillih jenis magang</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="" class="block text-sm font-medium mb-2">Deadline Pendaftaran</label>
                        <input type="text" id="" name=""
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="Pilih deadline" aria-describedby="hs-input-helper-text">
                    </div>
                    <div class="flex flex-row gap-4">
                        <label for="" class="block text-sm font-medium mb-2">Tes seleksi diperlukan</label>
                        <label for="hs-basic-usage" class="relative inline-block w-11 h-6 cursor-pointer">
                            <input type="checkbox" id="hs-basic-usage" class="peer sr-only">
                            <span
                                class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-primary-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                            <span
                                class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400"></span>
                        </label>
                    </div>
                    <div class="w-full">
                        <label for="" class="block text-sm font-medium mb-2">Informasi Test</label>
                        <textarea id="" name=""
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none"
                            rows="3" placeholder="Tambahkan informasi test..."></textarea>
                    </div>
                </div>
            </div>
            <div class="flex justify-end w-full">
                <button type="submit" class="btn-primary">
                    Tambahkan Lowongan
                </button>
            </div>
    </div>
@endsection