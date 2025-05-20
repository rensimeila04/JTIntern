@extends('layout.template')
@section('content')
    <div class="space-y-4">
        {{-- Detail Perusahaan Mitra --}}
        <div class="bg-white h-fit p-6 rounded-lg space-y-6">
            <div class="flex justify-between items-center">
                <p class="text-xl font-medium text-neutral-900">Detail Perusahaan Mitra</p>
            </div>
            <div class="flex items-center gap-8">
                <img src="{{ asset('Images/logo_mitra.png') }}" alt="Logo Perusahaan"
                    class="w-32 h-32 rounded-lg object-cover">
                <div class="flex flex-col gap-6">
                    <p class="text-lg font-medium text-neutral-900">PT Neural Technologies Indonesia (Official)</p>
                    <div class="flex gap-8">
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">Jenis Perusahaan</p>
                            <p class="text-sm font-semibold text-neutral-700">Software House</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">Bidang Industri</p>
                            <p class="text-sm font-semibold text-neutral-700">Information Technology and Services</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Deskripsi & Kontak --}}
        <div class="flex flex-row gap-6">
            <div class="w-1/2 p-6 bg-white rounded-xl flex flex-col gap-6">
                <div class="flex justify-between items-center">
                    <p class="text-xl font-medium text-neutral-900">Deskripsi</p>
                </div>
                <div class="flex gap-8">
                    <div class="flex flex-col gap-6">
                        <p class="text-sm font-normal text-neutral-400">Neural Technologies Indonesia adalah Perusahaan IT
                            Consulting yang menyediakan solusi end-to-end untuk berbagai jenis industri sesuai dengan
                            kebutuhan setiap perusahaan.</p>
                    </div>
                </div>
            </div>
            <div class="w-1/2 p-6 bg-white rounded-xl flex flex-col gap-6">
                <div class="flex justify-between items-center">
                    <p class="text-xl font-medium text-neutral-900">Kontak</p>
                </div>
                <div class="flex gap-6">
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <i class="ph ph-map-pin text-primary-500 text-2xl"></i>
                            <p class="align-top text-sm font-normal text-neutral-700">Jakarta Pusat, DKI Jakarta, Indonesia
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ph ph-phone text-primary-500 text-2xl"></i>
                            <p class="align-top text-sm font-normal text-neutral-700">+62 821-2345-6789</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ph ph-envelope text-primary-500 text-2xl"></i>
                            <p class="align-top text-sm font-normal text-neutral-700">hr@neural.tech</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Lowongan Tersedia --}}
        <div class="h-fit rounded-lg space-y-3">
            <div class="flex justify-between items-center">
                <p class="text-xl font-medium text-neutral-900">Lowongan Tersedia</p>
            </div>
            <div class="space-y-4">
                <div class="flex flex-col gap-6">
                    <div class="bg-white h-fit w-full py-4 px-6 rounded-lg flex items-center gap-6">
                        <img src="{{ asset('Images/logo_mitra.png') }}" alt="Logo Perusahaan"
                            class="w-20 h-20 rounded-lg object-cover">
                        <div class="flex flex-col gap-4 flex-1">
                            <div class="flex items-center gap-2">
                                <p class="text-xl font-medium text-neutral-900">UI UX Designer</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-lucide-calendar-days class="w-6 h-6 mr-2 text-neutral-500" />
                                <p class="align-top text-base font-normal text-neutral-700">Ganjil 2026</p>
                            </div>
                        </div>
                        <button type="button"
                            class="py-3 px-4 inline-flex items-center justify-end gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 focus:outline-hidden focus:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none ml-auto">
                            Lihat Detail
                        </button>
                    </div>
                    <div class="bg-white h-fit w-full py-4 px-6 rounded-lg flex items-center gap-6">
                        <img src="{{ asset('Images/logo_mitra.png') }}" alt="Logo Perusahaan"
                            class="w-20 h-20 rounded-lg object-cover">
                        <div class="flex flex-col gap-4 flex-1">
                            <div class="flex items-center gap-2">
                                <p class="text-xl font-medium text-neutral-900">Frontend Developer</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-lucide-calendar-days class="w-6 h-6 mr-2 text-neutral-500" />
                                <p class="align-top text-base font-normal text-neutral-700">Ganjil 2026</p>
                            </div>
                        </div>
                        <button type="button"
                            class="py-3 px-4 inline-flex items-center justify-end gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 focus:outline-hidden focus:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none ml-auto">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
