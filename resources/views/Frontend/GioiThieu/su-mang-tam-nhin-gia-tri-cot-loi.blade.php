@extends('Frontend.layout')
@section('title', __('Giới thiệu - Sứ mạng - Tầm nhìn - Giá trị cốt lõi - Triết lý giáo dục - Bản sắc người học'))
@section('body')
<div class="rs-container light rev_slider_wrapper">
    <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"delay": 9000, "gridwidth": 1170, "gridheight": 400}'>
        <ul>
            <li data-transition="fade" class="typo-dark heavy">
                <img src="{{ env('APP_ASSETS') }}assets/frontend/images/gioithieu/tam-nhin.jpg"
                    alt="{{ __('Trường Đại học An Giang') }}"
                    title="{{ __('Trường Đại học An Giang') }}"
                    data-bgposition="center center"
                    data-bgfit="cover"
                    data-bgrepeat="no-repeat"
                    class="rev-slidebg">
            </li>
            <li data-transition="fade" class="typo-dark heavy">
                <img src="{{ env('APP_ASSETS') }}assets/frontend/images/gioithieu/su-mang.jpg"
                    alt="{{ __('Trường Đại học An Giang') }}"
                    title="{{ __('Trường Đại học An Giang') }}"
                    data-bgposition="center center"
                    data-bgfit="cover"
                    data-bgrepeat="no-repeat"
                    class="rev-slidebg">
            </li>
            <li data-transition="fade" class="typo-dark heavy">
                <img src="{{ env('APP_ASSETS') }}assets/frontend/images/gioithieu/he-gia-tri-cot-loi.jpg"
                    alt="{{ __('Trường Đại học An Giang') }}"
                    title="{{ __('Trường Đại học An Giang') }}"
                    data-bgposition="center center"
                    data-bgfit="cover"
                    data-bgrepeat="no-repeat"
                    class="rev-slidebg">
            </li>
            <li data-transition="fade" class="typo-dark heavy">
                <img src="{{ env('APP_ASSETS') }}assets/frontend/images/gioithieu/triet-ly-giao-duc.jpg"
                    alt="{{ __('Trường Đại học An Giang') }}"
                    title="{{ __('Trường Đại học An Giang') }}"
                    data-bgposition="center center"
                    data-bgfit="cover"
                    data-bgrepeat="no-repeat"
                    class="rev-slidebg">
            </li>
            <li data-transition="fade" class="typo-dark heavy">
                <img src="{{ env('APP_ASSETS') }}assets/frontend/images/gioithieu/ban-sac-nguoi-hoc.jpg"
                    alt="{{ __('Trường Đại học An Giang') }}"
                    title="{{ __('Trường Đại học An Giang') }}"
                    data-bgposition="center center"
                    data-bgfit="cover"
                    data-bgrepeat="no-repeat"
                    class="rev-slidebg">
            </li>
        </ul>
    </div>
</div><!-- Home Slider -->
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Hệ Giá trị Cốt lõi</h4>
            <p class="text-justify">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/core-values-thumbnail.jpg" alt="Trường Đại học An Giang" style="float:left;width:250px;margin-right:20px;">
                Hệ giá trị cốt lõi là hệ thống giá trị nền tảng của văn hóa tổ chức liên quan đến chất lượng của nhà trường được gầy dựng nên trong suốt quá trình tồn tại và phát triển; trở thành các giá trị, niềm tin, nguyên tắc, chuẩn mực, truyền thống ăn sâu vào mọi hoạt động của cơ sở giáo dục; chi phối tình cảm, suy nghĩ và hành động của tất cả thành viên của nhà trường trong việc theo đuổi thực hiện sứ mạng và các mục tiêu chất lượng. Hệ giá trị cốt lõi của Trường được xác định là <strong>Chính trực – Tận tâm – Sáng tạo.</strong>
            </p>
            <p class="text-justify"><strong>Chính trực (Integrity):</strong> Hành động theo các giá trị văn hóa; tuân thủ các chuẩn mực về đạo đức nghề nghiệp; coi trọng sự hợp tác, kết nối và phục vụ cộng đồng.</p>
            <p class="text-justify"><strong>Tận tâm (Dedication):</strong> Hành động bằng tất cả sự tận tụy và niềm đam mê đối với công việc; lấy sự cống hiến làm nền tảng cho mọi suy nghĩ và hành động.</p>
            <p class="text-justify"><strong>Sáng tạo (Creativity):</strong> Hành động thông qua việc không ngừng đổi mới và cải tiến chất lượng để chinh phục những đỉnh cao mới; dám khác biệt; thể hiện khát vọng tiên phong.</p>
            <h4>Triết lý Giáo dục</h4>
            <p class="text-justify">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/education-philosophy-thumbnail.jpg" alt="Trường Đại học An Giang" style="float:left;width:250px;margin-right:20px;">
                Triết lý giáo dục là một bộ giá trị được thực hiện bởi nhà trường và mọi giảng viên, tác động đến mục đích của quá trình học, vai trò của giảng viên, nội dung và phương pháp giảng dạy. Căn cứ vào sứ mạng, tầm nhìn, hệ giá trị cốt lõi và bản sắc của người học, triết lý giáo dục của Trường được xác định là Kiến tạo – Khai phóng, nhằm đáp ứng mục tiêu giáo dục toàn diện cho người học về phẩm chất và năng lực trong bối cảnh toàn cầu. Triết lý giáo dục này là kim chỉ nam cho quá trình giáo dục thể hiện qua mục tiêu giáo dục mà nhà trường đã tuyên bố.
            </p>
            <p class="text-justify">
                <strong>Kiến tạo (Constructivist Education)</strong> <br />
                Với quan điểm tri thức là sản phẩm được kiến tạo thông qua sự trải nghiệm và sự tương tác với môi trường xung quanh, chương trình đào tạo được xây dựng và phát triển một cách hệ thống, xoay quanh chuẩn đầu ra các môn học kiến thức ngành với các kỹ năng được tích hợp, đan xen vào kiến thức giúp người học có những trải nghiệm học tập ý nghĩa với vai trò trung tâm trong việc chủ động chiếm lĩnh các kiến thức, kỹ năng và năng lực thực hành nghề nghiệp để kiến tạo những giá trị mới; đồng thời có khả năng làm chủ cuộc sống, có năng lực hội nhập trong môi trường đa văn hóa bằng sự nỗ lực không ngừng với tinh thần sẵn sàng cống hiến nhằm thực hiện được khát vọng của bản thân và phụng sự xã hội.
            </p>
            <p class="text-justify">
                <strong>Khai phóng (Liberal Education)</strong>
                Với quan điểm giáo dục là nền tảng cho sự phát triển toàn diện con người tự do học thuật và sáng tạo, chương trình đào tạo được xây dựng mở – linh hoạt, có chiều rộng cũng như chiều sâu, cơ cấu hợp lý giữa kiến thức khoa học cơ bản lẫn chuyên ngành, tích hợp các kỹ năng liên môn, liên ngành tương thích với trình độ chung của khu vực và thế giới giúp người học chủ động khai phóng trí tuệ ở nhiều lĩnh vực, phát huy tối đa năng lực sáng tạo, tư duy phản biện để khởi nghiệp; đồng thời có nền tảng đạo đức tốt, có tinh thần trách nhiệm cao, biết vun đắp và phát triển các giá trị phổ quát: Chân – Thiện – Mỹ nhằm thích ứng linh hoạt trong một thế giới luôn biến đổi.
            </p>
            <h4>Bản sắc Người học</h4>
            <p class="text-justify">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/identity_of_learners.jpg" alt="Trường Đại học An Giang" style="float:left;width:250px;margin-right:20px;">
                Bản sắc của người học là những phẩm chất và đặc điểm làm nên giá trị riêng biệt của người học. Bản sắc người học của Trường được xác định là <strong>Thích ứng – Khởi nghiệp</strong>.
            </p>

        </div>
    </div>
</div>
@endsection
