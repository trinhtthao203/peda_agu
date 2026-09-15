@php
    $taxonomy = app()->getLocale() == 'vi' ? 'tin-tuc-su-kien' : 'news-and-events';
@endphp

<ul class="nav-main flex items-center space-x-1">
    <li>
        <a href="{{ url('/') }}">{{ __('Home') }}</a>
    </li>

    <!-- 2. ABOUT (Mega Menu 2-3 cột) -->
    <li class="!static">
        <a href="#">{{ __('About') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 right-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Overview & Strategy') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/overview"
                                class="hover:text-agu-blue transition">{{ __('Overview') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/history"
                                class="hover:text-agu-blue transition">{{ __('History') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/mission-vision-core-values"
                                class="hover:text-agu-blue transition">{{ __('Mission - Vision - Core Values') }}</a>
                        </li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/contact"
                                class="hover:text-agu-blue transition">{{ __('Contact & Feedback') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Leadership') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/organization"
                                class="hover:text-agu-blue transition">{{ __('Organization') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/faculty-board"
                                class="hover:text-agu-blue transition">{{ __('Faculty Board') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/education-and-research-council"
                                class="hover:text-agu-blue transition">{{ __('Education & Research Council') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </li>

    <!-- 3. DEPARTMENTS (Mega Menu 2 cột) -->
    <li class="!static">
        <a href="#">{{ __('Departments') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 right-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Administration & Science') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/staff/faculty-office"
                                class="hover:text-agu-blue transition">{{ __('Faculty Office') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/staff/mathematics-department"
                                class="hover:text-agu-blue transition">{{ __('Mathematics Department') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/staff/department-of-physics-chemistry-biology"
                                class="hover:text-agu-blue transition">{{ __('Physics - Chemistry - Biology') }}</a>
                        </li>
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

        $subInfoDaoTaoEn = \App\Models\SubInfo::where('locale', 'en')
            ->where('type', 'dao-tao')
            ->where('status', 1)
            ->get()
            ->keyBy('slug');
    @endphp

    <!-- 4. ACADEMICS (Mega Menu 3 cột) -->
    <li class="!static">
        <a href="#">{{ __('Academics') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 right-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- 1. UNDERGRADUATE -->
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                        🎓 {{ __('Undergraduate Programs') }}
                    </span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        @forelse($nganhChinhQuy as $nganh)
                            @php $slugEn = $nganh->slug_en ?: $nganh->slug; @endphp
                            @if (isset($subInfoDaoTaoEn[$slugEn]))
                                <li>
                                    <a href="{{ env('APP_URL') }}en/academics/{{ $slugEn }}"
                                        class="hover:text-agu-blue transition block truncate">
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
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                        🏛️ {{ __('Postgraduate Programs') }}
                    </span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        @forelse($nganhSauDaiHoc as $nganh)
                            @php $slugEn = $nganh->slug_en ?: $nganh->slug; @endphp
                            @if (isset($subInfoDaoTaoEn[$slugEn]))
                                <li>
                                    <a href="{{ env('APP_URL') }}en/academics/{{ $slugEn }}"
                                        class="hover:text-agu-blue transition block truncate">
                                        • {{ $nganh->ten_en ?: $nganh->ten }}
                                    </a>
                                </li>
                            @endif
                        @empty
                            <li class="text-gray-400 italic">Updating...</li>
                        @endforelse
                    </ul>
                </div>

                <!-- 3. ACADEMIC RESOURCES -->
                <div class="space-y-3">
                    <span
                        class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                        📚 {{ __('Academic Resources') }}
                    </span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}en/academics/curriculum"
                                class="hover:text-agu-blue transition">{{ __('Curriculum') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}en/academics/course-syllabi"
                                class="hover:text-agu-blue transition">{{ __('Course Syllabi') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}en/academics/program-proposals"
                                class="hover:text-agu-blue transition">{{ __('Program Proposals') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>

    <!-- 5. RESEARCH (Dropdown 1 cột gọn gàng) -->
    <li class="relative group">
        <a href="#">{{ __('Research') }} <span class="text-[10px] ml-1">▼</span></a>
        <div
            class="mega-menu-dropdown absolute left-0 top-full hidden group-hover:block w-72 bg-white shadow-lg p-5 z-50">
            <div class="space-y-3">
                <span
                    class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                    {{ __('Projects') }}
                </span>
                <ul class="space-y-2 text-xs text-gray-600">
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/research/provincial-research"
                            class="hover:text-agu-blue transition">{{ __('Provincial Research') }}</a></li>
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/research/school-research"
                            class="hover:text-agu-blue transition">{{ __('School Research') }}</a></li>
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/research/faculty-research"
                            class="hover:text-agu-blue transition">{{ __('Faculty Research') }}</a></li>
                </ul>
            </div>
        </div>
    </li>

    <!-- QA (Dropdown 1 cột) -->
    <li class="relative group">
        <a href="#">{{ __('QA') }} <span class="text-[10px] ml-1">▼</span></a>
        <div
            class="mega-menu-dropdown absolute left-0 top-full hidden group-hover:block w-72 bg-white shadow-lg p-5 z-50">
            <div class="space-y-3">
                <span
                    class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">
                    {{ __('Quality Assurance') }}
                </span>
                <ul class="space-y-2 text-xs text-gray-600">
                    <li>
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/quality-assurance/quality-objectives"
                            class="hover:text-agu-blue transition">
                            {{ __('Quality objectives') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/quality-assurance/feedbacks"
                            class="hover:text-agu-blue transition">
                            {{ __('Feedbacks') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/quality-assurance/self-evaluation-reports"
                            class="hover:text-agu-blue transition">
                            {{ __('Self-evaluation reports') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </li>

    <!-- 7. STUDENTS (Mega Menu 1 cột) -->
    <li class="relative group">
        <a href="#">{{ __('Documents & Forms') }} <span class="text-[10px] ml-1">▼</span></a>
        <div
            class="mega-menu-dropdown absolute left-0 top-full hidden group-hover:block w-72 bg-white shadow-lg p-5 z-50">
            <div class="space-y-3">
                <ul class="space-y-2 text-xs text-gray-600">
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/students/procedures"
                            class="hover:text-agu-blue transition">{{ __('Procedures') }}</a></li>
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/students/documents"
                            class="hover:text-agu-blue transition">{{ __('Documents') }}</a></li>
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/students/forms"
                            class="hover:text-agu-blue transition">{{ __('Forms') }}</a></li>
                </ul>
            </div>
        </div>
    </li>

    <!-- 8. NEWS & EVENTS (Dropdown 1 cột gọn gàng - Không bị full màn hình) -->
    <li class="relative group">
        <a href="#">{{ __('News & Events') }} <span class="text-[10px] ml-1">▼</span></a>
        <div
            class="mega-menu-dropdown absolute left-0 top-full hidden group-hover:block w-72 bg-white shadow-lg p-5 z-50">
            <div class="space-y-3">
                <span
                    class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Media board') }}</span>
                <ul class="space-y-2 text-xs text-gray-600">
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/lastest-news"
                            class="hover:text-agu-blue transition font-semibold text-agu-blue">{{ __('🔥 Latest News') }}</a>
                    </li>
                    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/{{ $taxonomy }}/operational-news"
                            class="hover:text-agu-blue transition">{{ __('Operational News') }}</a></li>
                </ul>
            </div>
        </div>
    </li>
</ul>
