@extends('Admin.layout')
@section('title', 'Thêm trang tĩnh mới')
@section('body')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin-sub-info', [app()->getLocale()]) }}" class="text-decoration-none text-muted">← {{ __('Quay lại danh sách') }}</a>
        <h1 class="h3 mt-2 text-gray-800">{{ __('Thêm trang thông tin tĩnh mới') }}</h1>
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
            <form action="{{ route('admin-sub-info-create', [app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Phân loại cụm (Type) <span class="text-danger">*</span></label>
                        <select name="type" id="select-type" class="form-control" required>
                            <option value="nhan-su">Nhân sự / Bộ môn (nhan-su)</option>
                            <option value="dao-tao">Đào tạo (dao-tao)</option>
                            <option value="gioi-thieu">Giới thiệu (gioi-thieu)</option>
                            <option value="nckh">Nghiên cứu khoa học (nckh)</option>
                            <option value="sinh-vien">Sinh viên (sinh-vien)</option>
                            <option value="dbcl">Đảm bảo chất lượng (dbcl)</option>
                        </select>
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Ngôn ngữ <span class="text-danger">*</span></label>
                        <select name="locale" id="select-locale" class="form-control" required>
                            <option value="vi">Tiếng Việt (vi)</option>
                            <option value="en">Tiếng Anh (en)</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3" id="quick-select-wrapper">
                        <label class="font-weight-bold text-primary">⚡ Chọn nhanh từ Danh mục:</label>
                        <select id="quick-select" class="form-control border-primary">
                            <option value="">-- Chọn đơn vị/ngành để tự điền --</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Tên trang / Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" name="ten" id="input-ten" class="form-control" required placeholder="Ví dụ: Bộ môn Toán" value="{{ old('ten') }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Đường dẫn tùy chỉnh (Slug)</label>
                        <input type="text" name="slug" id="input-slug" class="form-control" placeholder="Ví dụ: bo-mon-toan" value="{{ old('slug') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="font-weight-bold text-gray-700"><i class="fab fa-youtube text-danger"></i> Link Video YouTube</label>
                        <input type="text" name="video_ytb" class="form-control" placeholder="https://www.youtube.com/watch?v=... hoặc https://youtu.be/..." value="{{ old('video_ytb') }}">
                        <small class="text-muted">Hệ thống sẽ tự động tách mã nhúng Embed Video.</small>
                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label class="font-weight-bold text-gray-700"><i class="far fa-image text-success"></i> Ảnh bìa trang (Tùy chọn)</label>
                        <input type="file" name="hinh_anh" class="form-control-file border p-1 rounded bg-light" accept="image/*">
                    </div>
                    <div class="col-md-2 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Trạng thái</label>
                        <select name="status" class="form-control">
                            <option value="1">Hiển thị</option>
                            <option value="0">Tạm ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-700">Mô tả ngắn</label>
                    <textarea name="mo_ta" class="form-control" rows="2" placeholder="Tóm tắt ngắn gọn nội dung trang...">{{ old('mo_ta') }}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-gray-700">Nội dung trang HTML <span class="text-danger">*</span></label>
                    <textarea id="noi_dung" name="noi_dung" class="form-control" required>{{ old('noi_dung') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success px-4">💾 {{ __('Lưu dữ liệu') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ env('APP_URL') }}assets/backend/libs/ckeditor/ckeditor.js"></script>
<script>
    var departmentsData = @json($departments);
    var nganhData = @json($nganhDaoTaos);

    function updateQuickSelect() {
        var type = $('#select-type').val();
        var locale = $('#select-locale').val();
        var $select = $('#quick-select');

        $select.empty().append('<option value="">-- Chọn đơn vị/ngành để tự điền --</option>');

        if (type === 'nhan-su') {
            $('#quick-select-wrapper').show();
            departmentsData.forEach(function(item) {
                var name = (locale === 'en' && item.name_en) ? item.name_en : item.name;
                var slug = (locale === 'en' && item.slug_en) ? item.slug_en : item.slug;
                $select.append(`<option value="${item._id}" data-name="${name}" data-slug="${slug}">${name}</option>`);
            });
        } else if (type === 'dao-tao') {
            $('#quick-select-wrapper').show();
            nganhData.forEach(function(item) {
                var name = (locale === 'en' && item.ten_en) ? item.ten_en : item.ten;
                var slug = (locale === 'en' && item.slug_en) ? item.slug_en : item.slug;
                var heLabel = (item.he_dao_tao === 'SAU_DAI_HOC') ?
                    (locale === 'en' ? '[Postgraduate] ' : '[Sau đại học] ') :
                    (locale === 'en' ? '[Undergraduate] ' : '[Đại học] ');

                $select.append('<option value="' + item._id + '" data-name="' + name + '" data-slug="' + slug + '">' + heLabel + name + '</option>');
            });
        } else {
            $('#quick-select-wrapper').hide();
        }
    }

    $(document).ready(function() {
        updateQuickSelect();

        $('#select-type, #select-locale').on('change', function() {
            updateQuickSelect();
        });

        $('#quick-select').on('change', function() {
            var selected = $(this).find('option:selected');
            if (selected.val()) {
                $('#input-ten').val(selected.data('name'));
                $('#input-slug').val(selected.data('slug'));
            }
        });

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