@php
$banner = App\Models\Banner::where('locale','=',app()->getLocale())
->where('status', '=', 1)->where('trang_chu', '=', 1)
->orderBy('order','asc')->orderBy('updated_at', 'desc')->get();
@endphp

@if($banner && count($banner) > 0)
<div class="relative w-full overflow-hidden bg-gray-950 aspect-[1920/600] sm:max-h-[500px] md:max-h-[420px] lg:max-h-[600px]" id="agu-carousel">

    <div class="flex transition-transform duration-500 ease-in-out h-full" id="carousel-inner" style="transform: translateX(0%);">
        @foreach($banner as $index => $b)
        @if(isset($b['photos'][0]['aliasname']) && $b['photos'][0]['aliasname'])
        <div class="w-full h-full flex-shrink-0 relative">
            @if(isset($b['url']) && $b['url'])
            <a href="{{ $b['url'] }}" class="block w-full h-full">
                @endif

                <img src="{{ env('APP_URL') }}storage/images/origin/{{ $b['photos'][0]['aliasname'] }}"
                    alt="{{ __($b['title']) }}"
                    title="{{ __($b['title']) }}"
                    class="w-full h-full object-cover select-none pointer-events-none" />

                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20 pointer-events-none"></div>

                @if(isset($b['url']) && $b['url'])
            </a>
            @endif
        </div>
        @endif
        @endforeach
    </div>

    <button id="carousel-prev" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/40 text-white p-2.5 rounded-full hover:bg-agu-blue transition z-20 focus:outline-none hidden sm:block">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button id="carousel-next" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/40 text-white p-2.5 rounded-full hover:bg-agu-blue transition z-20 focus:outline-none hidden sm:block">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const inner = document.getElementById('carousel-inner');
        const items = inner.children;
        const totalItems = items.length;
        let currentIndex = 0;
        let interval;

        function showSlide(index) {
            if (index >= totalItems) currentIndex = 0;
            else if (index < 0) currentIndex = totalItems - 1;
            else currentIndex = index;

            inner.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        function startAutoPlay() {
            interval = setInterval(() => {
                showSlide(currentIndex + 1);
            }, 6000); // Tự chuyển đổi sau mỗi 6 giây hành chính
        }

        document.getElementById('carousel-next').addEventListener('click', () => {
            clearInterval(interval);
            showSlide(currentIndex + 1);
            startAutoPlay();
        });

        document.getElementById('carousel-prev').addEventListener('click', () => {
            clearInterval(interval);
            showSlide(currentIndex - 1);
            startAutoPlay();
        });

        startAutoPlay();
    });
</script>
@endif
