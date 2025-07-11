<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('images/logo_icon.png') }}" type="image/png" />
    <title>JTIntern - Magang JTI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css" />
</head>

<body>
    {{-- Navbar --}}
    <nav id="navbar"
        class="flex items-center justify-between bg-white px-4 sm:px-8 lg:px-20 py-4 lg:py-6 w-full z-50 transition-all duration-300">
        {{-- logo --}}
        <img src="{{ asset('Images/logo.svg') }}" alt="Logo" class="h-6 sm:h-8">
        
        {{-- Mobile menu button --}}
        <button id="mobile-menu-button" class="lg:hidden text-neutral-500 hover:text-primary-500">
            <i class="ph ph-list text-2xl"></i>
        </button>
        
        {{-- menu --}}
        <ul id="navbar-menu" class="hidden lg:flex space-x-4 xl:space-x-8 text-sm xl:text-base">
            <li><a href="#beranda" class="text-primary-500 font-semibold nav-link">Beranda</a></li>
            <li><a href="#tentang"
                    class="text-neutral-500 font-normal hover:text-primary-500 hover:font-semibold nav-link">Tentang</a>
            </li>
            <li><a href="#fitur"
                    class="text-neutral-500 font-normal hover:text-primary-500 hover:font-semibold nav-link">Fitur</a>
            </li>
            <li><a href="#panduan"
                    class="text-neutral-500 font-normal hover:text-primary-500 hover:font-semibold nav-link">Panduan</a>
            </li>
        </ul>
        
        {{-- Mobile menu --}}
        <div id="mobile-menu" class="hidden lg:hidden fixed top-16 left-0 right-0 bg-white shadow-lg z-40 py-4">
            <ul class="flex flex-col space-y-4 px-4">
                <li><a href="#beranda" class="text-primary-500 font-semibold nav-link block py-2">Beranda</a></li>
                <li><a href="#tentang" class="text-neutral-500 font-normal hover:text-primary-500 hover:font-semibold nav-link block py-2">Tentang</a></li>
                <li><a href="#fitur" class="text-neutral-500 font-normal hover:text-primary-500 hover:font-semibold nav-link block py-2">Fitur</a></li>
                <li><a href="#panduan" class="text-neutral-500 font-normal hover:text-primary-500 hover:font-semibold nav-link block py-2">Panduan</a></li>
            </ul>
        </div>
        
        {{-- button --}}
        <div class="hidden lg:flex space-x-2 xl:space-x-4">
            @auth
                @php
                    $dashboardRoute = match(auth()->user()->level->kode_level) {
                        'ADM' => 'admin.dashboard',
                        'DSP' => 'dosen.dashboard', 
                        'MHS' => 'mahasiswa.dashboard',
                        default => 'landing'
                    };
                @endphp
                <a href="{{ route($dashboardRoute) }}" class="btn-primary text-sm xl:text-base px-3 xl:px-4 py-2">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-secondary text-sm xl:text-base px-3 xl:px-4 py-2">Masuk</a>
                <a href="{{ route('register') }}" class="btn-primary text-sm xl:text-base px-3 xl:px-4 py-2">Mulai Sekarang</a>
            @endauth
        </div>
    </nav>

    {{-- Empty div as placeholder when navbar becomes fixed --}}
    <div id="navbar-placeholder" class="hidden h-0"></div>

    {{-- Hero --}}
    <div id="beranda"
        class="bg-gradient-to-b from-[#DEECE200] to-[#BEDCC6] h-screen w-full flex flex-col items-center mt-24 overflow-hidden">
        <p class="text-4xl font-semibold text-center text-neutral-900 animate-fade-in-up delay-100">
            Temukan <span class="text-primary-500">Rekomendasi Magang</span> yang Paling Sesuai dengan<br>Minat,
            Keahlian, dan Tujuan Kariermu
        </p>
        <p class="text-base text-neutral-500 font-medium text-center mt-6 animate-fade-in-up delay-200">Dapatkan
            rekomendasi magang yang
            dipersonalisasi berdasarkan minat, keahlian,<br>dan rencana kariermu untuk membantumu berkembang di
            jalur
            yang tepat.</p>
        <a href="{{ route('register') }}" class="mt-6 btn-primary-animated animate-fade-in-up delay-300">
            Mulai Sekarang
        </a>
        <div class="mt-15 p-3 outline-1 rounded-3xl outline-primary-200 animate-fade-in-up delay-500">
            <img src="{{ asset('images/konten_dashboard.png') }}" alt="Hero Illustration"
                class="h-auto object-center object-cover w-[903px] border-1 rounded-3xl border-primary-200">
        </div>
        <img class="w-90 left-27 top-149 absolute animate-on-scroll animate-float" data-animation="animate-fade-in-left"
            src="{{ asset('images/card_konten1.svg') }}" />
        <img class="w-60 left-267 top-180 absolute animate-on-scroll animate-float-reverse"
            data-animation="animate-fade-in-right" src="{{ asset('images/card_konten2.svg') }}" />
    </div>

    {{-- Tentang --}}
    <div id="tentang" class="bg-white min-h-screen w-full flex flex-col lg:flex-row justify-between items-center px-4 sm:px-8 lg:px-20 py-12 lg:py-0 gap-8 lg:gap-0">
        <div class="space-y-6 w-full lg:w-[521px] animate-on-scroll order-2 lg:order-1" data-animation="animate-fade-in-right">
            <p class="font-semibold text-2xl sm:text-3xl lg:text-4xl text-neutral-900 text-center lg:text-left">
                <span class="text-primary-500">Temukan, Lamar, dan Mulai</span>
                <br>Magangmu dengan Lebih<br class="hidden lg:block">Mudah
            </p>
            <p class="font-normal text-sm sm:text-base text-neutral-500 text-center lg:text-left leading-relaxed">
                Dengan JTIntern, menemukan tempat magang yang sesuai jadi lebih cepat dan tepat. Nikmati pengalaman mencari magang yang lebih praktis lewat rekomendasi berbasis profilmu. Pantau setiap langkah perjalananmu, dapatkan insight untuk berkembang, dan siapkan diri menyambut dunia kerja dengan lebih percaya diri.
            </p>
        </div>
        <div class="w-full max-w-[627px] sm:max-w-[600px] lg:w-[627px] h-[300px] sm:h-[400px] lg:h-[627px] bg-neutral-50 rounded-2xl animate-on-scroll order-1 lg:order-2 relative flex items-center justify-center" data-animation="animate-fade-in-left">
            <img class="w-[85%] h-[85%] object-contain" src="{{ asset('images/konten3.svg') }}" alt="Content Illustration" />
        </div>
    </div>

    {{-- Fitur --}}
    <div id="fitur" class="bg-white h-fit w-full px-20 py-24 space-y-22">
        <div class="space-y-4 flex flex-col items-center animate-on-scroll" data-animation="animate-fade-in-up">
            <div class="space-x-2 flex items-center w-fit rounded-full outline-1 outline-primary-200 px-6 py-2">
                <i class="ph-fill ph-lightning text-primary-500 text-xl"></i>
                <p class="text-base text-neutral-900">Fitur Unggulan</p>
            </div>
            <p class="text-4xl text-neutral-900 font-semibold text-center">Persiapkan magangmu dengan fitur pintar!</p>
            <p class="text-center text-base text-neutral-500">Sistem terintegrasi untuk pencarian,
                pengelolaan, dan evaluasi magang, memungkinkan mahasiswa menemukan peluang yang sesuai, mengajukan
                lamaran dengan mudah, serta memantau perkembangan dalam satu platform.</p>
        </div>
        {{-- show fitur --}}
        <div class="space-y-4">
            <!-- First row - 2 cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="w-full h-auto min-h-[280px] sm:min-h-[320px] lg:h-110 bg-neutral-50 rounded-2xl py-6 px-6 animate-on-scroll hover-scale hover-shadow relative overflow-hidden flex flex-col justify-between"
                    data-animation="animate-zoom-in">
                    <div class="space-y-2 z-10 relative">
                        <p class="font-medium text-xl sm:text-2xl text-neutral-900">Rekomendasi Magang</p>
                        <p class="font-normal text-sm sm:text-base text-neutral-500">Sistem pendukung keputusan mempermudah pencarian magang sesuai keahlian.</p>
                    </div>
                    <img class="w-145 sm:w-80 lg:w-145 absolute right-2 bottom-2 sm:right-4 sm:bottom-4 lg:left-8 lg:top-38" 
                         src="{{ asset('images/fitur1.svg') }}" alt="Rekomendasi Magang" />
                </div>
                
                <div class="w-full h-auto min-h-[280px] sm:min-h-[320px] lg:h-110 bg-neutral-50 rounded-2xl py-6 px-6 animate-on-scroll hover-scale hover-shadow relative overflow-hidden flex flex-col justify-between"
                    data-animation="animate-zoom-in">
                    <div class="space-y-2 z-10 relative">
                        <p class="font-medium text-xl sm:text-2xl text-neutral-900">Manajemen Pengajuan Magang</p>
                        <p class="font-normal text-sm sm:text-base text-neutral-500">Ajukan lamaran, pantau status, dan terima notifikasi dalam satu platform.</p>
                    </div>
                    <img class="w-122 h-32 sm:w-75 sm:h-40 lg:w-122 lg:h-64 absolute right-4 bottom-2 sm:right-6 sm:bottom-4 lg:left-18 lg:top-30" 
                         src="{{ asset('images/fitur2.svg') }}" alt="Manajemen Pengajuan Magang" />
                </div>
            </div>

            <!-- Second row - 3 cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="w-full h-auto min-h-[280px] sm:min-h-[320px] lg:h-110 bg-neutral-50 rounded-2xl py-6 px-6 flex flex-col justify-end animate-on-scroll hover-scale hover-shadow relative overflow-hidden"
                    data-animation="animate-zoom-in">
                    <img class="w-65 sm:w-75 lg:w-80 lg:h-60 absolute left-4 top-4 sm:left-6 sm:top-6 lg:left-[32px] lg:top-[32px]" 
                         src="{{ asset('images/fitur3.svg') }}" alt="Monitoring & Evaluasi Magang" />
                    <div class="relative z-10 space-y-2 mt-16 sm:mt-20 lg:mt-0">
                        <p class="font-medium text-xl sm:text-2xl text-neutral-900">Monitoring & Evaluasi Magang</p>
                        <p class="font-normal text-sm sm:text-base text-neutral-500">Catat progres, isi log aktivitas, dan dapatkan evaluasi dari dosen pembimbing.</p>
                    </div>
                </div>
                
                <div class="w-full h-auto min-h-[280px] sm:min-h-[320px] lg:h-110 bg-neutral-50 rounded-2xl py-6 px-6 flex flex-col justify-end animate-on-scroll hover-scale hover-shadow relative overflow-hidden"
                    data-animation="animate-zoom-in">
                    <img class="w-60 sm:w-65 lg:w-96 lg:h-64 absolute left-4 top-4 sm:left-6 sm:top-6 lg:left-[23.33px] lg:top-[21px]" 
                         src="{{ asset('images/fitur4.svg') }}" alt="Platform Kolaborasi" />
                    <div class="relative z-10 space-y-2 mt-16 sm:mt-20 lg:mt-0">
                        <p class="font-medium text-xl sm:text-2xl text-neutral-900">Platform Kolaborasi</p>
                        <p class="font-normal text-sm sm:text-base text-neutral-500">Mahasiswa, dosen, dan koordinator magang terhubung untuk komunikasi efektif.</p>
                    </div>
                </div>
                
                <div class="w-full h-auto min-h-[280px] sm:min-h-[320px] lg:h-110 bg-neutral-50 rounded-2xl py-6 px-6 flex flex-col justify-end animate-on-scroll hover-scale hover-shadow relative overflow-hidden md:col-span-2 lg:col-span-1"
                    data-animation="animate-zoom-in">
                    <img class="w-65 sm:w-70 lg:w-96 lg:h-72 absolute left-4 top-4 sm:left-6 sm:top-6 lg:left-[14.67px] lg:top-[32px]" 
                         src="{{ asset('images/fitur5.svg') }}" alt="Analisis & Laporan" />
                    <div class="relative z-10 space-y-2 mt-16 sm:mt-20 lg:mt-0">
                        <p class="font-medium text-xl sm:text-2xl text-neutral-900">Analisis & Laporan</p>
                        <p class="font-normal text-sm sm:text-base text-neutral-500">Pantau efektivitas magang dengan data terintegrasi dan laporan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Panduan --}}
    <div id="panduan" class="bg-white h-fit w-full px-4 sm:px-8 lg:px-20 py-12 sm:py-16 lg:py-24 space-y-12 sm:space-y-16 lg:space-y-22">
        <div class="space-y-4 flex flex-col items-center animate-on-scroll" data-animation="animate-fade-in-up">
            <div class="space-x-2 flex items-center w-fit rounded-full outline-1 outline-primary-200 px-4 sm:px-6 py-2">
                <i class="ph-fill ph-book-open text-primary-500 text-lg sm:text-xl"></i>
                <p class="text-sm sm:text-base text-neutral-900">Panduan Singkat</p>
            </div>
            <p class="text-2xl sm:text-3xl lg:text-4xl text-neutral-900 font-semibold text-center leading-tight">Maksimalkan Sistem Rekomendasi Magang</p>
            <p class="text-center text-sm sm:text-base text-neutral-500 max-w-2xl px-4">Temukan peluang magang yang sesuai dengan minat dan
                keahlianmu, ajukan lamaran dengan mudah, dan pantau secara real-time dalam satu sistem terintegrasi.
            </p>
        </div>
        {{-- show panduan --}}
        @php
            $steps = [
                [
                    'title' => 'Mulai dengan Profil',
                    'desc' => 'Lengkapi profil untuk rekomendasi magang terbaik.',
                ],
                [
                    'title' => 'Cari dan Ajukan Magang',
                    'desc' => 'Temukan magang, ajukan lamaran, dan pantau status.',
                ],
                [
                    'title' => 'Kelola dan Pantau Progres',
                    'desc' => 'Catat aktivitas, pantau progres, dan terima evaluasi.',
                ],
                [
                    'title' => 'Selesaikan Magang',
                    'desc' => 'Tinjau evaluasi dan lengkapi administrasi magang.',
                ],
            ];
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-4">
            @foreach ($steps as $item)
                <div class="w-full h-fit bg-white outline-1 outline-neutral-200 rounded-2xl py-6 px-6 
                          hover:bg-primary-50 hover:outline-primary-500 space-y-4 sm:space-y-6 animate-on-scroll"
                    data-animation="animate-scale-up" style="animation-delay: {{ 100 * $loop->index }}ms">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 bg-white border-1 rounded-lg border-neutral-200 p-2 flex flex-col justify-center hover:!outline-none">
                        <p class="text-lg sm:text-xl font-semibold text-primary-500 text-center">{{ $loop->index + 1 }}</p>
                    </div>
                    <div class="space-y-1 sm:space-y-2">
                        <p class="text-lg sm:text-xl font-medium text-neutral-900">{{ $item['title'] }}</p>
                        <p class="text-sm sm:text-base font-normal text-neutral-500 leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="bg-white py-12 sm:py-16 lg:py-24 px-4 sm:px-8 lg:px-20 space-y-8 sm:space-y-12 lg:space-y-14">
        <div class="flex flex-col lg:flex-row justify-between items-center lg:items-center gap-8 lg:gap-0">
            <div class="text-center lg:text-left order-2 lg:order-1">
                <p class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-neutral-900 animate-on-scroll leading-tight"
                    data-animation="animate-fade-in-right">
                    Mulai Magangmu<br>dan Raih Kesempatan<br class="hidden sm:block">Terbaik!</p>
            </div>
            <div class="flex flex-col justify-start items-center lg:items-end space-y-4 animate-on-scroll order-1 lg:order-2"
                data-animation="animate-fade-in-left">
                <p class="text-sm sm:text-base text-neutral-500 text-center lg:text-end leading-relaxed max-w-md lg:max-w-none">
                    Jelajahi peluang magang terbaik sesuai minat dan keahlianmu,<br class="hidden lg:block">
                    ajukan lamaran dengan mudah, dan pantau perkembanganmu<br class="hidden lg:block">
                    dalam satu sistem terintegrasi.
                </p>
                <a href="{{ route('register') }}" class="btn-primary-animated">
                    Mulai Sekarang
                    <span><i class="ph ph-caret-double-right"></i></span>
                </a>
            </div>
        </div>
        <hr class="border-neutral-300">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 sm:gap-0 animate-on-scroll" data-animation="animate-fade-in">
            <ul class="flex flex-wrap justify-center sm:justify-start gap-4 sm:gap-6 text-sm sm:text-base">
                <li><a href="#beranda"
                        class="text-neutral-500 font-normal hover:text-primary-500 hover:font-semibold nav-link transition-colors duration-200">Beranda</a>
                </li>
                <li><a href="#tentang"
                        class="text-neutral-500 font-normal hover:text-primary-500 hover:font-semibold nav-link transition-colors duration-200">Tentang</a>
                </li>
                <li><a href="#fitur"
                        class="text-neutral-500 font-normal hover:text-primary-500 hover:font-semibold nav-link transition-colors duration-200">Fitur</a>
                </li>
                <li><a href="#panduan"
                        class="text-neutral-500 font-normal hover:text-primary-500 hover:font-semibold nav-link transition-colors duration-200">Panduan</a>
                </li>
            </ul>
            <p class="text-neutral-500 text-xs sm:text-sm lg:text-base font-normal text-center sm:text-right">
                © Copyright 2025 . Kelompok 3 TI-2E . All right reserved
            </p>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top"
        class="w-12 h-12 fixed bottom-8 right-8 bg-white border border-neutral-200 hover:bg-primary-50 text-primary-500 rounded-full p-3 shadow-lg opacity-0 transition-all duration-300 transform translate-y-10"
        aria-label="Back to top">
        <i class="ph ph-arrow-line-up text-xl"></i>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu functionality
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            let isMobileMenuOpen = false;

            mobileMenuButton.addEventListener('click', function() {
                isMobileMenuOpen = !isMobileMenuOpen;
                if (isMobileMenuOpen) {
                    mobileMenu.classList.remove('hidden');
                    mobileMenuButton.innerHTML = '<i class="ph ph-x text-2xl"></i>';
                } else {
                    mobileMenu.classList.add('hidden');
                    mobileMenuButton.innerHTML = '<i class="ph ph-list text-2xl"></i>';
                }
            });

            // Close mobile menu when clicking on a link
            const mobileNavLinks = mobileMenu.querySelectorAll('.nav-link');
            mobileNavLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                    isMobileMenuOpen = false;
                    mobileMenuButton.innerHTML = '<i class="ph ph-list text-2xl"></i>';
                });
            });

            // Animation on scroll
            const animatedElements = document.querySelectorAll('.animate-on-scroll');
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('div[id]');
            const backToTopButton = document.getElementById('back-to-top');

            // Back to top button functionality
            backToTopButton.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            const animateOnScroll = function() {
                // Your existing animation code
                animatedElements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;

                    // When element is in viewport (with a small offset)
                    if (elementPosition < windowHeight - 100) {
                        // Get the animation class from data attribute
                        const animationClass = element.dataset.animation || 'animate-fade-in-up';
                        element.classList.add(animationClass);
                    }
                });

                // Show/hide back to top button
                if (window.scrollY > 500) {
                    backToTopButton.classList.remove('opacity-0', 'translate-y-10');
                    backToTopButton.classList.add('opacity-100', 'translate-y-0');
                } else {
                    backToTopButton.classList.add('opacity-0', 'translate-y-10');
                    backToTopButton.classList.remove('opacity-100', 'translate-y-0');
                }

                // Highlight active section in navbar
                let currentSection = '';

                // If at the top of the page, set Beranda as active
                if (window.scrollY < 100) {
                    currentSection = 'beranda';
                } else {
                    // Otherwise determine based on scroll position
                    sections.forEach(section => {
                        const sectionTop = section.offsetTop;
                        const sectionHeight = section.clientHeight;
                        if (window.scrollY >= (sectionTop - 150)) {
                            currentSection = section.getAttribute('id');
                        }
                    });
                }

                navLinks.forEach(link => {
                    link.classList.remove('text-primary-500', 'font-semibold');
                    link.classList.add('text-neutral-500', 'font-normal');

                    if (link.getAttribute('href') === `#${currentSection}`) {
                        link.classList.remove('text-neutral-500', 'font-normal');
                        link.classList.add('text-primary-500', 'font-semibold');
                    }
                });
            };

            // Smooth scrolling for navbar links
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);

                    if (targetId === 'beranda') {
                        // For beranda, scroll to the very top of the page
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    } else {
                        // For other sections, apply the offset for fixed navbar
                        const offset = window.innerWidth < 1024 ? 60 : 80; // Responsive offset
                        window.scrollTo({
                            top: targetSection.offsetTop - offset,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Fixed navbar on scroll
            const navbar = document.getElementById('navbar');
            const navbarPlaceholder = document.getElementById('navbar-placeholder');
            const heroSection = document.querySelector('.bg-gradient-to-b');
            let navbarHeight = navbar.offsetHeight;

            const handleNavbarPosition = function() {
                const heroBottom = heroSection.getBoundingClientRect().bottom;

                if (heroBottom <= 0) {
                    // Fix navbar to top
                    navbar.classList.add('fixed', 'top-0', 'shadow-md');
                    navbarPlaceholder.classList.remove('hidden');
                    navbarPlaceholder.style.height = `${navbarHeight}px`;
                } else {
                    // Return navbar to normal
                    navbar.classList.remove('fixed', 'top-0', 'shadow-md');
                    navbarPlaceholder.classList.add('hidden');
                    navbarPlaceholder.style.height = '0';
                }
            };

            // Add hover micro-interactions
            const addHoverInteractions = function() {
                // Feature cards hover effect
                const featureCards = document.querySelectorAll('#fitur .grid > div');
                featureCards.forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        this.classList.add('hover:transform', 'hover:scale-105',
                            'transition-transform', 'duration-300');
                    });
                    card.addEventListener('mouseleave', function() {
                        setTimeout(() => {
                            this.classList.remove('hover:transform', 'hover:scale-105');
                        }, 300);
                    });
                });

                // Guide steps hover effect
                const guideSteps = document.querySelectorAll('#panduan .grid > div');
                guideSteps.forEach(step => {
                    step.addEventListener('mouseenter', function() {
                        this.classList.add('shadow-md', 'transform', 'scale-105',
                            'transition-all', 'duration-300');
                    });
                    step.addEventListener('mouseleave', function() {
                        this.classList.remove('shadow-md', 'transform', 'scale-105');
                    });
                });

                // Navbar links hover effect
                navLinks.forEach(link => {
                    link.addEventListener('mouseenter', function() {
                        if (!this.classList.contains('text-primary-500')) {
                            this.classList.add('transform', 'translate-y-[-2px]',
                                'transition-transform', 'duration-200');
                        }
                    });
                    link.addEventListener('mouseleave', function() {
                        this.classList.remove('transform', 'translate-y-[-2px]');
                    });
                });

                // Buttons hover effect
                const buttons = document.querySelectorAll('.btn-primary, .btn-secondary');
                buttons.forEach(button => {
                    button.addEventListener('mouseenter', function() {
                        this.classList.add('shadow-md', 'transition-all', 'duration-300');
                    });
                    button.addEventListener('mouseleave', function() {
                        this.classList.remove('shadow-md');
                    });
                });

                // Hero image hover effect
                const heroImage = document.querySelector('.bg-gradient-to-b img');
                if (heroImage) {
                    heroImage.addEventListener('mouseenter', function() {
                        this.classList.add('filter', 'brightness-105', 'transition-all',
                            'duration-300');
                    });
                    heroImage.addEventListener('mouseleave', function() {
                        this.classList.remove('filter', 'brightness-105');
                    });
                }

                // Back to top button enhanced hover
                backToTopButton.addEventListener('mouseenter', function() {
                    this.classList.add('animate-pulse', 'shadow-lg');
                });
                backToTopButton.addEventListener('mouseleave', function() {
                    this.classList.remove('animate-pulse', 'shadow-lg');
                });
            };

            // Check on load
            handleNavbarPosition();
            animateOnScroll();
            addHoverInteractions();

            // Check on scroll for both animations and navbar
            window.addEventListener('scroll', function() {
                animateOnScroll();
                handleNavbarPosition();
            });

            // Update navbar height on window resize
            window.addEventListener('resize', function() {
                navbarHeight = navbar.offsetHeight;
                handleNavbarPosition();
                
                // Close mobile menu on resize to desktop
                if (window.innerWidth >= 1024) {
                    mobileMenu.classList.add('hidden');
                    isMobileMenuOpen = false;
                    mobileMenuButton.innerHTML = '<i class="ph ph-list text-2xl"></i>';
                }
            });
        });
    </script>
</body>

</html>
