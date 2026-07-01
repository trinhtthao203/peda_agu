@extends('Admin.layout')
@section('title', __('Tư vấn Tuyển sinh'))
@section('css')
    <link href="{{ env('APP_URL') }}assets/backend/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/magnific-popup.css"/>
    <link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.css"/>
@endsection
@section('body')
@php
    $arr_traloi = array(2 => 'Thông tin trả lời', 0 => 'Chưa trả lời',1 => 'Đã trả lời');
    $arr_congbo = array(2 => 'Thông tin Công bố', 0 => 'Chưa Công bố', 1 => 'Đã Công bố');
@endphp
<div class="row">
    <div class="col-12 card-box">
        <h3 class="m-t-0"><i class="fas fa-user-graduate text-primary"></i> {{ __('Tư vấn Tuyển sinh') }}</h3>
        <form method="GET" action="{{ env('APP_URL') . app()->getLocale() }}/admin/tuyen-sinh/tu-van">
            <div class="row form-group">
                <div class="col-12 col-md-3">
                    <input type="text" name="keywords" id="keywords" value="{{ $keywords }}" placeholder="Tìm Tên" class="form-control">
                </div>
                <div class="col-12 col-md-3">
                    <select name="id_cat" class="form-control select2">
                        <option value="">{{ __('Chọn chuyên mục') }}</option>
                        @foreach($arr_cats as $cat)
                            <option value="{{ $cat['id'] }}" @if($id_cat == $cat['id']) selected @endif>{{ $cat['title'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <select name="tra_loi" class="form-control select2">
                        @foreach($arr_traloi as $ktl => $tl)
                            <option value="{{ $ktl }}" @if($tra_loi == $ktl) selected @endif>{{ $tl }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <select name="cong_bo" class="form-control select2">
                        @foreach($arr_congbo as $kcb => $cb)
                            <option value="{{ $kcb }}" @if($cong_bo == $kcb) selected @endif>{{ $cb }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" name="submit" value="Search" class="btn btn-primary"><i class="fa fa-search"></i> {{ __('Tìm') }}</button>
                </div>
            </div>
        </form>
        <hr />
        @if($danhsach)
        <table class="table table-border table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>{{ __('STT') }}</th>
                    <th>{{ __('Nội dung') }}</th>
                    <th>{{ __('Trả lời') }}</th>
                    <th>{{ __('Public') }}</th>
                    <th style="width:55px;">#</th>
                </tr>
            </thead>
            <tbody>
            @foreach($danhsach as $key => $ds)
                <tr style="max-height:30px !important; overflow:hidden !important;">
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{!! $ds['noi_dung'] !!}</td>
                    <td>
                        @if($ds['tra_loi'])
                            {!! $ds['tra_loi'] !!}
                        @else 
                        <div class="text-center">
                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/tuyen-sinh/tu-van/edit/{{ $ds['_id'] }}"><strong>TRẢ LỜI</strong></a>
                        </div>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($ds['status'] == 1) <i class="fas fa-check-circle text-primary"></i>
                            @else <i class="fab fa-bandcamp"></i>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/tuyen-sinh/tu-van/delete/{{ $ds['_id'] }}" onclick="return confirm('Chắc chắc xóa?')"><i class="fas fa-trash text-danger"></i></a>&nbsp;
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/tuyen-sinh/tu-van/edit/{{ $ds['_id'] }}"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            @if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'])
                {{ $danhsach->withPath(env('APP_URL') . app()->getLocale() . '/admin/tuyen-sinh/tu-van?' . $_SERVER['QUERY_STRING']) }}
            @else 
                {{ $danhsach->withPath(env('APP_URL') . app()->getLocale() . '/admin/tuyen-sinh/tu-van') }}
            @endif
        @endif
    </div>
</div>
@endsection
@section('js')
    <script src="{{ env('APP_URL') }}assets/backend/libs/jquery-toast/jquery.toast.min.js"></script>
    <script src="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".select2").select2();
            @if(Session::get('msg') != null && Session::get('msg'))
            $.toast({
                heading:"Thông báo",
                text:"{{ Session::get('msg') }}",
                loaderBg:"#3b98b5",icon:"info", hideAfter:3e3,stack:1,position:"top-right"
            });
            @endif
        });
    </script>
@endsection