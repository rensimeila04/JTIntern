@extends('layout.template')
@section('content')
    <div class="flex flex-col space-y-5">
        <h2 class="text-xl font-medium">Detail Aktivitas</h2>
        <div class="bg-white p-6 rounded-lg">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6 md:gap-9">
                <div
                    class="w-28 h-28 rounded-2xl overflow-hidden flex-shrink-0 bg-neutral-100 flex items-center justify-center">
                    @if(isset($user->profile_photo) && $user->profile_photo)
                        <img class="w-28 h-28 object-cover" src="{{ asset('storage/' . $user->profile_photo) }}"
                            alt="Foto Mahasiswa" />
                    @else
                        <img class="w-28 h-28 object-cover" src="{{ asset('Images/avatar.svg') }}" alt="Default Avatar" />
                    @endif
                </div>
                <div class="flex flex-col gap-6">
                    <div class="text-neutral-900 text-lg font-medium">{{ $user->name }}</div>
                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-9">
                        <div class="flex flex-col gap-1">
                            <div class="text-neutral-400 text-sm">NIM</div>
                            <div class="text-neutral-700 text-sm font-semibold">{{ $mahasiswa->nim ?? 'Tidak tersedia' }}
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <div class="text-neutral-400 text-sm">Email</div>
                            <div class="text-neutral-700 text-sm font-semibold">{{ $user->email }}</div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <div class="text-neutral-400 text-sm">Program Studi</div>
                            <div class="text-neutral-700 text-sm font-semibold">
                                {{ $mahasiswa->programStudi->nama_prodi ?? 'Tidak tersedia' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg">
            <div class="flex items-center gap-3">
                <div>
                    <p class="font-medium text-xl ">Detail Magang</p>
                </div>
                <div class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border 
                            @if($magang->status_magang == 'diterima')
                                border-teal-500 bg-white text-teal-500
                            @elseif($magang->status_magang == 'magang')
                                border-blue-500 bg-white text-blue-500
                            @elseif($magang->status_magang == 'selesai')
                                border-gray-500 bg-white text-gray-500
                            @endif">
                    @if($magang->status_magang == 'diterima')
                        Diterima
                    @elseif($magang->status_magang == 'magang')
                        Sedang Magang
                    @elseif($magang->status_magang == 'selesai')
                        Selesai
                    @endif
                </div>
            </div>
            <div class="flex justify-start items-center w-full bg-white p-4 rounded-md">
                <div class="flex items-center">
                    <img src="{{ $lowongan->perusahaanMitra->logo ? Storage::url($lowongan->perusahaanMitra->logo) : asset('Images/placeholder_perusahaan.png') }}"
                        alt="{{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}"
                        class="w-30 h-30 rounded-2xl object-contai">
                    <div class="flex flex-col pl-6 gap-y-4">
                        <div class="space-y-2">
                            <div class="flex gap-4 items-center">
                                <p class="font-semibold">{{ $lowongan->judul_lowongan }}</p>
                            </div>
                            <a href="{{ route('admin.perusahaan.detail', $lowongan->perusahaanMitra->id_perusahaan_mitra) }}"
                                class="text-primary-500 text-base font-normal hover:text-primary-700 hover:underline transition-colors duration-200 w-fit block">
                                {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                            </a>
                        </div>
                        <div class="flex flex-row gap-10 items-start">
                            <div class="flex flex-col gap-2">
                                <span class="flex items-center gap-2 text-sm text-neutral-700">
                                    <x-lucide-map-pin class="text-neutral-500 size-6" stroke-width="1.5" />
                                    <p>{{ $lowongan->perusahaanMitra->alamat }}</p>
                                </span>
                                <span class="flex items-center gap-2 text-sm text-neutral-700">
                                    <x-lucide-calendar-days class="text-neutral-500 size-6" stroke-width="1.5" />
                                    <p>{{ $lowongan->periodeMagang->nama_periode }}</p>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg">
            <div class="flex flex-col gap-3">
                <div>
                    <p class="font-medium text-xl ">Detail Aktivitas</p>
                </div>
                <div class="flex flex-row gap-4">
                    <span class="flex flex-col gap-2 text-base font-medium text-neutral-400">
                        <p>Hari, Tanggal</p>
                        <p>Waktu</p>
                        <p>Kegiatan</p>
                    </span>
                    <span class="flex flex-col gap-2 text-base font-medium">
                        <p>
                            {{ \Carbon\Carbon::parse($logAktivitas->tanggal)->isoFormat('dddd, D MMMM Y') }}
                        </p>
                        <p>
                            {{ \Carbon\Carbon::parse($logAktivitas->jam_masuk)->format('H.i') }} -
                            {{ \Carbon\Carbon::parse($logAktivitas->jam_pulang)->format('H.i') }}
                        </p>
                        <p>
                            {{ $logAktivitas->kegiatan }}
                        </p>
                    </span>
                </div>
                <form method="POST" action="{{ route('dosen.monitoring.feedback', ['id_magang' => $magang->id_magang, 'id_log_aktivitas' => $logAktivitas->id_log_aktivitas]) }}">
                    @csrf
                    <div class="flex flex-col gap-2.5">
                        <div class="flex justify-between">
                            <label for="komentar" class="text-sm font-semibold w-full">Feedback</label>
                            <span id="counter" class="text-sm text-gray-500">0/100</span>
                        </div>
                        <div>
                            <textarea
                                class="rounded-lg border border-gray-200 w-full h-24 text-gray-500 font-default p-3 resize-y"
                                placeholder="Tambahkan feedback..." name="komentar" id="komentar" maxlength="100"
                                required>{{ old('komentar', $logAktivitas->feedback_dospem) }}</textarea>
                        </div>
                    </div>
                    <span class="flex justify-end">
                        <button type="submit" id="submitBtn" class="btn-primary">
                            Unggah Feedback
                        </button>
                    </span>
                </form>
            </div>
        </div>
        @if(session('success'))
            <!-- Modal Success -->
            <div id="successModal" class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm">
                <div class="bg-white rounded-lg shadow-lg w-auto p-6 max-w-xs text-center">
                    <div class="p-4 overflow-y-auto">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-green-600" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="mt-2 text-sm text-gray-600">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                    <button onclick="closeModal()"
                        class="mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Tutup</button>
                </div>
            </div>
            <script>
                function closeModal() {
                    document.getElementById('successModal').style.display = 'none';
                }
            </script>
        @endif
    </div>
@endsection