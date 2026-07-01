<h4>{{ __($title_page) }}</h4>
@if(app()->getLocale() == 'vi')
<ul style="list-style: square; margin-left:30px;">
    <li>Các thiết bị sử dụng điện cần được tắt hoặc ngắt nguồn điện sau khi sử dụng xong;</li>
    <li>Khi rời khỏi lớp học hoặc phòng làm việc sau một ngày, cần chủ động kiểm tra để tắt tất cả các thiết bị dùng điện, cúp cầu dao điện (áp dụng với những thiết bị không cần duy trì điện qua đêm);</li>
    <li>Ưu tiên sử dụng các thiết bị có chức năng tiết kiệm điện;</li>
    <li>Mở cửa sổ thay vì sử dụng máy điều hòa nhiệt độ vào mùa hè, kết hợp mở cửa sổ với trồng cây xanh trong văn phòng;</li>
    <li>Ưu tiên sử dụng ánh sáng tự nhiên trong xây dựng và thiết kế nội thất văn phòng kết hợp với việc lắp đặt các cửa sổ lớn để tận dụng triệt để nguồn ánh sáng và gió tự nhiên;</li>
    <li>Hướng đến sử dụng nguồn năng lượng có thể tái tạo.</li>
</ul>
@endif
@if(app()->getLocale() == 'en')
<ul style="list-style: square; margin-left:30px;">
    <li>Turn off or unplug electrical equipment after use;</li>
    <li>Ensure all devices are turned if leaving the room last, except for those requiring continuous overnight power.</li>
    <li>Prioritize energy-efficient devices.</li>
    <li>Use windows and plants to reduce air conditioning.</li>
    <li>Maximize natural light and ventilation in office design.</li>
    <li>Strive for renewable energy sources.</li>
</ul>
@endif

<h4>{{ __('Một số hình ảnh') }}</h4>
<div class="row">
    <div class="col-md-12">
        <div class="isotope-grid grid-three-column has-gutter-space" data-gutter="20" data-columns="3">
            <div class="grid-sizer"></div>
            @for($i=1; $i<=3;$i++)
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
