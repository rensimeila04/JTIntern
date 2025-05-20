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
        <a href="/admin/dashboard"
            class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ $activeMenu == 'dashboard' ? 'bg-primary-100' : '' }}">
            <x-lucide-house class="size-6 {{ $activeMenu == 'dashboard' ? 'text-primary-600' : 'text-neutral-500' }} group-hover:text-primary-600" stroke-width="1.5" />
            <div class="{{ $activeMenu == 'dashboard' ? 'text-primary-600' : 'text-neutral-500' }} text-base font-normal group-hover:text-primary-600">Dashboard</div>
        </a>

        <!-- Manajemen Pengguna Section -->
        <div class="flex flex-col gap-2">
            <p class="text-neutral-400 text-xs font-medium">Manajemen Pengguna</p>
            <div class="flex flex-col gap-2">
                <a href="/admin/level"
                    class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ $activeMenu == 'level-pengguna' ? 'bg-primary-100' : '' }}">
                    <x-lucide-group class="size-6 {{ $activeMenu == 'level-pengguna' ? 'text-primary-600' : 'text-neutral-500' }} group-hover:text-primary-600"
                        stroke-width="1.5" />
                    <div class="{{ $activeMenu == 'level-pengguna' ? 'text-primary-600' : 'text-neutral-500' }} text-base font-normal group-hover:text-primary-600">Level
                        Pengguna</div>
                </a>
                <a href="/admin/pengguna"
                    class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ $activeMenu == 'pengguna' ? 'bg-primary-100' : '' }}">
                    <x-lucide-users class="size-6 {{ $activeMenu == 'pengguna' ? 'text-primary-600' : 'text-neutral-500' }} group-hover:text-primary-600"
                        stroke-width="1.5" />
                    <div class="{{ $activeMenu == 'pengguna' ? 'text-primary-600' : 'text-neutral-500' }} text-base font-normal group-hover:text-primary-600">Pengguna
                    </div>
                </a>
            </div>
        </div>

        <!-- Mitra dan Institusi Section -->
        <div class="flex flex-col gap-2">
            <p class="text-neutral-400 text-xs font-medium">Mitra dan Institusi</p>
            <div class="flex flex-col gap-2">
                <a href="/admin/perusahaan-mitra"
                    class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ $activeMenu == 'perusahaan-mitra' ? 'bg-primary-100' : '' }}">
                    <x-lucide-building-2 class="size-6 {{ $activeMenu == 'perusahaan-mitra' ? 'text-primary-600' : 'text-neutral-500' }} group-hover:text-primary-600"
                        stroke-width="1.5" />
                    <div class="{{ $activeMenu == 'perusahaan-mitra' ? 'text-primary-600' : 'text-neutral-500' }} text-base font-normal group-hover:text-primary-600">Perusahaan
                        Mitra</div>
                </a>
                <a href="/admin/program-studi"
                    class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ $activeMenu == 'program-studi' ? 'bg-primary-100' : '' }}">
                    <x-lucide-graduation-cap class="size-6 {{ $activeMenu == 'program-studi' ? 'text-primary-600' : 'text-neutral-500' }} group-hover:text-primary-600"
                        stroke-width="1.5" />
                    <div class="{{ $activeMenu == 'program-studi' ? 'text-primary-600' : 'text-neutral-500' }} text-base font-normal group-hover:text-primary-600">Program
                        Studi</div>
                </a>
            </div>
        </div>

        <!-- Manajemen Magang Section -->
        <div class="flex flex-col gap-2">
            <p class="text-neutral-400 text-xs font-medium">Manajemen Magang</p>
            <div class="flex flex-col gap-2">
                <a href="/admin/periode-magang"
                    class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ $activeMenu == 'periode-magang' ? 'bg-primary-100' : '' }}">
                    <x-lucide-calendar-days class="size-6 {{ $activeMenu == 'periode-magang' ? 'text-primary-600' : 'text-neutral-500' }} group-hover:text-primary-600"
                        stroke-width="1.5" />
                    <div class="{{ $activeMenu == 'periode-magang' ? 'text-primary-600' : 'text-neutral-500' }} text-base font-normal group-hover:text-primary-600">Periode
                        Magang</div>
                </a>
                <a href="/admin/lowongan"
                    class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ $activeMenu == 'lowongan' ? 'bg-primary-100' : '' }}">
                    <x-lucide-briefcase class="size-6 {{ $activeMenu == 'lowongan' ? 'text-primary-600' : 'text-neutral-500' }} group-hover:text-primary-600"
                        stroke-width="1.5" />
                    <div class="{{ $activeMenu == 'lowongan' ? 'text-primary-600' : 'text-neutral-500' }} text-base font-normal group-hover:text-primary-600">Lowongan
                    </div>
                </a>
                <a href="/admin/kelola-magang"
                    class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ $activeMenu == 'kelola-magang' ? 'bg-primary-100' : '' }}">
                    <x-lucide-clipboard-list class="size-6 {{ $activeMenu == 'kelola-magang' ? 'text-primary-600' : 'text-neutral-500' }} group-hover:text-primary-600"
                        stroke-width="1.5" />
                    <div class="{{ $activeMenu == 'kelola-magang' ? 'text-primary-600' : 'text-neutral-500' }} text-base font-normal group-hover:text-primary-600">Kelola
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