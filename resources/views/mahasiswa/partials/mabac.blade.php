<div class="space-y-6">
    {{-- Filter Dropdowns --}}
    <div class="flex justify-between items-center">
        <div class="flex gap-2">
            {{-- Tipe Magang Dropdown --}}
            <div class="hs-dropdown relative inline-flex">
                <button id="hs-dropdown-tipe-magang" type="button"
                    class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-md font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Semua Tipe Magang
                    <x-lucide-chevron-down class="hs-dropdown-open:rotate-180 size-4" />
                </button>
                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-tipe-magang">
                    <div class="p-1 space-y-0.5">
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            Semua Tipe Magang
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            WFO
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            Remote
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            Hybrid
                        </a>
                    </div>
                </div>
            </div>

            {{-- Perusahaan Dropdown --}}
            <div class="hs-dropdown relative inline-flex">
                <button id="hs-dropdown-perusahaan" type="button"
                    class="hs-dropdown-toggle py-1.5 sm:py-2 px-4 inline-flex items-center gap-x-2 text-md font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 h-[38px]"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Semua Perusahaan
                    <x-lucide-chevron-down class="hs-dropdown-open:rotate-180 size-4" />
                </button>
                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-perusahaan">
                    <div class="p-1 space-y-0.5">
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            href="#">
                            Semua Perusahaan
                        </a>
                        @foreach($jenisPerusahaan as $jenis)
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-white text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                href="#" data-value="{{ $jenis->id_jenis_perusahaan }}">
                                {{ $jenis->nama_jenis_perusahaan }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Lokasi Dropdown dengan Search --}}
            <div class="relative">
                <select data-hs-select='{
                    "hasSearch": true,
                    "searchPlaceholder": "Cari lokasi...",
                    "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-primary-500 focus:ring-primary-500 py-2 px-3 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500",
                    "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
                    "placeholder": "Pilih lokasi",
                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"text-gray-800 dark:text-neutral-200\" data-title></span></button>",
                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-1.5 sm:py-2 pl-4 pr-10 flex gap-x-2 text-nowrap w-auto cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-md font-medium focus:outline-hidden focus:ring-2 focus:ring-primary-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600 h-[38px]",
                    "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 min-w-max bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                    "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                    "optionTemplate": "<div class=\"flex items-center\"><div class=\"text-gray-800 dark:text-neutral-200\" data-title></div></div>",
                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                }' class="hidden" name="lokasi" id="lokasi-filter">
                    <option value="">Semua Lokasi</option>
                    @foreach($lokasiPerusahaan as $lokasi)
                        <option value="{{ $lokasi }}">{{ $lokasi }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <a href="#" class="btn-primary">Lihat Perhitungan</a>
    </div>

    {{-- Daftar Lowongan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3=2 gap-4 w-full">
        @for ($i = 1; $i <= 6; $i++)
            <div class="bg-white flex-col rounded-xl flex py-6 px-4 gap-4">
                <div class="inline-flex items-center gap-6">
                    <img src="https://placehold.co/80x80?text=Logo" alt="Logo"
                        class="w-20 h-20 rounded-lg object-contain bg-gray-50">
                    <div class="flex flex-col flex-1 justify-start items-start gap-2 h-fill">
                        <div class="self-stretch inline-flex justify-start items-center gap-4">
                            <div class="justify-start text-black text-lg font-medium leading-none">
                                UI UX Designer</div>
                        </div>
                        <div class="inline-flex justify-start items-center gap-2">
                            <a class="justify-start text-neutral-400 text-sm font-normal leading-none">
                                PT. Quantum</a>
                            <div class="w-1 h-1 bg-neutral-400 rounded-full"></div>
                            <a class="justify-start text-neutral-400 text-sm font-normal leading-none">
                                Jakarta Pusat</a>
                        </div>
                        <div class="inline-flex justify-start items-start gap-2">
                            <span
                                class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">WFO</span>
                            <span
                                class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">Software
                                House</span>
                        </div>
                    </div>
                    <button type="button"
                        class="ml-auto py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-600 disabled:opacity-50 disabled:pointer-events-none">
                        Ajukan Magang
                    </button>
                </div>
                <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">
                <div class="self-stretch inline-flex justify-start items-center gap-2">
                    <a class="justify-start text-neutral-400 text-sm font-normal leading-none">
                        23 hari tersisa</a>
                    <div class="w-1 h-1 bg-neutral-400 rounded-full"></div>
                    <a class="justify-start text-neutral-400 text-sm font-normal leading-none">
                        30 Pelamar</a>
                </div>
            </div>
        @endfor
    </div>
</div>