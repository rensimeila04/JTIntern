<div id="modalEditLog"
    class="hidden fixed inset-0 z-[90] flex items-center justify-center bg-black bg-opacity-40 transition-opacity duration-300">
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
                <input type="date" name="tanggal_log" id="editTanggal" class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm mb-2">
                <label class="block text-sm font-medium mb-2">Waktu Awal</label>
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