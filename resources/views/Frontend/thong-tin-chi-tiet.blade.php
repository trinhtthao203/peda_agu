@extends('Frontend.layout')
@section('title', $ds['ten'])
@section('description', $ds['mo_ta'])
@if(isset($ds['photos'][0]['aliasname']) && $ds['photos'][0]['aliasname'])
@section('image', env('APP_URL') . "storage/images/thumb_360x200/".$ds['photos'][0]['aliasname'])
@else
@section('image', env('APP_URL') . "assets/frontend/images/blog/blog-02.jpg")
@endif

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<style>
    #related-news-container .owl-nav {
        position: static !important;
        margin: 0 !important;
    }

    #related-news-container .owl-prev,
    #related-news-container .owl-next {
        position: absolute !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        margin: 0 !important;
        z-index: 30 !important;
        background: transparent !important;
        color: #000000 !important;
        width: 30px !important;
        height: 50px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-shadow: none !important;
        transition: all 0.2s ease-in-out !important;
    }

    #related-news-container .owl-prev:hover,
    #related-news-container .owl-next:hover {
        color: #0066b3 !important;
        transform: translateY(-50%) scale(1.2) !important;
    }

    #related-news-container .owl-prev {
        left: -20px !important;
    }

    #related-news-container .owl-next {
        right: -20px !important;
    }

    #related-news-container .owl-prev span,
    #related-news-container .owl-next span {
        font-size: 32px !important;
        font-weight: 300 !important;
        line-height: 1 !important;
        display: block !important;
        font-family: 'Montserrat', sans-serif !important;
    }

    .fancybox__container {
        --fancybox-bg: rgba(24, 24, 27, 0.95);
    }
</style>
@endsection

@section('body')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0&appId=131376384294659&autoLogAppEvents=1" nonce="xz8OBKsp"></script>

<div class="bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <div class="lg:col-span-3 bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 space-y-6">
                <h1 class="text-gray-900 font-heading font-bold text-2xl sm:text-3xl leading-snug m-0">
                    {{ $ds['ten'] }}
                </h1>
                <div class="flex flex-wrap items-center gap-4 text-xs font-heading font-semibold text-gray-500 border-b border-gray-100 pb-4">
                    <span class="flex items-center gap-1">📅 {{ App\Http\Controllers\ObjectController::getDate($ds['date_post'],"d/m/Y H:i") }}</span>

                    @if($ds['id_cat'])
                    <div class="flex flex-wrap items-center gap-2">
                        <span>🏷️</span>
                        @foreach($ds['id_cat'] as $c)
                        @php
                        $cat = App\Models\DMThongTin::find($c);
                        $taxonomy = (app()->getLocale() == 'vi') ? 'tin-tuc-su-kien' : 'news-and-events';
                        @endphp
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/{{ $cat['slug'] }}" class="text-agu-blue hover:underline">
                            {{ $cat['ten'] }}
                        </a>
                        @endforeach
                    </div>
                    @endif

                    @php
                    $views = App\Models\Views::where('path','=',Request::path())->count();
                    @endphp
                    @if($views)
                    <span class="flex items-center gap-1">👁️ {{ $views }} {{ __('lượt xem') }}</span>
                    @endif

                    <div class="inline-block align-middle">
                        <div class="fb-like" data-href="{{ Request::fullUrl() }}" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
                    </div>
                </div>

                @if(isset($ds['id_sdg_tags']) && $ds['id_sdg_tags'])
                <div class="flex justify-end gap-2 pt-2">
                    @foreach($ds['id_sdg_tags'] as $st)
                    <img src="{{ env('APP_URL') }}assets/frontend/images/sdg-tags/{{ $st }}_{{ $ds['locale'] }}.png" alt="{{ __($sdg_tags[$st]) }}" title="{{ __($sdg_tags[$st]) }}" class="h-10 w-auto rounded shadow-sm cursor-pointer hover:scale-105 transition duration-200" />
                    @endforeach
                </div>
                @endif

                <div class="text-[15px] text-gray-700 leading-relaxed font-normal space-y-4 prose max-w-none">
                    <p class="font-semibold text-gray-900 border-l-4 border-agu-blue pl-3 bg-blue-50/50 py-2 rounded-r">{{ $ds['mo_ta'] }}</p>
                    <div class="content-render">
                        {!! $ds['noi_dung'] !!}
                    </div>
                </div>

                @if($ds['photos'])
                <div class="pt-6 border-t border-gray-100">
                    <h5 class="font-heading font-bold text-[#0066b3] text-base mb-4 uppercase tracking-wider flex items-center gap-2">
                        🖼️ {{ __('Hình ảnh hoạt động') }}
                    </h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($ds['photos'] as $h)
                        <div class="group relative aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                            <img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ $h['aliasname'] }}" title="{{ $h['title'] }}" alt="{{ $h['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" />

                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                <a href="{{ env('APP_URL') }}storage/images/origin/{{ $h['aliasname'] }}"
                                    data-fancybox="gallery"
                                    data-caption="{{ $h['title'] }}"
                                    title="{{ $h['title'] }}"
                                    class="p-3 bg-agu-blue text-white rounded-full shadow-lg hover:bg-blue-700 transition transform hover:scale-110 cursor-zoom-in">
                                    🔍
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($ds['attachments'])
                <div class="pt-6 border-t border-gray-100">
                    <h5 class="font-heading font-bold text-[#00954d] text-base mb-4 uppercase tracking-wider flex items-center gap-2">
                        📎 {{ __('Văn bản đính kèm hành chính') }}
                    </h5>
                    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200 font-heading font-semibold text-gray-700">
                                    <th class="p-3 text-center w-16">{{ __('STT') }}</th>
                                    <th class="p-3">{{ __('Tên loại văn bản / Tài liệu') }}</th>
                                    <th class="p-3 text-center w-28">{{ __('Hành động') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white text-gray-600">
                                @foreach($ds['attachments'] as $key => $dk)
                                <tr class="hover:bg-gray-50/70 transition">
                                    <td class="p-3 text-center font-medium">{{ $key+1 }}</td>
                                    <td class="p-3">
                                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/xem-truc-tuyen/thong-tin/{{ $ds['_id'] }}/{{ $key }}" onClick="return false;" class="view_online font-medium text-gray-900 hover:text-agu-blue transition flex items-center gap-1.5">
                                            📄 {{ $dk['title'] }}
                                        </a>
                                    </td>
                                    <td class="p-3 text-center">
                                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tai-ve/thong-tin/{{ $ds['_id'] }}/{{ $key }}" class="inline-flex p-2 bg-gray-100 text-gray-600 rounded hover:bg-agu-blue hover:text-white transition shadow-sm btn-agu-effect">
                                            📥
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>

            <div class="lg:col-span-1 space-y-6">
                @php
                $widget_tintuc = App\Models\DMThongTin::where('locale','=',app()->getLocale())->where('thu_tu', '>', 0)->get();
                @endphp
                @if($widget_tintuc)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 space-y-4">
                    <h5 class="font-heading font-bold text-gray-900 text-base m-0 border-b-2 border-agu-blue pb-2 uppercase tracking-wide">
                        {{ __('Danh mục chính') }}
                    </h5>
                    <ul class="space-y-2 text-xs font-heading font-semibold">
                        @foreach($widget_tintuc as $tt)
                        <li>
                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/{{ $tt['slug'] }}" class="block p-2.5 bg-gray-50 rounded hover:bg-agu-blue hover:text-white text-gray-700 transition">
                                ➔ {{ $tt['ten'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @php
                $widget_tintucmoi = App\Models\ThongTin::where('locale','=',app()->getLocale())->where('_id', '<>', $ds['_id'])->orderBy('date_post', 'desc')->take(6)->get();
                    $detail_taxonomy = (app()->getLocale() == 'vi') ? 'chi-tiet-thong-tin' : 'detail-news-and-events';
                    @endphp

                    @if($widget_tintucmoi)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 space-y-4">
                        <h5 class="font-heading font-bold text-gray-900 text-base m-0 border-b-2 border-agu-green pb-2 uppercase tracking-wide">
                            {{ __('Tin tức mới') }}
                        </h5>
                        <ul class="space-y-3 text-xs font-heading font-semibold">
                            @foreach($widget_tintucmoi as $ttm)
                            <li class="border-b border-gray-100 pb-2 last:border-0 last:pb-0">
                                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $detail_taxonomy }}/{{ $ttm['slug'] }}" class="block text-gray-700 hover:text-agu-blue transition leading-snug">
                                    ➔ {{ $ttm['ten'] }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
            </div>

        </div>
    </div>
</div>

@if($tin_lien_quan && count($tin_lien_quan) > 0)
<section class="bg-gray-100 py-12 border-t border-gray-200 clear-both w-full block">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <h5 class="font-heading font-bold text-gray-800 text-lg uppercase tracking-wider m-0 flex items-center gap-2">
            🔗 {{ __('Tin tức liên quan học thuật') }}
        </h5>

        <div class="w-full relative px-0 md:px-10" id="related-news-container">
            @if(count($tin_lien_quan) > 3)
            <div class="owl-carousel related-carousel-init" data-items="1" data-loop="true" data-merge="true" data-nav="true" data-dots="true" data-margin="24" data-mobile="1" data-tablet="2" data-desktopsmall="3" data-desktop="3" data-autoplay="false">
                @foreach($tin_lien_quan as $tmn)
                <div class="item bg-white rounded-xl shadow-sm border border-gray-200/60 overflow-hidden flex flex-col justify-between min-h-[380px] p-4 hover:shadow-md transition-all duration-300 w-full box-border">
                    <div class="space-y-3">
                        <div class="relative aspect-[16/10] bg-gray-50 rounded-lg overflow-hidden border border-gray-100 shrink-0">
                            @if(isset($tmn['thu_tu']) && $tmn['thu_tu'] < 0)
                                <span class="absolute top-2 left-2 z-10 inline-flex items-center px-2 py-0.5 rounded text-[9px] font-heading font-bold bg-[#ed1c24] text-white tracking-wider uppercase shadow animate-pulse">🔥 HOT</span>
                                @endif

                                @if(isset($tmn['photos'][0]['aliasname']) && $tmn['photos'][0]['aliasname'])
                                <img src="{{ env('APP_ASSETS') }}storage/images/thumb_360x200/{{ $tmn['photos'][0]['aliasname'] }}" class="w-full h-full object-cover" alt="{{ $tmn['ten'] }}">
                                @else
                                <img src="{{ env('APP_ASSETS') }}assets/frontend/images/blog/blog-02.jpg" class="w-full h-full object-cover" alt="{{ $tmn['ten'] }}">
                                @endif
                        </div>

                        <div class="space-y-1">
                            <span class="text-[10px] text-gray-400 font-semibold block">📅 {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'],"d/m/Y H:i") }}</span>
                            <h5 class="text-sm font-heading font-bold text-gray-900 leading-snug line-clamp-2 m-0 hover:text-agu-blue transition min-h-[38px]">
                                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/chi-tiet-thong-tin/{{ $tmn['slug'] }}">{{ $tmn['ten'] }}</a>
                            </h5>
                            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed m-0">{{ $tmn['mo_ta'] }}</p>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-gray-50 mt-3">
                        <a class="w-full text-center block text-xs font-heading font-bold text-white bg-agu-blue py-2.5 rounded shadow-sm hover:bg-blue-700 transition btn-agu-effect" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/chi-tiet-thong-tin/{{ $tmn['slug'] }}">{{ __('Xem thêm') }}</a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($tin_lien_quan as $tmn)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200/60 overflow-hidden flex flex-col justify-between min-h-[380px] p-4 hover:shadow-md transition-all duration-300 w-full box-border">
                    <div class="space-y-3">
                        <div class="relative aspect-[16/10] bg-gray-50 rounded-lg overflow-hidden border border-gray-100 shrink-0">
                            @if(isset($tmn['thu_tu']) && $tmn['thu_tu'] < 0)
                                <span class="absolute top-2 left-2 z-10 inline-flex items-center px-2 py-0.5 rounded text-[9px] font-heading font-bold bg-[#ed1c24] text-white tracking-wider uppercase shadow animate-pulse">🔥 HOT</span>
                                @endif

                                @if(isset($tmn['photos'][0]['aliasname']) && $tmn['photos'][0]['aliasname'])
                                <img src="{{ env('APP_ASSETS') }}storage/images/thumb_360x200/{{ $tmn['photos'][0]['aliasname'] }}" class="w-full h-full object-cover" alt="{{ $tmn['ten'] }}">
                                @else
                                <img src="{{ env('APP_ASSETS') }}assets/frontend/images/blog/blog-02.jpg" class="w-full h-full object-cover" alt="{{ $tmn['ten'] }}">
                                @endif
                        </div>

                        <div class="space-y-1">
                            <span class="text-[10px] text-gray-400 font-semibold block">📅 {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'],"d/m/Y H:i") }}</span>
                            <h5 class="text-sm font-heading font-bold text-gray-900 leading-snug line-clamp-2 m-0 hover:text-agu-blue transition min-h-[38px]">
                                <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/chi-tiet-thong-tin/{{ $tmn['slug'] }}">{{ $tmn['ten'] }}</a>
                            </h5>
                            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed m-0">{{ $tmn['mo_ta'] }}</p>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-gray-50 mt-3">
                        <a class="w-full text-center block text-xs font-heading font-bold text-white bg-agu-blue py-2.5 rounded shadow-sm hover:bg-blue-700 transition btn-agu-effect" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/chi-tiet-thong-tin/{{ $tmn['slug'] }}">{{ __('Xem thêm') }}</a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
@endif

<div id="xemdinhkem" class="modal fade" window-status="closed" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl fixed inset-4 md:inset-10 bg-white rounded-xl shadow-2xl z-[9999] border border-gray-200 flex flex-col hidden" id="modal-container">
        <div class="flex items-center justify-between p-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
            <h4 class="font-heading font-bold text-gray-800 text-base m-0">{{ __("Xem chi tiết đính kèm trực tuyến") }}</h4>
            <button type="button" class="close-modal text-gray-400 hover:text-gray-600 text-2xl font-bold focus:outline-none">&times;</button>
        </div>
        <div id="chitiet" class="modal-body flex-grow p-4 overflow-y-auto bg-gray-100"></div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        if ($.fn.owlCarousel && $('.related-carousel-init').length > 0) {
            $('.related-carousel-init').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                dots: true,
                navText: ['<span class="p-2 bg-black/50 text-white rounded-full hover:bg-agu-blue transition shadow">&larr;</span>', '<span class="p-2 bg-black/50 text-white rounded-full hover:bg-agu-blue transition shadow">&rarr;</span>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    640: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 4
                    }
                }
            });
        }

        $(".view_online").click(function() {
            var href = $(this).attr("href");
            $("#modal-container").removeClass('hidden');
            $("#chitiet").html('<div class="flex items-center justify-center h-full text-gray-400 font-heading animate-pulse text-xs uppercase">🔄 {{ __("Đang đồng bộ và hiển thị tài liệu hành chính...") }}</div>');
            $.get(href, function(html_view) {
                $("#chitiet").html(html_view);
            });
        });

        $(".close-modal").click(function() {
            $("#modal-container").addClass('hidden');
            $("#chitiet").html('');
        });

        Fancybox.bind("[data-fancybox='gallery']", {
            Toolbar: {
                display: {
                    left: ["infobar"],
                    middle: [],
                    right: ["slideshow", "thumbs", "zoom", "close"],
                },
            },
            Images: {
                Panzoom: {
                    maxScale: 3,
                },
            },
            Html: {
                videoAutoplay: true
            }
        });
    });
</script>
@endsection