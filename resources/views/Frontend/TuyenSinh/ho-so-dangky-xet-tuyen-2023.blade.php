@extends('Frontend.TuyenSinh.layout')
@section('title', 'Tra cứu Kết quả tuyển sinh')
@section('css')
<style>
    #SearchForm input,  #SearchForm select{
        font-size: 18px;
    }
</style>
@endsection
@section('body')
@php
    if($phuongthuc == 'phuong-thuc-5') $title = 'Tra cứu hồ sơ đăng ký xét tuyển đại học theo Phương thức 5';
    else if($phuongthuc == 'bai-luan-phuong-thuc-5') $title = 'Tra cứu kết quả xét duyệt bài luận áp dụng xét tuyển theo Phương thức 5';
    else $title = '';
@endphp
<section class="bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-container text-left sm">
                    <div class="title-wrap">
                        <h4 class="title">{{ $title }}</h4>
                        <span class="separator line-separator"></span>
                    </div>							
                </div><!-- Name -->
            </div><!-- Column -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Search -->
                <div class="search">
                    <form id="SearchForm" action="{{ env('APP_URL') }}vi/tuyen-sinh/ho-so-dang-ky-xet-tuyen/{{ $nam }}/{{ $phuongthuc }}" method="GET">
                        <div class="row form-group">
                            <div class="col-12 col-md-8">
                                <div class="input-group">
                                    <input type="text" class="form-control search" value="{{ $keywords }}" name="q" id="q" placeholder="Họ tên hoặc CMND/CCCD">
                                    <span class="input-group-btn">
                                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- Search -->
            </div>
        </div>
        @if($danhsach)
            @if($phuongthuc == 'phuong-thuc-5')
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped" style="font-size: 13px;">
                            <thead>
                                <tr>
                                    <th>CMND/CCCD</th>
                                    <th>Họ tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Ngành viết bài luận</th>
                                    <th>Nguyện vọng 1</th>
                                    <th>Nguyện vọng 2</th>
                                    <th>Nguyện vọng 3</th>
                                    <th>Trạng thái</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhsach as $ds)
                                    <tr>
                                        <td>{{ $ds['cmnd'] }}</td>
                                        <td>{{ $ds['ho_ten'] }}</td>
                                        <td>{{ $ds['ngay_sinh'] }}</td>
                                        <td>{{ $ds['nganh_viet_bai_luan'] }}</td>
                                        <td>{{$ds['nguyen_vong_1']}}</td>
                                        <td>{{$ds['nguyen_vong_2']}}</td>
                                        <td>{{$ds['nguyen_vong_3']}}</td>
                                        <td>{{$ds['trang_thai']}}</td>
                                        <td>{{ $ds['ghi_chu'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endif
    </div>
    
</section>
@endsection