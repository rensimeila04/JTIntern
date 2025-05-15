<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('images/logo_icon.png') }}" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - JTIntern</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="h-screen w-full p-6 flex items-center justify-center space-x-6">
        <div class="w-1/2 px-20 h-full overflow-y-auto mt-4 space-y-12.5">
            <a href="#"
                class="flex items-center flex-row space-x-2 text-neutral-500 hover:text-primary-500 font-medium ">
                <i class="ph ph-arrow-left"></i>
                <span>Kembali</span>
            </a>
            <div class="mx-4 flex flex-col justify-center min-h-[80vh]">
                <div class="space-y-2">
                    <h1 class="font-medium text-neutral-900 text-4xl">Masuk ke JTIntern.</h1>
                    <p class="text-normal text-normal text-neutral-500">Masuk dan lanjutkan aktivitas Anda.</p>
                </div>
                <form method="POST" action="#" class="mt-8 space-y-5">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" placeholder="Masukkan email"
                            class="form-input-lg" required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" placeholder="Masukkan kata sandi"
                                class="form-input-lg" required>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember" class="mr-2">
                            <label for="remember" class="text-neutral-500">Ingat Saya</label>
                        </div>
                        <a href="#" class="text-primary-500 font-medium hover:underline">Lupa Kata Sandi?</a>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-primary-500 hover:bg-primary-600 text-white font-medium py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                            Masuk
                        </button>
                    </div>

                    <div>
                        <span class="text-neutral-500">Belum memiliki akun? </span>
                        <a href="#" class="text-primary-500 font-medium hover:underline">Daftar Sekarang</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-1/2 bg-primary-500 h-full rounded-2xl relative overflow-hidden">
            <div class="space-y-12">
                <div class="flex items-center justify-center mt-8">
                    <img src="{{ asset('images/logotext_white.svg') }}" alt="JTIntern Logo" class="h-10">
                </div>
                <div class="px-20 space-y-2">
                    <h1 class="text-4xl text-white font-medium">Temukan Magang Terbaik Sesuai Minat dan Keahlian</h1>
                    <p class="text-base text-white font-normal">Masuk ke akunmu dan temukan lowongan yang sesuai dengan
                        minat dan keahlianmu.</p>
                </div>
            </div>

            <div class="w-[834.97px] p-2.5 left-[116px] top-[453px] absolute opacity-90 rounded-3xl outline-1 outline-primary-200">
                <img src="{{ asset('images/konten_dashboard.png') }}" alt="Dashboard Preview" class="self-stretch rounded-3xl border-1 border-neutral-300 opacity-90">
            </div>
            <div
                class="w-96 p-2 left-[67px] top-[394px] absolute rounded-2xl outline-1 outline-primary-200">
                <div
                    class="self-stretch flex-1 px-2.5 py-4 bg-white rounded-lg shadow-md outline-1 outline-primary-200 flex flex-col gap-3.5">
                    <img src="{{ asset('images/konten2.svg') }}" alt="Analytics Chart" class="w-full">
                </div>
            </div>
        </div>
    </div>
</body>
</html>