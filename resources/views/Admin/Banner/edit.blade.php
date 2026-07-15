@extends('Admin.layout')
@section('title', __('Chỉnh sửa BANNER'))
@section('css')
<link href="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/magnific-popup.css" />
<link href="{{ env('APP_URL') }}assets/backend/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h3 class="m-t-0"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/banner" class="btn btn-primary"><i class="mdi mdi-reply-all"></i></a>{{ __('Chỉnh sửa banner') }}</h3>
            <form action="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/banner/update" method="post" id="dinhkemform" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="{{ $ds['_id'] }}" placeholder="">
                <div class="form-body">
                    <hr />
                    @if($errors->any())
                    <div class="alert alert-success">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2 text-right p-t-10">{{ __('Tiêu đề') }}</label>
                                <div class="col-md-10">
                                    <input type="text" id="title" name="title" class="form-control" placeholder="{{ __('Tiêu đề') }}" value="{{ old('title') != null ? old('title') : $ds['title'] }}" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('URL') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="url" value="{{ old('url') != null ? old('url') : $ds['url'] }}" placeholder="{{ __('URL') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Thứ tự') }}</label>
                        <div class="col-md-1">
                            <input type="number" name="thutu" id="thutu" value="{{ old('thutu') != null ? old('thutu') : $ds['order'] }}" placeholder="Thứ tự" class="form-control">
                        </div>
                        <div class="col-md-2 switchery-demo">
                            <b>{{ __('Trạng thái') }}: </b>
                            <input type="checkbox" name="status" id="status" class="js-switch" data-plugin="switchery" @if($ds['status']==1) checked @endif data-color="#009efb" value="1" />
                        </div>
                        <div class="col-md-2 switchery-demo">
                            <b>{{ __('Trang chủ') }}: </b>
                            <input type="checkbox" name="trang_chu" id="trang_chu" class="js-switch" data-plugin="switchery" @if($ds['trang_chu']==1) checked @endif data-color="#009efb" value="1" />
                        </div>
                        <!-- <div class="col-md-2 switchery-demo">
                            <b>{{ __('Tuyển sinh') }}: </b>
                            <input type="checkbox" name="tuyen_sinh" id="tuyen_sinh" class="js-switch" data-plugin="switchery" @if($ds['tuyen_sinh']==1) checked @endif data-color="#009efb" value="1" />
                        </div>
                        <div class="col-md-3 switchery-demo">
                            <b>{{ __('Phát triển bền vững') }}: </b>
                            <input type="checkbox" name="phat_trien_ben_vung" id="phat_trien_ben_vung" class="js-switch" data-plugin="switchery" @if($ds['phat_trien_ben_vung']==1) checked @endif data-color="#009efb" value="1" />
                        </div> -->
                    </div>
                    <div class="progress m-b-20" id="progressbar">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2 text-right p-t-10">{{ __('Hình ảnh') }}</label>
                                <div class="col-md-2" id="upload_button_wrapper">
                                    <label class="btn btn-danger">
                                        <input type="file" name="hinhanh_files[]" class="hinhanh_files btn btn-primary" accept="image/png, image/jpeg, image/jpg, image/gif" placeholder="Chọn hình ảnh" style="display:none;" id="imageUpload" />
                                        <i class="fa fa-images"></i> {{ __('Hình ảnh') }}
                                    </label>
                                </div>
                                <div class="col-md-6 p-t-10 text-danger" id="upload_warning" style="display: none;">
                                    <i>{{ __('Đã tải lên tối đa 1 ảnh. Vui lòng xóa ảnh hiện tại nếu muốn đổi ảnh khác.') }}</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                    $hinhanh = old('hinhanh_aliasname') != null ? old('hinhanh_aliasname') : $ds['photos'];
                    @endphp
                    <div class="row" id="list_hinhanh">
                        @if($hinhanh)
                        @foreach($hinhanh as $k => $h)
                        @php
                        $aliasname = old('hinhanh_aliasname') != null ? old('hinhanh_aliasname')[$k] : $ds['photos'][$k]['aliasname'];
                        $filename = old('hinhanh_filename') != null ? old('hinhanh_filename')[$k] : $ds['photos'][$k]['filename'];
                        $title = old('hinhanh_title') != null ? old('hinhanh_title')[$k] : $ds['photos'][$k]['title'];
                        @endphp
                        <div class="col-sm-6 col-md-4 items draggable-element text-center">
                            <input type="hidden" name="hinhanh_aliasname[]" value="{{ $aliasname }}" readonly />
                            <input type="hidden" name="hinhanh_filename[]" class="form-control" value="{{ $filename }}" />
                            <a href="{{  env('APP_URL') }}storage/images/origin/{{ $aliasname }}" class="image-popup">
                                <div class="portfolio-masonry-box">
                                    <div class="portfolio-masonry-img">
                                        <img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ $aliasname }}" class="thumb-img img-fluid" alt="work-thumbnail">
                                    </div>
                                    <div class="portfolio-masonry-detail">
                                        <p>{{ $filename }}</p>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ env('APP_URL')}}{{ app()->getLocale() }}/image/delete/{{ $aliasname }}" onclick="return false;" class="btn btn-danger btn-sm delete_file" style="position:absolute;top:40px;right:30px;z-index:1;">
                                <i class="fa fa-trash"></i>
                            </a>
                            <input type="text" name="hinhanh_title[]" class="form-control" value="{{ $title }}" />
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}admin/banner" class="btn btn-light"><i class="fa fa-reply-all"></i>{{ __('Trở về') }}</a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> {{ __('Cập nhật') }}</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('js')
<script src="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.js" type="text/javascript"></script>
<script src="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="{{ env('APP_URL') }}assets/backend/js/drag-arrange.min.js" type="text/javascript"></script>
<script src="{{ env('APP_URL') }}assets/backend/libs/switchery/switchery.min.js"></script>
<script src="{{ env('APP_URL') }}assets/backend/js/script.js" type="text/javascript"></script>
<script type="text/javascript">
    function checkImageLimit() {
        var currentImages = $('#list_hinhanh').find('.items:visible').length;

        if (currentImages >= 1) {
            $('#upload_button_wrapper').hide();
            $('#upload_warning').show();
            $('#imageUpload').prop('disabled', true);
        } else {
            $('#upload_button_wrapper').show();
            $('#upload_warning').hide();
            $('#imageUpload').prop('disabled', false);
            $('#imageUpload').val('');
        }
    }

    $(document).ready(function() {
        upload_files("{{ env('APP_URL') }}{{ app()->getLocale() }}/file/uploads");
        upload_hinhanh("{{ env('APP_URL') }}{{ app()->getLocale() }}/image/uploads");
        delete_file();
        $(".select2").select2();
        $("#progressbar").hide();
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        checkImageLimit();

        var targetNode = document.getElementById('list_hinhanh');
        if (targetNode) {
            var observer = new MutationObserver(function(mutationsList) {
                checkImageLimit();
            });
            observer.observe(targetNode, {
                childList: true,
                subtree: true
            });
        }
        $(document).on('click', '.delete_file', function() {
            setTimeout(function() {
                checkImageLimit();
            }, 300);
        });
        setInterval(function() {
            checkImageLimit();
        }, 500);
    });
</script>
@endsection