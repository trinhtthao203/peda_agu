@extends('Frontend.layout')
@section('title', __('Giới thiệu - Logo kỷ niệm 25 năm thành lập Trường'))
@section('body')
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Logo kỷ niệm 25 năm thành lập Trường</h4>
            <div style="border:2px solid #287143;  border-radius:10px;padding:30px; background: #266f42;">
                <p class="text-center">
                    <img src="{{ env('APP_URL') }}assets/frontend/images/logo/logo_25_nam_thanh_lap_truong_xanh_la.png" alt="Logo kỷ niệm 25 năm thành lập trường màu xanh lá" align="center" style="width:50%;">
                </p>
                <br />
                <p class="text-center"><a download="logo_25_nam_thanh_lap_truong_xanh_la_origin.png" href="{{ env('APP_URL') }}assets/frontend/images/logo/logo_25_nam_thanh_lap_truong_xanh_la_origin.png" target="_blank" class="btn" style="background:#287143;border:2px solid #fff;">Download hình gốc</a></p>
            </div>
            <hr />
            <div style="border:2px solid #265381; border-radius:10px;padding:30px; background: #265381;"">
                <p class="text-center">
                    <img src="{{ env('APP_URL') }}assets/frontend/images/logo/logo_25_nam_thanh_lap_truong_xanh_duong.png" alt="Logo kỷ niệm 25 năm thành lập trường màu xanh dương" align="center" style="width:50%;">
                </p>
                <br />
                <p class="text-center"><a download="logo_25_nam_thanh_lap_truong_xanh_duong_origin.png" href="{{ env('APP_URL') }}assets/frontend/images/logo/logo_25_nam_thanh_lap_truong_xanh_duong_origin.png" target="_blank" class="btn" style="backgroud:#265381;border:2px solid #fff;">Download hình gốc</a></p>
            </div>
            
            
        </div>
    </div>
</div>
@endsection
