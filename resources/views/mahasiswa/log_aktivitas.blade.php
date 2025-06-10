@extends('layout.template')
@section('content')
    @php
        use Carbon\Carbon;
        \Carbon\Carbon::setLocale('id');
    @endphp
    <div class="bg-white py-6 px-4 rounded-lg">
        <div class="flex flex-row justify-between mb-4">
            <span class="font-medium text-xl">
                <h2>Log Aktivitas</h2>
            </span>
            <button type="button"
                onclick="openModal()"
                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700">
                <i class="ph ph-plus"></i>
                Tambah Log Aktivitas
            </button>
        </div>
        <div class="hs-dropdown relative inline-flex">
            <button id="hs-dropdown-default" type="button"
                class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <x-lucide-calendar-days class="size-3.5 text-neutral-500" />
                <x-lucide-chevron-down class="size-5 text-neutral-500" />
            </button>
        </div>
        <div class="flex flex-col mt-4 mb-6">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <table class="min-w-full divide-y-2 divide-gray-200">
                            <thead class="bg-gray-50 divide-y-2">
                                <tr>
                                    <th scope="col" class="px-5 py-3 text-start text-xs font-medium text-gray-500 w-fit">
                                        Hari, Tanggal
                                    </th>
                                    <th scope="col" class="px-5 py-3 text-start text-xs font-medium text-gray-500 w-48">
                                        Waktu
                                    </th>
                                    <th scope="col" class="px-5 py-3 text-start text-xs font-medium text-gray-500 w-auto">
                                        Kegiatan
                                    </th>
                                    <th scope="col" class="px-5 py-3 text-start text-xs font-medium text-gray-500 w-44">
                                        Status Feedback
                                    </th>
                                    <th scope="col" class="px-5 py-3 text-start text-xs font-medium text-gray-500 w-48">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($logAktivitas as $log)
                                    <tr>
                                        <td class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ \Carbon\Carbon::parse($log->tanggal)->translatedFormat('l, d F Y') }}
                                        </td>
                                        <td class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800">
                                            <!-- Tampilkan waktu_awal dan waktu_akhir dari database -->
                                            @if($log->jam_masuk && $log->jam_pulang)
                                                {{ \Carbon\Carbon::parse($log->jam_masuk)->format('H.i') }} - {{ \Carbon\Carbon::parse($log->jam_pulang)->format('H.i') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $log->kegiatan }}
                                        </td>
                                        <td class="px-5 py-1.5 whitespace-nowrap text-sm text-gray-800">
                                            @if($log->feedback)
                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">
                                                    Dinilai
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-400 text-gray-400">
                                                    Belum Dinilai
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-end max-w-43 w-fit ">
                                            <div class="flex justify-start gap-2.5">
                                                <a href="#"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <button type="button"
                                                    onclick="openEditModal({{ $log->id }}, '{{ $log->tanggal }}', '{{ $log->waktu_awal }}', '{{ $log->waktu_akhir }}', `{{ $log->deskripsi }}`)"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </button>
                                                <a href="#"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data log aktivitas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if ($logAktivitas->hasPages())
            <div class="flex items-center justify-end mt-8">
                {{ $logAktivitas->links('custom.pagination') }}
            </div>
        @endif
    </div>

    @include('mahasiswa.tambah_log_aktivitas')
    
@endsection

<script>
function openModal() {
    document.getElementById('modalTambahLog').classList.remove('hidden');
}
function closeModal() {
    document.getElementById('modalTambahLog').classList.add('hidden');
    document.getElementById('formTambahLog').reset();
    document.getElementById('formError').classList.add('hidden');
}

// AJAX submit
document.getElementById('formTambahLog').addEventListener('submit', function(e) {
    e.preventDefault();
    let form = this;
    let data = new FormData(form);
    let errorDiv = document.getElementById('formError');
    errorDiv.classList.add('hidden');
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: data
    })
    .then(res => res.json())
    .then(res => {
        if(res.success) {
            closeModal();
            location.reload(); // Atau update tabel via JS tanpa reload
        } else {
            errorDiv.textContent = res.message || 'Terjadi kesalahan.';
            errorDiv.classList.remove('hidden');
        }
    })
    .catch(err => {
        errorDiv.textContent = 'Terjadi kesalahan.';
        errorDiv.classList.remove('hidden');
    });
});

function openEditModal(id, tanggal, waktuAwal, waktuAkhir, deskripsi) {
    document.getElementById('modalEditLog').classList.remove('hidden');
    document.getElementById('editId').value = id;
    document.getElementById('editTanggal').value = tanggal;
    document.getElementById('editWaktuAwal').value = waktuAwal;
    document.getElementById('editWaktuAkhir').value = waktuAkhir;
    document.getElementById('editDeskripsi').value = deskripsi;
}
function closeEditModal() {
    document.getElementById('modalEditLog').classList.add('hidden');
    document.getElementById('formEditLog').reset();
    document.getElementById('editFormError').classList.add('hidden');
}

// AJAX submit edit
document.getElementById('formEditLog').addEventListener('submit', function(e) {
    e.preventDefault();
    let form = this;
    let id = document.getElementById('editId').value;
    let data = new FormData(form);
    let errorDiv = document.getElementById('editFormError');
    errorDiv.classList.add('hidden');
    fetch('/mahasiswa/log_aktivitas/' + id, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'X-HTTP-Method-Override': 'PUT'
        },
        body: data
    })
    .then(res => res.json())
    .then(res => {
        if(res.success) {
            closeEditModal();
            location.reload();
        } else {
            errorDiv.textContent = res.message || 'Terjadi kesalahan.';
            errorDiv.classList.remove('hidden');
        }
    })
    .catch(err => {
        errorDiv.textContent = 'Terjadi kesalahan.';
        errorDiv.classList.remove('hidden');
    });
});
</script>