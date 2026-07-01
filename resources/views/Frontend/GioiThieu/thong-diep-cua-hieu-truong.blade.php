@extends('Frontend.layout')
@section('title', __('Giới thiệu - Thông điệp của Hiệu Trưởng'))
@section('body')
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Sơ đồ Tổ chức</h4>
            <p class="text-center">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/to-chuc-bo-may.jpg" alt="Trường Đại học An Giang" align="center">
            </p>
            <h4>Đảng ủy</h4>
            <p class="text-center">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/dang-uy.png" alt="Trường Đại học An Giang" align="center" style="max-width:100%;">
            </p>
            <h4>Hội đồng trường</h4>
            <p>Hội đồng trường Trường Đại học An Giang được thành lập ngày 27/8/2020 gồm 25 thành viên, trong đó có Chủ tịch, Phó Chủ tịch, Thư ký và các thành viên đại diện cho giảng viên, viên chức, người lao động và người học; nhà khoa học, nhà doanh nghiệp và đại diện cho công đồng xã hội.</p>
            <p>Với những thành phần ưu tú, tâm huyết, đại diện cho giảng viên, viên chức, người lao động và cộng đồng xã hội, Hội đồng trường sẽ tích cực phát huy vai trò, năng lực và đề ra những định hướng mới, phù hợp, góp phần vào sự phát triển của Trường Đại học An Giang trong tương lai.</p>
            <p class="text-center">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/hoi-dong-truong-2020-2025.jpg" alt="Trường Đại học An Giang" align="center" style="max-width:100%;">
            </p>
            <p class="text-center">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/hoi-dong-truong.png" alt="Trường Đại học An Giang" align="center" style="max-width:100%;">
            </p>
        </div>
    </div>
</div>
@endsection
