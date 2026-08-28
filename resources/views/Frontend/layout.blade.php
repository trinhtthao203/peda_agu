<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Trường Đại học An Giang - Khoa Sư phạm" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', __('Khoa Sư phạm')) - {{ __('Trường Đại học An Giang') }}</title>
    <meta name="keywords" content="Khoa Sư phạm, Trường Đại học An Giang, Đại học Quốc Gia TP.HCM" />
    <meta name="description" content="@yield('description', __('Khoa Sư phạm - Trường Đại học An Giang, ĐHQG-HCM'))">

    <meta property="og:title" content="@yield('title', __('Khoa Sư phạm - Trường Đại học An Giang, ĐHQG-HCM'))" />
    <meta property="og:description" content="@yield('description', __('Thông tin Khoa Sư phạm, Trường Đại học An Giang'))" />
    <meta property="og:site_name" content="agu.edu.vn - Khoa Sư phạm, Trường Đại học An Giang, ĐHQG-HCM" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:image" content="{{ asset('assets/frontend/images/AGU_THUMBNAIL_600x315.jpg') }}" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favicon.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        agu: {
                            blue: '#0066b3',
                            green: '#00954d',
                            yellow: '#ffe600',
                            red: '#ed1c24'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 15px;
            line-height: 1.5;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .font-heading {
            font-family: 'Montserrat', sans-serif;
        }

        h1 {
            font-size: 24px;
            font-weight: 700;
        }

        h2 {
            font-size: 18px;
            font-weight: 600;
        }

        .nav-main>li>a {
            position: relative;
            padding: 1rem 0.75rem;
            display: block;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.05em;
            transition: color 0.2s ease;
        }

        .nav-main>li>a::after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 3px;
            bottom: 0;
            left: 0;
            background-color: #ffe600;
            transform-origin: bottom right;
            transition: transform 0.3s ease-out;
        }

        .nav-main>li:hover>a::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        .nav-main>li {
            position: relative;
        }

        .mega-menu-dropdown {
            visibility: hidden;
            opacity: 0;
            position: absolute;
            left: 0;
            top: 100%;
            width: 100vw;
            max-width: 1200px;
            background: white;
            color: #1f2937;
            border-top: 3px solid #ffe600;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            z-index: 50;
            transition: all 0.25s ease;
            transform: translateY(10px);
        }

        .nav-main>li:hover .mega-menu-dropdown {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
        }

        .btn-agu-effect {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-agu-effect:hover {
            transform: scale(1.05);
        }

        @media (max-width: 1023px) {
            .nav-main {
                flex-direction: column;
                align-items: stretch;
                space-x: 0;
                width: 100%;
            }

            .nav-main>li {
                width: 100%;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .nav-main>li>a {
                padding: 0.75rem 0.5rem;
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .mega-menu-dropdown {
                position: static !important;
                visibility: visible !important;
                opacity: 1 !important;
                width: 100% !important;
                box-shadow: none !important;
                background: rgba(255, 255, 255, 0.05) !important;
                color: #ffffff !important;
                padding: 1rem !important;
                transform: none !important;
                display: none;
            }

            .nav-main>li:hover .mega-menu-dropdown,
            .nav-main>li.active-mobile .mega-menu-dropdown {
                display: block;
            }

            .mega-menu-dropdown span.mega-menu-sub-title,
            .mega-menu-dropdown span.block {
                color: #ffe600 !important;
                margin-top: 0.75rem;
                font-size: 13px;
            }

            .mega-menu-dropdown ul li a {
                color: #e5e7eb !important;
                padding: 0.5rem 0;
                display: block;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }

            .mega-menu-dropdown .grid {
                grid-template-cols: 1fr !important;
                gap: 1rem !important;
            }
        }
    </style>

    @yield('css')
</head>

<body class="bg-gray-50 text-gray-700 flex flex-col min-h-screen">
    <div id="pageloader" class="fixed inset-0 bg-white z-[99999] flex items-center justify-center overflow-hidden transition-opacity duration-500">
        <div class="loader-inner text-center">
            <img src="{{ asset('assets/frontend/images/preloader.gif') }}"
                alt="Loading..."
                class="w-[235px] mx-auto block object-contain" />

            <p class="text-xs font-heading font-semibold text-gray-400 mt-4 animate-pulse uppercase tracking-wider">
                {{ __('Đang tải dữ liệu hệ thống AGU...') }}
            </p>
        </div>
    </div>
    @hasSection('urgent_notice')
    <div class="bg-[#ed1c24] text-white text-sm py-2 px-4 sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto overflow-hidden whitespace-nowrap relative">
            <div class="inline-block animate-marquee uppercase font-semibold tracking-wider">
                @yield('urgent_notice')
            </div>
        </div>
    </div>
    <style>
        @keyframes marquee {
            0% {
                transform: translate3d(100%, 0, 0);
            }

            100% {
                transform: translate3d(-100%, 0, 0);
            }
        }

        .animate-marquee {
            animation: marquee 25s linear infinite;
        }
    </style>
    @endif


    @php
    // Logic dịch thuật URI động có sẵn của hệ thống
    $path = App\Http\Controllers\TranslatePathController::getPath(Request::path());
    $locale = app()->getLocale();

    if ($path) {
    if ($locale == 'vi') {
    $path_vi = env('APP_URL') . Request::path();
    $path_en = env('APP_URL') . $path;
    } else {
    $path_en = env('APP_URL') . Request::path();
    $path_vi = env('APP_URL') . $path;
    }
    } else {
    $path_vi = env('APP_URL') . 'vi';
    $path_en = env('APP_URL') . 'en';
    }
    @endphp

    <div class="bg-gray-100 border-b border-gray-200 py-2 px-4 text-xs">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2 sm:gap-0 font-heading font-medium text-gray-600">

            <div class="flex items-center space-x-4">
                <a href="mailto:peda@agu.edu.vn" class="flex items-center hover:text-[#0066b3] transition-colors gap-1.5">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                    <span>peda@agu.edu.vn</span>
                </a>

                <a href="tel:+842966256565" class="flex items-center hover:text-[#0066b3] transition-colors gap-1.5">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25V18.16a2.25 2.25 0 00-1.242-2.01l-4.24-2.12a2.25 2.25 0 00-2.478.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    <span>+84 296 6256565 <span class="text-gray-400 font-normal">(ext 1900)</span></span>
                </a>
            </div>

            <div class="flex items-center space-x-1 border-l sm:border-l-0 border-gray-300 pl-3 sm:pl-0">
                <a href="{{ $path_vi }}" class="hover:text-agu-blue transition-colors {{ app()->getLocale() == 'vi' ? 'text-agu-blue font-bold' : '' }}">VN</a>
                <span class="text-gray-300">|</span>
                <a href="{{ $path_en }}" class="hover:text-agu-blue transition-colors {{ app()->getLocale() == 'en' ? 'text-agu-blue font-bold' : '' }}">EN</a>
            </div>

        </div>
    </div>

    <header class="bg-white border-b border-gray-100 py-4 px-6 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between">

            <div class="flex items-center pl-6">
                <a href="{{ url('/') }}" class="flex items-center block">
                    <img src="/assets/frontend/images/footer_logo.png"
                        alt="AGU Logo"
                        class="w-20 h-20 object-contain aspect-square shrink-0" />

                    <div class="ml-6 flex flex-col justify-center border-l-2 border-gray-200 pl-4">
                        <span class="font-heading font-bold text-base md:text-lg tracking-wide text-gray-800 leading-tight uppercase">
                            {{ __('Trường Đại học An Giang') }}
                        </span>
                        <span class="font-heading font-semibold text-xs md:text-sm tracking-normal text-agu-blue uppercase">
                            {{ __('Khoa Sư phạm') }}
                        </span>
                    </div>
                </a>
            </div>

            <button id="mobile-menu-btn" class="lg:hidden text-gray-600 focus:outline-none p-2">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </header>

    <nav class="bg-[#0066b3] text-white shadow-md font-heading font-semibold sticky top-0 z-40 hidden lg:block">
        <div class="max-w-7xl mx-auto px-6 relative flex justify-start">
            @if(app()->getLocale() == 'en')
            @include('Frontend.menu_en')
            @else
            @include('Frontend.menu_vi')
            @endif
        </div>
    </nav>

    <div id="mobile-menu" class="hidden lg:hidden bg-[#0066b3] text-white font-heading font-semibold px-4 py-4 space-y-2 border-t border-blue-700 max-h-[calc(100vh-100px)] overflow-y-auto">
        @if(app()->getLocale() == 'en')
        @include('Frontend.menu_en')
        @else
        @include('Frontend.menu_vi')
        @endif
    </div>

    @yield('body')

    <footer class="bg-gray-950 text-gray-400 pt-12 pb-6 px-6 border-t-4 border-[#0066b3]">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 pb-8 border-b border-gray-800">
            <div>
                <h3 class="font-heading font-bold text-white text-base uppercase tracking-wider">{{ __('Trường Đại học An Giang') }}</h3>
                <h3 class="font-heading font-bold text-white text-base mb-4 uppercase tracking-wider">{{ __('Khoa Sư phạm') }}</h3>
                <p class="text-xs leading-relaxed mb-2">
                    <strong class="text-gray-300">{{ __('Địa chỉ: số 18, đường Ung Văn Khiêm, phường Đông Xuyên, thành phố Long Xuyên, tỉnh An Giang') }}:</strong>
                </p>
                <p class="text-xs">
                    <strong class="text-gray-300">{{ __('Email:') }}</strong>
                    <a href="mailto:peda@agu.edu.vn" class="text-agu-blue font-medium hover:underline">peda@agu.edu.vn</a>
                </p>
                <p class="text-xs">
                    <strong class="text-gray-300">{{ __('Phone:') }}</strong>
                    <a href="tel:+84 296 6256565" class="text-agu-blue font-medium hover:underline">+84 296 6256565 (ext 1900)</a>
                </p>
            </div>

            <div>
                <h3 class="font-heading font-bold text-white text-base mb-4 uppercase tracking-wider">{{ __('Liên kết') }}</h3>
                <ul class="text-xs space-y-2.5">
                    <li><a href="https://www.agu.edu.vn" target="_blank" class="hover:text-white transition-colors">{{ __('Cổng thông tin AGU') }}</a></li>
                    <li><a href="https://vnuhcm.edu.vn" target="_blank" class="hover:text-white transition-colors">{{ __('Đại học Quốc gia TP.HCM') }}</a></li>
                    <li><a href="https://lms.agu.edu.vn" target="_blank" class="hover:text-white transition-colors">{{ __('Hệ thống Đào tạo LMS') }}</a></li>
                </ul>
            </div>

            <div class="flex flex-col items-start md:items-end justify-between space-y-4 md:space-y-0">

                <div class="flex items-center space-x-4 md:justify-end w-full">
                    <img src="/assets/frontend/images/logo_vnu.png"
                        alt="VNU-HCM Logo"
                        class="h-10 w-auto object-contain opacity-80 hover:opacity-100 transition-opacity duration-300"
                        style="max-height: 40px;" />

                    <span class="h-6 w-px bg-gray-700 block"></span>

                    <img src="/assets/frontend/images/footer_logo.png"
                        alt="AGU Logo"
                        class="h-10 w-auto object-contain opacity-80 hover:opacity-100 transition-opacity duration-300"
                        style="max-height: 40px;" />
                </div>

                <p class="text-[11px] text-gray-500 mt-4 md:mt-6 md:text-right w-full tracking-wide">
                    &copy; {{ date('Y') }} {{ __('Tổ Nghiệp vụ - Thông tin, Thư viện AGU-VNU.') }}
                </p>
            </div>
        </div>
    </footer>
    <button id="back-to-top"
        class="fixed bottom-6 right-6 z-[99] hidden p-3 rounded-full bg-[#0066b3] text-white shadow-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-110 focus:outline-none btn-agu-effect"
        aria-label="Back to top">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
        </svg>
    </button>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            const pageloader = document.getElementById('pageloader');
            if (pageloader) {
                pageloader.classList.add('opacity-0');
                setTimeout(() => {
                    pageloader.remove();
                }, 500);
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopBtn = document.getElementById('back-to-top');

            if (backToTopBtn) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 300) {
                        backToTopBtn.classList.remove('hidden');
                        backToTopBtn.classList.add('block');
                    } else {
                        backToTopBtn.classList.remove('block');
                        backToTopBtn.classList.add('hidden');
                    }
                });

                backToTopBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileMenu.classList.toggle('hidden');
                });
            }
            if (window.innerWidth < 1024) {
                const menuItemsWithDropdown = document.querySelectorAll('.nav-main > li > a');

                menuItemsWithDropdown.forEach(item => {
                    const dropdown = item.nextElementSibling;
                    if (dropdown && dropdown.classList.contains('mega-menu-dropdown')) {
                        item.addEventListener('click', function(e) {
                            e.preventDefault();
                            const parentLi = this.parentElement;
                            parentLi.classList.toggle('active-mobile');
                        });
                    }
                });
            }
        });
    </script>
    @yield('js')
</body>

</html>
