@extends('layout.template')
@section('content')
    <div class="flex flex-row items-center justify-between">
        <div>
            <h2 class="text-xl font-medium">Daftar Lowongan</h2>
        </div>
        <div class="flex-row">
            <div class="flex items-center gap-x-2">
                <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-500 text-white hover:bg-blue-700">
                    <i class="ph ph-export"></i>
                    Export
                </button>
                <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-700">
                    <i class="ph ph-arrow-square-in"></i>
                    Import
                </button>
                <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700">
                    <i class="ph ph-plus"></i>
                    Tambah Lowongan
                </button>
            </div>
        </div>
    </div>
    <div class="mt-6 flex flex-row justify-between">
        <div class="flex gap-2">
            <select
                class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option selected="">Open this select menu</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
            <select
                class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option selected="">Open this select menu</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
        </div>
        <div class="relative">
            <input type="text" class="py-1.5 sm:py-2 px-3 pl-10  block w-full border-gray-200 rounded-lg sm:text-sm"
                placeholder="Cari Lowongan">
            <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                <i class="ph ph-magnifying-glass text-gray-400"></i>
            </span>
        </div>
    </div>
    @for ($i = 0; $i < 5; $i++)

    <div class="flex justify-between items-center mt-5 w-full bg-white p-4 rounded-md shadow-md">
        <div class="flex ">
           <img src="{{asset('Images/LOGOPT.png') }}">
            <div class="flex flex-col pl-6 gap-y-1 ">
                <div class="flex gap-4 items-center">
                    <h4 class="font-semibold">UI UX DESIGNER</h4>
                    <p class="rounded-md border border-teal-500 text-teal-500 p-1">Aktif Merekrut</p>
                </div>
                <p class="text-primary-500">
                    PT. Quantum Technology Nusantara
                </p>
                <span class="flex items-center gap-2">
                    <i class="ph ph-map-pin"></i>
                    <p>Jakarta Selatan, DKI Jakarta, Indonesia</p>
                </span>
                <span class="flex items-center">
                    <i class="ph ph-calendar-dots"></i>
                    <p>Ganjil 2026</p>
                </span>
            </div>

        </div>
        <span>
            <button type="button" href="#"
                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700 focus:outline-hidden focus:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                Lihat Detail
            </button>
        </span>
    </div>
    @endfor

@endsection