<div id="modalEditLog"
    class="hidden fixed inset-0 z-[90] flex items-center justify-center bg-black/60 transition-opacity duration-300">
    <div class="bg-white rounded-lg w-full max-w-lg relative mx-auto my-16 border border-gray-200">
        <!-- Header -->
        <div class="flex items-center justify-between border-b-1 border-gray-200 p-4">
            <h3 class="text-lg font-semibold text-gray-900">Edit Log Aktivitas</h3>
            <button type="button" class="text-gray-400 hover:text-gray-800 text-2xl" onclick="closeEditModal()">
                &times;
            </button>
        </div>
        <!-- Body -->
        <form id="formEditLog" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editId">
            <div class="w-full p-4">
                <label class="block text-sm font-medium mb-2">Tanggal</label>
                <div class="relative">
                    <input id="editTanggalInput"
                        class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 cursor-pointer bg-white"
                        type="text" placeholder="Pilih tanggal" readonly autocomplete="off">
                    <input type="hidden" name="tanggal_log" id="editTanggalHidden">
                    <span class="absolute top-1/2 right-4 -translate-y-1/2 text-gray-400 pointer-events-none" tabindex="-1">
                        <i class="ph ph-calendar-days text-xl"></i>
                    </span>
                    <div id="editDatePicker" class="absolute top-full left-0 mt-2 z-50 hidden">
                        <div
                            class="w-80 flex flex-col bg-white border border-gray-200 shadow-lg rounded-xl overflow-hidden">
                            <div class="p-3 space-y-0.5">
                                <div class="grid grid-cols-5 items-center gap-x-3 mx-1.5 pb-3">
                                    <div class="col-span-1">
                                        <button type="button" id="editPrevMonth"
                                            class="size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m15 18-6-6 6-6" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-span-3 flex justify-center items-center gap-x-1">
                                        <span id="editCurrentMonth"
                                            class="font-medium text-gray-800 cursor-pointer hover:text-primary-600"></span>
                                        <span class="text-gray-800">/</span>
                                        <span id="editCurrentYear"
                                            class="font-medium text-gray-800 cursor-pointer hover:text-primary-600"></span>
                                    </div>
                                    <div class="col-span-1 flex justify-end">
                                        <button type="button" id="editNextMonth"
                                            class="size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100">
                                            <svg class="shrink-0 size-4" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
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
                                <div id="editDaysContainer" class="space-y-0">
                                    <!-- Days will be generated by JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <label class="block text-sm font-medium mb-2 mt-4">Waktu Awal</label>
                <input type="time" name="waktu_awal" id="editWaktuAwal" class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm mb-2">
                <label class="block text-sm font-medium mb-2">Waktu Akhir</label>
                <input type="time" name="waktu_akhir" id="editWaktuAkhir" class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm mb-2">
                <label class="block text-sm font-medium mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="editDeskripsi" class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm mb-2"></textarea>
                <div id="editFormError" class="text-red-500 text-xs mt-2 hidden"></div>
                <button type="submit" class="mt-4 w-full py-2 px-4 bg-primary-500 text-white rounded-lg hover:bg-primary-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
// Custom Datepicker for Edit Modal
class EditCustomDatePicker {
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
        const tanggalHidden = document.getElementById('editTanggalHidden');
        if (tanggalHidden && tanggalHidden.value) {
            const existingDate = new Date(tanggalHidden.value);
            if (!isNaN(existingDate)) this.selectDate(existingDate, false);
        }
    }

    bindEvents() {
        const tanggalInput = document.getElementById('editTanggalInput');
        const datePicker = document.getElementById('editDatePicker');
        const prevMonth = document.getElementById('editPrevMonth');
        const nextMonth = document.getElementById('editNextMonth');

        if (!tanggalInput || !datePicker || !prevMonth || !nextMonth) return;

        tanggalInput.addEventListener('click', () => {
            datePicker.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!tanggalInput.contains(e.target) && !datePicker.contains(e.target)) {
                datePicker.classList.add('hidden');
            }
        });

        prevMonth.addEventListener('click', (e) => {
            e.preventDefault();
            this.currentDate.setMonth(this.currentDate.getMonth() - 1);
            this.updateCalendar();
        });

        nextMonth.addEventListener('click', (e) => {
            e.preventDefault();
            this.currentDate.setMonth(this.currentDate.getMonth() + 1);
            this.updateCalendar();
        });
    }

    updateCalendar() {
        const currentMonth = document.getElementById('editCurrentMonth');
        const currentYear = document.getElementById('editCurrentYear');
        const daysContainer = document.getElementById('editDaysContainer');

        if (!currentMonth || !currentYear || !daysContainer) return;

        currentMonth.textContent = this.monthNames[this.currentDate.getMonth()];
        currentYear.textContent = this.currentDate.getFullYear();
        this.generateDays(daysContainer);
    }

    generateDays(container) {
        container.innerHTML = '';
        const year = this.currentDate.getFullYear();
        const month = this.currentDate.getMonth();
        const today = new Date();
        today.setHours(0,0,0,0); // normalize
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
                currentDate.setHours(0,0,0,0); // normalize

                const dayDiv = document.createElement('div');
                const button = document.createElement('button');
                button.type = 'button';
                button.textContent = currentDate.getDate();

                const isCurrentMonth = currentDate.getMonth() === month;
                const isToday = currentDate.getTime() === today.getTime();
                const isFuture = currentDate > today;
                const isSelected = this.selectedDate && currentDate.getTime() === this.selectedDate.getTime();

                let classes =
                    'm-px size-10 flex justify-center items-center border-[1.5px] border-transparent text-sm rounded-full focus:outline-hidden';

                if (!isCurrentMonth) {
                    classes +=
                        ' text-gray-400 hover:border-primary-600 hover:text-primary-600 disabled:opacity-50 disabled:pointer-events-none';
                    button.disabled = true;
                } else if (isFuture) {
                    classes += ' text-gray-400 opacity-50 cursor-not-allowed';
                    button.disabled = true;
                } else if (isSelected) {
                    classes += ' bg-primary-600 text-white font-medium';
                } else if (isToday) {
                    classes +=
                        ' bg-primary-100 text-primary-600 font-medium hover:bg-primary-600 hover:text-white';
                } else {
                    classes +=
                        ' text-gray-800 hover:border-primary-600 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600';
                }

                button.className = classes;

                if (isCurrentMonth && !isFuture) {
                    button.addEventListener('click', () => {
                        this.selectDate(currentDate, true);
                    });
                }

                dayDiv.appendChild(button);
                weekDiv.appendChild(dayDiv);
            }
            container.appendChild(weekDiv);
        }
    }

    selectDate(date, close = true) {
        this.selectedDate = new Date(date);
        const tanggalInput = document.getElementById('editTanggalInput');
        const tanggalHidden = document.getElementById('editTanggalHidden');
        const datePicker = document.getElementById('editDatePicker');

        if (!tanggalInput || !tanggalHidden || !datePicker) return;

        const day = this.selectedDate.getDate();
        const monthName = this.monthNames[this.selectedDate.getMonth()];
        const year = this.selectedDate.getFullYear();
        const displayDate = `${day} ${monthName} ${year}`;

        tanggalInput.value = displayDate;

        // Format tanggal dengan timezone lokal
        const year_str = this.selectedDate.getFullYear();
        const month_str = String(this.selectedDate.getMonth() + 1).padStart(2, '0');
        const day_str = String(this.selectedDate.getDate()).padStart(2, '0');
        tanggalHidden.value = `${year_str}-${month_str}-${day_str}`;

        if (close) datePicker.classList.add('hidden');
        this.updateCalendar();
    }
}

// Inisialisasi datepicker edit saat modal dibuka
function openEditModal(id, tanggal, jamMasuk, jamPulang, kegiatan) {
    document.getElementById('modalEditLog').classList.remove('hidden');
    document.getElementById('editId').value = id;
    document.getElementById('editWaktuAwal').value = jamMasuk;
    document.getElementById('editWaktuAkhir').value = jamPulang;
    document.getElementById('editDeskripsi').value = kegiatan;

    // Set tanggal pada input dan hidden
    const tanggalInput = document.getElementById('editTanggalInput');
    const tanggalHidden = document.getElementById('editTanggalHidden');
    if (tanggalInput && tanggalHidden) {
        // tanggal format: YYYY-MM-DD
        tanggalHidden.value = tanggal;
        // Tampilkan dalam format lokal
        const dateObj = new Date(tanggal);
        if (!isNaN(dateObj)) {
            const monthNames = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            tanggalInput.value = `${dateObj.getDate()} ${monthNames[dateObj.getMonth()]} ${dateObj.getFullYear()}`;
        } else {
            tanggalInput.value = '';
        }
    }

    // Inisialisasi datepicker edit (hanya sekali)
    if (!window._editDatePickerInstance) {
        window._editDatePickerInstance = new EditCustomDatePicker();
    } else {
        window._editDatePickerInstance.loadExistingDate();
        window._editDatePickerInstance.updateCalendar();
    }
}
</script>