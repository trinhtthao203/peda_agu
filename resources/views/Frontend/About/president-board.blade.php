@extends('Frontend.layout')
@section('title', __('About - President Board'))
@section('body')
<section class="bg-grey typo-dark">
    <div class="container">
        <div class="row">
            <!-- Title -->
            <div class="col-sm-12">
                <div class="title-container">
                    <div class="title-wrap">
                        <h3 class="title">President Board</h3>
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
                        <h5 class="member-name"><strong>Assoc. Prof. Dr Vo Van Thang</strong></h5>
                        <h5>President</h5>
                        <h5>Email: <a href="mailto:vvthang@agu.edu.vn">vvthang@agu.edu.vn</a></h5>
                        <h5>Tel: <a href="mailto:+84 296 6256565">+84 296 6256565 ext 1999</a></h5>
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
                        <h5 class="member-name"><strong>Dr Nguyen Huu Tri</strong></h5>
                        <h5>Vice President</h5>
                        <h5>Email: <a href="mailto:nhtri@agu.edu.vn">nhtri@agu.edu.vn</a></h5>
                        <h5>Tel: <a href="mailto:+84 296 6256565">+84 296 6256565 ext 1888</a></h5>
                        
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
                        <h5 class="member-name"><strong>Dr Nguyen Phuong Thao</strong></h5>
                        <h5>Vice President</h5>
                        <h5>Email: <a href="mailto:npthao@agu.edu.vn">npthao@agu.edu.vn</a></h5>
                        <h5>Tel: <a href="mailto:+84 296 6256565">+84 296 6256565 ext 1666</a></h5>
                        
                    </div><!-- Member detail Wrapper -->
                </div><!-- Member Wrap -->
            </div><!-- Column -->
            <div class="col-sm-3">
            </div><!-- Column -->
        </div><!-- Row -->
    </div><!-- Container -->
</section>
@endsection
