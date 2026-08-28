@extends('Frontend.layout')

@section('title', '404 - ' . __('Không tìm thấy trang'))

@section('body')
<div class="min-h-[60vh] flex items-center justify-center px-4 py-16">
    <div class="max-w-md w-full text-center space-y-6">

        <!-- Con số 404 Nổi bật -->
        <div class="relative">
            <h1 class="text-8xl sm:text-9xl font-heading font-black text-blue-100 tracking-widest select-none">
                404
            </h1>
            <p class="absolute inset-0 flex items-center justify-center font-heading font-bold text-2xl sm:text-3xl uppercase text-[#0066b3]">
                {{ __('Không tìm thấy trang') }}
            </p>
        </div>

        <!-- Mô tả lỗi -->
        <p class="text-gray-600 text-xs sm:text-sm leading-relaxed">
            {{ __('Đường dẫn bạn yêu cầu không tồn tại, đã bị xóa hoặc đã thay đổi địa chỉ truy cập.') }}
        </p>

        <!-- Nút điều hướng -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <a href="{{ url('/') }}"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#0066b3] hover:bg-blue-700 text-white font-bold px-6 py-2.5 rounded-lg text-xs shadow-md transition-all active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>{{ __('Về trang chủ') }}</span>
            </a>

            <a href="javascript:history.back()"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-lg text-xs transition-all active:scale-95 border border-gray-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>{{ __('Quay lại') }}</span>
            </a>
        </div>

    </div>
</div>
@endsection
