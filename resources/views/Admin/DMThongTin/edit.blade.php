@extends('Admin.layout')
@section('title', __('Chỉnh sửa'))
@section('css')
<link href="{{ env('APP_URL') }}assets/backend/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h3 class="m-t-0"><a href="{{ env('APP_URl') }}{{ app()->getLocale() }}/admin/danh-muc-thong-tin" class="btn btn-primary btn-sm"><i class="mdi mdi-reply-all"></i> {{ __('Trở về') }}</a> {{ __('Chỉnh sửa') }} {{ __('Danh mục Thông tin') }}</h3>
            <form action="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/danh-muc-thong-tin/update" method="post" id="dinhkemform" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="{{ $ds['_id'] }}" placeholder="">
                <input type="hidden" name="trans_id" id="trans_id" value="{{ $trans_id }}" placeholder="">
                <input type="hidden" name="trans_lang" id="trans_lang" value="{{ $trans_lang }}" placeholder="">
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
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Tiêu đề') }}</label>
                        <div class="col-md-10">
                            <input type="text" id="ten" name="ten" class="form-control" placeholder="{{ __('Tiêu đề') }}" value="{{ old('ten') != null ? old('ten') : $ds['ten'] }}" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Slug') }}</label>
                        <div class="col-md-10">
                            <input type="text" id="slug" name="slug" class="form-control" placeholder="{{ __('Slug') }}" value="{{ old('slug') != null ? old('slug') : $ds['slug'] }}" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Thứ tự') }}</label>
                        <div class="col-md-4">
                            <input type="number" id="thu_tu" name="thu_tu" class="form-control" placeholder="{{ __('Thứ tự') }}" value="{{ old('thu_tu') != null ? old('thu_tu') : $ds['thu_tu'] }}" required />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/danh-muc-thong-tin" class="btn btn-light"><i class="fa fa-reply-all"></i> {{ __('Trở về') }}</a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> {{ __('Cập nhật') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $("#ten").change(function() {
            var ten = $(this).val();
            var path = "{{ env('APP_URL') }}{{ app()->getLocale() }}/slug/" + ten;
            $.get(path, function(slug) {
                $("#slug").val(slug);
            });
        });
    });
</script>
@endsection