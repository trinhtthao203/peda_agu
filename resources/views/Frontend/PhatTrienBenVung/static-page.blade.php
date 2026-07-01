@extends('Frontend.PhatTrienBenVung.layout')
@section('title', __($title_page) . ' - ' .  __('Trang Thông tin về Phát triển bền vững Trường Đại học An Giang'))
@section('body')
<style>
    h4 {
        color: #00bb62 !important;font-weight: bold !important;
    }
    .image-wrapper img {
        max-height: 250px !important;
    }
</style>
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <div class="row">
                <div class="col-12 col-md-9">
                    @include('Frontend.PhatTrienBenVung.'.$slug)
                </div>
                <div class="col-12 col-md-3">
                    @include('Frontend.PhatTrienBenVung.widget-right-menu')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
