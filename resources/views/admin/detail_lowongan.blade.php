@extends('layout.template')
@section('content')
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-medium">Detail Lowongan</h2>
        </div>
        <div>
            <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-primary-500 text-primary-500 hover:border-primary-700 hover:text-primary-700 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                <i class="ph ph-note-pencil"></i>
                Edit Lowongan
            </button>
        </div>
    </div>
    <div class="flex justify-start items-center mt-5 w-full bg-white p-4 rounded-md">
        <div class="flex ">
            <img src="{{asset('Images/LOGOPT.png') }}">
            <div class="flex flex-col pl-6 gap-y-2.5">
                <div class="flex gap-4 items-center">
                    <h4 class="font-semibold">UI UX DESIGNER</h4>
                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 bg-white text-teal-500">Aktif Merekrut</span>
                </div>
                <p class="text-primary-500 text-sm">
                    PT. Quantum Technology Nusantara
                </p>
                <div class="flex flex-col gap-1">
                    <span class="flex items-center gap-2 text-sm text-neutral-700">
                        <i class="ph ph-map-pin text-neutral-500 text-xl"></i>
                        <p>Jakarta Selatan, DKI Jakarta, Indonesia</p>
                    </span>
                    <span class="flex items-center gap-2 text-sm text-neutral-700">
                        <i class="ph ph-calendar text-neutral-500 text-xl"></i>
                        <p>Ganjil 2026</p>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full bg-white p-4 rounded-md mt-5">
        <h4 class="font-semibold">Deskripsi</h4>
        <p class="mt-2 text-neutral-400 text-sm">We are seeking a skilled and detail-focused UI/UX Designer to develop engaging,
            user-friendly interfaces and
            intuitive digital experiences. You will collaborate closely with product managers, developers, and stakeholders
            to transform requirements into wireframes, prototypes, and polished designs that meet both user needs and
            business objectives.</p>
    </div>
    <div class="w-full bg-white p-4 rounded-md mt-5">
        <h4 class="font-semibold">Persyaratan</h4>
        <p class="mt-2 text-neutral-400 text-sm">We are seeking a skilled and detail-focused UI/UX Designer to develop engaging,
            user-friendly interfaces and
            intuitive digital experiences. You will collaborate closely with product managers, developers, and stakeholders
            to transform requirements into wireframes, prototypes, and polished designs that meet both user needs and
            business objectives.</p>
    </div>
@endsection