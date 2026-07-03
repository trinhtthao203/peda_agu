<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <title>@yield('title', __('Khoa Sư phạm')) - {{ __('Trường Đại học An Giang, ĐHQG-HCM') }}</title>
    <meta name="keywords" content="Khoa Sư phạm, Trường Đại học An Giang, Đại học Quốc Gia TP.HCM" />
    <meta name="description" content="@yield('description', __('Khoa Sư phạm - Trường Đại học An Giang, ĐHQG-HCM'))">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Trường Đại học An Giang - Khoa Sư phạm" name="author" />

    <!-- Facebook / Open Graph Meta -->
    <meta property="og:title" content="@yield('title', __('Khoa Sư phạm - Trường Đại học An Giang, ĐHQG-HCM'))" />
    <meta property="og:description" content="@yield('description', __('Thông tin Khoa Sư phạm, Trường Đại học An Giang'))" />
    <meta property="og:site_name" content="agu.edu.vn - Khoa Sư phạm, Trường Đại học An Giang, ĐHQG-HCM" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:image" content="{{ asset('assets/frontend/images/AGU_THUMBNAIL_600x315.jpg') }}" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:image:alt" content="Khoa Sư phạm - Trường Đại học An Giang, ĐHQG-HCM" />
    <meta name="robots" content="index, follow, max-image-preview:large" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favicon.ico') }}">

    <!-- Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,500,700&display=swap" rel="stylesheet">

    <!-- Lib CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/lib/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/lib/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/lib/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/lib/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/lib/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/lib/prettyPhoto.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/lib/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/lib/timeline.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/theme-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/skins/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}">

    @section('css') @show
</head>

<body>
    {{-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0&appId=131376384294659&autoLogAppEvents=1" nonce="xz8OBKsp"></script> --}}
    <!-- Page Loader -->
    <div id="pageloader">
        <div class="loader-inner">
            <img src="{{ env('APP_ASSETS') }}assets/frontend/images/preloader.gif" alt="Trường Đại học An Giang">
        </div>
    </div><!-- Page Loader -->
    <!-- Back to top -->
    <a href="#0" class="cd-top">Top</a>
    <!-- Header Begins -->
    <header id="header" class="default-header colored flat-menu">
        <div class="header-top">
            <div class="container">
                <nav>
                    <ul class="nav nav-pills nav-top">
                        <li class="phone">
                            <span><i class="fa fa-envelope"></i>webmaster@agu.edu.vn</span>
                        </li>
                        <li class="phone">
                            <span><i class="fa fa-phone"></i>+84 296 6256565 ext 1900</span>
                        </li>
                    </ul>
                </nav>
                @php
                $path = App\Http\Controllers\TranslatePathController::getPath(Request::path());
                $locale = app()->getLocale();

                if($path) {
                if($locale == 'vi'){
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

                if($locale == 'vi'){
                $path_searh = env('APP_URL') . 'vi/tim-kiem';
                } else {
                $path_searh = env('APP_URL') . 'en/search';
                }
                @endphp
                <div class="search">
                    <form id="searchForm" action="{{ $path_searh }}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control search" value="{{ Request::input('q') }}" name="q" id="q" placeholder="{{ __('Tìm kiếm') }}" required>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

                    <!-- ĐƯA NÚT CHUYỂN NGỮ VÀO ĐÂY ĐỂ ĐI THEO KHUNG SEARCH -->
                    <div class="lang-switch-wrapper">
                        <label class="switch-modern">
                            <input type="checkbox" id="toggle-lang" {{ $locale != 'en' ? 'checked' : '' }}>
                            <div class="slider-modern">
                                <span class="lang-text en-text">EN</span>
                                <span class="lang-text vi-text">VI</span>
                                <span class="slider-button"></span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="logo">
                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}">
                    <img alt="{{ __('Trường Đại học An Giang') }}" title="{{ __('Trường Đại học An Giang') }}" width="300" height="43" data-sticky-width="280" data-sticky-height="40" src="{{ env('APP_ASSETS') }}assets/frontend/images/logo_{{ app()->getLocale() }}.png">
                </a>
            </div>
            <button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse"><i class="fa fa-bars"></i></button>
        </div>
        <div class="navbar-collapse nav-main-collapse collapse">
            <div class="container">
                <nav class="nav-main mega-menu">
                    @include('Frontend.menu_'.app()->getLocale())
                </nav>
            </div>
        </div>
    </header><!-- Header Ends -->
    <!-- Page Main -->
    <div role="main" class="main">
        @section('body') @show
    </div><!-- Page Main -->
    <!-- Footer -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <a href="https://vnuhcm.edu.vn/" target="_blank">
                        <img src="{{ env('APP_ASSETS') }}assets/frontend/images/logo_vnu.png" alt="ĐHQG TPHCM">
                    </a>
                    <a href="{{ env('APP_URL') }}">
                        <img src="{{ env('APP_ASSETS') }}assets/frontend/images/footer_logo.png" alt="ĐH An Giang">
                    </a>
                </div>
                <div class="footer-info">
                    <p>
                        Địa chỉ: số 18, đường Ung Văn Khiêm, phường Long Xuyên, tỉnh An Giang<br>
                        Điện thoại: +84 296 6256565 ext 1900 | Fax: +84 296 3842560<br>
                        Email: <a href="mailto:webmaster@agu.edu.vn">webmaster@agu.edu.vn</a><br>
                        © 2017 Trường Đại học An Giang. Phát triển bởi
                        <a href="https://lib.agu.edu.vn/gioi-thieu/nhan-su">Tổ Nghiệp vụ - Thông tin, Thư viện</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer -->

    <!-- library -->
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/jquery.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/bootstrap.min.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/bootstrapValidator.min.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/jquery.appear.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/jquery.easing.min.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/owl.carousel.min.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/countdown.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/counter.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/isotope.pkgd.min.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/jquery.easypiechart.min.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/jquery.mb.YTPlayer.min.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/jquery.prettyPhoto.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/jquery.stellar.min.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/menu.js"></script>

    <!-- Revolution Js -->
    <script src="{{ env('APP_ASSETS') }}assets/frontend/revolution/js/jquery.themepunch.tools.min.js?rev=5.0"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/revolution/js/jquery.themepunch.revolution.min.js?rev=5.0"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/theme-rs.js"></script>

    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/modernizr.js"></script>
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/modernizr.js"></script>
    <!-- Theme Base, Components and Settings -->
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/theme.js"></script>

    <!-- Theme Custom -->
    <script src="{{ env('APP_ASSETS') }}assets/frontend/js/custom.js"></script>
    <!-- <script>
        document.getElementById('toggle-lang').addEventListener('change', function() {
            var targetUrl = this.checked ? "{{ $path_vi }}" : "{{ $path_en }}";
            setTimeout(function() {
                window.location.href = targetUrl;
            }, 2500);
        });
    </script> -->
    <script>
        window.addEventListener('load', function() {
            var loader = document.getElementById('pageloader');
            if (loader) {
                setTimeout(function() {
                    loader.style.transition = 'opacity 0.5s ease';
                    loader.style.opacity = '0';

                    setTimeout(function() {
                        loader.style.display = 'none';
                    }, 500);
                }, 2000);
            }
        });
        document.getElementById('toggle-lang').addEventListener('change', function() {
            var targetUrl = this.checked ? "{{ $path_vi }}" : "{{ $path_en }}";

            setTimeout(function() {
                window.location.href = targetUrl;
            }, 2500);
        });
    </script>
    @section('js') @show
</body>

</html>
