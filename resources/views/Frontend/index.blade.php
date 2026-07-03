@extends('Frontend.layout')
@section('title', __('Trang chủ'))
@section('css')
<style>
    ul.list-news-home-ts {
        list-style-type: square;
        padding: 20px 30px 20px 30px;
        font-size: 18px;
    }

    ul.list-news-home-ts li {
        padding: 3px;
    }

    #daycounter-hero {
        width: 500px;
        position: absolute;
        right: 100px;
        top: 490px;
    }

    #home-new {
        margin-top: 0px !important;
    }

    @media screen and (max-width: 640px) {
        #daycounter-hero {
            width: 100%;
            top: 290px;
            left: 0px;
            font-size: 15px !important;
            background: #007326 !important;
            margin-top: -15px;
        }

        .countdown-section {
            padding: 18px 0px 18px 0px;
            font-size: 18px;
            width: 25%;

        }

        .countdown-amount {
            font-size: 20px !important;
            padding: 0px;
            line-height: 20px;
        }

        #home-new {
            margin-top: 10px !important;
        }
    }

    @media screen and (max-width: 430px) {
        #daycounter-hero {
            margin-top: -10px;
        }

        #home-new {
            margin-top: -10px !important;
        }
    }

    @media screen and (min-width: 1920px) {
        .tp-revslider-mainul {
            min-height: 700px !important;
        }

        #daycounter-hero {
            top: 700px;
            right: 400px;
            font-size: 50px !important;
        }

        #home-new {
            margin-top: 160px !important;
        }

        .countdown-amount {
            font-size: 50px !important;
            padding: 0px;
            line-height: 30px;
        }

    }
</style>
@endsection
@section('body')
@include('Frontend.widget_banner')
{{-- <div id="daycounter-hero" class="daycounter clearfix" data-counter="down" data-year="2024" data-month="11" data-date="16"></div>
<br /> --}}
<section class="typo-dark" id="home-new">
    <div class="container">
        <div class="row">
            @if($tin_moi_nhat && count($tin_moi_nhat) > 0)
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title" style="font-size:22px;font-weight:bold;"><i class="uni-globe"></i> {{ __('Tin mới nhất') }}</h3>
                </div>
                <div class="panel-body">
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
                                    <h5><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('chi-tiet-thong-tin') }}/{{ $tmn['slug'] }}" title="{{ $tmn['ten'] }}">{{ $tmn['ten'] }}</a></h5>
                                    <ul class="blog-meta">
                                        <li><i class="fa fa-calendar-o"></i> {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'], "d/m/Y") }}</li>
                                        <li>
                                            @if(isset($tmn['id_sdg_tags']) && $tmn['id_sdg_tags'])
                                            @foreach($tmn['id_sdg_tags'] as $st)
                                            <img src="{{ env('APP_URL') }}assets/frontend/images/sdg-tags/{{ $st }}_{{ $tmn['locale'] }}.png" alt="{{ __($sdg_tags[$st]) }}" title="{{ __($sdg_tags[$st]) }}" style="height: 25px;cursor: pointer;" />
                                            @endforeach
                                            @endif
                                        </li>
                                    </ul><!-- Blog Meta -->

                                    <p class="mo_ta">{{ $tmn['mo_ta'] }}</p>
                                    <a class="btn" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('chi-tiet-thong-tin') }}/{{ $tmn['slug'] }}">{{ __('Xem thêm') }}</a>
                                </div><!-- Blog Detail Wrapper -->
                            </div><!-- Blog Wrapper -->
                        </div><!-- Column -->
                        @endforeach
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            @if(app()->getLocale() == 'vi')
                            <p><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/tin-moi-nhat" class="btn btn-primary bg-pink"><i class="uni-paper-plane"></i> {{ __('Xem tất cả') }}</a></p>
                            @else
                            <p><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events" class="btn btn-primary bg-pink"><i class="uni-paper-plane"></i> {{ __('Xem tất cả') }}</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        {{-- <div class="row">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title" style="font-size:22px;font-weight:bold;"><i class="uni-information"></i> {{ __('Thông tin về Trường Đại học An Giang') }}</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <!-- Count Block -->
                <div class="count-block dark bg-green">
                    <h5>{{ __('Chương trình Đào tạo') }}</h5>
                    <h3 data-count="63" class="count-number"><span class="counter">63</span></h3>
                    <i class="uni-fountain-pen"></i>
                </div><!-- Counter Block -->
            </div><!-- Column -->
            <div class="col-sm-6 col-md-3">
                <!-- Count Block -->
                <div class="count-block dark bg-yellow">
                    <h5>{{ __('Đề tài NCKH') }}</h5>
                    <h3 data-count="624" class="count-number"><span class="counter">624</span></h3>
                    <i class="uni-chemical"></i>
                </div><!-- Counter Block -->
            </div><!-- Column -->
            <div class="col-sm-6 col-md-3">
                <!-- Count Block -->
                <div class="count-block dark bg-pink">
                    <h5>{{ __('Cán bộ - Giảng viên') }}</h5>
                    <h3 data-count="824" class="count-number"><span class="counter">824</span></h3>
                    <i class="uni-talk-man"></i>
                </div><!-- Counter Block -->
            </div><!-- Column -->
            <div class="col-sm-6 col-md-3">
                <!-- Count Block -->
                <div class="count-block dark bg-orange">
                    <h5>{{ __('Người học') }}</h5>
                    <h3 data-count="12281" class="count-number"><span class="counter">12281</span></h3>
                    <i class="uni-brain"></i>
                </div><!-- Counter Block -->
            </div><!-- Column -->
        </div>
    </div>
    </div>
    </div>--}}
    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title" style="font-size:22px;font-weight:bold;"><i class="uni-calendar-4"></i> {{ __('Lịch công tác') }}</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <span class="loading bg-orange"><i class="uni-repeat-2"></i> {{ __('Đang tải, vui lòng chờ') }}</span>
                    <div class="col-sm-12 col-md-12" id="calendar"></div>
                    <br />
                    <div class="col-sm-12 col-md-12">
                        <p><a class="ghost-button" href="https://calendar.google.com/calendar/u/0/r?cid=agu.edu.vn_qf2qof63stvjftctim9u8clh6c@group.calendar.google.com" target="_blank"><i class="uni-align-right"></i> {{ __('Xem thêm') }} </a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div><!-- Container -->
</section><!-- Section -->
@endsection
@section('js')
<script type="text/javascript">
    jQuery(document).ready(function() {
        var load = 0;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300 && load == 0) {
                $("#calendar").html('<iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=600&amp;wkst=2&amp;hl=vi&amp;bgcolor=%23FFFFFF&amp;src=agu.edu.vn_qf2qof63stvjftctim9u8clh6c%40group.calendar.google.com&amp;color=%23853104&amp;ctz=Asia%2FSaigon" style="border-width:0" width="100%" height="350" frameborder="0" scrolling="no"></iframe>');
                load = 1;
                setInterval(function() {
                    $(".loading").hide();
                }, 3000);
            }
        });
    });
</script>
@endsection
