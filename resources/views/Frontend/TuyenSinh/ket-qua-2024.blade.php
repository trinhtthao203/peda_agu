@extends('Frontend.TuyenSinh.layout')
@section('title', 'Tra cứu Kết quả tuyển sinh năm 2024')
@section('css')
<style>
    #SearchForm input,  #SearchForm select{
        font-size: 18px;
    }
    ul {
        list-style-type: square !important;
        margin-left: 40px;
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
</style>
@endsection
@section('body')
@php
    if($phuongthuc == 'phuong-thuc-5') $title = 'Tra cứu kết quả xét duyệt bài luận áp dụng xét tuyển theo Phương thức 5 năm 2024';
    else if($phuongthuc == 'ket-qua-tuyen-sinh')  $title = 'Kết quả trúng tuyển Đại học Chính Quy năm 2024';
    else if($phuongthuc == 'ket-qua-tuyen-sinh-bs')  $title = 'Kết quả trúng tuyển Đại học Chính Quy năm 2024 (đợt bổ sung)';
    else if($phuongthuc == 'ket-qua-tuyen-sinh-bs2')  $title = 'Kết quả trúng tuyển Đại học Chính Quy năm 2024 (bổ sung đợt 2)';
    else if($phuongthuc == 'phuong-thuc-1-2') $title = 'Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo phương thức Ưu tiên xét tuyển thẳng theo quy định ĐHQG-HCM thí sinh giỏi, tài năng của trường THPT (phương thức 1.2) năm 2024';
    else if($phuongthuc == 'tra-cuu-ho-so-phuong-thuc-5') $title = 'Tra cứu hồ sơ đăng ký xét tuyển đại học theo phương thức 5';
    else if($phuongthuc == 'ket-qua-trung-tuyen-dua-theo-danh-gia-nang-luc') $title = 'Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện dựa trên kết quả thi Đánh giá năng lực của ĐHQG-HCM năm 2024';
    else if($phuongthuc == 'ket-qua-trung-tuyen-ưu-tien-danh-gia-nang-luc') $title = 'Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức Ưu tiên xét tuyển theo quy định của ĐHQG-HCM năm 2024';
    else if($phuongthuc == 'ket-qua-trung-tuyen-phuong-thuc-5') $title = 'Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức xét tuyển dựa trên kết quả học tập THPT (Phương thức 5) năm 2024';
    else if($phuongthuc == 'ket-qua-trung-tuyen-phuong-thuc-6') $title = 'Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức xét tuyển thẳng đại học hình thức chính quy dựa trên các chứng chỉ ngoại ngữ quốc tế (Phương thức 6)';
    else if($phuongthuc == 'diem-thi-nang-khieu-khoi-m') $title='Tra cứu điểm thi tuyển sinh năng khiếu (Khối M) kỳ thi tuyển sinh đại học năm 2024';
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
            @if($phuongthuc == 'phuong-thuc-5')
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered" style="font-size: 15px;">
                            <thead>
                                <tr>
                                    <th>CMND/CCCD</th>
                                    <th>Họ tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Ngành đăng ký viết Bài luận</th>
                                    <th>Kết quả xét duyệt Bài luận</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhsach as $ds)
                                    <tr>
                                        <td class="text-center">{{ $ds['cmnd'] }}</td>
                                        <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                        <td class="text-center">{{ $ds['ngay_sinh'] }}</td>
                                        <td class="text-center">{{ $ds['nganh_dang_ky'] }}</td>
                                        <td class="text-center">{{ $ds['ket_qua'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @elseif($phuongthuc == 'ket-qua-tuyen-sinh' || $phuongthuc == 'ket-qua-tuyen-sinh-bs' || $phuongthuc == 'ket-qua-tuyen-sinh-bs2') 
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered" style="font-size: 15px;">
                            <thead>
                                <tr>
                                    <th>CMND/CCCD</th>
                                    <th>HỌ VÀ TÊN</th>
                                    <th>NGÀY SINH</th>
                                    <th>MÃ NGÀNH</th>
                                    <th>TÊN NGÀNH</th>
                                    <th>THỨ TỰ NGUYỆN VỌNG</th>
                                    <th>ĐIỂM TRÚNG TUYỂN</th>
                                    <th>TỔ HỢP</th>
                                    <th>PHƯƠNG THỨC TRÚNG TUYỂN</th>
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
                                        <td class="text-right">{{ $ds['thu_tu_nguyen_vong'] }}</td>
                                        <td class="text-right">{{ $ds['diem_trung_tuyen'] }}</td>
                                        <td class="text-center">{{ $ds['to_hop'] }}</td>
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
                                <h5 class="text-success"><strong>Chúc mừng bạn đã trúng tuyển vào của Trường Đại học An Giang - Đại học Quốc gia TP. HCM</strong></h5>
                                <h5 class="text-danger">Bạn vui lòng thực hiện các bước theo hướng dẫn để chuẩn bị thủ tục nhập học.</h5>
                                @if($phuongthuc == 'ket-qua-tuyen-sinh')
                                <ol>
                                    <li>Xác nhận nhập học: Từ ngày <strong>19/08/2024</strong>, tất cả thí sinh trúng tuyển xác nhận nhập học trực tuyến trên hệ thống của Bộ Giáo dục và Đào tạo: <a href="http://thisinh.thitotnghiepthpt.edu.vn" target="_blank">http://thisinh.thitotnghiepthpt.edu.vn</a>. [ Xem hướng dẫn nhập học trực tuyến: <a href="{{ env('APP_URL') }}storage/docs/HDSD - Thi sinh Xac nhan nhap hoc T4.2024.pdf" target="_blank"><i class="fa fa-file"></i> <strong>tại đây</strong></a> ]</li>
                                    <li>In giấy báo trúng tuyển và giấy báo nhập học để chuẩn bị các hồ sơ theo quy định <a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2024/tai-giay-bao/{{ $danhsach[0]['_id'] }}"><strong><i class="fa fa-download"></i> tại đây</strong></a></li>
                                    <li>Nhập lý lịch sinh viên trực tuyến tại đây: <a href="https://vnu.app/lylich" target="_blank">https://vnu.app/lylich</a>. [Xem hướng dẫn nhập lý lịch: <a href="https://docs.google.com/document/d/1DsPyiUuDB1Bjwb7nxOEFeuFDraY2V1Rh/edit" target="_blank"><i class="fa fa-file"></i> <strong>tại đây</strong></a>]</li>
                                    <li>Nộp hồ sơ nhập học:</li>
                                    <ul>
                                        <li>Thời gian nộp hồ sơ:</li>
                                        <ul>
                                            <li><strong>20/08/2024</strong> bao gồm tân sinh viên thuộc các khoa: Kinh tế - Quản trị kinh doanh, Công nghệ thông tin, Kỹ thuật - Công nghệ - Môi trường.</li>
                                            <li><strong>21/08/2024</strong> bao gồm tân sinh viên thuộc các khoa: Du lịch & VH-NT, Nông nghiệp – TNTN, Ngoại ngữ.</li>
                                            <li><strong>22/08/2024</strong> bao gồm tân sinh viên thuộc các khoa: Sư phạm, Luật & KHCT.</li>
                                        </ul>
                                        <li><strong><u>Lưu ý:</u> Nhà trường không nhận hồ sơ vào ngày thứ bảy, chủ nhật, ngày lễ.</strong></li>
                                        <li>Địa điểm nộp hồ sơ</li>
                                        <ul>
                                            <li>Từ ngày <strong>20-22/08/2024</strong> nhận hồ sơ nhập học tại Hội trường 600 Trường Đại học An Giang.</li>
                                            <li>Từ ngày <strong>23/08/2024</strong> trở về sau sinh viên nộp hồ sơ nhập học tại sảnh khu Hiệu bộ Trường Đại học An Giang.</li>
                                        </ul>
                                    </ul>
                                    <li>Lịch học sinh hoạt công dân: <a href="https://vnu.app/lich-hoc-shcd-dh25" target="_blank">https://vnu.app/lich-hoc-shcd-dh25</a></li>
                                </ol>
                                @endif
                                @if($phuongthuc == 'ket-qua-tuyen-sinh-bs' || $phuongthuc == 'ket-qua-tuyen-sinh-bs2')
                                <ol>
                                    <li>In giấy báo trúng tuyển và giấy báo nhập học để chuẩn bị các hồ sơ theo quy định <a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2024/tai-giay-bao/{{ $danhsach[0]['_id'] }}"><strong><i class="fa fa-download"></i> tại đây</strong></a></li>
                                    <li>Nhập lý lịch sinh viên trực tuyến tại đây: <a href="https://vnu.app/lylich" target="_blank">https://vnu.app/lylich</a>. [Xem hướng dẫn nhập lý lịch: <a href="https://docs.google.com/document/d/1DsPyiUuDB1Bjwb7nxOEFeuFDraY2V1Rh/edit" target="_blank"><i class="fa fa-file"></i> <strong>tại đây</strong></a>]</li>
                                    <li>Nộp hồ sơ nhập học:</li>
                                    <ul>
                                        <li>Thời gian nộp hồ sơ: từ ngày 23/09/2024 đến 27/09/2024</li>
                                        <li>Địa điểm nộp hồ sơ: Phòng Đào tạo 01</li>
                                    </ul>
                                    <li>Lịch học sinh hoạt công dân: <a href="https://vnu.app/lich-hoc-shcd-dh25" target="_blank">https://vnu.app/lich-hoc-shcd-dh25</a></li>
                                </ol>
                                @endif
                                <h5 class="text-danger">Trong quá trình nhập học nếu có khó khăn, bạn vui lòng liên hệ theo các thông tin dưới đây để được hỗ trợ nhé.</h5>
                                <ul>
                                    <li> Hotline Tuyển sinh: <a href="tel:0794.2222.45">0794.2222.45</a> (Thầy Ngọc Anh)</li>
                                    <li>Phòng Đào tạo (Thời khóa biểu): 02966.253572 (Thầy Vũ)</li>
                                    <li>Phòng Công tác sinh viên (Kê khai lý lịch sinh viên): <a href="tel:0903.96.05.05">0903.96.05.05</a> (Thầy Danh)</li>
                                    <li>Trạm Y tế: <a href="tel:0901.444.775">0901.444.775</a> (BS Ngoan)</li>
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
            @elseif($phuongthuc == 'tra-cuu-ho-so-phuong-thuc-5')
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th>CMND/CCCD</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                                <th>KVUT</th>
                                <th>Nguyện vọng 1</th>
                                <th>Điểm NV1</th>
                                <th>Nguyện vọng 2</th>
                                <th>Điểm NV2</th>
                                <th>Nguyện vọng 3</th>
                                <th>Điểm NV3</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td class="text-center">{{ $ds['ngay_sinh'] }}</td>
                                    <td class="text-center">{{ $ds['kvut'] }}</td>
                                    <td class="text-center">{{ $ds['nguyen_vong_1'] }}</td>
                                    <td class="text-center">{{ $ds['diem_nv1'] }}</td>
                                    <td class="text-center">{{ $ds['nguyen_vong_2'] }}</td>
                                    <td class="text-center">{{ $ds['diem_nv2'] }}</td>
                                    <td class="text-center">{{ $ds['nguyen_vong_3'] }}</td>
                                    <td class="text-center">{{ $ds['diem_nv3'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if($phuongthuc == 'ket-qua-trung-tuyen-dua-theo-danh-gia-nang-luc')
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th>CMND/CCCD</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                                <th>Mã ngành</th>
                                <th>Ngành trúng tuyển</th>
                                <th>Điểm thi ĐGNL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td class="text-center">{{ $ds['ngay_sinh'] }}</td>
                                    <td class="text-center">{{ $ds['ma_nganh'] }}</td>
                                    <td class="text-center">{{ $ds['nganh_trung_tuyen'] }}</td>
                                    <td class="text-center">{{ $ds['diem_thi'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @if($phuongthuc == 'ket-qua-trung-tuyen-ưu-tien-danh-gia-nang-luc')
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th>CMND/CCCD</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                                <th>Mã ngành</th>
                                <th>Ngành trúng tuyển</th>
                                <th>Mã tổ hợp</th>
                                <th>Điểm xét tuyển (không tính UT)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td class="text-center">{{ $ds['ngay_sinh'] }}</td>
                                    <td class="text-center">{{ $ds['ma_nganh'] }}</td>
                                    <td class="text-center">{{ $ds['nganh_trung_tuyen'] }}</td>
                                    <td class="text-center">{{ $ds['ma_to_hop'] }}</td>
                                    <td class="text-center">{{ $ds['diem'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @if($phuongthuc == 'phuong-thuc-1-2')
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th>CMND/CCCD</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                                <th>Mã ngành</th>
                                <th>Ngành trúng tuyển</th>
                                <th>STT nguyện vọng</th>
                                <th>Mã tổ hợp</th>
                                <th>Điểm xét tuyển (không tính UT)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td class="text-center">{{ $ds['ngay_sinh'] }}</td>
                                    <td class="text-center">{{ $ds['ma_nganh'] }}</td>
                                    <td class="text-center">{{ $ds['nganh_trung_tuyen'] }}</td>
                                    <td class="text-center">{{ $ds['stt_nv'] }}</td>
                                    <td class="text-center">{{ $ds['ma_to_hop'] }}</td>
                                    <td class="text-center">{{ $ds['diem'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @if($phuongthuc == 'ket-qua-trung-tuyen-phuong-thuc-5')
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th>CMND/CCCD</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                                <th>Mã ngành</th>
                                <th>Ngành trúng tuyển</th>
                                <th>STT nguyện vọng</th>
                                <th>Mã tổ hợp</th>
                                <th>Điểm xét tuyển</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td class="text-center">{{ $ds['ngay_sinh'] }}</td>
                                    <td class="text-center">{{ $ds['ma_nganh'] }}</td>
                                    <td class="text-center">{{ $ds['nganh_trung_tuyen'] }}</td>
                                    <td class="text-center">{{ $ds['stt_nv'] }}</td>
                                    <td class="text-center">{{ $ds['ma_to_hop'] }}</td>
                                    <td class="text-center">{{ $ds['diem'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @if($phuongthuc == 'ket-qua-trung-tuyen-phuong-thuc-6')
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th>CMND/CCCD</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                                <th>Mã ngành</th>
                                <th>Ngành trúng tuyển</th>
                                <th>STT nguyện vọng</th>
                                <th>Năng lực Ngoại ngữ</th>
                                <th>Giá trị</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td class="text-center">{{ $ds['ngay_sinh'] }}</td>
                                    <td class="text-center">{{ $ds['ma_nganh'] }}</td>
                                    <td class="text-center">{{ $ds['nganh_trung_tuyen'] }}</td>
                                    <td class="text-center">{{ $ds['stt_nv'] }}</td>
                                    <td class="text-center">{{ $ds['nang_luc_ngoai_ngu'] }}</td>
                                    <td class="text-center">{{ $ds['gia_tri'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

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
            @endif

        @else
            @if(!$keywords)
            <div class="alert alert-danger">
                <h4><i class="fa fa-search"></i> Vui lòng nhập từ khóa tìm kiếm (Số CMND hoặc CCCD). </h4>
            </div>
            @else
            <div class="alert alert-danger">
                <h4><i class="fa fa-search"></i> Không tìm thấy.</h4>
            </div>
            @endif
        @endif
    </div>
</section>
@endsection