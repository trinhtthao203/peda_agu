@extends('Frontend.layout')
@section('title', __('Giới thiệu - Chính sách Đảm bảo Chất lượng'))
@section('css')
<style type="text/css" media="screen">
    ul.list {
        padding-left: 50px !important;
        list-style-type: square;
    }
    ul.list li {
        font-size: 16px;
        line-height: 29px;
    }
</style>
@endsection

@section('body')
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Chính sách Đảm bảo Chất lượng</h4>
            <p class="text-justify" style="font-size:16px;">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/dam-bao-chat-luong.jpg" alt="Trường Đại học An Giang" style="float:left;width:500px;margin-right:20px;">
                Đảm bảo chất lượng thông qua việc thường xuyên đổi mới và hội nhập trong đào tạo; sáng tạo và năng động trong nghiên cứu và chuyển giao công nghệ; gắn lý thuyết với thực hành để trang bị đầy đủ kiến thức và kỹ năng cho người học nhằm thích ứng tối đa với sự thay đổi. Xây dựng hệ thống quản trị hiệu quả, chuyên nghiệp, trách nhiệm và sáng tạo; quy trình hóa, tin học hóa hoạt động quản lý, áp dụng hệ thống đảm bảo chất lượng theo tiêu chuẩn ISO và “5S” nhằm kiến tạo một môi trường giáo dục đại học chuẩn mực, nhân văn. Phát huy mọi tiềm năng và cống hiến của tất cả các thành viên trong các hoạt động quản trị, dạy và học, nghiên cứu, chuyển giao công nghệ, xây dựng Trường thành một tập thể trong sạch, vững mạnh, gia tăng vị thế cạnh tranh của Trường trong khu vực và trên thế giới.
            </p>
            <h4>Phương châm hoạt động</h4>
            <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/phuong-cham-hoat-dong.jpg" alt="Trường Đại học An Giang" style="float:right;width:500px;margin-left:40px;">
            <ul class="list">
                <li>Tất cả vì sự phát triển toàn diện của người học, lấy người học làm trung tâm.</li>
                <li>Cải tiến và nâng cao chất lượng giáo dục và đào tạo là ưu tiên hàng đầu. </li>
                <li>Độc lập, sáng tạo, hiệu quả trong nghiên cứu khoa học. </li>
                <li>Lấy hợp tác bền vững và cùng có lợi là nền tảng.</li>
                <li>Chuyên nghiệp và hiệu quả trong quản trị đại học. </li>
                <li>Gắn kết và phục vụ cộng đồng.</li>
                <li>Hướng đến văn hóa chất lượng.</li>
            </u>
        </div>
    </div>
</div>
@endsection
