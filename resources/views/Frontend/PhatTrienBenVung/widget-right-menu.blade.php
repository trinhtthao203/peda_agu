<aside class="sidebar">
    <div class="widget">
        <h5 class="widget-title" style="font-size:20px;">{{ __('Phát triển bền vững') }}<span></span></h5>
        <ul class="go-widget">
            <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}">{{ __('Trang chủ PTBV') }}</a></li>
            <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/tin-tuc-su-kien">{{ __('Tin tức sự kiện') }}</a></li>
            @foreach($arr_page as $p_key => $p_value)
                <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('phat-trien-ben-vung') }}/{{ $p_key }}">{{ __($p_value) }}</a></li>
            @endforeach
        </ul>
    </div>
</aside>