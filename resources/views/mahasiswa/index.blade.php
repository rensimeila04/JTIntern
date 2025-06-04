@extends('layout.template')
@section('content')
    <div class="flex flex-col gap-6">
        <span class="text-xl font-medium">
            <h2>Selamat datang kembali, {{ Auth::user()->name }}</h2>
        </span>
        <div class="grid grid-cols-3 gap-4 w-full">
            <div class="bg-white rounded-lg p-4 ">
                <div class="flex flex-row gap-2.5">
                    <div class="flex flex-row gap-4 w-full items-center">
                        <div class="bg-primary-100 rounded-lg p-4">
                            <x-lucide-briefcase class="w-8 h-8 text-primary-600" />
                        </div>
                        <div class="flex flex-col gap-2.5">
                            <div class="flex gap-2.5 font-medium text-base">
                                <p>UI/UX Designer</p>
                                <span
                                    class="inline-flex items-center gap-x-1.5 py-0.5 px-1 rounded-md text-[10px] font-medium border border-blue-400 bg-white text-blue-600">
                                    Magang
                                </span>
                            </div>
                            <p class="text-neutral-400 text-xs">PT. Quantum Technology Nusantara</p>
                        </div>
                        <span class="text-sm font-medium text-primary-500 underline ml-auto" href="#">
                            Detail
                        </span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4">
                <div class="flex flex-row gap-2.5">
                    <div class="flex flex-row gap-4 w-full items-center">
                        <div class="bg-orange-100 rounded-lg p-4">
                            <x-lucide-book-open class="w-8 h-8 text-orange-600" />
                        </div>
                        <div class="flex flex-col gap-2.5">
                            <div class="flex gap-2.5 font-medium text-base">
                                <p>Log Aktivitas</p>
                                <span
                                    class="inline-flex items-center gap-x-1.5 py-0.5 px-1 rounded-md text-[10px] font-medium border border-teal-400 bg-white text-teal-600">
                                    Wajib
                                </span>
                            </div>
                            <p class="text-neutral-400 text-xs">Catat kegiatan magangmu</p>
                        </div>
                        <a class="text-sm font-medium text-primary-500 underline ml-auto"
                            href="{{ route('mahasiswa.log_aktivitas') }}">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4">
                <div class="flex flex-row gap-2.5">
                    <div class="flex flex-row gap-4 w-full items-center">
                        <div class="bg-blue-100 rounded-lg p-4">
                            <i class="ph ph-chat-teardrop-text text-[32px] text-blue-600"></i>
                        </div>
                        <div class="flex flex-col gap-2.5">
                            <div class="flex gap-2.5 font-medium text-base">
                                <p>Feedback Magang</p>
                                <span
                                    class="inline-flex items-center gap-x-1.5 py-0.5 px-1 rounded-md text-[10px] font-medium border border-blue-400 bg-white text-blue-600">
                                    Wajib
                                </span>
                            </div>
                            <p class="text-neutral-400 text-xs">Bagikan pengalamanmu!</p>
                        </div>
                        <a class="text-sm font-medium text-primary-500 underline ml-auto"
                            href="{{ route('mahasiswa.feedback') }}">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-between">
            <p class="text-xl font-medium">Lowongan Terbaru</p>
            <p class="text-base font-semibold text-primary-500">Lihat semua</p>
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
                        <a href="#" class="btn-outline bg-gray-100 text-gray-300 hover:bg-primary-700 hover:text-white">
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
                        <a href="#" class="btn-outline bg-gray-100 text-gray-300 hover:bg-primary-700 hover:text-white">
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
                        <a href="#" class="btn-outline bg-gray-100 text-gray-300 hover:bg-primary-700 hover:text-white">
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
                        <a href="#" class="btn-outline bg-gray-100 text-gray-300 hover:bg-primary-700 hover:text-white">
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