<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('images/logo_icon.png') }}" type="image/png" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'JTIntern' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@900&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <!-- ApexCharts CSS via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.css">
    <!-- Lodash via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <!-- ApexCharts via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
    <!-- Preline ApexCharts Helper via CDN -->
    <script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>
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
        <!-- Include Sidebar -->
        @include('layout.sidebar_admin')

        <!-- Content -->
        <div class="w-full lg:ps-60">
            <!-- Include Header -->
            @include('layout.header')

            @include('layout.breadcrumb')

            <!-- Main Content -->
            <main class="p-6 sm:p-6 md:p-6">
                @yield('content')
            </main>
        </div>
        <!-- End Content -->
    </div>

    <!-- Preline JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof HSOverlay !== 'undefined') {
                HSOverlay.autoInit();
                console.log('HSOverlay initialized');
            } else {
                console.error('HSOverlay not found');
            }
            
            if (typeof HSDropdown !== 'undefined') {
                HSDropdown.autoInit();
            }
        });
    </script>
    @stack('js')
</body>

</html>