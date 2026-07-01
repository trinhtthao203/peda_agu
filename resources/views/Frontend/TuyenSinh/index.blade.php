@extends('Frontend.TuyenSinh.layout')
@section('title', __('Thông tin Tuyển sinh Trường Đại học An Giang'))
@section('body')
@php
$banner = App\Models\Banner::where('locale','=',app()->getLocale())
        ->where('status' , '=', 1)->where('tuyen_sinh', '=', 1)
        ->orderBy('order','asc')->orderBy('updated_at', 'desc')->get();
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
@endif
{{-- 
<div class="rs-container light rev_slider_wrapper">
    <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"delay": 9000, "gridwidth": 1170, "gridheight": 500}'>
        <ul>
        
            <li data-transition="fade" class="typo-dark heavy">
                <img src="{{ env('APP_URL') }}assets/frontend/images/banner_ts.jpg"
                    alt="Thông tin Tuyển sinh"
                    title="Thông tin Tuyển sinh"
                    data-bgposition="center center"
                    data-bgfit="cover"
                    data-bgrepeat="no-repeat"
                    class="rev-slidebg">
                </a> 
            </li>
        </ul>
    </div>
</div>
 --}}
 <section class="typo-dark bg-lgrey">
    <div class="container">
        {{-- <div class="row">
            <div class="col-sm-12">
                <div class="title-container">
                    <div class="title-wrap">
                        <h3 class="title">{{ __('Tin mới nhất') }}</h3>
                        <span class="separator line-separator"></span>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="tab"> 
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#news" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">{{ __('Tin mới nhất') }}</a></li>
                        <li role="presentation" class=""><a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">{{ __('Sau Đại học') }}</a></li>
                        <li role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">{{ __('Đại học Chính quy') }}</a></li>
                        <li role="presentation" class=""><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false">{{ __('Vừa làm Vừa học') }}</a></li>
                        <li role="presentation" class=""><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">{{ __('Đào tạo Ngắn hạn') }}</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="news">
                            @if($tin_moi_nhat && count($tin_moi_nhat) > 0)
                                <div class="row">
                                    @foreach($tin_moi_nhat as $sdh)
                                        <!-- Item Begins -->
                                        <div class="col-sm-4" style="margin-bottom:20px;">
                                            <!-- Blog Grid Wrapper -->
                                            <div class="blog-wrap">
                                                <!-- Blog Image Wrapper -->
                                                <div class="blog-img-wrap">
                                                    @if(isset($sdh['photos'][0]['aliasname']) && $sdh['photos'][0]['aliasname'])
                                                        <img width="600" height="220" src="{{ env('APP_ASSETS') }}storage/images/thumb_360x200/{{ $sdh['photos'][0]['aliasname'] }}" class="img-responsive" alt="{{ $sdh['ten'] }}">
                                                    @else
                                                        <img width="600" height="220" src="{{ env('APP_ASSETS') }}assets/frontend/images/blog/blog-02.jpg" class="img-responsive" alt="{{ $sdh['ten'] }}">
                                                    @endif
                                                </div><!-- Blog Wraper -->
                                                <!-- Blog Detail Wrapper -->
                                                <div class="blog-details">
                                                    <h5><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('tuyen-sinh/thong-tin') }}/{{ $sdh['slug'] }}" title="{{ $sdh['ten'] }}">{{ $sdh['ten'] }}</a></h5>
                                                    <ul class="blog-meta">
                                                        <li><i class="fa fa-calendar-o"></i> {{ App\Http\Controllers\ObjectController::getDate($sdh['date_post'], "d/m/Y") }}</li>
                                                        {{-- <li><i class="fa fa-comments"></i> 22</li> --}}
                                                    </ul><!-- Blog Meta -->
                                                    <p class="mo_ta" style="height: 60px;overflow:hidden;">{{ $sdh['mo_ta'] }}</p>
                                                    <a class="btn" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('tuyen-sinh/thong-tin') }}/{{ $sdh['slug'] }}">{{ __('Xem thêm') }}</a>
                                                </div><!-- Blog Detail Wrapper -->
                                            </div><!-- Blog Wrapper -->
                                        </div><!-- Column -->
                                    @endforeach
                                </div>
                            @else 
                                <h5>Chưa có bài viết.... Đang cập nhật.</h5>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="home">
                            @if($sau_dai_hoc && count($sau_dai_hoc) > 0)
                                <div class="row">
                                    @foreach($sau_dai_hoc as $sdh)
                                        <!-- Item Begins -->
                                        <div class="col-sm-4">
                                            <!-- Blog Grid Wrapper -->
                                            <div class="blog-wrap">
                                                <!-- Blog Image Wrapper -->
                                                <div class="blog-img-wrap">
                                                    @if(isset($sdh['photos'][0]['aliasname']) && $sdh['photos'][0]['aliasname'])
                                                        <img width="600" height="220" src="{{ env('APP_ASSETS') }}storage/images/thumb_360x200/{{ $sdh['photos'][0]['aliasname'] }}" class="img-responsive" alt="{{ $sdh['ten'] }}">
                                                    @else
                                                        <img width="600" height="220" src="{{ env('APP_ASSETS') }}assets/frontend/images/blog/blog-02.jpg" class="img-responsive" alt="{{ $sdh['ten'] }}">
                                                    @endif
                                                </div><!-- Blog Wraper -->
                                                <!-- Blog Detail Wrapper -->
                                                <div class="blog-details">
                                                    <h5><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('tuyen-sinh/thong-tin') }}/{{ $sdh['slug'] }}" title="{{ $sdh['ten'] }}">{{ $sdh['ten'] }}</a></h5>
                                                    <ul class="blog-meta">
                                                        <li><i class="fa fa-calendar-o"></i> {{ App\Http\Controllers\ObjectController::getDate($sdh['date_post'], "d/m/Y") }}</li>
                                                        {{-- <li><i class="fa fa-comments"></i> 22</li> --}}
                                                    </ul><!-- Blog Meta -->
                                                    <p class="mo_ta" style="height: 60px;overflow:hidden;">{{ $sdh['mo_ta'] }}</p>
                                                    <a class="btn" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('tuyen-sinh/thong-tin') }}/{{ $sdh['slug'] }}">{{ __('Xem thêm') }}</a>
                                                </div><!-- Blog Detail Wrapper -->
                                            </div><!-- Blog Wrapper -->
                                        </div><!-- Column -->
                                    @endforeach
                                </div>
                                <div class="row" style="padding:20px;">
                                    <div class="col-12">
                                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/dai-hoc-chinh-quy" class="btn pull-right" style="background:#ff0000;"><i class="uni-paper-plane"></i> {{ __('Xem tất cả') }}</a>
                                    </div>
                                </div>
                            @else 
                                <h5><i class="uni-brush"></i> Chưa có bài viết.... Đang cập nhật.</h5>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile">
                            @if($dai_hoc_chinh_quy && count($dai_hoc_chinh_quy) > 0)
                                <div class="row">
                                    @foreach($dai_hoc_chinh_quy as $tmn)
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
                                                    <h5><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('tuyen-sinh/thong-tin') }}/{{ $tmn['slug'] }}" title="{{ $tmn['ten'] }}">{{ $tmn['ten'] }}</a></h5>
                                                    <ul class="blog-meta">
                                                        <li><i class="fa fa-calendar-o"></i> {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'], "d/m/Y") }}</li>
                                                        {{-- <li><i class="fa fa-comments"></i> 22</li> --}}
                                                    </ul><!-- Blog Meta -->
                                                    <p class="mo_ta" style="height: 60px;overflow:hidden;">{{ $tmn['mo_ta'] }}</p>
                                                    <a class="btn" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('tuyen-sinh/thong-tin') }}/{{ $tmn['slug'] }}">{{ __('Xem thêm') }}</a>
                                                </div><!-- Blog Detail Wrapper -->
                                            </div><!-- Blog Wrapper -->
                                        </div><!-- Column -->
                                    @endforeach
                                </div>
                                <div class="row" style="padding:20px;">
                                    <div class="col-12">
                                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/dai-hoc-chinh-quy" class="btn pull-right" style="background:#ff0000;"><i class="uni-paper-plane"></i> {{ __('Xem tất cả') }}</a>
                                    </div>
                                </div>
                            @else 
                                <h5><i class="uni-brush"></i> Chưa có bài viết.... Đang cập nhật.</h5>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="messages">
                            @if($vua_lam_vua_hoc && count($vua_lam_vua_hoc) > 0)
                                <div class="row">
                                    @foreach($vua_lam_vua_hoc as $tmn)
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
                                                    <h5><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('tuyen-sinh/thong-tin') }}/{{ $tmn['slug'] }}" title="{{ $tmn['ten'] }}">{{ $tmn['ten'] }}</a></h5>
                                                    <ul class="blog-meta">
                                                        <li><i class="fa fa-calendar-o"></i> {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'], "d/m/Y") }}</li>
                                                        {{-- <li><i class="fa fa-comments"></i> 22</li> --}}
                                                    </ul><!-- Blog Meta -->
                                                    <p class="mo_ta" style="height: 60px;overflow:hidden;">{{ $tmn['mo_ta'] }}</p>
                                                    <a class="btn" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('tuyen-sinh/thong-tin') }}/{{ $tmn['slug'] }}">{{ __('Xem thêm') }}</a>
                                                </div><!-- Blog Detail Wrapper -->
                                            </div><!-- Blog Wrapper -->
                                        </div><!-- Column -->
                                    @endforeach
                                </div>
                                <div class="row" style="padding:20px;">
                                    <div class="col-12">
                                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/dai-hoc-vua-lam-vua-hoc" class="btn pull-right" style="background:#ff0000;"><i class="uni-paper-plane"></i> {{ __('Xem tất cả') }}</a>
                                    </div>
                                </div>
                            @else 
                                <h5><i class="uni-brush"></i> Chưa có bài viết.... Đang cập nhật.</h5>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="settings">
                            @if($dao_tao_ngan_han && count($dao_tao_ngan_han) > 0)
                                <div class="row">
                                    @foreach($dao_tao_ngan_han as $tmn)
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
                                                    <h5><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('tuyen-sinh/thong-tin') }}/{{ $tmn['slug'] }}" title="{{ $tmn['ten'] }}">{{ $tmn['ten'] }}</a></h5>
                                                    <ul class="blog-meta">
                                                        <li><i class="fa fa-calendar-o"></i> {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'], "d/m/Y") }}</li>
                                                        {{-- <li><i class="fa fa-comments"></i> 22</li> --}}
                                                    </ul><!-- Blog Meta -->
                                                    <p class="mo_ta" style="height: 60px;overflow:hidden;">{{ $tmn['mo_ta'] }}</p>
                                                    <a class="btn" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('tuyen-sinh/thong-tin') }}/{{ $tmn['slug'] }}">{{ __('Xem thêm') }}</a>
                                                </div><!-- Blog Detail Wrapper -->
                                            </div><!-- Blog Wrapper -->
                                        </div><!-- Column -->
                                    @endforeach
                                </div>
                                <div class="row" style="padding:20px;">
                                    <div class="col-12">
                                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/dao-tao-ngan-han" class="btn pull-right" style="background:#ff0000;"><i class="uni-paper-plane"></i> {{ __('Xem tất cả') }}</a>
                                    </div>
                                </div>
                            @else 
                                <h5><i class="uni-brush"></i> Chưa có bài viết.... Đang cập nhật.</h5>
                            @endif
                        </div>
                    </div><!-- Tab Content -->
                </div>
            </div>
        </div>
    </div>
 </section>
{{-- 
@if($tin_moi_nhat)
<section class="typo-dark bg-lgrey">
    <div class="container">
        <div class="row">
            <!-- Title -->
            <div class="col-sm-12">
                <div class="title-container">
                    <div class="title-wrap">
                        <h3 class="title">{{ __('Tin mới nhất') }}</h3>
                        <span class="separator line-separator"></span>
                    </div>
                </div>
            </div><!-- Title -->
        </div><!-- Row -->
        <div class="row">
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
                        <h5><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('tuyen-sinh/thong-tin') }}/{{ $tmn['slug'] }}" title="{{ $tmn['ten'] }}">{{ $tmn['ten'] }}</a></h5>
                        <ul class="blog-meta">
                            <li><i class="fa fa-calendar-o"></i> {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'], "d/m/Y") }}</li>
                            <li><i class="fa fa-comments"></i> 22</li>
                        </ul><!-- Blog Meta -->
                        <p class="mo_ta" style="height: 60px;overflow:hidden;">{{ $tmn['mo_ta'] }}</p>
                        <a class="btn" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('tuyen-sinh/thong-tin') }}/{{ $tmn['slug'] }}">{{ __('Xem thêm') }}</a>
                    </div><!-- Blog Detail Wrapper -->
                </div><!-- Blog Wrapper -->
            </div><!-- Column -->
        @endforeach
        </div><!-- Row -->
        <br />
        <div class="row">
            <div class="col-sm-12 text-right">
                @if(app()->getLocale() == 'vi')
                    <p><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/tin-moi-nhat" class="btn btn-primary bg-pink"><i class="uni-paper-plane"></i> {{ __('Xem tất cả') }}</a></p>
                @else
                    <p><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admissions/lastes-news" class="btn btn-primary bg-pink"><i class="uni-paper-plane"></i> {{ __('Xem tất cả') }}</a></p>
                @endif
            </div>
        </div>
    </div><!-- Container -->
</section><!-- Section -->
@endif
--}}
@endsection