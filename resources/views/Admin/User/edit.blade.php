@extends('Admin.layout')
@section('title') Chỉnh sửa tài khoản người dùng @endsection
@section('css')
<link href="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/switchery/switchery.min.css">
<link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/magnific-popup.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h3 class="m-t-0"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/user" class="btn btn-primary btn-sm"><i class="mdi mdi-reply-all"></i> {{ __('Trở về') }}</a> {{ __('Chỉnh sửa tài khoản người dùng') }}</h3>
            <form action="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/user/update" method="post" id="dinhkemform" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="{{ $user['_id'] }}" />
                <div class="form-body">
                    <hr>
                    @if($errors->any())
                    <div class="alert alert-danger">
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
                                <label class="control-label col-md-2 text-right p-t-10">{{ __('Tên đăng nhập') }}</label>
                                <div class="col-md-4">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="{{ __('Tên đăng nhập') }}" value="{{ old('email') !== null ? old('username') : $user['username'] }}" required readonly />
                                </div>
                                <label class="control-label col-md-2 text-right p-t-10">{{ __('Mật khẩu') }}</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="password" id="password" name="password" class="form-control pwd-input" placeholder="{{ __('Mật khẩu') }} ({{ __('>= 8 ký tự') }})">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary toggle-pwd" type="button">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2 text-right p-t-10">{{ __('Họ và tên') }}</label>
                                <div class="col-md-4">
                                    <input type="text" id="fullname" name="fullname" class="form-control" placeholder="{{ __('Họ và tên') }}" value="{{ old('fullname') !== null ? old('fullname') : $user['fullname'] }}">
                                </div>
                                <label class="control-label col-md-2 text-right p-t-10">{{ __('Xác nhận mật khẩu') }}</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control pwd-input" placeholder="{{ __('Nhập lại mật khẩu') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary toggle-pwd" type="button">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2 text-right p-t-10">{{ __('Điện thoại') }}</label>
                                <div class="col-md-4">
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="{{ __('Điện thoại') }}" value="{{ old('phone') !== null ? old('phone') : $user['phone'] }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            @php
                            // Đảm bảo dữ liệu cũ hoặc từ database luôn ép về dạng mảng để hàm in_array không bị lỗi
                            $roleses = old('roles') !== null ? old('roles') : (isset($user['roles']) ? (array)$user['roles'] : []);
                            @endphp
                            <select class="select2 m-b-10 select2-multiple" name="roles[]" style="width: 100%" multiple="multiple" data-placeholder="{{ __('Chọn quyền') }}">
                                @if($roles)
                                @foreach($roles as $role => $role_name)
                                <option value="{{ $role }}" @if(in_array($role, $roleses)) selected @endif>{{ $role_name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> {{ __('Cập nhật') }}</button>
                            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/user" class="btn btn-light"><i class="mdi mdi-reply-all"></i> {{ __('Trở về') }}</a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.js" type="text/javascript"></script>
<script src="{{ env('APP_URL') }}assets/backend/libs/switchery/switchery.min.js"></script>
<script type="text/javascript" src="{{ env('APP_URL') }}assets/backend/libs/isotope/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="{{ env('APP_URL') }}assets/backend/js/drag-arrange.min.js"></script>
<script src="{{ env('APP_URL') }}assets/backend/js/script.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2();
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        $('.toggle-pwd').click(function() {
            var input = $(this).closest('.input-group').find('.pwd-input');
            var icon = $(this).find('i');

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                // Xóa class mắt mở, thêm class mắt đóng chuẩn của Bootstrap
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            } else {
                input.attr('type', 'password');
                // Xóa class mắt đóng, quay lại class mắt mở chuẩn
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            }
        });
    });
</script>
@endsection