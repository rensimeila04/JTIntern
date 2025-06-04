@extends('layout.template')
@section('content')
    <div class="bg-white flex flex-col space-y-6 rounded-2xl py-6 px-4">

        <span class="font-medium text-xl">
            <h2>Feedback Mahasiswa</h2>
        </span>

        @if ($magangSelesai)
            <form action="{{ route('mahasiswa.feedback.store') }}" method="post" class="flex flex-col gap-6">
                @csrf
                <input type="hidden" name="id_magang" value="{{ $magang->id_magang }}">

                <div class="border border-gray-200 rounded-lg p-4">
                    <p class="text-base font-medium text-neutral-400 mb-2.5">Pertanyaan 1</p>
                    <div class="flex flex-col gap-2.5">
                        <div class="flex justify-between">
                            <label for="" class="text-sm font-medium w-full">Silakan tulis komentar, saran, atau masukan Anda
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
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">1</label>
                            </div>
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">2</label>
                            </div>
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">3</label>
                            </div>
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">4</label>
                            </div>
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">5</label>
                            </div>
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
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">Sangat Puas</label>
                            </div>
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">Puas</label>
                            </div>
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">Netral</label>
                            </div>
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">Tidak Puas</label>
                            </div>
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">Sangat Tidak Puas</label>
                            </div>
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
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">Sangat sesuai</label>
                            </div>
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">Sesuai</label>
                            </div>
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">Cukup Sesuai</label>
                            </div>
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">Tidak Sesuai</label>
                            </div>
                            <div class="flex">
                                <input type="radio" name=""
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 checked:border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                <label for="" class="text-sm font-medium ms-2">Sangat Tidak Sesuai</label>
                            </div>
                        </div>
                    </div>
                    </p>
                </div>
                <span class="flex justify-end">
                    <button type="submit" class="btn-primary">
                        Kirim Feedback
                    </button>
                </span>
            </form>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const textarea = document.getElementById('komentar');
            const counter = document.getElementById('counter');

            if (textarea) {
                textarea.addEventListener('input', function () {
                    const count = this.value.length;
                    counter.textContent = count + '/300';
                });
            }
        });
    </script>
@endsection