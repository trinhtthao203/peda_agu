@php
    $taxonomy = app()->getLocale() == 'vi' ? 'tin-tuc-su-kien' : 'news-and-events';
@endphp

<ul class="nav-main flex items-center space-x-1">
    <li>
        <a href="{{ url('/') }}">{{ __('Trang chủ') }}</a>
    </li>

    <!-- 2. GIỚI THIỆU (Mega Menu 3 cột) -->
    <li class="!static">
        <a href="#">{{ __('Giới thiệu') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 right-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Tổng quan & Chiến lược') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/tong-quan"
                                class="hover:text-agu-blue transition">{{ __('Tổng quan') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/lich-su-hinh-thanh"
                                class="hover:text-agu-blue transition">{{ __('Lịch sử hình thành') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/su-mang-tam-nhin-gia-tri-cot-loi"
                                class="hover:text-agu-blue transition">{{ __('Sứ mạng - Tầm nhìn - Giá trị cốt lõi') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Ban lãnh đạo') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/co-cau-to-chuc"
                                class="hover:text-agu-blue transition">{{ __('Cơ cấu tổ chức') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/ban-chu-nhiem"
                                class="hover:text-agu-blue transition">{{ __('Ban chủ nhiệm') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/hoi-dong-khoa-hoc-va-dao-tao"
                                class="hover:text-agu-blue transition">{{ __('Hội đồng Khoa học và Đào tạo') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Thông tin chung') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/doi-tac"
                                class="hover:text-agu-blue transition">{{ __('Đối tác') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/lien-he"
                                class="hover:text-agu-blue transition">{{ __('Liên hệ & Góp ý') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>

    <!-- 3. ĐƠN VỊ TRỰC THUỘC (Mega Menu 2 cột) -->
    <li class="!static">
        <a href="#">{{ __('Đơn vị trực thuộc') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 right-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Khối Văn phòng & Tự nhiên') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/van-phong-khoa"
                                class="hover:text-agu-blue transition">{{ __('Văn phòng Khoa') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/bo-mon-toan"
                                class="hover:text-agu-blue transition">{{ __('Bộ môn Toán') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/bo-mon-vl-hh-sh"
                                class="hover:text-agu-blue transition">{{ __('Bộ môn VL - HH - SH') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Khối Xã hội & Giáo dục chuyên ngành') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/bo-mon-ngu-van"
                                class="hover:text-agu-blue transition">{{ __('Bộ môn Ngữ văn') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/bo-mon-lich-su-dia-ly"
                                class="hover:text-agu-blue transition">{{ __('Bộ môn Lịch sử - Địa lý') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nhan-su/tam-ly-giao-duc-mam-non-tieu-hoc"
                                class="hover:text-agu-blue transition">{{ __('Tâm lý Giáo dục - Mầm non - Tiểu học') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </li>

    @php
        $taxonomy = 'tin-tuc-su-kien';

        $dsNganh = \App\Models\NganhDaoTao::active()->orderBy('display_order', 'asc')->get();
        $nganhChinhQuy = $dsNganh->where('he_dao_tao', 'DAI_HOC');
        $nganhSauDaiHoc = $dsNganh->where('he_dao_tao', 'SAU_DAI_HOC');

        $subInfoDaoTao = \App\Models\SubInfo::where('locale', 'vi')
            ->where('type', 'dao-tao')
            ->where('status', 1)
            ->get()
            ->keyBy('slug');
    @endphp

    <!-- 4. ĐÀO TẠO (Mega Menu 3 cột) -->
    <li class="!static">
        <a href="#">{{ __('Đào tạo') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 right-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- 1. ĐÀO TẠO CHÍNH QUY -->
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                        🎓 {{ __('Đào tạo chính quy') }}
                    </span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        @forelse($nganhChinhQuy as $nganh)
                            @if (isset($subInfoDaoTao[$nganh->slug]))
                                <li>
                                    <a href="{{ env('APP_URL') }}vi/dao-tao/{{ $nganh->slug }}"
                                        class="hover:text-agu-blue transition block truncate">
                                        • {{ $nganh->ten }}
                                    </a>
                                </li>
                            @endif
                        @empty
                            <li class="text-gray-400 italic">{{ __('Đang cập nhật...') }}</li>
                        @endforelse
                    </ul>
                </div>

                <!-- 2. SAU ĐẠI HỌC -->
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                        🏛️ {{ __('Sau đại học') }}
                    </span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        @forelse($nganhSauDaiHoc as $nganh)
                            @if (isset($subInfoDaoTao[$nganh->slug]))
                                <li>
                                    <a href="{{ env('APP_URL') }}vi/dao-tao/{{ $nganh->slug }}"
                                        class="hover:text-agu-blue transition block truncate">
                                        • {{ $nganh->ten }}
                                    </a>
                                </li>
                            @endif
                        @empty
                            <li class="text-gray-400 italic">{{ __('Đang cập nhật...') }}</li>
                        @endforelse
                    </ul>
                </div>

                <!-- 3. TÀI NGUYÊN HỌC THUẬT -->
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                        📚 {{ __('Tài nguyên học thuật') }}
                    </span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="https://aao.agu.edu.vn/?q=node/25" target="_blank"
                                class="hover:text-agu-blue transition">{{ __('Chương trình đào tạo') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}vi/dao-tao/de-cuong-chi-tiet"
                                class="hover:text-agu-blue transition">{{ __('Đề cương chi tiết') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}vi/dao-tao/de-an-mo-nganh"
                                class="hover:text-agu-blue transition">{{ __('Đề án mở ngành') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>

    <!-- 5. NGHIÊN CỨU KHOA HỌC (Dropdown 2 cột gọn gàng) -->
    <li class="relative group">
        <a href="#">{{ __('NCKH') }} <span class="text-[10px] ml-1">▼</span></a>
        <div
            class="mega-menu-dropdown absolute left-0 top-full hidden group-hover:block w-[560px] bg-white shadow-lg p-6 z-50">
            <div class="grid grid-cols-2 gap-6">
                <!-- Cột 1: Đề tài nghiên cứu -->
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                        {{ __('Đề tài nghiên cứu') }}
                    </span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li>
                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nckh/de-tai-cap-bo-tinh"
                                class="hover:text-agu-blue transition">{{ __('Cấp Bộ / Cấp Tỉnh') }}</a>
                        </li>
                        <li>
                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nckh/de-tai-cap-truong"
                                class="hover:text-agu-blue transition">{{ __('Cấp Trường') }}</a>
                        </li>
                        <li>
                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nckh/de-tai-cap-khoa"
                                class="hover:text-agu-blue transition">{{ __('Cấp Khoa') }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Cột 2: Công trình khoa học -->
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                        {{ __('Công trình khoa học') }}
                    </span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li>
                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nckh/bai-bao-khoa-hoc"
                                class="hover:text-agu-blue transition">{{ __('Bài báo khoa học') }}</a>
                        </li>
                        <li>
                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nckh/sach-giao-trinh-tlgd"
                                class="hover:text-agu-blue transition">{{ __('Sách/Giáo trình/TLGD') }}</a>
                        </li>
                        <li>
                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nckh/sang-kien-kinh-nghiem"
                                class="hover:text-agu-blue transition">{{ __('Sáng kiến kinh nghiệm') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </li>

    <!-- ĐBCL (Dropdown 1 cột) -->
    <li class="relative group">
        <a href="#">{{ __('ĐBCL') }} <span class="text-[10px] ml-1">▼</span></a>
        <div
            class="mega-menu-dropdown absolute left-0 top-full hidden group-hover:block w-72 bg-white shadow-lg p-5 z-50">
            <div class="space-y-3">
                <span
                    class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                    {{ __('Đảm bảo chất lượng') }}
                </span>
                <ul class="space-y-2 text-xs text-gray-600">
                    <li>
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dbcl/muc-tieu-chat-luong"
                            class="hover:text-agu-blue transition">
                            {{ __('Mục tiêu chất lượng') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dbcl/thong-tin-phan-hoi"
                            class="hover:text-agu-blue transition">
                            {{ __('Thông tin phản hồi') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dbcl/tu-danh-gia-ctdt"
                            class="hover:text-agu-blue transition">
                            {{ __('Tự đánh giá CTĐT') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </li>

    <!-- 7. SINH VIÊN (1 cột) -->
    <li class="relative group">
        <a href="#">{{ __('Văn bản – Biểu mẫu') }} <span class="text-[10px] ml-1">▼</span></a>
        <div
            class="mega-menu-dropdown absolute left-0 top-full hidden group-hover:block w-72 bg-white shadow-lg p-5 z-50">
            <div class="space-y-3">
                <ul class="space-y-2 text-xs text-gray-600">
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/sinh-vien/quy-trinh"
                            class="hover:text-agu-blue transition">{{ __('Quy trình') }}</a></li>
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/sinh-vien/van-ban"
                            class="hover:text-agu-blue transition">{{ __('Văn bản') }}</a></li>
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/sinh-vien/bieu-mau"
                            class="hover:text-agu-blue transition">{{ __('Biểu mẫu') }}</a></li>
                </ul>
            </div>
        </div>
    </li>

    <li class="relative group">
        <a href="#">{{ __('Tin tức - Sự kiện') }} <span class="text-[10px] ml-1">▼</span></a>
        <div
            class="mega-menu-dropdown absolute left-0 top-full hidden group-hover:block w-72 bg-white shadow-lg p-5 z-50">
            <div class="space-y-3">
                <span
                    class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Thông tin công bố') }}</span>
                <ul class="space-y-2 text-xs text-gray-600">
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/tin-moi-nhat"
                            class="hover:text-agu-blue transition font-semibold text-agu-blue">{{ __('🔥 Tin tức mới nhất') }}</a>
                    </li>
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/tin-hoat-dong-khoa-hoc"
                            class="hover:text-agu-blue transition">{{ __('Tin hoạt động khoa học') }}</a></li>
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/doi-ngoai"
                            class="hover:text-agu-blue transition">{{ __('Đối ngoại') }}</a></li>
                </ul>
            </div>
        </div>
    </li>
</ul>
