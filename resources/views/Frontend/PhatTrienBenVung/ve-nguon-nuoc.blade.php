<h4>{{ __($title_page) }}</h4>
@if(app()->getLocale() == 'vi')
<ul style="list-style: square; margin-left:30px;">
    <li>Giảm thiểu rác thải nhựa: Khuyến khích mọi người sử dụng các loại đồ dùng đựng thức ăn như inox, thủy tinh, hạn chế các dụng cụ ăn uống sử dụng 1 lần như ống hút nhựa, chai nước nhựa, bao ni lông,...</li>
    <li>Không đổ dầu ăn trực tiếp vào đường nước thải: Dầu mỡ được sử dụng nhiều lần sẽ rất khó phân hủy và có khả năng bám dính cao, vì vậy sẽ tạo thành nhiều mảng trong đường ống thoát nước, gây tắc nghẽn và khiến nguồn nước sinh hoạt có nguy cơ bị ô nhiễm nặng;</li>
    <li>Hạn chế hóa chất tẩy rửa: Kkhi vệ sinh các thiết bị trong phòng thí nghiệm hoặc những khu vực liên quan, ưu tiên dùng các chất tẩy rửa có nguồn gốc tự nhiên để tránh các hóa chất xâm nhập vào nguồn nước;</li>
    <li>Ưu tiên lắp đặt và sử dụng các thiết bị có chức năng tiết kiệm nước tại các nhà vệ sinh;</li>
    <li>Không vứt tàn thuốc lá vào bồn cầu để tránh gây tắc nghẽn ống thoát nước và tránh tạo điều kiện cho vi khuẩn sinh sôi do nhiều thành phần trong thuốc lá không thể phân hủy được trong nước;</li>
    <li>Hạn chế dùng thuốc trừ sâu khi chăm sóc cây cối trong khuôn viên trường: tránh việc thẩm thấu các hóa chất vào nguồn nước ngầm, gây nên tình trạng ô nhiễm cho nguồn nước;</li>
    <li>Nghiên cứu các phương án tận dụng nguồn nước mưa để tưới cây;</li>
    <li>Thường xuyên dọn dẹp rác và nơi tập kết rác: Hạn chế chất thải lỏng từ rác ngấm vào nguồn nước.</li>
</ul>
@endif
@if(app()->getLocale() == 'en')
<ul style="list-style: square; margin-left:30px;">
    <li>plastic waste: Encourage using stainless steel or glass food containers and minimize single-use items like plastic straws, bottles, and bags.</li>
    <li>Avoid pouring cooking oil into wastewater: Used cooking oil can cause pipe blockages and water pollution.</li>
    <li>Limit chemical use: Prioritize natural cleaning agents to prevent chemical infiltration into water sources.</li>
    <li>Install water-saving devices in restrooms.</li>
    <li>Dispose of cigarette butts properly to prevent pipe clogs and water pollution. </li>
    <li>Reduce pesticide use to avoid groundwater contamination.</li>
    <li>Harvest rainwater for plant irrigation.</li>
    <li>Regularly clean up trash areas to prevent liquid waste leaching into water sources.</li>

</ul>
@endif
<h4>{{ __('Một số hình ảnh') }}</h4>
<div class="row">
    <div class="col-md-12">
        <div class="isotope-grid grid-three-column has-gutter-space" data-gutter="20" data-columns="3">
            <div class="grid-sizer"></div>
            @for($i=1; $i<=4;$i++)
                <div class="item">
                    <div class="image-wrapper">
                        <img src="{{ env('APP_URL') }}assets/frontend/images/phattrienbenvung/{{ $slug }}/h{{ $i }}.jpg" title="{{ $title_page }}" alt="{{ $title_page }}">
                        <div class="gallery-detail btns-wrapper">
                            <a href="{{ env('APP_URL') }}assets/frontend/images/phattrienbenvung/{{ $slug }}/h{{ $i }}.jpg" data-rel="prettyPhoto[portfolio]" title="{{ $title_page }}" class="btn uni-full-screen"></a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
