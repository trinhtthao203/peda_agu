@extends('Frontend.layout')
@section('title', __('Giới thiệu - Chiến lược Phát triển'))
@section('body')
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Chiến lược Phát triển</h4>
            <div class="row">
                <div class="col-sm-4">
                    <div class="course-wrapper chien-luoc-phat-trien">
                        <div class="course-banner-wrap">
                            <img width="600" height="220" src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/doi-moi-phuong-phap-day-va-hoc.jpg" class="img-responsive" title="Đổi mới phương pháp dạy và học">
                        </div>
                        <div class="course-detail-wrap">
                            <div class="course-content">
                                <h5>Thiết lập môi trường dạy - học tích cực, hiệu quả và sáng tạo</h5>
                                <p>Mở rộng ngành nghề đào tạo, nâng cao chất lượng chương trình đào tạo; Tạo môi trường dạy - học chủ động và kết nối; Đồng bộ và hiện đại hóa cơ sở vật chất; Ứng dụng công nghệ thông tin và tự động hóa vào việc dạy - học.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="course-wrapper chien-luoc-phat-trien">
                        <div class="course-banner-wrap">
                            <img width="600" height="220" src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/phat-trien-doi-ngu.jpg" class="img-responsive" title="Phát triển tổ chức bộ máy đáp ứng yêu cầu tự chủ; phát triển nguồn nhân lực theo chuẩn quốc tế">
                        </div>
                        <div class="course-detail-wrap">
                            <div class="course-content">
                                <h5>Phát triển tổ chức bộ máy đáp ứng yêu cầu tự chủ; phát triển nguồn nhân lực theo chuẩn quốc tế</h5>
                                <p>Phát triển tổ chức bộ máy và cơ cấu đội ngũ viên chức phù hợp quy định, đảm bảo cho tự chủ và phát triển bền vững; Nâng cao năng lực ngoại ngữ và ứng dụng các thành tựu của cách mạng công nghệ 4.0; Đào tạo cán bộ giảng viên có trình độ chuyên môn đạt chuẩn khu vực ASEAN; Thực hiện chính sách thu hút, đãi ngộ người có trình độ cao.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="course-wrapper chien-luoc-phat-trien">
                        <div class="course-banner-wrap">
                            <img width="600" height="220" src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/tang-cuong-nang-luc-nghien-cuu.jpg" class="img-responsive" title="">
                        </div>
                        <div class="course-detail-wrap">
                            <div class="course-content">
                                <h5>Nâng cao chất lượng nghiên cứu, ứng dụng khoa học và chuyển giao công nghệ phục vụ đào tạo và cộng đồng</h5>
                                <p>Nâng cao năng lực nghiên cứu, tăng số lượng và chất lượng đề tài/dự án; Đẩy mạnh ứng dụng khoa học và chuyển giao công nghệ phục vụ đào tạo và cộng đồng; Tăng số lượng bài báo công bố quốc tế.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-sm-4">
                    <div class="course-wrapper chien-luoc-phat-trien">
                        <div class="course-banner-wrap">
                            <img width="600" height="220" src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/phat-trien-hop-tac-quoc-te.jpg" class="img-responsive" title="Tăng cường hợp tác quốc tế và phát triển thương hiệu AGU">
                        </div>
                        <div class="course-detail-wrap">
                            <div class="course-content">
                                <h5>Tăng cường hợp tác quốc tế và phát triển thương hiệu "AGU"</h5>
                                <p>Tăng cường hợp tác quốc tế; Đẩy mạnh công tác tuyên truyền, quảng bá; Đẩy mạnh thương mại hóa sản phẩm “AGU”; Nâng cao hiệu quả phục vụ cộng đồng.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="course-wrapper chien-luoc-phat-trien">
                        <div class="course-banner-wrap">
                            <img width="600" height="220" src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/he-thong-quan-ly.jpg" class="img-responsive" title="Thiết lập hệ thống quản lý tiên tiến">
                        </div>
                        <div class="course-detail-wrap">
                            <div class="course-content">
                                <h5>Thiết lập hệ thống quản lý tiên tiến</h5>
                                <p>Áp dụng các hệ thống quản trị tiên tiến; Áp dụng công nghệ thông tin nâng cao hiệu quả quản lý; Đẩy mạnh công tác đảm bảo chất lượng.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
