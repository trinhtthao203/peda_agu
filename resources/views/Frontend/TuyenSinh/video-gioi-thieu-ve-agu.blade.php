@extends('Frontend.TuyenSinh.layout')
@section('title', __('Giới thiệu - Giới thiệu về Trường Đại học An Giang trên VTV3'))
@section('body')
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Giới thiệu về Trường Đại học An Giang trên VTV3</h4>
            <p class="text-center">
                <video controls poster="{{ env('APP_URL') }}/assets/frontend/images/poster.png" style="width:100%">
                    <source src="{{ env('APP_URL') }}/assets/frontend/videos/agu_vtv3.mp4" type="video/mp4">
                </video>
            </p>
            <hr />
            <h4>Trường Đại học An Giang 20 năm phát triển</h4>
            <p class="text-center">
                <video controls poster="{{ env('APP_URL') }}/assets/frontend/images/poster.png" style="width:100%">
                    <source src="{{ env('APP_URL') }}/assets/frontend/videos/agu_20nam.mp4" type="video/mp4">
                </video>
            </p>
            <hr />
            <h4>Trường Đại học An Giang 15 năm phát triển</h4>
            <p class="text-center">
                <video controls poster="{{ env('APP_URL') }}/assets/frontend/images/poster.png" style="width:100%">
                    <source src="{{ env('APP_URL') }}/assets/frontend/videos/agu_15nam.mp4" type="video/mp4">
                </video>
            </p>
            <hr />
            <h4>Giới thiệu về Trường Đại học An Giang</h4>
            <p class="text-center">
                <video controls poster="{{ env('APP_URL') }}/assets/frontend/images/poster.png" style="width:100%">
                    <source src="{{ env('APP_URL') }}/assets/frontend/videos/agu_gioithieu.mp4" type="video/mp4">
                </video>
            </p>
        </div>
    </div>
</div>
@endsection
