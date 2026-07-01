@extends('Frontend.layout')
@section('title', __('Giới thiệu - Hội đồng trường'))
@section('body')
@php
    $arr_danhsach = array(
        array(1,'Trần Văn Đạt','Bí thư Đảng ủy','Chủ tịch'),
        array(2,'Võ Văn Thắng','Nguyên Hiệu trưởng, Giảng viên Khoa Luật và Khoa học chính trị','Phó Chủ tịch'),
        array(3,'Trần Lê Đăng Phương','Trưởng khoa Khoa Luật và Khoa học chính trị','Thư ký'),
        array(4,'Đoàn Văn An','Giám đốc Ngân hàng TMCP Xuất nhập khẩu Việt Nam - Chi nhánh An Giang','Thành viên'),
        array(5, 'Tầng Phú An', 'Nguyên Giám đốc Sở Khoa học và Công nghệ tỉnh An Giang', 'Thành viên'),
        array(6,'Hồ Thanh Bình','Phó Giám đốc Sở Nông nghiệp và Môi trường tỉnh An Giang','Thành viên'),
        array(7,'Lê Quốc Cường','Phó Giám đốc Sở Khoa học và Công nghệ tỉnh An Giang','Thành viên'),
        array(8,'Trần Thị Ngọc Diễm','Nguyên Giám đốc Sở Giáo dục và Đào tạo tỉnh An Giang; Bí thư phường Bình Đức, tỉnh An Giang','Thành viên'),
        array(9, 'Hà Trọng Điệp', 'Chủ tịch  Hội đồng quản trị kiêm Tổng Giám đốc, Công ty Cổ phần bất động sản Ngọc Viễn Đông', 'Thành viên'),
        array(10, 'Dương Phương Đông','Phó Trưởng khoa Khoa Du lịch và Văn hóa - Nghệ thuật','Thành viên'),
        array(11, 'Trần Quang Hiền', 'Giám đốc Sở Y tế tỉnh An Giang', 'Thành viên'),
        array(12, 'Nguyễn Thị Thanh Loan', 'Trưởng phòng Phòng Công tác sinh viên', 'Thành viên'),
        array(13,'Đoàn Thanh Nghị','Trưởng khoa Khoa Công nghệ thông tin kiêm Giám đốc Trung tâm Tin học','Thành viên'),
        array(14,'Hồ Nhã Phong','Trưởng phòng Tổ chức - Chính trị kiêm Trưởng phòng Phòng Khảo thí và Đảm bảo chất lượng','Thành viên'),
        array(15,'Lê Văn Phước','UV BTV Tỉnh ủy, Phó Chủ tịch Uỷ ban nhân dân tỉnh An Giang','Thành viên'),
        array(16,'Vũ Hải Quân','UV BCH Trung ương Đảng, Nguyên Giám đốc Đại học Quốc gia TP.HCM, Thứ trưởng thường trực Bộ Khoa học và Công nghệ','Thành viên'),
        array(17,'Nguyễn Trần Nhẫn Tánh','Viện trưởng Viện Biến đổi Khí hậu kiêm Trưởng khoa Khoa KT-CN-MT','Thành viên'),
        array(18, 'Nguyễn Trung Thành', 'Trưởng phòng Phòng Khoa học và Công nghệ', 'Thành viên'),
        array(19,'Nguyễn Phương Thảo','Phó Hiệu trưởng kiêm Trưởng khoa Khoa Sư phạm','Thành viên'),
        array(20,'Nguyễn Thị Ngọc Thơ','Hiệu trưởng Trường Phổ thông Thực hành Sư phạm','Thành viên'),
        array(21,'Huỳnh Văn Thòn','Chủ tịch Hội đồng quản trị Tập đoàn Lộc Trời','Thành viên'),
        array(22,'Đổ Thị Cẩm Tiên','Nguyên UV BCH Đoàn Trường Đại học An Giang','Thành viên'),
        array(23,'Phan Minh Trí','Chủ tịch Công đoàn Trường Đại học An Giang','Thành viên'),
        array(24,'Nguyễn Hữu Trí','Phó Hiệu trưởng kiêm Trưởng phòng Phòng Quan hệ đối ngoại','Thành viên'),
        array(25,'Phạm Huỳnh Thanh Vân','Phó Trưởng khoa Khoa Nông nghiệp - Tài nguyên thiên nhiên','Thành viên')
    );
    $bankiemsoat = array(
        array(1,'ThS Hồ Nhã Phong','Trưởng ban'),
        array(2,'TS Trần Lê Đăng Phương','Thành viên'),
        array(3,'ThS Lê Quốc Cường','Thành viên'),
        array(4,'TS Phạm Huỳnh Thanh Vân','Thành viên'),
        array(5,'ThS Nguyễn Thị Thanh Loan','Thành viên')
    );
    $banchienluoc = array(
        array(1,'TS Nguyễn Trần Nhẫn Tánh','Trưởng ban'),
        array(2,'PGS,TS Vũ Hải Quân','Thành viên'),
        array(3,'Ông Lê Văn Phước','Thành viên'),
        array(4,'PGS,TS Trần Văn Đạt','Thành viên'),
        array(5,'PGS,TS Võ Văn Thắng','Thành viên'),
        array(6,'PGS,TS Hồ Thanh Bình','Thành viên')
    );
    $banchuyenmon = array(
        array(1,'PGS,TS Nguyễn Trung Thành','Trưởng ban'),
        array(2,'ThS Phan Minh Trí','Thành viên'),
        array(3,'TS Nguyễn Hữu Trí','Thành viên'),
        array(4,'PGS, TS Đoàn Thanh Nghị','Thành viên'),
        array(5,'ThS Nguyễn Thị Ngọc Thơ','Thành viên')
    );
@endphp
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Hội đồng trường</h4>
            <p class="text-justify">Hội đồng trường Trường Đại học An Giang được thành lập ngày 27/8/2020 gồm 25 thành viên, trong đó có Chủ tịch, Phó Chủ tịch, Thư ký và các thành viên đại diện cho giảng viên, viên chức, người lao động và người học; nhà khoa học, nhà doanh nghiệp và đại diện cho công đồng xã hội.</p>
            <p class="text-justify">Với những thành phần ưu tú, tâm huyết, đại diện cho giảng viên, viên chức, người lao động và cộng đồng xã hội, Hội đồng trường sẽ tích cực phát huy vai trò, năng lực và đề ra những định hướng mới, phù hợp, góp phần vào sự phát triển của Trường Đại học An Giang trong tương lai.</p>
            <p class="text-center">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/hoi-dong-truong-2020-2025.jpg" alt="Trường Đại học An Giang" align="center" style="max-width:100%;">
            </p>
            <br />
            <h5 class="text-center"><b>DANH SÁCH THÀNH VIÊN HỘI ĐỒNG TRƯỜNG</b></h5>
            <br />
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>HỌ TÊN</th>
                        <th>ĐƠN VỊ</th>
                        <th>CHỨC DANH</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($arr_danhsach as $ds)
                    <tr>
                        <td class="text-center">{{ $ds[0] }}</td>
                        <td>{{ $ds[1] }}</td>
                        <td>{{ $ds[2] }}</td>
                        <td class="text-center">{{ $ds[3] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <h5 class="text-center"><b>DANH SÁCH CÁC BAN THUỘC HỘI ĐỒNG TRƯỜNG</b></h5>
            <h6><b>I. BAN KIỂM SOÁT</b></h6>
            <table class="table table-bordered table-striped">
                @foreach($bankiemsoat as $bks)
                    <tr>
                        <td class="text-center">{{ $bks[0] }}</td>
                        <td>{{ $bks[1] }}</td>
                        <td class="text-center">{{ $bks[2] }}</td>
                    </tr>
                @endforeach
            </table>
            <h6><b>II. BAN CHIẾN LƯỢC</b></h6>
            <table class="table table-bordered table-striped">
                @foreach($banchienluoc as $bcl)
                    <tr>
                        <td class="text-center">{{ $bcl[0] }}</td>
                        <td>{{ $bcl[1] }}</td>
                        <td class="text-center">{{ $bcl[2] }}</td>
                    </tr>
                @endforeach
            </table>
            <h6><b>III. BAN CHUYÊN MÔN</b></h6>
            <table class="table table-bordered table-striped">
                @foreach($banchuyenmon as $bcm)
                    <tr>
                        <td class="text-center">{{ $bcm[0] }}</td>
                        <td>{{ $bcm[1] }}</td>
                        <td class="text-center">{{ $bcm[2] }}</td>
                    </tr>
                @endforeach
            </table>
            @php
                $nghi_quyet = array(
                    array('title' => '120_NQ-HĐT Nghị quyết kỳ họp Hội đồng trường Trường ĐHAG lần thứ 14', 'file' => '120_NQ-HĐT.pdf'),
                    array('title' => '122_NQ-HĐT Quy định về phân quyền tự chủ và trách nhiệm giải trình đối với đơn vị, tổ chức, cá nhân tại Trường ĐHAG', 'file' => '122_NQ-HĐT.pdf'),
                    array('title' => '123_NQ-HĐT Bảng mô tả công việc và khung năng lực đối với từng vị trí việc làm của Trường ĐHAG', 'file' => '123_NQ-HĐT.pdf'),
                    array('title' => '126_NQ-HĐT Nghi quyết Hội nghị HĐT bổ nhiệm Phó Hiệu trưởng', 'file' => '126_NQ-HĐT.pdf'),
                    array('title' => '130_NQ-HĐT Nghị quyết chủ trương đầu tư trang thiết bị Phòng thí nghiệm phục vụ đào tạo', 'file' => '130_NQ-HĐT.pdf'),
                    array('title' => '133_NQ-HĐT Nghị quyết thông qua Đề án tuyển sinh sau đại học năm 2024', 'file' => '133_NQ-HĐT.pdf'),
                    array('title' => '138_NQ-HĐT Nghị quyết thông qua Kế hoạch đầu tư công trung hạn giai đoạn 2026-2030', 'file' => '138_NQ-HĐT.pdf'),
                    array('title' => '141_NQ-HĐT Nghị quyết kỳ họp Hội đồng trường Trường ĐHAG lần thứ 16', 'file' => '141_NQ-HĐT.pdf'),
                    array('title' => '144_NQ-HĐT Nghị quyết thống nhất chủ trương bổ sung vào kế hoạch đầu tư công trung hạn giai 2021-2025', 'file' => '144_NQ-HĐT.pdf'),
                    array('title' => '147_NQ-HĐT Thống nhất đánh giá kết quả hoạt động của Chủ tịch HĐT và Hiệu trưởng năm 2024', 'file' => '147_NQ-HĐT.pdf'),
                    array('title' => '152_NQ-HĐT Nghị quyết kỳ họp HĐT Trường ĐHAG lần thứ 17', 'file' => '152_NQ-HĐT.pdf'),
                );
            @endphp
            <h5 class="text-center"><b>DANH MỤC NGHỊ QUYẾT CỦA HỘI ĐỒNG TRƯỜNG</b></h5>
            <table class="table table-bordered table-striped">
                @foreach($nghi_quyet as $knq => $nq)
                    <tr>
                        <td class="text-center">{{ $knq+1 }}</td>
                        <td>
                            <a href="{{ env('APP_URL') }}storage/files/nghi-quyet-hdt-2025/{{ $nq['file'] }}">{{ $nq['title'] }}</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{--
            <p class="text-center">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/hoi-dong-truong.png" alt="Trường Đại học An Giang" align="center" style="max-width:100%;">
            </p> --}}
        </div>
    </div>
</div>
@endsection
