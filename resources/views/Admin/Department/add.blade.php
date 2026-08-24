@extends('Admin.layout')
@section('title', 'Thêm đơn vị mới')
@section('body')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin-department') }}" class="text-decoration-none text-muted">← Quay lại danh sách</a>
        <h1 class="h3 mt-2 text-gray-800">Thêm đơn vị mới</h1>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin-department-create') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Tên đơn vị <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" required maxlength="255" placeholder="Ví dụ: Bộ môn Toán - Tin">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Loại đơn vị <span class="text-danger">*</span></label>
                        <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="">-- Chọn loại --</option>
                            <option value="LEADERSHIP" {{ old('type') == 'LEADERSHIP' ? 'selected' : '' }}>Ban Lãnh đạo (LEADERSHIP)</option>
                            <option value="ACADEMIC" {{ old('type') == 'ACADEMIC' ? 'selected' : '' }}>Bộ môn / Học thuật (ACADEMIC)</option>
                            <option value="OFFICE" {{ old('type') == 'OFFICE' ? 'selected' : '' }}>Văn phòng / Hành chính (OFFICE)</option>
                        </select>
                        @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Thứ tự hiển thị</label>
                        <input type="number" name="display_order" class="form-control @error('display_order') is-invalid @enderror"
                            value="{{ old('display_order', 0) }}" min="0" max="9999">
                        @error('display_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group mb-3 d-flex align-items-end">
                        <div class="form-check mb-2">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1"
                                {{ old('is_active', '1') ? 'checked' : '' }}>
                            <label class="form-check-label font-weight-bold text-gray-700" for="is_active">
                                Đang hoạt động
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success px-4">💾 Lưu đơn vị</button>
            </form>
        </div>
    </div>
</div>
@endsection
