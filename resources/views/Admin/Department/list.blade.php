@extends('Admin.layout')
@section('title', 'Danh sách Đơn vị')
@section('body')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý Đơn vị</h1>
        <a href="{{ route('admin-department-add') }}" class="btn btn-primary shadow-sm">➕ Thêm mới</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->first('delete'))
    <div class="alert alert-danger">{{ $errors->first('delete') }}</div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-sm">
                    <thead class="bg-light font-weight-bold text-gray-700">
                        <tr>
                            <th class="pl-4">STT</th>
                            <th>Tên đơn vị</th>
                            <th>Loại</th>
                            <th>Thứ tự</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center pr-4" style="width: 150px;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 divide-y">
                        @forelse($danhsach as $index => $item)
                        <tr>
                            <td class="pl-4">{{ $danhsach->firstItem() + $index }}</td>
                            <td class="font-weight-bold text-gray-900">{{ $item->name }}</td>
                            <td>
                                @php
                                    $typeBadge = match($item->type) {
                                        'LEADERSHIP' => 'badge-danger',
                                        'ACADEMIC'   => 'badge-primary',
                                        'OFFICE'     => 'badge-secondary',
                                        default      => 'badge-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $typeBadge }} uppercase text-xs px-2 py-1">{{ $item->type }}</span>
                            </td>
                            <td>{{ $item->display_order }}</td>
                            <td class="text-center">
                                @if($item->is_active)
                                    <span class="badge badge-success">Hoạt động</span>
                                @else
                                    <span class="badge badge-warning">Tạm ẩn</span>
                                @endif
                            </td>
                            <td class="text-center pr-4">
                                <a href="{{ route('admin-department-edit', [app()->getLocale(), $item->_id]) }}" class="btn btn-sm btn-outline-primary mr-1">✏️ Sửa</a>
                                <a href="{{ route('admin-department-delete', [app()->getLocale(), $item->_id]) }}" onclick="return confirm('Bạn chắc chắn muốn xóa đơn vị này?')" class="btn btn-sm btn-outline-danger">🗑️ Xóa</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Chưa có đơn vị nào.</td>
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
