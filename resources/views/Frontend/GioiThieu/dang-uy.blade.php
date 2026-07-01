@extends('Frontend.layout')
@section('title', __('Giới thiệu - Đảng ủy'))
@section('body')
@php
    //Danh sách 2020 - 2025
    /*$danhsach = array(
        array('Trần Văn Đạt', 'Bí thư Đảng ủy'),
        array('Võ Văn Thắng','Phó Bí thư Đảng ủy'),
        array('Hồ Nhã Phong','UV Ban Thường vụ'),
        array('Nguyễn Hữu Trí','Ủy viên'),
        array('Nguyễn Trần Nhẫn Tánh','Ủy viên'),
        array('Trần Lê Đăng Phương','Ủy viên'),
        array('Phan Trung Dũng','Ủy viên'),
        array('Trần Thanh Hải','Ủy viên'),
        array('Trần Minh Tâm','Ủy viên'),
        array('Nguyễn Thị Ngọc Thơ','Ủy viên'),
        array('Phan Minh Trí','Ủy viên'),
        array('Đoàn Thanh Nghị','Ủy viên'),
        array('Nguyễn Phương Thảo','Ủy viên'),
    );*/
    //Danh sach 2025 - 2030 
    $danhsach = array(
        array('Trần Văn Đạt', 'Bí thư Đảng ủy'),
        array('Trần Lê Đăng Phương','Ủy viên Ban Thường vụ'),
        array('Nguyễn Phương Thảo','Ủy viên Ban Thường vụ'),
        array('Nguyễn Hữu Trí','Ủy viên Ban Thường vụ'),
        array('Phan Trung Dũng','Ủy viên'),
        array('Phan Thị Thanh Huyền','Ủy viên'),
        array('Nguyễn Thị Thanh Loan','Ủy viên'),
        array('Nguyễn Thị Thảo Linh','Ủy viên'),
        array('Nguyễn Văn Mện','Ủy viên'),
        array('Đoàn Thanh Nghị','Ủy viên'),
        array('Hồ Nhã Phong','Ủy viên'),
        array('Nguyễn Thị Ngọc Thơ','Ủy viên'),
        array('Phan Minh Trí','Ủy viên'),
    );
@endphp
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Đảng ủy</h4>
            {{-- <p class="font-17">Ngày 3/8/2020, Đại hội đại biểu Đảng bộ Trường Đại học An Giang lần thứ VI, nhiệm kỳ 2020 – 2025 đã bầu 15 đồng chí vào Ban Chấp hành Đảng bộ.</p> --}}
            <p class="font-17">Ngày 29/06/2025, Đại hội đại biểu Đảng bộ Trường Đại học An Giang lần thứ VII, nhiệm kỳ 2025 – 2030 đã bầu 13 đồng chí vào Ban Chấp hành Đảng bộ.</p>
            <p class="text-center">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/dang-uy-3.jpg" alt="Trường Đại học An Giang" align="center" style="max-width:100%;">
            </p>
            {{-- <p class="text-center">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/dang-uy.png" alt="Trường Đại học An Giang" align="center" style="max-width:100%;">
            </p> --}}
            <br /><br />
            <h3 class="text-center">Ban Chấp hành Đảng bộ</h3>
            <hr />
            <table class="table table-border table-bordered table-hovered table-striped">
                <thead>
                    <tr>
                        <th width="50">STT</th>
                        <th>Họ tên</th>
                        <th>Chức vụ</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($danhsach as $ks => $ds)
                <tr>
                    <td class="text-center">{{ $ks+1 }}</td>
                    <td>{{ $ds[0] }}</td>
                    <td>{{ $ds[1] }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
