@extends('Frontend.layout')
@section('title', __('Biểu mẫu'))

@section('body')
<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Tiêu đề trang -->
        <div class="border-b-2 border-agu-blue pb-3">
            <h2 class="text-agu-blue font-heading font-bold text-xl uppercase tracking-wide m-0 flex items-center gap-2">
                <span class="inline-block w-2.5 h-6 bg-agu-blue rounded-sm"></span>
                {{ __('Danh sách Biểu mẫu') }}
            </h2>
        </div>

        @if(isset($danhsach) && count($danhsach) > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200 font-heading font-semibold text-gray-700">
                            <th class="p-3.5 text-center w-16">{{ __('STT') }}</th>
                            <th class="p-3.5">{{ __('Tên biểu mẫu / Tài liệu') }}</th>
                            <th class="p-3.5 text-center w-40">{{ __('File & Thao tác') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white text-gray-600">
                        @php $stt = 1; @endphp
                        @foreach($danhsach as $item)
                        @if(isset($item['attachments']) && is_array($item['attachments']) && count($item['attachments']) > 0)
                        @foreach($item['attachments'] as $key => $file)
                        <tr class="hover:bg-gray-50/70 transition">
                            <td class="p-3.5 text-center font-medium">{{ $stt++ }}</td>
                            <td class="p-3.5 font-medium text-gray-900">
                                <div class="flex flex-col gap-1">
                                    <span>📄 {{ $file['title'] ?? $item['ten'] }}</span>
                                    @if(!empty($item['mo_ta']))
                                    <span class="text-xs text-gray-400 font-normal">{{ $item['mo_ta'] }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="p-3.5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Nút Xem trực tuyến -->
                                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/xem-truc-tuyen/thong-tin/{{ $item['_id'] }}/{{ $key }}"
                                        class="view_online px-2.5 py-1.5 bg-blue-50 text-agu-blue rounded hover:bg-agu-blue hover:text-white transition font-heading font-semibold text-xs flex items-center gap-1 shadow-sm">
                                        👁️ {{ __('Xem') }}
                                    </a>
                                    <!-- Nút Tải về -->
                                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tai-ve/thong-tin/{{ $item['_id'] }}/{{ $key }}"
                                        class="px-2.5 py-1.5 bg-green-50 text-green-700 rounded hover:bg-green-600 hover:text-white transition font-heading font-semibold text-xs flex items-center gap-1 shadow-sm">
                                        📥 {{ __('Tải') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="hover:bg-gray-50/70 transition">
                            <td class="p-3.5 text-center font-medium">{{ $stt++ }}</td>
                            <td class="p-3.5 font-medium text-gray-900">
                                📄 {{ $item['ten'] }}
                            </td>
                            <td class="p-3.5 text-center text-gray-400 text-xs italic">
                                {{ __('Chưa có file') }}
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl p-8 text-center text-gray-500 border border-gray-100">
            {{ __('Chưa có dữ liệu biểu mẫu.') }}
        </div>
        @endif

    </div>
</section>

<!-- Modal Xem Trực Tuyến -->
<div id="modal-container" class="fixed inset-4 md:inset-10 bg-white rounded-xl shadow-2xl z-[9999] border border-gray-200 flex flex-col hidden">
    <div class="flex items-center justify-between p-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
        <h4 class="font-heading font-bold text-gray-800 text-base m-0">{{ __("Xem chi tiết đính kèm trực tuyến") }}</h4>
        <button type="button" class="close-modal text-gray-400 hover:text-gray-600 text-2xl font-bold focus:outline-none">&times;</button>
    </div>
    <div id="chitiet" class="modal-body flex-grow p-4 overflow-y-auto bg-gray-100"></div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".view_online").click(function(e) {
            e.preventDefault();
            var href = $(this).attr("href");
            $("#modal-container").removeClass('hidden');
            $("#chitiet").html('<div class="flex items-center justify-center h-full text-gray-400 font-heading animate-pulse text-xs uppercase">🔄 {{ __("Đang đồng bộ và hiển thị tài liệu...") }}</div>');
            $.get(href, function(html_view) {
                $("#chitiet").html(html_view);
            });
        });

        $(".close-modal").click(function() {
            $("#modal-container").addClass('hidden');
            $("#chitiet").html('');
        });
    });
</script>
@endsection