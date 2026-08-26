@extends('Admin.layout')
@section('title', 'Danh sách trang tĩnh HTML')
@section('body')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Quản lý Trang thông tin tĩnh') }}</h1>
        <a href="{{ route('admin-sub-info-add', [app()->getLocale()]) }}" class="btn btn-primary shadow-sm">➕ {{ __('Thêm trang mới') }}</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- BỘ LỌC TÌM KIẾM --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('admin-sub-info', [app()->getLocale()]) }}">
                <div class="form-row align-items-end">
                    <div class="col-md-4 mb-2">
                        <label class="small font-weight-bold text-gray-700 mb-1">{{ __('Tiêu đề hoặc Slug') }}</label>
                        <input type="text" name="keyword" class="form-control" placeholder="{{ __('Nhập từ khóa tìm kiếm...') }}" value="{{ request('keyword') }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="small font-weight-bold text-gray-700 mb-1">{{ __('Phân loại cụm (Type)') }}</label>
                        <select name="type" class="form-control">
                            <option value="">-- {{ __('Tất cả phân loại') }} --</option>
                            <option value="nhan-su" {{ request('type') == 'nhan-su' ? 'selected' : '' }}>Nhân sự / Bộ môn (nhan-su)</option>
                            <option value="dao-tao" {{ request('type') == 'dao-tao' ? 'selected' : '' }}>Đào tạo (dao-tao)</option>
                            <option value="gioi-thieu" {{ request('type') == 'gioi-thieu' ? 'selected' : '' }}>Giới thiệu (gioi-thieu)</option>
                            <option value="nckh" {{ request('type') == 'nckh' ? 'selected' : '' }}>Nghiên cứu khoa học (nckh)</option>
                            <option value="sinh-vien" {{ request('type') == 'sinh-vien' ? 'selected' : '' }}>Sinh viên (sinh-vien)</option>
                            <option value="dbcl" {{ request('type') == 'dbcl' ? 'selected' : '' }}>Đảm bảo chất lượng (dbcl)</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="small font-weight-bold text-gray-700 mb-1">{{ __('Ngôn ngữ') }}</label>
                        <select name="locale" class="form-control">
                            <option value="">-- {{ __('Tất cả') }} --</option>
                            <option value="vi" {{ request('locale') == 'vi' ? 'selected' : '' }}>Tiếng Việt (vi)</option>
                            <option value="en" {{ request('locale') == 'en' ? 'selected' : '' }}>Tiếng Anh (en)</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2 d-flex">
                        <button type="submit" class="btn btn-primary mr-2 flex-fill"><i class="fas fa-search"></i> {{ __('Tìm kiếm') }}</button>
                        @if(request()->filled('keyword') || request()->filled('type') || request()->filled('locale'))
                        <a href="{{ route('admin-sub-info', [app()->getLocale()]) }}" class="btn btn-outline-secondary"><i class="fas fa-undo"></i></a>
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
                            <th class="pl-4" style="width: 70px;">{{ __('Ảnh') }}</th>
                            <th>{{ __('Tên trang') }}</th>
                            <th>{{ __('Phân loại (Type)') }}</th>
                            <th>{{ __('Đường dẫn (Slug)') }}</th>
                            <th class="text-center">{{ __('Video') }}</th>
                            <th class="text-center">{{ __('Ngôn ngữ') }}</th>
                            <th class="text-center">{{ __('Trạng thái') }}</th>
                            <th class="text-center pr-4" style="width: 150px;">{{ __('Hành động') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 divide-y">
                        @forelse($danhsach as $item)
                        <tr>
                            <td class="pl-4">
                                @if(!empty($item->hinh_anh))
                                <img src="{{ asset('storage/images/subinfo/' . $item->hinh_anh) }}" class="rounded border" style="width: 45px; height: 35px; object-fit: cover;">
                                @else
                                <span class="text-muted"><i class="far fa-image fa-2x"></i></span>
                                @endif
                            </td>
                            <td class="font-weight-bold text-gray-900">{{ $item->ten }}</td>
                            <td>
                                @php
                                $badge = match($item->type) {
                                'nhan-su' => 'badge-info',
                                'dao-tao' => 'badge-primary',
                                'gioi-thieu'=> 'badge-secondary',
                                'nckh' => 'badge-success',
                                'sinh-vien' => 'badge-warning',
                                'dbcl' => 'badge-danger',
                                default => 'badge-dark',
                                };
                                @endphp
                                <span class="badge {{ $badge }} uppercase text-xs px-2 py-1">{{ $item->type }}</span>
                            </td>
                            <td class="text-monospace text-xs text-muted">{{ $item->slug }}</td>
                            <td class="text-center">
                                @if(!empty($item->video_ytb))
                                <a href="https://www.youtube.com/watch?v={{ $item->video_ytb }}" target="_blank" class="text-danger font-weight-bold">
                                    <i class="fab fa-youtube fa-lg"></i>
                                </a>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $item->locale == 'vi' ? 'badge-success' : 'badge-warning' }} uppercase">
                                    {{ $item->locale }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $item->status == 1 ? 'badge-success' : 'badge-danger' }}">
                                    {{ $item->status == 1 ? __('Hiển thị') : __('Ẩn') }}
                                </span>
                            </td>
                            <td class="text-center pr-4">
                                <a href="{{ route('admin-sub-info-edit', [app()->getLocale(), $item->_id]) }}" class="btn btn-sm btn-outline-primary mr-1">✏️ {{ __('Sửa') }}</a>
                                <a href="{{ route('admin-sub-info-delete', [app()->getLocale(), $item->_id]) }}" onclick="return confirm('{{ __('Bạn chắc chắn muốn xóa trang này?') }}')" class="btn btn-sm btn-outline-danger">🗑️ {{ __('Xóa') }}</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">{{ __('Chưa có trang thông tin tĩnh nào.') }}</td>
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