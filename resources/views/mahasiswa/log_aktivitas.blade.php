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
            <button type="button" onclick="openModal()"
                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-500 text-white hover:bg-primary-700">
                <i class="ph ph-plus"></i>
                Tambah Log Aktivitas
            </button>
        </div>
        <div class="hs-dropdown relative inline-flex">
            <button id="datePickerBtn" type="button"
                class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                <x-lucide-calendar-days class="size-3.5 text-neutral-500" />
                <span id="selectedDate">
                    @if (!empty($startDate) && !empty($endDate))
                        {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d M Y') }}
                    @else
                        Pilih Tanggal
                    @endif
                </span>
                <x-lucide-chevron-down class="size-5 text-neutral-500 hs-dropdown-open:-rotate-180 transition-transform duration-300" />
            </button>
            <!-- Calendar Dropdown -->
            <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 opacity-0 w-80 transition-[opacity,margin] duration-300 hs-dropdown-open:translate-y-0 translate-y-2 hidden z-50 mt-2">
                <div class="w-80 flex flex-col bg-white border border-gray-200 shadow-lg rounded-xl overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
                    <!-- Calendar -->
                    <div class="p-3 space-y-0.5">
                        <!-- Months -->
                        <div class="grid grid-cols-5 items-center gap-x-3 mx-1.5 pb-3">
                            <!-- Prev Button -->
                            <div class="col-span-1">
                                <button type="button" id="prevMonth" class="size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" aria-label="Previous">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                                </button>
                            </div>
                            <!-- End Prev Button -->

                            <!-- Month/Year -->
                            <div class="col-span-3 flex justify-center items-center gap-x-1">
                                <span id="currentMonth" class="text-gray-800 font-medium dark:text-white"></span>
                                <span id="currentYear" class="text-gray-800 font-medium dark:text-white"></span>
                            </div>
                            <!-- End Month/Year -->

                            <!-- Next Button -->
                            <div class="col-span-1 flex justify-end">
                                <button type="button" id="nextMonth" class="size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" aria-label="Next">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                </button>
                            </div>
                            <!-- End Next Button -->
                        </div>
                        <!-- End Months -->

                        <!-- Week Days -->
                        <div class="flex gap-1 mb-1">
                            <div class="w-10 h-10 flex justify-center items-center text-xs text-gray-500 font-medium dark:text-neutral-400">Sen</div>
                            <div class="w-10 h-10 flex justify-center items-center text-xs text-gray-500 font-medium dark:text-neutral-400">Sel</div>
                            <div class="w-10 h-10 flex justify-center items-center text-xs text-gray-500 font-medium dark:text-neutral-400">Rab</div>
                            <div class="w-10 h-10 flex justify-center items-center text-xs text-gray-500 font-medium dark:text-neutral-400">Kam</div>
                            <div class="w-10 h-10 flex justify-center items-center text-xs text-gray-500 font-medium dark:text-neutral-400">Jum</div>
                            <div class="w-10 h-10 flex justify-center items-center text-xs text-gray-500 font-medium dark:text-neutral-400">Sab</div>
                            <div class="w-10 h-10 flex justify-center items-center text-xs text-gray-500 font-medium dark:text-neutral-400">Min</div>
                        </div>
                        <!-- End Week Days -->

                        <!-- Calendar Days -->
                        <div id="calendarDays" class="grid grid-cols-7 gap-1">
                            <!-- Days will be populated by JS -->
                        </div>
                        <!-- End Calendar Days -->
                    </div>
                    <!-- End Calendar -->
                    
                    <!-- Footer -->
                    <div class="flex items-center justify-between px-3 py-2 border-t border-gray-200 dark:border-neutral-700">
                        <button type="button" id="cancelDate" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:shadow-neutral-700/10">
                            Batal
                        </button>
                        <button type="button" id="applyDate" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                            Terapkan
                        </button>
                    </div>
                    <!-- End Footer -->
                </div>
            </div>
            <!-- End Calendar Dropdown -->
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
                                    <th scope="col"
                                        class="px-5 py-3 text-start text-xs font-medium text-gray-500 w-auto">
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
                                            @if ($log->jam_masuk && $log->jam_pulang)
                                                {{ \Carbon\Carbon::parse($log->jam_masuk)->format('H.i') }} -
                                                {{ \Carbon\Carbon::parse($log->jam_pulang)->format('H.i') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $log->kegiatan }}
                                        </td>
                                        <td class="px-5 py-1.5 whitespace-nowrap text-sm text-gray-800">
                                            @if ($log->feedback)
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 text-teal-500">
                                                    Dinilai
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-400 text-gray-400">
                                                    Belum Dinilai
                                                </span>
                                            @endif
                                        </td>
                                        <td
                                            class="px-5 py-1.5 whitespace-nowrap text-sm font-medium text-end max-w-43 w-fit ">
                                            <div class="flex justify-start gap-2.5">
                                                <a href="javascript:void(0)"
                                                    onclick="openDetailModal({{ $log->id_log_aktivitas }})"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none"
                                                    aria-haspopup="dialog" aria-expanded="false"
                                                    aria-controls="modal-detail-log" data-hs-overlay="#modal-detail-log">
                                                    <x-lucide-files class="w-4 h-4 text-primary-500" />
                                                </a>
                                                <button type="button"
                                                    onclick="openEditModal({{ $log->id_log_aktivitas }}, '{{ $log->tanggal }}', '{{ $log->jam_masuk }}', '{{ $log->jam_pulang }}', `{{ $log->kegiatan }}`)"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-file-edit class="w-4 h-4 text-yellow-500" />
                                                </button>
                                                <button type="button"
                                                    onclick="confirmDelete({{ $log->id_log_aktivitas }})"
                                                    class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-red-500 disabled:opacity-50 disabled:pointer-events-none">
                                                    <x-lucide-trash-2 class="w-4 h-4 text-red-500" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data log
                                            aktivitas.</td>
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
    @include('mahasiswa.edit_log_aktivitas')

    <div id="modal-detail-log"
        class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-80 opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="modal-detail-log-label">
        <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 id="modal-detail-log-label" class="font-bold text-gray-800">
                        Detail Log Aktivitas
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200"
                        aria-label="Close" data-hs-overlay="#modal-detail-log">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div id="detailContent">
                        <!-- Konten detail akan diisi via JS -->
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200">
                    <button type="button"
                        class="btn-primary"
                        data-hs-overlay="#modal-detail-log">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="modal-confirm-delete" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="modal-confirm-delete-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm pointer-events-auto dark:bg-neutral-900 dark:border-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="modal-confirm-delete-label" class="font-bold text-gray-800 dark:text-white">
                        Konfirmasi Hapus
                    </h3>
                    <button type="button" id="closeModalBtn" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" data-hs-overlay="#modal-confirm-delete" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-trash-2 class="w-8 h-8 text-red-600" />
                        </div>
                        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Apakah Anda yakin ingin menghapus log aktivitas ini?
                        </p>
                        <p class="mt-1 text-xs text-red-600">
                            Tindakan ini tidak dapat dibatalkan!
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" id="cancelDelete" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800" data-hs-overlay="#modal-confirm-delete">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="confirmDeleteBtn" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                            <span id="deleteButtonText">Hapus</span>
                            <div id="deleteSpinner" class="hidden animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading">
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    let currentDate = new Date(); 
    let rangeStart = null; 
    let rangeEnd = null;
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    
    // If there is a range from backend, set it (set to local midnight)
    @if (!empty($startDate) && !empty($endDate))
        rangeStart = new Date("{{ $startDate }}T00:00:00");
        rangeEnd = new Date("{{ $endDate }}T00:00:00");
    @endif
    
    function generateCalendar(year, month) {
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const startDate = new Date(firstDay);
        const endDate = new Date(lastDay);
        
        // Adjust to start from Monday
        startDate.setDate(startDate.getDate() - ((startDate.getDay() + 6) % 7));
        endDate.setDate(endDate.getDate() + (7 - endDate.getDay()) % 7);
        
        const calendarDays = document.getElementById('calendarDays');
        calendarDays.innerHTML = '';
        
        let currentWeek = document.createElement('div');
        currentWeek.className = 'flex';
        
        for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
            const dayContainer = document.createElement('div');
            const dayButton = document.createElement('button');
            dayButton.type = 'button';
            dayButton.textContent = d.getDate();
            
            const isCurrentMonth = d.getMonth() === month;
            const isToday = d.toLocaleDateString() === new Date().toLocaleDateString();
            const isInRange = rangeStart && rangeEnd && d >= rangeStart && d <= rangeEnd;
            const isRangeStart = rangeStart && d.toLocaleDateString() === rangeStart.toLocaleDateString();
            const isRangeEnd = rangeEnd && d.toLocaleDateString() === rangeEnd.toLocaleDateString();
            
            let classes = 'm-px size-10 flex justify-center items-center border-[1.5px] border-transparent text-sm rounded-full focus:outline-hidden ';
            
            if (!isCurrentMonth) {
                classes += 'text-gray-400 hover:border-primary-600 hover:text-primary-600 disabled:opacity-50 disabled:pointer-events-none focus:bg-gray-100 dark:text-neutral-500 dark:hover:border-neutral-500 dark:focus:bg-neutral-700';
                dayButton.disabled = true;
            } else if (isRangeStart || isRangeEnd) {
                classes += 'bg-primary-600 text-white font-medium hover:border-primary-600 focus:border-primary-600 dark:bg-primary-500 dark:hover:border-neutral-700 dark:focus:border-neutral-700';
            } else if (isInRange) {
                classes += 'bg-primary-100 text-primary-600 font-medium hover:border-primary-600 focus:border-primary-600 dark:bg-primary-800 dark:text-primary-400';
            } else if (isToday) {
                classes += 'bg-primary-50 text-primary-600 font-medium hover:border-primary-600 focus:border-primary-600 dark:bg-primary-800 dark:text-primary-400';
            } else {
                classes += 'text-gray-800 hover:border-primary-600 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 dark:text-neutral-200 dark:hover:border-primary-500 dark:hover:text-primary-500 dark:focus:border-primary-500 dark:focus:text-primary-500';
            }
            
            dayButton.className = classes;
            
            if (isCurrentMonth) {
                // Create a new date object for closure event, and set to local midnight
                const thisDay = new Date(d.getFullYear(), d.getMonth(), d.getDate());
                
                dayButton.addEventListener('click', function() {
                    if (!rangeStart || (rangeStart && rangeEnd)) {
                        rangeStart = new Date(thisDay.getFullYear(), thisDay.getMonth(), thisDay.getDate());
                        rangeStart.setHours(0,0,0,0);
                        rangeEnd = null;
                    } else if (rangeStart && !rangeEnd) {
                        let picked = new Date(thisDay.getFullYear(), thisDay.getMonth(), thisDay.getDate());
                        picked.setHours(0,0,0,0);
                        
                        if (picked < rangeStart) {
                            rangeEnd = rangeStart;
                            rangeStart = picked;
                        } else {
                            rangeEnd = picked;
                        }
                    }
                    
                    // Only update calendar, DON'T close dropdown here!
                    generateCalendar(year, month);
                });
            }
            
            dayContainer.appendChild(dayButton);
            currentWeek.appendChild(dayContainer);
            
            if (d.getDay() === 0) { // Sunday
                calendarDays.appendChild(currentWeek);
                currentWeek = document.createElement('div');
                currentWeek.className = 'flex';
            }
        }
        
        if (currentWeek.children.length > 0) {
            calendarDays.appendChild(currentWeek);
        }
    }
    
    function updateCalendarHeader() {
        document.getElementById('currentMonth').textContent = monthNames[currentDate.getMonth()];
        document.getElementById('currentYear').textContent = currentDate.getFullYear();
    }
    
    function initCalendar() {
        updateCalendarHeader();
        generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
        
        document.getElementById('prevMonth').addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            updateCalendarHeader();
            generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
        });
        
        document.getElementById('nextMonth').addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            updateCalendarHeader();
            generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
        });
        
        document.getElementById('cancelDate').addEventListener('click', function() {
            rangeStart = null;
            rangeEnd = null;
            document.getElementById('selectedDate').textContent = 'Pilih Tanggal';
            
            // Close dropdown
            const dropdown = document.querySelector('.hs-dropdown');
            if (dropdown) {
                dropdown.classList.remove('hs-dropdown-open');
            }
        });
        
        document.getElementById('applyDate').addEventListener('click', function() {
            if (rangeStart && rangeEnd) {
                const options = { day: '2-digit', month: 'short', year: 'numeric' };
                document.getElementById('selectedDate').textContent = rangeStart.toLocaleDateString('id-ID', options) + ' - ' + 
                    rangeEnd.toLocaleDateString('id-ID', options);
                filterLogsByRange(rangeStart, rangeEnd);
            } else if (rangeStart) {
                const options = { day: '2-digit', month: 'short', year: 'numeric' };
                document.getElementById('selectedDate').textContent = rangeStart.toLocaleDateString('id-ID', options);
                filterLogsByRange(rangeStart, rangeStart);
            }
            
            // Close dropdown ONLY here
            const dropdown = document.querySelector('.hs-dropdown');
            if (dropdown) {
                dropdown.classList.remove('hs-dropdown-open');
            }
        });
    }
    
    function filterLogsByRange(start, end) {
        // Format as yyyy-mm-dd (local time)
        const startString = start.getFullYear() + '-' + String(start.getMonth() + 1).padStart(2, '0') + '-' + 
            String(start.getDate()).padStart(2, '0');
        const endString = end.getFullYear() + '-' + String(end.getMonth() + 1).padStart(2, '0') + '-' + 
            String(end.getDate()).padStart(2, '0');
            
        window.location.href = window.location.pathname + '?start_date=' + startString + '&end_date=' + endString;
    }
    
    // Initialize calendar when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        initCalendar();

        // AJAX submit
        const formTambahLog = document.getElementById('formTambahLog');
        if (formTambahLog) {
            formTambahLog.addEventListener('submit', function(e) {
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
                        if (res.success) {
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
        }

        const formEditLog = document.getElementById('formEditLog');
        if (formEditLog) {
            formEditLog.addEventListener('submit', function(e) {
                e.preventDefault();
                let form = this;
                let id = document.getElementById('editId').value;
                let data = new FormData(form);
                let errorDiv = document.getElementById('editFormError');
                errorDiv.classList.add('hidden');
                
                fetch('/mahasiswa/log-aktivitas/' + id, {
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
                        if (res.success) {
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
        }

        const deleteForm = document.getElementById('deleteForm');
        
        if (deleteForm) {
            deleteForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                const deleteButton = document.getElementById('confirmDeleteBtn');
                const deleteButtonText = document.getElementById('deleteButtonText');
                const deleteSpinner = document.getElementById('deleteSpinner');
                
                deleteButton.disabled = true;
                deleteButtonText.textContent = 'Menghapus...';
                deleteSpinner.classList.remove('hidden');
                
                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-HTTP-Method-Override': 'DELETE'
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Close the modal
                        if (typeof HSOverlay !== 'undefined') {
                            HSOverlay.close(document.getElementById('modal-confirm-delete'));
                        } else {
                            document.getElementById('modal-confirm-delete').classList.add('hidden');
                            document.getElementById('modal-confirm-delete').classList.remove('opacity-100');
                            document.getElementById('modal-confirm-delete').classList.remove('pointer-events-auto');
                        }
                        
                        // Redirect to the log activities page with reload to refresh data
                        window.location = '/mahasiswa/log-aktivitas';
                    } else {
                        // Reset button state
                        deleteButton.disabled = false;
                        deleteButtonText.textContent = 'Hapus';
                        deleteSpinner.classList.add('hidden');
                        
                        alert(data.message || 'Gagal menghapus log aktivitas.');
                    }
                })
                .catch(error => {
                    // Reset button state
                    deleteButton.disabled = false;
                    deleteButtonText.textContent = 'Hapus';
                    deleteSpinner.classList.add('hidden');
                    
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus log aktivitas.');
                });
            });
        }
    });

    function openModal() {
        document.getElementById('modalTambahLog').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modalTambahLog').classList.add('hidden');
        document.getElementById('formTambahLog').reset();
        document.getElementById('formError').classList.add('hidden');
    }

    function openEditModal(id, tanggal, jamMasuk, jamPulang, kegiatan) {
        document.getElementById('modalEditLog').classList.remove('hidden');
        document.getElementById('editId').value = id;
        document.getElementById('editTanggal').value = tanggal;
        document.getElementById('editWaktuAwal').value = jamMasuk;
        document.getElementById('editWaktuAkhir').value = jamPulang;
        document.getElementById('editDeskripsi').value = kegiatan;
    }

    function closeEditModal() {
        document.getElementById('modalEditLog').classList.add('hidden');
        document.getElementById('formEditLog').reset();
        document.getElementById('editFormError').classList.add('hidden');
    }

    function openDetailModal(id) {
        let contentDiv = document.getElementById('detailContent');
        contentDiv.innerHTML = 'Memuat...';
        fetch('/mahasiswa/log-aktivitas/' + id)
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    let log = res.data;
                    let waktu = `${log.jam_masuk} - ${log.jam_pulang}`;
                    contentDiv.innerHTML = `
                    <div class="flex flex-col gap-y-4">
                        <div class="flex items-start gap-x-4">
                            <div class="w-40 text-gray-400 font-medium">Hari, Tanggal</div>
                            <div class="font-medium text-gray-900">${log.tanggal}</div>
                        </div>
                        <div class="flex items-start gap-x-4">
                            <div class="w-40 text-gray-400 font-medium">Waktu</div>
                            <div class="font-medium text-gray-900">${waktu}</div>
                        </div>
                        <div class="flex items-start gap-x-4">
                            <div class="w-40 text-gray-400 font-medium">Kegiatan</div>
                            <div class="font-medium text-gray-900 whitespace-pre-line">${log.kegiatan}</div>
                        </div>
                        <div class="flex items-start gap-x-4">
                            <div class="w-40 text-gray-400 font-medium">Feedback</div>
                            <div class="font-medium text-gray-900">${log.feedback_dospem ?? '-'}</div>
                        </div>
                    </div>
                `;
                } else {
                    contentDiv.innerHTML = 'Gagal memuat detail.';
                }
            })
            .catch(() => {
                contentDiv.innerHTML = 'Gagal memuat detail.';
            });
    }

    function confirmDelete(id) {
        document.getElementById('deleteForm').action = `/mahasiswa/log-aktivitas/${id}`;
        
        if (typeof HSOverlay !== 'undefined') {
            HSOverlay.open(document.getElementById('modal-confirm-delete'));
        } else {
            document.getElementById('modal-confirm-delete').classList.remove('hidden');
            document.getElementById('modal-confirm-delete').classList.add('opacity-100');
            document.getElementById('modal-confirm-delete').classList.add('pointer-events-auto');
        }
    }
</script>
