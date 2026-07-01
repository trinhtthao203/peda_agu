@extends('Frontend.layout')
@section('title', __('Giới thiệu - Hội đồng Khoa học và Đào tạo'))
@section('body')
@php
$arr_danshach = array(
    array('PGS.TS. Trần Văn Đạt', 'Bí thư Đảng ủy, Chủ tịch Hội đồng Trường', 'Chủ tịch'),
    array('TS. Nguyễn Hữu Trí','Phó Hiệu trưởng phụ trách, kiêm TP. Phòng Quan hệ đối ngoại','Thành viên'),
    array('TS. Nguyễn Phương Thảo', 'Phó Hiệu trưởng, kiêm GĐ. Trung tâm BDNG&PTKN', 'Thành viên'),
    array('PGS.TS. Nguyễn Trung Thành','Trưởng phòng Phòng Khoa học và Công nghệ','Thành viên, Thư ký Hội đồng'),
    array('ThS. Hồ Nhã Phong','TP. Phòng Tổ chức - Chính trị, kiêm TP. Phòng Khảo thí và ĐBCL','Thành viên'),
    array('PGS.TS Nguyễn Văn Mện','Phó trưởng phòng Phòng Đào tạo','Thành viên'),
    array('TS Nguyễn Trần Nhẫn Tánh','Viện trưởng Viện Biến đổi khí hậu','Thành viên'),
    array('TS. Nguyễn Thanh Hùng','Phó Trưởng khoa Khoa Kỹ thuật - Công nghệ - Môi trường','Thành viên'),
    array('PGS.TS Đoàn Thanh Nghị','Trưởng khoa Khoa Công nghệ thông tin, kiêm Giám đốc Trung tâm Tin học','Thành viên'),
    array('TS Trần Lê Đăng Phương','Trưởng khoa Khoa Luật và Khoa học chính trị','Thành viên'),
    array('TS. Trần Thế Định','Phó Trưởng khoa Khoa Sư phạm','Thành viên'),
    array('TS Phan Thị Thanh Huyền','Trưởng khoa Khoa Ngoại ngữ','Thành viên'),
    array('TS Phan Phương Loan','Trưởng khoa Khoa Nông nghiệp – Tài nguyên thiên nhiên','Thành viên'),
    array('ThS Dương Phương Đông','Phó Trưởng khoa Khoa Du lịch và Văn hoá Nghệ thuật','Thành viên'),
    array('ThS Nguyễn Đăng Khoa','Phó Trưởng khoa Khoa Kinh tế - Quản trị Kinh doanh, kiêm Phó trưởng phòng Kế hoạch - Tài vụ','Thành viên'),
    array('ThS Hồ Văn Tú','Trưởng Bộ môn Bộ môn Giáo dục thể chất','Thành viên'),
    array('ThS. Phạm Văn Thành', 'Phó Trưởng Bộ môn GDQP','Thành viên')
    //array('TS Nguyễn Hữu Trí','Trưởng phòng Phòng Quan hệ đối ngoại (kiêm Trưởng khoa Khoa Kinh tế - Quản trị kinh doanh)','Thành viên'),
    //array('TS Huỳnh Thanh Tiến','Giám đốc Trung tâm Tạo nguồn nhân lực phát triển cộng đồng','Thành viên')
        
);
@endphp
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Hội đồng Khoa học và Đào tạo</h4>
            <p>Hội đồng Khoa học và Đào tạo Trường Đại học An Giang được thành lập theo Quyết định số 3932/QĐ-ĐHAG ngày 24 tháng 12 năm 2025 của Hiệu trưởng Trường Đại học An Giang.</p>
            <p>Nhiệm kỳ của Hội đồng Khoa học và Đào tạo theo nhiệm kỳ của Hiệu trưởng. Hội đồng Khoa học và Đào tạo thực hiện tổ chức và hoạt động theo Quy chế tổ chức và hoạt động của Trường ĐHAG, Quy chế tổ chức và hoạt động của Hội đồng Khoa học và Đào tạo và các quy định khác có liên quan.</p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>HỌ TÊN</th>
                        <th>CHỨC VỤ/ CHỨC DANH</th>
                        {{-- -<th>NHIỆM VỤ</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($arr_danshach as $key => $value)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $value[0] }}</td>
                        <td>{{ $value[1] }}</td>
                        {{-- -<td>{{ $value[2] }}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <p class="text-center">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/hoi-dong-khoa-hoc.png" alt="Trường Đại học An Giang" align="center">
            </p> --}}
        </div>
    </div>
</div>
@endsection
