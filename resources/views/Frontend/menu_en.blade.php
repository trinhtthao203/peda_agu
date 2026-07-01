<ul class="nav nav-pills nav-main" id="mainMenu">
    <li class="dropdown mega-menu-item mega-menu-fullwidth">
        <a class="dropdown-toggle" href="#"> Introduction <i class="fa fa-caret-down"></i></a>
        <ul class="dropdown-menu">
            <li>
                <div class="mega-menu-content">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">An Giang University</span>
                                    <ul class="sub-menu">
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/overview">Overview</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/structure-and-organization">Structure and Organization</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/president-board">President board</a></li>
                                        
                                        {{-- <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/message-from-the-rector">Message from the Rector</a></li> --}}
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/mission-vision-core-value">Mission - Vision - Core value</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/quality-asssurance-policy">Quality Assurance Policy</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/strategic-plan">Development Strategies</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/brochure">Brochure</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">{{ __('Brief introduction') }}</span>
                                    <ul class="sub-menu">
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/annual-report">Annual Report</a></li>
                                        {{-- <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/timeline-of-agu">Timeline of AGU</a></li> --}}
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/video">Video</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/an-giang-university-song">An Giang University Song</a></li>
                                        <li><a href="http://25years.agu.edu.vn" target="_blank">25th Anniversary</a></li>
                                        <li><a href="{{ env('APP_URL') }}20years" target="_blank">20th Anniversary</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/gallery">Gallery</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/contacts">Contacts</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">{{ __('Services') }}</span>
                                    <ul class="sub-menu">
                                        <li><a href="https://mail.google.com/a/agu.edu.vn" target="_blank">Email</a></li>
                                        <li><a href="http://enews.agu.edu.vn/" target="_blank">eNews</a></li>
                                        <li><a href="https://regis.agu.edu.vn/" target="_blank">Register Courses</a></li>
                                        <li><a href="https://its.agu.edu.vn/" target="_blank">IT Resources</a></li>
                                        <li><a href="https://lib1.agu.edu.vn/SitePages/SearchOpac.aspx" target="_blank">Learning resources</a></li>
                                        <li><a href="https://ir.vnulib.edu.vn/home" target="_blank">Digital documents</a></li>
                                        <li><a href="https://lib.agu.edu.vn/co-so-du-lieu" target="_blank">E-Databases</a></li>
                                        {{-- <li><a href="https://docs.agu.edu.vn/tracuucongvan/" target="_blank">Documentary</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/gioi-thieu/bieu-mau">Forms</a></li>--}}
                                        <li><a href="https://epa.agu.edu.vn/" target="_blank">Laboratory practices and Equipment</a></li>
                                        <li><a href="https://cict.agu.edu.vn/danh-ba-dien-thoai" target="_blank">Contacts list</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        @php
                            $menu_tintuc = App\Models\DMThongTin::where('locale', '=', app()->getLocale())->where('thu_tu','>', 0)->orderBy('thu_tu', 'asc')->get();
                        @endphp
                        @if($menu_tintuc)
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">News and Events</span>
                                    <ul class="sub-menu">
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/lastest-news">Lastest News</a></li>
                                        @foreach($menu_tintuc as $tt)
                                            <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/{{ $tt['slug'] }}">{{ $tt['ten'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </li>
        </ul>
    </li>
    <li class="dropdown mega-menu-item mega-menu-fullwidth">
        <a class="dropdown-toggle" href="#">Training & QA  <i class="fa fa-caret-down"></i></a>
        <ul class="dropdown-menu">
            <li>
                <div class="mega-menu-content">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Programs and Courses</span>
                                    <ul class="sub-menu">
                                        <li><a href="https://pgd.agu.edu.vn" target="_blank">Graduate programs</a></li>
                                        <li><a href="https://aao.agu.edu.vn/?q=content/ct%C4%91t-tr%C3%ACnh-%C4%91%E1%BB%99-%C4%91%E1%BA%A1i-h%E1%BB%8Dc" target="_blank">Undergraduate programs</a></li>
                                        {{-- <li><a href="https://aao.agu.edu.vn/?q=content/ct%C4%91t-tr%C3%ACnh-%C4%91%E1%BB%99-cao-%C4%91%E1%BA%B3ng" target="_blank">3-Year college programs</a></li> --}}
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        {{-- <div class="col-md-4">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Annual Recruitment</span>
                                    <ul class="sub-menu">
                                        <li><a href="http://www.agu.edu.vn/tuyensinh">Admissions information</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/enrollment-guides">Enrollment Guides</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/programs-in-approval-process">Programs in Approval Process</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div> --}}
                        <div class="col-md-6">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Quality Assurance</span>
                                    <ul class="sub-menu">
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/self-evaluation-report">Self-evaluation Report</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/training-program-quality-assurement">Training program Quality Assurement</a></li>
                                        <li><a href="https://fms.agu.edu.vn/{{ app()->getLocale() }}" target="_blank">Quality Assurance System</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/quality-assurance-manual">Quality Assurance Manual</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </li>
    <li><a href="{{ env('APP_URL') }}vi/tuyen-sinh">Admissions</a></li>
    <li class="dropdown mega-menu-item mega-menu-fullwidth">
        <a class="dropdown-toggle" href="#"> Research & Cooperation <i class="fa fa-caret-down"></i></a>
        <ul class="dropdown-menu">
            <li>
                <div class="mega-menu-content">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Researches</span>
                                    <ul class="sub-menu">
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/research-activity">Research activity</a></li>
                                        <li><a href="https://dspace.agu.edu.vn:8080/handle/AGU_Library/2900" target="_blank">Science technology</a></li>
                                        <li><a href="http://sj.agu.edu.vn/" target="_blank">Journal of science</a></li>
                                        <li><a href="https://rmgo.agu.edu.vn/?q=vi/thong-bao-hoi-thao" target="_blank">Workshops</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">International activity</span>
                                    <ul class="sub-menu">
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/international-relations">International relations</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/memorandum-of-understanding">Memorandum of Understanding</a></li>
                                        <li><a href="https://sahed.agu.edu.vn/" target="_blank">SAHED Project</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </li>
    <li class="dropdown mega-menu-item mega-menu-fullwidth">
        <a class="dropdown-toggle" href="#"> Units <i class="fa fa-caret-down"></i></a>
        <ul class="dropdown-menu">
            <li>
                <div class="mega-menu-content">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Academic Units</span>
                                    <ul class="sub-menu">
                                        <li><a href="http://agri.agu.edu.vn/" target="_blank">Faculty of Agriculture and Natural Resources</a></li>
                                        <li><a href="http://tech.agu.edu.vn/" target="_blank">Faculty of Engineering - Technology - Environment</a></li>
                                        <li><a href="http://fit.agu.edu.vn/" target="_blank">Faculty of Information Technology</a></li>
                                        <li><a href="http://peda.agu.edu.vn/"  target="_blank">Faculty of Education</a></li>
                                        <li><a href="http://feba.agu.edu.vn/"  target="_blank">Faculty of Economics – Business & Administration</a></li>
                                        <li><a href="http://fpe.agu.edu.vn/"  target="_blank">Faculty of Law and Political Science</a></li>
                                        <li><a href="http://ffl.agu.edu.vn/"  target="_blank">Faculty of Foreign Languages</a></li>
                                        <li><a href="http://fac.agu.edu.vn/"  target="_blank">Faculty of Tourism – Culture – Arts</a></li>
                                        <li><a href="http://pe.agu.edu.vn/"  target="_blank">Department of Physical Education</a></li>
                                        <li><a href="http://nde.agu.edu.vn/"  target="_blank">Department of Defense Education</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Functional Units</span>
                                    <ul class="sub-menu">
                                        <li><a href="http://aao.agu.edu.vn/" target="_blank">Academic Affairs Office</a></li>
                                        <li><a href="http://exams.agu.edu.vn/" target="_blank">Examination and Quality Assurance office</a></li>
                                        <li><a href="http://exro.agu.edu.vn/" target="_blank">External Relations Office</a></li>
                                        <li><a href="http://rmgo.agu.edu.vn/" target="_blank">Science & Technology Office</a></li>
                                        <li><a href="http://ado.agu.edu.vn/" target="_blank">General Administrative Office</a></li>
                                        <li><a href="http://peo.agu.edu.vn/" target="_blank">Personnel Office</a></li>
                                        <li><a href="http://sao.agu.edu.vn/" target="_blank">Students Affairs Office</a></li>
                                        <li><a href="http://po.agu.edu.vn/" target="_blank">Property Office</a></li>
                                        <li><a href="http://pfo.agu.edu.vn/" target="_blank">Finance & Planning Office</a></li>
                                        <li><a href="http://lib.agu.edu.vn/" target="_blank">Library</a></li>
                                        <li><a href="http://ctepsd.agu.edu.vn" target="">Center for Teacher Training and Skills Development</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Career Units</span>
                                    <ul class="sub-menu">
                                        <li><a href="http://cci.agu.edu.vn/" target="_blank">Climate Change Institute</a></li>
                                        {{-- <li><a href="http://shrc.agu.edu.vn/" target="_blank">Research Center for Social Science & Humanities</a></li> --}}
                                        <li><a href="http://citfl.agu.edu.vn/" target="_blank">Center for Information Technology and Foreign Languages</a></li>
                                        {{-- -<li><a href="http://cflhrd.agu.edu.vn/" target="_blank">Center for Foreign Languages and Human Resource Development</a></li> --}}
                                        {{-- <li><a href="http://cfl.agu.edu.vn/" target="_blank">Center for Foreign Languages</a></li> --}}
                                        <li><a href="http://cds.agu.edu.vn/" target="_blank">Dormitory Service Center</a></li>
                                        <li><a href="http://pps.agu.edu.vn/" target="_blank">Pedagogical Practice School</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="sub-menu menu-border">
                                <li>
                                    <span class="mega-menu-sub-title">Political - Social Organizations</span>
                                    <ul class="sub-menu">
                                        <li><a href="http://cpv.agu.edu.vn/" target="_blank">Party committee</a></li>
                                        <li><a href="http://union.agu.edu.vn" target="_blank">Labor Union</a></li>
                                        <li><a href="http://youth.agu.edu.vn/" target="_blank">HCM Communist Youth Union</a></li>
                                        <li><a href="http://youth.agu.edu.vn/" target="_blank">Student Association</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/alumni-association">Alumni Association</a></li>
                                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/veteran-teachers-association">Veteran Teachers Association</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/publicity">Publicity</a>
    </li>
    <li><a href="https://lms.agu.edu.vn" target="_blank">LMS/LCMS</a></li>
</ul>
