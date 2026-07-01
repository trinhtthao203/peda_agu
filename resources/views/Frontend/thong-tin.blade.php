@extends('Frontend.layout')
@section('title', __($title))
@section('body')
@if($danhsach)
<section class="typo-dark bg-lgrey">
    <div class="container">
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
                        <h5><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/chi-tiet-thong-tin/{{ $tmn['slug'] }}" title="{{ $tmn['ten'] }}">{{ $tmn['ten'] }}</a></h5>
                        <ul class="blog-meta">
                            <li><i class="fa fa-calendar-o"></i> {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'],"d/m/Y H:i") }}</li>
                            {{-- <li><i class="fa fa-comments"></i> 22</li> --}}
                        </ul><!-- Blog Meta -->
                        <p class="mo_ta">{{ $tmn['mo_ta'] }}</p>
                        <a class="btn" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/chi-tiet-thong-tin/{{ $tmn['slug'] }}">{{ __('Xem thêm') }}</a>
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
    </div>
</section>

@endif
@endsection
