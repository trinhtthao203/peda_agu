@extends('Admin.layout')
@section('title', 'Danh sách nhân sự giảng viên')
@section('body')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý Đội ngũ Giảng viên - Nhân sự</h1>
        <a href="{{ route('admin-nhan-su-add') }}" class="btn btn-primary shadow-sm">➕ Thêm giảng viên mới</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-sm">
                    <thead class="bg-light font-weight-bold text-gray-700">
                        <tr>
                            <th class="pl-4" style="width: 80px;">Hình ảnh</th>
                            <th>Họ và Tên</th>
                            <th>Đơn vị công tác</th>
                            <th>Học hàm / Học vị</th>
                            <th>Chuyên ngành</th>
                            <th>Email công vụ</th>
                            <th class="text-center pr-4" style="width: 150px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 divide-y">
                        @forelse($danhsach as $item)
                        <tr>
                            <td class="pl-4">
                                <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-100 border" style="width: 40px; height: 40px;">
                                    @if($item->hinh_anh)
                                    <img src="{{ asset('storage/avatars/' . $item->hinh_anh) }}" class="w-full h-full object-cover" style="width: 100%; height: 100%;">
                                    @else
                                    <span class="text-muted d-flex align-items-center justify-content-center h-100">👤</span>
                                    @endif
                                </div>
                            </td>
                            <td class="font-weight-bold text-gray-900">{{ $item->ho_ten }}</td>
                            <td>
                                @if(!empty($item->departments))
                                    @foreach($item->departments as $entry)
                                        <span class="badge {{ $entry['is_primary'] ? 'badge-primary' : 'badge-secondary' }} mr-1 mb-1">
                                            {{ $entry['department_name'] ?? '' }}
                                            @if($entry['is_primary'])<small> ★</small>@endif
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-muted small">Chưa phân đơn vị</span>
                                @endif
                            </td>
                            <td class="text-monospace-xs text-muted">{{ $item->hoc_ham_hoc_vi }}</td>
                            <td class="text-xs text-muted">{{ $item->chuyen_nganh }}</td>
                            <td class="text-monospace text-xs">{{ $item->email }}</td>
                            <td class="text-center pr-4">
                                <a href="{{ route('admin-nhan-su-edit', [app()->getLocale(), $item->_id]) }}" class="btn btn-sm btn-outline-primary mr-1">✏️ Sửa</a>
                                <a href="{{ route('admin-nhan-su-delete', [app()->getLocale(), $item->_id]) }}" onclick="return confirm('Bạn chắc chắn muốn xóa nhân sự này khỏi bộ môn?')" class="btn btn-sm btn-outline-danger">🗑️ Xóa</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Chưa có cán bộ giảng viên nào được khai báo.</td>
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