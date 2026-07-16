@extends('Admin.layout')
@section('title', __('Sửa Thông tin'))
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/magnific-popup.css" />
<style>
    /* CSS Menu Chuột phải dùng chung */
    #custom-context-menu {
        position: absolute;
        display: none;
        background: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        min-width: 200px;
        border-radius: 4px;
    }

    #custom-context-menu ul {
        list-style: none;
        margin: 0;
        padding: 5px 0;
    }

    #custom-context-menu ul li {
        padding: 10px 15px;
        cursor: pointer;
        font-size: 13px;
        color: #333;
    }

    #custom-context-menu ul li:hover {
        background: #009efb;
        color: #fff;
    }

    #custom-context-menu ul li i {
        margin-right: 8px;
    }
</style>
@endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h3 class="m-t-0"><a href="{{ env('APP_URl') }}{{ app()->getLocale() }}/admin/thong-tin" class="btn btn-primary btn-sm"><i class="mdi mdi-reply-all"></i> {{ __('Trở về') }}</a> {{ __('Chỉnh sửa bài viết') }}</h3>
            <form action="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/thong-tin/update" method="post" id="dinhkemform" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="{{ $ds['_id'] }}" placeholder="">
                <input type="hidden" name="trans_id" id="trans_id" value="{{ $trans_id }}" placeholder="">
                <input type="hidden" name="trans_lang" id="trans_lang" value="{{ $trans_lang }}" placeholder="">
                <div class="form-body">
                    <hr />
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @php
                    if(old('ten') != null){
                    $ten = old('ten'); $noi_dung = old('noi_dung');$slug = old('slug');
                    $thu_tu = old('thu_tu');$id_cat = old('id_cat'); $mo_ta = old('mo_ta');
                    $date_post = old('date_post');$id_sdg_tags = old('id_sdg_tags');
                    } else if(isset($ds['ten']) && $ds['ten']){
                    $ten = $ds['ten']; $noi_dung = $ds['noi_dung'];$slug = $ds['slug'];
                    $thu_tu = $ds['thu_tu']; $id_cat = $ds['id_cat']; $mo_ta = $ds['mo_ta'];$date_post = $ds['date_post'];
                    $id_sdg_tags = isset($ds['id_sdg_tags']) ? $ds['id_sdg_tags'] : array();
                    } else {
                    $ten = '';$noi_dung = '';$slug='';$thu_tu=0;$id_cat=array();$mo_ta = ''; $date_post = App\Http\Controllers\ObjectController::setDate();
                    $id_sdg_tags = array();
                    }
                    @endphp
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Tiêu đề') }}</label>
                        <div class="col-md-10">
                            <input type="text" id="ten" name="ten" class="form-control" placeholder="{{ __('Tiêu đề') }}" value="{{ $ten }}" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Slug') }}</label>
                        <div class="col-md-10">
                            <input type="text" id="slug" name="slug" class="form-control" placeholder="{{ __('slug') }}" value="{{ $slug }}" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Mô tả') }}</label>
                        <div class="col-12 col-md-10">
                            <textarea name="mo_ta" id="mo_ta" class="form-control" required placeholder="{{ __('Mô tả nội dung') }}" style="height:100px;">{{ $mo_ta }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Nội dung') }}</label>
                        <div class="col-md-10">
                            <textarea name="noi_dung" id="noi_dung" class="form-control" required>{!! $noi_dung !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Thuộc Danh mục') }}</label>
                        <div class="col-md-10">
                            <select name="id_cat[]" id="id_cat" required class="form-control select2" multiple data-placeholder="{{ __('Chọn danh mục') }}">
                                <option value=""></option>
                                @if($cats)
                                @foreach($cats as $cat)
                                <option value="{{ $cat['_id'] }}" @if(in_array($cat['_id'],$id_cat)) selected @endif>{{ $cat['ten'] }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('SDG TAGS') }}</label>
                        <div class="col-md-10">
                            <select name="id_sdg_tags[]" id="id_sdg_tags" required class="form-control select2" multiple data-placeholder="{{ __('Chọn SDG Tags') }}">
                                <option value=""></option>
                                @if($sdg_tags)
                                @foreach($sdg_tags as $sk => $vk)
                                <option value="{{ $sk }}" @if(in_array($sk,$id_sdg_tags)) selected @endif>{{ __($vk) }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Ngày tạo') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="date_post" name="date_post" class="form-control" placeholder="{{ __('Ngày tạo') }}" value="{{ $date_post }}" required />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Thứ tự') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="thu_tu" name="thu_tu" class="form-control" placeholder="{{ __('Thứ tự') }}" value="{{ $thu_tu }}" required />
                        </div>
                    </div>
                    <div class="card-box bg-light">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="btn btn-danger">
                                            <input type="file" name="hinhanh_files[]" class="hinhanh_files btn btn-primary" multiple accept="image/png, image/jpeg, image/jpg, image/gif" placeholder="Chọn hình ảnh" style="display:none;" />
                                            <i class="fa fa-images"></i> {{ __('Chọn Hình ảnh') }} : (jpg, png, bmp)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="list_hinhanh">
                            @if(old('hinhanh_aliasname'))
                            @foreach(old('hinhanh_aliasname') as $k => $h)
                            <div class="col-sm-6 col-md-4 items draggable-element text-center">
                                <input type="hidden" name="hinhanh_aliasname[]" value="{{ old('hinhanh_aliasname')[$k] }}" readonly />
                                <input type="hidden" name="hinhanh_filename[]" class="form-control" value="{{ old('hinhanh_filename')[$k] }}" />
                                <a href="{{  env('APP_URL') }}storage/images/origin/{{ old('hinhanh_aliasname')[$k] }}" class="image-popup">
                                    <div class="portfolio-masonry-box">
                                        <div class="portfolio-masonry-img">
                                            <img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ old('hinhanh_aliasname')[$k] }}" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </div>
                                        <div class="portfolio-masonry-detail">
                                            <p>{{ old('hinhanh_filename')[$k] }}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ env('APP_URL')}}{{ app()->getLocale() }}/image/delete/{{ old('hinhanh_aliasname')[$k] }}" onclick="return false;" class="btn btn-danger btn-sm delete_file" style="position:absolute;top:40px;right:30px;">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <input type="text" name="hinhanh_title[]" class="form-control" value="{{ old('hinhanh_title')[$k] }}" />
                            </div>
                            @endforeach
                            @elseif(isset($ds['photos']) && $ds['photos'])
                            @foreach($ds['photos'] as $photo)
                            <div class="col-sm-6 col-md-4 items draggable-element text-center">
                                <input type="hidden" name="hinhanh_aliasname[]" value="{{ $photo['aliasname'] }}" readonly />
                                <input type="hidden" name="hinhanh_filename[]" class="form-control" value="{{ $photo['filename'] }}" />
                                <a href="{{  env('APP_URL') }}storage/images/origin/{{ $photo['aliasname'] }}" class="image-popup">
                                    <div class="portfolio-masonry-box">
                                        <div class="portfolio-masonry-img">
                                            <img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ $photo['aliasname'] }}" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </div>
                                        <div class="portfolio-masonry-detail">
                                            <p>{{ $photo['filename'] }}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ env('APP_URL')}}{{ app()->getLocale() }}/image/delete/{{ $photo['aliasname'] }}" onclick="return false;" class="btn btn-danger btn-sm delete_file" style="position:absolute;top:40px;right:30px;">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <input type="text" name="hinhanh_title[]" class="form-control" value="{{ $photo['title'] }}" />
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="progress m-b-20" id="progressbar">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="card-box" style="background-color:#eee;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="btn btn-info">
                                            <input type="file" name="dinhkem_files[]" id="dinhkem_files" class="dinhkem_files btn btn-primary" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar" style="display:none;" />
                                            <i class="mdi mdi mdi-attachment"></i> {{ __('Thêm File đính kèm') }} : (pdf, xlsx, docx, pptx, zip, ....)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="list_files">
                            @if(old('file_aliasname'))
                            @foreach(old('file_aliasname') as $key => $dk)
                            <div class="form-group row items draggable-element">
                                <input type="hidden" name="file_aliasname[]" value="{{ $dk }}" readonly />
                                <input type="hidden" name="file_filename[]" value="{{ old('file_filename')[$key] }}" class="form-control" />
                                <div class="col-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
                                        <input type="hidden" name="file_size[]" value="{{ old('file_size')[$key] }}" class="form-control">
                                        <input type="hidden" name="file_type[]" value="{{ old('file_type')[$key] }}" class="form-control">
                                        <input type="text" name="file_title[]" placeholder="{{ __('Chú thích tập tinh đính kèm') }} - Bấm chuột phải để lấy mã nhúng" value="{{ old('file_title')[$key] }}" class="form-control">
                                        <div class="input-group-append">
                                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/file/delete/{{ $dk }}" class="btn btn-info btn-circle delete_file" onclick="return false;" style="margin-left:2px;"><i class="mdi mdi-delete"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{-- BỔ SUNG: Kiểm tra và lặp load danh sách file cũ đã lưu trong database --}}
                            @elseif(isset($ds['attachments']) && $ds['attachments'])
                            @foreach($ds['attachments'] as $dk)
                            <div class="form-group row items draggable-element">
                                <input type="hidden" name="file_aliasname[]" value="{{ $dk['aliasname'] }}" readonly />
                                <input type="hidden" name="file_filename[]" value="{{ $dk['filename'] }}" class="form-control" />
                                <div class="col-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
                                        <input type="hidden" name="file_size[]" value="{{ $dk['size'] }}" class="form-control">
                                        <input type="hidden" name="file_type[]" value="{{ $dk['type'] }}" class="form-control">
                                        <input type="text" name="file_title[]" placeholder="{{ __('Chú thích tập tinh đính kèm') }} - Bấm chuột phải để lấy mã nhúng" value="{{ $dk['title'] }}" class="form-control">
                                        <div class="input-group-append">
                                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/file/delete/{{ $dk['aliasname'] }}" class="btn btn-info btn-circle delete_file" onclick="return false;" style="margin-left:2px;"><i class="mdi mdi-delete"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/thong-tin" class="btn btn-light"><i class="fa fa-reply-all"></i> {{ __('Trở về') }}</a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> {{ __('Cập nhật') }}</button>
                </div>
            </form>
        </div>
    </div>

    <div id="custom-context-menu">
        <ul>
            <li id="copy-iframe-pdf"><i class="fa fa-code"></i> Copy mã Iframe PDF</li>
            <li id="copy-direct-link"><i class="fa fa-link"></i> Copy Link trực tiếp</li>
        </ul>
    </div>
</div>
@endsection
@section('js')
<script src="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.js" type="text/javascript"></script>
<script src="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="{{ env('APP_URL') }}assets/backend/js/drag-arrange.min.js" type="text/javascript"></script>
<script src="{{ env('APP_URL') }}assets/backend/libs/ckeditor/ckeditor.js"></script>
<script src="{{ env('APP_URL') }}assets/backend/js/script.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const baseUrl = "{{ url('/') }}";
        const locale = "{{ app()->getLocale() }}";
        let selectedFileUrl = "";

        delete_file();
        $(".select2").select2();

        var options = {
            filebrowserImageBrowseUrl: baseUrl + '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: baseUrl + '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: baseUrl + '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: baseUrl + '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}'
        };

        upload_files(baseUrl + "/" + locale + "/file/uploads");
        upload_hinhanh(baseUrl + "/" + locale + "/image/uploads");

        $("#ten").change(function() {
            var title = $(this).val();
            $.get(baseUrl + "/" + locale + "/slug/" + title, function(slug) {
                $("#slug").val(slug);
            });
        });
        $("#progressbar").hide();
        CKEDITOR.replace('noi_dung', options);

        $('#dinhkem_files').on('change', function() {
            var validExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip', 'rar'];
            var files = this.files;
            for (var i = 0; i < files.length; i++) {
                var ext = files[i].name.split('.').pop().toLowerCase();
                if ($.inArray(ext, validExtensions) == -1) {
                    alert("Tập tin '" + files[i].name + "' không đúng định dạng cho phép (pdf, docx, xlsx, zip...)!");
                    this.value = '';
                    return false;
                }
            }
        });

        $('#list_files').on('contextmenu', 'input[name="file_title[]"]', function(e) {
            e.preventDefault();
            let aliasname = $(this).closest('.items').find('input[name="file_aliasname[]"]').val();
            selectedFileUrl = baseUrl + "/storage/files/" + aliasname;

            $("#custom-context-menu").css({
                top: e.pageY + "px",
                left: e.pageX + "px",
                display: "block"
            });
        });

        $("#copy-iframe-pdf").on("click", function() {
            if (!selectedFileUrl.toLowerCase().endsWith('.pdf')) {
                alert("Hệ thống chỉ hỗ trợ sinh mã nhúng cho định dạng tệp tin PDF!");
                return;
            }
            let iframeCode = `<iframe src="${selectedFileUrl}" width="100%" height="700px" style="border:none;">Trình duyệt của bạn không hỗ trợ hiển thị tệp PDF trực tiếp. <a href="${selectedFileUrl}">Tải tệp tin tại đây.</a></iframe>`;
            copyToClipboard(iframeCode, "Đã copy mã Iframe nhúng PDF thành công!");
        });

        $("#copy-direct-link").on("click", function() {
            copyToClipboard(selectedFileUrl, "Đã sao chép đường dẫn liên kết tệp tin thành công!");
        });

        $(document).on("click", function() {
            $("#custom-context-menu").hide();
        });

        function copyToClipboard(text, msg) {
            navigator.clipboard.writeText(text).then(() => {
                alert(msg);
                $("#custom-context-menu").hide();
            }).catch(() => {
                prompt("Trình duyệt chặn sao chép tự động. Hãy copy thủ công tại đây:", text);
            });
        }
    });
</script>
@endsection
