<ul class="nav-main flex items-center space-x-1">
    <li>
        <a href="{{ url('/') }}">{{ __('Home') }}</a>
    </li>

    <li>
        <a href="#">{{ __('Introduction') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('An Giang University') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/overview" class="hover:text-agu-blue transition">{{ __('Overview') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/structure-and-organization" class="hover:text-agu-blue transition">{{ __('Structure & Organization') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/president-board" class="hover:text-agu-blue transition">{{ __('President Board') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/mission-vision-core-value" class="hover:text-agu-blue transition">{{ __('Mission - Vision') }}</a></li>
                    </ul>
                </div>

                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Brief Introduction') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="https://25years.agu.edu.vn/" target="_blank" class="hover:text-agu-blue transition">{{ __('25th Anniversary') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/annual-report" class="hover:text-agu-blue transition">{{ __('Annual Report') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/about/contacts" class="hover:text-agu-blue transition">{{ __('Contacts') }}</a></li>
                    </ul>
                </div>

                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Services') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="https://mail.google.com/a/agu.edu.vn" target="_blank" class="hover:text-agu-blue transition">{{ __('Official Email') }}</a></li>
                        <li><a href="https://regis.agu.edu.vn/" target="_blank" class="hover:text-agu-blue transition">{{ __('Register Courses') }}</a></li>
                        <li><a href="https://opac.vnulib.edu.vn/" target="_blank" class="hover:text-agu-blue transition">{{ __('Learning Resources') }}</a></li>
                    </ul>
                </div>

                @if($menu_tintuc)
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('News & Events') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/lastest-news" class="hover:text-agu-blue transition">{{ __('Latest News') }}</a></li>
                        @foreach($menu_tintuc as $tt)
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/{{ $tt['slug'] }}" class="hover:text-agu-blue transition">{{ $tt['ten'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </li>

    <li>
        <a href="#">{{ __('Training & QA') }} <span class="text-[10px] ml-1">▼</span></a>
        <div class="mega-menu-dropdown left-0 p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Programs') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="https://pgd.agu.edu.vn" target="_blank" class="hover:text-agu-blue transition">{{ __('Graduate Programs') }}</a></li>
                        <li><a href="https://aao.agu.edu.vn/" target="_blank" class="hover:text-agu-blue transition">{{ __('Undergraduate Programs') }}</a></li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <span class="block font-heading font-bold text-agu-blue border-b border-gray-100 pb-2 text-sm uppercase">{{ __('Quality Assurance') }}</span>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/self-evaluation-report" class="hover:text-agu-blue transition">{{ __('Self-evaluation Report') }}</a></li>
                        <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/quality-assurance-manual" class="hover:text-agu-blue transition">{{ __('Quality Assurance Manual') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>

    <li><a href="https://tuyensinh.agu.edu.vn" target="_blank">{{ __('Admissions') }}</a></li>
    <li><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/news-and-events/publicity">{{ __('Publicity') }}</a></li>
    <li><a href="https://lms.agu.edu.vn" target="_blank">LMS/LCMS</a></li>
</ul>
