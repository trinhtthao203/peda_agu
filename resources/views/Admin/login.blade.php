<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ __("KHOA SƯ PHẠM, ĐẠI HỌC QUỐC GIA TPHCM TRƯỜNG ĐẠI HỌC AN GIANG") }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ __("KHOA SƯ PHẠM, ĐẠI HỌC QUỐC GIA TPHCM TRƯỜNG ĐẠI HỌC AN GIANG") }}" name="description" />
    <meta content="Phan Minh Trung - trungminhphan@gmail.com" name="author" />

    <!-- App favicon (Đã thêm type phòng lỗi cache trình duyệt) -->
    <link rel="shortcut icon" href="{{ env('APP_URL') }}assets/backend/images/favicon.png">

    <!-- CDN CSS (Bootstrap & Icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css">

    <!-- Local App css (Giữ lại các file giao diện riêng) -->
    <link href="{{ env('APP_URL') }}assets/backend/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ env('APP_URL') }}assets/backend/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body class="account-pages">
    <!-- Begin page -->
    <div class="accountbg" style="background: url('{{ env('APP_URL') }}assets/backend/images/bg.jpg'); background-size: contain; background-position: center; background-repeat: no-repeat;"></div>
    <div class="wrapper-page account-page-full">
        <div class="card shadow-none">
            <div class="card-block">
                <div class="account-box">
                    <div class="card-box shadow-none p-4 mt-2">
                        <h2 class="text-uppercase text-center pb-3">
                            <a href="{{ env('APP_URL') }}" class="text-success">
                                <span><img src="{{ env('APP_URL') }}assets/backend/images/logo_{{ app()->getLocale() }}.png" alt="" height="60"></span>
                            </a>
                        </h2>
                        <div class="language">
                            <ul>
                                @foreach($arr_lang as $klang => $vlang)
                                @php
                                $id = isset($id) ? $id : App\Http\Controllers\ObjectController::Id();
                                $link = route(\Illuminate\Support\Facades\Route::currentRouteName(), array($klang, 'id='.$id.'&url='.$destination));
                                @endphp
                                <li>
                                    <a href="{{ $link }}">
                                        <img src="{{ env('APP_URL') }}assets/backend/images/flags/{{ $klang }}.jpg" style="height:15px;" /> {{ $vlang }}
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </div>

                        <form action="{{ env('APP_URL') . app()->getLocale() }}/auth/login" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="url" value="{{ isset($destination) ? $destination : '' }}" />
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="emailaddress">{{ __("Username") }}</label>
                                    <input class="form-control" type="text" id="username" name="username" required="" placeholder="{{ __("Username") }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="password">{{ __("Password") }}</label>
                                    <input class="form-control" type="password" required name="password" id="password" placeholder="{{ __("Password") }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="checkbox checkbox-primary">
                                        <input id="remember" type="checkbox" checked="">
                                        <label for="remember">{{ __("Remember login") }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row text-center">
                                <div class="col-12">
                                    <button class="btn btn-block btn-primary waves-effect waves-light" type="submit"><i class="fas fa-lock"></i> {{ __("Login") }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <p class="account-copyright">© 2022 {{ __("ĐẠI HỌC QUỐC GIA TPHCM TRƯỜNG ĐẠI HỌC AN GIANG") }}</p>
        </div>
    </div>
    <!-- Vendor js -->
    <script src="{{ env('APP_URL') }}assets/backend/js/vendor.min.js"></script>
    <!-- App js -->
    <script src="{{ env('APP_URL') }}assets/backend/js/app.min.js"></script>
</body>

</html>