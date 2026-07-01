@extends('Frontend.TuyenSinh.layout')
@section('title', $ds['ten'])
@section('description', $ds['mo_ta'])
@if(isset($ds['photos'][0]['aliasname']) && $ds['photos'][0]['aliasname'])
    @section('image', env('APP_URL') . "storage/images/thumb_360x200/".$ds['photos'][0]['aliasname'])
@else
    @section('image', env('APP_URL') . "assets/frontend/images/blog/blog-02.jpg")
@endif
@section('css')
    <style>
        .blog-single-details ul {
            list-style-type: square;
            padding-left: 50px;
        }
        .blog-single-details ul li {
            padding: 3px;
        }
        ul.thumbnail-widget {
            padding-left: 0px;
        }
    </style>
@endsection
@section('body')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0&appId=131376384294659&autoLogAppEvents=1" nonce="xz8OBKsp"></script>
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
        <div class="row">
            <div class="col-12 col-md-9">
                <h4>{{ $ds['ten'] }}</h4>
                <ul class="blog-meta">
                    <li><i class="fa fa-calendar-o"></i> {{ App\Http\Controllers\ObjectController::getDate($ds['date_post'],"d/m/Y H:i") }}
                    </li>
                    @if($ds['id_cat'])
                    <li>
                        @foreach($ds['id_cat'] as $c)
                            @php
                                if(app()->getLocale() == 'vi') $taxonomy = 'tuyen-sinh';
                                else $taxonomy = 'admissions';
                            @endphp
                            <i class="fa fa-tags"></i> <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/{{ $c }}">{{ $arr_cats[$c] }}</a>
                        @endforeach
                    </li>
                    @endif
                    @php
                        $views = App\Models\Views::where('path','=',Request::path())->count();
                    @endphp
                    @if($views)
                        <li><i class="fa fa-eye"></i> {{ $views }}</li>
                    @endif
                    <li style="line-height:35px;">
                        <div class="fb-like" data-href="{{ Request::fullUrl() }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
                    </li>
                </ul>
                <p> {{ $ds['mo_ta'] }}</p>
                {!! $ds['noi_dung'] !!}
                @if($ds['photos'])
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <h5><i class="uni-camera-2"></i> {{ __('HÌNH ẢNH') }}</h5>
                        <hr />
                        <br />
                        <div class="isotope-grid grid-three-column has-gutter-space" data-gutter="20" data-columns="3">
                            <div class="grid-sizer"></div>
                            @foreach($ds['photos'] as $h)
                            <div class="item">
                                <div class="image-wrapper">
                                    <!-- IMAGE -->
                                    <img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ $h['aliasname'] }}" title="{{ $h['title'] }}" alt="{{ $h['title'] }}">
                                    <!-- Gallery Btns Wrapper -->
                                    <div class="gallery-detail btns-wrapper">
                                        <a href="{{ env('APP_URL') }}storage/images/origin/{{ $h['aliasname'] }}" data-rel="prettyPhoto[portfolio]" title="{{ $h['title'] }}" class="btn uni-full-screen"></a>
                                    </div><!-- Gallery Btns Wrapper -->
                                </div><!-- Image Wrapper -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @if($ds['attachments'])
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <h5><i class="uni-file-zip"></i> {{ __('ĐÍNH KÈM') }}</h5>
                        <hr />
                        <table class="table table-border table-striped table-sm" style="font-size:18px;">
                            <thead>
                                <tr>
                                  <th class="text-center">STT</th>
                                  <th>Nội dung</th>
                                  <th class="text-center">Tải về</th>
                                </tr>
                          </thead>
                            <tbody>
                            @foreach($ds['attachments'] as $key => $dk)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td>
                                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/xem-truc-tuyen/{{ $ds['_id'] }}/{{ $key }}" onclick="return false;" class="view_online">
                                            {{ $dk['title'] }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/tai-ve/{{ $ds['_id'] }}/{{ $key }}">
                                            <i class="uni-download-fromcloud" style="font-size:20px;font-weight:bold;"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-12 col-md-3">
                @php
                    $widget_tintucmoi = App\Models\ThongTinTuyenSinh::where('locale','=',app()->getLocale())->where('_id', '<>', $ds['_id'])->orderBy('date_post', 'desc')->take(6)->get();
                    if(app()->getLocale() == 'vi') $detail_taxonomy = 'tuyen-sinh/thong-tin';
                    else $detail_taxonomy = 'admissions/information';
                @endphp
                @if($widget_tintucmoi)
                <div class="widget">
                    <h5 class="widget-title">{{ __('Tin tức mới') }}<span></span></h5>
                    <ul class="thumbnail-widget">
                        @foreach($widget_tintucmoi as $ttm)
                        <li>
                            <div class="thumb-wrap">
                                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $detail_taxonomy }}/{{ $ttm['slug'] }}">
                                    @if(isset($ttm['photos'][0]['aliasname']) && $ttm['photos'][0]['aliasname'])
                                        <img src="{{ env('APP_URL') }}storage/images/thumb_50/{{ $ttm['photos'][0]['aliasname'] }}" width="60" height="60" alt="{{ $ttm['ten'] }}" title="{{ $ttm['ten'] }}">
                                    @else
                                        <img src="{{ env('APP_URL') }}assets/frontend/images/default/thumb_agu.jpg" width="60" height="60" alt="{{ $ttm['ten'] }}" title="{{ $ttm['ten'] }}">
                                    @endif
                                </a>
                            </div>
                            <div class="thumb-content">
                                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $detail_taxonomy }}/{{ $ttm['slug'] }}" alt="{{ $ttm['ten'] }}" title="{{ $ttm['ten'] }}">{{ Str::limit($ttm['ten'],50) }}</a><span>{{ App\Http\Controllers\ObjectController::getDate($ttm['date_post'], "d/m/Y H:i") }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        </div>
    </div>
</div>
@if($tin_lien_quan && count($tin_lien_quan) > 0)
<section class="bg-grey">
    <div class="container">
        <div class="row m-t-30">
            <div class="col-md-12">
                <h5><i class="uni-cursor-click2"></i> {{ __('TIN LIÊN QUAN') }}</h5>
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel dots-inline"
                        data-animatein=""
                        data-animateout=""
                        data-items="1"
                        data-loop="true"
                        data-merge="true"
                        data-nav="true"
                        data-dots="true"
                        data-stagepadding=""
                        data-margin="30"
                        data-mobile="1"
                        data-tablet="3"
                        data-desktopsmall="3"
                        data-desktop="3"
                        data-autoplay="false"
                        data-delay="3000"
                        data-navigation="true">
                    @foreach($tin_lien_quan as $tmn)
                    <div class="item">
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
                                <h5><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/thong-tin/{{ $tmn['slug'] }}">{{ $tmn['ten'] }}</a></h5>
                                <ul class="blog-meta">
                                    <li><i class="fa fa-calendar-o"></i> {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'],"d/m/Y H:i") }}</li>
                                    {{-- <li><i class="fa fa-comments"></i> 22</li> --}}
                                </ul><!-- Blog Meta -->
                                <p class="mo_ta">{{ $tmn['mo_ta'] }}</p>
                                <a class="btn" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/thong-tin/{{ $tmn['slug'] }}">{{ __('Xem thêm') }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endif
<div id="xemdinhkem" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="width:95%;">
        <div class="modal-content" style="height:800px !important;">
            <div class="modal-header">
                <h4 class="modal-title" id="myExtraLargeModalLabel">{{ __("Xem chi tiết đính kèm") }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="chitiet" class="modal-body" style="height:700px; overflow:hidden;">
                <h3>Đang tải về (Loadding...), Vui lòng chờ.</h3>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript">
        jQuery(document).ready(function(){
            $(".view_online").click(function(){
                var href = $(this).attr("href");
                $("#xemdinhkem").modal('show');
                $.get(href, function(html_view){
                    $("#chitiet").html(html_view);
                });
            });
        });
    </script>
@endsection