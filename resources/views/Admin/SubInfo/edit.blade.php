@extends('Admin.layout')
@section('title', 'Chỉnh sửa trang thông tin tĩnh')
@section('body')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin-sub-info', [app()->getLocale()]) }}" class="text-decoration-none text-muted">← {{ __('Quay lại danh sách') }}</a>
        <h1 class="h3 mt-2 text-gray-800">{{ __('Chỉnh sửa trang thông tin tĩnh') }}</h1>
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
            <form action="{{ route('admin-sub-info-update', [app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $ds->_id }}">

                <div class="row">
                    <div class="col-md-3 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Phân loại cụm (Type) <span class="text-danger">*</span></label>
                        <select name="type" id="select-type" class="form-control" required>
                            <option value="nhan-su" {{ $ds->type == 'nhan-su' ? 'selected' : '' }}>Nhân sự / Bộ môn (nhan-su)</option>
                            <option value="dao-tao" {{ $ds->type == 'dao-tao' ? 'selected' : '' }}>Đào tạo (dao-tao)</option>
                            <option value="gioi-thieu" {{ $ds->type == 'gioi-thieu' ? 'selected' : '' }}>Giới thiệu (gioi-thieu)</option>
                            <option value="nckh" {{ $ds->type == 'nckh' ? 'selected' : '' }}>Nghiên cứu khoa học (nckh)</option>
                            <option value="sinh-vien" {{ $ds->type == 'sinh-vien' ? 'selected' : '' }}>Sinh viên (sinh-vien)</option>
                            <option value="dbcl" {{ $ds->type == 'dbcl' ? 'selected' : '' }}>Đảm bảo chất lượng (dbcl)</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Ngôn ngữ <span class="text-danger">*</span></label>
                        <select name="locale" id="select-locale" class="form-control" required>
                            <option value="vi" {{ $ds->locale == 'vi' ? 'selected' : '' }}>Tiếng Việt (vi)</option>
                            <option value="en" {{ $ds->locale == 'en' ? 'selected' : '' }}>Tiếng Anh (en)</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3" id="quick-select-wrapper">
                        <label class="font-weight-bold text-primary">⚡ Chọn nhanh từ Danh mục:</label>
                        <select id="quick-select" class="form-control border-primary">
                            <option value="">-- Chọn mục tương ứng để thay đổi --</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Tên trang / Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" name="ten" id="input-ten" class="form-control" required value="{{ $ds->ten }}">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Đường dẫn tùy chỉnh (Slug)</label>
                        <input type="text" name="slug" id="input-slug" class="form-control" value="{{ $ds->slug }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="font-weight-bold text-gray-700 mb-0"><i class="fab fa-youtube text-danger"></i> Link Video YouTube</label>
                            @if(!empty($ds->video_ytb))
                            <button type="button" class="btn btn-xs btn-outline-danger py-0 px-2" id="btn-clear-ytb" style="font-size: 11px;">
                                ✕ Xóa link video
                            </button>
                            @endif
                        </div>
                        @php
                        $ytbVal = !empty($ds->video_ytb) ? 'https://www.youtube.com/watch?v=' . $ds->video_ytb : '';
                        @endphp
                        <input type="text" name="video_ytb" id="input-video-ytb" class="form-control" placeholder="https://www.youtube.com/watch?v=..." value="{{ $ytbVal }}">
                        @if(!empty($ds->video_ytb))
                        <small class="text-success mt-1 d-block" id="ytb-current-id">ID Video hiện tại: <code>{{ $ds->video_ytb }}</code></small>
                        @endif
                    </div>

                    <div class="col-md-4 form-group mb-3">
                        <label class="font-weight-bold text-gray-700"><i class="far fa-image text-success"></i> Ảnh bìa</label>
                        <input type="file" name="hinh_anh" class="form-control-file border p-1 rounded bg-light" accept="image/*">
                        @if(!empty($ds->hinh_anh))
                        <div class="mt-2 d-flex align-items-center p-1 border rounded bg-light">
                            <img src="{{ asset('storage/images/subinfo/' . $ds->hinh_anh) }}" class="rounded mr-2" style="height: 32px; width: 45px; object-fit: cover;">
                            <div class="form-check m-0">
                                <input type="checkbox" name="delete_hinh_anh" id="delete_hinh_anh" class="form-check-input" value="1">
                                <label class="form-check-label text-danger small font-weight-bold" for="delete_hinh_anh">
                                    🗑️ Xóa ảnh này
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="col-md-2 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Trạng thái</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $ds->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ $ds->status == 0 ? 'selected' : '' }}>Tạm ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-700">Mô tả ngắn</label>
                    <textarea name="mo_ta" class="form-control" rows="2">{{ $ds->mo_ta }}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-gray-700">Nội dung trang HTML <span class="text-danger">*</span></label>
                    <textarea id="noi_dung" name="noi_dung" class="form-control" required>{{ $ds->noi_dung }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary px-4">💾 {{ __('Lưu các thay đổi') }}</button>
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
    var currentItemSlug = "{{ $ds->slug }}";

    function updateQuickSelect(isInitialLoad) {
        var type = $('#select-type').val();
        var locale = $('#select-locale').val();
        var $select = $('#quick-select');

        $select.empty().append('<option value="">-- Chọn mục tương ứng để tự điền --</option>');

        if (type === 'nhan-su') {
            $('#quick-select-wrapper').show();
            departmentsData.forEach(function(item) {
                var name = (locale === 'en' && item.name_en) ? item.name_en : item.name;
                var slug = (locale === 'en' && item.slug_en) ? item.slug_en : item.slug;
                var isSelected = (isInitialLoad && (item.slug === currentItemSlug || item.slug_en === currentItemSlug)) ? 'selected' : '';
                $select.append('<option value="' + item._id + '" data-name="' + name + '" data-slug="' + slug + '" ' + isSelected + '>' + name + '</option>');
            });
        } else if (type === 'dao-tao') {
            $('#quick-select-wrapper').show();
            nganhData.forEach(function(item) {
                var name = (locale === 'en' && item.ten_en) ? item.ten_en : item.ten;
                var slug = (locale === 'en' && item.slug_en) ? item.slug_en : item.slug;
                var heLabel = (item.he_dao_tao === 'SAU_DAI_HOC') ?
                    (locale === 'en' ? '[Postgraduate] ' : '[Sau đại học] ') :
                    (locale === 'en' ? '[Undergraduate] ' : '[Đại học] ');

                var isSelected = (isInitialLoad && (item.slug === currentItemSlug || item.slug_en === currentItemSlug)) ? 'selected' : '';
                $select.append('<option value="' + item._id + '" data-name="' + name + '" data-slug="' + slug + '" ' + isSelected + '>' + heLabel + name + '</option>');
            });
        } else {
            $('#quick-select-wrapper').hide();
        }
    }

    $(document).ready(function() {
        updateQuickSelect(true);

        $('#select-type, #select-locale').on('change', function() {
            updateQuickSelect(false);
        });

        $('#quick-select').on('change', function() {
            var selected = $(this).find('option:selected');
            if (selected.val()) {
                $('#input-ten').val(selected.data('name'));
                $('#input-slug').val(selected.data('slug'));
            }
        });

        $('#btn-clear-ytb').on('click', function() {
            $('#input-video-ytb').val('');
            $('#ytb-current-id').hide();
            $(this).hide();
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