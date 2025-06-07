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
                            </div>
                            @if ($magang->status_magang == 'menunggu')
                                <div class="flex gap-2">
                                    <button type="button" id="btn-terima"
                                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700 focus:outline-hidden focus:bg-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                        Terima
                                    </button>
                                    <button type="button" id="btn-tolak"
                                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:bg-red-400 hover:text-white focus:outline-hidden focus:border-red-400 focus:text-red-400 disabled:opacity-50 disabled:pointer-events-none">
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
@endsection
