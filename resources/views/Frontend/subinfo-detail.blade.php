@extends('Frontend.layout')
@section('title', $page['ten'])
@section('description', $page['mo_ta'])

@section('body')
@php
$isEn = app()->getLocale() === 'en';
$cleanVideoId = null;
if (!empty($page['video_ytb'])) {
preg_match('/[a-zA-Z0-9_-]{11}/', $page['video_ytb'], $matches);
$cleanVideoId = $matches[0] ?? null;
}
$ytThumbnail = $cleanVideoId ? 'https://img.youtube.com/vi/' . $cleanVideoId . '/maxresdefault.jpg' : null;
$gradients = [
'linear-gradient(135deg, #1e3c72 0%, #2a5298 100%)',
'linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%)',
'linear-gradient(135deg, #134e5e 0%, #71b280 100%)',
'linear-gradient(135deg, #1A2980 0%, #26D0CE 100%)',
'linear-gradient(135deg, #2c3e50 0%, #3498db 100%)',
];
$randomGradient = $gradients[crc32($page['slug']) % count($gradients)];
@endphp

<div class="relative w-full text-white overflow-hidden" style="min-height: 380px;">
    @if(!empty($page['hinh_anh']))
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('storage/images/subinfo/' . $page['hinh_anh']) }}');"></div>
    <div class="absolute inset-0 bg-blue-950/80 backdrop-blur-[2px]"></div>
    @else
    <div class="absolute inset-0" style="background: {{ $randomGradient }};"></div>
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;"></div>
    @endif
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 flex flex-col lg:flex-row items-center justify-between gap-8 z-10">
        <div class="w-full lg:w-3/5 space-y-4 text-left">
            @if(isset($nganhDaoTao))
            @php
            $heInfo = \App\Models\NganhDaoTao::HE_DAO_TAO[$nganhDaoTao->he_dao_tao] ?? null;
            $heName = $heInfo ? ($isEn ? $heInfo['en'] : $heInfo['vi']) : $nganhDaoTao->he_dao_tao;
            @endphp
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-xs font-semibold uppercase tracking-wider">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                {{ $heName }}
            </div>
            @endif
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-black tracking-tight leading-tight drop-shadow-md">
                {{ $page['ten'] }}
            </h1>
            @if(!empty($page['mo_ta']))
            <p class="text-white/80 text-sm sm:text-base line-clamp-3 leading-relaxed max-w-2xl">
                {{ $page['mo_ta'] }}
            </p>
            @endif
            @if(isset($nganhDaoTao) && !empty($nganhDaoTao->ma_nganh))
            <div class="pt-2 flex flex-wrap items-center gap-4">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 px-4 py-2 rounded-lg inline-flex items-center gap-2">
                    <span class="text-xs text-white/70">{{ __('Mã ngành') }}:</span>
                    <span class="text-sm font-mono font-bold tracking-wider text-yellow-300">{{ $nganhDaoTao->ma_nganh }}</span>
                </div>
            </div>
            @endif
        </div>
        @if($cleanVideoId)
        <div class="w-full lg:w-2/5 flex justify-center lg:justify-end">
            <div class="w-full max-w-md aspect-video rounded-2xl overflow-hidden shadow-2xl border-2 border-white/30 bg-black relative group cursor-pointer"
                onclick="openVideoModal('{{ $cleanVideoId }}')">
                <img src="{{ $ytThumbnail }}"
                    onerror="this.onerror=null; this.src='https://img.youtube.com/vi/{{ $cleanVideoId }}/hqdefault.jpg';"
                    alt="{{ $page['ten'] }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition duration-300 flex items-center justify-center">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-red-600/90 group-hover:bg-red-600 rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white translate-x-0.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </div>
                </div>
                <div class="absolute bottom-3 left-3 bg-black/60 backdrop-blur-sm text-white text-[11px] px-2.5 py-1 rounded-md flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                    <span>{{ __('Xem Video giới thiệu') }}</span>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 space-y-8">
            <div class="prose max-w-none text-gray-700 leading-relaxed font-sans text-sm sm:text-base">
                {!! $page['noi_dung'] !!}
            </div>
            @if(isset($danhSachNhanSu) && count($danhSachNhanSu) > 0)
            <div class="pt-10 border-t border-gray-100">
                <h3 class="font-heading font-bold text-gray-900 text-lg mb-6 uppercase tracking-wide flex items-center gap-2">
                    👨‍🏫 {{ __('Đội ngũ Giảng viên - Cán bộ bộ môn') }}
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($danhSachNhanSu as $ns)
                    @php
                    $hoTen = ($isEn && !empty($ns['ho_ten_en'])) ? $ns['ho_ten_en'] : ($ns['ho_ten'] ?? '');
                    $hocHamHocVi = ($isEn && !empty($ns['hoc_ham_hoc_vi_en'])) ? $ns['hoc_ham_hoc_vi_en'] : ($ns['hoc_ham_hoc_vi'] ?? '');

                    $currentRole = collect($ns['departments'] ?? [])->first();
                    if (isset($dept)) {
                    $currentRole = collect($ns['departments'] ?? [])->firstWhere('department_id', (string)$dept->_id);
                    }
                    $chucVu = '';
                    if (!empty($currentRole)) {
                    $chucVu = ($isEn && !empty($currentRole['chuc_vu_en'])) ? $currentRole['chuc_vu_en'] : ($currentRole['chuc_vu'] ?? '');
                    }
                    @endphp
                    <div class="bg-gray-50 rounded-xl border border-gray-200/60 p-5 flex gap-4 items-center hover:shadow-md transition duration-300">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-gray-200 overflow-hidden shrink-0 border-2 border-white shadow-sm">
                            @if(!empty($ns['hinh_anh']))
                            <img src="{{ env('APP_URL') }}storage/avatars/{{ $ns['hinh_anh'] }}" class="w-full h-full object-cover" alt="{{ $hoTen }}">
                            @else
                            <img src="{{ env('APP_URL') }}assets/frontend/images/default/avatar_placeholder.jpg" class="w-full h-full object-cover" alt="No avatar">
                            @endif
                        </div>
                        <div class="space-y-1 min-w-0 flex-1">
                            <h4 class="text-sm font-heading font-bold text-gray-900 m-0 truncate">
                                {{ $hocHamHocVi ? $hocHamHocVi . '.' : '' }} {{ $hoTen }}
                            </h4>
                            @if(!empty($chucVu))
                            <p class="text-xs font-semibold text-agu-blue m-0 truncate">{{ $chucVu }}</p>
                            @endif
                            <p class="text-[11px] text-gray-400 truncate m-0">✉️ {{ $ns['email'] }}</p>
                            @if(isset($ns['ly_lich_khoa_hoc']['aliasname']))
                            <div class="pt-1">
                                <a href="{{ env('APP_URL') }}storage/files/{{ $ns['ly_lich_khoa_hoc']['aliasname'] }}" target="_blank" class="inline-flex items-center text-[10px] font-bold text-white bg-agu-green px-2 py-1 rounded hover:bg-green-700 transition">
                                    📑 {{ __('Lý lịch khoa học') }}
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<div id="videoModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    <div class="relative w-full max-w-4xl bg-black rounded-2xl overflow-hidden shadow-2xl border border-white/20">
        <button type="button"
            onclick="closeVideoModal()"
            class="absolute top-3 right-3 z-10 w-9 h-9 flex items-center justify-center rounded-full bg-black/70 hover:bg-red-600 text-white transition text-lg font-bold">
            ✕
        </button>
        <div class="aspect-video w-full bg-black">
            <iframe id="modalVideoFrame"
                class="w-full h-full"
                src=""
                title="YouTube Video"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="no-referrer-when-downgrade"
                allowfullscreen>
            </iframe>
        </div>
    </div>
</div>

<script>
    function openVideoModal(videoId) {
        var modal = document.getElementById('videoModal');
        var frame = document.getElementById('modalVideoFrame');
        frame.src = "https://www.youtube-nocookie.com/embed/" + videoId + "?autoplay=1&rel=0&enablejsapi=1";
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeVideoModal() {
        var modal = document.getElementById('videoModal');
        var frame = document.getElementById('modalVideoFrame');
        frame.src = "";
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    document.getElementById('videoModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeVideoModal();
        }
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeVideoModal();
        }
    });
</script>
@endsection