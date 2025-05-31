@extends('layout.template')
@section('content')
    <div class="space-y-4">
        <div class="flex flex-col justify-start mt-5 w-full bg-white p-4 rounded-md">
            <div class="mb-4">
                <h2 class="text-xl font-medium text-black mb-3">Detail Lowongan</h2>
            </div>
            <div class="flex">
                <img src="{{asset('Images/LOGOPT.png') }}">
                <div class="flex flex-col pl-6 gap-y-2.5">
                    <div class="flex gap-4 items-center">
                        <h4 class="font-medium text-lg">UI UX DESIGNER</h4>
                        <span
                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 bg-white text-teal-500">
                            AktifMerekrut
                        </span>
                    </div>
                    <p class="text-primary-500 text-sm">
                        PT. Quantum Technology Nusantara
                    </p>
                    <div class="flex flex-row items-center gap-10">
                        <div class="flex flex-col gap-2">
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-map-pin class="w-5 h-5 text-neutral-500 text-2xl" />
                                <p>Jakarta Selatan, DKI Jakarta, Indonesia</p>
                            </span>
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-calendar-days class="w-5 h-5 text-neutral-500 text-2xl" />
                                <p>Ganjil 2026</p>
                            </span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-laptop class="w-5 h-5 text-neutral-500 text-2xl" />
                                <p>UI/UX Design</p>
                            </span>
                            <span class="flex items-center gap-2 text-sm text-neutral-700">
                                <x-lucide-building-2 class="w-5 h-5 text-neutral-500 text-2xl" />
                                <p>WFO</p>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="justify-end ml-auto">
                    <a href="#"
                        class="btn-outline bg-primary-500 text-white border-primary-500 hover:bg-primary-700 hover:text-white">
                        <x-lucide-briefcase stroke-width="1.5" class="size-3.5 text-white" />
                        Ajukan Magang
                    </a>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-3 w-full bg-white p-4 rounded-md">
            <h2 class="font-medium text-xl">Deskripsi</h2>
            <p class="mt-2 text-neutral-400 text-sm">We are seeking a skilled and detail-focused UI/UX Designer to
                develop engaging,
                user-friendly interfaces and
                intuitive digital experiences. You will collaborate closely with product managers, developers, and
                stakeholders
                to transform requirements into wireframes, prototypes, and polished designs that meet both user needs
                and
                business objectives.</p>
        </div>
        <div class="flex flex-col gap-3 w-full bg-white p-4 rounded-md">
            <h2 class="font-medium text-xl">Persyaratan</h2>
            <p class="mt-2 text-neutral-400 text-sm">We are seeking a skilled and detail-focused UI/UX Designer to
                develop engaging,
                user-friendly interfaces and
                intuitive digital experiences. You will collaborate closely with product managers, developers, and
                stakeholders
                to transform requirements into wireframes, prototypes, and polished designs that meet both user needs
                and
                business objectives.</p>
        </div>
        <div class="flex flex-col gap-3 w-full bg-white p-4 rounded-md">
            <h2 class="font-medium text-xl">Informasi Test</h2>
            <p class="mt-2 text-neutral-400 text-sm">We are seeking a skilled and detail-focused UI/UX Designer to
                develop engaging,
                user-friendly interfaces and
                intuitive digital experiences. You will collaborate closely with product managers, developers, and
                stakeholders
                to transform requirements into wireframes, prototypes, and polished designs that meet both user needs
                and
                business objectives.</p>
        </div>
        <div class="flex flex-col gap-6 w-full bg-white p-4 rounded-md">
            <h2 class="font-medium text-xl">Tentang Perusahaan</h2>
            <div class="flex">
                <img src="{{asset('Images/LOGOPT.png') }}">
                <div class="flex flex-col pl-6 gap-y-6">
                    <div class="flex gap-4 items-center">
                        <h4 class="font-medium text-lg">PT Neural Technologies Indonesia (Official)</h4>
                    </div>
                    <div class="flex flex-row gap-9">
                        <div class="flex flex-col gap-2 items-start">
                            <span class="text-neutral-400 font-normal text-sm">
                                <p>Jenis Perusahaan</p>
                            </span>
                            <span class="text-neutral-700 font-normal text-sm">
                                <p>Software House</p>
                            </span>
                        </div>
                        <div class="flex flex-col gap-2 items-start">
                            <span class="text-neutral-400 font-normal text-sm">
                                <p>Bidang Industri</p>
                            </span>
                            <span class="text-neutral-700 font-normal text-sm">
                                <p>Information Technology and Services</p>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-3 w-full rounded-md">
                <h2 class="font-medium text-xl">Deskripsi</h2>
                <p class="mt-2 text-neutral-400 text-sm">Neural Technologies Indonesia adalah Perusahaan IT
                    Consulting yang menyediakan solusi end-to-end untuk berbagai jenis industri sesuai dengan
                    kebutuhan setiap perusahaan.</p>
            </div>
        </div>
        <div>
            <h2 class="text-xl font-medium text-black mb-4">Lowongan Lainnya</h2>
        </div>
        <div class="grid grid-cols-2 gap-5">
            <div class="flex flex-col bg-white rounded-md px-4 py-6">
                <div class="flex flex-row gap-6 items-center">
                    <img src="{{asset('Images/LOGOPT.png') }}" class="w-20 h-20">
                    <div class="flex flex-col gap-2">
                        <div class="flex gap-4 items-center">
                            <h4 class="font-medium text-lg">UI UX DESIGNER</h4>
                        </div>
                        <div class="flex flex-row items-center gap-2">
                            <p class="text-sm font-normal text-neutral-400">PT. Quantum</p>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="4" height="4" viewBox="0 0 4 4" fill="none">
                                    <circle cx="2" cy="2" r="2" fill="#A3A3A3" />
                                </svg>
                            </span>
                            <p class="text-sm font-normal text-neutral-400">Jakarta Pusat</p>
                        </div>
                        <div class="flex flex-row gap-2">
                            <span
                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-300 bg-white text-gray-500">WFO</span>
                            <span
                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-300 bg-white text-gray-500">Software
                                House</span>
                        </div>
                    </div>
                    <div class="justify-end ml-auto">
                        <a href="#"
                            class="btn-outline bg-primary-500 text-white border-primary-500 hover:bg-primary-700 hover:text-white">
                            Ajukan Magang
                        </a>
                    </div>
                </div>
                <hr class="w-full my-4 mx-auto border-t-2 border-neutral-200">
                <div class="flex flex-row items-center gap-2">
                    <p class="text-sm font-normal text-neutral-400">23 hari tersisa</p>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="4" height="4" viewBox="0 0 4 4" fill="none">
                            <circle cx="2" cy="2" r="2" fill="#A3A3A3" />
                        </svg>
                    </span>
                    <p class="text-sm font-normal text-neutral-400">30 Pelamar</p>
                </div>
            </div>
        </div>
    </div>
@endsection