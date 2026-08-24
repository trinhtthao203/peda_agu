@php
$taxonomy = (app()->getLocale() == 'vi') ? 'tin-tuc-su-kien' : 'news-and-events';
@endphp

<ul class="nav-main flex items-center space-x-1">
    <li>
        <a href="{{ url('/') }}">{{ __('Trang chủ') }}</a>
    </li>
    <li>
        <a href="#">{{ __('Giới thiệu') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Tổng quan & Chiến lược') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/tong-quan" class="hover:text-agu-blue transition">{{ __('Tổng quan') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/lich-su-hinh-thanh" class="hover:text-agu-blue transition">{{ __('Lịch sử hình thành') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/su-mang-tam-nhin-gia-tri-cot-loi" class="hover:text-agu-blue transition">{{ __('Sứ mạng - Tầm nhìn - Giá trị cốt lõi') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Ban lãnh đạo') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/co-cau-to-chuc" class="hover:text-agu-blue transition">{{ __('Cơ cấu tổ chức') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/ban-chu-nhiem" class="hover:text-agu-blue transition">{{ __('Ban chủ nhiệm') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/hoi-dong-khoa-hoc-va-dao-tao" class="hover:text-agu-blue transition">{{ __('Hội đồng Khoa học và Đào tạo') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Thông tin chung') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/doi-tac" class="hover:text-agu-blue transition">{{ __('Đối tác') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/lien-he" class="hover:text-agu-blue transition">{{ __('Liên hệ') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li>
        <a href="#">{{ __('Đơn vị trực thuộc') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Khối Văn phòng & Tự nhiên') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/van-phong-khoa" class="hover:text-agu-blue transition">{{ __('Văn phòng Khoa') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/bo-mon-toan" class="hover:text-agu-blue transition">{{ __('Bộ môn Toán') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/bo-mon-vl-hh-sh" class="hover:text-agu-blue transition">{{ __('Bộ môn VL - HH - SH') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Khối Xã hội & Giáo dục chuyên ngành') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/bo-mon-ngu-van" class="hover:text-agu-blue transition">{{ __('Bộ môn Ngữ văn') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/bo-mon-lich-su-dia-ly" class="hover:text-agu-blue transition">{{ __('Bộ môn Lịch sử - Địa lý') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/tam-ly-giao-duc-mam-non-tieu-hoc" class="hover:text-agu-blue transition">{{ __('Tâm lý Giáo dục - Mầm non - Tiểu học') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li class="!static">
        <a href="#">{{ __('Đào tạo') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Chương trình Đào tạo') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/chinh-quy" class="hover:text-agu-blue transition">{{ __('Hệ Chính quy (Undergraduate)') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/sau-dai-hoc" class="hover:text-agu-blue transition">{{ __('Hệ Sau đại học (Postgraduate)') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Tài nguyên học thuật') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/de-an-mo-nganh" class="hover:text-agu-blue transition">{{ __('Đề án mở ngành') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/de-cuong-chi-tiet" class="hover:text-agu-blue transition">{{ __('Đề cương chi tiết học phần') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li class="!static">
        <a href="#">{{ __('Nghiên cứu khoa học') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Quản lý Đề tài') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nckh/de-tai-cap-bo-tinh" class="hover:text-agu-blue transition">{{ __('Cấp Bộ / Cấp Tỉnh') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nckh/de-tai-cap-truong" class="hover:text-agu-blue transition">{{ __('Cấp Trường') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nckh/de-tai-cap-khoa" class="hover:text-agu-blue transition">{{ __('Cấp Khoa') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Sản phẩm khoa học') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nckh/bai-bao-khoa-hoc" class="hover:text-agu-blue transition">{{ __('Bài báo khoa học') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nckh/sach-giao-trinh-tlgd" class="hover:text-agu-blue transition">{{ __('Sách / Giáo trình / TLGD') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nckh/sang-kien-kinh-nghiem" class="hover:text-agu-blue transition">{{ __('Sáng kiến kinh nghiệm') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Phong trào người học') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nckh/sinh-vien-nckh" class="hover:text-agu-blue transition">{{ __('Sinh viên NCKH & Sáng tạo') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>

    <li class="!static">
        <a href="#">{{ __('ĐBCL') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Minh bạch thông tin') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dbcl/ba-cong-khai" class="hover:text-agu-blue transition">{{ __('Ba công khai hành chính') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Kiểm định học thuật') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dbcl/kiem-dinh-chat-luong" class="hover:text-agu-blue transition">{{ __('Kiểm định chất lượng') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Hành động hậu kiểm định') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dbcl/cai-tien-chat-luong" class="hover:text-agu-blue transition">{{ __('Cải tiến chất lượng giáo dục') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li class="!static">
        <a href="#">{{ __('Sinh viên') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 right-0 mx-auto p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Tiến trình học tập') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/sinh-vien/hoc-vu" class="hover:text-agu-blue transition">{{ __('Công tác Học vụ') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Chính sách hỗ trợ') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/sinh-vien/hoc-bong-va-ho-tro" class="hover:text-agu-blue transition">{{ __('Học bổng & Hỗ trợ sinh viên') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Hành chính một cửa') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/sinh-vien/quy-trinh-va-bieu-mau" class="hover:text-agu-blue transition">{{ __('Quy trình & Biểu mẫu sinh viên') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>

    <li class="!static">
        <a href="#">{{ __('Tin tức - Sự kiện') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 right-0 mx-auto p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Thông tin công bố') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/tin-moi-nhat" class="hover:text-agu-blue transition font-semibold text-agu-blue">{{ __('🔥 Tin tức mới nhất') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/tin-hoat-dong-khoa-hoc" class="hover:text-agu-blue transition">{{ __('Tin hoạt động khoa học') }}</a></li>
                        @if($menu_tintuc)
                        @foreach($menu_tintuc as $tt)
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/{{ $tt['slug'] }}" class="hover:text-agu-blue transition">{{ $tt['ten'] }}</a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </li>
</ul>