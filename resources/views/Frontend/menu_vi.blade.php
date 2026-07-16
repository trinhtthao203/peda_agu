<ul class="nav-main flex items-center space-x-1">
    <li>
        <a href="{{ url('/') }}">{{ __('Trang chủ') }}</a>
    </li>

    <li>
        <a href="#">{{ __('Giới thiệu') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Trường Đại học An Giang') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/tong-quan-ve-truong-dai-hoc-an-giang" class="hover:text-agu-blue transition">{{ __('Tổng quan Trường') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/so-do-to-chuc" class="hover:text-agu-blue transition">{{ __('Sơ đồ tổ chức') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/ban-giam-hieu" class="hover:text-agu-blue transition">{{ __('Ban Giám hiệu') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/su-mang-tam-nhin-gia-tri-cot-loi" class="hover:text-agu-blue transition">{{ __('Sứ mạng - Tầm nhìn') }}</a></li>
                    </ul>
                </div>

                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Thông tin chung') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="https://25years.agu.edu.vn/" target="_blank" class="hover:text-agu-blue transition">{{ __('Kỷ niệm 25 năm thành lập') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/bao-cao-thuong-nien" class="hover:text-agu-blue transition">{{ __('Báo cáo thường niên') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/lien-he" class="hover:text-agu-blue transition">{{ __('Liên hệ hệ thống') }}</a></li>
                    </ul>
                </div>

                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Các dịch vụ') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="https://mail.google.com/a/agu.edu.vn" target="_blank" class="hover:text-agu-blue transition">{{ __('Thư điện tử công vụ') }}</a></li>
                        <li><a href="http://regis.agu.edu.vn/" target="_blank" class="hover:text-agu-blue transition">{{ __('Đăng ký học phần') }}</a></li>
                        <li><a href="https://lib.agu.edu.vn/" target="_blank" class="hover:text-agu-blue transition">{{ __('Hệ thống học liệu thư viện') }}</a></li>
                    </ul>
                </div>

                @if($menu_tintuc)
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Tin tức - Sự kiện') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/tin-moi-nhat" class="hover:text-agu-blue transition">{{ __('Tin tức mới nhất') }}</a></li>
                        @foreach($menu_tintuc as $tt)
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/{{ $tt['slug'] }}" class="hover:text-agu-blue transition">{{ $tt['ten'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </li>

    <li>
        <a href="#">{{ __('Đào tạo & ĐBCL') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Hệ thống Đào tạo') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="https://pgd.agu.edu.vn" target="_blank" class="hover:text-agu-blue transition">{{ __('Trình độ Sau đại học') }}</a></li>
                        <li><a href="https://aao.agu.edu.vn/" target="_blank" class="hover:text-agu-blue transition">{{ __('Trình độ Đại học chính quy') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Đảm bảo chất lượng') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/tu-danh-gia-co-so-giao-duc" class="hover:text-agu-blue transition">{{ __('Tự đánh giá cơ sở giáo dục') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/tu-danh-gia-chuong-trinh-dao-tao" class="hover:text-agu-blue transition">{{ __('Tự đánh giá CTĐT đạt chuẩn') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>

    <li><a href="https://tuyensinh.agu.edu.vn" target="_blank">{{ __('Tuyển sinh') }}</a></li>
    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/quy-che-cong-khai">{{ __('Quy chế công khai') }}</a></li>
    <li><a href="https://lms.agu.edu.vn" target="_blank">LMS/LCMS</a></li>
</ul>
