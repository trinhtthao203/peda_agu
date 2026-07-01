@extends('Frontend.layout')
@section('title', __('Giới thiệu - Ban Giám hiệu'))
@section('body')
<section class="bg-grey typo-dark">
    <div class="container">
        <div class="row">
            <!-- Title -->
            <div class="col-sm-12">
                <div class="title-container">
                    <div class="title-wrap">
                        <h3 class="title">Ban Giám hiệu</h3>
                        <span class="separator line-separator"></span>
                    </div>
                </div>
            </div><!-- Title -->
        </div><!-- Row -->
        {{-- <div class="row border-style">
            <div class="col-sm-3">
            </div><!-- Column -->
            <div class="col-sm-6">
                <!-- Member Wrap -->
                <div class="member-wrap">
                    <!-- Member Image Wrap -->
                    <div class="member-img-wrap">
                        <img width="600" height="500" src="{{ env('APP_URL') }}assets/frontend/images/teacher/thay_thang.png" alt="Member" class="img-responsive">
                    </div>
                    <!-- Member detail Wrapper -->
                    <div class="member-detail-wrap bg-white">
                        <h5 class="member-name"><strong>PGS.TS. Võ Văn Thắng</strong></h5>
                        <h5>Hiệu Trưởng</h5>
                        <h5>Email: <a href="mailto:vvthang@agu.edu.vn">vvthang@agu.edu.vn</a></h5>
                        <h5>Điện thoại: <a href="mailto:+84 296 6256565">+84 296 6256565 ext 1999</a></h5>
                    </div><!-- Member detail Wrapper -->
                </div><!-- Member Wrap -->
            </div><!-- Column -->
            <div class="col-sm-3">
            </div><!-- Column -->
        </div><!-- Row -->
        <br /> <br /> --}}
        <div class="row border-style">
            <div class="col-sm-3">
            </div><!-- Column -->
            <div class="col-sm-6">
                <!-- Member Wrap -->
                <div class="member-wrap">
                    <!-- Member Image Wrap -->
                    <div class="member-img-wrap">
                        <img width="600" height="500" src="{{ env('APP_URL') }}assets/frontend/images/teacher/thay_tri.png" alt="Member" class="img-responsive">
                    </div>
                    <!-- Member detail Wrapper -->
                    <div class="member-detail-wrap bg-white">
                        <h5 class="member-name"><strong>TS. Nguyễn Hữu Trí</strong></h5>
                        <h5>Phó Hiệu Trưởng (Phụ trách)</h5>
                        <h5>Email: <a href="mailto:nhtri@agu.edu.vn">nhtri@agu.edu.vn</a></h5>
                        <h5>Điện thoại: <a href="mailto:+84 296 6256565">+84 296 6256565 ext 1888</a></h5>
                        
                    </div><!-- Member detail Wrapper -->
                </div><!-- Member Wrap -->
            </div><!-- Column -->
            <div class="col-sm-3">
            </div><!-- Column -->
        </div><!-- Row -->
        <br /><br />
        <div class="row border-style">
            <div class="col-sm-3">
            </div><!-- Column -->
            <div class="col-sm-6">
                <!-- Member Wrap -->
                <div class="member-wrap">
                    <!-- Member Image Wrap -->
                    <div class="member-img-wrap">
                        <img width="600" height="500" src="{{ env('APP_URL') }}assets/frontend/images/teacher/npthao.png" alt="Member" class="img-responsive">
                    </div>
                    <!-- Member detail Wrapper -->
                    <div class="member-detail-wrap bg-white">
                        <h5 class="member-name"><strong>TS. Nguyễn Phương Thảo</strong></h5>
                        <h5>Phó Hiệu Trưởng</h5>
                        <h5>Email: <a href="mailto:npthao@agu.edu.vn">npthao@agu.edu.vn</a></h5>
                        <h5>Điện thoại: <a href="mailto:+84 296 6256565">+84 296 6256565 ext 1666</a></h5>
                    </div><!-- Member detail Wrapper -->
                </div><!-- Member Wrap -->
            </div><!-- Column -->
            <div class="col-sm-3">
            </div><!-- Column -->
        </div>
    </div><!-- Container -->
</section>

@endsection
