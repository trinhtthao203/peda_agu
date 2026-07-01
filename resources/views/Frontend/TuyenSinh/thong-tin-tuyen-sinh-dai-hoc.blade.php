@extends('Frontend.TuyenSinh.layout')
@section('title', __($title) . '- Thông tin tuyển sinh Đại học')
@section('css')
    <style>
        ul.list-thong-tin {
            list-style: square;
            padding: 20px 40px;
        }
        ul.list-thong-tin li {
            padding: 3px;
        }
        ul.list-thong-tin li a {
            font-size: 18px;
        }
        .content-box h5 {
            color:#fff;
            font-weight:bold;
        }
        .text-white {
            color:#fff;
            font-size: 30px;
        }
    </style>
@endsection
@section('body')
<section class="typo-dark bg-lgrey">
    <div class="container">
        @include('Frontend.TuyenSinh.widget-thong-tin')
        <div class="row">
            <div class="col-sm-12 col-md-9">
                <div class="tab"> 
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab2026" aria-controls="tab2026" role="tab" data-toggle="tab" aria-expanded="true">{{ __('Tuyển sinh năm 2026') }}</a></li>
                        <li role="presentation" class=""><a href="#tab2025" aria-controls="tab2025" role="tab" data-toggle="tab" aria-expanded="true">{{ __('Tuyển sinh năm 2025') }}</a></li>
                        <li role="presentation" class=""><a href="#tab2024" aria-controls="tab2024" role="tab" data-toggle="tab" aria-expanded="true">{{ __('Tuyển sinh năm 2024') }}</a></li>
                        {{-- -<li role="presentation" class=""><a href="#tab2023" aria-controls="tab2023" role="tab" data-toggle="tab" aria-expanded="true">{{ __('Tuyển sinh năm 2023') }}</a></li> --}}
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab2026">
                            @if($danhsach_2026 && count($danhsach_2026) > 0)
                            <ul class="list-thong-tin">
                                @foreach($danhsach_2026 as $ds_2026)
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/thong-tin/{{ $ds_2026['slug'] }}">{{ $ds_2026['ten'] }}</a></li>
                                @endforeach
                            </ul>
                            @else 
                                <h5><i class="uni-brush"></i> Chưa có bài viết.... Đang cập nhật.</h5>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab2025">
                            @if($danhsach_2025 && count($danhsach_2025) > 0)
                            <ul class="list-thong-tin">
                                @foreach($danhsach_2025 as $ds_2025)
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/thong-tin/{{ $ds_2025['slug'] }}">{{ $ds_2025['ten'] }}</a></li>
                                @endforeach
                            </ul>
                            @else 
                                <h5><i class="uni-brush"></i> Chưa có bài viết.... Đang cập nhật.</h5>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab2024">
                            @if($danhsach_2024 && count($danhsach_2024) > 0)
                            <ul class="list-thong-tin">
                                @foreach($danhsach_2024 as $ds_2024)
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/thong-tin/{{ $ds_2024['slug'] }}">{{ $ds_2024['ten'] }}</a></li>
                                @endforeach
                            </ul>
                            @else 
                                <h5><i class="uni-brush"></i> Chưa có bài viết.... Đang cập nhật.</h5>
                            @endif
                        </div>
                        {{-- -
                        <div role="tabpanel" class="tab-pane fade" id="tab2023">
                            @if($danhsach_2023 && count($danhsach_2023) > 0)
                            <ul class="list-thong-tin">
                                @foreach($danhsach_2023 as $ds_2023)
                                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/thong-tin/{{ $ds_2023['slug'] }}">{{ $ds_2023['ten'] }}</a></li>
                                @endforeach
                            </ul>
                            @else 
                                <h5><i class="uni-brush"></i> Chưa có bài viết.... Đang cập nhật.</h5>
                            @endif
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <aside class="sidebar">
                    <div class="widget">
                        <h5 class="widget-title">Tra cứu kết quả<span></span></h5>
                        <ul class="go-widget">
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2025/ket-qua-tuyen-sinh-bs3" style="color:#ff0000;">Kết quả trúng tuyển Đại học Chính Quy năm 2025 (Bổ sung đợt 3)</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2025/ket-qua-tuyen-sinh-bs2" style="color:#ff0000;">Kết quả trúng tuyển Đại học Chính Quy năm 2025 (Bổ sung đợt 2)</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2025/ket-qua-tuyen-sinh-bs" style="color:#ff0000;">Kết quả trúng tuyển Đại học Chính Quy năm 2025 (Bổ sung)</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2025/ket-qua-tuyen-sinh" style="color:#ff0000;">Kết quả trúng tuyển Đại học Chính Quy năm 2025</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2025/quy-che-tuyen-sinh-bgddt">Tra cứu kết quả hồ sơ xét tuyển thẳng theo Quy chế Tuyển sinh đại học của Bộ Giáo dục và Đào tạo năm 2025</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2025/diem-thi-nang-khieu-khoi-m">Tra cứu điểm thi tuyển sinh năng khiếu (Khối M) kỳ thi tuyển sinh đại học năm 2025</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2024/ket-qua-tuyen-sinh-bs2">Kết quả trúng tuyển Đại học Chính Quy năm 2024 (bổ sung đợt 2)</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2024/ket-qua-tuyen-sinh-bs">Kết quả trúng tuyển Đại học Chính Quy năm 2024 (đợt bổ sung)</a></li>                            
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2024/ket-qua-tuyen-sinh">Kết quả trúng tuyển Đại học Chính Quy năm 2024</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2024/diem-thi-nang-khieu-khoi-m">Tra cứu điểm thi tuyển sinh năng khiếu (Khối M) kỳ thi tuyển sinh đại học năm 2024</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2024/ket-qua-trung-tuyen-phuong-thuc-6">Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức xét tuyển thẳng đại học hình thức chính quy dựa trên các chứng chỉ ngoại ngữ quốc tế (Phương thức 6)</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2024/ket-qua-trung-tuyen-phuong-thuc-5">Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức xét tuyển dựa trên kết quả học tập THPT (Phương thức 5) năm 2024</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2024/phuong-thuc-1-2">Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo phương thức Ưu tiên xét tuyển thẳng theo quy định ĐHQG-HCM thí sinh giỏi, tài năng của trường THPT (phương thức 1.2) năm 2024</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2024/ket-qua-trung-tuyen-ưu-tien-danh-gia-nang-luc">Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức Ưu tiên xét tuyển theo quy định của ĐHQG-HCM năm 2024</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2024/ket-qua-trung-tuyen-dua-theo-danh-gia-nang-luc">Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện dựa trên kết quả thi Đánh giá năng lực của ĐHQG-HCM năm 2024</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2024/tra-cuu-ho-so-phuong-thuc-5">Tra cứu hồ sơ đăng ký xét tuyển đại học theo phương thức 5</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2024/phuong-thuc-5">Tra cứu kết quả xét duyệt bài luận áp dụng xét tuyển theo Phương thức 5</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2023/danh-sach-trung-tuyen-bo-sung">Tra cứu Kết quả trúng tuyển Đại học hệ chính quy năm 2023 (đợt bổ sung)</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2023/bai-luan-phuong-thuc-5-bo-sung/">Tra cứu kết quả xét duyệt bài luận áp dụng xét tuyển theo Phương thức 5 (đợt bổ sung)</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2023/nang-khieu-khoi-m-bo-sung">Tra cứu điểm thi tuyển sinh năng khiếu (Khối M) kỳ tuyển sinh đại học năm 2023 (Đợt bổ sung)</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2023/danh-sach-trung-tuyen">Tra cứu Kết quả trúng tuyển Đại học hệ chính quy năm 2023</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2023/phuong-thuc-5">Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức xét tuyển dựa trên kết quả học tập THPT năm 2023</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2023/phuong-thuc-1-2">Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức Ưu tiên xét tuyển thẳng vào đại học theo quy định ĐHQG–TP.HCM thí sinh giỏi, tài năng của trường THPT năm 2023</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2023/phuong-thuc-6">Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức xét tuyển thẳng đại học hệ chính quy dựa trên các chứng chỉ ngoại ngữ quốc tế năm 2023</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2023/nang-khieu-khoi-m">Tra cứu điểm thi tuyển sinh năng khiếu (Khối M) kỳ thi tuyển sinh đại học năm 2023</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2023/uu-tien-xet-tuyen/">Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện theo Phương thức Ưu tiên xét tuyển theo quy định của ĐHQG-HCM năm 2023</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2023/danh-gia-nang-luc/">Tra cứu kết quả trúng tuyển đại học chính quy có điều kiện dựa trên kết quả thi Đánh giá năng lực của ĐHQG-HCM năm 2023</a></li>
                            <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ket-qua/2023/bai-luan-phuong-thuc-5/">Tra cứu kết quả xét duyệt bài luận áp dụng xét tuyển theo Phương thức 5</a></li>
                            {{--<li><a href="{{ env('APP_URL') }}vi/tuyen-sinh/ho-so-dang-ky-xet-tuyen/2023/phuong-thuc-5/">Tra cứu hồ sơ đăng ký xét tuyển đại học theo Phương thức 5</a></li>
                            <li><a href="https://www.agu.edu.vn/tuyensinh/tracuukq_dang_ky_xet_tuyen_sinh_dot_2_22/" target="_blank">Kết quả xét tuyển đợt bổ sung 2</a></li>
                            <li><a href="https://www.agu.edu.vn/tuyensinh/tracuukq_dang_ky_xet_tuyen_sinh_dot_2_18/" target="_blank">Tra cứu hồ sơ đăng ký xét tuyển Đại học (đợt bổ sung)</a></li>
                            <li><a href="https://www.agu.edu.vn/tuyensinh/tracuukq_dang_ky_xet_tuyen_sinh_bo_sung_d2/" target="_blank">Tra cứu kết quả thí sinh đủ điều kiện trúng tuyển đại học (đợt bổ sung)</a></li>
                            <li><a href="https://www.agu.edu.vn/tuyensinh/tracuukq_dang_ky_xet_tuyen_sinh_dot_2/" target="_blank">Tra cứu hồ sơ đăng ký xét tuyển Đại học (đợt bổ sung)</a></li>
                            <li><a href="https://www.agu.edu.vn/tuyensinh/tracuukq_dang_ky_xet_tuyen_sinh_bo_sung/" target="_blank">Tra cứu kết quả xét duyệt bài luận (đợt bổ sung)</a></li>
                            <li><a href="https://www.agu.edu.vn/tuyensinh/tracuukq_dang_ky_xet_tuyen_sinh_17_09/" target="_blank">Tra cứu kết quả thí sinh đủ điều kiện trúng tuyển đại học (Đợt 1)</a></li>
                            <li><a href="https://www.agu.edu.vn/tuyensinh/tracuukq_xt_THPT/" target="_blank">Kết quả xét tuyển đại học hình thức đào tạo chính quy theo phương thức xét tuyển dựa trên kết quả học tập THPT</a></li>
                            <li><a href="https://www.agu.edu.vn/tuyensinh/tracuukq_uu_tien_pt6/" target="_blank">Tra cứu thí sinh đủ điều kiện trúng tuyển đại học hình thức đào tạo chính quy theo phương thức xét tuyển thẳng vào đại học dựa trên các chứng chỉ ngoại ngữ quốc tế (phương thức 6) trong đợt tuyển sinh đại học năm 2022.</a></li>
                            <li><a href="https://www.agu.edu.vn/tuyensinh/tracuukq_uu_tien_xt_dhqg/" target="_blank">Tra cứu kết quả theo phương thức ưu tiên xét tuyển của Đại học Quốc gia TP.HCM năm 2022</a></li>
                            <li><a href="https://www.agu.edu.vn/tuyensinh/tracuukq_danh_gia_nang_luc_d2" target="_blank">Tra cứu kết quả xét tuyển dựa trên kết quả thi Đánh giá năng lực</a></li>
                            <li><a href="https://www.agu.edu.vn/tuyensinh/tracuukq_dang_ky_xet_tuyen_sinh_pt5_2022/" target="_blank">Tra cứu Hồ sơ đăng ký xét tuyển sinh (PT5)</a></li>
                            <li><a href="https://www.agu.edu.vn/tuyensinh/tracuukq_bai_luan_2022/" target="_blank">Tra cứu kết quả Bài luận</a></li> --}}
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
@endsection
