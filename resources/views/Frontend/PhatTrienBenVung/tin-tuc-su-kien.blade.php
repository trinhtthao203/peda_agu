@extends('Frontend.PhatTrienBenVung.layout')
@section('title', __($title))
@section('body')
<style>
    h4 {
        color: #00bb62 !important;font-weight: bold !important;
    }
    .image-wrapper img {
        max-height: 250px !important;
    }
</style>
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
                        <h5><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/phat-trien-ben-vung/{{ $tmn['slug'] }}" title="{{ $tmn['ten'] }}">{{ $tmn['ten'] }}</a></h5>
                        <ul class="blog-meta">
                            <li><i class="fa fa-calendar-o"></i> {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'],"d/m/Y H:i") }}</li>
                            <li>
                                @if(isset($tmn['id_sdg_tags']) && $tmn['id_sdg_tags'])
                                    @foreach($tmn['id_sdg_tags'] as $st)
                                        <img src="{{ env('APP_URL') }}assets/frontend/images/sdg-tags/{{ $st }}_{{ $tmn['locale'] }}.png" alt="{{ __($sdg_tags[$st]) }}" title="{{ __($sdg_tags[$st]) }}" style="height: 25px;cursor: pointer;"/>
                                    @endforeach
                                @endif
                            </li>
                        </ul><!-- Blog Meta -->
                        <p class="mo_ta">{{ $tmn['mo_ta'] }}</p>
                        <a class="btn" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/phat-trien-ben-vung/{{ $tmn['slug'] }}">{{ __('Xem thêm') }}</a>
                    </div><!-- Blog Detail Wrapper -->
                </div><!-- Blog Wrapper -->
            </div><!-- Column -->
        @endforeach
        </div><!-- Row -->
        <div class="row">
            <div class="col-12">
                {{ $danhsach->withPath(env('APP_URL') . app()->getLocale() .'/' . __('phat-trien-ben-vung'). '/tin-tuc-su-kien/'.'?q='.Request::input('q')) }}
            </div>
        </div>
    </div>
</section>

@endif
@endsection
