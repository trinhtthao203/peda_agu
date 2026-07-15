@php
$banner = App\Models\Banner::where('locale','=',app()->getLocale())
->where('status', '=', 1)->where('trang_chu', '=', 1)
->orderBy('order','asc')->orderBy('updated_at', 'desc')->get();
@endphp
@if($banner && count($banner) > 0)
<div class="rs-container light rev_slider_wrapper">
    <div id="revolutionSlider"
        class="slider rev_slider"
        data-plugin-revolution-slider
        data-plugin-options='{
        "delay":9000,
        "gridwidth":[1920,1200,992,768,576],
        "gridheight":[600,500,420,320,220],
        "responsiveLevels":[1920,1200,992,768,576],
        "visibilityLevels":[1920,1200,992,768,576]
     }'>
        <ul>
            @foreach($banner as $b)
            @if(isset($b['photos'][0]['aliasname']) && $b['photos'][0]['aliasname'])
            <li data-transition="fade" class="typo-dark heavy">
                @if(isset($b['url']) && $b['url']) <a href="{{ $b['url'] }}" style="width:auto !important; height:auto !important;"> @endif
                    <img
                        src="{{ env('APP_URL') }}storage/images/origin/{{ $b['photos'][0]['aliasname'] }}"
                        alt="{{ __($b['title']) }}"
                        title="{{ __($b['title']) }}"
                        class="rev-slidebg"
                        data-bgfit="cover"
                        data-bgposition="center center"
                        data-bgrepeat="no-repeat"
                        style="width:100%;height:100%;object-fit:cover;object-position:center;">
                    @if(isset($b['url']) && $b['url']) </a> @endif
            </li>
            @endif
            @endforeach
        </ul>
    </div>
</div><!-- Home Slider -->
@endif
