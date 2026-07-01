@extends('Frontend.TuyenSinh.layout')
@section('title', 'Tra cứu Kết quả tuyển sinh năm 2025')
@section('css')
<style>
    #SearchForm input,  #SearchForm select{
        font-size: 18px;
    }
    ul {
        list-style-type: square !important;
        margin-left: 40px;
        margin-right: 40px;
    }
    li {
        text-align: justify;
        font-size: 18px;
        line-height: 28px;
    }
    .table th {
        border: 1px solid #ccc !important;
        text-align:center;
    }
    .table th, .table td {
        vertical-align: middle !important;
    }
    .nowrap {
        white-space: nowrap !important;
    }
    h5 {
        font-size: 20px; font-weight: 400;
    }
    .panel-body p {
        font-size: 18px;text-align: justify;
        padding:0px 30px 0px 30px;
    }
</style>
@endsection
@section('body')
@php
    if($phuongthuc == 'diem-thi-nang-khieu-khoi-m') $title='Tra cứu điểm thi tuyển sinh năng khiếu (Khối M) kỳ thi tuyển sinh đại học năm 2025';
    else if($phuongthuc == 'ket-qua-tuyen-sinh')  $title = 'Kết quả trúng tuyển Đại học Chính Quy năm 2025';
    else if($phuongthuc == 'ket-qua-tuyen-sinh-bs')  $title = 'Kết quả trúng tuyển Đại học Chính Quy năm 2025 (Bổ sung)';
    else if($phuongthuc == 'ket-qua-tuyen-sinh-bs2')  $title = 'Kết quả trúng tuyển Đại học Chính Quy năm 2025 (Bổ sung đợt 2)';
    else if($phuongthuc == 'ket-qua-tuyen-sinh-bs3')  $title = 'Kết quả trúng tuyển Đại học Chính Quy năm 2025 (Bổ sung đợt 3)';
    else if($phuongthuc == 'quy-che-tuyen-sinh-bgddt') $title='Tra cứu kết quả hồ sơ xét tuyển thẳng theo Quy chế Tuyển sinh đại học của Bộ Giáo dục và Đào tạo năm 2025';
    else $title = '';
@endphp
<section class="bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-container text-left sm">
                    <div class="title-wrap">
                        <h4 class="title">{{ $title }}</h4>
                        <span class="separator line-separator"></span>
                    </div>							
                </div><!-- Name -->
            </div><!-- Column -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Search -->
                <div class="search">
                    <form id="SearchForm" action="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/{{ $nam }}/{{ $phuongthuc }}" method="GET">
                        <div class="row form-group">
                            <div class="col-12 col-md-8">
                                <div class="input-group">
                                    <input type="text" class="form-control search" value="{{ $keywords }}" name="q" id="q" placeholder="Nhập từ khóa tìm kiếm CMND hoặc CCCD">
                                    <span class="input-group-btn">
                                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- Search -->
            </div>
        </div>
        @if($danhsach && count($danhsach) > 0)
            @if($phuongthuc == 'diem-thi-nang-khieu-khoi-m')
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered" style="font-size: 15px;">
                            <thead>
                                <tr>
                                    <th>CMND/CCCD</th>
                                    <th>Họ tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Điểm</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhsach as $ds)
                                    <tr>
                                        <td class="text-center">{{ $ds['cmnd'] }}</td>
                                        <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                        <td class="text-center">{{ $ds['ngay_sinh'] }}</td>
                                        <td class="text-center">{{ $ds['diem'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @elseif($phuongthuc == 'ket-qua-tuyen-sinh' || $phuongthuc == 'ket-qua-tuyen-sinh-bs' || $phuongthuc == 'ket-qua-tuyen-sinh-bs2' || $phuongthuc == 'ket-qua-tuyen-sinh-bs3') 
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered" style="font-size: 15px;">
                            <thead>
                                <tr>
                                    <th>Số ĐDCN</th>
                                    <th>Họ tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th>Mã ngành</th>
                                    <th>Tên ngành</th>
                                    <th>Nhóm Tổ hợp môn trúng tuyển</th>
                                    <th>Thứ tự NV trúng tuyển</th>
                                    <th>Điểm trúng tuyển</th>
                                    <th>Phương thức trúng tuyển</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhsach as $ds)
                                    <tr>
                                        <td class="text-center">{{ $ds['cmnd'] }}</td>
                                        <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                        <td class="text-center">{{ $ds['ngay_sinh'] }}</td>
                                        <td class="text-center">{{ $ds['gioi_tinh'] }}</td>
                                        <td class="text-center">{{ $ds['ma_nganh'] }}</td>
                                        <td class="text-center">{{ $ds['ten_nganh'] }}</td>
                                        <td class="text-center">{{ $ds['nhom_to_hop'] }}</td>
                                        <td class="text-center">{{ $ds['thu_tu_nv'] }}</td>
                                        <td class="text-center">{{ str_replace(".",",",$ds['diem']) }}</td>
                                        <td>{{ $ds['phuong_thuc_trung_tuyen'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr />
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="font-size:22px;font-weight:bold;"><i class="uni-megaphone"></i> Thí sinh Trúng tuyển thực hiện các bước sau:</h3>
                            </div>
                            <div class="panel-body">
                                <h5 class="text-success"><strong>Chúc mừng bạn đã trúng tuyển vào Trường Đại học An Giang - Đại học Quốc gia TP. HCM</strong></h5>
                                <h5 class="text-danger">Tân sinh viên cần thực hiện các bước theo hướng dẫn để hoàn thành thủ tục nhập học vào Trường, như sau:</h5>
                                @if($phuongthuc == 'ket-qua-tuyen-sinh')
                                    <h5 style="font-weight:bold;">1. Xác nhận nhập học trên hệ thống Bộ Giáo dục và Đào tạo</h5>
                                    <p>Trước <strong>17 giờ 00 ngày 30/8/2025</strong>, tất cả thí sinh trúng tuyển xác nhận nhập học trực tuyến trên hệ thống của Bộ Giáo dục và Đào tạo: <a href="http://thisinh.thitotnghiepthpt.edu.vn" target="_blank">http://thisinh.thitotnghiepthpt.edu.vn</a>. Đối với những thí sinh "không xác nhận nhập học" trong thời hạn quy định xem như thí sinh từ chối nhập học. Xem hướng dẫn xác nhận nhập học trực tuyến [ <a href="{{ env('APP_URL') }}storage/docs/Huong_dan_xac_nhan_nhap_hoc_2025.pdf" target="_blank"><i class="fa fa-file"></i> <strong>tại đây</strong></a> ].</p>
                                    <h5 style="font-weight:bold;">2. Giấy báo trúng tuyển, giấy báo nhập học và học phí</h5>
                                    <p>In giấy báo trúng tuyển, giấy báo nhập học và hướng dẫn đóng học phí, để chuẩn bị các hồ sơ theo quy định [ <a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/{{ $nam }}/tai-giay-bao/{{ $danhsach[0]['_id'] }}"><strong><i class="fa fa-download"></i> tại đây</strong></a> ].</p>
                                    <h5 style="font-weight:bold;">3. Lý lịch sinh viên</h5>
                                    <p>Nộp trực tuyến tại đây: <a href="https://vnu.app/lylich" target="_blank">https://vnu.app/lylich</a>. Xem hướng dẫn nhập lý lịch [ <a href="https://docs.google.com/document/d/1DsPyiUuDB1Bjwb7nxOEFeuFDraY2V1Rh/edit" target="_blank"><i class="fa fa-file"></i> <strong>tại đây</strong></a> ].</p>
                                    <h5 style="font-weight:bold;">4. Thời gian và địa điểm nộp hồ sơ nhập học</h5>
                                    <h5 style="font-weight:500;">4.1. Thời gian nộp hồ sơ</h5>
                                    <ul>
                                        <li>Ngày 03/9/2025 bao gồm tân sinh viên thuộc các khoa: Kinh tế - Quản trị kinh doanh, Công nghệ thông tin, Kỹ thuật - Công nghệ - Môi trường.</li>
                                        <li>Ngày 04/9/2025 bao gồm tân sinh viên thuộc các khoa: Du lịch và Văn hóa - Nghệ thuật, Nông nghiệp - Tài nguyên thiên nhiên, Ngoại ngữ.</li>
                                        <li>Ngày 05/9/2025 bao gồm tân sinh viên thuộc các khoa: Sư phạm, Luật và Khoa học chính trị.</li>
                                    </ul>
                                    <h5 style="font-weight:500;padding-top:10px;">4.2. Địa điểm nộp hồ sơ</h5>
                                    <ul>
                                        <li>Từ ngày 03/9/2025 đến ngày 05/9/2025 nhận hồ sơ nhập học tại Hội trường 600, Trường Đại học An Giang.</li>
                                        <li>Từ ngày 06/9/2025 trở về sau sinh viên nộp hồ sơ nhập học tại sảnh khu <span style="color:#ff0000;font-weight:bold;">Hiệu bộ Trường Đại học An Giang.</span></li>
                                    </ul>
                                    <p style="color:#ff0000;"><u>Lưu ý:</u> Từ ngày 08/9/2025 trở về sau Nhà trường không nhận hồ sơ vào ngày thứ bảy, chủ nhật và ngày lễ.</p>
                                    <h5 style="font-weight:bold;padding-top:10px;">5. Lịch học sinh hoạt công dân:</h5>
                                    <p>Xem chi tiết tại đây: <a href="https://vnu.app/lich-shcd-dh26" target="">https://vnu.app/lich-shcd-dh26</a></p>
                                @endif
                                @if($phuongthuc == 'ket-qua-tuyen-sinh-bs' || $phuongthuc == 'ket-qua-tuyen-sinh-bs2' || $phuongthuc == 'ket-qua-tuyen-sinh-bs3')
                                    <h5 style="font-weight:bold;">1. Giấy báo trúng tuyển, giấy báo nhập học và học phí</h5>
                                    <p>In giấy báo trúng tuyển, giấy báo nhập học và hướng dẫn đóng học phí, để chuẩn bị các hồ sơ theo quy định [ <a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/{{ $nam }}/tai-giay-bao/{{ $danhsach[0]['_id'] }}"><strong><i class="fa fa-download"></i> tại đây</strong></a> ].</p>
                                    <h5 style="font-weight:bold;">2. Lý lịch sinh viên</h5>
                                    <p>Nộp trực tuyến tại đây: <a href="https://vnu.app/lylich" target="_blank">https://vnu.app/lylich</a>. Xem hướng dẫn nhập lý lịch [ <a href="https://docs.google.com/document/d/1DsPyiUuDB1Bjwb7nxOEFeuFDraY2V1Rh/edit" target="_blank"><i class="fa fa-file"></i> <strong>tại đây</strong></a> ].</p>
                                    <h5 style="font-weight:bold;">3. Thời gian và địa điểm nộp hồ sơ nhập học</h5>
                                    <h5 style="font-weight:500;">3.1. Thời gian nộp hồ sơ</h5>
                                    <ul>
                                        @if($phuongthuc == 'ket-qua-tuyen-sinh-bs')
                                            <li>Đến hết 17 giờ ngày 16/09/2025</li>
                                        @endif
                                        @if($phuongthuc == 'ket-qua-tuyen-sinh-bs2')
                                            <li>Đến hết 17 giờ ngày 02/10/2025</li>
                                        @endif
                                        @if($phuongthuc == 'ket-qua-tuyen-sinh-bs3')
                                            <li>Đến hết 17 giờ ngày 22/10/2025</li>
                                        @endif
                                    </ul>
                                    <h5 style="font-weight:500;padding-top:10px;">3.2. Địa điểm nộp hồ sơ</h5>
                                    <ul>
                                        <li>Sinh viên nộp hồ sơ nhập học tại sảnh <span style="color:#ff0000;font-weight:bold;">Khu Hiệu bộ Trường Đại học An Giang.</span></li>
                                    </ul>
                                    <h5 style="font-weight:bold;padding-top:10px;">4. Lịch học sinh hoạt công dân:</h5>
                                    <p>Xem chi tiết tại đây: <a href="https://vnu.app/lich-shcd-dh26" target="">https://vnu.app/lich-shcd-dh26</a></p>
                                @endif

                                <h5 class="text-danger">Trong quá trình nhập học nếu có khó khăn, bạn vui lòng liên hệ theo các thông tin dưới đây để được hỗ trợ.</h5>
                                <ul>
                                    <li>Hotline Tuyển sinh: <a href="tel:0794.2222.45">0794.2222.45</a> (Thầy Ngọc Anh)</li>
                                    <li>Phòng Đào tạo (Thời khóa biểu): <a href="tel:0949.686.964">0949.686.964</a> (Thầy Vũ)</li>
                                    <li>Phòng Kế hoạch - Tài vụ (học phí):  <a href="tel:0983.204.236">0983.204.236</a> (Cô Tiếp)</li>
                                    <li>Phòng Công tác sinh viên (Kê khai lý lịch sinh viên): <a href="tel:0903.96.05.05">0903.96.05.05</a> (Thầy Danh)</li>
                                    <li>Trạm Y tế: <a href="tel:0901.444.775">0901.444.775</a> (Bác sĩ Ngoan)</li>
                                    <li>Ký túc xá: <a href="tel:0909.11.99.82">0909.11.99.82</a> (Cô Thoa)</li>
                                    <li>Đoàn Thanh niên: <a href="tel:0356.005.040">0356.005.040</a> (Thầy Quốc)</li>
                                    <li>Hồ sơ Đảng: <a href="tel:0987.385.238">0987.385.238</a> (Cô Trinh)</li>
                                    <li>Trung tâm tin học (Email sinh viên): <a href="tel:0919.499.192">0919.499.192</a> (Cô Huế)</li>
                                </ul>
                                <h5 class="text-danger" style="margin-top:10px;">Các website, fanpage tuyển sinh:</h5>
                                <ul>
                                    <li>Website đăng ký học phần (Xem TKB): <a href="https://regis.agu.edu.vn/" target="_blank">https://regis.agu.edu.vn/</a></li>
                                    <li>Website tuyển sinh: <a href="https://www.agu.edu.vn/vi/tuyen-sinh" target="_blank">https://www.agu.edu.vn/vi/tuyen-sinh</a></li>
                                    <li> Fanpage tuyển sinh: <a href="https://www.facebook.com/tuyensinhdhag" target="_blank">https://www.facebook.com/tuyensinhdhag</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($phuongthuc == 'quy-che-tuyen-sinh-bgddt')
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered" style="font-size: 15px;">
                            <thead>
                                <tr>
                                    <th>CMND/CCCD</th>
                                    <th>Họ tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Mã ngành</th>
                                    <th>Tên ngành</th>
                                    <th>Thứ tự nguyện vọng</th>
                                    <th>Đối tượng tuyển thẳng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhsach as $ds)
                                    <tr>
                                        <td class="text-center">{{ $ds['cmnd'] }}</td>
                                        <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                        <td class="text-center">{{ $ds['ngay_sinh'] }}</td>
                                        <td class="text-center">{{ $ds['ma_nganh'] }}</td>
                                        <td class="text-center">{{ $ds['ten_nganh'] }}</td>
                                        <td class="text-center">{{ $ds['thu_tu_nguyen_vong'] }}</td>
                                        <td class="text-center">{{ $ds['doi_tuong_tuyen_thang'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endif
    </div>
</section>

@endsection