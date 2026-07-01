@extends('Frontend.layout')
@section('title', __('Giới thiệu - Liên hệ'))
@section('body')
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Thông tin liên hệ</h4>
            <hr />
            <div class="container pad-top-50">
                <div class="row">
                     <!-- Column -->
                    <div class="col-sm-12 col-md-12">
                        <div class="contact-info">
                            <div class="info-icon bg-blue">
                                <i class="uni-map-marker"></i>
                            </div>
                            <h5 class="title">{{ __('Ban Biên tập Trang Thông tin điện tử Trường Đại Học An Giang') }}</h5>
                            <p><strong>{{ __('Địa chỉ: Số 18, đường Ung Văn Khiêm, Phường Long Xuyên, Tỉnh An Giang') }}</strong></p>
                        </div><!-- Contact Info -->
                    </div><!-- Column -->
                </div>
            </div>
            <div class="container" style="margin-top:50px">
                <div class="row">
                    <!-- Column -->
                    <div class="col-sm-12 col-md-4">
                        <div class="contact-info">
                            <div class="info-icon bg-blue">
                                <i class="uni-mail"></i>
                            </div>
                            <h5 class="title">Email</h5>
                            <p><a href="mailto:webmaster@agu.edu.vn"><strong>webmaster@agu.edu.vn</strong></a></p>
                        </div><!-- Contact Info -->
                    </div><!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-12 col-md-4">
                        <div class="contact-info">
                            <div class="info-icon bg-blue">
                                <i class="uni-phone-2"></i>
                            </div>
                            <h5 class="title">Điện thoại</h5>
                            <p><strong>+84 296 6256565 ext 1900</strong></p>
                        </div><!-- Contact Info -->
                    </div><!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-4">
                        <div class="contact-info">
                            <div class="info-icon bg-blue">
                                <i class="uni-cash-register2"></i>
                            </div>
                            <h5 class="title">Fax</h5>
                            <p><strong>+84 296 3842560</strong></p>
                        </div><!-- Contact Info -->
                    </div><!-- Column -->
                </div><!-- Row -->
            </div><!-- Container -->
            <div class="container" style="margin-top:50px">
                <div class="row">
                    <div class="full-screen map-canvas"
                         style=""
                         data-zoom="14"
                         data-lat="10.3711416"
                         data-lng="105.4322978"
                         data-title="An Giang University"
                         data-type="roadmap"
                         data-hue="#2196F3"
                         data-content="An Giang university&lt;br&gt; Contact: +84 296 6256565 ext 1900&lt;br&gt; webmaster@agu.edu.vn">
                    </div><!-- Map -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
