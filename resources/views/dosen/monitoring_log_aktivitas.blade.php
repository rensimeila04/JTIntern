@extends('layout.template')

@section('content')
    <div class="w-full p-4 bg-white rounded-xl flex-col space-y-4">
        <!-- Header dan tombol aksi -->
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-medium">Monitoring Log Aktivitas</div>
        </div>

        <!-- Filter "Semua Status" -->
        <div class="flex justify-between w-full items-center">
            <div class="flex items-start space-x-2">
                <!-- Status Filter -->
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-default" type="button"
                        class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-neutral-900 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        @if (request('status') == 'belum_ada')
                            Menunggu
                        @elseif(request('status') == 'sudah_ada')
                            Dinilai
                        @else
                            Semua Status
                        @endif

                        <x-lucide-chevron-down class="hs-dropdown-open:rotate-180 size-4" />
                    </button>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                        <div class="p-1 space-y-0.5">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100"
                                href="{{ route('dosen.monitoring_log_aktivitas', ['search' => request('search')]) }}">
                                Semua Status
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100"
                                href="{{ route('dosen.monitoring_log_aktivitas', ['status' => 'belum_ada', 'search' => request('search')]) }}">
                                Menunggu
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100"
                                href="{{ route('dosen.monitoring_log_aktivitas', ['status' => 'sudah_ada', 'search' => request('search')]) }}">
                                Dinilai
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <!-- Table Header -->
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="w-14 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        ID</th>
                                    <th scope="col"
                                        class="w-68 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Nama Mahasiswa</th>
                                    <th scope="col"
                                        class="w-68 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Hari, Tanggal</th>
                                    <th scope="col"
                                        class="w-68 px-3 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Kegiatan</th>
                                    <th scope="col"
                                        class="w-34 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Status Feedback</th>
                                    <th scope="col"
                                        class="w-27 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400 whitespace-nowrap">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <!-- Table Body -->
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse($logAktivitas as $i => $log)
                                    <tr>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $log->id_log_aktivitas }}
                                        </td>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $log->magang->mahasiswa->user->name }}
                                        </td>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('l, d F Y') }}
                                        </td>
                                        <td
                                            class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 w-68 overflow-hidden truncate">
                                            {{ $log->kegiatan }}
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = 'border-yellow-500 text-yellow-500';
                                                $statusText = 'Menunggu';

                                                if ($log->status_feedback == 'sudah_ada') {
                                                    $statusClass = 'border-teal-500 text-teal-500';
                                                    $statusText = 'Dinilai';
                                                }
                                            @endphp
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border {{ $statusClass }}">
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('dosen.monitoring.detail', ['id_magang' => $log->magang->id_magang, 'id_log_aktivitas' => $log->id_log_aktivitas]) }}"
                                                class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-600 disabled:opacity-50 disabled:pointer-events-none">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada aktivitas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        @if ($logAktivitas->hasPages())
            <div class="flex items-center justify-end mt-8">
                {{ $logAktivitas->links('custom.pagination') }}
            </div>
        @endif
    </div>
@endsection
