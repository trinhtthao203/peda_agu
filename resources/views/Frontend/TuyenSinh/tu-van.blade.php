@extends('Frontend.TuyenSinh.layout')
@section('title', 'Tư vấn tuyển sinh')
@section('body')
<section class="bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="title-container text-left sm">
                    <div class="title-wrap">
                        <h4 class="title">{{ __('Tư vấn Tuyển sinh') }}</h4>
                        <span class="separator line-separator"></span>
                    </div>							
                </div><!-- Name -->
            </div><!-- Column -->
            <div class="col-12 col-md-2 text-right">
                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/tu-van-tuyen-sinh/goi-cau-hoi" class="btn btn-lg"><i class="fa fa-send"></i> {{ __('Gởi câu hỏi') }}</a>
            </div>
        </div>
        <div class="alert alert-danger" role="alert">
            <p><span class="text-danger"><strong>{{ __('Lưu ý') }}:</strong></span> {{ __('Một số câu hỏi không có phản hồi do nội dung bị trùng với những câu hỏi đã được trả lời trước đó. Các bạn vui lòng tham khảo các câu hỏi đã được trả lời dưới đây.') }}</p>
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