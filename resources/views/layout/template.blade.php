<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('images/logo_icon.png') }}" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'JTIntern' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@900&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
</head>

<body class="bg-neutral-50">
    <!-- Navigation Toggle for mobile -->
    <div class="lg:hidden fixed top-4 left-4 z-[70]">
        <button type="button"
            class="py-2 px-3 inline-flex justify-center items-center gap-x-2 bg-white border border-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow-sm hover:bg-gray-50"
            aria-haspopup="dialog" aria-expanded="false" aria-controls="sidebar" aria-label="Toggle navigation"
            data-hs-overlay="#sidebar">
            <i class="ph ph-list"></i>
            <span>Menu</span>
        </button>
    </div>

    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="hs-overlay [--auto-close:lg] lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 w-60 -translate-x-full transition-all duration-300 transform fixed top-0 start-0 bottom-0 z-[60] bg-white border-r border-neutral-100 overflow-y-auto">
            <!-- Header/Logo -->
            <div class="h-fit px-4 py-6 ">
                <div class="h-fit w-full items-center flex justify-center">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-9">
                </div>
            </div>

            <!-- Sidebar body with menu -->
            <div class="px-4 py-6 flex flex-col gap-4">
                <!-- Dashboard -->
                <a href="/dashboard"
                    class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ request()->is('dashboard') ? 'bg-primary-100' : '' }}">
                    <x-lucide-house class="size-6 text-neutral-500 group-hover:text-primary-600" stroke-width="1.5" />
                    <div class="text-neutral-500 text-base font-normal group-hover:text-primary-600">Dashboard</div>
                </a>

                <!-- Manajemen Pengguna Section -->
                <div class="flex flex-col gap-2">
                    <p class="text-neutral-400 text-xs font-medium">Manajemen Pengguna</p>
                    <div class="flex flex-col gap-2">
                        <a href="/level-pengguna"
                            class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ request()->is('level-pengguna') ? 'bg-primary-100' : '' }}">
                            <x-lucide-group class="size-6 text-neutral-500 group-hover:text-primary-600"
                                stroke-width="1.5" />
                            <div class="text-neutral-500 text-base font-normal group-hover:text-primary-600">Level
                                Pengguna</div>
                        </a>
                        <a href="/pengguna"
                            class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ request()->is('pengguna') ? 'bg-primary-100' : '' }}">
                            <x-lucide-users class="size-6 text-neutral-500 group-hover:text-primary-600"
                                stroke-width="1.5" />
                            <div class="text-neutral-500 text-base font-normal group-hover:text-primary-600">Pengguna
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Mitra dan Institusi Section -->
                <div class="flex flex-col gap-2">
                    <p class="text-neutral-400 text-xs font-medium">Mitra dan Institusi</p>
                    <div class="flex flex-col gap-2">
                        <a href="/perusahaan-mitra"
                            class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ request()->is('perusahaan-mitra') ? 'bg-primary-100' : '' }}">
                            <x-lucide-building-2 class="size-6 text-neutral-500 group-hover:text-primary-600"
                                stroke-width="1.5" />
                            <div class="text-neutral-500 text-base font-normal group-hover:text-primary-600">Perusahaan
                                Mitra</div>
                        </a>
                        <a href="/program-studi"
                            class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ request()->is('program-studi') ? 'bg-primary-100' : '' }}">
                            <x-lucide-graduation-cap class="size-6 text-neutral-500 group-hover:text-primary-600"
                                stroke-width="1.5" />
                            <div class="text-neutral-500 text-base font-normal group-hover:text-primary-600">Program
                                Studi</div>
                        </a>
                    </div>
                </div>

                <!-- Manajemen Magang Section -->
                <div class="flex flex-col gap-2">
                    <p class="text-neutral-400 text-xs font-medium">Manajemen Magang</p>
                    <div class="flex flex-col gap-2">
                        <a href="/periode-magang"
                            class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ request()->is('periode-magang') ? 'bg-primary-100' : '' }}">
                            <x-lucide-calendar-days class="size-6 text-neutral-500 group-hover:text-primary-600"
                                stroke-width="1.5" />
                            <div class="text-neutral-500 text-base font-normal group-hover:text-primary-600">Periode
                                Magang</div>
                        </a>
                        <a href="/lowongan"
                            class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ request()->is('lowongan') ? 'bg-primary-100' : '' }}">
                            <x-lucide-briefcase class="size-6 text-neutral-500 group-hover:text-primary-600"
                                stroke-width="1.5" />
                            <div class="text-neutral-500 text-base font-normal group-hover:text-primary-600">Lowongan
                            </div>
                        </a>
                        <a href="/kelola-magang"
                            class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ request()->is('kelola-magang') ? 'bg-primary-100' : '' }}">
                            <x-lucide-clipboard-list class="size-6 text-neutral-500 group-hover:text-primary-600"
                                stroke-width="1.5" />
                            <div class="text-neutral-500 text-base font-normal group-hover:text-primary-600">Kelola
                                Magang</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile close button -->
            <div class="lg:hidden absolute top-4 right-4">
                <button type="button"
                    class="flex justify-center items-center size-8 text-gray-600 hover:bg-gray-100 rounded-full"
                    data-hs-overlay="#sidebar">
                    <i class="ph ph-x text-lg"></i>
                </button>
            </div>
        </aside>
        <!-- End Sidebar -->

        <!-- Content -->
        <div class="w-full lg:ps-60">
            <!-- Header -->
            <header
                class="sticky top-0 inset-x-0 flex flex-wrap sm:justify-start sm:flex-nowrap z-[48] w-full bg-white border-b border-neutral-100 text-sm py-2.5 sm:py-4 lg:ps-60 h-21">
                <nav class="flex basis-full items-center w-full mx-auto px-4 sm:px-6 md:px-8" aria-label="Global">
                    <div class="flex items-center justify-end w-full gap-4">

                        <!-- Notification Icon -->
                        <div class="size-10 p-2 bg-white rounded-[100px] outline-1 outline-offset-[-1px] outline-neutral-200 flex justify-start items-center">
                            <div class="size-6 relative overflow-hidden">
                                <x-lucide-bell-dot class="size-6 text-neutral-500" stroke-width="1.5" />
                            </div>
                        </div>

                        <!-- User Menu -->
                        <div class="self-stretch py-4 flex justify-start items-center gap-2">
                            <img class="size-9 rounded-full" src="https://randomuser.me/api/portraits/men/33.jpg" alt="User profile">
                            <div>
                                <div class="text-black text-xs font-medium">Rizky Wahyu</div>
                                <div class="text-neutral-400 text-xs">Administrator</div>
                            </div>
                            <x-lucide-chevron-down class="size-6 text-neutral-400" stroke-width="1.5" />
                        </div>
                    </div>
                </nav>
            </header>
            <!-- End Header -->

            <!-- Main Content -->
            <main class="p-4 sm:p-6 md:p-8">
                @yield('content')
            </main>
        </div>
        <!-- End Content -->
    </div>

    <!-- Preline JS -->
    <script>
        // Required for Preline dropdown and other components to work correctly
        document.addEventListener('DOMContentLoaded', () => {
            HSOverlay.autoInit();
            HSDropdown.autoInit();
        });
    </script>
</body>

</html>
