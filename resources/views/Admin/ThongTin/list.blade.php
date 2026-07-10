@extends('Admin.layout')
@section('title', __('Thông tin'))
@section('css')
<link href="{{ env('APP_URL') }}assets/backend/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/magnific-popup.css" />
<link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.css" />
@endsection
@section('body')
<div class="row">
    <div class="col-12 card-box">
        <h3 class="m-t-0"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/thong-tin/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ __('Thêm mới') }}</a> {{ __('Bài đăng') }}</h3>
        <hr />
        <form method="GET" action="{{ env('APP_URL') . app()->getLocale() }}/admin/thong-tin">
            <div class="row form-group">
                <div class="col-12 col-md-4">
                    <input type="text" name="keywords" id="keywords" value="{{ $keywords }}" placeholder="Tìm Tên" class="form-control">
                </div>
                <div class="col-12 col-md-4">
                    <select name="id_cat" class="form-control select2">
                        <option value="">{{ __('Danh mục thông tin') }}</option>
                        @foreach($dmthongtin as $tt)
                        <option value="{{ $tt['_id'] }}" @if($id_cat==$tt['_id']) selected @endif>{{ $tt['ten'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" name="submit" value="Search" class="btn btn-primary"><i class="fa fa-search"></i> {{ __('Tìm') }}</button>
                </div>
            </div>
        </form>
        @if($danhsach)
        <table class="table table-border table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>{{ __('STT') }}</th>
                    <th>{{ __('Hình') }}</th>
                    <th>{{ __('Tên') }}</th>
                    <th>{{ __('Danh mục') }}</th>
                    <th style="width:55px;">#</th>
                    @foreach($arr_lang as $klang => $vlang)
                    @if($klang != app()->getLocale())
                    <th><img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}.jpg" alt="" class="flag-icon"></th>
                    @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($danhsach as $key => $ds)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td class="text-center">
                        @if(isset($ds['photos'][0]['aliasname']) && $ds['photos'][0]['aliasname'])
                        <a href="{{ env('APP_URL') }}storage/images/origin/{{ $ds['photos'][0]['aliasname'] }}" class="image-popup">
                            <img src="{{ env('APP_URL') }}storage/images/thumb_50/{{ $ds['photos'][0]['aliasname'] }}" title="{{ $ds['ho_ten'] }}" alt="{{ $ds['ho_ten'] }}" style="height:30px;">
                        </a>
                        @else
                        {{ __('NO PIC') }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/@if(app()->getLocale() == 'vi'){{ 'chi-tiet-thong-tin' }}@else{{ ('detail-news-and-events') }}@endif/{{ $ds['slug'] }}" target="_blank"><strong>{{ $ds['ten'] }}</strong></a>
                        <span class="badge badge-info"><small>{{ App\Http\Controllers\ObjectController::getDate($ds['date_post'],"d/m/Y H:i") }}</small></span>
                    </td>
                    <td class="text-center">
                        @if($ds['id_cat'])
                        <div class="btn-group mb-2 dropleft" style="margin:0px !important;">
                            <button class="btn btn-info btn-sm waves-effect waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="line-height:12px;">
                                {{ __('Danh mục') }} <span class="badge badge-danger">{{ count($ds['id_cat']) }}</span>
                            </button>
                            <div class="dropdown-menu">
                                @foreach($ds['id_cat'] as $key => $cat)
                                @php
                                $c = App\Models\DMThongTin::find($cat);
                                @endphp
                                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/thong-tin?id_cat={{ $cat }}" class="dropdown-item"><i class="fa fa-tag text-primary"></i> {{ $c['ten'] }}</a>
                                @endforeach
                            </div>
                        </div>
                        @else
                        {{ __('Không danh mục') }}
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/thong-tin/edit/{{ $ds['_id'] }}"><i class="fas fa-edit" style="color: rgba(255, 142, 0, 1.00)"></i></a>
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/thong-tin/delete/{{ $ds['_id'] }}" onclick="return confirm('Chắc chắc xóa?')"><i class="fas fa-trash" style="color: rgb(255, 44, 0);"></i></a>&nbsp;
                    </td>
                    @foreach($arr_lang as $klang => $vlang)
                    @if($klang != app()->getLocale())
                    @php
                    $lang = $ds['locale'];
                    $id_path = App\Http\Controllers\ObjectController::ObjectId($ds['_id']);
                    $transpath = App\Models\TranslatePath::where("id_".$lang,"=",$id_path)->where('collection','=','thong_tin')->first();
                    @endphp
                    <td class="text-center text-middle">
                        @if($transpath && isset($transpath['id_'.$klang]))
                        <a href="{{ env('APP_URL') }}{{ $klang }}/admin/thong-tin/edit/{{ $transpath["id_$klang"] }}?trans_id={{ $ds['_id'] }}&trans_lang={{ app()->getLocale() }}">
                            <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}.jpg" alt="" class="flag-icon">
                        </a>
                        @else
                        <a href="{{ env('APP_URL') }}{{ $klang }}/admin/thong-tin/add?trans_id={{ $ds['_id'] }}&trans_lang={{ app()->getLocale() }}">
                            <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}_black.jpg" alt="" class="flag-icon">
                        </a>
                        @endif
                    </td>
                    @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'])
        {{ $danhsach->withPath(env('APP_URL') . app()->getLocale() . '/admin/thong-tin?' . $_SERVER['QUERY_STRING']) }}
        @else
        {{ $danhsach->withPath(env('APP_URL') . app()->getLocale() . '/admin/thong-tin?') }}
        @endif
        @endif
    </div>
</div>
@endsection
@section('js')
<script src="{{ env('APP_URL') }}assets/backend/libs/jquery-toast/jquery.toast.min.js"></script>
<script type="text/javascript" src="{{ env('APP_URL') }}assets/backend/libs/isotope/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2();
        @if(Session::get('msg') != null && Session::get('msg'))
        $.toast({
            heading: "Thông báo",
            text: "{{ Session::get('msg') }}",
            loaderBg: "#3b98b5",
            icon: "info",
            hideAfter: 3e3,
            stack: 1,
            position: "top-right"
        });
        @endif
        $('.image-popup').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-fade',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            }
        });
    });
</script>
@endsection
