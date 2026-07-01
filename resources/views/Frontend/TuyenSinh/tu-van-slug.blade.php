@extends('Frontend.TuyenSinh.layout')
@section('title', 'Tư vấn tuyển sinh')
@section('css')
<style>
    #SearchForm input,  #SearchForm select{
        font-size: 18px;
    }
    .panel-body ul {
        list-style: square;
        padding-left: 50px;
    }
</style>
@endsection
@section('body')
<section class="bg-lgrey">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="title-container text-left sm">
                    <div class="title-wrap">
                        <h4 class="title">{{ __('Tư vấn Tuyển sinh') }} - <strong>{{ $title }}</strong></h4>
                        <span class="separator line-separator"></span>
                    </div>							
                </div><!-- Name -->
            </div><!-- Column -->
            <div class="col-12 col-md-2 text-right">
                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/tu-van-tuyen-sinh/goi-cau-hoi" class="btn btn-lg"><i class="fa fa-send"></i> {{ __('Gởi câu hỏi') }}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Search -->
                <div class="search">
                    <form id="SearchForm" action="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/tu-van-tuyen-sinh/tim-kiem" method="GET">
                        <div class="row form-group">
                            <div class="col-12 col-md-4">
                                <select name="id_cat" id="id_cat" class="form-control">
                                    <option value="">{{ __('Tất cả Chuyên mục') }}</option>
                                    @foreach($arr_cats as $cat)
                                    <option value="{{ $cat['id'] }}" @if($cat['id'] == $slug) selected @endif>{{ $cat['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="input-group">
                                    <input type="text" class="form-control search" value="{{ $keywords }}" name="q" id="q" placeholder="{{ __('Tìm câu hỏi...') }}" >
                                    <span class="input-group-btn">
                                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- Search -->
            </div><!-- Column -->
        </div><!-- Row -->
        <hr />
        @if($danhsach)
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($danhsach as $ds)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading_{{ $ds['_id'] }}">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{ $ds['_id'] }}" aria-expanded="true" aria-controls="collapse_{{ $ds['_id'] }}" style="font-size:18px;font-weight:400;">
                                    <img src="{{ env('APP_URL') }}assets/frontend/images/question.png" alt="{{ $ds['ho_ten'] }}" title="{{ $ds['ho_ten'] }}" style="float:left;height: 30px;margin-right:10px;">
                                    {!! $ds['noi_dung']  !!}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse_{{ $ds['_id'] }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_{{ $ds['_id'] }}">
                            <div class="panel-body bg-warning" style="padding-top:20px;font-size:18px;font-weight:300 !important;">
                                <img src="{{ env('APP_URL') }}assets/frontend/images/logo.png" alt="{{ __('Trường Đại học An Giang') }}" title="{{ __('Trường Đại học An Giang') }}" style="float:left;height: 30px;margin-right:10px;">
                                {!! $ds['tra_loi'] !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if($keywords)
        {{ $danhsach->withPath(env('APP_URL').app()->getLocale().'/tuyen-sinh/tu-van-tuyen-sinh/tim-kiem/?'.$_SERVER['QUERY_STRING']) }}
        @else
            {{ $danhsach->withPath(env('APP_URL').app()->getLocale().'/tuyen-sinh/tu-van-tuyen-sinh/'.$slug) }}
        @endif
        @endif
        
    </div><!-- Container -->
</section>
<section class="bg-grey">
    <div class="container">
        <div class="alert alert-danger" role="alert">
            <p><span class="text-danger"><strong>Lưu ý:</strong></span> Một số câu hỏi không có phản hồi do nội dung bị trùng với những câu hỏi đã được trả lời trước đó. Các bạn vui lòng tham khảo các câu hỏi đã được trả lời dưới đây.</p>
        </div>
        <div class="row">
            @foreach ($arr_cats as $cat)
            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/tu-van-tuyen-sinh/{{ $cat['id'] }}">
            <div class="col-12 col-sm-3 col-md-3" style="margin-bottom:20px;">
                <div class="count-block dark {{ $cat['bgcolor'] }}" style="height:120px;">
                    <h5 style="font-weight:400;font-size:19px;">{{ $cat['title'] }}</h5>
                    {{-- <h3 class="count-number" data-count="452"><span class="counter">452</span></h3> --}}
                    <i class="{{ $cat['icon'] }}"></i>
                </div>
            </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection