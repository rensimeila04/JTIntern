<div class="space-y-6">
    {{-- MABAC Info Section --}}
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="ph ph-medal text-blue-600 text-xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-900">Rekomendasi MABAC</h3>
                <p class="text-sm text-blue-700">Lowongan diurutkan berdasarkan kesesuaian dengan profil Anda</p>
            </div>
        </div>

        @if ($mabacRecommendations->isEmpty())
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-yellow-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-yellow-800 text-sm">
                        Lengkapi profil Anda untuk mendapatkan rekomendasi yang akurat.
                    </p>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                <div class="bg-white rounded-lg p-4 border border-blue-200">
                    <div class="text-2xl font-bold text-blue-600">{{ $mabacRecommendations->count() }}</div>
                    <div class="text-sm text-gray-600">Lowongan Tersedia</div>
                </div>
                <div class="bg-white rounded-lg p-4 border border-blue-200">
                    <div class="text-2xl font-bold text-primary-500">
                        {{ $mabacRecommendations->where('deadline_pendaftaran', '>=', now())->count() }}
                    </div>
                    <div class="text-sm text-gray-600">Masih Terbuka</div>
                </div>
                <div class="bg-white rounded-lg p-4 border border-blue-200">
                    <div class="text-2xl font-bold text-yellow-500">TOP 3</div>
                    <div class="text-sm text-gray-600">Rekomendasi Terbaik</div>
                </div>
            </div>
        @endif

        <div class="mt-4 flex justify-center">
            <a href="{{ route('mahasiswa.mabac.hitung') }}" class="btn-primary">
                Lihat Perhitungan Detail
            </a>
        </div>
    </div>

    {{-- Daftar Lowongan Berdasarkan MABAC --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-4 w-full relative z-10">
        @forelse ($mabacRecommendations as $index => $lowongan)
            @php
                $wibNow = now('Asia/Jakarta');
                $deadline = $lowongan->deadline_pendaftaran
                    ? \Carbon\Carbon::parse($lowongan->deadline_pendaftaran)->setTimezone('Asia/Jakarta')
                    : null;
                $daysLeft = $deadline ? $deadline->diffInDays($wibNow, false) : null;
                $applicantCount = $lowongan->magang()->count();
                $isExpired = $deadline && $deadline->isPast();
                $isTopRecommendation = $index < 3; // Top 3 recommendations
            @endphp
            <div
                class="bg-white flex-col rounded-xl flex py-6 px-4 gap-4 relative z-0 {{ $isExpired ? 'opacity-75' : '' }} {{ $isTopRecommendation ? 'ring-2 ring-primary-200 bg-blue-50' : '' }}">
                {{-- Ranking Badge --}}
                @if ($isTopRecommendation)
                    <div class="absolute -top-2 -right-2 z-10">
                        <div
                            class="bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold shadow-lg">
                            {{ $index + 1 }}
                        </div>
                    </div>
                @endif

                {{-- Recommendation Badge for Top 3 --}}
                @if ($index === 0)
                    <div class="absolute top-4 left-4 z-10">
                        <span
                            class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-yellow-900 px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            TOP CHOICE
                        </span>
                    </div>
                @elseif($isTopRecommendation)
                    <div class="absolute top-4 left-4 z-10">
                        <span class="bg-primary-100 text-primary-600 px-2 py-1 rounded-full text-xs font-semibold">
                            TOP {{ $index + 1 }}
                        </span>
                    </div>
                @endif

                <div class="inline-flex items-center gap-6 {{ $isTopRecommendation ? 'mt-2' : '' }}">
                    <img src="{{ $lowongan->perusahaanMitra->logo ? $lowongan->perusahaanMitra->logo_url : asset('images/placeholder_perusahaan.png') }}"
                        alt="Logo {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}"
                        class="w-20 h-20 rounded-lg object-contain bg-gray-50">
                    <div class="flex flex-col flex-1 justify-start items-start gap-2 h-fill">
                        <div class="self-stretch inline-flex justify-start items-center gap-4">
                            <div class="justify-start text-black text-lg font-medium leading-none">
                                {{ $lowongan->judul_lowongan }}
                            </div>
                        </div>
                        <div class="inline-flex justify-start items-center gap-2">
                            <span
                                class="justify-start text-neutral-400 text-sm font-normal leading-none truncate max-w-[120px]">
                                {{ $lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                            </span>
                            <div class="w-1 h-1 bg-neutral-400 rounded-full flex-shrink-0"></div>
                            <span
                                class="justify-start text-neutral-400 text-sm font-normal leading-none truncate max-w-[150px]">
                                {{ $lowongan->perusahaanMitra->alamat }}
                            </span>
                        </div>
                        <div class="inline-flex justify-start items-start gap-2">
                            <span
                                class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">
                                {{ strtoupper($lowongan->jenis_magang) }}
                            </span>
                            <span
                                class="inline-flex items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-gray-500 ring-1 ring-gray-500/10 ring-inset">
                                {{ $lowongan->perusahaanMitra->jenisPerusahaan->nama_jenis_perusahaan }}
                            </span>
                        </div>
                    </div>
                    <button type="button"
                        class="ml-auto py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent {{ $isTopRecommendation ? 'bg-primary-500 hover:bg-primary-600' : 'bg-primary-500 hover:bg-primary-600' }} text-white focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none {{ $isExpired ? 'bg-gray-400 hover:bg-gray-400 cursor-not-allowed' : '' }}"
                        {{ $isExpired ? 'disabled' : '' }}>
                        {{ $isExpired ? 'Tutup' : 'Ajukan Magang' }}
                    </button>
                </div>
                <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">
                <div class="self-stretch inline-flex justify-start items-center gap-2">
                    @if ($lowongan->deadline_pendaftaran)
                        <span class="justify-start text-neutral-400 text-sm font-normal leading-none">
                            @if ($isExpired)
                                Pendaftaran ditutup
                            @else
                                {{ abs($daysLeft) }} hari tersisa
                            @endif
                        </span>
                        <div class="w-1 h-1 bg-neutral-400 rounded-full"></div>
                    @endif
                    <span class="justify-start text-neutral-400 text-sm font-normal leading-none">
                        {{ $applicantCount }} Pelamar
                    </span>
                    {{-- Match Score Indicator --}}
                    @if ($isTopRecommendation)
                        <div class="w-1 h-1 bg-neutral-400 rounded-full"></div>
                        <span class="text-primary-400 text-sm font-medium">
                            {{ $index === 0 ? '🎯 Perfect Match' : ($index === 1 ? '⭐ Great Match' : '👍 Good Match') }}
                        </span>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
                <div class="text-gray-500 text-lg mb-2">Tidak ada rekomendasi tersedia</div>
                <div class="text-gray-400 text-sm">
                    Silakan lengkapi profil Anda untuk mendapatkan rekomendasi yang sesuai.
                </div>
                <div class="mt-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                        Lengkapi Profil →
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
