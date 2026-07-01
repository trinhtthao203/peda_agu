@extends('Frontend.layout')
@section('title', __('About - Strategic Development'))
@section('body')
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>Strategic Development</h4>
            <div class="row">
                <div class="col-sm-4">
                    <div class="course-wrapper chien-luoc-phat-trien">
                        <div class="course-banner-wrap">
                            <img width="600" height="220" src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/doi-moi-phuong-phap-day-va-hoc.jpg" class="img-responsive" title="Creating a positive, effective, and creative environment for teaching and learning">
                        </div>
                        <div class="course-detail-wrap">
                            <div class="course-content">
                                <h5>Creating a positive, effective, and creative environment for teaching and learning</h5>
                                <p>Opening more training majors, improving training program quality; Creating an active and connective teaching & learning environment; Synchronizing and modernizing facilities; Utilizing information technology and automation in teaching & learning.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="course-wrapper chien-luoc-phat-trien">
                        <div class="course-banner-wrap">
                            <img width="600" height="220" src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/phat-trien-doi-ngu.jpg" class="img-responsive" title="Developing an autonomous organization and developing human resources in accordance with global standards">
                        </div>
                        <div class="course-detail-wrap">
                            <div class="course-content">
                                <h5>Developing an autonomous organization and developing human resources in accordance with global standards</h5>
                                <p>Devising a competent organization and staff system that can develop autonomously and sustainably; Improving foreign language capability and applying Fourth Industrial Revolution achievements; Training staff and lecturers with qualifications that can meet the standards in ASEAN region; Applying policies on attracting and giving incentives for high skilled staff.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="course-wrapper chien-luoc-phat-trien">
                        <div class="course-banner-wrap">
                            <img width="600" height="220" src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/tang-cuong-nang-luc-nghien-cuu.jpg" class="img-responsive" title="Enhancing quality in research, scientific application and technology transfer to aid the training process and community">
                        </div>
                        <div class="course-detail-wrap">
                            <div class="course-content">
                                <h5>Enhancing quality in research, scientific application and technology transfer to aid the training process and community</h5>
                                <p>Enhancing quality in research, scientific application and technology transfer to aid the training process and the community; Increasing the number of international publications.</p>
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
                            <img width="600" height="220" src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/phat-trien-hop-tac-quoc-te.jpg" class="img-responsive" title="Promoting international cooperation and commercializing the AGU trademark">
                        </div>
                        <div class="course-detail-wrap">
                            <div class="course-content">
                                <h5>Promoting international cooperation and commercializing the AGU trademark</h5>
                                <p>Promoting international cooperation; Focusing on promotion and advertisement; Promoting the commercialization of the “AGU” trademark; and Improving community service effectiveness.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="course-wrapper chien-luoc-phat-trien">
                        <div class="course-banner-wrap">
                            <img width="600" height="220" src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/he-thong-quan-ly.jpg" class="img-responsive" title="Establishing an advanced administrative system">
                        </div>
                        <div class="course-detail-wrap">
                            <div class="course-content">
                                <h5>Establishing an advanced administrative system</h5>
                                <p>Utilizing advanced administrative systems; Utilizing information technology to enhance management effectiveness; and Promoting quality assurance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
