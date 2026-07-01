@extends('Admin.layout')
@section('title', __('Sửa Tư vấn Tuyển sinh'))
@section('css')
    <link href="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/switchery/switchery.min.css">
@endsection

@section('body')
<div class="card-box">
    <div class="row">
        <div class="col-12">
            <h3 class="m-t-0"><a href="{{ env('APP_URl') }}{{ app()->getLocale() }}/admin/tuyen-sinh/tu-van" class="btn btn-primary btn-sm"><i class="mdi mdi-reply-all"></i> {{ __('Trở về') }}</a> {{ __('Sửa Tư vấn Tuyển sinh') }}</h3>
            <form action="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/tuyen-sinh/tu-van/update" method="post" id="dinhkemform" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="{{ $ds['_id'] }}">
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
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Chuyên mục') }}</label>
                        <div class="col-md-4">
                            <select name="id_cat[]" multiple id="id_cat" class="form-control select2" data-placeholder="{{ __('Chọn chuyên mục') }}">
                                @foreach ($arr_cats as $cat)
                                    <option value="{{ $cat['id'] }}" @if(is_array($ds['id_cat']) && in_array($cat['id'], $ds['id_cat'])) selected @endif>{{ $cat['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Họ tên') }}</label>
                        <div class="col-md-4">
                            <input type="text" name="ho_ten" id="ho_ten" value="{{ $ds['ho_ten'] }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Email') }}</label>
                        <div class="col-md-4">
                            <input type="email" name="email" id="email" value="{{ $ds['email'] }}" class="form-control">
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Điện thoại') }}</label>
                        <div class="col-md-4">
                            <input type="dien_thoai" name="dien_thoai" id="dien_thoai" value="{{ $ds['dien_thoai'] }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Nội dung câu hỏi') }}</label>
                        <div class="col-12 col-md-10">
                            <textarea name="noi_dung" id="noi_dung" cols="30" rows="5" class="form-control">{{ $ds['noi_dung'] }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Trả lời') }}</label>
                        <div class="col-12 col-md-10">
                            <textarea name="tra_loi" id="tra_loi" cols="30" rows="5" class="form-control">{{ $ds['tra_loi'] }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4 switchery-demo">
                            <b>Công bố câu hỏi và trả lời:</b>&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="status" id="status" class="js-switch" data-plugin="switchery" @if($ds['status'] == 1) checked="checked" @endif data-color="#009efb" value="1"/>
                        </div>
                        <div class="col-md-4 switchery-demo">
                            <b>Câu hỏi thường gặp:</b>&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="thuong_gap" id="thuong_gap" class="js-switch" data-plugin="switchery" @if($ds['thuong_gap'] == 1) checked="checked" @endif data-color="#009efb" value="1"/>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/tuyen-sinh/tu-van" class="btn btn-light"><i class="fa fa-reply-all"></i> {{ __('Trở về') }}</a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> {{ __('Cập nhật') }}</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.js" type="text/javascript"></script>
    <script src="{{ env('APP_URL') }}assets/backend/libs/switchery/switchery.min.js"></script>
    <script src="{{ env('APP_URL') }}assets/backend/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
           $(".select2").select2();
           $('.js-switch').each(function() {
              new Switchery($(this)[0], $(this).data());
            });
            var options = {
                toolbar: [
                    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'RemoveFormat' ] },
                    { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
                    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                    { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
                    
                ],
                filebrowserImageBrowseUrl: '{{ env('APP_URL') }}laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '{{ env('APP_URL') }}laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '{{ env('APP_URL') }}laravel-filemanager?type=Files',
                filebrowserUploadUrl: '{{ env('APP_URL') }}laravel-filemanager/upload?type=Files&_token='
            };
            CKEDITOR.replace('tra_loi', options);
            CKEDITOR.replace('noi_dung', options);
        });
    </script>
@endsection