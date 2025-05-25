@extends('layout.template')

@section('content')
<div class="flex gap-4">
    <div class="w-full p-6 bg-white rounded-lg flex flex-col items-center gap-10 shadow">
        <div class="w-full flex justify-beetwen items-center">
            <div class="text-neutral-900 text-xl font-medium tracking-tight">Detail Pengguna</div>
        </div>
        <img src="{{ asset('Images/Jas.jpg') }}" alt="Profile Picture"
            lass="w-30 h-30 rounded-lg object-cover">

        <div class="w-full flex justify-start items-center gap-6">
            <div class="flex flex-col items-start gap-4">
                <div class="w-24 text-neutral-900 text-sm font-medium leading-tight tracking-tight">NIP</div>
                <div class="text-neutral-900 text-sm font-medium leading-tight tracking-tight">Nama Lengkap</div>
                <div class="w-24 text-neutral-900 text-sm font-medium leading-tight tracking-tight">Email</div>
                <div class="text-neutral-900 text-sm font-medium leading-tight tracking-tight">Level Pengguna</div>
            </div>
            <div class="flex flex-col items-start gap-4">
                <div class="text-neutral-400 text-sm font-medium leading-tight tracking-tight">198907152203123</div>
                <div class="text-neutral-400 text-sm font-medium leading-tight tracking-tight">Rizky Wahyu</div>
                <div class="text-neutral-400 text-sm font-medium leading-tight tracking-tight">rizkywahyu@polinema.ac.id</div>
                <div class="text-neutral-400 text-sm font-medium leading-tight tracking-tight">Administrator</div>
            </div>
        </div>
    </div>

    <div class="w-full h-[400px] p-6 bg-white rounded-lg flex flex-col items-center gap-6 shadow">
        <div class="w-full flex justify-beetwen items-center">
            <div class="text-neutral-900 text-xl font-medium tracking-tight">Kata Sandi</div>
        </div>
        <button type="button" class="w-full py-3 px-4 flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-500 disabled:opacity-50 disabled:pointer-events-none">
            <x-lucide-lock class="w-3.5" /> Atur Ulang Kata Sandi
        </button>
    </div>
</div>
@endsection