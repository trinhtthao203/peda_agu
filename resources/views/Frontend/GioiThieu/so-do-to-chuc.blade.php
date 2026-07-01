@extends('Frontend.layout')
@section('title', __('Giới thiệu - Tổ chức bộ máy'))
@section('body')
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Sơ đồ Tổ chức</h4>
            <p class="text-center">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/co-cau-to-chuc-vi.jpg" alt="Trường Đại học An Giang" align="center" style="width:100%;">
            </p>
        </div>
    </div>
</div>
@endsection
