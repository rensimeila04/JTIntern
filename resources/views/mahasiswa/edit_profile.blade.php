@extends('layout.template')
@section('content')
    <div class="bg-white w-full flex flex-col p-4 space-y-6 rounded-2xl">
        <h2 class="font-medium text-xl">Edit Profil Pengguna</h2>
        <div class="border border-neutral-200 rounded-lg px-4 py-6 w-full space-y-6">
            <h3 class="font-medium text-xl">Data Pribadi</h3>
            <div class="flex items-start gap-10">
                <div class="flex flex-col gap-4 w-fit items-center">
                    <img class="size-32 rounded-full"
                        src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/avatar.svg') }}"
                        alt="User profile">
                    <a href="#"
                        class="btn-outline w-fit text-primary-500 border-primary-500 hover:bg-primary-500 hover:text-white flex items-center gap-2 whitespace-nowrap px-3 py-2">
                        <x-lucide-pencil-line stroke-width="1.5" class="size-3.5" />
                        Ganti Foto Profil
                    </a>
                </div>
                <div class="flex flex-col gap-4  w-full">
                    <div>
                        <label for="nama_lengkap" class="text-sm font-semibold">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ Auth::user()->name }}"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    <div>
                        <label for="nim" class="text-sm font-semibold">NIM</label>
                        <input type="text" id="nim" name="nim" value="{{ Auth::user()->mahasiswa->nim ?? '' }}"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    <div>
                        <label for="program_studi" class="text-sm font-semibold">Program Studi</label>
                        <select id="program_studi" name="program_studi"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="">Pilih Program Studi</option>
                            @foreach ($programStudi as $prodi)
                                <option value="{{ $prodi->id_program_studi }}"
                                    {{ (Auth::user()->mahasiswa->id_program_studi ?? '') == $prodi->id_program_studi ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <span class="flex justify-end mt-6">
                <button type="button" id="submitBtn" class="btn-primary">
                    Perbarui Data Pribadi
                </button>
            </span>
        </div>
        <hr class="border-neutral-200">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3=2 gap-4 w-full">
            <div class="border border-neutral-200 rounded-lg px-4 py-6 w-full max-h-max">
                <h3 class="mb-6 font-medium text-xl">Preferensi Magang</h3>
                <div class="flex flex-col gap-4">
                    <div>
                        <label for="jenis_magang" class="text-sm font-semibold">Jenis Magang</label>
                        <select id="jenis_magang" name="jenis_magang"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="">Pilih Jenis Magang</option>
                            <option value="wfo"
                                {{ (Auth::user()->mahasiswa->jenis_magang ?? '') == 'wfo' ? 'selected' : '' }}>Work From
                                Office (WFO)</option>
                            <option value="remote"
                                {{ (Auth::user()->mahasiswa->jenis_magang ?? '') == 'remote' ? 'selected' : '' }}>Remote
                            </option>
                            <option value="hybrid"
                                {{ (Auth::user()->mahasiswa->jenis_magang ?? '') == 'hybrid' ? 'selected' : '' }}>Hybrid
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="kompetensi" class="text-sm font-semibold">Kompetensi</label>
                        <select id="kompetensi" name="kompetensi"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="">Pilih Kompetensi</option>
                            @foreach ($kompetensi as $komp)
                                <option value="{{ $komp->id_kompetensi }}"
                                    {{ (Auth::user()->mahasiswa->id_kompetensi ?? '') == $komp->id_kompetensi ? 'selected' : '' }}>
                                    {{ $komp->nama_kompetensi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="jenis_perusahaan" class="text-sm font-semibold">Jenis Perusahaan</label>
                        <select id="jenis_perusahaan" name="jenis_perusahaan"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="">Pilih Jenis Perusahaan</option>
                            @foreach ($jenisPerusahaan as $jenis)
                                <option value="{{ $jenis->id_jenis_perusahaan }}"
                                    {{ (Auth::user()->mahasiswa->id_jenis_perusahaan ?? '') == $jenis->id_jenis_perusahaan ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="preferensi_lokasi" class="text-sm font-semibold">Preferensi Lokasi</label>
                        <input type="text" id="preferensi_lokasi" name="preferensi_lokasi"
                            value="{{ Auth::user()->mahasiswa->preferensi_lokasi ?? '' }}"
                            placeholder="Masukkan kota atau wilayah yang diinginkan"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                </div>
                <span class="flex justify-end mt-6">
                    <button type="button" id="submitBtn" class="btn-primary">
                        Perbarui Preferensi
                    </button>
                </span>
            </div>
            <div class="border border-neutral-200 rounded-lg px-4 py-6 w-full max-h-max">
                <h3 class="mb-6 font-medium text-xl">Akun pengguna</h3>
                <div class="flex flex-col gap-4">
                    <div>
                        <label for="email" class="text-sm font-semibold">Email</label>
                        <input type="email" id="email" name="email" value="{{ Auth::user()->email }}"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    <div>
                        <label for="password" class="text-sm font-semibold">Kata Sandi</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi baru"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    <div>
                        <label for="password_confirmation" class="text-sm font-semibold">Konfirmasi Kata Sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Konfirmasi kata sandi"
                            class="py-2.5 sm:py-3 px-4 mt-2.5 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                </div>
                <span class="flex justify-end mt-6">
                    <button type="button" id="submitBtn" class="btn-primary">
                        Perbarui Akun
                    </button>
                </span>
            </div>
        </div>
        <hr class="border-neutral-200">
        <div class="w-full px-4 py-6 rounded-lg border border-neutral-200 flex flex-col gap-6">
            <div class="flex justify-between items-center w-full">
                <div class="text-neutral-900 text-xl font-semibold">Dokumen Pendukung</div>
            </div>
            <div class="flex gap-6 w-full">
                {{-- CV --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 w-full">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <x-lucide-file class="w-4 h-4 text-primary-600" />
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Curriculum Vitae</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs ">
                        @php $cv = $dokumen['curriculum vitae'] ?? null; @endphp
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">
                                {{ $cv ? $cv->created_at->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">
                                {{ $cv && $cv->path_dokumen ? number_format(Storage::size($cv->path_dokumen) / 1024, 0) . ' KB' : '-' }}
                            </span>
                        </div>
                    </div>
                    @if ($cv)
                        <div class="flex justify-start ">
                            <a href="{{ asset('storage/' . $cv->path_dokumen) }}" target="_blank"
                                class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-eye class="w-4 h-4 mr-2" />
                                Lihat Dokumen
                            </a>
                        </div>
                        <div class="flex justify-start">
                            <button type="button"
                                class="inline-flex justify-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition w-full">
                                Perbarui Dokumen
                            </button>
                        </div>
                    @else
                        <div class="flex items-center">
                            <button type="button"
                                class="btn-primary justify-center inline-flex items-center py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-upload class="w-4 h-4 mr-2" />
                                Unggah
                            </button>
                        </div>
                    @endif
                </div>

                {{-- Portofolio --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 w-full">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <x-lucide-image class="w-4 h-4 text-primary-600" />
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Portofolio</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs ">
                        @php $portofolio = $dokumen['portofolio'] ?? null; @endphp
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">
                                {{ $portofolio ? $portofolio->created_at->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">
                                {{ $portofolio && $portofolio->path_dokumen ? number_format(Storage::size($portofolio->path_dokumen) / 1024, 0) . ' KB' : '-' }}
                            </span>
                        </div>
                    </div>
                    @if ($portofolio)
                        <div class="flex justify-start ">
                            <a href="{{ asset('storage/' . $portofolio->path_dokumen) }}" target="_blank"
                                class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-eye class="w-4 h-4 mr-2" />
                                Lihat Dokumen
                            </a>
                        </div>
                        <div class="flex justify-start">
                            <button type="button"
                                class="inline-flex justify-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition w-full">
                                Perbarui Dokumen
                            </button>
                        </div>
                    @else
                        <div class="flex items-center">
                            <button type="button"
                                class="btn-primary justify-center inline-flex items-center py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-upload class="w-4 h-4 mr-2" />
                                Unggah
                            </button>
                        </div>
                    @endif
                </div>

                {{-- Sertifikat --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 w-full">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="ph ph-medal w-4 h-4 text-primary-600"></i>
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Sertifikat</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs ">
                        @php $sertifikat = $dokumen['sertifikat'] ?? null; @endphp
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">
                                {{ $sertifikat ? $sertifikat->created_at->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">
                                {{ $sertifikat && $sertifikat->path_dokumen ? number_format(Storage::size($sertifikat->path_dokumen) / 1024, 0) . ' KB' : '-' }}
                            </span>
                        </div>
                    </div>
                    @if ($sertifikat)
                        <div class="flex justify-start ">
                            <a href="{{ asset('storage/' . $sertifikat->path_dokumen) }}" target="_blank"
                                class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-eye class="w-4 h-4 mr-2" />
                                Lihat Dokumen
                            </a>
                        </div>
                        <div class="flex justify-start">
                            <button type="button"
                                class="inline-flex justify-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition w-full">
                                Perbarui Dokumen
                            </button>
                        </div>
                    @else
                        <div class="flex items-center">
                            <button type="button"
                                class="btn-primary justify-center inline-flex items-center py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-upload class="w-4 h-4 mr-2" />
                                Unggah
                            </button>
                        </div>
                    @endif
                </div>

                {{-- Surat Pengantar --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 w-full">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="ph ph-envelope-simple w-4 h-4 text-primary-600"></i>
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Surat Pengantar</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs ">
                        @php $suratPengantar = $dokumen['surat pengantar'] ?? null; @endphp
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">
                                {{ $suratPengantar ? $suratPengantar->created_at->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">
                                {{ $suratPengantar && $suratPengantar->path_dokumen ? number_format(Storage::size($suratPengantar->path_dokumen) / 1024, 0) . ' KB' : '-' }}
                            </span>
                        </div>
                    </div>
                    @if ($suratPengantar)
                        <div class="flex justify-start ">
                            <a href="{{ asset('storage/' . $suratPengantar->path_dokumen) }}" target="_blank"
                                class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-eye class="w-4 h-4 mr-2" />
                                Lihat Dokumen
                            </a>
                        </div>
                        <div class="flex justify-start">
                            <button type="button"
                                class="inline-flex justify-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition w-full">
                                Perbarui Dokumen
                            </button>
                        </div>
                    @else
                        <div class="flex items-center">
                            <button type="button"
                                class="btn-primary justify-center inline-flex items-center py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-upload class="w-4 h-4 mr-2" />
                                Unggah
                            </button>
                        </div>
                    @endif
                </div>

                {{-- Transkip Nilai --}}
                <div class="flex flex-col gap-4 rounded-xl bg-neutral-50 p-4 w-full">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="ph ph-chart-line w-4 h-4 text-primary-600"></i>
                        </div>
                        <div class="text-neutral-900 text-base font-medium">Transkip Nilai</div>
                    </div>
                    <div class="flex flex-col gap-1 text-xs ">
                        @php $transkip = $dokumen['transkip nilai'] ?? null; @endphp
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Diunggah:</span>
                            <span class="text-neutral-500">
                                {{ $transkip ? $transkip->created_at->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span class="text-neutral-900 font-medium">Ukuran:</span>
                            <span class="text-neutral-500">
                                {{ $transkip && $transkip->path_dokumen ? number_format(Storage::size($transkip->path_dokumen) / 1024, 0) . ' KB' : '-' }}
                            </span>
                        </div>
                    </div>
                    @if ($transkip)
                        <div class="flex justify-start ">
                            <a href="{{ asset('storage/' . $transkip->path_dokumen) }}" target="_blank"
                                class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-eye class="w-4 h-4 mr-2" />
                                Lihat Dokumen
                            </a>
                        </div>
                        <div class="flex justify-start">
                            <button type="button"
                                class="inline-flex justify-center px-4 py-2 border border-primary-600 rounded-lg text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-600 text-sm font-medium transition w-full">
                                Perbarui Dokumen
                            </button>
                        </div>
                    @else
                        <div class="flex items-center">
                            <button type="button"
                                class="btn-primary justify-center inline-flex items-center py-2 rounded-lg text-sm font-medium transition w-full">
                                <x-lucide-upload class="w-4 h-4 mr-2" />
                                Unggah
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
