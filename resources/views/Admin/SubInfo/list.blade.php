@extends('Admin.layout')
@section('title', 'Danh sách trang tĩnh HTML')
@section('body')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý Trang thông tin tĩnh</h1>
        <a href="{{ route('admin-sub-info-add') }}" class="btn btn-primary shadow-sm">➕ Thêm trang mới</a>
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
                            <th class="pl-4">Tên trang</th>
                            <th>Phân loại (Type)</th>
                            <th>Đường dẫn (Slug)</th>
                            <th class="text-center">Ngôn ngữ</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center pr-4" style="width: 150px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 divide-y">
                        @forelse($danhsach as $item)
                        <tr>
                            <td class="pl-4 font-weight-bold text-gray-900">{{ $item->ten }}</td>
                            <td><span class="badge badge-secondary uppercase text-xs px-2 py-1">{{ $item->type }}</span></td>
                            <td class="text-monospace text-xs text-muted">{{ $item->slug }}</td>
                            <td class="text-center">
                                <span class="badge {{ $item->locale == 'vi' ? 'badge-info' : 'badge-warning' }} uppercase">
                                    {{ $item->locale }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $item->status == 1 ? 'badge-success' : 'badge-danger' }}">
                                    {{ $item->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                                </span>
                            </td>
                            <td class="text-center pr-4">
                                <a href="{{ route('admin-sub-info-edit', [app()->getLocale(), $item->_id]) }}" class="btn btn-sm btn-outline-primary mr-1">✏️ Sửa</a>
                                <a href="{{ route('admin-sub-info-delete', [app()->getLocale(), $item->_id]) }}" onclick="return confirm('Bạn chắc chắn muốn xóa trang này?')" class="btn btn-sm btn-outline-danger">🗑️ Xóa</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Chưa có trang thông tin tĩnh nào được tạo.</td>
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