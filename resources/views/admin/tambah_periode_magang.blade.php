@extends('layout.template')

@section('content')
    <div class="p-6 space-y-6 bg-white rounded-lg">
        <h1 class="text-xl font-medium text-neutral-900">Tambah Periode Magang</h1>
        <form id="periodForm" action="{{ route('admin.periode_magang.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label for="nama_periode" class="block text-sm font-medium mb-2 dark:text-white">Nama
                            Periode</label>
                        <input type="text" id="nama_periode" name="nama_periode"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Contoh: Periode Magang 2025 Semester Ganjil" aria-describedby="hs-input-helper-text">
                    </div>
                </div>
                
                <div class="space-y-4 w-full">
                    <div class="w-full relative">
                        <label for="tanggal_selesai" class="block text-sm font-medium mb-2 dark:text-white">Tanggal Selesai</label>
                        <input id="endDateInput"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 cursor-pointer"
                            type="text" placeholder="Pilih tanggal selesai" readonly>
                        <input type="hidden" name="tanggal_selesai" id="endDateHidden" value="{{ old('tanggal_selesai') }}">
                        <span class="absolute top-1/2 right-4 -translate-y-1/2 text-gray-400 pointer-events-none">
                            <i class="ph ph-calendar-days text-xl"></i>
                        </span>
                        @error('tanggal_selesai')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Custom Date Picker -->
                        <div id="endDatePicker" class="absolute top-full left-0 mt-2 z-50 hidden">
                            <div class="w-80 flex flex-col bg-white border border-gray-200 shadow-lg rounded-xl overflow-hidden">
                                <div class="p-3 space-y-0.5">
                                    <div class="grid grid-cols-5 items-center gap-x-3 mx-1.5 pb-3">
                                        <div class="col-span-1">
                                            <button type="button" id="prevMonthEnd"
                                                class="size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="m15 18-6-6 6-6" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="col-span-3 flex justify-center items-center gap-x-1">
                                            <span id="currentMonthEnd"
                                                class="font-medium text-gray-800 cursor-pointer hover:text-primary-600"></span>
                                            <span class="text-gray-800">/</span>
                                            <span id="currentYearEnd"
                                                class="font-medium text-gray-800 cursor-pointer hover:text-primary-600"></span>
                                        </div>
                                        <div class="col-span-1 flex justify-end">
                                            <button type="button" id="nextMonthEnd"
                                                class="size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100">
                                                <svg class="shrink-0 size-4" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="m9 18 6-6-6-6" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex pb-1.5">
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Sen</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Sel</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Rab</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Kam</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Jum</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Sab</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Min</span>
                                    </div>
                                    <div id="daysContainerEnd" class="space-y-0">
                                        <!-- Days will be generated by JavaScript -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-4 w-full">
                    <div class="w-full relative">
                        <label for="tanggal_mulai" class="block text-sm font-medium mb-2 dark:text-white">Tanggal Mulai</label>
                        <input id="startDateInput"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 cursor-pointer"
                            type="text" placeholder="Pilih tanggal mulai" readonly>
                        <input type="hidden" name="tanggal_mulai" id="startDateHidden" value="{{ old('tanggal_mulai') }}">
                        <span class="absolute top-1/2 right-4 -translate-y-1/2 text-gray-400 pointer-events-none">
                            <i class="ph ph-calendar-days text-xl"></i>
                        </span>
                        @error('tanggal_mulai')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Custom Date Picker -->
                        <div id="startDatePicker" class="absolute top-full left-0 mt-2 z-50 hidden">
                            <div class="w-80 flex flex-col bg-white border border-gray-200 shadow-lg rounded-xl overflow-hidden">
                                <div class="p-3 space-y-0.5">
                                    <div class="grid grid-cols-5 items-center gap-x-3 mx-1.5 pb-3">
                                        <div class="col-span-1">
                                            <button type="button" id="prevMonthStart"
                                                class="size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="m15 18-6-6 6-6" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="col-span-3 flex justify-center items-center gap-x-1">
                                            <span id="currentMonthStart"
                                                class="font-medium text-gray-800 cursor-pointer hover:text-primary-600"></span>
                                            <span class="text-gray-800">/</span>
                                            <span id="currentYearStart"
                                                class="font-medium text-gray-800 cursor-pointer hover:text-primary-600"></span>
                                        </div>
                                        <div class="col-span-1 flex justify-end">
                                            <button type="button" id="nextMonthStart"
                                                class="size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100">
                                                <svg class="shrink-0 size-4" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="m9 18 6-6-6-6" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex pb-1.5">
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Sen</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Sel</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Rab</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Kam</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Jum</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Sab</span>
                                        <span class="m-px w-10 block text-center text-sm text-gray-500">Min</span>
                                    </div>
                                    <div id="daysContainerStart" class="space-y-0">
                                        <!-- Days will be generated by JavaScript -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-4 w-full">
                    <div class="w-full bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="font-medium text-sm mb-2">Informasi Durasi</div>
                        <div class="flex flex-col gap-2">
                            <div class="flex items-center">
                                <x-lucide-calendar-days class="size-5 text-gray-500 mr-2" />
                                <span class="text-sm text-gray-600">Durasi: </span>
                                <span id="durationDays" class="text-sm font-medium text-gray-900 ml-1">- hari</span>
                            </div>
                            <div class="flex items-center">
                                <x-lucide-calendar-clock class="size-5 text-gray-500 mr-2" />
                                <span class="text-sm text-gray-600">Setara: </span>
                                <span id="durationWeeks" class="text-sm font-medium text-gray-900 ml-1">- minggu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end w-full">
                <button type="button" id="submitBtn" class="btn-primary">
                    Tambahkan Periode
                </button>
            </div>
        </form>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="confirmModal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="confirmModal-label" class="font-bold text-gray-800 dark:text-white">
                        Konfirmasi Tambah Periode Magang
                    </h3>
                    <button type="button" id="closeConfirmModalBtn" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-calendar-days class="w-8 h-8 text-blue-600" />
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Konfirmasi Data Periode Magang</h4>
                        <div class="text-left space-y-2 bg-gray-50 p-4 rounded-lg">
                            <div>
                                <span class="text-sm font-medium text-gray-600">Nama Periode:</span>
                                <span id="confirmNama" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Tanggal Mulai:</span>
                                <span id="confirmMulai" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Tanggal Selesai:</span>
                                <span id="confirmSelesai" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Durasi:</span>
                                <span id="confirmDurasi" class="text-sm text-gray-900 ml-2"></span>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-gray-600">
                            Apakah Anda yakin ingin menambahkan periode magang ini?
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="cancelConfirm" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800">
                        Batal
                    </button>
                    <button type="button" id="confirmSubmit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <span id="confirmButtonText">Ya, Tambahkan</span>
                        <div id="confirmSpinner" class="hidden animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading">
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="successModal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="successModal-label" class="font-bold text-gray-800 dark:text-white">
                        Berhasil!
                    </h3>
                    <button type="button" id="closeSuccessModalBtn" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-check class="w-8 h-8 text-green-600" />
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Periode Magang Berhasil Ditambahkan</h4>
                        <p class="text-sm text-gray-600 mb-4">
                            Data periode magang <span id="successPeriodName" class="font-semibold text-gray-900"></span> telah berhasil disimpan ke dalam sistem.
                        </p>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                            <div class="flex items-center">
                                <x-lucide-info class="w-4 h-4 text-green-600 mr-2" />
                                <p class="text-xs text-green-800">
                                    Periode dapat langsung digunakan untuk membuat lowongan magang.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="backToListBtn" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800">
                        <x-lucide-list class="w-4 h-4" />
                        Kembali ke Daftar
                    </button>
                    <button type="button" id="addAnotherBtn" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        <x-lucide-plus class="w-4 h-4" />
                        Tambah Lagi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Custom Date Picker class
        class CustomDatePicker {
            constructor(options) {
                this.type = options.type; // start or end
                this.currentDate = new Date();
                this.selectedDate = null;
                this.minDate = options.minDate || null;
                this.monthNames = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];
                this.inputElement = document.getElementById(options.inputId);
                this.hiddenInput = document.getElementById(options.hiddenId);
                this.pickerElement = document.getElementById(options.pickerId);
                this.currentMonthElement = document.getElementById(options.currentMonthId);
                this.currentYearElement = document.getElementById(options.currentYearId);
                this.daysContainer = document.getElementById(options.daysContainerId);
                this.prevMonthBtn = document.getElementById(options.prevMonthBtnId);
                this.nextMonthBtn = document.getElementById(options.nextMonthBtnId);
                
                this.init();
            }

            init() {
                this.bindEvents();
                this.updateCalendar();
                this.loadExistingDate();
            }

            loadExistingDate() {
                if (this.hiddenInput && this.hiddenInput.value) {
                    const existingDate = new Date(this.hiddenInput.value);
                    this.selectDate(existingDate);
                }
            }

            bindEvents() {
                if (!this.inputElement || !this.pickerElement || !this.prevMonthBtn || !this.nextMonthBtn) return;

                this.inputElement.addEventListener('click', () => {
                    // Close any other open picker first
                    document.querySelectorAll('.date-picker-container').forEach(picker => {
                        if (picker !== this.pickerElement && !picker.classList.contains('hidden')) {
                            picker.classList.add('hidden');
                        }
                    });
                    
                    this.pickerElement.classList.toggle('hidden');
                });

                document.addEventListener('click', (e) => {
                    if (!this.inputElement.contains(e.target) && !this.pickerElement.contains(e.target)) {
                        this.pickerElement.classList.add('hidden');
                    }
                });

                this.prevMonthBtn.addEventListener('click', () => {
                    this.currentDate.setMonth(this.currentDate.getMonth() - 1);
                    this.updateCalendar();
                });

                this.nextMonthBtn.addEventListener('click', () => {
                    this.currentDate.setMonth(this.currentDate.getMonth() + 1);
                    this.updateCalendar();
                });
            }

            updateCalendar() {
                if (!this.currentMonthElement || !this.currentYearElement || !this.daysContainer) return;

                this.currentMonthElement.textContent = this.monthNames[this.currentDate.getMonth()];
                this.currentYearElement.textContent = this.currentDate.getFullYear();
                this.generateDays();
            }

            generateDays() {
                this.daysContainer.innerHTML = '';
                const year = this.currentDate.getFullYear();
                const month = this.currentDate.getMonth();
                const today = new Date();
                const firstDay = new Date(year, month, 1);
                const startDate = new Date(firstDay);
                const dayOfWeek = firstDay.getDay();
                const daysBack = dayOfWeek === 0 ? 6 : dayOfWeek - 1;
                startDate.setDate(firstDay.getDate() - daysBack);

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
                        const isSelected = this.selectedDate && currentDate.toDateString() === this.selectedDate.toDateString();
                        
                        // Check if date is before minimum date (for end date picker)
                        const isBeforeMinDate = this.minDate && currentDate < this.minDate;

                        let classes = 'm-px size-10 flex justify-center items-center border-[1.5px] border-transparent text-sm rounded-full focus:outline-hidden';

                        if (!isCurrentMonth) {
                            classes += ' text-gray-400 hover:border-primary-600 hover:text-primary-600 disabled:opacity-50 disabled:pointer-events-none';
                            button.disabled = true;
                        } else if (isBeforeMinDate) {
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

                        if (isCurrentMonth && !isBeforeMinDate) {
                            button.addEventListener('click', () => {
                                this.selectDate(currentDate);
                            });
                        }

                        dayDiv.appendChild(button);
                        weekDiv.appendChild(dayDiv);
                    }
                    this.daysContainer.appendChild(weekDiv);
                }
            }

            selectDate(date) {
                this.selectedDate = new Date(date);
                
                if (!this.inputElement || !this.hiddenInput || !this.pickerElement) return;

                const day = this.selectedDate.getDate();
                const monthName = this.monthNames[this.selectedDate.getMonth()];
                const year = this.selectedDate.getFullYear();
                const displayDate = `${day} ${monthName} ${year}`;

                this.inputElement.value = displayDate;
                this.hiddenInput.value = this.selectedDate.toISOString().split('T')[0];
                this.pickerElement.classList.add('hidden');
                
                // Update calendar display
                this.currentDate = new Date(this.selectedDate);
                this.updateCalendar();
                
                // If this is a start date picker, update the minimum date for the end date picker
                if (this.type === 'start' && window.endDatePicker) {
                    window.endDatePicker.minDate = this.selectedDate;
                    window.endDatePicker.updateCalendar();
                    
                    // If end date is now before start date, clear end date
                    if (window.endDatePicker.selectedDate && window.endDatePicker.selectedDate < this.selectedDate) {
                        document.getElementById('endDateInput').value = '';
                        document.getElementById('endDateHidden').value = '';
                        window.endDatePicker.selectedDate = null;
                    }
                }
                
                // Calculate duration whenever a date is selected
                calculateDuration();
            }
        }

        // Calculate duration between two dates
        function calculateDuration() {
            const startDate = document.getElementById('startDateHidden').value;
            const endDate = document.getElementById('endDateHidden').value;
            
            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                
                // Check if end date is before start date
                if (end < start) {
                    document.getElementById('durationDays').textContent = "Tanggal tidak valid";
                    document.getElementById('durationWeeks').textContent = "Tanggal tidak valid";
                    return false;
                }
                
                // Calculate difference in milliseconds
                const diffTime = Math.abs(end - start);
                
                // Calculate days (add 1 to include both start and end dates)
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                
                // Calculate weeks and remaining days
                const diffWeeks = Math.floor(diffDays / 7);
                const remainingDays = diffDays % 7;
                
                document.getElementById('durationDays').textContent = `${diffDays} hari`;
                document.getElementById('durationWeeks').textContent = `${diffWeeks} minggu${remainingDays > 0 ? ` ${remainingDays} hari` : ''}`;
                
                return {
                    days: diffDays,
                    weeks: diffWeeks,
                    remainingDays: remainingDays
                };
            }
            
            document.getElementById('durationDays').textContent = "- hari";
            document.getElementById('durationWeeks').textContent = "- minggu";
            return null;
        }

        // Format date for display
        function formatDate(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            
            const monthNames = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            
            return `${date.getDate()} ${monthNames[date.getMonth()]} ${date.getFullYear()}`;
        }

        // Validasi form
        function validateForm() {
            const requiredFields = [
                { id: 'nama_periode', name: 'Nama Periode' },
                { id: 'startDateHidden', name: 'Tanggal Mulai' },
                { id: 'endDateHidden', name: 'Tanggal Selesai' }
            ];

            for (const field of requiredFields) {
                const element = document.getElementById(field.id);
                if (!element || !element.value.trim()) {
                    alert(`${field.name} harus diisi!`);
                    element.focus();
                    return false;
                }
            }

            // Validate dates
            const startDate = new Date(document.getElementById('startDateHidden').value);
            const endDate = new Date(document.getElementById('endDateHidden').value);
            
            if (endDate < startDate) {
                alert('Tanggal Selesai tidak boleh sebelum Tanggal Mulai!');
                document.getElementById('endDateInput').focus();
                return false;
            }

            return true;
        }

        // Menampilkan modal konfirmasi
        function showConfirmModal() {
            // Isi data konfirmasi
            const namaPeriode = document.getElementById('nama_periode').value;
            const tanggalMulai = formatDate(document.getElementById('startDateHidden').value);
            const tanggalSelesai = formatDate(document.getElementById('endDateHidden').value);
            const durasi = calculateDuration();
            
            let durasiText = '-';
            if (durasi) {
                durasiText = `${durasi.days} hari (${durasi.weeks} minggu${durasi.remainingDays > 0 ? ` ${durasi.remainingDays} hari` : ''})`;
            }

            document.getElementById('confirmNama').textContent = namaPeriode;
            document.getElementById('confirmMulai').textContent = tanggalMulai;
            document.getElementById('confirmSelesai').textContent = tanggalSelesai;
            document.getElementById('confirmDurasi').textContent = durasiText;

            confirmModal = new HSOverlay(document.getElementById('confirmModal'));
            confirmModal.open();
        }

        // Menutup modal konfirmasi
        function closeConfirmModal() {
            if (confirmModal) {
                confirmModal.close();
                confirmModal = null;
            }
        }

        // Show success modal
        function showSuccessModal(periodName) {
            document.getElementById('successPeriodName').textContent = periodName;
            
            // Initialize and show the modal
            if (window.HSOverlay) {
                successModal = new HSOverlay(document.getElementById('successModal'));
                successModal.open();
            } else {
                // Fallback if HSOverlay is not available
                document.getElementById('successModal').classList.remove('hidden');
                document.getElementById('successModal').classList.add('hs-overlay-open');
            }
        }

        // Close success modal
        function closeSuccessModal() {
            if (successModal) {
                successModal.close();
                successModal = null;
            } else {
                // Fallback
                document.getElementById('successModal').classList.add('hidden');
                document.getElementById('successModal').classList.remove('hs-overlay-open');
            }
        }

        // Tunggu DOM selesai dimuat sebelum menambahkan event listener
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize date pickers
            window.startDatePicker = new CustomDatePicker({
                type: 'start',
                inputId: 'startDateInput',
                hiddenId: 'startDateHidden',
                pickerId: 'startDatePicker',
                currentMonthId: 'currentMonthStart',
                currentYearId: 'currentYearStart',
                daysContainerId: 'daysContainerStart',
                prevMonthBtnId: 'prevMonthStart',
                nextMonthBtnId: 'nextMonthStart'
            });
            
            window.endDatePicker = new CustomDatePicker({
                type: 'end',
                inputId: 'endDateInput',
                hiddenId: 'endDateHidden',
                pickerId: 'endDatePicker',
                currentMonthId: 'currentMonthEnd',
                currentYearId: 'currentYearEnd',
                daysContainerId: 'daysContainerEnd',
                prevMonthBtnId: 'prevMonthEnd',
                nextMonthBtnId: 'nextMonthEnd'
            });
            
            // Check if there's a success message in the session
            @if(session('success'))
                const periodName = '{{ session('period_name', 'periode') }}';
                
                // Delay showing modal to ensure everything is loaded
                setTimeout(function() {
                    showSuccessModal(periodName);
                }, 500);
            @endif

            @if(session('error'))
                alert('{{ session('error') }}');
            @endif

            // Submit button event listener
            document.getElementById('submitBtn').addEventListener('click', function(e) {
                e.preventDefault();
                
                if (validateForm()) {
                    showConfirmModal();
                }
            });

            // Modal event listeners
            document.getElementById('closeConfirmModalBtn').addEventListener('click', closeConfirmModal);
            document.getElementById('cancelConfirm').addEventListener('click', closeConfirmModal);

            // Confirm submit
            document.getElementById('confirmSubmit').addEventListener('click', function() {
                const confirmBtn = this;
                const confirmText = document.getElementById('confirmButtonText');
                const confirmSpinner = document.getElementById('confirmSpinner');

                // Show loading state
                confirmBtn.disabled = true;
                confirmText.textContent = 'Menyimpan...';
                confirmSpinner.classList.remove('hidden');

                // Submit the form
                document.getElementById('periodForm').submit();
            });

            // Success modal event listeners
            document.getElementById('closeSuccessModalBtn').addEventListener('click', closeSuccessModal);
            
            document.getElementById('backToListBtn').addEventListener('click', function() {
                window.location.href = '{{ route("admin.periode_magang") }}';
            });
            
            document.getElementById('addAnotherBtn').addEventListener('click', function() {
                closeSuccessModal();
                // Reset form
                document.getElementById('periodForm').reset();
                document.getElementById('startDateInput').value = '';
                document.getElementById('startDateHidden').value = '';
                document.getElementById('endDateInput').value = '';
                document.getElementById('endDateHidden').value = '';
                // Reset duration display
                document.getElementById('durationDays').textContent = "- hari";
                document.getElementById('durationWeeks').textContent = "- minggu";
                // Reset date pickers
                window.startDatePicker.selectedDate = null;
                window.endDatePicker.selectedDate = null;
                window.endDatePicker.minDate = null;
                // Scroll to top
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (confirmModal) {
                        closeConfirmModal();
                    } else if (successModal) {
                        closeSuccessModal();
                    }
                    
                    // Also close date pickers
                    document.getElementById('startDatePicker').classList.add('hidden');
                    document.getElementById('endDatePicker').classList.add('hidden');
                }
            });
            
            // Add hidden class to both pickers initially to prevent class name mistakes
            document.getElementById('startDatePicker').classList.add('date-picker-container');
            document.getElementById('endDatePicker').classList.add('date-picker-container');
        });
    </script>
@endsection