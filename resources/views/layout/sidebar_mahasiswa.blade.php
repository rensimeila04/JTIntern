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
        <a href="{{ route('mahasiswa.dashboard') }}"
            class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ ($activeMenu ?? '') == 'dashboard' ? 'bg-primary-100' : '' }}">
            <x-lucide-house class="size-6 {{ ($activeMenu ?? '') == 'dashboard' ? 'text-primary-600' : 'text-neutral-500' }} group-hover:text-primary-600" stroke-width="1.5" />
            <div class="{{ ($activeMenu ?? '') == 'dashboard' ? 'text-primary-600' : 'text-neutral-500' }} text-base font-normal group-hover:text-primary-600">Dashboard</div>
        </a>

        <!-- Manajemen Magang Section -->
        <div class="flex flex-col gap-2">
            <p class="text-neutral-400 text-xs font-medium">Manajemen Magang</p>
            <div class="flex flex-col gap-2">
                <a href="{{ route('mahasiswa.lowongan') }}"
                    class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ ($activeMenu ?? '') == 'lowongan' ? 'bg-primary-100' : '' }}">
                    <x-lucide-briefcase class="size-6 {{ ($activeMenu ?? '') == 'lowongan' ? 'text-primary-600' : 'text-neutral-500' }} group-hover:text-primary-600"
                        stroke-width="1.5" />
                    <div class="{{ ($activeMenu ?? '') == 'lowongan' ? 'text-primary-600' : 'text-neutral-500' }} text-base font-normal group-hover:text-primary-600">Lowongan
                    </div>
                </a>
                <a href="#"
                    class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ ($activeMenu ?? '') == 'rincian-magang' ? 'bg-primary-100' : '' }}">
                    <x-lucide-file-text class="size-6 {{ ($activeMenu ?? '') == 'rincian-magang' ? 'text-primary-600' : 'text-neutral-500' }} group-hover:text-primary-600"
                        stroke-width="1.5" />
                    <div class="{{ ($activeMenu ?? '') == 'rincian-magang' ? 'text-primary-600' : 'text-neutral-500' }} text-base font-normal group-hover:text-primary-600">Rincian
                        Magang</div>
                </a>
                <a href="#"
                    class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ ($activeMenu ?? '') == 'log-aktivitas' ? 'bg-primary-100' : '' }}">
                    <x-lucide-activity class="size-6 {{ ($activeMenu ?? '') == 'log-aktivitas' ? 'text-primary-600' : 'text-neutral-500' }} group-hover:text-primary-600"
                        stroke-width="1.5" />
                    <div class="{{ ($activeMenu ?? '') == 'log-aktivitas' ? 'text-primary-600' : 'text-neutral-500' }} text-base font-normal group-hover:text-primary-600">Log
                        Aktivitas</div>
                </a>
                <a href="{{ route('mahasiswa.feedback') }}"
                    class="p-2 flex items-center gap-2 hover:bg-primary-100 rounded-lg group {{ ($activeMenu ?? '') == 'log-aktivitas' ? 'bg-primary-100' : '' }}">
                    <x-lucide-message-square-plus class="size-6 {{ ($activeMenu ?? '') == 'log-aktivitas' ? 'text-primary-600' : 'text-neutral-500' }} group-hover:text-primary-600"
                        stroke-width="1.5" />
                    <div class="{{ ($activeMenu ?? '') == 'log-aktivitas' ? 'text-primary-600' : 'text-neutral-500' }} text-base font-normal group-hover:text-primary-600">Feedback
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