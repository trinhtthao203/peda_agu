@extends('Frontend.layout')
@section('title', __('Quy trình'))

@section('body')
<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Tiêu đề trang -->
        <div class="border-b-2 border-agu-blue pb-3">
            <h2 class="text-agu-blue font-heading font-bold text-xl uppercase tracking-wide m-0 flex items-center gap-2">
                <span class="inline-block w-2.5 h-6 bg-agu-blue rounded-sm"></span>
                {{ __('Quy trình dành cho sinh viên') }}
            </h2>
        </div>

        @if(isset($danhsach) && count($danhsach) > 0)
        <!-- Danh sách dạng List Link -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden divide-y divide-gray-100">
            @php $stt = 1; @endphp
            @foreach($danhsach as $item)
            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/chi-tiet-thong-tin/{{ $item['slug'] }}"
                class="group p-4 sm:p-5 flex items-start sm:items-center justify-between gap-4 hover:bg-blue-50/40 transition duration-150 block text-decoration-none">

                <div class="flex items-start sm:items-center gap-3.5 flex-1 min-w-0">
                    <!-- STT / Icon -->
                    <span class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 font-heading font-bold text-xs flex items-center justify-center shrink-0 group-hover:bg-agu-blue group-hover:text-white transition">
                        {{ $stt++ }}
                    </span>

                    <!-- Tiêu đề & mô tả -->
                    <div class="space-y-1 min-w-0 flex-1">
                        <h3 class="text-sm sm:text-base font-heading font-semibold text-gray-900 group-hover:text-agu-blue transition m-0 truncate">
                            {{ $item['ten'] }}
                        </h3>
                        @if(!empty($item['mo_ta']))
                        <p class="text-xs text-gray-500 line-clamp-1 m-0">
                            {{ $item['mo_ta'] }}
                        </p>
                        @endif
                    </div>
                </div>

                <!-- Ngày đăng & Icon điều hướng -->
                <div class="flex items-center gap-4 shrink-0 text-gray-400">
                    <span class="hidden sm:inline-block text-xs font-heading font-medium text-gray-400">
                        📅 {{ App\Http\Controllers\ObjectController::getDate($item['date_post'], "d/m/Y") }}
                    </span>
                    <span class="text-agu-blue transform group-hover:translate-x-1 transition font-bold text-sm">
                        ➔
                    </span>
                </div>

            </a>
            @endforeach
        </div>

        @if(method_exists($danhsach, 'links'))
        <div class="pt-6 border-t border-gray-200 flex justify-center pagination-wrapper text-sm font-heading">
            {{ $danhsach->links() }}
        </div>
        @endif
        @else
        <div class="bg-white rounded-xl p-8 text-center text-gray-500 border border-gray-100">
            {{ __('Chưa có thông tin quy trình nào.') }}
        </div>
        @endif

    </div>
</section>
@endsection