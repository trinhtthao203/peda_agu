@extends('Frontend.layout')
@section('title', __('About - An  Giang University Song'))
@section('body')
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>An  Giang University Song</h4>
             <p class="text-center">
                <video controls poster="{{ env('APP_URL') }}/assets/frontend/images/poster.png" style="width:100%">
                    <source src="{{ env('APP_URL') }}/assets/frontend/videos/agu_song.webm" type="video/mp4">
                </video>
            </p>
        </div>
    </div>
</div>
@endsection
