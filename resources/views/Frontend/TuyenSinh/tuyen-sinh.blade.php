@extends('Frontend.TuyenSinh.layout')
@section('css')
    <style>
        .content-box h5 {
            color:#fff;
            font-weight:bold;
        }
        .text-white {
            color:#fff;
            font-size: 30px;
        }
    </style>
@endsection
@section('title', __($title))
@section('body')
<section class="typo-dark bg-lgrey">
    <div class="container">
        @if($slug == 'dai-hoc-chinh-quy' || $slug == 'dai-hoc-vua-lam-vua-hoc' || $slug == 'dai-hoc-lien-thong-tu-cao-dang' || $slug=='dai-hoc-van-bang-2')
            @include('Frontend.TuyenSinh.widget-thong-tin')
        @endif
        <div class="row">
            <!-- Title -->
            <div class="col-sm-12">
                <div class="title-container">
                    <div class="title-wrap">
                        <h3 class="title">{{ __($title) }}</h3>
                        <span class="separator line-separator"></span>
                    </div>
                </div>
            </div><!-- Title -->
        </div><!-- Row -->
        @if($danhsach && count($danhsach) > 0)
        <div class="row thong-tin">
            @foreach($danhsach as $tmn)
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
                            <h5><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/thong-tin/{{ $tmn['slug'] }}" title="{{ $tmn['ten'] }}">{{ $tmn['ten'] }}</a></h5>
                            <ul class="blog-meta">
                                <li><i class="fa fa-calendar-o"></i> {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'],"d/m/Y H:i") }}</li>
                                {{-- <li><i class="fa fa-comments"></i> 22</li> --}}
                            </ul><!-- Blog Meta -->
                            <p class="mo_ta" style="height: 60px;  overflow:hidden;">{{ $tmn['mo_ta'] }}</p>
                            <a class="btn" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/thong-tin/{{ $tmn['slug'] }}">{{ __('Xem thêm') }}</a>
                        </div><!-- Blog Detail Wrapper -->
                    </div><!-- Blog Wrapper -->
                </div><!-- Column -->
            @endforeach
            </div><!-- Row -->
            <div class="row">
                <div class="col-12">
                    {{ $danhsach->withPath(env('APP_URL') . app()->getLocale() . '/' . $path . '?q='.Request::input('q')) }}
                </div>
            </div>
        @else 
            <h4><i class="uni-brush"></i> {{ __('Chưa có bài viết') }}</h4>
        
        @endif
    </div>
</section>


@endsection
