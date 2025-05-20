@extends('layout.template')

@section('content')
<div class="w-full p-6 bg-white rounded-xl flex-col gap-6 shadow">
    <!-- Header dan tombol aksi -->
    <div class="flex justify-between items-center w-full">
        <div class="text-neutral-900 text-xl font-semibold">Pengguna</div>
        <div class="flex gap-2">
            <button class="px-4.5 py-2.5 bg-blue-500 rounded-lg flex items-center gap-2 text-white font-semibold text-base tracking-tight hover:bg-blue-600 transition">
                <i class="ph ph-export text-lg"></i> Export
            </button>
            <button class="px-4.5 py-2.5 bg-amber-500 rounded-lg flex items-center gap-2 text-white font-semibold text-base tracking-tight hover:bg-amber-600 transition">
                <i class="ph ph-arrow-square-in"></i> Import
            </button>
            <button class="px-4.5 py-2.5 bg-primary-500 rounded-lg flex items-center gap-2 text-white font-semibold text-base tracking-tight hover:bg-primary-600 transition">
                <i class="ph ph-plus"></i> Tambah Pengguna
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[16px] mt-6">
        <!-- Card 1 -->
        <div class="self-stretch p-4 bg-white rounded-lg outline outline-1 outline-offset-[-1px] outline-gray-200 flex flex-col items-center gap-2">
            <div class="flex items-center gap-[8px] mb-2">
                <div class="bg-primary-50 rounded-[4px] p-2 w-[32px] h-[32px] flex items-center justify-center">
                    <x-lucide-user-check class="size-6 text-primary-600" stroke-width="1.5" />
                </div>
                <span class="text-base text-neutral-400 font-medium">Mahasiswa</span>
            </div>
            <div class="flex-1 flex items-center justify-center">
                <span class="text-4xl font-semibold text-gray-800">260</span>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="self-stretch p-4 bg-white rounded-lg outline outline-1 outline-offset-[-1px] outline-gray-200 flex flex-col items-center gap-2">
            <div class="flex items-center gap-[8px] mb-2">
                <div class="bg-primary-50 rounded-[4px] p-2 w-[32px] h-[32px] flex items-center justify-center">
                    <x-lucide-square-user-round class="size-6 text-primary-600" stroke-width="1.5" />
                </div>
                <span class="text-base text-neutral-400 font-medium">Dosen Pembimbing</span>
            </div>
            <div class="flex-1 flex items-center justify-center">
                <span class="text-4xl font-semibold text-gray-800">65</span>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="self-stretch p-4 bg-white rounded-lg outline outline-1 outline-offset-[-1px] outline-gray-200 flex flex-col items-center gap-2">
            <div class="flex items-center gap-[8px] mb-2">
                <div class="bg-primary-50 rounded-[4px] p-2 w-[32px] h-[32px] flex items-center justify-center">
                    <x-lucide-briefcase class="size-6 text-primary-600" stroke-width="1.5" />
                </div>
                <span class="text-base text-neutral-400 font-medium">Lowongan</span>
            </div>
            <div class="flex-1 flex items-center justify-center">
                <span class="text-4xl font-semibold text-gray-800">85</span>
            </div>
        </div>
    </div>

    <!-- Filter "Semua Pengguna" & "Cari Pengguna" -->
    <div class="flex flex-row justify-between items-center gap-4 mt-6 w-full">
        <div>
            <div class="w-50 bg-white-50 rounded-lg outline outline-1 outline-offset-[-1px] outline-gray-200 flex items-center overflow-hidden h-9">
                <div class="flex-1 flex items-center justify-center h-full">
                    <span class="text-gray-400 text-base font-medium tracking-tight">Semua Pengguna</span>
                </div>
                <div class="px-3 py-2.5 flex items-center justify-center">
                    <x-lucide-chevron-down class="w-4 h-4 text-gray-400" />
                </div>
            </div>
        </div>
        <div>
            <div class="w-105 bg-white-50 rounded-lg outline outline-1 outline-offset-[-1px] outline-gray-200 flex items-center overflow-hidden h-9">
                <div class="px-3 py-2.5 flex items-center gap-2">
                    <x-lucide-search class="w-4 h-4 text-gray-400" />
                </div>
                <div class="flex-1 flex items-center">
                    <div class="flex-1 px-3 py-2.5 flex items-center gap-2.5">
                        <span class="flex-1 text-gray-400 text-base font-medium tracking-tight">Cari pengguna...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Header -->
    <div class="w-full mt-8 border-1 border-gray-200 rounded-lg">
        <div class="grid grid-cols-12 rounded-lg">
            <div class="h-10 px-4.5 py-3 bg-gray-100 border-b border-gray-200 flex items-center w-auto">
                <span class="text-gray-500 text-xs font-medium leading-none tracking-tight">ID</span>
            </div>
            <div class="col-span-2 h-10 px-5 py-3 bg-gray-100 border-b border-gray-200 flex items-center justify-start">
                <span class="text-gray-500 text-xs font-medium leading-none tracking-tight">Level</span>
            </div>
            <div class="col-span-3 h-10 px-5 py-3 bg-gray-100 border-b border-gray-200 flex items-center">
                <span class="text-gray-500 text-xs font-medium leading-none tracking-tight">Email</span>
            </div>
            <div class="col-span-4 h-10 px-5 py-3 bg-gray-100 border-b border-gray-200 flex items-center">
                <span class="text-gray-500 text-xs font-medium leading-none tracking-tight">Nama Pengguna</span>
            </div>
            <div class="col-span-2 h-10 px-5 py-3 bg-gray-100 border-b border-gray-200 flex items-center">
                <span class="text-gray-500 text-xs font-medium leading-none tracking-tight">Aksi</span>
            </div>
        </div>

        <!-- 1 -->
        <div class="grid grid-cols-12">
            <div class="col-span-1 h-12 px-5 py-3 border-b border-gray-200 flex items-center w-auto">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">1</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-blue-600 text-blue-600 dark:text-blue-500">Admin</span>
            </div>
            <div class="col-span-3 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">admin@polinema.ac.id</span>
            </div>
            <div class="col-span-4 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">Admin</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center gap-2">
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-teal-500 text-teal-500 hover:border-teal-400 hover:text-teal-400 focus:outline-hidden focus:border-teal-400 focus:text-teal-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-teal-50 transition">
                    <x-lucide-files class="w-4 h-4 text-teal-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:outline-hidden focus:border-yellow-400 focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-50 transition">
                    <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-red-50 transition">
                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                </button>
            </div>
        </div>
        
        <!-- 2 -->
        <div class="grid grid-cols-12">
            <div class="col-span-1 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">2</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">Dosen Pembimbing</span>
            </div>
            <div class="col-span-3 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">ayu@lecturer.polinema.ac.id</span>
            </div>
            <div class="col-span-4 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">Ayu Maharani</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center gap-2">
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-teal-500 text-teal-500 hover:border-teal-400 hover:text-teal-400 focus:outline-hidden focus:border-teal-400 focus:text-teal-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-teal-50 transition">
                    <x-lucide-files class="w-4 h-4 text-teal-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:outline-hidden focus:border-yellow-400 focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-50 transition">
                    <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-red-50 transition">
                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                </button>
            </div>
        </div>

        <!-- 3 -->
        <div class="grid grid-cols-12">
            <div class="col-span-1 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">3</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">Dosen Pembimbing</span>
            </div>
            <div class="col-span-3 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">bagas@lecturer.polinema.ac.id</span>
            </div>
            <div class="col-span-4 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">Bagas Nugroho</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center gap-2">
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-teal-500 text-teal-500 hover:border-teal-400 hover:text-teal-400 focus:outline-hidden focus:border-teal-400 focus:text-teal-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-teal-50 transition">
                    <x-lucide-files class="w-4 h-4 text-teal-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:outline-hidden focus:border-yellow-400 focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-50 transition">
                    <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-red-50 transition">
                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                </button>
            </div>
        </div>

        <!-- 4 -->
        <div class="grid grid-cols-12">
            <div class="col-span-1 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">4</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">Dosen Pembimbing</span>
            </div>
            <div class="col-span-3 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">cintya@lecturer.polinema.ac.id</span>
            </div>
            <div class="col-span-4 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">Cintya Hanna</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center gap-2">
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-teal-500 text-teal-500 hover:border-teal-400 hover:text-teal-400 focus:outline-hidden focus:border-teal-400 focus:text-teal-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-teal-50 transition">
                    <x-lucide-files class="w-4 h-4 text-teal-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:outline-hidden focus:border-yellow-400 focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-50 transition">
                    <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-red-50 transition">
                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                </button>
            </div>
        </div>

        <!-- 5 -->
        <div class="grid grid-cols-12">
            <div class="col-span-1 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">5</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">Dosen Pembimbing</span>
            </div>
            <div class="col-span-3 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">dimas@lecturer.polinema.ac.id</span>
            </div>
            <div class="col-span-4 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">Dimas Aji</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center gap-2">
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-teal-500 text-teal-500 hover:border-teal-400 hover:text-teal-400 focus:outline-hidden focus:border-teal-400 focus:text-teal-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-teal-50 transition">
                    <x-lucide-files class="w-4 h-4 text-teal-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:outline-hidden focus:border-yellow-400 focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-50 transition">
                    <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-red-50 transition">
                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                </button>
            </div>
        </div>

        <!-- 6 -->
        <div class="grid grid-cols-12">
            <div class="col-span-1 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">6</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">Dosen Pembimbing</span>
            </div>
            <div class="col-span-3 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">erlang@lecturer.polinema.ac.id</span>
            </div>
            <div class="col-span-4 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">Erlangga Setiawan</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center gap-2">
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-teal-500 text-teal-500 hover:border-teal-400 hover:text-teal-400 focus:outline-hidden focus:border-teal-400 focus:text-teal-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-teal-50 transition">
                    <x-lucide-files class="w-4 h-4 text-teal-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:outline-hidden focus:border-yellow-400 focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-50 transition">
                    <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-red-50 transition">
                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                </button>
            </div>
        </div>

        <!-- 7 -->
        <div class="grid grid-cols-12">
            <div class="col-span-1 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">7</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-yellow-500 text-yellow-500">Mahasiswa</span>
            </div>
            <div class="col-span-3 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">2341720001@student.polinema.ac.id</span>
            </div>
            <div class="col-span-4 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">Dinda Safira</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center gap-2">
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-teal-500 text-teal-500 hover:border-teal-400 hover:text-teal-400 focus:outline-hidden focus:border-teal-400 focus:text-teal-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-teal-50 transition">
                    <x-lucide-files class="w-4 h-4 text-teal-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:outline-hidden focus:border-yellow-400 focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-50 transition">
                    <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-red-50 transition">
                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                </button>
            </div>
        </div>

        <!-- 8 -->
        <div class="grid grid-cols-12">
            <div class="col-span-1 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">8</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-yellow-500 text-yellow-500">Mahasiswa</span>
            </div>
            <div class="col-span-3 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">2341720002@student.polinema.ac.id</span>
            </div>
            <div class="col-span-4 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">Salsabila Putri</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center gap-2">
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-teal-500 text-teal-500 hover:border-teal-400 hover:text-teal-400 focus:outline-hidden focus:border-teal-400 focus:text-teal-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-teal-50 transition">
                    <x-lucide-files class="w-4 h-4 text-teal-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:outline-hidden focus:border-yellow-400 focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-50 transition">
                    <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-red-50 transition">
                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                </button>
            </div>
        </div>

        <!-- 9 -->
        <div class="grid grid-cols-12">
            <div class="col-span-1 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">9</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-yellow-500 text-yellow-500">Mahasiswa</span>
            </div>
            <div class="col-span-3 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">2341720003@student.polinema.ac.id</span>
            </div>
            <div class="col-span-4 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">Reza Mahendra</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center gap-2">
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-teal-500 text-teal-500 hover:border-teal-400 hover:text-teal-400 focus:outline-hidden focus:border-teal-400 focus:text-teal-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-teal-50 transition">
                    <x-lucide-files class="w-4 h-4 text-teal-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:outline-hidden focus:border-yellow-400 focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-50 transition">
                    <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-red-50 transition">
                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                </button>
            </div>
        </div>

        <!-- 10 -->
        <div class="grid grid-cols-12">
            <div class="col-span-1 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">10</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-yellow-500 text-yellow-500">Mahasiswa</span>
            </div>
            <div class="col-span-3 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">2341720004@student.polinema.ac.id</span>
            </div>
            <div class="col-span-4 h-12 px-5 py-3 border-b border-gray-200 flex items-center">
                <span class="text-gray-700 text-sm font-medium leading-tight tracking-tight">Yoga Saputra</span>
            </div>
            <div class="col-span-2 h-12 px-5 py-3 border-b border-gray-200 flex items-center gap-2">
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-teal-500 text-teal-500 hover:border-teal-400 hover:text-teal-400 focus:outline-hidden focus:border-teal-400 focus:text-teal-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-teal-50 transition">
                    <x-lucide-files class="w-4 h-4 text-teal-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:outline-hidden focus:border-yellow-400 focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-yellow-50 transition">
                    <x-lucide-file-pen class="w-4 h-4 text-yellow-500" />
                </button>
                <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none hover:bg-red-50 transition">
                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                </button>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-end items-center mt-8">
            <div class="rounded-lg flex items-center overflow-hidden">
                <div class="h-9 px-3 rounded-lg flex items-center gap-2">
                    <span class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">«</span>
                    <span class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">Sebelumnya</span>
                </div>
                <div class="flex items-center">
                    <div class="w-9 h-9 bg-gray-200 rounded-lg flex justify-center items-center">
                        <span class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">1</span>
                    </div>
                    <div class="w-9 h-9 rounded-lg flex justify-center items-center">
                        <span class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">2</span>
                    </div>
                    <div class="w-9 h-9 rounded-lg flex justify-center items-center">
                        <span class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">3</span>
                    </div>
                    <div class="w-9 h-9 rounded-lg flex justify-center items-center">
                        <span class="text-center text-gray-500 text-xs font-medium leading-none tracking-tight">•••</span>
                    </div>
                    <div class="w-9 h-9 rounded-lg flex justify-center items-center">
                        <span class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">10</span>
                    </div>
                </div>
                <div class="h-9 px-3 rounded-lg flex items-center gap-2">
                    <span class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">Selanjutnya</span>
                <span class="text-center text-gray-500 text-base font-medium leading-normal tracking-tight">»</span>
            </div>
        </div>
    </div>
</div>

@endsection