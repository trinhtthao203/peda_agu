@extends('Admin.layout')
@section('title', 'Thêm trang tĩnh mới')
@section('body')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin-sub-info') }}" class="text-decoration-none text-muted">← Quay lại danh sách</a>
        <h1 class="h3 mt-2 text-gray-800">Thêm trang thông tin tĩnh mới</h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin-sub-info-create') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Tên trang / Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" name="ten" class="form-control" required placeholder="Ví dụ: Bộ môn Toán">
                    </div>
                    <div class="col-md-3 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Phân loại cụm (Type) <span class="text-danger">*</span></label>
                        <select name="type" class="form-control" required>
                            <option value="nhan-su">Nhân sự / Bộ môn (nhan-su)</option>
                            <option value="dao-tao">Đào tạo (dao-tao)</option>
                            <option value="gioi-thieu">Giới thiệu (gioi-thieu)</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Ngôn ngữ <span class="text-danger">*</span></label>
                        <select name="locale" class="form-control" required>
                            <option value="vi">Tiếng Việt (vi)</option>
                            <option value="en">Tiếng Anh (en)</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Đường dẫn tùy chỉnh (Slug - Để trống hệ thống tự tạo)</label>
                        <input type="text" name="slug" class="form-control" placeholder="Ví dụ: bo-mon-toan">
                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Trạng thái hiển thị</label>
                        <select name="status" class="form-control">
                            <option value="1">Hiển thị ngay</option>
                            <option value="0">Tạm ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-700">Mô tả ngắn</label>
                    <textarea name="mo_ta" class="form-control" rows="2" placeholder="Tóm tắt ngắn gọn nội dung trang..."></textarea>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-gray-700">Nội dung trang HTML <span class="text-danger">*</span></label>
                    <textarea id="noi_dung" name="noi_dung" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-success px-4">💾 Lưu dữ liệu</button>
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