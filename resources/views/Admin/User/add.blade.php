@extends('Admin.layout')
@section('title') {{ __('Thêm tài khoản người dùng') }} @endsection
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
            <h3 class="m-t-0"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/user" class="btn btn-primary"><i class="mdi mdi-reply-all"></i></a> {{ __('Thêm tài khoản người dùng') }}</h3>
            <form action="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/user/create" method="post" id="dinhkemform" enctype="multipart/form-data">
                {{ csrf_field() }}
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
                                    <input type="text" id="username" name="username" class="form-control" placeholder="{{ __('Tên đăng nhập') }}" value="{{ old('username') }}" required />
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
                                    <input type="text" id="fullname" name="fullname" class="form-control" placeholder="{{ __('Họ và tên') }}" value="{{ old('fullname') }}" required>
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
                                <label class="control-label col-md-2 text-right p-t-10">{{ __('Số điện thoại') }}</label>
                                <div class="col-md-4">
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="{{ __('Số điện thoại') }}" value="{{ old('phone') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Quyền') }}</label>
                        <div class="col-md-10">
                            @if(isset($roles) && $roles)
                            @foreach($roles as $key => $value)
                            <div class="checkbox checkbox-primary form-check-inline">
                                <input type="checkbox" name="roles[]" id="role_{{ $key }}" value="{{ $key }}"
                                    {{ is_array(old('roles')) && in_array($key, old('roles')) ? 'checked' : '' }}>
                                <label for="role_{{ $key }}"> {{ $value }} </label>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i>{{ __('Cập nhật') }}</button>
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/user" class="btn btn-light"><i class="mdi mdi-reply-all"></i> {{ __('Trở về') }}</a>
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
        $("#roles").select2({
            placeholder: "{{ __('Chọn quyền') }}"
        });
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