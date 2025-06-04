@extends('layout.template')
@section('content')
    <div class="bg-white flex flex-col space-y-6 rounded-2xl py-6 px-4">


        @if ($magangSelesai)
            @if($feedbackSudahDikirim)
                <!-- Tampilan untuk mahasiswa yang sudah mengirim feedback -->
                <div class="flex flex-col items-center justify-center py-12 px-4 text-center">
                    <svg class="w-20 h-20 text-green-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Feedback Sudah Dikirim</h3>
                    <p class="text-base text-gray-500 max-w-md">
                        Anda sudah mengirimkan feedback untuk program magang ini. Terima kasih atas kontribusi Anda!
                    </p>
                    <a href="{{ route('mahasiswa.dashboard') }}" class="mt-6 btn-secondary">
                        Kembali ke Dashboard
                    </a>
                </div>
            @else
                <span class="font-medium text-xl">
                    <h2>Feedback Mahasiswa</h2>
                </span>
                <form action="{{ route('mahasiswa.feedback.store') }}" method="post" class="flex flex-col gap-6">
                    @csrf
                    <input type="hidden" name="id_magang" value="{{ $magang->id_magang }}">

                    <div class="border border-gray-200 rounded-lg p-4">
                        <p class="text-base font-medium text-neutral-400 mb-2.5">Pertanyaan 1</p>
                        <div class="flex flex-col gap-2.5">
                            <div class="flex justify-between">
                                <label for="komentar" class="text-sm font-medium w-full">Silakan tulis komentar, saran, atau masukan
                                    Anda
                                    terkait magang:</label>
                                <span id="counter" class="text-sm text-gray-500">0/300</span>
                            </div>
                            <div>
                                <textarea
                                    class="rounded-lg border border-gray-200 w-full h-24 text-gray-500 font-medium p-3 resize-y"
                                    placeholder="Tambahkan komentar..." name="komentar" id="komentar" maxlength="300"
                                    required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <p class="text-base font-medium text-neutral-400 mb-2.5">Pertanyaan 2
                        <div class="flex flex-col gap-2.5">
                            <label for="" class="text-sm font-medium w-full mb-6">Beri nilai dari 1 hingga 5 untuk tingkat kepuasan
                                Anda
                                secara
                                keseluruhan terhadap rekomendasi yang diberikan:</label>
                            <div class="flex flex-col gap-y-6">
                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="flex">
                                        <input type="radio" name="rating"
                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none"
                                            value="{{ $i }}" required>
                                        <label for="" class="text-sm font-medium ms-2">{{ $i }}</label>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <p class="text-base font-medium text-neutral-400 mb-2.5">Pertanyaan 3
                        <div class="flex flex-col gap-2.5">
                            <label for="" class="text-sm font-medium w-full mb-6">Apakah Anda merasa puas dengan hasil rekomendasi
                                yang
                                Anda
                                terima?</label>
                            <div class="flex flex-col gap-y-6">
                                @foreach (['Sangat Puas', 'Puas', 'Netral', 'Tidak Puas', 'Sangat Tidak Puas'] as $option)
                                    <div class="flex">
                                        <input type="radio" id="kepuasan-{{ $loop->index }}" name="kepuasan_rekomendasi"
                                            value="{{ $option }}" required
                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                        <label for="kepuasan-{{ $loop->index }}" class="text-sm font-medium ms-2">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <p class="text-base font-medium text-neutral-400 mb-2.5">Pertanyaan 4
                        <div class="flex flex-col gap-2.5">
                            <label for="" class="text-sm font-medium w-full mb-6">Menurut Anda, apakah rekomendasi yang diberikan
                                sesuai
                                dengan kebutuhan atau minat Anda?</label>
                            <div class="flex flex-col gap-y-6">
                                @foreach(['Sangat Sesuai', 'Sesuai', 'Cukup Sesuai', 'Kurang Sesuai', 'Tidak Sesuai'] as $option)
                                    <div class="flex">
                                        <input type="radio" id="kesesuaian-{{ $loop->index }}" name="kesesuaian_rekomendasi"
                                            value="{{ $option }}" required
                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                        <label for="kesesuaian-{{ $loop->index }}"
                                            class="text-sm font-medium ms-2">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        </p>
                    </div>
                    <span class="flex justify-end">
                        <button type="submit" id="submitBtn" class="btn-primary">
                            Kirim Feedback
                        </button>
                    </span>
                </form>
            @endif
        @else
            <!-- Tampilan untuk mahasiswa yang belum menyelesaikan magang -->
            <div class="flex flex-col items-center justify-center py-12 px-4 text-center">
                <svg class="w-20 h-20 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Anda Belum Menyelesaikan Magang</h3>
                <p class="text-base text-gray-500 max-w-md">
                    Form feedback hanya tersedia untuk mahasiswa yang telah menyelesaikan program magang.
                    Silakan selesaikan program magang Anda terlebih dahulu.
                </p>
                <a href="{{ route('mahasiswa.dashboard') }}" class="mt-6 btn-secondary">
                    Kembali ke Dashboard
                </a>
            </div>
        @endif
    </div>

    <!-- Modal overlay untuk transparansi background -->
    <div id="modalOverlay" class="fixed inset-0 bg-white bg-opacity-50 z-40 hidden"></div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 z-50 hidden">
        <div class="overflow-y-auto overflow-x-hidden flex items-center justify-center w-full h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button"
                        class="close-modal absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-green-500 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <h3 class="mb-5 text-lg font-medium text-gray-900">Feedback Berhasil Dikirim</h3>
                        <p class="text-gray-600 mb-5">Terima kasih! Feedback Anda telah berhasil dikirim dan akan membantu
                            meningkatkan kualitas magang.</p>
                        <a href="{{ route('mahasiswa.dashboard') }}" class="btn-primary w-full">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="fixed inset-0 z-50 hidden">
        <div class="overflow-y-auto overflow-x-hidden flex items-center justify-center w-full h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button"
                        class="close-modal absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-red-500 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                        <h3 class="mb-5 text-lg font-medium text-gray-900">Gagal Mengirim Feedback</h3>
                        <p class="text-gray-600 mb-5">Terjadi kesalahan saat mengirim feedback Anda. Silakan coba lagi.</p>
                        <button type="button" class="btn-secondary w-full close-modal">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const textarea = document.getElementById('komentar');
            const counter = document.getElementById('counter');
            const modalOverlay = document.getElementById('modalOverlay');

            if (textarea) {
                textarea.addEventListener('input', function () {
                    const count = this.value.length;
                    counter.textContent = count + '/300';
                });
            }

            // Modal functionality
            const successModal = document.getElementById('successModal');
            const errorModal = document.getElementById('errorModal');
            const closeButtons = document.querySelectorAll('.close-modal');

            // Show success modal if session has success message
            @if(session('success'))
                showModal(successModal);
            @endif

            // Show error modal if session has error message
            @if(session('error'))
                showModal(errorModal);
            @endif

            // Close modal when clicking close button
            closeButtons.forEach(button => {
                button.addEventListener('click', function () {
                    closeModals();
                });
            });

            // Close modal when clicking outside
            if (modalOverlay) {
                modalOverlay.addEventListener('click', function () {
                    closeModals();
                });
            }

            function showModal(modal) {
                modal.classList.remove('hidden');
                modalOverlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeModals() {
                if (successModal) successModal.classList.add('hidden');
                if (errorModal) errorModal.classList.add('hidden');
                if (modalOverlay) modalOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });
    </script>
@endsection