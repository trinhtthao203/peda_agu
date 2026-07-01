@extends('Frontend.layout')
@section('title', __('Giới thiệu - Brochure'))
@section('body')
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Brochure</h4>
        </div>
        @if(app()->getLocale() == 'vi')
            {{-- <iframe src="https://drive.google.com/file/d/1Vsw3O-_a01hVIK2Xo3vnlQixwod1-P16/preview" style="width:100%;height:800px;"></iframe> --}}
            <iframe src="https://drive.google.com/file/d/1Jll2yUIAV6b7PCh2YtGxpHm5DzDowWVx/preview" style="width:100%;height:800px;"></iframe>
        @else
            <iframe src="https://drive.google.com/file/d/1OquTlEjQI7CeE-P-I4HpmwtQZMA8W2uc/preview" style="width:100%;height:800px;"></iframe>
        @endif
    </div>
</div>
@endsection
