@extends('layout.template')
@section('content')
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <p class="text-xl font-medium text-neutral-900">Detail Mahasiswa</p>
            <div class="flex gap-2">
                <button type="button" onclick="openExportModal()" class="btn-primary bg-blue-500 hover:bg-blue-600">
                    <i class="ph ph-export text-lg"></i> Export PDF
                </button>
            </div>
        </div>
        <div class="bg-white h-fit p-6 rounded-lg space-y-6">
            <div class="flex items-center gap-8">
                <img src="{{ $magang->mahasiswa->user->profile_photo ? asset('storage/' . $magang->mahasiswa->user->profile_photo) : asset('Images/avatar.svg') }}"
                    alt="Profile Picture" class="w-30 h-30 rounded-lg object-cover">
                <div class="flex flex-col gap-6">
                    <p class="text-lg font-medium text-neutral-900">{{ $magang->mahasiswa->user->name }}</p>
                    <div class="flex gap-8">
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">NIM</p>
                            <p class="text-sm font-semibold text-neutral-700">{{ $magang->mahasiswa->nim }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">Email</p>
                            <p class="text-sm font-semibold text-neutral-700">{{ $magang->mahasiswa->user->email }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-normal text-neutral-400">Program Studi</p>
                            <p class="text-sm font-semibold text-neutral-700">
                                {{ $magang->mahasiswa->programStudi->nama_prodi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full p-4 bg-white rounded-2xl flex flex-col gap-6">
            <div class="flex justify-between items-center w-full">
                <div class="text-neutral-900 text-xl font-medium">Dokumen Pendukung</div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                @php
                    $documentTypes = [
                        'curriculum vitae' => ['icon' => 'ph ph-file', 'label' => 'Curriculum Vitae'],
                        'portofolio' => ['icon' => 'ph ph-image', 'label' => 'Portofolio'],
                        'sertifikat' => ['icon' => 'ph ph-medal', 'label' => 'Sertifikat'],
                        'surat pengantar' => ['icon' => 'ph ph-envelope-simple', 'label' => 'Surat Pengantar'],
                        'transkrip nilai' => ['icon' => 'ph ph-chart-line', 'label' => 'Transkrip Nilai'],
                    ];
                @endphp
                @foreach ($documentTypes as $docType => $config)
                    @php
                        $document = $magang->mahasiswa->dokumen
                            ->filter(function ($dok) use ($docType) {
                                if (!$dok->jenisDokumen) {
                                    return false;
                                }

                                $dbType = strtolower(trim($dok->jenisDokumen->nama));
                                $searchType = strtolower(trim($docType));

                                // Direct match
                                if ($dbType === $searchType) {
                                    return true;
                                }

                                // Flexible matching to handle variations
                                return str_contains($dbType, $searchType) || str_contains($searchType, $dbType);
                            })
                            ->first();
                    @endphp

                    <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                                @if (str_contains($config['icon'], 'x-lucide'))
                                    <{{ $config['icon'] }} class="w-4 h-4 text-primary-600" />
                                @else
                                    <i class="{{ $config['icon'] }} w-4 h-4 text-primary-600"></i>
                                @endif
                            </div>
                            <div class="text-neutral-900 text-base font-medium">{{ $config['label'] }}</div>
                        </div>

                        @if ($document)
                            <div class="flex flex-col gap-1 text-xs mt-auto">
                                <div class="flex flex-row items-center gap-1">
                                    <span class="text-neutral-900 font-medium">Diunggah:</span>
                                    <span class="text-neutral-500">{{ $document->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex flex-row items-center gap-1">
                                    <span class="text-neutral-900 font-medium">Ukuran:</span>
                                    <span class="text-neutral-500">
                                        @if ($document->path_dokumen && file_exists(storage_path('app/public/' . $document->path_dokumen)))
                                            {{ round(filesize(storage_path('app/public/' . $document->path_dokumen)) / 1024, 1) }}
                                            KB
                                        @else
                                            -
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="flex justify-start mt-auto">
                                <a href="{{ asset('storage/' . $document->path_dokumen) }}" target="_blank"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 border border-primary-500 rounded-lg text-primary-500 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm font-medium transition">
                                    <x-lucide-eye class="w-4 h-4 mr-2" />
                                    Lihat Dokumen
                                </a>
                            </div>
                        @else
                            <div class="flex flex-col gap-1 text-xs mt-auto">
                                <div class="flex flex-row items-center gap-1">
                                    <span class="text-neutral-500 font-medium">Belum diunggah</span>
                                </div>
                            </div>
                            <div class="flex justify-start mt-auto">
                                <button disabled
                                    class="w-full inline-flex items-center justify-center px-4 py-2 border border-neutral-300 rounded-lg text-neutral-400 bg-neutral-100 text-sm font-medium cursor-not-allowed">
                                    <x-lucide-eye class="w-4 h-4 mr-2" />
                                    Tidak Tersedia
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Detail Magang --}}
        <div class="h-fit rounded-lg space-y-3">
            <div class="space-y-4">
                <div class="bg-white h-fit w-full py-4 px-6 rounded-lg flex flex-col gap-6">
                    <div class="flex align-middle items-center gap-4">
                        <p class="text-xl font-medium text-neutral-900">Detail Magang</p>
                        <div id="status-badge">
                            @php
                                $statusClasses = match ($magang->status_magang) {
                                    'menunggu' => 'border-yellow-500 text-yellow-500',
                                    'diterima' => 'border-green-500 text-green-500',
                                    'ditolak' => 'border-red-500 text-red-500',
                                    'magang' => 'border-blue-500 text-blue-500',
                                    'selesai' => 'border-gray-500 text-gray-500',
                                    default => 'border-gray-500 text-gray-500',
                                };
                            @endphp
                            <span id="status-text"
                                class="inline-flex items-center h-[28px] gap-x-1.5 py-1 px-2 rounded-md text-xs font-medium border {{ $statusClasses }}">
                                {{ ucfirst($magang->status_magang) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex gap-8">
                        <img src="{{ $magang->lowongan->perusahaanMitra->logo_perusahaan ? asset('storage/' . $magang->lowongan->perusahaanMitra->logo_perusahaan) : asset('Images/placeholder_perusahaan.png') }}"
                            alt="Company Logo" class="w-30 h-30 rounded-lg object-cover">
                        <div class="flex flex-col gap-6">
                            <div class="flex flex-col gap-3">
                                <p class="text-xl font-medium text-neutral-900">{{ $magang->lowongan->judul_lowongan }}
                                </p>
                                <p class="text-base font-normal text-primary-500">
                                    {{ $magang->lowongan->perusahaanMitra->nama_perusahaan_mitra }}</p>
                                <div class="flex items-center gap-2">
                                    <x-lucide-map-pin class="w-6 h-6 text-neutral-500" stroke-width="1.5" />
                                    <p class="align-top text-base font-normal text-neutral-700">
                                        {{ $magang->lowongan->perusahaanMitra->alamat ?? 'Tidak Tersedia' }}</p>
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <x-lucide-calendar-days class="w-6 h-6 text-neutral-500" stroke-width="1.5" />
                                    <p class="align-top text-base font-normal text-neutral-700">
                                        {{ $magang->lowongan->periodeMagang->nama_periode ?? 'Tidak tersedia' }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <x-lucide-square-user-round class="w-6 h-6 text-neutral-500" stroke-width="1.5" />
                                    <p class="align-top text-base font-normal text-neutral-700">
                                        {{ $magang->dosenPembimbing->user->name ?? '-' }}</p>
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const statusText = document.getElementById('status-text');
                                    const btnTerima = document.getElementById('btn-terima');
                                    const btnTolak = document.getElementById('btn-tolak');
                                    const btnDetail = document.getElementById('btn-detail-lowongan');

                                    btnTerima?.addEventListener('click', function() {
                                        statusText.textContent = 'Diterima';
                                        statusText.className =
                                            'inline-flex items-center h-[28px] gap-x-1.5 py-1 px-2 rounded-md text-xs font-medium border border-green-500 text-green-500';
                                    });
                                    btnTolak?.addEventListener('click', function() {
                                        statusText.textContent = 'Ditolak';
                                        statusText.className =
                                            'inline-flex items-center h-[28px] gap-x-1.5 py-1 px-2 rounded-md text-xs font-medium border border-red-500 text-red-500';
                                    });
                                    btnDetail?.addEventListener('click', function() {
                                        window.location.href = '/detail-lowongan/{{ $magang->lowongan->id_lowongan }}';
                                    });
                                });
                            </script>
                        </div>

                    </div>
                    @if ($magang->status_magang == 'diterima' && $magang->tanggal_diterima)
                        <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-start gap-2">
                                <x-lucide-check class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" />
                                <div>
                                    <p class="text-sm font-medium text-green-800">Status Diterima</p>
                                    <p class="text-xs text-green-600 mt-1">
                                        Diterima pada:
                                        {{ \Carbon\Carbon::parse($magang->tanggal_diterima)->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- Log Aktivitas Section --}}
        <div class="bg-white h-fit p-6 rounded-lg space-y-6">
            <div class="flex flex-row justify-between">
                <p class="text-xl font-medium">Log Aktivitas</p>
            </div>
            @if ($logAktivitas->count() > 0)
                <div class="bg-neutral-50 rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-5 py-3 text-left text-xs font-medium text-gray-500 tracking-wider w-3/10">
                                        Hari, Tanggal
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 text-left text-xs font-medium text-gray-500 tracking-wider w-3/10">
                                        Waktu
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 max-w-xs text-left text-xs font-medium text-gray-500 tracking-wider w-3/10">
                                        Kegiatan
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 text-left text-xs font-medium text-gray-500 tracking-wider w-1/10">
                                        Status Feedback
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($logAktivitas as $log)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-5 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($log->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                            @if ($log->jam_masuk && $log->jam_pulang)
                                                {{ \Carbon\Carbon::parse($log->jam_masuk)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($log->jam_pulang)->format('H:i') }}
                                            @else
                                                08:00 - 17:00
                                            @endif
                                        </td>
                                        <td class="px-5 py-3 text-sm text-gray-900 max-w-xs">
                                            @php
                                                $kegiatan = $log->kegiatan ?? 'Tidak ada deskripsi kegiatan';
                                            @endphp
                                            <div class="truncate" title="{{ $kegiatan }}">
                                                {{ $kegiatan }}
                                            </div>
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap text-left">
                                            @if ($log->feedback_dospem || $log->status_feedback == 'dinilai')
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">
                                                    Dinilai
                                                </span>
                                            @elseif($log->status_feedback == 'menunggu')
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-yellow-500 text-yellow-500">
                                                    Menunggu
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-400 text-gray-400">
                                                    Belum Dinilai
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($logAktivitas->hasPages())
                        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 flex justify-between sm:hidden">
                                    @if ($logAktivitas->previousPageUrl())
                                        <a href="{{ $logAktivitas->previousPageUrl() }}"
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            Previous
                                        </a>
                                    @endif
                                    @if ($logAktivitas->nextPageUrl())
                                        <a href="{{ $logAktivitas->nextPageUrl() }}"
                                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            Next
                                        </a>
                                    @endif
                                </div>
                                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700">
                                            Menampilkan
                                            <span class="font-medium">{{ $logAktivitas->firstItem() ?? 0 }}</span>
                                            sampai
                                            <span class="font-medium">{{ $logAktivitas->lastItem() ?? 0 }}</span>
                                            dari
                                            <span class="font-medium">{{ $logAktivitas->total() }}</span>
                                            aktivitas
                                        </p>
                                    </div>
                                    <div>
                                        {{ $logAktivitas->links('custom.pagination') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-neutral-50 rounded-lg p-8">
                    <div class="flex items-center justify-center">
                        <div class="text-center">
                            <x-lucide-clock class="w-12 h-12 text-gray-400 mx-auto mb-3" />
                            <p class="text-sm font-medium text-gray-600">Belum Ada Log Aktivitas</p>
                            <p class="text-xs text-gray-500 mt-1">Mahasiswa belum mencatat aktivitas magang</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Alasan Penolakan Section - Tampil di bagian paling bawah --}}
    @if ($magang->status_magang == 'ditolak')
        <div class="bg-white h-fit p-6 rounded-lg space-y-6">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-red-100 rounded-full flex items-center justify-center">
                    <x-lucide-x-circle class="w-6 h-6 text-red-600" />
                </div>
                <div>
                    <p class="text-xl font-medium text-neutral-900">Informasi Penolakan</p>
                    <p class="text-sm text-neutral-500">Detail alasan penolakan pengajuan magang</p>
                </div>
            </div>

            <div class="bg-red-50 border border-red-200 rounded-lg p-6 space-y-4">
                {{-- Status dan Tanggal --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                        <span class="text-sm font-medium text-red-800">Status: Ditolak</span>
                    </div>
                    @if ($magang->tanggal_ditolak)
                        <div class="text-right">
                            <p class="text-xs text-red-600">Ditolak pada</p>
                            <p class="text-sm font-medium text-red-700">
                                {{ \Carbon\Carbon::parse($magang->tanggal_ditolak)->format('d M Y H:i') }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Alasan Penolakan --}}
                <div class="bg-white rounded-lg p-4">
                    <h5 class="text-sm font-medium text-red-900 mb-3 flex items-center gap-2">
                        <x-lucide-message-square-text class="w-4 h-4" />
                        Alasan Penolakan
                    </h5>

                    @if ($magang->alasan_penolakan)
                        <div class="relative">
                            <x-lucide-quote class="absolute top-0 left-0 w-4 h-4 text-red-400" />
                            <p
                                class="text-sm text-red-700 leading-relaxed pl-6 italic bg-red-25 p-3 rounded border-l-4 border-red-300">
                                {{ $magang->alasan_penolakan }}
                            </p>
                        </div>
                    @else
                        <div class="flex items-center justify-center py-6">
                            <div class="text-center">
                                <x-lucide-message-square-x class="w-8 h-8 text-red-400 mx-auto mb-2" />
                                <p class="text-sm text-red-600">Tidak ada alasan penolakan yang diberikan</p>
                                <p class="text-xs text-red-500 mt-1">Admin tidak memberikan alasan spesifik untuk penolakan
                                    ini</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Informasi Tambahan --}}
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start gap-2">
                        <x-lucide-info class="w-4 h-4 text-yellow-600 mt-0.5 flex-shrink-0" />
                        <div class="text-sm text-yellow-800">
                            <p class="font-medium mb-1">Langkah Selanjutnya:</p>
                            <ul class="list-disc list-inside space-y-1 text-xs">
                                <li>Mahasiswa dapat mengajukan ke lowongan magang lain yang tersedia</li>
                                <li>Pastikan dokumen pendukung sudah lengkap sebelum mengajukan kembali</li>
                                <li>Hubungi admin jika memerlukan klarifikasi lebih lanjut</li>
                                <li>Perbaiki aspek yang menjadi alasan penolakan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Detail Pengajuan yang Ditolak --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white rounded-lg p-4">
                        <h6 class="text-xs font-medium text-red-900 mb-2">Pengajuan yang Ditolak</h6>
                        <div class="space-y-1">
                            <p class="text-sm text-red-700">{{ $magang->lowongan->judul_lowongan }}</p>
                            <p class="text-xs text-red-600">
                                {{ $magang->lowongan->perusahaanMitra->nama_perusahaan_mitra }}</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg p-4">
                        <h6 class="text-xs font-medium text-red-900 mb-2">Mahasiswa</h6>
                        <div class="space-y-1">
                            <p class="text-sm text-red-700">{{ $magang->mahasiswa->user->name }}</p>
                            <p class="text-xs text-red-600">{{ $magang->mahasiswa->nim }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal Tolak --}}
    <div id="hs-tolak-modal"
        class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-80 opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="hs-tolak-modal-label">
        <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xl rounded-xl pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 id="hs-tolak-modal-label" class="font-bold text-gray-800">
                        Konfirmasi Penolakan Magang
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
                        aria-label="Close" data-hs-overlay="#hs-tolak-modal">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-red-100 rounded-full flex items-center justify-center">
                                <x-lucide-x-circle class="w-5 h-5 text-red-600" />
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Tolak Pengajuan Magang</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    Apakah Anda yakin ingin menolak pengajuan magang dari
                                    <strong>{{ $magang->mahasiswa->user->name }}</strong>
                                    untuk posisi <strong>{{ $magang->lowongan->judul_lowongan }}</strong> di
                                    <strong>{{ $magang->lowongan->perusahaanMitra->nama_perusahaan_mitra }}</strong>?
                                </p>
                            </div>
                        </div>

                        <!-- Alasan Penolakan -->
                        <div class="space-y-2">
                            <label for="alasan-penolakan" class="block text-sm font-medium text-gray-900">
                                Alasan Penolakan <span class="text-gray-500 text-xs">(opsional)</span>
                            </label>
                            <textarea id="alasan-penolakan" name="alasan_penolakan" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 resize-none"
                                placeholder="Berikan alasan penolakan untuk membantu mahasiswa memahami keputusan..."></textarea>
                            <p class="text-xs text-gray-500">
                                <x-lucide-info class="inline w-3 h-3 mr-1" />
                                Alasan penolakan akan dikirimkan kepada mahasiswa
                            </p>
                        </div>

                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                            <div class="flex items-start gap-2">
                                <x-lucide-alert-triangle class="w-4 h-4 text-yellow-600 mt-0.5 flex-shrink-0" />
                                <div class="text-sm text-yellow-800">
                                    <p class="font-medium">Perhatian!</p>
                                    <ul class="mt-1 list-disc list-inside space-y-0.5 text-xs">
                                        <li>Status magang akan berubah menjadi "Ditolak"</li>
                                        <li>Mahasiswa akan mendapat notifikasi penolakan</li>
                                        <li>Keputusan ini tidak dapat dibatalkan</li>
                                        <li>Mahasiswa dapat mengajukan ke lowongan lain</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-overlay="#hs-tolak-modal">
                        Batal
                    </button>
                    <button type="button" id="confirm-tolak"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        <x-lucide-x class="w-4 h-4" />
                        Ya, Tolak
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Terima --}}
    <div id="hs-terima-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="hs-terima-modal-label">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xl rounded-xl pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 id="hs-terima-modal-label" class="font-bold text-gray-800">
                        Konfirmasi Penerimaan Magang
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
                        aria-label="Close" data-hs-overlay="#hs-terima-modal">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-green-100 rounded-full flex items-center justify-center">
                                <x-lucide-check-circle class="w-5 h-5 text-green-600" />
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Terima Pengajuan Magang</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    Apakah Anda yakin ingin menerima pengajuan magang dari
                                    <strong>{{ $magang->mahasiswa->user->name }}</strong>
                                    untuk posisi <strong>{{ $magang->lowongan->judul_lowongan }}</strong> di
                                    <strong>{{ $magang->lowongan->perusahaanMitra->nama_perusahaan_mitra }}</strong>?
                                </p>
                            </div>
                        </div>

                        <!-- Dosen Pembimbing Selection -->
                        <div class="space-y-2">
                            <label for="dosen-pembimbing" class="block text-sm font-medium text-gray-900">
                                Pilih Dosen Pembimbing <span class="text-red-500">*</span>
                            </label>
                            <select id="dosen-pembimbing" name="id_dosen_pembimbing"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                required>
                                <option value="">-- Pilih Dosen Pembimbing --</option>
                                @foreach ($dosenPembimbing as $dosen)
                                    <option value="{{ $dosen->id_dosen_pembimbing }}"
                                        {{ $magang->id_dosen_pembimbing == $dosen->id_dosen_pembimbing ? 'selected' : '' }}>
                                        {{ $dosen->user->name }} - {{ $dosen->nip }}
                                        @if ($dosen->bidang_minat)
                                            ({{ $dosen->bidang_minat }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <div id="dosen-error" class="text-red-500 text-xs hidden">
                                <x-lucide-alert-circle class="inline w-3 h-3 mr-1" />
                                Dosen pembimbing wajib dipilih
                            </div>
                            <p class="text-xs text-gray-500">
                                <x-lucide-info class="inline w-3 h-3 mr-1" />
                                Pilih dosen pembimbing untuk mahasiswa ini <span
                                    class="text-red-500 font-medium">(wajib)</span>
                            </p>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                            <div class="flex items-start gap-2">
                                <x-lucide-info class="w-4 h-4 text-blue-600 mt-0.5 flex-shrink-0" />
                                <div class="text-sm text-blue-800">
                                    <p class="font-medium mb-1">Setelah menerima pengajuan:</p>
                                    <ul class="mt-1 list-disc list-inside space-y-0.5 text-xs">
                                        <li>Status magang akan berubah menjadi "Diterima"</li>
                                        <li>Mahasiswa akan mendapat notifikasi penerimaan</li>
                                        <li>Dosen pembimbing akan ditugaskan (jika dipilih)</li>
                                        <li>Proses magang dapat dimulai sesuai jadwal</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-overlay="#hs-terima-modal">
                        Batal
                    </button>
                    <button type="button" id="confirm-terima"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        <x-lucide-check class="w-4 h-4" />
                        Ya, Terima
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusText = document.getElementById('status-text');
            const btnTolak = document.getElementById('btn-tolak');
            const btnDetail = document.getElementById('btn-detail-lowongan');
            const confirmTerima = document.getElementById('confirm-terima');
            const confirmTolak = document.getElementById('confirm-tolak');
            const dosenSelect = document.getElementById('dosen-pembimbing');
            const dosenError = document.getElementById('dosen-error');
            const alasanTextarea = document.getElementById('alasan-penolakan');

            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            // Real-time validation for dosen pembimbing selection
            dosenSelect?.addEventListener('change', function() {
                if (this.value) {
                    this.classList.remove('border-red-300');
                    this.classList.add('border-gray-300');
                    dosenError.classList.add('hidden');
                    confirmTerima.disabled = false;
                    confirmTerima.classList.remove('opacity-50', 'cursor-not-allowed');
                } else {
                    this.classList.remove('border-gray-300');
                    this.classList.add('border-red-300');
                    dosenError.classList.remove('hidden');
                    confirmTerima.disabled = true;
                    confirmTerima.classList.add('opacity-50', 'cursor-not-allowed');
                }
            });

            // Initially disable confirm button if no dosen selected
            if (!dosenSelect?.value) {
                confirmTerima.disabled = true;
                confirmTerima.classList.add('opacity-50', 'cursor-not-allowed');
            }

            // Handle modal confirm terima button
            confirmTerima?.addEventListener('click', function() {
                const selectedDosenId = dosenSelect.value;

                // Frontend validation
                if (!selectedDosenId) {
                    dosenSelect.classList.remove('border-gray-300');
                    dosenSelect.classList.add('border-red-300');
                    dosenError.classList.remove('hidden');
                    dosenSelect.focus();

                    // Shake animation for attention
                    dosenSelect.classList.add('animate-pulse');
                    setTimeout(() => {
                        dosenSelect.classList.remove('animate-pulse');
                    }, 1000);

                    showNotification('error', 'Silakan pilih dosen pembimbing terlebih dahulu');
                    return;
                }

                // Disable button to prevent double submission
                confirmTerima.disabled = true;
                confirmTerima.innerHTML = `
                    <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses...
                `;

                // Make AJAX call
                fetch(`/admin/kelola-magang/{{ $magang->id_magang }}/terima`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            id_dosen_pembimbing: selectedDosenId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update status display
                            statusText.textContent = 'Diterima';
                            statusText.className =
                                'inline-flex items-center h-[28px] gap-x-1.5 py-1 px-2 rounded-md text-xs font-medium border border-green-500 text-green-500';

                            // Close modal
                            const modal = document.getElementById('hs-terima-modal');
                            if (modal) {
                                modal.classList.add('hidden');
                                modal.classList.remove('pointer-events-auto');
                                document.body.classList.remove('overflow-hidden');
                            }

                            // Hide action buttons
                            const actionButtons = document.querySelector('.flex.gap-2');
                            if (actionButtons) {
                                actionButtons.style.display = 'none';
                            }

                            // Show success message
                            showNotification('success', data.message);

                            // Reload page after delay to show updated data
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);

                        } else {
                            // Handle validation errors
                            if (data.errors && data.errors.id_dosen_pembimbing) {
                                dosenSelect.classList.remove('border-gray-300');
                                dosenSelect.classList.add('border-red-300');
                                dosenError.innerHTML = `
                                <x-lucide-alert-circle class="inline w-3 h-3 mr-1" />
                                ${data.errors.id_dosen_pembimbing[0]}
                            `;
                                dosenError.classList.remove('hidden');
                            }

                            showNotification('error', data.message ||
                                'Terjadi kesalahan saat memproses pengajuan');

                            // Re-enable button
                            confirmTerima.disabled = false;
                            confirmTerima.innerHTML = `
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Ya, Terima
                        `;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('error', 'Terjadi kesalahan saat memproses pengajuan');

                        // Re-enable button
                        confirmTerima.disabled = false;
                        confirmTerima.innerHTML = `
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Ya, Terima
                    `;
                    });
            });

            // Handle modal confirm tolak button
            confirmTolak?.addEventListener('click', function() {
                const alasanPenolakan = alasanTextarea.value.trim();

                // Disable button to prevent double submission
                confirmTolak.disabled = true;
                confirmTolak.innerHTML = `
                    <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses...
                `;

                // Make AJAX call for rejection
                fetch(`/admin/kelola-magang/{{ $magang->id_magang }}/tolak`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            alasan_penolakan: alasanPenolakan
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            statusText.textContent = 'Ditolak';
                            statusText.className =
                                'inline-flex items-center h-[28px] gap-x-1.5 py-1 px-2 rounded-md text-xs font-medium border border-red-500 text-red-500';

                            // Close modal
                            const modal = document.getElementById('hs-tolak-modal');
                            if (modal) {
                                modal.classList.add('hidden');
                                modal.classList.remove('pointer-events-auto');
                                document.body.classList.remove('overflow-hidden');
                            }

                            // Hide action buttons
                            const actionButtons = document.querySelector('.flex.gap-2');
                            if (actionButtons) {
                                actionButtons.style.display = 'none';
                            }

                            showNotification('success', data.message);

                            // Reload page after delay
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        } else {
                            showNotification('error', data.message ||
                                'Terjadi kesalahan saat menolak pengajuan');

                            // Re-enable button
                            confirmTolak.disabled = false;
                            confirmTolak.innerHTML = `
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 6 6 18M6 6l12 12" clip-rule="evenodd"></path>
                            </svg>
                            Ya, Tolak
                        `;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('error', 'Terjadi kesalahan saat menolak pengajuan');

                        // Re-enable button
                        confirmTolak.disabled = false;
                        confirmTolak.innerHTML = `
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 6 6 18M6 6l12 12" clip-rule="evenodd"></path>
                        </svg>
                        Ya, Tolak
                    `;
                    });
            });

            btnDetail?.addEventListener('click', function() {
                window.location.href = '/admin/lowongan/{{ $magang->lowongan->id_lowongan }}';
            });

            // Notification function
            function showNotification(type, message) {
                const bgColor = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' :
                    'bg-red-100 border-red-400 text-red-700';
                const iconPath = type === 'success' ?
                    'M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z' :
                    'M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z';

                const notification = document.createElement('div');
                notification.className =
                    `fixed top-4 right-4 ${bgColor} px-4 py-3 rounded-lg shadow-lg z-50 max-w-sm`;
                notification.innerHTML = `
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="${iconPath}" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm">${message}</span>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-lg leading-none">&times;</button>
                    </div>
                `;

                document.body.appendChild(notification);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 5000);
            }
        });
    </script>

    {{-- Modal Pilih Log --}}
    <div id="exportLogModal" class="fixed inset-0 z-80 bg-black/50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-full max-w-lg">
            <h3 class="text-lg font-semibold mb-4">Pilih Log Aktivitas yang Akan Diexport</h3>
            <form id="exportLogForm" method="GET" action="{{ route('dosen.detail_mahasiswa.export_log', $magang->id_magang) }}" target="_blank">
                <div class="max-h-64 overflow-y-auto mb-4 border rounded p-2">
                    @foreach($logAktivitas as $log)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" name="log_ids[]" value="{{ $log->id_log_aktivitas }}" id="log-{{ $log->id_log_aktivitas }}" checked class="mr-2">
                            <label for="log-{{ $log->id_log_aktivitas }}">
                                {{ \Carbon\Carbon::parse($log->tanggal)->locale('id')->translatedFormat('l, d F Y') }} - {{ $log->kegiatan ? Str::limit($log->kegiatan, 40) : 'Tidak ada deskripsi' }}
                            </div>
                    @endforeach
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeExportModal()" class="btn-secondary">Batal</button>
                    <button type="submit" class="btn-primary bg-blue-500 hover:bg-blue-600">Export PDF</button>
                </div>
            </form>
        </div>
    </div>
    <script>
    function openExportModal() {
        document.getElementById('exportLogModal').classList.remove('hidden');
    }
    function closeExportModal() {
        document.getElementById('exportLogModal').classList.add('hidden');
    }
    </script>
@endsection
