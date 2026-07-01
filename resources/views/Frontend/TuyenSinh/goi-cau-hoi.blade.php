@extends('Frontend.TuyenSinh.layout')
@section('title', __('Tư vấn tuyển sinh') .' - '. __('Gởi câu hỏi'))
@section('css')
<style>
    #QuestionForm input,  #QuestionForm select, #QuestionForm textarea {
        font-size: 18px;
    }
    #QuestionForm textarea {
        padding: 20px;
    }
</style>
@endsection
@section('body')
<section class="bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-container text-left sm">
                    <div class="title-wrap">
                        <h4 class="title">{{ __('Gởi câu hỏi') }}</h4>
                        <span class="separator line-separator"></span>
                    </div>							
                </div><!-- Name -->
            </div><!-- Column -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Form Begins -->
                <form action="{{ env('APP_URL') }}{{ app()->getLocale() }}/tuyen-sinh/tu-van-tuyen-sinh/goi-cau-hoi/create" method="POST" id="QuestionForm">
                    {{ csrf_field() }}
                    <!-- Field 1 -->
                    <div class="row">
                        <div class="col-12 col-md-2 text-right text-label p-t-18">{{ __('Chuyên mục') }} (*)</div>
                        <div class="col-12 col-md-4 input-text form-group"> 
                            <select name="id_cat" id="id_cat" class="input-name form-control" required>
                                <option value="">{{ __('Chọn chuyên mục cần hỏi') }}</option>
                                @foreach($arr_cats as $cat)
                                    <option value="{{ $cat['id'] }}">{{ $cat['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-2 text-right text-label p-t-18">{{ __('Họ tên') }} (*)</div>
                        <div class="col-12 col-md-4 input-text form-group">
                            <input type="text" name="ho_ten" id="ho_ten" class="input-name form-control" placeholder="{{ __('Họ tên') }}" required>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-12 col-md-2 text-right text-label p-t-18">{{ __('Email') }}</div>
                        <div class="col-12 col-md-4 input-email form-group">
                            <input type="email" name="email" class="input-email form-control" placeholder="{{ __('Địa chỉ Email') }}">
                        </div>
                        <div class="col-12 col-md-2 text-right text-label p-t-18">{{ __('Điện thoại') }}</div>
                        <div class="col-12 col-md-4 input-email form-group">
                            <input type="tel" name="dien_thoai" class="input-phone form-control" placeholder="{{ __('Số điện thoại') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-2 text-right text-label">{{ __('Nội dung câu hỏi') }} (*)</div>
                        <div class="col-12 col-md-10  textarea-message form-group">
                            <textarea name="noi_dung" id="noi_dung" class="textarea-message form-control" placeholder="{{ __('Nội dung câu hỏi') }}" rows="8" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12 text-right">
                            <button class="btn" type="submit">{{ __('Gởi câu hỏi') }} <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div><!-- Column -->
        </div>
        <div class="alert alert-danger" role="alert" style="margin-top:10px;">
            <p><span class="text-danger"><strong>{{ __('Lưu ý') }}:</strong></span> {{ __('Một số câu hỏi không có phản hồi do nội dung bị trùng với những câu hỏi đã được trả lời trước đó. Các bạn vui lòng tham khảo các câu hỏi đã được trả lời dưới đây.') }}</p>
        </div>
    </div>
</section>
 <!-- Modal -->
<div class="modal fade" id="modalThongBao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Thông tin gởi câu hỏi tư vấn') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h5>{{ __('Câu hỏi của Anh/Chị đã được gởi đến Ban tư vấn. Ban tư vấn sẽ trả lời câu hỏi của Anh/Chị sớm nhất có thể.') }}</h5>
            <h5>{{ __('Cám ơn Anh/Chị đã gởi câu hỏi') }}</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Đóng') }}</button>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('js')
    <script src="{{ env('APP_URL') }}assets/backend/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            @if(Session::has('msg') && Session::get("msg"))
                $("#modalThongBao").modal('show');
            @endif
            var options = {
                toolbar: [
                    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'RemoveFormat' ] },
                    { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] }
                ]
            };
            CKEDITOR.replace('noi_dung', options);
        });
    </script>
  @endsection