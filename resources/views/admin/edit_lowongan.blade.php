@extends('layout.template')
@section('content')
    <div class="p-6 space-y-6 bg-white rounded-lg">
        <h1 class="text-xl font-medium text-neutral-900">Edit Lowongan</h1>
        <form class="space-y-4">
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Perusahaan</label>
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
                                PT. Digital Inovasi Indonesia
                            </option>
                            <option value="US"
                                data-hs-select-option='{}'>
                                PT. Teknologi Masa Depan
                            </option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Periode Magang</label>
                        <select
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="" disabled selected>Pilih periode magang</option>
                            <option>Ganjil 2025</option>
                            <option>Genap 2026</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Judul Lowongan</label>
                        <input type="text"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            placeholder="ex: Frontend Developer">
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Deskripsi</label>
                        <textarea
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            rows="3" placeholder="Tambahkan deskripsi lowongan..."></textarea>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Persyaratan</label>
                        <textarea
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            rows="3" placeholder="Tambahkan persyaratan..."></textarea>
                    </div>
                </div>
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Kompetensi</label>
                        <select
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="" disabled selected>Pilih kompetensi</option>
                            <option>UI/UX</option>
                            <option>Backend</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Jenis Magang</label>
                        <select
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="" disabled selected>Pilih jenis magang</option>
                            <option>Remote</option>
                            <option>WFO</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Deadline Pendaftaran</label>
                        <div class="relative">
                            <input type="date"
                                class="py-2.5 sm:py-3 px-4 pl-10 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <x-lucide-calendar class="w-5 h-5 text-gray-400" />
                            </span>
                        </div>
                    </div>
                   <div class="flex flex-row gap-4">
                        <label for="" class="block text-sm font-medium mb-2">Tes seleksi diperlukan</label>
                        <label for="tes-seleksi-switch" class="relative inline-block w-11 h-6 cursor-pointer">
                            <input type="checkbox" id="tes-seleksi-switch" class="peer sr-only">
                            <span
                                class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-primary-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                            <span
                                class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400"></span>
                        </label>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Informasi Test</label>
                        <textarea
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            rows="3" placeholder="Tambahkan informasi test..."></textarea>
                    </div>
                    <div class="flex flex-row gap-4">
                        <label for="" class="block text-sm font-medium mb-2">Status Pendaftaran</label>
                        <label for="status-pendaftaran-switch" class="relative inline-block w-11 h-6 cursor-pointer">
                            <input type="checkbox" id="status-pendaftaran-switch" class="peer sr-only">
                            <span
                                class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-primary-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                            <span
                                class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex justify-end w-full">
                <button type="submit" class="btn-primary">
                    Edit Lowongan
                </button>
            </div>
        </form>
    </div>
@endsection