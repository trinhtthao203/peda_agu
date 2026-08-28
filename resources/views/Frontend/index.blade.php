@extends('Frontend.layout')

@section('title', __('Trang chủ'))
@section('css')
<style>
    ul.list-news-home-ts {
        list-style-type: square;
    }

    .mo_ta {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 14px;
        color: #4b5563;
    }

    .calendar-container iframe {
        width: 100%;
        height: 450px;
        border: none;
        border-radius: 8px;
    }
</style>
@endsection

@section('body')
@include('Frontend.widget_banner')

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12" id="home-new">

    @if($tin_moi_nhat && count($tin_moi_nhat) > 0)
    <div class="space-y-6">
        <div class="border-b-2 border-agu-blue pb-3 flex items-center justify-between">
            <h2 class="text-agu-blue font-heading font-bold text-xl uppercase tracking-wide m-0">
                <span class="inline-block w-2.5 h-5 bg-agu-blue mr-2 align-middle rounded-sm"></span>{{ __('Tin mới nhất') }}
            </h2>

            @if(app()->getLocale() == 'vi')
            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/tin-moi-nhat" class="text-xs font-heading font-semibold text-agu-blue hover:text-blue-700 transition flex items-center">
                {{ __('Xem tất cả') }} &rarr;
            </a>
            @else
            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events" class="text-xs font-heading font-semibold text-agu-blue hover:text-blue-700 transition flex items-center">
                {{ __('Xem tất cả') }} &rarr;
            </a>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tin_moi_nhat as $tmn)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="relative aspect-[16/9] bg-gray-100 overflow-hidden">
                        @if(isset($tmn['thu_tu']) && $tmn['thu_tu'] < 0)
                            <span class="absolute top-3 left-3 z-10 inline-flex items-center px-2.5 py-1 rounded text-[10px] font-heading font-bold bg-[#ed1c24] text-white tracking-wider uppercase shadow-md animate-pulse">
                            🔥 {{ __('TIN HOT') }}
                            </span>
                            @endif

                            @if(isset($tmn['photos'][0]['aliasname']) && $tmn['photos'][0]['aliasname'])
                            <img src="{{ env('APP_ASSETS') }}storage/images/thumb_360x200/{{ $tmn['photos'][0]['aliasname'] }}" class="w-full h-full object-cover" alt="{{ $tmn['ten'] }}">
                            @else
                            <img src="{{ env('APP_ASSETS') }}assets/frontend/images/blog/blog-02.jpg" class="w-full h-full object-cover" alt="{{ $tmn['ten'] }}">
                            @endif
                    </div>

                    <div class="p-5 space-y-3">
                        <span class="text-xs font-heading font-semibold text-gray-400 block">
                            📅 {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'], "d/m/Y") }}
                        </span>

                        <h3 class="text-base font-heading font-bold text-gray-900 leading-snug hover:text-agu-blue transition">
                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('chi-tiet-thong-tin') }}/{{ $tmn['slug'] }}" title="{{ $tmn['ten'] }}">
                                {{ $tmn['ten'] }}
                            </a>
                        </h3>

                        <p class="mo_ta">{{ $tmn['mo_ta'] }}</p>
                    </div>
                </div>

                <div class="p-5 pt-0 flex justify-between items-center">
                    <div class="flex space-x-1">
                        @if(isset($tmn['id_sdg_tags']) && $tmn['id_sdg_tags'])
                        @foreach($tmn['id_sdg_tags'] as $st)
                        <img src="{{ env('APP_URL') }}assets/frontend/images/sdg-tags/{{ $st }}_{{ $tmn['locale'] }}.png" alt="SDG" class="h-6 object-contain" />
                        @endforeach
                        @endif
                    </div>

                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ __('chi-tiet-thong-tin') }}/{{ $tmn['slug'] }}"
                        class="text-xs font-heading font-bold text-white bg-agu-blue px-4 py-2 rounded shadow-sm hover:bg-blue-700 transition btn-agu-effect">
                        {{ __('Xem thêm') }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
        <div class="border-b-2 border-agu-green pb-3 flex items-center justify-between">
            <h2 class="text-agu-green font-heading font-bold text-xl uppercase tracking-wide m-0">{{ __('Lịch công tác') }}</h2>
            <a class="text-xs font-heading font-bold text-agu-green hover:underline flex items-center"
                href="https://calendar.google.com/calendar/u/0/r?cid=agu.edu.vn_qf2qof63stvjftctim9u8clh6c@group.calendar.google.com" target="_blank">
                {{ __('Xem trên Google Calendar') }} &nearrow;
            </a>
        </div>

        <div class="relative">
            <div id="calendar-loading" class="flex items-center justify-center py-16 text-gray-400 text-sm font-heading">
                <span class="animate-pulse flex items-center">🔄 {{ __('Đang kết nối dữ liệu lịch công tác học thuật...') }}</span>
            </div>
            <div class="calendar-container" id="calendar"></div>
        </div>
    </div>

</section>
@endsection

@section('js')
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var load = 0;
        setTimeout(function() {
            if (load === 0) {
                $("#calendar").html('<iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=500&amp;wkst=2&amp;hl=vi&amp;bgcolor=%23FFFFFF&amp;src=agu.edu.vn_qf2qof63stvjftctim9u8clh6c%40group.calendar.google.com&amp;color=%230066b3&amp;ctz=Asia%2FHo_Chi_Minh" scrolling="no"></iframe>');
                load = 1;
                $("#calendar-loading").hide();
            }
        }, 500);
    });
</script>
@endsection
