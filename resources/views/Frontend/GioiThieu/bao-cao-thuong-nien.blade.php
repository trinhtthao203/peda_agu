@extends('Frontend.layout')
@section('title', __('Giới thiệu - Báo cáo Thường niên'))
@section('body')
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Báo cáo thường niên</h4>
            <div class="tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#nam2020" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">Năm 2024</a></li>
                    <li role="presentation" class=""><a href="#nam2019" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">Năm 2019</a></li>
                    <li role="presentation" class=""><a href="#nam2017_2018" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">Năm 2017-2018</a></li>
                    <li role="presentation" class=""><a href="#nam2016" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">Năm 2016</a></li>
                    <li role="presentation" class=""><a href="#nam2015" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">Năm 2015</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="nam2020">
                        <iframe src="https://drive.google.com/file/d/1QHrzcrxXS32IUwBvdpJcQHCRrmDmWccb/preview" style="width:100%;height:800px;"></iframe>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="nam2019">
                        <iframe src="https://drive.google.com/file/d/1s1wy7n2QjDO1ITJmabIWDRIVziCC1X6x/preview" style="width:100%;height:800px;"></iframe>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="nam2017_2018">
                        <iframe src="https://drive.google.com/file/d/1CxdjV1QIr7JauA3f9suxKBj-6UsfIxQZ/preview" style="width:100%;height:800px;"></iframe>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="nam2016">
                        <iframe src="https://drive.google.com/file/d/1IwODiA5o4spGUkfSJVgibymY4zKtRsKG/preview" style="width:100%;height:800px;"></iframe>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="nam2015">
                        <iframe src="https://drive.google.com/file/d/1BhJKdp53wr8ER6Y41AAnRmwd3yfqzwj-/preview" style="width:100%;height:800px;"></iframe>
                    </div>
                </div><!-- Tab Content -->
            </div><!-- Tab -->
        </div>
    </div>
</div>
@endsection
