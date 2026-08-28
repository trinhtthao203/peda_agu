@extends('Frontend.layout')

@section('title', __('Liên hệ & Tiếp nhận Ý kiến') . ' - ' . __('Khoa Sư phạm'))

@section('body')
<!-- Banner Tiêu đề -->
<div class="bg-gradient-to-r from-[#003b6d] to-[#0066b3] text-white py-12 px-6">
    <div class="max-w-7xl mx-auto text-center md:text-left">
        <h1 class="text-2xl md:text-3xl font-heading font-bold uppercase tracking-wide">
            {{ __('Liên hệ & Tiếp nhận ý kiến đóng góp') }}
        </h1>
        <p class="text-xs sm:text-sm text-blue-100 mt-2">
            {{ __('Kênh thông tin liên lạc chính thức và tiếp nhận ý kiến, sáng kiến từ Người học và Doanh nghiệp.') }}
        </p>
    </div>
</div>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">
    <!-- KHỐI 1: THÔNG TIN LIÊN HỆ, BẢN ĐỒ & FORM GÓP Ý -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">

        <!-- CỘT TRÁI: THÔNG TIN & BẢN ĐỒ -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white p-6 sm:p-7 rounded-2xl shadow-sm border border-gray-200">
                <h2 class="text-base sm:text-lg font-bold font-heading text-gray-800 uppercase tracking-wide border-b pb-3 mb-4 border-gray-100 flex items-center gap-2">
                    <svg class="w-5 h-5 text-agu-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    {{ __('Thông tin liên hệ') }}
                </h2>

                <div class="space-y-4 text-xs sm:text-sm text-gray-600">
                    <div>
                        <strong class="text-gray-900 block font-heading mb-1">{{ __('Khoa Sư phạm - Trường Đại học An Giang') }}</strong>
                        <p>{{ __('Số 18 Ung Văn Khiêm, Phường Đông Xuyên, TP. Long Xuyên, Tỉnh An Giang') }}</p>
                    </div>

                    <div class="pt-3 border-t border-gray-100 space-y-2.5">
                        <p class="flex items-center gap-3">
                            <span class="p-2 rounded-lg bg-blue-50 text-agu-blue shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <span><strong>Email:</strong> <a href="mailto:peda@agu.edu.vn" class="text-agu-blue hover:underline">peda@agu.edu.vn</a></span>
                        </p>

                        <p class="flex items-center gap-3">
                            <span class="p-2 rounded-lg bg-blue-50 text-agu-blue shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </span>
                            <span><strong>{{ __('Điện thoại') }}:</strong> <a href="tel:+842966256565" class="text-agu-blue hover:underline">+84 296 6256565 (ext 1900)</a></span>
                        </p>

                        <p class="flex items-center gap-3">
                            <span class="p-2 rounded-lg bg-blue-50 text-agu-blue shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <span><strong>{{ __('Giờ làm việc:') }}</strong> {{ __('Thứ Hai - Thứ Sáu (07:00 - 17:00)') }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Khung Bản đồ Vị trí -->
            <div class="bg-white p-2 sm:p-3 rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.627295627254!2d105.43015431526463!3d10.37165586938361!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310a72e81d6d8437%3A0x6a2c2bfba617c0a!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBBbiBHaWFuZw!5e0!3m2!1svi!2svn!4v1650000000000!5m2!1svi!2svn"
                    width="100%"
                    height="260"
                    style="border:0; border-radius: 0.75rem;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <!-- CỘT PHẢI: FORM GỬI Ý KIẾN -->
        <div class="lg:col-span-7">
            <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-gray-200">
                <div class="mb-6">
                    <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-agu-blue text-xs font-semibold uppercase tracking-wider mb-2">
                        {{ __('Đồng hành & Lắng nghe') }}
                    </span>
                    <h2 class="text-xl sm:text-2xl font-bold font-heading text-gray-800 uppercase">
                        {{ __('Gửi ý kiến đóng góp / Phản ánh') }}
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">
                        {{ __('Thông tin người gửi được bảo mật. Ý kiến sẽ được chuyển đến đúng đơn vị chuyên trách để xử lý.') }}
                    </p>
                </div>

                <form id="contactFeedbackForm" class="space-y-4">
                    @csrf
                    <input type="text" name="_hp_security" class="hidden" tabindex="-1" autocomplete="off">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                                {{ __('Bạn là:') }} <span class="text-rose-500">*</span>
                            </label>
                            <select name="sender_type" required class="w-full bg-gray-50 border border-gray-300 text-gray-800 rounded-lg px-3.5 py-2.5 text-xs focus:ring-2 focus:ring-agu-blue focus:bg-white outline-none">
                                <option value="student">{{ __('Người học / Sinh viên / Học viên') }}</option>
                                <option value="business">{{ __('Doanh nghiệp / Đơn vị tuyển dụng') }}</option>
                                <option value="alumni">{{ __('Cựu sinh viên') }}</option>
                                <option value="other">{{ __('Đối tác / Khác') }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                                {{ __('Lĩnh vực góp ý:') }} <span class="text-rose-500">*</span>
                            </label>
                            <select name="topic" required class="w-full bg-gray-50 border border-gray-300 text-gray-800 rounded-lg px-3.5 py-2.5 text-xs focus:ring-2 focus:ring-agu-blue focus:bg-white outline-none">
                                <option value="dao-tao">{{ __('Chương trình đào tạo / Giảng dạy') }}</option>
                                <option value="co-so-vat-chat">{{ __('Cơ sở vật chất / Trang thiết bị') }}</option>
                                <option value="viec-lam">{{ __('Nhu cầu tuyển dụng & Thực tập') }}</option>
                                <option value="khac">{{ __('Ý kiến / Đề xuất khác') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">{{ __('Họ và tên') }}:</label>
                            <input type="text" name="fullname" placeholder="{{ __('Tùy chọn (Để trống nếu muốn ẩn danh)') }}" class="w-full bg-gray-50 border border-gray-300 text-gray-800 rounded-lg px-3.5 py-2.5 text-xs focus:ring-2 focus:ring-agu-blue focus:bg-white outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">{{ __('Email hoặc Số điện thoại') }}:</label>
                            <input type="text" name="contact" placeholder="{{ __('Tùy chọn (Để nhận phản hồi trực tiếp)') }}" class="w-full bg-gray-50 border border-gray-300 text-gray-800 rounded-lg px-3.5 py-2.5 text-xs focus:ring-2 focus:ring-agu-blue focus:bg-white outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                            {{ __('Nội dung đóng góp chi tiết:') }} <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="content" rows="4" required placeholder="{{ __('Mô tả chi tiết ý kiến, phản ánh hoặc sáng kiến của bạn...') }}" class="w-full bg-gray-50 border border-gray-300 text-gray-800 rounded-lg px-3.5 py-2.5 text-xs focus:ring-2 focus:ring-agu-blue focus:bg-white outline-none resize-none"></textarea>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-2">
                        <div id="contactMsg" class="text-xs font-semibold"></div>
                        <button type="submit" id="btnSendContact" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-agu-blue hover:bg-blue-700 text-white font-bold px-7 py-3 rounded-lg text-xs shadow-md transition-all active:scale-95">
                            <span>{{ __('Gửi ý kiến đóng góp') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- KHỐI 2: DANH SÁCH Ý KIẾN ĐÃ ĐƯỢC PHẢN HỒI CÔNG KHAI -->
    @if(isset($publishedFeedbacks) && $publishedFeedbacks->count() > 0)
    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-gray-200">
        <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
            <span class="p-2.5 bg-blue-50 text-agu-blue rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
            </span>
            <div>
                <h3 class="text-lg font-bold font-heading uppercase text-gray-800">
                    {{ __('Ý kiến & Phản hồi công khai') }}
                </h3>
                <p class="text-xs text-gray-500">
                    {{ __('Tổng hợp các ý kiến đóng góp tiêu biểu và câu trả lời chính thức từ Khoa.') }}
                </p>
            </div>
        </div>

        <!-- Danh sách bài viết -->
        <div class="space-y-6">
            @foreach($publishedFeedbacks as $item)
            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200/70 space-y-3">
                <div class="flex flex-wrap items-center justify-between gap-2 text-xs">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-gray-800">{{ $item->fullname ?: __('Ẩn danh') }}</span>
                        <span class="text-gray-400">•</span>
                        <span class="px-2.5 py-0.5 rounded-full bg-blue-100 text-agu-blue font-medium">
                            @if($item->topic == 'dao-tao') {{ __('Đào tạo') }}
                            @elseif($item->topic == 'co-so-vat-chat') {{ __('Cơ sở vật chất') }}
                            @elseif($item->topic == 'viec-lam') {{ __('Tuyển dụng & Việc làm') }}
                            @else {{ __('Khác') }} @endif
                        </span>
                    </div>
                    <span class="text-gray-400 text-[11px]">
                        {{ $item->created_at ? date('d/m/Y H:i', strtotime($item->created_at)) : '' }}
                    </span>
                </div>

                <p class="text-xs sm:text-sm text-gray-700 leading-relaxed font-medium">
                    "{{ $item->content }}"
                </p>

                @if($item->response_content)
                <div class="bg-white border-l-4 border-agu-blue p-4 rounded-r-lg text-xs sm:text-sm shadow-sm space-y-1.5">
                    <div class="flex items-center justify-between text-xs text-agu-blue font-bold">
                        <span>{{ __('Phản hồi từ:') }} {{ $item->responder_name ?: ($item->assigned_to ?: __('Ban Chủ nhiệm Khoa')) }}</span>
                        <span class="font-normal text-gray-400 text-[11px]">
                            {{ $item->responded_at ? date('d/m/Y', strtotime($item->responded_at)) : '' }}
                        </span>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $item->response_content }}
                    </p>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <!-- Phân trang ngang -->
        @if (method_exists($publishedFeedbacks, 'hasPages') && $publishedFeedbacks->hasPages())
        <div class="mt-8 pt-4 border-t border-gray-100 flex items-center justify-center">
            <nav class="flex items-center gap-1.5" aria-label="Pagination">
                @if ($publishedFeedbacks->onFirstPage())
                <span class="w-9 h-9 flex items-center justify-center rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </span>
                @else
                <a href="{{ $publishedFeedbacks->previousPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-agu-blue hover:text-white hover:border-agu-blue transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                @endif

                @foreach ($publishedFeedbacks->getUrlRange(1, $publishedFeedbacks->lastPage()) as $page => $url)
                @if ($page == $publishedFeedbacks->currentPage())
                <span class="w-9 h-9 flex items-center justify-center rounded-lg bg-agu-blue text-white font-bold text-xs shadow-sm">
                    {{ $page }}
                </span>
                @else
                <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-blue-50 hover:text-agu-blue text-xs font-semibold transition shadow-sm">
                    {{ $page }}
                </a>
                @endif
                @endforeach

                @if ($publishedFeedbacks->hasMorePages())
                <a href="{{ $publishedFeedbacks->nextPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-agu-blue hover:text-white hover:border-agu-blue transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                @else
                <span class="w-9 h-9 flex items-center justify-center rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
                @endif
            </nav>
        </div>
        @endif
    </div>
    @endif
</main>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#contactFeedbackForm').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var btn = $('#btnSendContact');

        btn.prop('disabled', true).addClass('opacity-50');

        $.ajax({
            url: '{{ route("feedback.submit") }}',
            type: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            dataType: 'json',
            success: function(res) {
                btn.prop('disabled', false).removeClass('opacity-50');
                form[0].reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: res.message,
                    confirmButtonColor: '#0066b3'
                });
            },
            error: function(xhr) {
                btn.prop('disabled', false).removeClass('opacity-50');
                var errMsg = 'Có lỗi xảy ra, vui lòng thử lại.';
                if (xhr.status === 429) {
                    errMsg = 'Bạn gửi quá nhanh, vui lòng chờ 1 phút.';
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errMsg = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Chưa gửi được',
                    text: errMsg,
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
</script>
@endsection
