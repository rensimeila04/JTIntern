@extends('layout.template')
@section('content')
    <div class="flex flex-col gap-6">
        <div>
            <h2 class="text-xl font-medium">Daftar Lowongan</h2>
        </div>
        <div class="flex items-center">
            <div class="flex gap-2.5 flex-1">
                <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                    <button type="button"
                        class="hs-tab-active:bg-primary-500 hs-tab-active:text-white dark:hs-tab-active:bg-primary-60 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm font-medium text-center text-gray-500 rounded-lg hover:text-primary-600 focus:outline-hidden focus:text-primary-600 disabled:opacity-50 disabled:pointer-events-none active"
                        id="tab-semua-lowongan" aria-selected="true" data-hs-tab="#content-semua-lowongan"
                        aria-controls="content-semua-lowongan" role="tab">
                        Semua Lowongan
                    </button>
                    <button type="button"
                        class="hs-tab-active:bg-primary-500 hs-tab-active:text-white dark:hs-tab-active:bg-primary-60 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm font-medium text-center text-gray-500 rounded-lg hover:text-primary-600 focus:outline-hidden focus:text-primary-600 disabled:opacity-50 disabled:pointer-events-none"
                        id="tab-rekomendasi-mabac" aria-selected="false" data-hs-tab="#content-rekomendasi-mabac"
                        aria-controls="content-rekomendasi-mabac" role="tab">
                        Rekomendasi MABAC
                    </button>
                    <button type="button"
                        class="hs-tab-active:bg-primary-500 hs-tab-active:text-white dark:hs-tab-active:bg-primary-60 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm font-medium text-center text-gray-500 rounded-lg hover:text-primary-600 focus:outline-hidden focus:text-primary-600 disabled:opacity-50 disabled:pointer-events-none"
                        id="tab-rekomendasi-topsis" aria-selected="false" data-hs-tab="#content-rekomendasi-topsis"
                        aria-controls="content-rekomendasi-topsis" role="tab">
                        Rekomendasi Topsis
                    </button>
                </nav>
                <div class="flex justify-end items-center gap-2 flex-1">
                    <form method="GET" action="{{ route('mahasiswa.lowongan') }}" id="searchForm" class="flex items-center gap-2">
                        <x-search-input name="search" placeholder="Cari lowongan..." id="searchInput"
                            value="{{ request('search') }}"
                            class="py-3 px-4 pl-11 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" />
                        {{-- Preserve existing filters --}}
                        @if(request('jenis_magang'))
                            <input type="hidden" name="jenis_magang" value="{{ request('jenis_magang') }}">
                        @endif
                        @if(request('jenis_perusahaan'))
                            <input type="hidden" name="jenis_perusahaan" value="{{ request('jenis_perusahaan') }}">
                        @endif
                        @if(request('lokasi'))
                            <input type="hidden" name="lokasi" value="{{ request('lokasi') }}">
                        @endif
                    </form>
                </div>
            </div>
        </div>
        
        {{-- Tab Content --}}
        <div class="mt-3">
            {{-- Semua Lowongan Tab Content --}}
            <div id="content-semua-lowongan" role="tabpanel" aria-labelledby="tab-semua-lowongan">
                @include('mahasiswa.partials.semua_lowongan')
            </div>

            {{-- Rekomendasi MABAC Tab Content --}}
            <div id="content-rekomendasi-mabac" class="hidden" role="tabpanel" aria-labelledby="tab-rekomendasi-mabac">
                @include('mahasiswa.partials.mabac')
            </div>

            {{-- Rekomendasi Topsis Tab Content --}}
            <div id="content-rekomendasi-topsis" class="hidden" role="tabpanel" aria-labelledby="tab-rekomendasi-topsis">
                @include('mahasiswa.partials.topsis')
            </div>
        </div>
    </div>
@endsection
