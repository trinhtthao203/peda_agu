@extends('Admin.layout')
@section('title', __('Banner'))
@section('css')
<link href="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="row">
    <div class="col-12 card-box">
        <h3 class="m-t-0"><a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/banner/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ __('Thêm mới') }}</a> {{ __('BANNER') }}</h3>
        @if($danhsach)
        <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ __('STT') }}</th>
                    <th>{{ __('Hình ảnh') }}</th>
                    <th>{{ __('Tiêu đề') }}</th>
                    <th>{{ __('Thứ tự') }}</th>
                    <th>{{ __('Trạng thái') }}</th>
                    <th>{{ __('Trang chủ') }}</th>
                    <!-- <th>{{ __('Tuyển sinh') }}</th>
                    <th>{{ __('PTBV') }}</th> -->
                    <th class="text-center">#</th>
                </tr>
            </thead>
            <tbody>
                @foreach($danhsach as $k => $ds)
                <tr>
                    <td class="text-center">{{ ($k+1) }}</td>
                    <td class="text-center">
                        @if(isset($ds['photos'][0]['aliasname']) && $ds['photos'][0]['aliasname'])
                        <img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ $ds['photos'][0]['aliasname'] }}" height="20">
                        @else
                        {{ __('NO IMAGE') }}
                        @endif
                    </td>
                    <td>{{ $ds['title'] }}</td>
                    <td class="text-center">{{ $ds['order'] }}</td>
                    <td class="text-center">
                        @if($ds['status'] == 1)
                        <i class="fas fa-check-circle text-primary"></i>
                        @else
                        <i class="fas fa-circle text-default"></i>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($ds['trang_chu'] == 1)
                        <i class="fas fa-check-circle text-primary"></i>
                        @else
                        <i class="fas fa-circle text-default"></i>
                        @endif
                    </td>
                    <!-- <td class="text-center">
                        @if($ds['tuyen_sinh'] == 1)
                        <i class="fas fa-check-circle text-primary"></i>
                        @else
                        <i class="fas fa-circle text-default"></i>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($ds['phat_trien_ben_vung'] == 1)
                        <i class="fas fa-check-circle text-primary"></i>
                        @else
                        <i class="fas fa-circle text-default"></i>
                        @endif
                    </td> -->
                    <td class="text-center">
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/banner/delete/{{$ds['_id']}}" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-danger"></i></a>
                        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/banner/edit/{{$ds['_id']}}"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
@section('js')
<script src="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2();
    });
</script>
@endsection