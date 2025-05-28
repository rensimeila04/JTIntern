@extends('layout.template')
@section('content')
    <div class="p-6 space-y-6 bg-white rounded-lg">
        <h1 class="text-xl font-medium text-neutral-900">Tambah Lowongan</h1>
        <form action="{{ route('admin.lowongan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Perusahaan</label>
                        <select name="id_perusahaan_mitra" required
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="" disabled selected>Pilih perusahaan</option>
                            @foreach($perusahaan as $p)
                                <option value="{{ $p->id_perusahaan_mitra }}">{{ $p->nama_perusahaan_mitra }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Periode Magang</label>
                        <select name="id_periode_magang" required
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="" disabled selected>Pilih periode magang</option>
                            @foreach($periode as $pr)
                                <option value="{{ $pr->id_periode_magang }}">{{ $pr->nama_periode }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Judul Lowongan</label>
                        <input type="text" name="judul_lowongan" required
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            placeholder="ex: Frontend Developer">
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Deskripsi</label>
                        <textarea name="deskripsi" required
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            rows="3" placeholder="Tambahkan deskripsi lowongan..."></textarea>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Persyaratan</label>
                        <textarea name="persyaratan" required
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            rows="3" placeholder="Tambahkan persyaratan..."></textarea>
                    </div>
                </div>
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Kompetensi</label>
                        <select name="id_kompetensi" required
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="" disabled selected>Pilih kompetensi</option>
                            @foreach($kompetensi as $k)
                                <option value="{{ $k->id_kompetensi }}">{{ $k->nama_kompetensi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Jenis Magang</label>
                        <select name="jenis_magang" required
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="" disabled selected>Pilih jenis magang</option>
                            <option value="wfo">WFO</option>
                            <option value="remote">Remote</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                    </div>
                    <div class="w-full relative">
                        <label class="block text-sm font-medium mb-2">Deadline Pendaftaran</label>
                        <input
                            class="hs-datepicker py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none"
                            type="text" placeholder="Pilih deadline" readonly="" data-hs-datepicker='{
                                "selectedDates": ["2025-01-10 2025-01-15"],
                                "selectionDatesMode": "multiple-ranged",
                                "dateMax": "2050-12-31",
                                "mode": "custom-select",
                                "inputModeOptions": {
                                "itemsSeparator": " / "
                                },
                                "templates": {
                                "arrowPrev": "<button data-vc-arrow=\"prev\"><svg class=\"shrink-0 size-4\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m15 18-6-6 6-6\"></path></svg></button>",
                                "arrowNext": "<button data-vc-arrow=\"next\"><svg class=\"shrink-0 size-4\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m9 18 6-6-6-6\"></path></svg></button>"
                                }
                            }'>
                        <span class="absolute top-1/2 right-4 -translate-y-1/2 text-gray-400 pointer-events-none">
                            <i class="ph ph-calendar-days text-xl"></i>
                        </span>
                    </div>
                    <div class="flex flex-row gap-4 items-center">
                        <label class="block text-sm font-medium mb-2">Tes seleksi diperlukan</label>
                        <label for="test" class="relative inline-block w-11 h-6 cursor-pointer">
                            <input type="checkbox" id="test" name="test" value="1" class="peer sr-only">
                            <span
                                class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-primary-500"></span>
                            <span
                                class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full transition-transform duration-200 ease-in-out peer-checked:translate-x-full"></span>
                        </label>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Informasi Test</label>
                        <textarea name="informasi_test"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            rows="3" placeholder="Tambahkan informasi test..."></textarea>
                    </div>
                </div>
            </div>
            <div class="flex justify-end w-full">
                <button type="submit" class="btn-primary">
                    Tambahkan Lowongan
                </button>
            </div>
        </form>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault();
            const form = e.target;
            const data = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: data
            })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        alert('Lowongan berhasil ditambahkan!');
                        window.location.href = "{{ route('admin.lowongan') }}";
                    } else {
                        alert('Gagal menambah lowongan');
                    }
                });
        });
    </script>
@endsection