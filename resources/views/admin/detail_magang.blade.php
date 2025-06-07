@extends('layout.template')
@section('content')
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <p class="text-xl font-medium text-neutral-900">Detail Magang</p>
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
                        $document = $magang->mahasiswa->dokumen->where('jenisDokumen.nama', $docType)->first();
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

        @if ($magang->path_file_test)
            <div class="bg-white h-fit p-6 rounded-lg space-y-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-100 rounded-full flex items-center justify-center">
                        <x-lucide-file-text class="w-6 h-6 text-blue-600" />
                    </div>
                    <div>
                        <p class="text-xl font-medium text-neutral-900">Hasil Test</p>
                        <p class="text-sm text-neutral-500">Hasil test yang telah dikerjakan mahasiswa</p>
                    </div>
                </div>

                <div class="bg-neutral-50 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-white rounded-lg">
                                <x-lucide-file class="w-5 h-5 text-neutral-600" />
                            </div>
                            <div>
                                <p class="text-sm font-medium text-neutral-900">
                                    {{ basename($magang->path_file_test) }}
                                </p>
                                <div class="flex items-center gap-4 text-xs text-neutral-500 mt-1">
                                    <span>Diunggah: {{ $magang->updated_at->format('d M Y H:i') }}</span>
                                    @if (file_exists(storage_path('app/public/' . $magang->path_file_test)))
                                        <span>Ukuran:
                                            {{ round(filesize(storage_path('app/public/' . $magang->path_file_test)) / 1024, 1) }}
                                            KB</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ asset('storage/' . $magang->path_file_test) }}" target="_blank"
                                class="inline-flex items-center px-3 py-2 border border-blue-500 rounded-lg text-blue-500 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm font-medium transition">
                                <x-lucide-eye class="w-4 h-4 mr-2" />
                                Lihat File
                            </a>
                            <a href="{{ asset('storage/' . $magang->path_file_test) }}" download
                                class="inline-flex items-center px-3 py-2 border border-primary-500 rounded-lg text-primary-500 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm font-medium transition">
                                <x-lucide-download class="w-4 h-4 mr-2" />
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($magang->status_magang == 'selesai' && $magang->path_sertifikat)
            <div class="bg-white h-fit p-6 rounded-lg space-y-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-green-100 rounded-full flex items-center justify-center">
                        <x-lucide-award class="w-6 h-6 text-green-600" />
                    </div>
                    <div>
                        <p class="text-xl font-medium text-neutral-900">Sertifikat Magang</p>
                        <p class="text-sm text-neutral-500">Sertifikat penyelesaian magang mahasiswa</p>
                    </div>
                </div>

                <div class="bg-neutral-50 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-white rounded-lg">
                                <x-lucide-file-check class="w-5 h-5 text-green-600" />
                            </div>
                            <div>
                                <p class="text-sm font-medium text-neutral-900">
                                    {{ basename($magang->path_sertifikat) }}
                                </p>
                                <div class="flex items-center gap-4 text-xs text-neutral-500 mt-1">
                                    <span>Diterbitkan: {{ $magang->updated_at->format('d M Y H:i') }}</span>
                                    @if (file_exists(storage_path('app/public/' . $magang->path_sertifikat)))
                                        <span>Ukuran:
                                            {{ round(filesize(storage_path('app/public/' . $magang->path_sertifikat)) / 1024, 1) }}
                                            KB</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ asset('storage/' . $magang->path_sertifikat) }}" target="_blank"
                                class="inline-flex items-center px-3 py-2 border border-blue-500 rounded-lg text-blue-500 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm font-medium transition">
                                <x-lucide-eye class="w-4 h-4 mr-2" />
                                Lihat Sertifikat
                            </a>
                            <a href="{{ asset('storage/' . $magang->path_sertifikat) }}" download
                                class="inline-flex items-center px-3 py-2 border border-primary-500 rounded-lg text-primary-500 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm font-medium transition">
                                <x-lucide-download class="w-4 h-4 mr-2" />
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($magang->status_magang == 'selesai' && !$magang->path_sertifikat)
            <div class="bg-white h-fit p-6 rounded-lg space-y-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gray-100 rounded-full flex items-center justify-center">
                        <x-lucide-award class="w-6 h-6 text-gray-600" />
                    </div>
                    <div>
                        <p class="text-xl font-medium text-neutral-900">Sertifikat Magang</p>
                        <p class="text-sm text-neutral-500">Sertifikat belum tersedia</p>
                    </div>
                </div>

                <div class="bg-neutral-50 rounded-lg p-4">
                    <div class="flex items-center justify-center py-8">
                        <div class="text-center">
                            <x-lucide-file-x class="w-12 h-12 text-gray-400 mx-auto mb-3" />
                            <p class="text-sm font-medium text-gray-600">Sertifikat Belum Diterbitkan</p>
                            <p class="text-xs text-gray-500 mt-1">Sertifikat akan tersedia setelah diterbitkan oleh admin
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($magang->status_magang == 'selesai')
            @php
                $feedback = $magang->feedback->first();
            @endphp

            @if ($feedback)
                <div class="bg-white h-fit p-6 rounded-lg space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-purple-100 rounded-full flex items-center justify-center">
                            <x-lucide-message-square-text class="w-6 h-6 text-purple-600" />
                        </div>
                        <div>
                            <p class="text-xl font-medium text-neutral-900">Feedback Mahasiswa</p>
                            <p class="text-sm text-neutral-500">Feedback dan penilaian dari mahasiswa</p>
                        </div>
                    </div>

                    <div class="bg-neutral-50 rounded-lg p-6 space-y-4">
                        {{-- Rating Section --}}
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-neutral-900 mb-2">Rating Keseluruhan</h4>
                                <div class="flex items-center gap-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $feedback->rating)
                                            <x-lucide-star class="w-5 h-5 text-yellow-400 fill-current" />
                                        @else
                                            <x-lucide-star class="w-5 h-5 text-gray-300" />
                                        @endif
                                    @endfor
                                    <span class="text-sm text-neutral-600 ml-2">{{ $feedback->rating }}/5</span>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="text-xs text-neutral-500">Diberikan pada</p>
                                <p class="text-sm font-medium text-neutral-700">
                                    {{ $feedback->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        {{-- Recommendations Section --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-white rounded-lg p-4">
                                <h5 class="text-sm font-medium text-neutral-900 mb-2">Kepuasan Rekomendasi</h5>
                                <div class="flex items-center gap-2">
                                    @if ($feedback->kepuasan_rekomendasi == 'Sangat Puas')
                                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                        <span class="text-sm text-green-600 font-medium">Sangat Puas</span>
                                    @elseif($feedback->kepuasan_rekomendasi == 'Puas')
                                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                        <span class="text-sm text-blue-600 font-medium">Puas</span>
                                    @elseif($feedback->kepuasan_rekomendasi == 'Netral')
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                        <span class="text-sm text-yellow-600 font-medium">Netral</span>
                                    @elseif($feedback->kepuasan_rekomendasi == 'Tidak Puas')
                                        <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                                        <span class="text-sm text-orange-600 font-medium">Tidak Puas</span>
                                    @else
                                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                        <span class="text-sm text-red-600 font-medium">Sangat Tidak Puas</span>
                                    @endif
                                </div>
                            </div>

                            <div class="bg-white rounded-lg p-4">
                                <h5 class="text-sm font-medium text-neutral-900 mb-2">Kesesuaian Rekomendasi</h5>
                                <div class="flex items-center gap-2">
                                    @if ($feedback->kesesuaian_rekomendasi == 'Sangat Sesuai')
                                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                        <span class="text-sm text-green-600 font-medium">Sangat Sesuai</span>
                                    @elseif($feedback->kesesuaian_rekomendasi == 'Sesuai')
                                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                        <span class="text-sm text-blue-600 font-medium">Sesuai</span>
                                    @elseif($feedback->kesesuaian_rekomendasi == 'Cukup Sesuai')
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                        <span class="text-sm text-yellow-600 font-medium">Cukup Sesuai</span>
                                    @elseif($feedback->kesesuaian_rekomendasi == 'Kurang Sesuai')
                                        <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                                        <span class="text-sm text-orange-600 font-medium">Kurang Sesuai</span>
                                    @else
                                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                        <span class="text-sm text-red-600 font-medium">Tidak Sesuai</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Comment Section --}}
                        @if ($feedback->komentar)
                            <div class="bg-white rounded-lg p-4">
                                <h5 class="text-sm font-medium text-neutral-900 mb-3">Komentar</h5>
                                <div class="relative">
                                    <x-lucide-quote class="absolute top-0 left-0 w-4 h-4 text-neutral-400" />
                                    <p class="text-sm text-neutral-700 leading-relaxed pl-6 italic">
                                        {{ $feedback->komentar }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="bg-white h-fit p-6 rounded-lg space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-gray-100 rounded-full flex items-center justify-center">
                            <x-lucide-message-square-text class="w-6 h-6 text-gray-600" />
                        </div>
                        <div>
                            <p class="text-xl font-medium text-neutral-900">Feedback Mahasiswa</p>
                            <p class="text-sm text-neutral-500">Feedback belum tersedia</p>
                        </div>
                    </div>

                    <div class="bg-neutral-50 rounded-lg p-4">
                        <div class="flex items-center justify-center py-8">
                            <div class="text-center">
                                <x-lucide-message-square-x class="w-12 h-12 text-gray-400 mx-auto mb-3" />
                                <p class="text-sm font-medium text-gray-600">Feedback Belum Diberikan</p>
                                <p class="text-xs text-gray-500 mt-1">Mahasiswa belum memberikan feedback untuk magang ini
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        {{-- Pengajuan Magang --}}
        <div class="h-fit rounded-lg space-y-3">
            <div class="space-y-4">
                <div class="bg-white h-fit w-full py-4 px-6 rounded-lg flex flex-col gap-6">
                    <div class="flex align-middle items-center gap-4">
                        <p class="text-xl font-medium text-neutral-900">Pengajuan Magang</p>
                        <div id="status-badge">
                            <span id="status-text"
                                class="inline-flex items-center h-[28px] gap-x-1.5 py-1 px-2 rounded-md text-xs font-medium 
                                @if ($magang->status_magang == 'menunggu') border border-yellow-500 text-yellow-500
                                @elseif($magang->status_magang == 'diterima') border border-green-500 text-green-500
                                @elseif($magang->status_magang == 'ditolak') border border-red-500 text-red-500
                                @elseif($magang->status_magang == 'magang') border border-blue-500 text-blue-500
                                @elseif($magang->status_magang == 'selesai') border border-gray-500 text-gray-500 @endif">
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
                            @if ($magang->status_magang == 'menunggu')
                                <div class="flex gap-2">
                                    <button type="button" id="btn-terima"
                                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700 focus:outline-hidden focus:bg-primary-500 disabled:opacity-50 disabled:pointer-events-none"
                                        aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-terima-modal" data-hs-overlay="#hs-terima-modal">
                                        Terima
                                    </button>
                                    <button type="button" id="btn-tolak"
                                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:bg-red-400 hover:text-white focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none"
                                        aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-tolak-modal" data-hs-overlay="#hs-tolak-modal">
                                        Tolak
                                    </button>
                                    <button type="button" id="btn-detail-lowongan"
                                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:bg-blue-400 hover:text-white focus:outline-hidden focus:border-blue-500 focus:text-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                        Detail Lowongan
                                    </button>
                                </div>
                            @endif
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
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tolak -->
    <div id="hs-tolak-modal" class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-80 opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-tolak-modal-label">
        <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xl rounded-xl pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 id="hs-tolak-modal-label" class="font-bold text-gray-800">
                        Konfirmasi Penolakan Magang
                    </h3>
                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-tolak-modal">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                    Apakah Anda yakin ingin menolak pengajuan magang dari <strong>{{ $magang->mahasiswa->user->name }}</strong> 
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
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-tolak-modal">
                        Batal
                    </button>
                    <button type="button" id="confirm-tolak" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        <x-lucide-x class="w-4 h-4" />
                        Ya, Tolak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Terima -->
    <div id="hs-terima-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-terima-modal-label">
        <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xl rounded-xl pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 id="hs-terima-modal-label" class="font-bold text-gray-800">
                        Konfirmasi Penerimaan Magang
                    </h3>
                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-terima-modal">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                    Apakah Anda yakin ingin menerima pengajuan magang dari <strong>{{ $magang->mahasiswa->user->name }}</strong> 
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
                                @foreach($dosenPembimbing as $dosen)
                                    <option value="{{ $dosen->id_dosen_pembimbing }}"
                                        {{ ($magang->id_dosen_pembimbing == $dosen->id_dosen_pembimbing) ? 'selected' : '' }}>
                                        {{ $dosen->user->name }} - {{ $dosen->nip }}
                                        @if($dosen->bidang_minat)
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
                                Pilih dosen pembimbing untuk mahasiswa ini <span class="text-red-500 font-medium">(wajib)</span>
                            </p>
                        </div>
                        
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                            <div class="flex items-start gap-2">
                                <x-lucide-info class="w-4 h-4 text-blue-600 mt-0.5 flex-shrink-0" />
                                <div class="text-sm text-blue-800">
                                    <p class="font-medium">Setelah menerima pengajuan:</p>
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
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-terima-modal">
                        Batal
                    </button>
                    <button type="button" id="confirm-terima" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
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
                        statusText.className = 'inline-flex items-center h-[28px] gap-x-1.5 py-1 px-2 rounded-md text-xs font-medium border border-green-500 text-green-500';
                        
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
                        
                        showNotification('error', data.message || 'Terjadi kesalahan saat memproses pengajuan');
                        
                        // Re-enable button
                        confirmTerima.disabled = false;
                        confirmTerima.innerHTML = `
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
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
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
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
                        statusText.className = 'inline-flex items-center h-[28px] gap-x-1.5 py-1 px-2 rounded-md text-xs font-medium border border-red-500 text-red-500';
                        
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
                        showNotification('error', data.message || 'Terjadi kesalahan saat menolak pengajuan');
                        
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
                const bgColor = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';
                const iconPath = type === 'success' 
                    ? 'M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z'
                    : 'M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z';

                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 ${bgColor} px-4 py-3 rounded-lg shadow-lg z-50 max-w-sm`;
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
@endsection
