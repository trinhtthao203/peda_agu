@extends('Frontend.PhatTrienBenVung.layout')
@section('title', __('Trang Thông tin về Phát triển bền vững Trường Đại học An Giang'))
@section('body')
<style>
    h5.student-name {
        font-size: 20px;
    }
    a:hover {
        color: #00bb62 !important;
        font-weight:bold;
    }
    h3.title {
        font-size: 30px; font-weight: bold;color:#06a95b;
    }
    .news-wrap .news-content {
        padding: 0px;
    }
    .news-wrap .news-content h5 {
        font-size: 16px;
    }
</style>
@php
$banner = App\Models\Banner::where('status' , '=', 1)->where('phat_trien_ben_vung', '=', 1)
        ->orderBy('order','asc')->orderBy('updated_at', 'asc')->get();
@endphp
@if($banner && count($banner) > 0)
<div class="rs-container light rev_slider_wrapper">
    <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"delay": 9000, "gridwidth": 1920, "gridheight": 500}'>
        <ul>
        @foreach($banner as $b)
        @if(isset($b['photos'][0]['aliasname']) && $b['photos'][0]['aliasname'])
            <li data-transition="fade" class="typo-dark heavy">
                @if(isset($b['url']) && $b['url'])  <a href="{{ $b['url'] }}"> @endif
                <img src="{{ env('APP_URL') }}storage/images/origin/{{ $b['photos'][0]['aliasname'] }}"
                    alt="{{ __($b['title']) }}"
                    title="{{ __($b['title']) }}"
                    data-bgposition="center center"
                    data-bgfit="cover"
                    data-bgrepeat="no-repeat"
                    class="rev-slidebg" style="width:100% !important;">
                @if(isset($b['url']) && $b['url'])  </a> @endif
            </li>
        @endif
        @endforeach
        </ul>
    </div>
</div><!-- Home Slider -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title-container sm">
                    <div class="title-wrap">
                        <h3 class="title">{{ __('Quy tắc về Bảo vệ Môi trường và Phát triển Bền vững tại Trường Đại học An Giang') }}</h3>
                        <span class="separator line-separator"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="news-wrap">
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/ve-nguon-nang-luong"><img class="img-responsive" src="{{ env('APP_URL') }}assets/frontend/images/phattrienbenvung/h1.jpg" alt="..." height="700" width="800"></a>
                    <div class="news-content">
                        <h5 class="text-center"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/phat-trien-ben-vung/ve-nguon-nang-luong">{{ __('Về nguồn năng lượng') }}</a></h5>                        
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="news-wrap">
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/ve-nguon-nuoc"><img class="img-responsive" src="{{ env('APP_URL') }}assets/frontend/images/phattrienbenvung/h2.jpg" alt="..." height="700" width="800"></a>
                    <div class="news-content">
                        <h5 class="text-center"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/ve-nguon-nuoc">{{ __('Về nguồn nước') }}</a></h5>                        
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="news-wrap">
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/hoat-dong-tai-che"><img class="img-responsive" src="{{ env('APP_URL') }}assets/frontend/images/phattrienbenvung/h3.jpg" alt="..." height="700" width="800"></a>
                    <div class="news-content">
                        <h5 class="text-center"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/hoat-dong-tai-che">{{ __('Hoạt động Tái chế') }}</a></h5>                        
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="news-wrap">
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/no-luc-cai-thien-tinh-hinh-giao-thong"><img class="img-responsive" src="{{ env('APP_URL') }}assets/frontend/images/phattrienbenvung/h4.jpg" alt="..." height="700" width="800"></a>
                    <div class="news-content">
                        <h5 class="text-center"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/no-luc-cai-thien-tinh-hinh-giao-thong">{{ __('Nỗ lực cải thiện tình hình giao thông') }}</a></h5>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-grey typo-dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title-container">
                    <div class="title-wrap">
                        <h3 class="title">{{ __('Các hoạt động Phát triển bền vững tại Trường Đại học An Giang') }}</h3>
                        <span class="separator line-separator"></span>
                    </div>
                </div>
            </div><!-- Title -->
        </div><!-- Row -->
        <div class="row">
            <div class="col-sm-3">
                <div class="student-wrap">
                    <div class="student-img-wrap">
                        <a href="{{ env('APP_URL') }}{{ APP()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/tai-su-dung-tai-lieu-giao-trinh">
                            <img width="200" height="200" src="{{ env('APP_URL') }}assets/frontend/images/phattrienbenvung/h5.jpg" alt="{{ __('Tái sử dụng tài liệu giáo trình') }}" class="img-responsive">
                        </a>
                    </div>
                    <div class="student-detail-wrap">
                        <h5 class="student-name"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/tai-su-dung-tai-lieu-giao-trinh">{{ __('Tái sử dụng tài liệu giáo trình') }}</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="student-wrap">
                    <div class="student-img-wrap">
                        <a href="{{ env('APP_URL') }}{{ APP()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/hoat-dong-trao-doi-sach">
                            <img width="200" height="200" src="{{ env('APP_URL') }}assets/frontend/images/phattrienbenvung/h6.jpg" alt="{{ __('Hoạt động trao đổi sách') }}" class="img-responsive">
                        </a>
                    </div>
                    <div class="student-detail-wrap">
                        <h5 class="student-name"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/hoat-dong-trao-doi-sach">{{ __('Hoạt động trao đổi sách') }}</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="student-wrap">
                    <div class="student-img-wrap">
                        <a href="{{ env('APP_URL') }}{{ APP()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/thu-nhan-pin-da-su-dung">
                            <img width="200" height="200" src="{{ env('APP_URL') }}assets/frontend/images/phattrienbenvung/h7.jpg" alt="{{ __('Thu nhận Pin đã sử dụng') }}" class="img-responsive">
                        </a>
                    </div>
                    <div class="student-detail-wrap">
                        <h5 class="student-name"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/thu-nhan-pin-da-su-dung">{{ __('Thu nhận Pin đã sử dụng') }}</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="student-wrap">
                    <div class="student-img-wrap">
                        <a href="{{ env('APP_URL') }}{{ APP()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/tao-san-pham-handmake-tu-vat-lieu-tai-che">
                            <img width="200" height="200" src="{{ env('APP_URL') }}assets/frontend/images/phattrienbenvung/h8.jpg" alt="{{ __('Tạo sản phẩm handmade từ vật liệu tái chế') }}" class="img-responsive">
                        </a>
                    </div>
                    <div class="student-detail-wrap">
                        <h5 class="student-name"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/tao-san-pham-handmake-tu-vat-lieu-tai-che">{{ __('Tạo sản phẩm handmade từ vật liệu tái chế') }}</a></h5>
                    </div>
                </div>
            </div>

        </div><!-- Row -->
    </div><!-- Container -->
</section>
@endif
@if($tin_moi_nhat && $tin_moi_nhat->count() > 0)
<section class="typo-dark">
    <div class="container">
        <div class="row">
            <!-- Title -->
            <div class="col-sm-12">
                <div class="title-container">
                    <div class="title-wrap">
                        <h3 class="title">{{ __('Tin tức – Sự kiện về phát triển bền vững') }}</h3>
                        <span class="separator line-separator"></span>
                    </div>
                </div>
            </div><!-- Title -->
        </div><!-- Row -->
        <div class="row">
            @if($tin_moi_nhat && count($tin_moi_nhat) > 0)
                @foreach($tin_moi_nhat as $tmn)
                    <!-- Item Begins -->
                    <div class="col-sm-4">
                        <!-- Blog Grid Wrapper -->
                        <div class="blog-wrap">
                            <!-- Blog Image Wrapper -->
                            <div class="blog-img-wrap">
                                @if(isset($tmn['photos'][0]['aliasname']) && $tmn['photos'][0]['aliasname'])
                                    <img width="600" height="220" src="{{ env('APP_ASSETS') }}storage/images/thumb_360x200/{{ $tmn['photos'][0]['aliasname'] }}" class="img-responsive" alt="{{ $tmn['ten'] }}">
                                @else
                                    <img width="600" height="220" src="{{ env('APP_ASSETS') }}assets/frontend/images/blog/blog-02.jpg" class="img-responsive" alt="{{ $tmn['ten'] }}">
                                @endif
                            </div><!-- Blog Wraper -->
                            <!-- Blog Detail Wrapper -->
                            <div class="blog-details">
                                <h5><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/{{ $tmn['slug'] }}" title="{{ $tmn['ten'] }}">{{ $tmn['ten'] }}</a></h5>
                                <ul class="blog-meta">
                                    <li><i class="fa fa-calendar-o"></i> {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'], "d/m/Y") }}</li>
                                    <li>
                                        @if(isset($tmn['id_sdg_tags']) && $tmn['id_sdg_tags'])
                                            @foreach($tmn['id_sdg_tags'] as $st)
                                                <img src="{{ env('APP_URL') }}assets/frontend/images/sdg-tags/{{ $st }}_{{ $tmn['locale'] }}.png" alt="{{ __($sdg_tags[$st]) }}" title="{{ __($sdg_tags[$st]) }}" style="height: 25px;cursor: pointer;"/>
                                            @endforeach
                                        @endif
                                    </li>
                                </ul><!-- Blog Meta -->
                                <p class="mo_ta">{{ $tmn['mo_ta'] }}</p>
                                <a class="btn" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/{{ $tmn['slug'] }}">{{ __('Xem thêm') }}</a>
                            </div><!-- Blog Detail Wrapper -->
                        </div><!-- Blog Wrapper -->
                    </div><!-- Column -->
                @endforeach
            @endif
        </div>
        <br />
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/tin-tuc-su-kien" class="btn btn-primary bg-pink">{{ __('Xem tất cả') }}</a>
            </div>
        </div>

    </div><!-- Container -->
</section><!-- Section -->
@endif

@endsection