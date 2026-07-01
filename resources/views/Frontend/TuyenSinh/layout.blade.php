<!DOCTYPE html>
<html>
    <head>
        <!-- Basic -->
        <meta charset="utf-8">
        <title>@yield('title', __('Trang chủ')) - {{ __('Trường Đại học An Giang') }}</title>
        <meta name="keywords" content="{{ __('Trường Đại học An Giang') }}" />
        <meta name="description" content="{{ __('Trường Đại học An Giang') }}">
        <meta content="Phan Minh Trung - trungminhphan@gmail.com" name="author" />
        <meta property="og:url"           content="{{ Request::fullUrl() }}" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="@yield('title', __('Đại học Quốc Gia TPHCM Trường Đại học An Giang '))" />
        <meta property="og:description"   content="@yield('description' , __('Đại học Quốc Gia TPHCM Trường Đại học An Giang'))" />
        <meta property="og:image"         content="@yield('image', 'https://www.agu.edu.vn/assets/frontend/images/logo_'.app()->getLocale().'.png')" />

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ env('APP_ASSETS') }}assets/frontend/images/favicon.ico">
        <!-- Web Fonts  -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
        <!-- Lib CSS -->
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/css/lib/bootstrap.min.css">
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/css/lib/animate.min.css">
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/css/lib/font-awesome.min.css">
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/css/lib/icons.css">
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/css/lib/owl.carousel.css">
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/css/lib/prettyPhoto.css">
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/css/lib/menu.css">
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/css/lib/timeline.css">
        <!-- Revolution CSS -->
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/revolution/css/settings.css">
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/revolution/css/layers.css">
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/revolution/css/navigation.css">
        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/css/theme.css">
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/css/theme-responsive.css">
        <!--[if IE]>
            <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/css/ie.css">
        <![endif]-->
        <!-- Head Libs -->
        {{-- <script src="{{ env('APP_ASSETS') }}assets/frontend/js/lib/modernizr.js"></script> --}}
        <!-- Skins CSS -->
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/css/skins/default.css">
        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="{{ env('APP_ASSETS') }}assets/frontend/css/custom.css">
        @section('css') @show
    </head>
<body>
{{-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0&appId=131376384294659&autoLogAppEvents=1" nonce="xz8OBKsp"></script> --}}
<!-- Page Loader -->
<div id="pageloader">
    <div class="loader-inner">
        <img src="{{ env('APP_ASSETS') }}assets/frontend/images/preloader.gif" alt="">
    </div>
</div><!-- Page Loader -->
<!-- Back to top -->
<a href="#0" class="cd-top">Top</a>
<!-- Header Begins -->
<header id="header" class="default-header colored flat-menu">
    <div class="header-top"  style="background:#0c5371;">
        <div class="container" style="max-width: 100% !important;">
            <nav>
                <ul class="nav nav-pills nav-top">
                    <li class="phone">
                        <span><a href="{{ env('APP_URL') }}"><i class="fa fa-home"></i><b>AGU HOME</b></a></span>
                    </li>
                    <li class="phone">
                        <span><a href="mailto:tuyensinh@agu.edu.vn"><i class="fa fa-envelope"></i><b>tuyensinh@agu.edu.vn</b></a></span>
                    </li>
                    <li class="phone">
                        <span><a href="tel:0794222245"><i class="fa fa-phone"></i> <b>0794.2222.45</b></a></span>
                    </li>
                    <li class="phone">
                        <span><a href="#"><i class="fa fa-graduation-cap"></i> Mã trường: <b>QSA</b></a></span>
                    </li>
                    <li class="phone">
                        <span>
                            <a href="https://www.facebook.com/tuyensinhdhag" target="_blank">
                            <b><i class="fa fa-facebook-square" aria-hidden="true"></i> Facebook</b>
                            </a>
                        </span>
                    </li>
                </ul>
            </nav>
            <div class="search">
                <form id="searchForm" action="{{  env('APP_URL') }}vi/tuyen-sinh/tim-kiem" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control search" value="{{ Request::input('q') }}" name="q" id="q" placeholder="{{ __('Tìm kiếm') }}" required>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>				
                    </div>
                </form>
            </div>
            {{-- 
            <ul class="social-icons color" style="float:left !important">
                <li class="facebook"><a title="{{ __('Facebook') }}" href="https://www.facebook.com/tuyensinhdhag" target="_blank">facebook</a></li>
            </ul> --}}
        </div>
    </div>
    <div class="container" style="max-width: 100% !important;">
        <div class="logo">
            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh">
                <img alt="{{ __('Trường Đại học An Giang') }}" title="{{ __('Trường Đại học An Giang') }}" width="338" height="48" data-sticky-width="200" data-sticky-height="29" src="{{ env('APP_ASSETS') }}assets/frontend/images/logo_ts.jpg">
            </a>
        </div>
        <button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse"><i class="fa fa-bars"></i></button>
    </div>
    <div class="navbar-collapse nav-main-collapse collapse">
        <div class="container"  style="max-width: 100% !important;">
            <nav class="nav-main mega-menu">
                <ul class="nav nav-pills nav-main" id="mainMenu">
                    <li class="dropdown">
                        <a href="{{ env('APP_URL') }}vi/tuyen-sinh/" class="dropdown-toggle"> {{ __('Giới thiệu AGU') }} <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/gioi-thieu-ve-agu">{{ __('Giới thiệu về Trường Đại học An Giang') }}</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/video-gioi-thieu-ve-agu">{{ __('Video giới thiệu về Trường Đại học An Giang') }}</a></li>
                            <li><a href="https://cict.agu.edu.vn/demo/vr3d/demo_agu/" target="_blank">{{ __('Hình ảnh 3D') }}</a></li>
                            <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/trai-nghiem-mot-ngay-lam-sinh-vien-agu">{{ __('Trải nghiệm một ngày làm sinh viên AGU') }}</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" target="_blank"> {{ __('Sau Đại học') }} <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/sau-dai-hoc"> {{ __('Thông tin Tuyển sinh') }}</a></li>
                            <li><a href="https://pgd.agu.edu.vn/trainings/majors" target="_blank"> {{ __('Chương trình Đào tạo') }}</a></li>                        
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{ env('APP_URL') }}vi/tuyen-sinh/" class="dropdown-toggle"> {{ __('Đại học') }} <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/thong-tin-tuyen-sinh-dai-hoc"> {{ __('Thông tin Tuyển sinh') }}</a></li>
                            <li><a href="https://aao.agu.edu.vn/?q=content/ct%C4%91t-tr%C3%ACnh-%C4%91%E1%BB%99-%C4%91%E1%BA%A1i-h%E1%BB%8Dc" target="_blank">{{ __('CTĐT Đại học Chính quy') }}</a></li>
                            <li><a href="https://aao.agu.edu.vn/?q=content/340-ch%C6%B0%C6%A1ng-tr%C3%ACnh-%C4%91%C3%A0o-t%E1%BA%A1o-tr%C3%ACnh-%C4%91%E1%BB%99-%C4%91%E1%BA%A1i-h%E1%BB%8Dc" target="_blank"> {{ __('CTĐT Đại học Vừa làm Vừa học') }}</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/de-an-tuyen-sinh">{{ __('Đề án Tuyển sinh') }}</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/cam-nang-tuyen-sinh">{{ __('Cẩm nang Tuyển sinh') }}</a></li>
                            {{-- <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/dai-hoc-lien-thong-tu-cao-dang"> {{ __('Đại học Liên thông từ Cao Đẳng') }}</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/dai-hoc-van-bang-2"> {{ __('Đại học Văn bằng 2') }}</a></li> --}}
                        </ul>
                    </li>
                    <li  class="dropdown"><a href="{{ env('APP_URL') }}vi/tuyen-sinh/dao-tao-ngan-han"  class="dropdown-toggle">{{ __('Đào tạo Ngắn hạn') }} <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="https://cict.agu.edu.vn" target="_blank">{{ __('Trung tâm Tin học') }}</a></li>
                            <li><a href="https://cfl.agu.edu.vn" target="_blank">{{ __('Trung tâm Ngoại ngữ') }}</a></li>
                            <li><a href="https://rccd.agu.edu.vn" target="_blank">{{ __('Trung tâm Tạo nguồn Nhân lực Phát triển Cộng đồng') }}</a></li>
                            <li><a href="https://ctepsd.agu.edu.vn/" target="_blank">{{ __('Trung tâm Bồi dưỡng nhà giáo và Phát triển kỹ năng sư phạm') }}</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/tu-van-tuyen-sinh">{{ __('Tư vấn Tuyển sinh') }}</a></li>
                    <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/tra-cuu-ket-qua-tuyen-sinh">{{ __('Tra cứu kết quả tuyển sinh') }}</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header><!-- Header Ends -->
<!-- Page Main -->
<div role="main" class="main">
    @section('body') @show
</div><!-- Page Main -->
<!-- Footer -->
<footer id="footer" class="footer-1" style="background:#0c5371;">
    <!-- Footer Copyright -->
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <!-- Copy Right Logo -->
                <div class="col-md-2">
                    <a class="logo" href="{{ env('APP_URL') }}">
                        <img src="{{ env('APP_ASSETS') }}assets/frontend/images/footer_logo.png" width="90" height="90"  class="img-responsive" alt="{{ __('Trường Đại học An Giang') }}">
                    </a>
                </div><!-- Copy Right Logo -->
                <!-- Copy Right Content -->
                <div class="col-md-10">
                    <p>
                        {{ __('Địa chỉ: số 18, đường Ung Văn Khiêm, phường Long Xuyên, tỉnh An Giang') }}<br>
                        {{ __('Điện thoại') }}: +84 296 6256565 ext 1900&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: <a href="mailto:webmaster@agu.edu.vn">webmaster@agu.edu.vn</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Fax') }}: +84 296 3842560<br>
                        © Copyright 2017. {{ __('Trường Đại học An Giang') }}. | {{ __('Phát triển bởi') }} <a href="http://cict.agu.edu.vn" title="{{ __('Trung tâm Tin học Trường Đại học An Giang') }}">{{ __('Trung tâm Tin học Trường Đại học An Giang') }}</a>
                    </p>
                </div><!-- Copy Right Content -->
                <!-- Copy Right Content -->
            </div><!-- Footer Copyright -->
        </div><!-- Footer Copyright container -->
    </div><!-- Footer Copyright -->
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
@section('js') @show
</body>
</html>
