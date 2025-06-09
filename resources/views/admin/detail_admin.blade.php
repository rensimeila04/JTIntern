@extends('layout.template')

@section('content')
    <div class="flex gap-4">
        <div class="w-full p-4 bg-white rounded-xl flex flex-col items-center gap-10 ">
            <div class="w-full flex justify-beetwen items-center">
                <div class="text-neutral-900 text-xl font-medium tracking-tight">Detail Pengguna</div>
            </div>

            @if (isset($user->profile_photo) && $user->profile_photo)
                <img src="{{ asset('Images/' . $user->profile_photo) }}" alt="Profile Picture"
                    class="w-30 h-30 rounded-lg object-cover">
            @else
                <img src="{{ asset('Images/avatar.svg') }}" alt="Profile Picture" 
                    class="w-30 h-30 rounded-lg object-cover">
            @endif


            <div class="w-full flex justify-start items-center gap-6">
                <div class="flex flex-col items-start gap-4">
                    <div class="w-24 text-neutral-900 text-sm font-medium">NIP</div>
                    <div class="text-neutral-900 text-sm font-medium ">Nama Lengkap</div>
                    <div class="w-24 text-neutral-900 text-sm font-medium ">Email</div>
                    <div class="text-neutral-900 text-sm font-medium ">Level Pengguna</div>
                </div>
                <div class="flex flex-col items-start gap-4">
                    <div class="text-neutral-400 text-sm font-medium">{{ $user->admin->nip }}</div>
                    <div class="text-neutral-400 text-sm font-medium">{{ $user->name }}</div>
                    <div class="text-neutral-400 text-sm font-medium">{{ $user->email }}</div>
                    <div class="text-neutral-400 text-sm font-medium">{{ $user->level->nama_level }}</div>
                </div>
            </div>
        </div>

        <div class="w-full h-[400px] p-4 bg-white rounded-xl flex flex-col items-center gap-6 ">
            <div class="w-full flex justify-beetwen items-center">
                <div class="text-neutral-900 text-xl font-medium tracking-tight">Kata Sandi</div>
            </div>
            <button type="button"
                class="w-full py-3 px-4 flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                <x-lucide-lock class="w-3.5" /> Atur Ulang Kata Sandi
            </button>
        </div>
    </div>
@endsection