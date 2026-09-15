@extends('Admin.layout')
@section('title', 'Danh sách nhân sự giảng viên')
@section('body')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('Quản lý Đội ngũ Giảng viên - Nhân sự') }}</h1>
            <a href="{{ route('admin-nhan-su-add', [app()->getLocale()]) }}" class="btn btn-primary shadow-sm">➕
                {{ __('Thêm giảng viên mới') }}</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- BỘ LỌC TÌM KIẾM --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body p-3">
                <form method="GET" action="{{ route('admin-nhan-su', [app()->getLocale()]) }}">
                    <div class="form-row align-items-end">
                        <div class="col-md-5 mb-2">
                            <label
                                class="small font-weight-bold text-gray-700 mb-1">{{ __('Họ tên, Email hoặc Số điện thoại') }}</label>
                            <input type="text" name="keyword" class="form-control"
                                placeholder="{{ __('Nhập họ tên (VI/EN), email hoặc số điện thoại...') }}"
                                value="{{ request('keyword') }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="small font-weight-bold text-gray-700 mb-1">{{ __('Đơn vị công tác') }}</label>
                            <select name="department_id" class="form-control">
                                <option value="">-- {{ __('Tất cả đơn vị') }} --</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->_id }}"
                                        {{ request('department_id') == (string) $dept->_id ? 'selected' : '' }}>
                                        {{ app()->getLocale() == 'en' && !empty($dept->name_en) ? $dept->name_en : $dept->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2 d-flex">
                            <button type="submit" class="btn btn-primary mr-2 flex-fill">
                                <i class="fas fa-search"></i> {{ __('Tìm kiếm') }}
                            </button>
                            @if (request()->filled('keyword') || request()->filled('department_id'))
                                <a href="{{ route('admin-nhan-su', [app()->getLocale()]) }}"
                                    class="btn btn-outline-secondary">
                                    <i class="fas fa-undo"></i> {{ __('Xóa lọc') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- BẢNG DANH SÁCH --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-sm">
                        <thead class="bg-light font-weight-bold text-gray-700">
                            <tr>
                                <th class="pl-4" style="width: 80px;">{{ __('Hình ảnh') }}</th>
                                <th>{{ __('Họ và tên') }}</th>
                                <th>{{ __('Đơn vị công tác') }}</th>
                                <th>{{ __('Học hàm / Học vị') }}</th>
                                <th>{{ __('Chuyên ngành') }}</th>
                                <th>{{ __('Liên hệ') }}</th>
                                <th class="text-center pr-4" style="width: 150px;">#</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 divide-y">
                            @php $isEn = app()->getLocale() === 'en'; @endphp
                            @forelse($danhsach as $item)
                                @php
                                    $displayName = $isEn && !empty($item->ho_ten_en) ? $item->ho_ten_en : $item->ho_ten;
                                    $displayDegree =
                                        $isEn && !empty($item->hoc_ham_hoc_vi_en)
                                            ? $item->hoc_ham_hoc_vi_en
                                            : $item->hoc_ham_hoc_vi;
                                    $displayMajor =
                                        $isEn && !empty($item->chuyen_nganh_en)
                                            ? $item->chuyen_nganh_en
                                            : $item->chuyen_nganh;
                                @endphp
                                <tr>
                                    <td class="pl-4">
                                        <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-100 border"
                                            style="width: 40px; height: 40px;">
                                            @if ($item->hinh_anh)
                                                <img src="{{ asset('storage/avatars/' . $item->hinh_anh) }}"
                                                    class="w-full h-full object-cover" style="width: 100%; height: 100%;">
                                            @else
                                                <span
                                                    class="text-muted d-flex align-items-center justify-content-center h-100">👤</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="font-weight-bold text-gray-900">{{ $displayName }}</div>
                                        @if ($item->ho_ten_en && !$isEn)
                                            <div class="small text-muted font-italic">{{ $item->ho_ten_en }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($item->departments))
                                            @foreach ($item->departments as $entry)
                                                @php
                                                    $deptName =
                                                        $isEn && !empty($entry['department_name_en'])
                                                            ? $entry['department_name_en']
                                                            : $entry['department_name'] ?? '';
                                                    $roleTitle =
                                                        $isEn && !empty($entry['chuc_vu_en'])
                                                            ? $entry['chuc_vu_en']
                                                            : $entry['chuc_vu'] ?? '';
                                                @endphp
                                                <span
                                                    class="badge {{ !empty($entry['is_primary']) ? 'badge-primary' : 'badge-secondary' }} mr-1 mb-1">
                                                    {{ $deptName }} @if ($roleTitle)
                                                        ({{ $roleTitle }})
                                                    @endif
                                                    @if (!empty($entry['is_primary']))
                                                        <small> ★</small>
                                                    @endif
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-muted small">{{ __('Chưa phân đơn vị') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-monospace-xs text-muted">{{ $displayDegree }}</td>
                                    <td class="text-xs text-muted">{{ $displayMajor }}</td>
                                    <td>
                                        <div class="text-monospace text-xs">{{ $item->email }}</div>
                                        @if ($item->so_dien_thoai)
                                            <div class="text-monospace text-xs text-muted">{{ $item->so_dien_thoai }}</div>
                                        @endif
                                    </td>
                                    <td class="text-center pr-4">
                                        <a href="{{ route('admin-nhan-su-edit', [app()->getLocale(), $item->_id]) }}"
                                            class="btn btn-sm btn-outline-primary mr-1">✏️ {{ __('Sửa') }}</a>
                                        <a href="{{ route('admin-nhan-su-delete', [app()->getLocale(), $item->_id]) }}"
                                            onclick="return confirm('{{ __('Bạn chắc chắn muốn xóa nhân sự này?') }}')"
                                            class="btn btn-sm btn-outline-danger">🗑️ {{ __('Xóa') }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        {{ __('Không tìm thấy cán bộ giảng viên phù hợp.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $danhsach->links() }}
        </div>
    </div>
@endsection
