@extends('Frontend.layout')
@section('title', __($title))

@section('body')
@if($danhsach)
<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <div class="border-b-2 border-agu-blue pb-3">
            <h2 class="text-agu-blue font-heading font-bold text-xl uppercase tracking-wide m-0 flex items-center gap-2">
                <span class="inline-block w-2.5 h-6 bg-agu-blue rounded-sm"></span>
                {{ __($title) }}
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 thong-tin">
            @foreach($danhsach as $tmn)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="relative aspect-[16/10] bg-gray-100 overflow-hidden border-b border-gray-100">
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
                        <span class="text-[11px] font-heading font-semibold text-gray-400 block">
                            📅 {{ App\Http\Controllers\ObjectController::getDate($tmn['date_post'],"d/m/Y H:i") }}
                        </span>

                        <h3 class="text-base font-heading font-bold text-gray-900 leading-snug hover:text-agu-blue transition m-0 line-clamp-2">
                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/chi-tiet-thong-tin/{{ $tmn['slug'] }}" title="{{ $tmn['ten'] }}">
                                {{ $tmn['ten'] }}
                            </a>
                        </h3>

                        <p class="text-sm text-gray-500 line-clamp-3 leading-relaxed mo_ta m-0">
                            {{ $tmn['mo_ta'] }}
                        </p>
                    </div>
                </div>

                <div class="p-5 pt-0">
                    <a class="w-full text-center block text-xs font-heading font-bold text-white bg-agu-blue py-2.5 rounded shadow-sm hover:bg-blue-700 transition btn-agu-effect" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/chi-tiet-thong-tin/{{ $tmn['slug'] }}">
                        {{ __('Xem thêm') }}
                    </a>
                </div>

            </div>
            @endforeach
        </div>

        <div class="pt-6 border-t border-gray-200 flex justify-center pagination-wrapper text-sm font-heading">
            {{ $danhsach->withPath(env('APP_URL') . app()->getLocale() . '/' . $path . '?q='.Request::input('q')) }}
        </div>

    </div>
</section>
@endif
@endsection
