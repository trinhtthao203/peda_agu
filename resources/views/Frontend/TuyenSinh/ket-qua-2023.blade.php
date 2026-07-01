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
        font-size: 16px;
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
</style>
@endsection
@section('body')
@php
    if($phuongthuc == 'phuong-thuc-5') $title = 'Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức xét tuyển dựa trên kết quả học tập THPT năm 2023';
    else if($phuongthuc == 'bai-luan-phuong-thuc-5') $title = 'Tra cứu kết quả xét duyệt bài luận áp dụng xét tuyển theo Phương thức 5';
    else if($phuongthuc == 'bai-luan-phuong-thuc-5-bo-sung') $title = 'Tra cứu kết quả xét duyệt bài luận áp dụng xét tuyển theo Phương thức 5 (đợt bổ sung)';
    else if($phuongthuc == 'uu-tien-xet-tuyen') $title = 'Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức Ưu tiên xét tuyển theo quy định của ĐHQG-HCM năm 2023';
    else if($phuongthuc == 'danh-gia-nang-luc') $title = 'Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện dựa trên kết quả thi Đánh giá năng lực của ĐHQG-HCM năm 2023';
    else if($phuongthuc == 'phuong-thuc-1-2') $title = 'Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức Ưu tiên xét tuyển thẳng vào đại học theo quy định ĐHQG–TP.HCM thí sinh giỏi, tài năng của trường THPT năm 2023';
    else if($phuongthuc == 'phuong-thuc-6') $title = 'Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức xét tuyển thẳng đại học hệ chính quy dựa trên các chứng chỉ ngoại ngữ quốc tế năm 2023';
    else if($phuongthuc == 'nang-khieu-khoi-m') $title = 'Tra cứu điểm thi tuyển sinh năng khiếu (Khối M) kỳ thi tuyển sinh đại học năm 2023';
    else if($phuongthuc == 'nang-khieu-khoi-m-bo-sung') $title = 'Tra cứu điểm thi tuyển sinh năng khiếu (Khối M) kỳ thi tuyển sinh đại học năm 2023 (đợt bổ sung)';
    else if($phuongthuc == 'danh-sach-trung-tuyen') $title = 'Tra cứu Kết quả trúng tuyển Đại học hệ chính quy năm 2023';
    else if($phuongthuc == 'danh-sach-trung-tuyen-bo-sung') $title = 'Tra cứu Kết quả trúng tuyển Đại học hệ chính quy năm 2023 (đợt bổ sung)';
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
                                    <input type="text" class="form-control search" value="{{ $keywords }}" name="q" id="q" placeholder="Họ tên hoặc CMND/CCCD">
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
        @if($danhsach)
            @if($phuongthuc == 'bai-luan-phuong-thuc-5' || $phuongthuc == 'bai-luan-phuong-thuc-5-bo-sung')
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th>CMND/CCCD</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                                <th>Ngành đăng ký viết bài luận</th>
                                <th>Kết quả</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td>{{ $ds['ngay_sinh'] }}</td>
                                    <td>{{ $ds['nganh_viet_bai_luan'] }}</td>
                                    <td>{{ $ds['ket_qua'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @if($phuongthuc == 'uu-tien-xet-tuyen')
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th>CMND/CCCD</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                                <th>Giới tính</th>
                                <th>KVUT</th>
                                <th>ĐTUT</th>
                                <th>Thứ tự NV</th>
                                <th>Mã ngành</th>
                                <th>Tên ngành</th>
                                <th>Mã tổ hợp</th>
                                <th>Điểm xét tuyển (không tính UT)</th>
                                <th>Điểm chuẩn</th>
                                <th>Dân tộc</th>
                                <th>Tôn giáo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td>{{ $ds['ngay_sinh'] }}</td>
                                    <td>{{ $ds['gioi_tinh']}}</td>
                                    <td class="text-center">{{ $ds['kv_ut']}}</td>
                                    <td class="text-center">{{ $ds['dt_ut']}}</td>
                                    <td class="text-center">{{ $ds['thu_tu_nv']}}</td>
                                    <td class="text-center">{{ $ds['ma_nganh']}}</td>
                                    <td class="text-center">{{ $ds['ten_nganh']}}</td>
                                    <td class="text-center">{{ $ds['ma_to_hop']}}</td>
                                    <td class="text-center">{{ $ds['diem_xet_tuyen']}}</td>
                                    <td class="text-center">{{ $ds['diem_chuan']}}</td>
                                    <td class="text-center">{{ $ds['dan_toc']}}</td>
                                    <td class="text-center">{{ $ds['ton_giao']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Danh sách tra cứu là <b>"DANH SÁCH TRÚNG TUYỂN CÓ ĐIỀU KIỆN".</b></h3>
						</div>
						<div class="panel-body">
							<ul>
                                <li>Thí sinh chỉ trúng tuyển khi tra cứu được kết quả trên trang web của nhà trường. Trong trường hợp thí sinh có điểm cao hơn hoặc bằng điểm chuẩn nhưng vẫn không đủ điều kiện trúng tuyển thì có nghĩa là thí sinh đã đậu một nguyện vọng có thứ tự ưu tiên cao hơn.</li>
                                <li> Đối với phương thức Ưu tiên xét tuyển (UTXT) theo quy định của ĐHQG-HCM, điểm chuẩn ngành Giáo dục Mầm non chưa tính điểm thi năng khiếu.</li>
                                <li>Đối với phương thức xét tuyển dựa trên kết quả kỳ thi ĐGNL ĐHQG-HCM 2023, điểm chuẩn trúng tuyển là điểm thi ĐGNL chưa bao gồm điểm ưu tiên.</li>
                                <li>Phương thức xét tuyển dựa trên kết quả thi Đánh giá năng lực ĐHQG HCM năm 2023, điểm chuẩn đối với ngành Giáo dục Mầm non chưa tính điểm thi Năng khiếu.</li>
                            </ul>
						</div>
					</div>
                    <div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title"><b>Một số thông tin cần lưu ý:</b></h3>
						</div>
						<div class="panel-body">
							<ol>
                                <li>Đối với các thí sinh trúng tuyển vào các ngành đào tạo giáo viên (Sư phạm): Thí sinh cần đạt yêu cầu ngưỡng ĐBCL đầu vào: Học lực lớp 12 xếp loại từ giỏi trở lên hoặc điểm xét tốt nghiệp THPT từ 8,0 trở lên. Nếu thí sinh không đáp ứng được một trong hai điều kiện trên nhà trường sẽ tự loại bỏ kết quả trúng tuyển có điều kiện này khi đưa lên hệ thống xét tuyển chung của Bộ Giáo dục và Đào tạo.</li>
                                <li>Các thí sinh đã được công bố "trúng tuyển có điều kiện" theo phương thức ưu tiên xét tuyển/đánh giá năng lực (hay bất kỳ phương thức xét tuyển sớm nào khác) thì phải đăng ký lại nguyện vọng này tại cổng đăng ký tuyển sinh của Bộ GD-ĐT từ ngày 10/7 đến trước 17 giờ ngày 30/7/2023.</li>
                                <li>Nếu thí sinh quyết định sẽ nhập học bằng kết quả trúng tuyển này thì chỉ cần ghi duy nhất một nguyện vọng đó vào danh sách nguyện vọng. Trong trường hợp khác, thí sinh có thể sắp xếp các nguyện vọng, bao gồm cả nguyện vọng trúng tuyển sớm, theo thứ tự ưu tiên mong muốn. Nếu không đăng ký lại trên cổng của Bộ, đồng nghĩa với việc thí sinh không dùng kết quả này.</li>
                            </ol>
						</div>
					</div>
                </div>
            </div>
            @endif
            @if($phuongthuc == 'danh-gia-nang-luc')
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th>CMND/CCCD</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                                <th>Giới tính</th>
                                <th>KVUT</th>
                                <th>ĐTUT</th>
                                <th>Thứ tự NV</th>
                                <th>Mã ngành</th>
                                <th>Tên ngành</th>
                                <th>Điểm thi ĐGNL</th>
                                <th>Điểm chuẩn</th>
                                <th>Dân tộc</th>
                                <th>Tôn giáo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td>{{ $ds['ngay_sinh'] }}</td>
                                    <td class="text-center">{{ $ds['gioi_tinh']}}</td>
                                    <td class="text-center">{{ $ds['kv_ut']}}</td>
                                    <td class="text-center">{{ $ds['dt_ut']}}</td>
                                    <td class="text-center">{{ $ds['thu_tu_nv']}}</td>
                                    <td class="text-center">{{ $ds['ma_nganh']}}</td>
                                    <td class="text-center">{{ $ds['ten_nganh']}}</td>
                                    <td class="text-center">{{ $ds['diem_thi_dgnl']}}</td>
                                    <td class="text-center">{{ $ds['diem_chuan']}}</td>
                                    <td class="text-center">{{ $ds['dan_toc']}}</td>
                                    <td class="text-center">{{ $ds['ton_giao']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Danh sách tra cứu là <b>"DANH SÁCH TRÚNG TUYỂN CÓ ĐIỀU KIỆN".</b></h3>
						</div>
						<div class="panel-body">
							<ul>
                                <li>Thí sinh chỉ trúng tuyển khi tra cứu được kết quả trên trang web của nhà trường. Trong trường hợp thí sinh có điểm cao hơn hoặc bằng điểm chuẩn nhưng vẫn không đủ điều kiện trúng tuyển thì có nghĩa là thí sinh đã đậu một nguyện vọng có thứ tự ưu tiên cao hơn.</li>
                                <li> Đối với phương thức Ưu tiên xét tuyển (UTXT) theo quy định của ĐHQG-HCM, điểm chuẩn ngành Giáo dục Mầm non chưa tính điểm thi năng khiếu.</li>
                                <li>Đối với phương thức xét tuyển dựa trên kết quả kỳ thi ĐGNL ĐHQG-HCM 2023, điểm chuẩn trúng tuyển là điểm thi ĐGNL chưa bao gồm điểm ưu tiên.</li>
                                <li>Phương thức xét tuyển dựa trên kết quả thi Đánh giá năng lực ĐHQG HCM năm 2023, điểm chuẩn đối với ngành Giáo dục Mầm non chưa tính điểm thi Năng khiếu.</li>
                            </ul>
						</div>
					</div>
                    <div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title"><b>Một số thông tin cần lưu ý:</b></h3>
						</div>
						<div class="panel-body">
							<ol>
                                <li>Đối với các thí sinh trúng tuyển vào các ngành đào tạo giáo viên (Sư phạm): Thí sinh cần đạt yêu cầu ngưỡng ĐBCL đầu vào: Học lực lớp 12 xếp loại từ giỏi trở lên hoặc điểm xét tốt nghiệp THPT từ 8,0 trở lên. Nếu thí sinh không đáp ứng được một trong hai điều kiện trên nhà trường sẽ tự loại bỏ kết quả trúng tuyển có điều kiện này khi đưa lên hệ thống xét tuyển chung của Bộ Giáo dục và Đào tạo.</li>
                                <li>Các thí sinh đã được công bố "trúng tuyển có điều kiện" theo phương thức ưu tiên xét tuyển/đánh giá năng lực (hay bất kỳ phương thức xét tuyển sớm nào khác) thì phải đăng ký lại nguyện vọng này tại cổng đăng ký tuyển sinh của Bộ GD-ĐT từ ngày 10/7 đến trước 17 giờ ngày 30/7/2023.</li>
                                <li>Nếu thí sinh quyết định sẽ nhập học bằng kết quả trúng tuyển này thì chỉ cần ghi duy nhất một nguyện vọng đó vào danh sách nguyện vọng. Trong trường hợp khác, thí sinh có thể sắp xếp các nguyện vọng, bao gồm cả nguyện vọng trúng tuyển sớm, theo thứ tự ưu tiên mong muốn. Nếu không đăng ký lại trên cổng của Bộ, đồng nghĩa với việc thí sinh không dùng kết quả này.</li>
                            </ol>
						</div>
					</div>
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
                                <th>Giới tính</th>
                                <th>KVUT</th>
                                <th>Mã ngành</th>
                                <th>Tên ngành</th>
                                <th>STT NV</th>
                                <th>Tổ hợp</th>
                                <th>Điểm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td class="text-center">{{ $ds['ngay_sinh'] }}</td>
                                    <td class="text-center">{{ $ds['gioi_tinh']}}</td>
                                    <td class="text-center">{{ $ds['kv_ut']}}</td>
                                    <td class="text-center">{{ $ds['ma_nganh']}}</td>
                                    <td class="text-center">{{ $ds['ten_nganh']}}</td>
                                    <td class="text-center">{{ $ds['stt_nv']}}</td>
                                    <td class="text-center">{{ $ds['to_hop']}}</td>
                                    <td class="text-center">{{ $ds['diem']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if($phuongthuc == 'phuong-thuc-6')
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th>CMND/CCCD</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                                <th>Giới tính</th>
                                <th>Mã ngành</th>
                                <th>Tên ngành</th>
                                <th>STT NV</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td class="text-center">{{ $ds['ngay_sinh'] }}</td>
                                    <td class="text-center">{{ $ds['gioi_tinh']}}</td>
                                    <td class="text-center">{{ $ds['ma_nganh']}}</td>
                                    <td class="text-center">{{ $ds['ten_nganh']}}</td>
                                    <td class="text-center">{{ $ds['stt_nv']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @if($phuongthuc == 'phuong-thuc-5')
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th>CMND/CCCD</th>
                                <th>Họ tên</th>
                                <th>Giới tính</th>
                                <th>Dân tộc</th>
                                <th>KVUT</th>
                                <th>ĐTUT</th>
                                <th>Thứ tự NV</th>
                                <th>Mã ngành</th>
                                <th>Tên ngành</th>
                                <th>Mã tổ hợp</th>
                                <th>Điểm xét tuyển</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td class="text-center">{{ $ds['gioi_tinh']}}</td>
                                    <td class="text-center">{{ $ds['dan_toc'] }}</td>
                                    <td class="text-center">{{ $ds['kv_ut'] }}</td>
                                    <td class="text-center">{{ $ds['dt_ut'] }}</td>
                                    <td class="text-center">{{ $ds['stt_nv'] }}</td>
                                    <td class="text-center">{{ $ds['ma_nganh']}}</td>
                                    <td class="text-center">{{ $ds['ten_nganh']}}</td>
                                    <td class="text-center">{{ $ds['to_hop']}}</td>
                                    <td class="text-center">{{ $ds['diem']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if($phuongthuc == 'nang-khieu-khoi-m' || $phuongthuc == 'nang-khieu-khoi-m-bo-sung')
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th>CMND/CCCD</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                                <th>Mã môn NK</th>
                                <th>Điểm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td class="text-center">{{ $ds['ngay_sinh'] }}</td>
                                    <td class="text-center">{{ $ds['ma_mon_nk']}}</td>
                                    <td class="text-center">{{ $ds['diem']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            
            @if($phuongthuc == 'danh-sach-trung-tuyen' || $phuongthuc == 'danh-sach-trung-tuyen-bo-sung')
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th>CMND/CCCD</th>
                                <th>Họ tên</th>
                                <th>Ngày sinh</th>
                                <th>Đối tượng</th>
                                <th>Khu vực</th>
                                <th>Mã ngành</th>
                                <th>Tên ngành</th>
                                <th>Thứ tự nguyện vọng</th>
                                <th>Điểm trúng tuyển</th>
                                <th>Tổ hợp</th>
                                <th>Phương thức trúng tuyển</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhsach as $ds)
                                <tr>
                                    <td class="text-center">{{ $ds['cmnd'] }}</td>
                                    <td class="nowrap">{{ $ds['ho_ten'] }}</td>
                                    <td class="nowrap">{{ $ds['ngay_sinh'] }}</td>
                                    <td class="text-center">{{ $ds['doi_tuong'] }}</td>
                                    <td class="text-center">{{ $ds['khu_vuc']}}</td>
                                    <td class="text-center">{{ $ds['ma_nganh']}}</td>
                                    <td class="text-center">{{ $ds['ten_nganh']}}</td>
                                    <td class="text-center">{{ $ds['thu_tu_nguyen_vong']}}</td>
                                    <td class="text-center">{{ $ds['diem_trung_tuyen']}}</td>
                                    <td class="text-center">{{ $ds['to_hop']}}</td>
                                    <td>{{ $ds['phuong_thuc_trung_tuyen']}}</td>
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