@php
$taxonomy = (app()->getLocale() == 'vi') ? 'tin-tuc-su-kien' : 'news-and-events';
@endphp

<ul class="nav-main flex items-center space-x-1">
    <li>
        <a href="{{ url('/') }}">{{ __('Home') }}</a>
    </li>
    <!-- 2. ABOUT -->
    <li>
        <a href="#">{{ __('About') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Overview & Strategy') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/overview" class="hover:text-agu-blue transition">{{ __('Overview') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/history" class="hover:text-agu-blue transition">{{ __('History') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/mission-vision-core-values" class="hover:text-agu-blue transition">{{ __('Mission - Vision - Core Values') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Leadership') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/organization" class="hover:text-agu-blue transition">{{ __('Organization') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/faculty-board" class="hover:text-agu-blue transition">{{ __('Faculty Board') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/education-and-research-council" class="hover:text-agu-blue transition">{{ __('Education & Research Council') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>

    <!-- 3. DEPARTMENTS (Chuyển sang đi qua prefix staff) -->
    <li>
        <a href="#">{{ __('Departments') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Administration & Science') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/staff/faculty-office" class="hover:text-agu-blue transition">{{ __('Faculty Office') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/staff/mathematics-department" class="hover:text-agu-blue transition">{{ __('Mathematics Department') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/staff/department-of-physics-chemistry-biology" class="hover:text-agu-blue transition">{{ __('Physics - Chemistry - Biology') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
    @php
    $taxonomy = 'news-and-events';

    $dsNganh = \App\Models\NganhDaoTao::active()->orderBy('display_order', 'asc')->get();
    $nganhChinhQuy = $dsNganh->where('he_dao_tao', 'DAI_HOC');
    $nganhSauDaiHoc = $dsNganh->where('he_dao_tao', 'SAU_DAI_HOC');

    $subInfoDaoTaoEn = \App\Models\SubInfo::where('locale', 'en')->where('type', 'dao-tao')->where('status', 1)->get()->keyBy('slug');
    @endphp

    <!-- Mục ACADEMICS TRONG MENU TIẾNG ANH -->
    <li class="!static">
        <a href="#">{{ __('Academics') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- 1. UNDERGRADUATE -->
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                        🎓 {{ __('Undergraduate Programs') }}
                    </span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        @forelse($nganhChinhQuy as $nganh)
                        @php $slugEn = $nganh->slug_en ?: $nganh->slug; @endphp
                        @if(isset($subInfoDaoTaoEn[$slugEn]))
                        <li>
                            <a href="{{ env('APP_URL') }}en/academics/{{ $slugEn }}" class="hover:text-agu-blue transition block truncate">
                                • {{ $nganh->ten_en ?: $nganh->ten }}
                            </a>
                        </li>
                        @endif
                        @empty
                        <li class="text-gray-400 italic">Updating...</li>
                        @endforelse
                    </ul>
                </div>

                <!-- 2. POSTGRADUATE -->
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                        🏛️ {{ __('Postgraduate Programs') }}
                    </span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        @forelse($nganhSauDaiHoc as $nganh)
                        @php $slugEn = $nganh->slug_en ?: $nganh->slug; @endphp
                        @if(isset($subInfoDaoTaoEn[$slugEn]))
                        <li>
                            <a href="{{ env('APP_URL') }}en/academics/{{ $slugEn }}" class="hover:text-agu-blue transition block truncate">
                                • {{ $nganh->ten_en ?: $nganh->ten }}
                            </a>
                        </li>
                        @endif
                        @empty
                        <li class="text-gray-400 italic">Updating...</li>
                        @endforelse
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                        📚 {{ __('Academic Resources') }}
                    </span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}en/academics/curriculum" class="hover:text-agu-blue transition">{{ __('Curriculum') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}en/academics/course-syllabi" class="hover:text-agu-blue transition">{{ __('Course Syllabi') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}en/academics/program-proposals" class="hover:text-agu-blue transition">{{ __('Program Proposals') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li class="!static">
        <a href="#">{{ __('Research') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Projects') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/research/provincial-research" class="hover:text-agu-blue transition">{{ __('Provincial Research') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/research/school-research" class="hover:text-agu-blue transition">{{ __('School Research') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/research/faculty-research" class="hover:text-agu-blue transition">{{ __('Faculty Research') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li class="!static">
        <a href="#">{{ __('QA') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Transparency') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/quality-assurance/public-disclosures" class="hover:text-agu-blue transition">{{ __('Public Disclosures') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Accreditation') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/quality-assurance/accreditation" class="hover:text-agu-blue transition">{{ __('Accreditation Standards') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Optimization') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/quality-assurance/continuous-improvement" class="hover:text-agu-blue transition">{{ __('Continuous Improvement') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li class="!static">
        <a href="#">{{ __('Students') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 right-0 mx-auto p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Education') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/students/academic-affairs" class="hover:text-agu-blue transition">{{ __('Academic Affairs') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Financial') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/students/scholarships-and-support" class="hover:text-agu-blue transition">{{ __('Scholarships & Support') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Forms hub') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/students/procedures" class="hover:text-agu-blue transition">{{ __('Procedures') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/students/documents" class="hover:text-agu-blue transition">{{ __('Documents') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/students/forms" class="hover:text-agu-blue transition">{{ __('Forms') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li class="!static">
        <a href="#">{{ __('News & Events') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 right-0 mx-auto p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Media board') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/lastest-news" class="hover:text-agu-blue transition font-semibold text-agu-blue">{{ __('🔥 Latest News') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/operational-news" class="hover:text-agu-blue transition">{{ __('Operational News') }}</a></li>
                        @if($menu_tintuc)
                        @foreach($menu_tintuc as $tt)
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/{{ $tt['slug'] }}" class="hover:text-agu-blue transition">{{ $tt['ten'] }}</a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </li>
</ul>