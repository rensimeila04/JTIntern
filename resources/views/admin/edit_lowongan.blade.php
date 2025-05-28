@extends('layout.template')
@section('content')
    <div class="p-6 space-y-6 bg-white rounded-lg">
        <h1 class="text-xl font-medium text-neutral-900">Edit Lowongan</h1>
        <form class="space-y-4">
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Perusahaan</label>
                        <select data-hs-select='{
                            "hasSearch": true,
                            "minSearchLength": 3,
                            "searchPlaceholder": "Search...",
                            "searchClasses": "block w-full sm:text-sm border-gray-200 rounded-lg focus:border-primary-500 focus:ring-primary-500 before:absolute before:inset-0 before:z-1 py-1.5 sm:py-2 px-3",
                            "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0",
                            "placeholder": "Pilih perusahaan",
                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 \" data-title></span></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-hidden focus:ring-2 focus:ring-primary-500",
                            "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
                            "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100",
                            "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 \" data-title></div></div></div>",
                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/></svg></div>"
                            }' class="hidden">
                            <option value="">Choose</option>
                            <option value="AF"
                                data-hs-select-option='{}'>
                                PT. Digital Inovasi Indonesia
                            </option>
                            <option value="US"
                                data-hs-select-option='{}'>
                                PT. Teknologi Masa Depan
                            </option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Periode Magang</label>
                        <select
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="" disabled selected>Pilih periode magang</option>
                            <option>Ganjil 2025</option>
                            <option>Genap 2026</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Judul Lowongan</label>
                        <input type="text"
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            placeholder="ex: Frontend Developer">
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Deskripsi</label>
                        <textarea
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            rows="3" placeholder="Tambahkan deskripsi lowongan..."></textarea>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Persyaratan</label>
                        <textarea
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            rows="3" placeholder="Tambahkan persyaratan..."></textarea>
                    </div>
                </div>
                <div class="space-y-4 w-full">
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Kompetensi</label>
                        <select
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="" disabled selected>Pilih kompetensi</option>
                            <option>UI/UX</option>
                            <option>Backend</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Jenis Magang</label>
                        <select
                            class="py-2.5 sm:py-3 px-4 block w-full text-gray-500 border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="" disabled selected>Pilih jenis magang</option>
                            <option>Remote</option>
                            <option>WFO</option>
                        </select>
                    </div>
                    <div class="w-full relative">
                        <label class="block text-sm font-medium mb-2">Deadline Pendaftaran</label>
                        <input
                            id="deadlineInput"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 cursor-pointer"
                            type="text" placeholder="Pilih deadline" readonly>
                        <input type="hidden" name="deadline_pendaftaran" id="deadlineHidden">
                        <span class="absolute top-1/2 right-4 -translate-y-1/2 text-gray-400 pointer-events-none">
                            <i class="ph ph-calendar-days text-xl"></i>
                        </span>
                        
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
                   <div class="flex flex-row gap-4">
                        <label for="" class="block text-sm font-medium mb-2">Tes seleksi diperlukan</label>
                        <label for="tes-seleksi-switch" class="relative inline-block w-11 h-6 cursor-pointer">
                            <input type="checkbox" id="tes-seleksi-switch" class="peer sr-only">
                            <span
                                class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-primary-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                            <span
                                class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400"></span>
                        </label>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-2">Informasi Test</label>
                        <textarea
                            class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500"
                            rows="3" placeholder="Tambahkan informasi test..."></textarea>
                    </div>
                    <div class="flex flex-row gap-4">
                        <label for="" class="block text-sm font-medium mb-2">Status Pendaftaran</label>
                        <label for="status-pendaftaran-switch" class="relative inline-block w-11 h-6 cursor-pointer">
                            <input type="checkbox" id="status-pendaftaran-switch" class="peer sr-only">
                            <span
                                class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-primary-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                            <span
                                class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex justify-end w-full">
                <button type="submit" class="btn-primary">
                    Edit Lowongan
                </button>
            </div>
        </form>
    </div>
@endsection

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
                
                // Get first Monday of the calendar (start from Monday)
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
        });
    </script>