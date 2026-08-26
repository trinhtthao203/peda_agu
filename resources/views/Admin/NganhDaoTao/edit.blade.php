@extends('Admin.layout')
@section('title', 'Chỉnh sửa ngành đào tạo')
@section('body')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin-nganh-dao-tao', [app()->getLocale()]) }}" class="text-decoration-none text-muted">← {{ __('Quay lại danh sách') }}</a>
        <h1 class="h3 mt-2 text-gray-800">{{ __('Chỉnh sửa ngành đào tạo') }}</h1>
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
            <form action="{{ route('admin-nganh-dao-tao-update', [app()->getLocale()]) }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $item->_id }}">

                <!-- Language Tabs -->
                <ul class="nav nav-tabs mb-4" id="langTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active font-weight-bold" id="vi-tab" data-toggle="tab" href="#vi" role="tab">🇻🇳 Tiếng Việt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="en-tab" data-toggle="tab" href="#en" role="tab">🇬🇧 English</a>
                    </li>
                </ul>

                <div class="tab-content" id="langTabContent">
                    <!-- Tab Tiếng Việt -->
                    <div class="tab-pane fade show active" id="vi" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label class="font-weight-bold text-gray-700">{{ __('Tên ngành đào tạo') }} <span class="text-danger">*</span></label>
                                <input type="text" name="ten" class="form-control" required value="{{ $item->ten }}">
                            </div>
                        </div>
                    </div>

                    <!-- Tab English -->
                    <div class="tab-pane fade" id="en" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-bold text-gray-700">{{ __('Program / Major Name (EN)') }}</label>
                                <input type="text" name="ten_en" class="form-control" value="{{ $item->ten_en }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-bold text-gray-700">{{ __('Slug (EN)') }}</label>
                                <input type="text" name="slug_en" class="form-control" value="{{ $item->slug_en }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">{{ __('Mã ngành') }}</label>
                        <input type="text" name="ma_nganh" class="form-control" value="{{ $item->ma_nganh }}">
                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">{{ __('Hệ đào tạo') }} <span class="text-danger">*</span></label>
                        <select name="he_dao_tao" class="form-control" required>
                            <option value="">-- {{ __('Chọn hệ đào tạo') }} --</option>
                            @foreach($heDaoTaoList as $k => $v)
                            <option value="{{ $k }}" {{ $item->he_dao_tao == $k ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'en' ? $v['en'] : $v['vi'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">{{ __('Thứ tự hiển thị') }}</label>
                        <input type="number" name="display_order" class="form-control" value="{{ $item->display_order }}" min="0" max="9999">
                    </div>
                    <div class="col-md-2 form-group mb-3 d-flex align-items-end">
                        <div class="form-check mb-2">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ $item->is_active ? 'checked' : '' }}>
                            <label class="form-check-label font-weight-bold text-gray-700" for="is_active">{{ __('Hoạt động') }}</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4">💾 {{ __('Lưu') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection