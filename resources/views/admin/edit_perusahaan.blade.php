@extends('layout.template')

@section('content')
    <div class="p-6 space-y-6 bg-white rounded-lg">
        <h1 class="text-xl font-medium text-neutral-900">Edit Perusahaan</h1>
        <form id="editCompanyForm" action="{{ route('admin.perusahaan.update', $perusahaan->id_perusahaan_mitra) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label for="jenis_perusahaan_id" class="block text-sm font-medium mb-2 dark:text-white">Jenis
                            Perusahaan</label>
                        <select id="jenis_perusahaan_id" name="jenis_perusahaan_id"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Pilih jenis perusahaan">
                            <option value="" disabled>Pilih jenis perusahaan</option>
                            @foreach ($jenisPerusahaan as $jenis)
                                <option value="{{ $jenis->id_jenis_perusahaan }}" 
                                    {{ $perusahaan->id_jenis_perusahaan == $jenis->id_jenis_perusahaan ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="nama_perusahaan" class="block text-sm font-medium mb-2 dark:text-white">Nama
                            Perusahaan</label>
                        <input type="text" id="nama_perusahaan" name="nama_perusahaan"
                            value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan_mitra) }}"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Masukkan nama perusahaan" aria-describedby="hs-input-helper-text">
                    </div>
                    <div class="w-full">
                        <label for="bidang_industri" class="block text-sm font-medium mb-2 dark:text-white">Bidang
                            Industri</label>
                        <input type="text" id="bidang_industri" name="bidang_industri"
                            value="{{ old('bidang_industri', $perusahaan->bidang_industri) }}"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Masukkan bidang industri" aria-describedby="hs-input-helper-text">
                    </div>
                    <div class="w-full">
                        <label for="tentang_perusahaan" class="block text-sm font-medium mb-2 dark:text-white">Tentang
                            Perusahaan</label>
                        <textarea id="tentang_perusahaan" name="tentang_perusahaan"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            rows="3" placeholder="Masukkan deskripsi tentang perusahaan">{{ old('tentang_perusahaan', $perusahaan->tentang) }}</textarea>
                    </div>
                </div>
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label for="alamat_perusahaan" class="block text-sm font-medium mb-2 dark:text-white">Alamat
                            Perusahaan</label>
                        <div class="location-input-container relative">
                            <input type="text" id="alamat_perusahaan" name="alamat_perusahaan"
                                value="{{ old('alamat_perusahaan', $perusahaan->alamat) }}"
                                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Ketik alamat perusahaan..."
                                autocomplete="off">
                            <div id="address-suggestions" class="absolute top-full left-0 right-0 bg-white border border-gray-200 rounded-lg shadow-lg max-h-60 overflow-y-auto z-50 hidden">
                            </div>
                        </div>
                        <input type="hidden" id="alamat_latitude" name="alamat_latitude" value="{{ old('alamat_latitude', $perusahaan->latitude) }}">
                        <input type="hidden" id="alamat_longitude" name="alamat_longitude" value="{{ old('alamat_longitude', $perusahaan->longitude) }}">
                    </div>
                    <div class="w-full">
                        <label for="email_perusahaan" class="block text-sm font-medium mb-2 dark:text-white">E-mail
                            Perusahaan</label>
                        <input type="email" id="email_perusahaan" name="email_perusahaan"
                            value="{{ old('email_perusahaan', $perusahaan->email) }}"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Masukkan e-mail perusahaan">
                    </div>
                    <div class="w-full">
                        <label for="nomor_telepon" class="block text-sm font-medium mb-2 dark:text-white">Nomor
                            Telepon</label>
                        <input type="text" id="nomor_telepon" name="nomor_telepon"
                            value="{{ old('nomor_telepon', $perusahaan->telepon) }}"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Masukkan nomor telepon perusahaan">
                    </div>
                    <div class="w-full">
                        <label for="logo_perusahaan" class="block text-sm font-medium mb-2 dark:text-white">Logo
                            Perusahaan</label>
                        
                        @if($perusahaan->logo)
                            <div class="mb-3">
                                <img src="{{ $perusahaan->logo ? asset('storage/' . $perusahaan->logo) : asset('Images/placeholder_perusahaan.png') }}" 
                                     alt="Logo Perusahaan" class="w-20 h-20 rounded-lg object-cover border border-gray-200">
                                <p class="text-xs text-gray-500 mt-1">Logo saat ini</p>
                            </div>
                        @endif
                        
                        <input type="file" id="logo_perusahaan" name="logo_perusahaan"
                            class="block w-full border border-gray-200 rounded-lg text-sm focus:z-10 focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                    file:bg-gray-50 file:border-0
                    file:me-4
                    file:py-3 file:px-4
                    dark:file:bg-neutral-700 dark:file:text-neutral-400"
                            accept="image/*">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah logo</p>
                    </div>
                </div>
            </div>

            <!-- Fasilitas Perusahaan Section -->
            <div class="w-full">
                <label class="block text-sm font-medium mb-4 dark:text-white">Fasilitas Perusahaan</label>
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach ($fasilitas as $item)
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       id="fasilitas_{{ $item->id_fasilitas }}" 
                                       name="fasilitas[]" 
                                       value="{{ $item->id_fasilitas }}"
                                       {{ in_array($item->id_fasilitas, $selectedFasilitas) ? 'checked' : '' }}
                                       class="shrink-0 mt-0.5 border-gray-200 rounded text-primary-600 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-primary-500 dark:checked:border-primary-500 dark:focus:ring-offset-gray-800">
                                <label for="fasilitas_{{ $item->id_fasilitas }}" 
                                       class="text-sm text-gray-700 ms-3 dark:text-neutral-400">
                                    {{ $item->nama_fasilitas }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Select All / Deselect All buttons -->
                    <div class="mt-4 pt-3 border-t border-gray-200">
                        <div class="flex gap-2">
                            <button type="button" 
                                    id="selectAllFasilitas"
                                    class="btn-primary">
                                Pilih Semua
                            </button>
                            <button type="button" 
                                    id="deselectAllFasilitas"
                                    class="btn-secondary">
                                Hapus Semua
                            </button>
                        </div>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-1">Pilih fasilitas yang tersedia di perusahaan ini</p>
            </div>

            <div class="flex justify-end gap-3 w-full">
                <a href="{{ route('admin.perusahaan') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="button" id="submitEditBtn" class="btn-primary">
                    Perbarui Perusahaan
                </button>
            </div>
        </form>
    </div>

    <!-- Edit Confirmation Modal -->
    <div id="editConfirmModal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="editConfirmModal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="editConfirmModal-label" class="font-bold text-gray-800 dark:text-white">
                        Konfirmasi Edit Perusahaan
                    </h3>
                    <button type="button" id="closeEditConfirmModalBtn" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-edit class="w-8 h-8 text-amber-600" />
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Konfirmasi Perubahan Data</h4>
                        <div class="text-left space-y-2 bg-gray-50 p-4 rounded-lg">
                            <div>
                                <span class="text-sm font-medium text-gray-600">Nama Perusahaan:</span>
                                <span id="editConfirmNama" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Jenis Perusahaan:</span>
                                <span id="editConfirmJenis" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Bidang Industri:</span>
                                <span id="editConfirmBidang" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Email:</span>
                                <span id="editConfirmEmail" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Telepon:</span>
                                <span id="editConfirmTelepon" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Alamat:</span>
                                <span id="editConfirmAlamat" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Fasilitas:</span>
                                <span id="editConfirmFasilitas" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div id="editConfirmLogoSection" class="hidden">
                                <span class="text-sm font-medium text-gray-600">Logo:</span>
                                <span class="text-sm text-gray-900 ml-2">Logo baru akan diupload</span>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-gray-600">
                            Apakah Anda yakin ingin menyimpan perubahan data perusahaan ini?
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="cancelEditConfirm" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800">
                        Batal
                    </button>
                    <button type="button" id="confirmEditSubmit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-amber-600 text-white hover:bg-amber-700 focus:outline-hidden focus:bg-amber-700 disabled:opacity-50 disabled:pointer-events-none">
                        <span id="editConfirmButtonText">Ya, Perbarui</span>
                        <div id="editConfirmSpinner" class="hidden animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading">
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Success Modal -->
    <div id="editSuccessModal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="editSuccessModal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="editSuccessModal-label" class="font-bold text-gray-800 dark:text-white">
                        Berhasil Diperbarui!
                    </h3>
                    <button type="button" id="closeEditSuccessModalBtn" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-check-circle class="w-8 h-8 text-green-600" />
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Data Perusahaan Berhasil Diperbarui</h4>
                        <p class="text-sm text-gray-600 mb-4">
                            Perubahan data perusahaan <span id="editSuccessCompanyName" class="font-semibold text-gray-900"></span> telah berhasil disimpan.
                        </p>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                            <div class="flex items-center">
                                <x-lucide-info class="w-4 h-4 text-green-600 mr-2" />
                                <p class="text-xs text-green-800">
                                    Semua perubahan telah diterapkan dan tersimpan dalam sistem.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="backToCompanyListBtn" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800">
                        <x-lucide-list class="w-4 h-4" />
                        Kembali ke Daftar
                    </button>
                    <button type="button" id="editAnotherBtn" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        <x-lucide-edit class="w-4 h-4" />
                        Edit Lagi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let debounceTimer;
        let editConfirmModal = null;
        let editSuccessModal = null;

        // Fungsi untuk mencari alamat menggunakan Nominatim API
        async function searchAddress(query) {
            if (query.length < 3) {
                hideSuggestions();
                return;
            }
            
            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&countrycodes=id&limit=5&addressdetails=1&accept-language=id`;
            
            try {
                const response = await fetch(url, {
                    headers: {
                        'Accept-Language': 'id-ID,id;q=0.9,en;q=0.8'
                    }
                });
                const data = await response.json();
                
                showSuggestions(data);
            } catch (error) {
                console.error("Error fetching address data:", error);
                hideSuggestions();
            }
        }

        // Menampilkan suggestions
        function showSuggestions(suggestions) {
            const suggestionsDiv = document.getElementById('address-suggestions');
            suggestionsDiv.innerHTML = '';
            
            if (suggestions.length > 0) {
                suggestions.forEach(place => {
                    const item = document.createElement('div');
                    item.className = 'px-4 py-3 cursor-pointer hover:bg-gray-50 border-b border-gray-100 last:border-b-0';
                    
                    // Format display name yang lebih bersih dan dalam bahasa Indonesia
                    const displayName = place.display_name;
                    
                    // Mapping tipe dalam bahasa Indonesia
                    const typeMapping = {
                        'administrative': 'Wilayah Administratif',
                        'city': 'Kota',
                        'town': 'Kota',
                        'village': 'Desa',
                        'hamlet': 'Dusun',
                        'suburb': 'Kelurahan',
                        'neighbourhood': 'Lingkungan',
                        'road': 'Jalan',
                        'house': 'Rumah',
                        'building': 'Bangunan',
                        'commercial': 'Komersial',
                        'industrial': 'Industri',
                        'residential': 'Perumahan'
                    };
                    
                    const typeInIndonesian = typeMapping[place.type] || place.class || 'Lokasi';
                    
                    item.innerHTML = `
                        <div class="text-sm font-medium text-gray-900">${displayName}</div>
                        <div class="text-xs text-gray-500">${typeInIndonesian}</div>
                    `;
                    
                    item.onclick = function() {
                        document.getElementById('alamat_perusahaan').value = displayName;
                        document.getElementById('alamat_latitude').value = place.lat;
                        document.getElementById('alamat_longitude').value = place.lon;
                        hideSuggestions();
                    };
                    
                    suggestionsDiv.appendChild(item);
                });
                
                suggestionsDiv.classList.remove('hidden');
            } else {
                // Tampilkan pesan tidak ada hasil
                const noResult = document.createElement('div');
                noResult.className = 'px-4 py-3 text-sm text-gray-500';
                noResult.textContent = 'Tidak ada alamat yang ditemukan';
                suggestionsDiv.appendChild(noResult);
                suggestionsDiv.classList.remove('hidden');
            }
        }

        // Menyembunyikan suggestions
        function hideSuggestions() {
            document.getElementById('address-suggestions').classList.add('hidden');
        }

        // Validasi form
        function validateForm() {
            const requiredFields = [
                { id: 'nama_perusahaan', name: 'Nama Perusahaan' },
                { id: 'jenis_perusahaan_id', name: 'Jenis Perusahaan' },
                { id: 'bidang_industri', name: 'Bidang Industri' },
                { id: 'email_perusahaan', name: 'Email Perusahaan' },
                { id: 'nomor_telepon', name: 'Nomor Telepon' },
                { id: 'alamat_perusahaan', name: 'Alamat Perusahaan' }
            ];

            for (const field of requiredFields) {
                const element = document.getElementById(field.id);
                if (!element.value.trim()) {
                    alert(`${field.name} harus diisi!`);
                    element.focus();
                    return false;
                }
            }

            // Validasi email
            const email = document.getElementById('email_perusahaan').value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Format email tidak valid!');
                document.getElementById('email_perusahaan').focus();
                return false;
            }

            return true;
        }

        // Menampilkan modal konfirmasi edit
        function showEditConfirmModal() {
            // Isi data konfirmasi
            const namaPerusahaan = document.getElementById('nama_perusahaan').value;
            const jenisSelect = document.getElementById('jenis_perusahaan_id');
            const jenisPerusahaan = jenisSelect.options[jenisSelect.selectedIndex].text;
            const bidangIndustri = document.getElementById('bidang_industri').value;
            const email = document.getElementById('email_perusahaan').value;
            const telepon = document.getElementById('nomor_telepon').value;
            const alamat = document.getElementById('alamat_perusahaan').value;
            
            // Dapatkan fasilitas yang dipilih
            const selectedFasilitas = [];
            document.querySelectorAll('input[name="fasilitas[]"]:checked').forEach(checkbox => {
                const label = document.querySelector(`label[for="${checkbox.id}"]`);
                selectedFasilitas.push(label.textContent.trim());
            });

            // Check if new logo is uploaded
            const logoFile = document.getElementById('logo_perusahaan').files[0];
            const logoSection = document.getElementById('editConfirmLogoSection');
            
            if (logoFile) {
                logoSection.classList.remove('hidden');
            } else {
                logoSection.classList.add('hidden');
            }

            document.getElementById('editConfirmNama').textContent = namaPerusahaan;
            document.getElementById('editConfirmJenis').textContent = jenisPerusahaan;
            document.getElementById('editConfirmBidang').textContent = bidangIndustri;
            document.getElementById('editConfirmEmail').textContent = email;
            document.getElementById('editConfirmTelepon').textContent = telepon;
            document.getElementById('editConfirmAlamat').textContent = alamat;
            document.getElementById('editConfirmFasilitas').textContent = selectedFasilitas.length > 0 ? selectedFasilitas.join(', ') : 'Tidak ada fasilitas dipilih';

            editConfirmModal = new HSOverlay(document.getElementById('editConfirmModal'));
            editConfirmModal.open();
        }

        // Menutup modal konfirmasi edit
        function closeEditConfirmModal() {
            if (editConfirmModal) {
                editConfirmModal.close();
                editConfirmModal = null;
            }
        }

        // Show edit success modal
        function showEditSuccessModal(companyName) {
            console.log('Showing edit success modal for:', companyName);
            document.getElementById('editSuccessCompanyName').textContent = companyName;
            
            // Initialize and show the modal
            if (window.HSOverlay) {
                editSuccessModal = new HSOverlay(document.getElementById('editSuccessModal'));
                editSuccessModal.open();
            } else {
                // Fallback if HSOverlay is not available
                document.getElementById('editSuccessModal').classList.remove('hidden');
                document.getElementById('editSuccessModal').classList.add('hs-overlay-open');
            }
        }

        // Close edit success modal
        function closeEditSuccessModal() {
            if (editSuccessModal) {
                editSuccessModal.close();
                editSuccessModal = null;
            } else {
                // Fallback
                document.getElementById('editSuccessModal').classList.add('hidden');
                document.getElementById('editSuccessModal').classList.remove('hs-overlay-open');
            }
        }

        // Event listener untuk input alamat
        document.getElementById('alamat_perusahaan').addEventListener('input', function(e) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                searchAddress(e.target.value);
            }, 500);
        });

        // Menyembunyikan suggestions ketika klik di luar
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.location-input-container')) {
                hideSuggestions();
            }
        });

        // Mencegah submit form saat menekan Enter di input alamat
        document.getElementById('alamat_perusahaan').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });

        // Tunggu DOM selesai dimuat sebelum menambahkan event listener
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded for edit page');
            
            // Check if there's a success message in the session
            @if(session('success'))
                console.log('Edit success session found');
                const companyName = '{{ $perusahaan->nama_perusahaan_mitra }}';
                console.log('Company name:', companyName);
                
                // Delay showing modal to ensure everything is loaded
                setTimeout(function() {
                    showEditSuccessModal(companyName);
                }, 500);
            @endif

            @if(session('error'))
                alert('{{ session('error') }}');
            @endif

            // Fasilitas checkbox functionality - Select All
            const selectAllButton = document.getElementById('selectAllFasilitas');
            const deselectAllButton = document.getElementById('deselectAllFasilitas');
            
            if (selectAllButton) {
                selectAllButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const checkboxes = document.querySelectorAll('input[name="fasilitas[]"]');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = true;
                    });
                });
            }

            // Fasilitas checkbox functionality - Deselect All
            if (deselectAllButton) {
                deselectAllButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const checkboxes = document.querySelectorAll('input[name="fasilitas[]"]');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                });
            }

            // Submit button event listener
            document.getElementById('submitEditBtn').addEventListener('click', function(e) {
                e.preventDefault();
                
                if (validateForm()) {
                    showEditConfirmModal();
                }
            });

            // Edit confirmation modal event listeners
            document.getElementById('closeEditConfirmModalBtn').addEventListener('click', closeEditConfirmModal);
            document.getElementById('cancelEditConfirm').addEventListener('click', closeEditConfirmModal);

            // Confirm edit submit
            document.getElementById('confirmEditSubmit').addEventListener('click', function() {
                const confirmBtn = this;
                const confirmText = document.getElementById('editConfirmButtonText');
                const confirmSpinner = document.getElementById('editConfirmSpinner');

                // Show loading state
                confirmBtn.disabled = true;
                confirmText.textContent = 'Menyimpan...';
                confirmSpinner.classList.remove('hidden');

                // Submit the form
                document.getElementById('editCompanyForm').submit();
            });

            // Edit success modal event listeners
            document.getElementById('closeEditSuccessModalBtn').addEventListener('click', closeEditSuccessModal);
            
            document.getElementById('backToCompanyListBtn').addEventListener('click', function() {
                window.location.href = '{{ route("admin.perusahaan") }}';
            });
            
            document.getElementById('editAnotherBtn').addEventListener('click', function() {
                closeEditSuccessModal();
                // Scroll to top to see the form
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Close modal when clicking outside
            document.getElementById('editConfirmModal').addEventListener('click', function(e) {
                const modalContent = this.querySelector('.bg-white');
                if (!modalContent.contains(e.target)) {
                    closeEditConfirmModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (editConfirmModal) {
                        closeEditConfirmModal();
                    } else if (editSuccessModal) {
                        closeEditSuccessModal();
                    }
                }
            });
        });
    </script>
@endsection