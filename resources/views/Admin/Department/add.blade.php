@extends('Admin.layout')
@section('title', 'Thêm đơn vị mới')
@section('body')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin-department') }}" class="text-decoration-none text-muted">← {{ __('Quay lại danh sách') }}</a>
        <h1 class="h3 mt-2 text-gray-800">{{ __('Thêm đơn vị mới') }}</h1>
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
                    <div class="col-md-6 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">{{ __('Tên đơn vị (Tiếng Việt)') }} <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" required maxlength="255" placeholder="Ví dụ: Bộ môn Toán">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">{{ __('Tên đơn vị (English)') }}</label>
                        <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror"
                            value="{{ old('name_en') }}" maxlength="255" placeholder="Ví dụ: Department of Mathematics">
                        @error('name_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">{{ __('Slug Tiếng Anh (Tùy chọn)') }}</label>
                        <input type="text" name="slug_en" class="form-control @error('slug_en') is-invalid @enderror"
                            value="{{ old('slug_en') }}" placeholder="Ví dụ: mathematics-department (tự sinh nếu để trống)">
                        <small class="form-text text-muted">Đường dẫn dùng cho trang tiếng Anh <code>/en/staff/{slug_en}</code></small>
                        @error('slug_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">{{ __('Loại đơn vị') }} <span class="text-danger">*</span></label>
                        <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="">-- {{ __('Chọn loại') }} --</option>
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
                        <label class="font-weight-bold text-gray-700">{{ __('Thứ tự hiển thị') }}</label>
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
                                {{ __('Hoạt động') }}
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success px-4">💾 {{ __('Lưu') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection