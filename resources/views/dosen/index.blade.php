@extends('layout.template')
@section('content')
    <div class="flex flex-col gap-6">
        <span class="text-xl font-medium">
            <h2>Selamat datang kembali, {{ Auth::user()->name }}</h2>
        </span>
        <div class="grid grid-cols-3 gap-4 w-full">
            <div class="p-4 bg-white rounded-lg">
                <div class="flex flex-col gap-4 items-center">
                    <div class="flex gap-2">
                        <span class="bg-primary-100 rounded-sm w-8 h-8 flex items-center justify-center">
                            <x-lucide-user-check class="w-6 h-6 text-primary-600" />
                        </span>
                        <p class="text-base font-medium text-neutral-400">Mahasiswa Bimbingan</p>
                    </div>
                    <p class="text-4xl font-medium">{{ $countMahasiswaBimbingan }}</p>
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg">
                <div class="flex flex-col gap-4 items-center">
                    <div class="flex gap-2">
                        <span class="bg-primary-100 rounded-sm w-8 h-8 flex items-center justify-center">
                            <x-lucide-briefcase class="w-6 h-6 text-primary-600" />
                        </span>
                        <p class="text-base font-medium text-neutral-400">Magang Aktif</p>
                    </div>
                    <p class="text-4xl font-medium">{{ $countMagangAktif }}</p>
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg">
                <div class="flex flex-col gap-4 items-center">
                    <div class="flex gap-2">
                        <span class="bg-primary-100 rounded-sm w-8 h-8 flex items-center justify-center">
                            <x-lucide-message-square-plus class="w-6 h-6 text-primary-600" />
                        </span>
                        <p class="text-base font-medium text-neutral-400">Menunggu Feedback</p>
                    </div>
                    <p class="text-4xl font-medium">{{ $countMenungguFeedback }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white h-fit p-4 rounded-lg space-y-6">
            <div class="flex items-center justify-between">
                <p class="text-xl font-medium text-neutral-900">Aktivitas Terbaru</p>
                <a href="{{ route('dosen.monitoring_log_aktivitas') }}" class="text-primary-600 text-sm font-medium hover:underline">Lihat Semua</a>
            </div>
            
            <div>
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                    <thead class="bg-gray-50 dark:bg-neutral-700">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-auto">
                                                ID</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                Nama Mahasiswa</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                Hari, tanggal</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                Kegiatan</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400 w-auto">
                                                Status Feedback</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                        @forelse($logAktivitasTerbaru as $i => $log)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 w-auto">
                                                    {{ $log->id_log_aktivitas }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                    {{ $log->magang->mahasiswa->user->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                    {{ \Carbon\Carbon::parse($log->tanggal)->translatedFormat('l, d F Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                    {{ $log->kegiatan }}
                                                </td>
                                               <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 w-auto">
                                                    @php
                                                        // Cek feedback_dospem, bukan hanya status_feedback
                                                        if (empty($log->feedback_dospem)) {
                                                            $statusClass = 'border-yellow-400 text-yellow-500';
                                                            $statusText = 'Menunggu';
                                                        } else {
                                                            $statusClass = 'border-gray-400 text-teal-500';
                                                            $statusText = 'Dinilai';
                                                        }
                                                    @endphp
                                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border {{ $statusClass }}">
                                                        {{ $statusText }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada aktivitas terbaru.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection