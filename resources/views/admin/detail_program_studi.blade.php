@extends('layout.template')

@section('content')
    <div class="space-y-4">
        {{-- Detail Program Studi --}}
        <div class="bg-white h-fit p-6 rounded-lg space-y-6">
            <div class="flex justify-between items-center">
                <p class="text-xl font-medium text-neutral-900">Detail Program Studi</p>
            </div>
            <div class="flex items-center gap-8">
                <div class="w-32 h-32 bg-primary-100 rounded-lg flex items-center justify-center">
                    <i class="ph ph-graduation-cap text-primary-600 text-4xl"></i>
                </div>
                <div class="flex flex-col gap-6">
                    <p class="text-lg font-medium text-neutral-900">{{ $programStudi->nama_prodi }}</p>
                    <div class="flex gap-8">
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">ID Program Studi</p>
                            <p class="text-sm font-semibold text-neutral-700">
                                {{ $programStudi->id_program_studi }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">Kode Program Studi</p>
                            <p class="text-sm font-semibold text-neutral-700">
                                {{ $programStudi->kode_prodi }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('admin.program_studi') }}"
                    class="px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100">
                    <div class="flex items-center gap-2">
                        <i class="ph ph-arrow-left"></i>
                        <span>Kembali</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
