@extends('Admin.layout')
@section('title', 'Danh sách Ngành đào tạo')
@section('body')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Quản lý Ngành đào tạo') }}</h1>
        <a href="{{ route('admin-nganh-dao-tao-add', [app()->getLocale()]) }}" class="btn btn-primary shadow-sm">➕ {{ __('Thêm ngành mới') }}</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- BỘ LỌC --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('admin-nganh-dao-tao', [app()->getLocale()]) }}">
                <div class="form-row align-items-end">
                    <div class="col-md-5 mb-2">
                        <label class="small font-weight-bold text-gray-700 mb-1">{{ __('Tên ngành hoặc Mã ngành') }}</label>
                        <input type="text" name="keyword" class="form-control" placeholder="{{ __('Nhập tên ngành (VI/EN) hoặc mã ngành...') }}" value="{{ request('keyword') }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small font-weight-bold text-gray-700 mb-1">{{ __('Hệ đào tạo') }}</label>
                        <select name="he_dao_tao" class="form-control">
                            <option value="">-- {{ __('Tất cả hệ đào tạo') }} --</option>
                            @foreach($heDaoTaoList as $key => $val)
                            <option value="{{ $key }}" {{ request('he_dao_tao') == $key ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'en' ? $val['en'] : $val['vi'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2 d-flex">
                        <button type="submit" class="btn btn-primary mr-2 flex-fill"><i class="fas fa-search"></i> {{ __('Tìm kiếm') }}</button>
                        @if(request()->filled('keyword') || request()->filled('he_dao_tao'))
                        <a href="{{ route('admin-nganh-dao-tao', [app()->getLocale()]) }}" class="btn btn-outline-secondary"><i class="fas fa-undo"></i></a>
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
                            <th class="pl-4">STT</th>
                            <th>{{ __('Mã ngành') }}</th>
                            <th>{{ __('Tên ngành đào tạo (VI / EN)') }}</th>
                            <th>{{ __('Hệ đào tạo') }}</th>
                            <th>{{ __('Slug (VI / EN)') }}</th>
                            <th>{{ __('Thứ tự') }}</th>
                            <th class="text-center">{{ __('Trạng thái') }}</th>
                            <th class="text-center pr-4" style="width: 150px;">{{ __('Thao tác') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 divide-y">
                        @php $isEn = app()->getLocale() === 'en'; @endphp
                        @forelse($danhsach as $index => $item)
                        <tr>
                            <td class="pl-4">{{ $danhsach->firstItem() + $index }}</td>
                            <td><span class="badge badge-info">{{ $item->ma_nganh ?? 'N/A' }}</span></td>
                            <td>
                                <div class="font-weight-bold text-gray-900">{{ $item->ten }}</div>
                                @if($item->ten_en)
                                <div class="small text-muted font-italic">{{ $item->ten_en }}</div>
                                @endif
                            </td>
                            <td>
                                @php
                                    $heInfo = $heDaoTaoList[$item->he_dao_tao] ?? null;
                                    $heBadge = $item->he_dao_tao === 'DAI_HOC' ? 'badge-primary' : 'badge-success';
                                @endphp
                                @if($heInfo)
                                <span class="badge {{ $heBadge }}">{{ $isEn ? $heInfo['en'] : $heInfo['vi'] }}</span>
                                @else
                                <span class="badge badge-secondary">{{ $item->he_dao_tao }}</span>
                                @endif
                            </td>
                            <td>
                                <div><code class="text-primary">{{ $item->slug }}</code></div>
                                @if($item->slug_en)
                                <div><code class="text-success">{{ $item->slug_en }}</code></div>
                                @endif
                            </td>
                            <td>{{ $item->display_order }}</td>
                            <td class="text-center">
                                @if($item->is_active)
                                    <span class="badge badge-success">{{ __('Hoạt động') }}</span>
                                @else
                                    <span class="badge badge-warning">{{ __('Tạm ẩn') }}</span>
                                @endif
                            </td>
                            <td class="text-center pr-4">
                                <a href="{{ route('admin-nganh-dao-tao-edit', [app()->getLocale(), $item->_id]) }}" class="btn btn-sm btn-outline-primary mr-1">✏️ {{ __('Sửa') }}</a>
                                <a href="{{ route('admin-nganh-dao-tao-delete', [app()->getLocale(), $item->_id]) }}" onclick="return confirm('{{ __('Bạn chắc chắn muốn xóa ngành này?') }}')" class="btn btn-sm btn-outline-danger">🗑️ {{ __('Xóa') }}</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">{{ __('Chưa có ngành đào tạo nào.') }}</td>
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
