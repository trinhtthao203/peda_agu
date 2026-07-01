<ul class="nav nav-pills nav-main" id="mainMenu">
    <li class="dropdown mega-menu-item mega-menu-fullwidth">
        <a class="dropdown-toggle" href="#"> {{ __('Giới thiệu') }} <i class="fa fa-caret-down"></i></a>
        <ul class="dropdown-menu">
            <li>
                <div class="mega-menu-content">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">{{ __('Trường Đại học An Giang') }}</span>
                                    <ul class="sub-menu">
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/tong-quan-ve-truong-dai-hoc-an-giang">Tổng quan về Trường Đại học An Giang</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/so-do-to-chuc">Sơ đồ tổ chức</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/dang-uy">Đảng ủy</a></li>
                                        {{-- -<li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/hoi-dong-truong">Hội đồng trường</a></li> --}}
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/ban-giam-hieu">Ban Giám hiệu</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/hoi-dong-khoa-hoc">Hội đồng Khoa học</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/su-mang-tam-nhin-gia-tri-cot-loi">Sứ mạng - Tầm nhìn - Giá trị cốt lõi - Triết lý giáo dục - Bản sắc người học</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/chinh-sach-dam-bao-chat-luong-phuong-cham-hoat-dong">Chính sách đảm bảo chất lượng - Phương châm hoạt động</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/ke-hoach-chien-luoc">Kế hoạch chiến lược</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/brochure">Brochure</a></li>
                                        {{--  <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/chien-luoc-phat-trien">Chiến lược phát triển</a></li>--}}
                                        {{-- <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/brochure">Brochure Trường Đại học An Giang</a></li> --}}
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">{{ __('Thông tin chung') }}</span>
                                    <ul class="sub-menu">
                                        <li><a href="https://25years.agu.edu.vn/" target="_blank">Kỷ niệm 25 năm thành lập Trường</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/logo-ky-niem-25-nam-thanh-lap-truong">Logo kỷ niệm 25 năm thành lập Trường</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/bao-cao-thuong-nien">Báo cáo thường niên</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/dai-hoc-an-giang-theo-dong-thoi-gian">Trường ĐHAG theo dòng thời gian</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/video-gioi-thieu">Video giới thiệu về Trường ĐHAG</a></li>
                                        <li><a href="{{ env('APP_URL') }}20years" target="_blanks">20 năm Trường Đại học An Giang</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/bai-hat-dhag-truong-chung-toi">Bài hát “ĐHAG Trường Chúng Tôi”</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/dhag-qua-goc-nhin-flycam">Trường ĐHAG qua góc nhìn Flycam</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/hinh-anh-hoat-dong">Thư viện ảnh</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/van-ban-quan-ly-dieu-hanh">Văn bản Quản lý - Điều hành</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/phat-trien-ben-vung">Phát triển bền vững</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/lien-he">Liên hệ</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Các dịch vụ</span>
                                    <ul class="sub-menu">
                                        <li><a href="https://mail.google.com/a/agu.edu.vn" target="_blank">Thư điện tử</a></li>
                                        <li><a href="http://enews.agu.edu.vn/" target="_blank">e-News</a></li>
                                        <li><a href="http://regis.agu.edu.vn/" target="_blank">Đăng ký học phần</a></li>
                                        <li><a href="https://its.agu.edu.vn/" target="_blank">Tài nguyên CNTT</a></li>
                                        <li><a href="https://opac.vnulib.edu.vn/" target="_blank">Học liệu</a></li>
                                        <li><a href="https://ir.vnulib.edu.vn/home" target="_blank">Tài liệu số</a></li>
                                        <li><a href="https://lib.agu.edu.vn/co-so-du-lieu" target="_blank">Cơ sở dữ liệu</a></li>
                                        {{--  <li><a href="https://docs.agu.edu.vn/tracuucongvan/" target="_blank">Công văn</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/bieu-mau">Các biểu mẫu</a></li> --}}
                                        <li><a href="https://epa.agu.edu.vn/" target="_blank">Khu Thí nghiệm - Thực hành</a></li>
                                        <li><a href="https://cict.agu.edu.vn/danh-ba-dien-thoai" target="_blank">Danh bạ điện thoại</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        @php
                            $menu_tintuc = App\Models\DMThongTin::where('locale', '=', app()->getLocale())->where('thu_tu', '>', 0)->orderBy('thu_tu', 'asc')->get();
                        @endphp
                        @if($menu_tintuc)
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Tin tức - Sự kiện</span>
                                    <ul class="sub-menu">
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/tin-moi-nhat">Tin mới nhất</a></li>
                                        @foreach($menu_tintuc as $tt)
                                            <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/{{ $tt['slug'] }}">{{ $tt['ten'] }}</a></li>
                                        @endforeach
                                        {{-- <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/tuyen-sinh">Tuyển sinh</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/hoat-dong-dao-tao">Hoạt động đào tạo</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/hop-tac-quoc-te">Hợp tác Quốc tế</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/nghien-cuu-khoa-hoc">Nghiên cứu khoa học</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/tuyen-dung">Tuyển dụng</a></li> --}}
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </li>
        </ul>
    </li>
    <li class="dropdown mega-menu-item mega-menu-fullwidth">
        <a class="dropdown-toggle" href="#"> Đào tạo & ĐBCL <i class="fa fa-caret-down"></i></a>
        <ul class="dropdown-menu">
            <li>
                <div class="mega-menu-content">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Đào tạo</span>
                                    <ul class="sub-menu">
                                        <li><a href="https://pgd.agu.edu.vn" target="_blank">Trình độ sau đại học</a></li>
                                        <li><a href="https://aao.agu.edu.vn/?q=content/ct%C4%91t-tr%C3%ACnh-%C4%91%E1%BB%99-%C4%91%E1%BA%A1i-h%E1%BB%8Dc" target="_blank">Trình độ đại học</a></li>
                                        {{-- <li><a href="https://aao.agu.edu.vn/?q=content/ct%C4%91t-tr%C3%ACnh-%C4%91%E1%BB%99-cao-%C4%91%E1%BA%B3ng" target="_blank">Trình độ Cao đẳng</a></li> --}}
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        {{-- <div class="col-md-4">
                            <ul class="sub-menu menu-border">
                                <li class="has-sub">
                                    <span class="mega-menu-sub-title">Tuyển sinh</span>
                                    <ul class="sub-menu">
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh">Thông tin Tuyển sinh</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/cam-nang-tuyen-sinh">Cẩm nang Tuyển sinh</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/de-an-mo-nganh">Đề án mở ngành</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>--}}
                        <div class="col-md-6">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Đảm bảo Chất lượng</span>
                                    <ul class="sub-menu">
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/tu-danh-gia-co-so-giao-duc">Tự đánh giá Cơ sở Giáo dục</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/tu-danh-gia-chuong-trinh-dao-tao">Tự đánh giá Chương trình Đào tạo</a></li>
                                        <li><a href="https://fms.agu.edu.vn/{{ app()->getLocale() }}" target="_blank">Hệ thống quản lý CSDL ĐBCL </a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/so-tay-dam-bao-chat-luong">Sổ tay Đảm bảo Chất lượng</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/giay-chung-nhan-dam-bao-chat-luong">Giấy chứng nhận Đảm bảo Chất lượng</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </li>
    <li>
        <a href="https://tuyensinh.agu.edu.vn" target="_blank">Tuyển sinh</a>
    </li>
    <li class="dropdown mega-menu-item mega-menu-fullwidth">
        <a class="dropdown-toggle" href="#"> NCKH&QHĐN <i class="fa fa-caret-down"></i></a>
        <ul class="dropdown-menu">
            <li>
                <div class="mega-menu-content">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Nghiên cứu Khoa học</span>
                                    <ul class="sub-menu">
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/nghien-cuu-khoa-hoc">Hoạt động Nghiên cứu Khoa học</a></li>
                                        {{-- <li><a href="https://dspace.agu.edu.vn/handle/agu_library/5442" target="_blank">Công trình khoa học</a></li> --}}
                                        <li><a href="http://sj.agu.edu.vn/" target="_blank">Tạp chí khoa học</a></li>
                                        <li><a href="https://rmgo.agu.edu.vn" target="_blank">Hội nghị - Hội thảo</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Quan hệ Đối ngoại</span>
                                    <ul class="sub-menu">
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/hop-tac-quoc-te">Hợp tác Quốc tế</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/doi-tac-ban-ghi-nho">Đối tác - Bản ghi nhớ</a></li>
                                        <li><a href="https://sahed.agu.edu.vn/" target="_blank">Dự án SAHED</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </li>
    <li class="dropdown mega-menu-item mega-menu-fullwidth">
        <a class="dropdown-toggle" href="#"> Các đơn vị <i class="fa fa-caret-down"></i></a>
        <ul class="dropdown-menu">
            <li>
                <div class="mega-menu-content">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Đơn vị Đào tạo</span>
                                    <ul class="sub-menu">
                                        <li><a href="http://agri.agu.edu.vn/" target="_blank">Khoa Nông nghiệp - Tài nguyên thiên nhiên</a></li>
                                        <li><a href="http://tech.agu.edu.vn/" target="_blank">Khoa Kỹ thuật - Công nghệ - Môi trường</a></li>
                                        <li><a href="http://fit.agu.edu.vn/" target="_blank">Khoa Công nghệ thông tin</a></li>
                                        <li><a href="http://peda.agu.edu.vn/"  target="_blank">Khoa Sư phạm</a></li>
                                        <li><a href="http://feba.agu.edu.vn/"  target="_blank">Khoa Kinh tế - Quản trị kinh doanh</a></li>
                                        <li><a href="http://fpe.agu.edu.vn/"  target="_blank">Khoa Luật và Khoa học chính trị</a></li>
                                        <li><a href="http://ffl.agu.edu.vn/"  target="_blank">Khoa Ngoại ngữ</a></li><li><a href="http://fac.agu.edu.vn/"  target="_blank">Khoa Du lịch và Văn hóa - Nghệ thuật</a></li>
                                        <li><a href="http://pe.agu.edu.vn/"  target="_blank">Bộ môn Giáo dục thể chất</a></li>
                                        <li><a href="http://nde.agu.edu.vn/"  target="_blank">Bộ môn Giáo dục quốc phòng</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Đơn vị Chức năng</span>
                                    <ul class="sub-menu">
                                        <li><a href="http://aao.agu.edu.vn/" target="_blank">Phòng Đào tạo</a></li>
                                        <li><a href="http://exams.agu.edu.vn/" target="_blank">Phòng Khảo thí và Đảm bảo chất lượng</a></li>
                                        <li><a href="http://exro.agu.edu.vn/" target="_blank">Phòng Quan hệ đối ngoại</a></li>
                                        <li><a href="http://rmgo.agu.edu.vn/" target="_blank">Phòng Khoa học và Công nghệ</a></li>
                                        <li><a href="http://ado.agu.edu.vn/" target="_blank">Phòng Hành chính - Tổng hợp</a></li>
                                        <li><a href="http://peo.agu.edu.vn/" target="_blank">Phòng Tố chức - Chính trị</a></li>
                                        <li><a href="http://sao.agu.edu.vn/" target="_blank">Phòng Công tác sinh viên</a></li>
                                        <li><a href="http://po.agu.edu.vn/" target="_blank">Phòng Quản trị - Thiết bị</a></li>
                                        {{-- <li><a href="http://lid.agu.edu.vn/" target="_blank">Phòng Thanh tra - Pháp chế</a></li> --}}
                                        <li><a href="http://pfo.agu.edu.vn/" target="_blank">Phòng Kế hoạch - Tài vụ</a></li>
                                        <li><a href="http://lib.agu.edu.vn/" target="_blank">Thư viện</a></li>
                                        {{--  <li><a href="http://csm.agu.edu.vn/" target="">Trung tâm Quản lý dịch vụ</a></li>--}}
                                        <li><a href="http://ctepsd.agu.edu.vn" target="">Trung tâm Bồi dưỡng nhà giáo và Phát triển kỹ năng</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Đơn vị Sự nghiệp</span>
                                    <ul class="sub-menu">
                                        <li><a href="http://cci.agu.edu.vn/" target="_blank">Viện Biến đổi Khí hậu</a></li>
                                        {{-- <li><a href="http://shrc.agu.edu.vn/" target="_blank">Trung tâm Nghiên cứu Khoa học xã hội và nhân văn</a></li> --}}
                                        {{-- -<li><a href="http://cflhrd.agu.edu.vn/" target="_blank">Trung tâm Ngoại ngữ và Phát triển nguồn nhân lực</a></li> --}}
                                        <li><a href="http://citfl.agu.edu.vn/" target="_blank">Trung tâm Tin học và Ngoại ngữ</a></li>
                                        {{-- <li><a href="http://cfl.agu.edu.vn/" target="_blank">Trung tâm Ngoại ngữ</a></li> --}}
                                        <li><a href="http://cds.agu.edu.vn/" target="">Trung tâm Dịch vụ Ký túc xá</a></li>
                                        <li><a href="http://pps.agu.edu.vn/" target="_blank">Trường Phổ thông Thực hành Sư phạm</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Tố chức Chính trị - Xã hội</span>
                                    <ul class="sub-menu">
                                        <li><a href="http://cpv.agu.edu.vn/" target="_blank">Đảng ủy</a></li>
                                        <li><a href="http://union.agu.edu.vn" target="_blank">Công đoàn</a></li>
                                        <li><a href="http://youth.agu.edu.vn/" target="_blank">Đoàn Thanh niên</a></li>
                                        <li><a href="http://youth.agu.edu.vn/" target="_blank">Hội Sinh viên</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/hoi-cuu-sinh-vien">Cựu sinh viên</a></li>
                                        <li><a href="https://www.agu.edu.vn/hoi-cuu-giao-chuc/" target="_blank">Hội Cựu giáo chức</a>  </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tin-tuc-su-kien/quy-che-cong-khai">Quy chế công khai</a>
    </li>
    <li><a href="https://lms.agu.edu.vn" target="_blank">LMS/LCMS</a></li>
</ul>
