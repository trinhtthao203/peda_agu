@extends('Admin.layout')
@section('title', 'Chỉnh sửa trang thông tin tĩnh')
@section('body')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin-sub-info') }}" class="text-decoration-none text-muted">← Quay lại danh sách</a>
        <h1 class="h3 mt-2 text-gray-800">Chỉnh sửa trang thông tin tĩnh</h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin-sub-info-update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $ds->_id }}">

                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Tên trang / Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" name="ten" class="form-control" required placeholder="Ví dụ: Bộ môn Toán" value="{{ $ds->ten }}">
                    </div>
                    <div class="col-md-3 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Phân loại cụm (Type) <span class="text-danger">*</span></label>
                        <select name="type" class="form-control" required>
                            <option value="nhan-su" {{ $ds->type == 'nhan-su' ? 'selected' : '' }}>Nhân sự / Bộ môn (nhan-su)</option>
                            <option value="dao-tao" {{ $ds->type == 'dao-tao' ? 'selected' : '' }}>Đào tạo (dao-tao)</option>
                            <option value="gioi-thieu" {{ $ds->type == 'gioi-thieu' ? 'selected' : '' }}>Giới thiệu (gioi-thieu)</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Ngôn ngữ <span class="text-danger">*</span></label>
                        <select name="locale" class="form-control" required>
                            <option value="vi" {{ $ds->locale == 'vi' ? 'selected' : '' }}>Tiếng Việt (vi)</option>
                            <option value="en" {{ $ds->locale == 'en' ? 'selected' : '' }}>Tiếng Anh (en)</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Đường dẫn tùy chỉnh (Slug)</label>
                        <input type="text" name="slug" class="form-control" placeholder="Ví dụ: bo-mon-toan" value="{{ $ds->slug }}">
                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Trạng thái hiển thị</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $ds->status == 1 ? 'selected' : '' }}>Hiển thị ngay</option>
                            <option value="0" {{ $ds->status == 0 ? 'selected' : '' }}>Tạm ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-700">Mô tả ngắn</label>
                    <textarea name="mo_ta" class="form-control" rows="2" placeholder="Tóm tắt ngắn gọn nội dung trang...">{{ $ds->mo_ta }}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-gray-700">Nội dung trang HTML <span class="text-danger">*</span></label>
                    <textarea id="noi_dung" name="noi_dung" class="form-control" required>{{ $ds->noi_dung }}</textarea>
                </div>

                <button type="submit" class="btn btn-success px-4">💾 Lưu thay đổi</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ env('APP_URL') }}assets/backend/libs/ckeditor/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        const baseUrl = "{{ url('/') }}";
        var options = {
            filebrowserImageBrowseUrl: baseUrl + '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: baseUrl + '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: baseUrl + '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: baseUrl + '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}',
            height: 400
        };
        CKEDITOR.replace('noi_dung', options);
    });
</script>
@endsection
