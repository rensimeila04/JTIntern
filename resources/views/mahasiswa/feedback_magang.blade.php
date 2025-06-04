@extends('layout.template')
@section('content')
    <div class="bg-white flex flex-col gap-6 rounded-2xl py-6 px-4">
        <span class="font-medium text-xl">
            <h2>Feedback Mahasiswa</h2>
        </span>
        <div class="border border-gray-200 rounded-lg p-4">
            <p class="text-base font-medium text-neutral-400 mb-2.5">Pertanyaan 1</p>
            <div class="flex flex-col gap-2.5">
                <div class="flex justify-between">
                    <label for="" class="text-sm font-medium w-full">Silakan tulis komentar, saran, atau masukan Anda
                        terkait magang:</label>
                    <span class="text-sm text-gray-500">0/100</span>
                </div>
                <div>
                    <textarea
                        class="rounded-lg border border-gray-200 w-full h-24 text-gray-500 font-medium p-3 resize-none"
                        placeholder="Tambahkan komentar..." name="komentar" id="komentar"></textarea>
                </div>
            </div>
        </div>
        <div class="border border-gray-200 rounded-lg p-4">
            <p class="text-base font-medium text-neutral-400 mb-2.5">Pertanyaan 2
            <div class="flex flex-col gap-2.5">
                <label for="" class="text-sm font-medium w-full mb-6">Beri nilai dari 1 hingga 5 untuk tingkat kepuasan Anda
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
                <label for="" class="text-sm font-medium w-full mb-6">Apakah Anda merasa puas dengan hasil rekomendasi yang
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
                <label for="" class="text-sm font-medium w-full mb-6">Menurut Anda, apakah rekomendasi yang diberikan sesuai
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
            <button type="button" id="submitBtn" class="btn-primary">
                Kirim Feedback
            </button>
        </span>
    </div>
@endsection