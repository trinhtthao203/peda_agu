@extends('Admin.layout')
@section('title', 'Thêm cán bộ mới')
@section('body')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin-nhan-su') }}" class="text-decoration-none text-muted">← Quay lại danh sách</a>
        <h1 class="h3 mt-2 text-gray-800">Thêm Cán bộ - Giảng viên mới</h1>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin-nhan-su-create') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Language Tabs -->
                <ul class="nav nav-tabs mb-4" id="langTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active font-weight-bold" id="vi-tab" data-toggle="tab" href="#vi" role="tab">🇻🇳 Tiếng Việt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="en-tab" data-toggle="tab" href="#en" role="tab">🇬🇧 English</a>
                    </li>
                </ul>

                <div class="tab-content" id="langTabContent">
                    <!-- Tab Tiếng Việt -->
                    <div class="tab-pane fade show active" id="vi" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-bold text-gray-700">Họ và Tên <span class="text-danger">*</span></label>
                                <input type="text" name="ho_ten" class="form-control" required placeholder="Ví dụ: TS. Nguyễn Văn A" value="{{ old('ho_ten') }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-bold text-gray-700">Học hàm - Học vị</label>
                                <input type="text" name="hoc_ham_hoc_vi" class="form-control" placeholder="Ví dụ: Phó Giáo sư, Tiến sĩ" value="{{ old('hoc_ham_hoc_vi') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label class="font-weight-bold text-gray-700">Chuyên ngành</label>
                                <input type="text" name="chuyen_nganh" class="form-control" placeholder="Ví dụ: Toán học, Giáo dục học, Ngữ văn..." value="{{ old('chuyen_nganh') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Tab English -->
                    <div class="tab-pane fade" id="en" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-bold text-gray-700">Full Name (EN)</label>
                                <input type="text" name="ho_ten_en" class="form-control" placeholder="e.g. Dr. Nguyen Van A" value="{{ old('ho_ten_en') }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-bold text-gray-700">Academic Title / Degree (EN)</label>
                                <input type="text" name="hoc_ham_hoc_vi_en" class="form-control" placeholder="e.g. Assoc. Prof., Ph.D" value="{{ old('hoc_ham_hoc_vi_en') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label class="font-weight-bold text-gray-700">Major / Academic Field (EN)</label>
                                <input type="text" name="chuyen_nganh_en" class="form-control" placeholder="e.g. Mathematics, Education, Literature..." value="{{ old('chuyen_nganh_en') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Email công vụ AGU <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required placeholder="username@agu.edu.vn" value="{{ old('email') }}">
                    </div>
                </div>

                {{-- Dynamic Department Rows --}}
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-700">Đơn vị công tác <span class="text-danger">*</span></label>
                    <div id="department-list">
                        <div class="department-row border rounded p-3 mb-2 bg-light" data-index="0">
                            <div class="row align-items-end">
                                <div class="col-md-3 form-group mb-2">
                                    <label class="small text-muted">Đơn vị</label>
                                    <select name="departments[0][department_id]" class="form-control" required>
                                        <option value="">-- Chọn đơn vị --</option>
                                        @foreach($departments as $dept)
                                        <option value="{{ $dept->_id }}">{{ $dept->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form-group mb-2">
                                    <label class="small text-muted">Chức vụ (VI) <span class="text-danger">*</span></label>
                                    <input type="text" name="departments[0][chuc_vu]" class="form-control" required placeholder="VD: Giảng viên, Trưởng BM">
                                </div>
                                <div class="col-md-3 form-group mb-2">
                                    <label class="small text-muted">Chức vụ (EN)</label>
                                    <input type="text" name="departments[0][chuc_vu_en]" class="form-control" placeholder="e.g. Lecturer, Head of Dept">
                                </div>
                                <div class="col-md-1 form-group mb-2">
                                    <label class="small text-muted">Thứ tự</label>
                                    <input type="number" name="departments[0][thu_tu]" class="form-control" value="0" min="0" max="9999">
                                </div>
                                <div class="col-md-1 form-group mb-2 d-flex align-items-center">
                                    <div class="form-check mt-3">
                                        <input type="checkbox" name="departments[0][is_primary]" class="form-check-input" value="1" id="is_primary_0" checked>
                                        <label class="form-check-label small" for="is_primary_0">Chính</label>
                                    </div>
                                </div>
                                <div class="col-md-1 form-group mb-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-dept" disabled>✕</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="btn-add-dept" class="btn btn-sm btn-outline-success mt-1">➕ Thêm đơn vị</button>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Ảnh chân dung (.jpg, .png)</label>
                        <input type="file" name="hinh_anh" class="form-control-file border p-2 w-100 rounded bg-light" accept="image/*">
                    </div>
                    <div class="col-md-6 form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Tệp đính kèm Lý lịch khoa học (.pdf)</label>
                        <input type="file" name="ly_lich_khoa_hoc" class="form-control-file border p-2 w-100 rounded bg-light" accept=".pdf">
                    </div>
                </div>

                <button type="submit" class="btn btn-success px-4">💾 Tạo hồ sơ cán bộ</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    (function() {
        var deptOptions = `<option value="">-- Chọn đơn vị --</option>` +
            @foreach($departments as $dept)
        `<option value="{{ $dept->_id }}">{{ $dept->name }}</option>` +
        @endforeach
            ``;

        var rowCount = 1;

        function updateRemoveButtons() {
            var rows = document.querySelectorAll('.department-row');
            rows.forEach(function(row) {
                var btn = row.querySelector('.btn-remove-dept');
                btn.disabled = rows.length === 1;
            });
        }

        document.getElementById('btn-add-dept').addEventListener('click', function() {
            var idx = rowCount++;
            var row = document.createElement('div');
            row.className = 'department-row border rounded p-3 mb-2 bg-light';
            row.dataset.index = idx;
            row.innerHTML = `
            <div class="row align-items-end">
                <div class="col-md-3 form-group mb-2">
                    <label class="small text-muted">Đơn vị</label>
                    <select name="departments[${idx}][department_id]" class="form-control" required>
                        ${deptOptions}
                    </select>
                </div>
                <div class="col-md-3 form-group mb-2">
                    <label class="small text-muted">Chức vụ (VI) <span class="text-danger">*</span></label>
                    <input type="text" name="departments[${idx}][chuc_vu]" class="form-control" required placeholder="VD: Giảng viên">
                </div>
                <div class="col-md-3 form-group mb-2">
                    <label class="small text-muted">Chức vụ (EN)</label>
                    <input type="text" name="departments[${idx}][chuc_vu_en]" class="form-control" placeholder="e.g. Lecturer">
                </div>
                <div class="col-md-1 form-group mb-2">
                    <label class="small text-muted">Thứ tự</label>
                    <input type="number" name="departments[${idx}][thu_tu]" class="form-control" value="0" min="0" max="9999">
                </div>
                <div class="col-md-1 form-group mb-2 d-flex align-items-center">
                    <div class="form-check mt-3">
                        <input type="checkbox" name="departments[${idx}][is_primary]" class="form-check-input" value="1" id="is_primary_${idx}">
                        <label class="form-check-label small" for="is_primary_${idx}">Chính</label>
                    </div>
                </div>
                <div class="col-md-1 form-group mb-2 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-dept">✕</button>
                </div>
            </div>`;
            document.getElementById('department-list').appendChild(row);
            updateRemoveButtons();
        });

        document.getElementById('department-list').addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-remove-dept') && !e.target.disabled) {
                var rows = document.querySelectorAll('.department-row');
                if (rows.length > 1) {
                    e.target.closest('.department-row').remove();
                    updateRemoveButtons();
                }
            }
        });
    })();
</script>
@endsection