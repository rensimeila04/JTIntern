@extends('layout.template')
@section('content')
    <div class="flex flex-col space-y-5">
        <h2 class="text-xl font-medium">Detail Aktivitas</h2>
        <div class="bg-white p-6 rounded-lg">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6 md:gap-9">
                <div
                    class="w-28 h-28 rounded-2xl overflow-hidden flex-shrink-0 bg-neutral-100 flex items-center justify-center">
                    @if (isset($user->profile_photo) && $user->profile_photo)
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
                <div
                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border 
                            @if ($magang->status_magang == 'diterima') border-teal-500 bg-white text-teal-500
                            @elseif($magang->status_magang == 'magang')
                                border-blue-500 bg-white text-blue-500
                            @elseif($magang->status_magang == 'selesai')
                                border-gray-500 bg-white text-gray-500 @endif">
                    @if ($magang->status_magang == 'diterima')
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
        <div class="bg-white p-6 rounded-xl">
            <div class="flex flex-col gap-5">
                <div class="flex items-center gap-2 mb-2">
                    <x-lucide-clipboard-list class="text-primary-500 size-6" />
                    <p class="font-semibold text-2xl text-primary-700">Detail Aktivitas</p>
                </div>
                <div class="flex flex-row gap-8">
                    <span class="flex flex-col gap-4 text-base font-medium text-neutral-400 min-w-[120px]">
                        <span class="flex items-center gap-2">
                            <x-lucide-calendar-days class="size-5" />
                            Hari, Tanggal
                        </span>
                        <span class="flex items-center gap-2">
                            <x-lucide-clock class="size-5" />
                            Waktu
                        </span>
                        <span class="flex items-center gap-2">
                            <x-lucide-activity class="size-5" />
                            Kegiatan
                        </span>
                        @if ($logAktivitas->feedback_dospem)
                            <span class="flex items-center gap-2">
                                <x-lucide-message-circle class="size-5" />
                                Feedback
                            </span>
                        @endif
                    </span>
                    <span class="flex flex-col gap-4 text-base font-semibold text-neutral-700">
                        <span>
                            {{ \Carbon\Carbon::parse($logAktivitas->tanggal)->isoFormat('dddd, D MMMM Y') }}
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($logAktivitas->jam_masuk)->format('H.i') }} -
                            {{ \Carbon\Carbon::parse($logAktivitas->jam_pulang)->format('H.i') }}
                        </span>
                        <span>
                            {{ $logAktivitas->kegiatan }}
                        </span>
                        @if ($logAktivitas->feedback_dospem)
                            <span>
                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    <x-lucide-check-circle class="size-4" />
                                    Sudah Diberi Feedback
                                </span>
                                <div class="mt-2 text-sm text-gray-700 italic border-l-4 border-green-300 pl-3">
                                    {{ $logAktivitas->feedback_dospem }}
                                </div>
                            </span>
                        @endif
                    </span>
                </div>
                <div class="border-t border-gray-200 my-4"></div>
                <form method="POST"
                    action="{{ route('dosen.monitoring.feedback', ['id_magang' => $magang->id_magang, 'id_log_aktivitas' => $logAktivitas->id_log_aktivitas]) }}">
                    @csrf
                    <div class="flex flex-col gap-2.5">
                        <div class="flex justify-between items-center">
                            <label for="komentar" class="text-base font-semibold text-primary-700">
                                {{ $logAktivitas->feedback_dospem ? 'Update Feedback' : 'Feedback' }}
                            </label>
                            <span class="text-xs text-gray-400">{{ strlen(old('komentar', $logAktivitas->feedback_dospem)) }}/100
                            </span>
                        </div>
                        <div>
                            <textarea
                                class="rounded-lg border border-gray-200 w-full h-28 text-gray-700 font-default p-3 resize-y focus:ring-2 focus:ring-primary-300 focus:border-primary-400 transition"
                                placeholder="Tambahkan feedback..." name="komentar" id="komentar" maxlength="100" required>{{ old('komentar', $logAktivitas->feedback_dospem) }}</textarea>
                        </div>
                    </div>
                    <span class="flex justify-end mt-3">
                        <button type="submit" id="submitBtn"
                            class="btn-primary transition hover:scale-105 hover:bg-primary-600 focus:ring-2 focus:ring-primary-300">
                            <x-lucide-send class="inline size-5 mr-1" /> Unggah Feedback
                        </button>
                    </span>
                </form>
            </div>
        </div>
        @if (session('success'))
            <!-- Modal Success -->
            <div id="successModal"
                class="fixed inset-0 z-[80] flex items-center justify-center bg-black/20 h-full">
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-sm w-full max-w-xs sm:max-w-lg mx-3 sm:mx-auto pointer-events-auto transition-all">
                    <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                        <h3 class="font-bold text-gray-800">
                            Berhasil!
                        </h3>
                        <button type="button" id="closeSuccessModalBtn"
                            class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200"
                            aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 overflow-y-auto">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Feedback Berhasil Dikirim</h4>
                            <p class="text-sm text-gray-600 mb-4">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                        <button type="button" id="closeSuccessModalBtn2"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
            <script>
                function closeSuccessModal() {
                    document.getElementById('successModal').style.display = 'none';
                }
                document.getElementById('closeSuccessModalBtn').onclick = closeSuccessModal;
                document.getElementById('closeSuccessModalBtn2').onclick = closeSuccessModal;
            </script>
        @endif
    </div>
@endsection
