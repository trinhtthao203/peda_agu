@extends('Admin.layout')

@section('title', 'Quản lý Ý kiến & Phản hồi')

@section('body')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">TIẾP NHẬN Ý KIẾN TỪ NGƯỜI HỌC & DOANH NGHIỆP</h4>
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-center">STT</th>
                        <th width="18%">Người gửi</th>
                        <th width="15%">Chủ đề</th>
                        <th>Nội dung đóng góp</th>
                        <th width="12%" class="text-center">Trạng thái</th>
                        <th width="10%" class="text-center">Công khai</th>
                        <th width="12%" class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feedbacks as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $item->fullname ?? 'Ẩn danh' }}</strong><br>
                            <small class="text-muted">{{ $item->contact }}</small><br>
                            <span class="badge bg-secondary">
                                @if($item->sender_type == 'student') Người học/SV
                                @elseif($item->sender_type == 'business') Doanh nghiệp
                                @elseif($item->sender_type == 'alumni') Cựu SV
                                @else Khác @endif
                            </span>
                        </td>
                        <td>
                            @if($item->topic == 'dao-tao') <span class="badge bg-primary">Đào tạo</span>
                            @elseif($item->topic == 'co-so-vat-chat') <span class="badge bg-info">Cơ sở vật chất</span>
                            @elseif($item->topic == 'viec-lam') <span class="badge bg-warning">Tuyển dụng & Việc làm</span>
                            @else <span class="badge bg-dark">Khác</span> @endif
                        </td>
                        <td>
                            <p class="mb-1 text-truncate" style="max-width: 320px;">{{ $item->content }}</p>
                            <small class="text-muted">{{ $item->created_at ? date('d/m/Y H:i', strtotime($item->created_at)) : '' }}</small>
                        </td>
                        <td class="text-center">
                            @if($item->status == 'pending')
                            <span class="badge bg-danger">Chờ tiếp nhận</span>
                            @elseif($item->status == 'assigned')
                            <span class="badge bg-warning">Đã phân công</span>
                            @else
                            <span class="badge bg-success">Đã trả lời</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->is_published)
                            <span class="badge bg-success">Công khai</span>
                            @else
                            <span class="badge bg-light text-dark border">Nội bộ</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin-feedback-detail', ['id' => $item->_id]) }}" class="btn btn-sm btn-primary">
                                Xử lý
                            </a>
                            <a href="{{ route('admin-feedback-delete', ['id' => $item->_id]) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa?');" class="btn btn-sm btn-danger">
                                Xóa
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Chưa có ý kiến đóng góp nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $feedbacks->links() }}
        </div>
    </div>
</div>
@endsection
