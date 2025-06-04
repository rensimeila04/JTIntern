@extends('layout.template')

@section('content')
    <div class="w-full p-4 bg-white rounded-xl flex-col space-y-4">
        <!-- Header dan tombol aksi -->
        <div class="flex justify-between items-center w-full">
            <div class="text-neutral-900 text-xl font-medium">Permohonan Magang</div>
            <div class="flex gap-2">
                <a href="#" class="btn-primary bg-blue-500 hover:bg-blue-600">
                    <i class="ph ph-export text-lg"></i> Export Data
                </a>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="flex justify-end items-center w-full gap-4">
            <!-- Search -->
            <div class="w-1/3">
                <form action="{{ route('admin.kelola-magang.permohonan_magang') }}" method="GET">
                    <input type="hidden" name="lowongan_id" value="{{ $currentLowongan }}">
                    <x-search-input placeholder="Cari data magang..." name="search" value="{{ $currentSearch }}" />
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col" class="w-4 px-6 py-6 text-start text-xs font-medium text-gray-500">ID
                                    </th>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">Nama Mahasiswa
                                    </th>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">Judul Lowongan
                                    </th>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">Nama
                                        Perusahaan</th>
                                    <th scope="col" class="w-4 px-5 py-3 text-start text-xs font-medium text-gray-500">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse($permohonan as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $item->id_magang }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $item->mahasiswa->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $item->lowongan->judul_lowongan }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $item->lowongan->perusahaanMitra->nama_perusahaan_mitra }}
                                        </td>
                                        <td class="px-5 py-4 whitespace-nowrap text-sm font-medium text-end">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.kelola-magang.detail', $item->id_magang) }}"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <button type="button"
                                                    onclick="confirmDeleteMagang('{{ $item->id_magang }}', '{{ $item->mahasiswa->user->name }}')"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Tidak ada data permohonan magang
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-end mt-8">
            {{ $permohonan->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDeleteMagang(id, name) {
                if (confirm('Apakah Anda yakin ingin menghapus data permohonan magang dari ' + name + '?')) {}
            }
        </script>
    @endpush
@endsection
