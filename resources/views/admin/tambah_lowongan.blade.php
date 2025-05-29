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
                        <select data-hs-select='{
                            "hasSearch": true,
                            "searchPlaceholder": "Cari perusahaan...",
                            "searchClasses": "block w-full sm:text-sm border-gray-200 rounded-lg focus:border-primary-500 focus:ring-primary-500 before:absolute before:inset-0 before:z-1 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-1.5 sm:py-2 px-3",
                            "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
                            "placeholder": "Pilih perusahaan...",
                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"text-gray-800 dark:text-neutral-200\" data-title></span></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 sm:py-3 ps-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-hidden focus:ring-2 focus:ring-primary-500 focus:border-primary-500",
                            "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                            "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                        }' name="id_perusahaan_mitra" required class="hidden">
                            <option value="">Pilih perusahaan</option>
                            @foreach($perusahaan as $p)
                                <option value="{{ $p->id_perusahaan_mitra }}" {{ old('id_perusahaan_mitra') == $p->id_perusahaan_mitra ? 'selected' : '' }}>
                                    {{ $p->nama_perusahaan_mitra }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_perusahaan_mitra')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Periode Magang</label>
                        <select name="id_periode_magang" required
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="" disabled selected>Pilih periode magang</option>
                            @foreach($periode as $pr)
                                <option value="{{ $pr->id_periode_magang }}" {{ old('id_periode_magang') == $pr->id_periode_magang ? 'selected' : '' }}>
                                    {{ $pr->nama_periode }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_periode_magang')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Judul Lowongan</label>
                        <input type="text" name="judul_lowongan" required value="{{ old('judul_lowongan') }}"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            placeholder="ex: Frontend Developer">
                        @error('judul_lowongan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Deskripsi</label>
                        <textarea name="deskripsi" required
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            rows="3" placeholder="Tambahkan deskripsi lowongan...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Persyaratan</label>
                        <textarea name="persyaratan" required
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            rows="3" placeholder="Tambahkan persyaratan...">{{ old('persyaratan') }}</textarea>
                        @error('persyaratan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Kompetensi</label>
                        <select name="id_kompetensi" required
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="" disabled selected>Pilih kompetensi</option>
                            @foreach($kompetensi as $k)
                                <option value="{{ $k->id_kompetensi }}" {{ old('id_kompetensi') == $k->id_kompetensi ? 'selected' : '' }}>
                                    {{ $k->nama_kompetensi }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kompetensi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Jenis Magang</label>
                        <select name="jenis_magang" required
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="" disabled selected>Pilih jenis magang</option>
                            <option value="wfo" {{ old('jenis_magang') == 'wfo' ? 'selected' : '' }}>WFO</option>
                            <option value="remote" {{ old('jenis_magang') == 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="hybrid" {{ old('jenis_magang') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        @error('jenis_magang')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full relative">
                        <label class="block text-sm font-medium mb-2">Deadline Pendaftaran</label>
                        <input
                            id="deadlineInput"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 cursor-pointer"
                            type="text" placeholder="Pilih deadline" readonly>
                        <input type="hidden" name="deadline_pendaftaran" id="deadlineHidden" value="{{ old('deadline_pendaftaran') }}">
                        <span class="absolute top-1/2 right-4 -translate-y-1/2 text-gray-400 pointer-events-none">
                            <i class="ph ph-calendar-days text-xl"></i>
                        </span>
                        @error('deadline_pendaftaran')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        
                        <!-- Custom Date Picker -->
                        <div id="datePicker" class="absolute top-full left-0 mt-2 z-50 hidden">
                            <div class="w-80 flex flex-col bg-white border border-gray-200 shadow-lg rounded-xl overflow-hidden">
                                <!-- Calendar -->
                                <div class="p-3 space-y-0.5">
                                    <!-- Months -->
                                    <div class="grid grid-cols-5 items-center gap-x-3 mx-1.5 pb-3">
                                        <!-- Prev Button -->
                                        <div class="col-span-1">
                                            <button type="button" id="prevMonth" class="size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                                            </button>
                                        </div>
                                        
                                        <!-- Month / Year -->
                                        <div class="col-span-3 flex justify-center items-center gap-x-1">
                                            <span id="currentMonth" class="font-medium text-gray-800 cursor-pointer hover:text-primary-600"></span>
                                            <span class="text-gray-800">/</span>
                                            <span id="currentYear" class="font-medium text-gray-800 cursor-pointer hover:text-primary-600"></span>
                                        </div>
                                        
                                        <!-- Next Button -->
                                        <div class="col-span-1 flex justify-end">
                                            <button type="button" id="nextMonth" class="size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100">
                                                <svg class="shrink-0 size-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Weeks -->
                                    <div class="flex pb-1.5">
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Sen</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Sel</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Rab</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Kam</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Jum</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Sab</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Min</span>
                                    </div>
                                    
                                    <!-- Days Container -->
                                    <div id="daysContainer" class="space-y-0">
                                        <!-- Days will be generated by JavaScript -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row gap-4 items-center">
                        <label class="block text-sm font-medium mb-2">Tes seleksi diperlukan</label>
                        <label for="test" class="relative inline-block w-11 h-6 cursor-pointer">
                            <input type="checkbox" id="test" name="test" value="1" class="peer sr-only" {{ old('test') ? 'checked' : '' }}>
                            <span
                                class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-primary-500"></span>
                            <span
                                class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full transition-transform duration-200 ease-in-out peer-checked:translate-x-full"></span>
                        </label>
                    </div>
                    <div id="informasiTestContainer" class="w-full {{ old('test') ? '' : 'hidden' }}">
                        <label class="block text-sm font-medium mb-2">Informasi Test</label>
                        <textarea name="informasi_test"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            rows="3" placeholder="Tambahkan informasi test...">{{ old('informasi_test') }}</textarea>
                        @error('informasi_test')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
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

    <!-- Success Modal -->
    @if(session('success'))
    <div id="successModal" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="fixed inset-0 bg-black opacity-25"></div>
            <div class="relative bg-white rounded-lg max-w-md mx-auto p-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ph ph-check text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Berhasil!</h3>
                    <p class="text-sm text-gray-500 mb-4">{{ session('success') }}</p>
                    <div class="flex gap-2 justify-center">
                        <a href="{{ route('admin.lowongan') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                            Lihat Daftar Lowongan
                        </a>
                        <a href="{{ route('admin.lowongan.tambah') }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                            Tambah Lagi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        // Custom Date Picker
        class CustomDatePicker {
            constructor() {
                this.currentDate = new Date();
                this.selectedDate = null;
                this.monthNames = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];
                
                this.init();
            }
            
            init() {
                this.bindEvents();
                this.updateCalendar();
                this.loadExistingDate();
            }
            
            loadExistingDate() {
                const deadlineHidden = document.getElementById('deadlineHidden');
                if (deadlineHidden.value) {
                    const existingDate = new Date(deadlineHidden.value);
                    this.selectDate(existingDate);
                }
            }
            
            bindEvents() {
                const deadlineInput = document.getElementById('deadlineInput');
                const datePicker = document.getElementById('datePicker');
                const prevMonth = document.getElementById('prevMonth');
                const nextMonth = document.getElementById('nextMonth');
                
                // Toggle date picker
                deadlineInput.addEventListener('click', () => {
                    datePicker.classList.toggle('hidden');
                });
                
                // Close when clicking outside
                document.addEventListener('click', (e) => {
                    if (!deadlineInput.contains(e.target) && !datePicker.contains(e.target)) {
                        datePicker.classList.add('hidden');
                    }
                });
                
                // Month navigation
                prevMonth.addEventListener('click', () => {
                    this.currentDate.setMonth(this.currentDate.getMonth() - 1);
                    this.updateCalendar();
                });
                
                nextMonth.addEventListener('click', () => {
                    this.currentDate.setMonth(this.currentDate.getMonth() + 1);
                    this.updateCalendar();
                });
            }
            
            updateCalendar() {
                const currentMonth = document.getElementById('currentMonth');
                const currentYear = document.getElementById('currentYear');
                const daysContainer = document.getElementById('daysContainer');
                
                // Update month/year display
                currentMonth.textContent = this.monthNames[this.currentDate.getMonth()];
                currentYear.textContent = this.currentDate.getFullYear();
                
                // Generate calendar days
                this.generateDays(daysContainer);
            }
            
            generateDays(container) {
                container.innerHTML = '';
                
                const year = this.currentDate.getFullYear();
                const month = this.currentDate.getMonth();
                const today = new Date();
                
                // First day of the month
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                
                // Get first Monday of the calendar
                const startDate = new Date(firstDay);
                const dayOfWeek = firstDay.getDay();
                const daysBack = dayOfWeek === 0 ? 6 : dayOfWeek - 1;
                startDate.setDate(firstDay.getDate() - daysBack);
                
                // Generate 6 weeks
                for (let week = 0; week < 6; week++) {
                    const weekDiv = document.createElement('div');
                    weekDiv.className = 'flex';
                    
                    for (let day = 0; day < 7; day++) {
                        const currentDate = new Date(startDate);
                        currentDate.setDate(startDate.getDate() + (week * 7) + day);
                        
                        const dayDiv = document.createElement('div');
                        const button = document.createElement('button');
                        button.type = 'button';
                        button.textContent = currentDate.getDate();
                        
                        const isCurrentMonth = currentDate.getMonth() === month;
                        const isToday = currentDate.toDateString() === today.toDateString();
                        const isPast = currentDate < today && !isToday;
                        const isSelected = this.selectedDate && currentDate.toDateString() === this.selectedDate.toDateString();
                        
                        // Base classes
                        let classes = 'm-px size-10 flex justify-center items-center border-[1.5px] border-transparent text-sm rounded-full focus:outline-hidden';
                        
                        if (!isCurrentMonth) {
                            classes += ' text-gray-400 hover:border-primary-600 hover:text-primary-600 disabled:opacity-50 disabled:pointer-events-none';
                            button.disabled = true;
                        } else if (isPast) {
                            classes += ' text-gray-400 opacity-50 cursor-not-allowed';
                            button.disabled = true;
                        } else if (isSelected) {
                            classes += ' bg-primary-600 text-white font-medium';
                        } else if (isToday) {
                            classes += ' bg-primary-100 text-primary-600 font-medium hover:bg-primary-600 hover:text-white';
                        } else {
                            classes += ' text-gray-800 hover:border-primary-600 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600';
                        }
                        
                        button.className = classes;
                        
                        // Add click event for date selection
                        if (isCurrentMonth && !isPast) {
                            button.addEventListener('click', () => {
                                this.selectDate(currentDate);
                            });
                        }
                        
                        dayDiv.appendChild(button);
                        weekDiv.appendChild(dayDiv);
                    }
                    
                    container.appendChild(weekDiv);
                }
            }
            
            selectDate(date) {
                this.selectedDate = new Date(date);
                const deadlineInput = document.getElementById('deadlineInput');
                const deadlineHidden = document.getElementById('deadlineHidden');
                const datePicker = document.getElementById('datePicker');
                
                // Format date as DD Month YYYY (Indonesian format)
                const day = this.selectedDate.getDate();
                const monthName = this.monthNames[this.selectedDate.getMonth()];
                const year = this.selectedDate.getFullYear();
                const displayDate = `${day} ${monthName} ${year}`;
                
                // Set display value
                deadlineInput.value = displayDate;
                
                // Set hidden input with YYYY-MM-DD format for form submission
                deadlineHidden.value = this.selectedDate.toISOString().split('T')[0];
                
                // Close picker
                datePicker.classList.add('hidden');
                
                // Update calendar to show selection
                this.updateCalendar();
            }
        }
        
        // Initialize date picker when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new CustomDatePicker();
            
            // Toggle informasi test visibility
            const testCheckbox = document.getElementById('test');
            const informasiTestContainer = document.getElementById('informasiTestContainer');
            const informasiTestTextarea = informasiTestContainer.querySelector('textarea[name="informasi_test"]');
            
            // Function to toggle informasi test
            function toggleInformasiTest() {
                if (testCheckbox.checked) {
                    informasiTestContainer.classList.remove('hidden');
                    // Make textarea required when test is enabled
                    informasiTestTextarea.setAttribute('required', 'required');
                } else {
                    informasiTestContainer.classList.add('hidden');
                    // Remove required attribute when test is disabled
                    informasiTestTextarea.removeAttribute('required');
                    // Clear the textarea value
                    informasiTestTextarea.value = '';
                }
            }
            
            // Add event listener for checkbox change
            testCheckbox.addEventListener('change', toggleInformasiTest);
            
            // Initialize state on page load
            toggleInformasiTest();

            // Auto-close success modal after 5 seconds
            const successModal = document.getElementById('successModal');
            if (successModal) {
                setTimeout(() => {
                    successModal.style.display = 'none';
                }, 5000);
            }
        });
    </script>
@endsection