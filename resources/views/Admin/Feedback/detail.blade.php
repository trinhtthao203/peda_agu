@extends('Admin.layout')

@section('title', 'Chi tiết & Xử lý Ý kiến')

@section('body')
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">THÔNG TIN Ý KIẾN</h5>
            </div>
            <div class="card-body">
                <p><strong>Người gửi:</strong> {{ $feedback->fullname ?? 'Ẩn danh' }}</p>
                <p><strong>Đối tượng:</strong> {{ $feedback->sender_type }}</p>
                <p><strong>Liên hệ:</strong> {{ $feedback->contact ?? 'Không cung cấp' }}</p>
                <p><strong>Chủ đề:</strong> {{ $feedback->topic }}</p>
                <p><strong>Thời gian gửi:</strong> {{ $feedback->created_at ? date('d/m/Y H:i:s', strtotime($feedback->created_at)) : '' }}</p>
                <p><strong>Địa chỉ IP:</strong> {{ $feedback->ip_address }}</p>
                <hr>
                <h6><strong>Nội dung đóng góp:</strong></h6>
                <div class="p-3 bg-light rounded border text-break">
                    {{ $feedback->content }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0 text-white">PHÂN CÔNG & PHẢN HỒI</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-feedback-update', ['id' => $feedback->_id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Trạng thái xử lý:</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $feedback->status == 'pending' ? 'selected' : '' }}>Chờ tiếp nhận</option>
                            <option value="assigned" {{ $feedback->status == 'assigned' ? 'selected' : '' }}>Đã phân công giải quyết</option>
                            <option value="responded" {{ $feedback->status == 'responded' ? 'selected' : '' }}>Đã trả lời / Hoàn tất</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Đơn vị / Cán bộ phụ trách xử lý:</label>
                        <input type="text" name="assigned_to" value="{{ $feedback->assigned_to }}" placeholder="VD: Bộ môn Toán / Thầy Nguyễn Văn A" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Đơn vị / Người ký phản hồi:</label>
                        <input type="text" name="responder_name" value="{{ $feedback->responder_name }}" placeholder="VD: Ban Chủ nhiệm Khoa Sư phạm" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Nội dung trả lời / Giải pháp:</label>
                        <textarea name="response_content" rows="6" placeholder="Nhập nội dung phản hồi giải đáp..." class="form-control">{{ $feedback->response_content }}</textarea>
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="publishCheck" {{ $feedback->is_published ? 'checked' : '' }}>
                        <label class="form-check-label font-weight-bold text-success" for="publishCheck">
                            Công khai câu hỏi và câu trả lời này lên trang Web
                        </label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin-feedback') }}" class="btn btn-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-success">Lưu cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
