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
        @if (!empty($page['hinh_anh']))
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('{{ asset('storage/images/subinfo/' . $page['hinh_anh']) }}');"></div>
            <div class="absolute inset-0 bg-blue-950/80 backdrop-blur-[2px]"></div>
        @else
            <div class="absolute inset-0" style="background: {{ $randomGradient }};"></div>
            <div class="absolute inset-0 opacity-10"
                style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;"></div>
        @endif
        <div
            class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 flex flex-col lg:flex-row items-center justify-between gap-8 z-10">
            <div class="w-full {{ $cleanVideoId ? 'lg:w-3/5' : 'w-full' }} space-y-4 text-left">
                @if (isset($nganhDaoTao))
                    @php
                        $heInfo = \App\Models\NganhDaoTao::HE_DAO_TAO[$nganhDaoTao->he_dao_tao] ?? null;
                        $heName = $heInfo ? ($isEn ? $heInfo['en'] : $heInfo['vi']) : $nganhDaoTao->he_dao_tao;
                    @endphp
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-xs font-semibold uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        {{ $heName }}
                    </div>
                @endif
                <h1
                    class="text-3xl sm:text-4xl lg:text-5xl font-heading font-black tracking-tight leading-tight drop-shadow-md">
                    {{ $page['ten'] }}
                </h1>
                @if (!empty($page['mo_ta']))
                    <p class="text-white/80 text-sm sm:text-base line-clamp-3 leading-relaxed max-w-2xl">
                        {{ $page['mo_ta'] }}
                    </p>
                @endif
                @if (isset($nganhDaoTao) && !empty($nganhDaoTao->ma_nganh))
                    <div class="pt-2 flex flex-wrap items-center gap-4">
                        <div
                            class="bg-white/10 backdrop-blur-md border border-white/20 px-4 py-2 rounded-lg inline-flex items-center gap-2">
                            <span class="text-xs text-white/70">{{ __('Mã ngành') }}:</span>
                            <span
                                class="text-sm font-mono font-bold tracking-wider text-yellow-300">{{ $nganhDaoTao->ma_nganh }}</span>
                        </div>
                    </div>
                @endif
            </div>
            @if ($cleanVideoId)
                <div class="w-full lg:w-2/5 flex justify-center lg:justify-end">
                    <div class="w-full max-w-md aspect-video rounded-2xl overflow-hidden shadow-2xl border-2 border-white/30 bg-black relative group cursor-pointer"
                        onclick="openVideoModal('{{ $cleanVideoId }}')">
                        <img src="{{ $ytThumbnail }}"
                            onerror="this.onerror=null; this.src='https://img.youtube.com/vi/{{ $cleanVideoId }}/hqdefault.jpg';"
                            alt="{{ $page['ten'] }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div
                            class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition duration-300 flex items-center justify-center">
                            <div
                                class="w-16 h-16 sm:w-20 sm:h-20 bg-red-600/90 group-hover:bg-red-600 rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition duration-300">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white translate-x-0.5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="absolute bottom-3 left-3 bg-black/60 backdrop-blur-sm text-white text-[11px] px-2.5 py-1 rounded-md flex items-center gap-1.5">
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

                @if (!empty($page['attachments']) && count($page['attachments']) > 0)
                    <div class="pt-8 border-t border-gray-100">
                        <h3
                            class="font-heading font-bold text-gray-900 text-base sm:text-lg mb-4 uppercase tracking-wide flex items-center gap-2">
                            📎 {{ __('Tài liệu / Tệp đính kèm') }}
                        </h3>
                        <div
                            class="divide-y divide-gray-100 border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm">
                            @foreach ($page['attachments'] as $k => $att)
                                @php
                                    $ext = strtolower($att['type'] ?? '');
                                    $canPreview = in_array($ext, ['pdf', 'doc', 'docx', 'xlsx', 'xls', 'ppt', 'pptx']);
                                @endphp
                                <div
                                    class="p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-gray-50/80 transition">
                                    <div class="flex items-start gap-3 min-w-0">
                                        <span
                                            class="p-2 bg-blue-50 text-blue-600 rounded-lg shrink-0 mt-0.5 font-bold uppercase text-xs">
                                            {{ $ext ?: 'FILE' }}
                                        </span>
                                        <div class="min-w-0">
                                            <p class="font-semibold text-gray-800 text-sm truncate mb-0">
                                                {{ $att['title'] ?? $att['filename'] }}
                                            </p>
                                            <small class="text-gray-400 text-xs">
                                                {{ round(($att['size'] ?? 0) / 1024, 1) }} KB
                                            </small>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 shrink-0 self-end sm:self-center">
                                        @if ($canPreview)
                                            <a href="{{ url(app()->getLocale() . '/xem-truc-tuyen-subinfo/' . $page['_id'] . '/' . $k) }}"
                                                target="_blank"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-md transition">
                                                👁️ {{ __('Xem trực tuyến') }}
                                            </a>
                                        @endif
                                        <a href="{{ url(app()->getLocale() . '/tai-ve-subinfo/' . $page['_id'] . '/' . $k) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-md shadow-sm transition">
                                            ⬇️ {{ __('Tải về') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (isset($danhSachNhanSu) && count($danhSachNhanSu) > 0)
                    <div class="pt-10 border-t border-gray-100">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-8">
                            <div>
                                <h3
                                    class="font-heading font-extrabold text-gray-900 text-xl sm:text-2xl tracking-tight flex items-center gap-2.5">
                                    <span
                                        class="p-2 rounded-xl bg-blue-50 text-blue-600 inline-flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                    </span>
                                    <span>{{ __('Đội ngũ Giảng viên - Cán bộ bộ môn') }}</span>
                                </h3>
                                <p class="text-sm text-gray-500 mt-1 pl-12">
                                    {{ __('Cán bộ giảng dạy và nghiên cứu khoa học chuyên trách') }}</p>
                            </div>
                            <span
                                class="self-start sm:self-auto px-3.5 py-1.5 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold border border-gray-200">
                                {{ count($danhSachNhanSu) }} {{ __('thành viên') }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 sm:gap-8">
                            @foreach ($danhSachNhanSu as $ns)
                                @php
                                    $hoTen = $isEn && !empty($ns['ho_ten_en']) ? $ns['ho_ten_en'] : $ns['ho_ten'] ?? '';
                                    $hocHamHocVi =
                                        $isEn && !empty($ns['hoc_ham_hoc_vi_en'])
                                            ? $ns['hoc_ham_hoc_vi_en']
                                            : $ns['hoc_ham_hoc_vi'] ?? '';
                                    $chuyenNganh =
                                        $isEn && !empty($ns['chuyen_nganh_en'])
                                            ? $ns['chuyen_nganh_en']
                                            : $ns['chuyen_nganh'] ?? '';

                                    $currentRole = collect($ns['departments'] ?? [])->first();
                                    if (isset($dept)) {
                                        $currentRole = collect($ns['departments'] ?? [])->firstWhere(
                                            'department_id',
                                            (string) $dept->_id,
                                        );
                                    }
                                    $chucVu = '';
                                    if (!empty($currentRole)) {
                                        $chucVu =
                                            $isEn && !empty($currentRole['chuc_vu_en'])
                                                ? $currentRole['chuc_vu_en']
                                                : $currentRole['chuc_vu'] ?? '';
                                    }
                                    $avatarUrl = !empty($ns['hinh_anh'])
                                        ? asset('storage/avatars/' . $ns['hinh_anh'])
                                        : asset('assets/frontend/images/default/avatar_placeholder.jpg');
                                @endphp

                                <div
                                    class="group relative bg-white rounded-3xl p-6 sm:p-7 border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_35px_-8px_rgba(14,165,233,0.15)] hover:border-blue-200 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1 overflow-hidden">
                                    <div
                                        class="absolute -right-12 -top-12 w-40 h-40 bg-gradient-to-br from-blue-50 to-indigo-50/20 rounded-full blur-2xl group-hover:scale-150 group-hover:from-blue-100 group-hover:to-cyan-100 transition-all duration-500 pointer-events-none">
                                    </div>

                                    <div>
                                        <div class="flex items-start gap-5 sm:gap-6">
                                            {{-- Avatar to, rõ nét và nổi bật --}}
                                            <div class="relative shrink-0">
                                                <div
                                                    class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 rounded-2xl overflow-hidden ring-4 ring-gray-50 group-hover:ring-blue-100 shadow-md group-hover:shadow-lg transition-all duration-300">
                                                    <img src="{{ $avatarUrl }}"
                                                        onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($hoTen) }}&background=0D8ABC&color=fff';"
                                                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500 ease-out"
                                                        alt="{{ $hoTen }}">
                                                </div>
                                                @if (!empty($currentRole['is_primary']))
                                                    <span
                                                        class="absolute -bottom-1 -right-1 w-6 h-6 bg-amber-400 text-white rounded-full flex items-center justify-center text-xs shadow border-2 border-white"
                                                        title="{{ __('Đơn vị chính') }}">★</span>
                                                @endif
                                            </div>

                                            {{-- Thông tin phân cấp từng dòng: Chức vụ -> Học hàm/học vị -> Họ tên --}}
                                            <div class="min-w-0 flex-1 space-y-1.5 pt-0.5">
                                                {{-- Dòng 1: Chức vụ --}}
                                                @if (!empty($chucVu))
                                                    <div>
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100/70 tracking-wide">
                                                            {{ $chucVu }}
                                                        </span>
                                                    </div>
                                                @endif

                                                {{-- Dòng 2: Học hàm / Học vị --}}
                                                @if (!empty($hocHamHocVi))
                                                    <div
                                                        class="text-xs sm:text-sm font-semibold text-gray-500 tracking-wide">
                                                        {{ $hocHamHocVi }}
                                                    </div>
                                                @endif

                                                {{-- Dòng 3: Họ và Tên --}}
                                                <h4
                                                    class="text-base sm:text-lg md:text-xl font-heading font-extrabold text-gray-900 group-hover:text-blue-600 transition-colors leading-snug [text-wrap:balance] break-words">
                                                    {{ $hoTen }}
                                                </h4>

                                                {{-- Chuyên ngành --}}
                                                @if (!empty($chuyenNganh))
                                                    <p
                                                        class="text-xs sm:text-sm text-gray-500 line-clamp-1 pt-1 font-medium flex items-center gap-1.5">
                                                        <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                                            </path>
                                                        </svg>
                                                        <span class="truncate">{{ $chuyenNganh }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Thông tin liên hệ --}}
                                        <div class="mt-5 pt-4 border-t border-gray-100/80 space-y-2">
                                            @if (!empty($ns['email']))
                                                <a href="mailto:{{ $ns['email'] }}"
                                                    class="flex items-center gap-2.5 text-xs sm:text-sm text-gray-600 hover:text-blue-600 transition-colors group/item truncate">
                                                    <div
                                                        class="w-7 h-7 rounded-lg bg-gray-50 group-hover/item:bg-blue-50 flex items-center justify-center text-gray-400 group-hover/item:text-blue-600 shrink-0 transition-colors">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <span class="truncate font-mono">{{ $ns['email'] }}</span>
                                                </a>
                                            @endif

                                            @if (!empty($ns['so_dien_thoai']))
                                                <a href="tel:{{ $ns['so_dien_thoai'] }}"
                                                    class="flex items-center gap-2.5 text-xs sm:text-sm text-gray-600 hover:text-green-600 transition-colors group/item truncate">
                                                    <div
                                                        class="w-7 h-7 rounded-lg bg-gray-50 group-hover/item:bg-green-50 flex items-center justify-center text-gray-400 group-hover/item:text-green-600 shrink-0 transition-colors">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <span class="font-mono">{{ $ns['so_dien_thoai'] }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    @if (isset($ns['ly_lich_khoa_hoc']['aliasname']))
                                        <div class="mt-5 pt-3">
                                            <a href="{{ asset('storage/files/' . $ns['ly_lich_khoa_hoc']['aliasname']) }}"
                                                target="_blank"
                                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-gray-700 bg-gray-50 hover:bg-blue-600 hover:text-white border border-gray-200/80 hover:border-transparent transition-all duration-200 shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <span>{{ __('Xem Lý lịch khoa học') }}</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div id="videoModal"
        class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
        <div class="relative w-full max-w-4xl bg-black rounded-2xl overflow-hidden shadow-2xl border border-white/20">
            <button type="button" onclick="closeVideoModal()"
                class="absolute top-3 right-3 z-10 w-9 h-9 flex items-center justify-center rounded-full bg-black/70 hover:bg-red-600 text-white transition text-lg font-bold">
                ✕
            </button>
            <div class="aspect-video w-full bg-black">
                <iframe id="modalVideoFrame" class="w-full h-full" src="" title="YouTube Video" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="no-referrer-when-downgrade" allowfullscreen>
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
