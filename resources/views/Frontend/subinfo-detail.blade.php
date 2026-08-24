@extends('Frontend.layout')
@section('title', $page['ten'])
@section('description', $page['mo_ta'])

@section('body')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="border-b-2 border-agu-blue pb-3">
            <h2 class="text-agu-blue font-heading font-bold text-xl uppercase tracking-wide m-0 flex items-center gap-2">
                <span class="inline-block w-2.5 h-6 bg-agu-blue rounded-sm"></span>
                {{ $page['ten'] }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 space-y-8">
            <div class="prose max-w-none text-gray-700 leading-relaxed font-sans text-sm sm:text-base">
                {!! $page['noi_dung'] !!}
            </div>
            @if(isset($danhSachNhanSu) && count($danhSachNhanSu) > 0)
            <div class="pt-8 border-t border-gray-100">
                <h3 class="font-heading font-bold text-gray-900 text-lg mb-6 uppercase tracking-wide flex items-center gap-2">
                    👨‍🏫 {{ __('Đội ngũ Giảng viên - Cán bộ bộ môn') }}
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($danhSachNhanSu as $ns)
                    @php
                    // Lấy chức vụ tại đơn vị hiện tại
                    $currentRole = collect($ns['departments'] ?? [])->first();
                    if (isset($dept)) {
                    $currentRole = collect($ns['departments'] ?? [])->firstWhere('department_id', (string)$dept->_id);
                    }
                    @endphp

                    <div class="bg-gray-50 rounded-xl border border-gray-200/60 p-5 flex gap-4 items-center hover:shadow-md transition duration-300">
                        <div class="w-20 h-20 rounded-full bg-gray-200 overflow-hidden shrink-0 border-2 border-white shadow-sm">
                            @if(!empty($ns['hinh_anh']))
                            <img src="{{ env('APP_URL') }}storage/avatars/{{ $ns['hinh_anh'] }}" class="w-full h-full object-cover" alt="{{ $ns['ho_ten'] }}">
                            @else
                            <img src="{{ env('APP_URL') }}assets/frontend/images/default/avatar_placeholder.jpg" class="w-full h-full object-cover" alt="No avatar">
                            @endif
                        </div>
                        <div class="space-y-1 min-w-0">
                            <h4 class="text-sm font-heading font-bold text-gray-900 m-0 truncate">
                                {{ $ns['hoc_ham_hoc_vi'] ? $ns['hoc_ham_hoc_vi'] . '.' : '' }} {{ $ns['ho_ten'] }}
                            </h4>

                            @if(!empty($currentRole['chuc_vu']))
                            <p class="text-xs font-semibold text-agu-blue m-0">{{ $currentRole['chuc_vu'] }}</p>
                            @endif

                            <p class="text-[11px] text-gray-400 truncate m-0">✉️ {{ $ns['email'] }}</p>

                            @if(isset($ns['ly_lich_khoa_hoc']['aliasname']))
                            <div class="pt-1">
                                <a href="{{ env('APP_URL') }}storage/files/{{ $ns['ly_lich_khoa_hoc']['aliasname'] }}" target="_blank" class="inline-flex items-center text-[10px] font-bold text-white bg-agu-green px-2 py-1 rounded hover:bg-green-700 transition">
                                    📑 {{ __('Lý lịch khoa học') }}
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection