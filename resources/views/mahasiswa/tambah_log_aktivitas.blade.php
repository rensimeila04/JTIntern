<div id="modalTambahLog"
    class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto bg-black/50 items-center justify-center transition-opacity duration-300">
    <div class="bg-white rounded-lg w-full max-w-lg relative mx-auto my-16 border border-gray-200
        transform transition-all duration-300 scale-95 opacity-0"
        id="modalTambahLogContent">
        <!-- Header -->
        <div class="flex items-center justify-between border-b-1 border-gray-200 p-4">
            <h3 class="text-lg font-semibold text-gray-900">Tambah Log Aktivitas</h3>
            <button type="button" class="text-gray-400 hover:text-gray-800 text-2xl" onclick="closeModal()">
                &times;
            </button>
        </div>
        <!-- Body -->
        <form id="formTambahLog" method="POST" action="{{ route('mahasiswa.log_aktivitas.store') }}">
            @csrf
            <div class="w-full p-4">
                <label class="block text-sm font-medium mb-2">Tanggal</label>
                <div class="relative">
                    <input id="tanggalInput"
                        class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 cursor-pointer"
                        type="text" placeholder="Pilih tanggal">
                    <input type="hidden" name="tanggal_log" id="tanggalHidden" value="{{ old('tanggal_log') }}">
                    <span class="absolute top-1/2 right-4 -translate-y-1/2 text-gray-400 pointer-events-none" tabindex="-1">
                        <i class="ph ph-calendar-days text-xl"></i>
                    </span>
                    @error('tanggal_log')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
    
                    <!-- Custom Date Picker -->
                    <div id="datePicker" class="absolute top-full left-0 mt-2 z-50 hidden">
                        <div
                            class="w-80 flex flex-col bg-white border border-gray-200 shadow-lg rounded-xl overflow-hidden">
                            <div class="p-3 space-y-0.5">
                                <div class="grid grid-cols-5 items-center gap-x-3 mx-1.5 pb-3">
                                    <div class="col-span-1">
                                        <button type="button" id="prevMonth"
                                            class="size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m15 18-6-6 6-6" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-span-3 flex justify-center items-center gap-x-1">
                                        <span id="currentMonth"
                                            class="font-medium text-gray-800 cursor-pointer hover:text-primary-600"></span>
                                        <span class="text-gray-800">/</span>
                                        <span id="currentYear"
                                            class="font-medium text-gray-800 cursor-pointer hover:text-primary-600"></span>
                                    </div>
                                    <div class="col-span-1 flex justify-end">
                                        <button type="button" id="nextMonth"
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
                                <div id="daysContainer" class="space-y-0">
                                    <!-- Days will be generated by JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1">Waktu</label>
                    <div class="flex gap-2">
                        <div class="w-1/2">
                            <input type="time" name="waktu_awal"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:border-primary-500 focus:ring-primary-500"
                                required>
                        </div>
                        <div class="w-1/2">
                            <input type="time" name="waktu_akhir"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:border-primary-500 focus:ring-primary-500"
                                required>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-2.5 mt-4 mb-2">
                    <div class="flex justify-between">
                        <label for="deskripsi" class="text-sm font-medium w-full">Kegiatan</label>
                    </div>
                    <div>
                        <textarea
                            name="deskripsi" id="deskripsi" rows="4" maxlength="100"
                            class="rounded-lg border border-gray-200 w-full text-gray-500 text-sm focus:border-primary-500 focus:ring-primary-500 resize-none"
                            placeholder="Tambahkan kegiatan..."></textarea>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <div class="flex justify-end border-t-1 border-gray-200 p-4">
                <button type="button" onclick="closeModal()" class="btn-secondary mr-2">
                    Batal
                </button>
                <span class="flex justify-end">
                    <button type="submit" id="submitBtn" class="btn-primary">
                        Tambahkan Log Aktivitas
                    </button>
                </span>
            </div>
            <div id="formError" class="text-red-500 mt-2 text-sm hidden"></div>
        </form>
    </div>
</div>

<!-- Modal Notifikasi -->
<div id="notifModal" class="fixed inset-0 z-[80] flex items-center justify-center bg-opacity-40 hidden transition-opacity duration-300">
    <div class="bg-white rounded-lg border border-gray-200 max-w-sm w-full p-6 text-center
        transform transition-all duration-300 scale-95 opacity-0"
        id="notifModalContent">
        <div id="notifIcon" class="mb-3 text-xl"></div>
        <div id="notifMessage" class="text-base font-medium mb-4"></div>
        <button type="button" onclick="closeNotif()" class="btn-primary px-4 py-2 rounded">
            Tutup
        </button>
    </div>
</div>

<script>

    function openModal() {
        const modal = document.getElementById('modalTambahLog');
        const content = document.getElementById('modalTambahLogContent');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }
    function closeModal() {
        const modal = document.getElementById('modalTambahLog');
        const content = document.getElementById('modalTambahLogContent');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            document.getElementById('formTambahLog').reset();
            document.getElementById('formError').classList.add('hidden');
        }, 300);
    }

    function showNotif(message, success = true) {
        closeModal();
        const notifModal = document.getElementById('notifModal');
        const notifContent = document.getElementById('notifModalContent');
        const notifMessage = document.getElementById('notifMessage');
        const notifIcon = document.getElementById('notifIcon');
        notifMessage.textContent = message;
        notifIcon.innerHTML = success
            ? '<span class="text-green-500">&#10003;</span>'
            : '<span class="text-red-500">&#9888;</span>';
        notifModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        setTimeout(() => {
            notifContent.classList.remove('scale-95', 'opacity-0');
            notifContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }
    function closeNotif() {
        const notifModal = document.getElementById('notifModal');
        const notifContent = document.getElementById('notifModalContent');
        notifContent.classList.remove('scale-100', 'opacity-100');
        notifContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            notifModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    }

    // AJAX submit
    document.getElementById('formTambahLog').addEventListener('submit', function (e) {
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
                    showNotif('Log aktivitas berhasil disimpan!', true);
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showNotif(res.message || 'Terjadi kesalahan.', false);
                }
            })
            .catch(err => {
                showNotif('Terjadi kesalahan.', false);
            });
    });

    // Tutup modal jika klik di luar konten modal
    document.getElementById('modalTambahLog').addEventListener('click', function (e) {
        if (e.target === this) closeModal();
    });

    document.addEventListener('DOMContentLoaded', function() {
        new CustomDatePicker();
    });
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
            const tanggalHidden = document.getElementById('tanggalHidden');
            if (tanggalHidden && tanggalHidden.value) {
                const existingDate = new Date(tanggalHidden.value);
                this.selectDate(existingDate);
            }
        }

        bindEvents() {
            const tanggalInput = document.getElementById('tanggalInput');
            const datePicker = document.getElementById('datePicker');
            const prevMonth = document.getElementById('prevMonth');
            const nextMonth = document.getElementById('nextMonth');

            if (!tanggalInput || !datePicker || !prevMonth || !nextMonth) return;

            tanggalInput.addEventListener('click', () => {
                datePicker.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (!tanggalInput.contains(e.target) && !datePicker.contains(e.target)) {
                    datePicker.classList.add('hidden');
                }
            });

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
            const tanggalInput = document.getElementById('tanggalInput');
            const tanggalHidden = document.getElementById('tanggalHidden');
            const datePicker = document.getElementById('datePicker');

            if (!tanggalInput || !tanggalHidden || !datePicker) return;

            const day = this.selectedDate.getDate();
            const monthName = this.monthNames[this.selectedDate.getMonth()];
            const year = this.selectedDate.getFullYear();
            const displayDate = `${day} ${monthName} ${year}`;

            tanggalInput.value = displayDate;
            tanggalHidden.value = this.selectedDate.toISOString().split('T')[0];
            datePicker.classList.add('hidden');
            this.updateCalendar();
        }
    }

    document.querySelectorAll('input[type="time"]').forEach(function(input) {
        input.addEventListener('focus', function() {
            const datePicker = document.getElementById('datePicker');
            if (datePicker) datePicker.classList.add('hidden');
        });
    });
</script>
