@extends('Admin.layout')
@section('title', 'Cập nhật hồ sơ cán bộ')
@section('body')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin-nhan-su') }}" class="text-decoration-none text-muted">← Quay lại danh sách</a>
        <h1 class="h3 mt-2 text-gray-800">Chỉnh sửa Hồ sơ Cán bộ - Giảng viên</h1>
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
            <form action="{{ route('admin-nhan-su-update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $ds->_id }}">

                <div class="row">
                    <div class="col-md-5 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Họ và Tên <span class="text-danger">*</span></label>
                        <input type="text" name="ho_ten" class="form-control" required value="{{ $ds->ho_ten }}">
                    </div>
                    <div class="col-md-4 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Học hàm - Học vị</label>
                        <input type="text" name="hoc_ham_hoc_vi" class="form-control" value="{{ $ds->hoc_ham_hoc_vi }}">
                    </div>
                    <div class="col-md-3 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Email công vụ AGU <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required value="{{ $ds->email }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group mb-3">
                        <label class="font-weight-bold text-gray-700">Chuyên ngành</label>
                        <input type="text" name="chuyen_nganh" class="form-control" placeholder="Ví dụ: Toán học, Giáo dục học, Ngữ văn..." value="{{ $ds->chuyen_nganh }}">
                    </div>
                </div>

                {{-- Dynamic Department Rows --}}
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-gray-700">Đơn vị công tác <span class="text-danger">*</span></label>
                    <div id="department-list">
                        @php $existingDepts = $ds->departments ?? []; @endphp
                        @if(!empty($existingDepts))
                            @foreach($existingDepts as $i => $entry)
                            <div class="department-row border rounded p-3 mb-2 bg-light" data-index="{{ $i }}">
                                <div class="row align-items-end">
                                    <div class="col-md-4 form-group mb-2">
                                        <label class="small text-muted">Đơn vị</label>
                                        <select name="departments[{{ $i }}][department_id]" class="form-control" required>
                                            <option value="">-- Chọn đơn vị --</option>
                                            @foreach($departments as $dept)
                                            <option value="{{ $dept->_id }}" {{ $entry['department_id'] == $dept->_id ? 'selected' : '' }}>
                                                {{ $dept->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group mb-2">
                                        <label class="small text-muted">Chức vụ <span class="text-danger">*</span></label>
                                        <input type="text" name="departments[{{ $i }}][chuc_vu]" class="form-control" required value="{{ $entry['chuc_vu'] ?? '' }}">
                                    </div>
                                    <div class="col-md-2 form-group mb-2">
                                        <label class="small text-muted">Thứ tự</label>
                                        <input type="number" name="departments[{{ $i }}][thu_tu]" class="form-control" value="{{ $entry['thu_tu'] ?? 0 }}" min="0" max="9999">
                                    </div>
                                    <div class="col-md-1 form-group mb-2 d-flex align-items-center">
                                        <div class="form-check mt-3">
                                            <input type="checkbox" name="departments[{{ $i }}][is_primary]" class="form-check-input" value="1"
                                                id="is_primary_{{ $i }}" {{ !empty($entry['is_primary']) ? 'checked' : '' }}>
                                            <label class="form-check-label small" for="is_primary_{{ $i }}">Chính</label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 form-group mb-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-dept" {{ count($existingDepts) === 1 ? 'disabled' : '' }}>✕</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="department-row border rounded p-3 mb-2 bg-light" data-index="0">
                                <div class="row align-items-end">
                                    <div class="col-md-4 form-group mb-2">
                                        <label class="small text-muted">Đơn vị</label>
                                        <select name="departments[0][department_id]" class="form-control" required>
                                            <option value="">-- Chọn đơn vị --</option>
                                            @foreach($departments as $dept)
                                            <option value="{{ $dept->_id }}">{{ $dept->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group mb-2">
                                        <label class="small text-muted">Chức vụ <span class="text-danger">*</span></label>
                                        <input type="text" name="departments[0][chuc_vu]" class="form-control" required>
                                    </div>
                                    <div class="col-md-2 form-group mb-2">
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
                        @endif
                    </div>
                    <button type="button" id="btn-add-dept" class="btn btn-sm btn-outline-success mt-1">➕ Thêm đơn vị</button>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Thay đổi ảnh chân dung (Để trống nếu giữ nguyên)</label>
                        <input type="file" name="hinh_anh" class="form-control-file border p-2 w-100 rounded bg-light mb-2" accept="image/*">
                        @if($ds->hinh_anh)
                        <div class="text-xs text-muted">File hiện tại: <span class="text-monospace">{{ $ds->hinh_anh }}</span></div>
                        @endif
                    </div>
                    <div class="col-md-6 form-group mb-4">
                        <label class="font-weight-bold text-gray-700">Thay đổi tệp Lý lịch khoa học PDF</label>
                        <input type="file" name="ly_lich_khoa_hoc" class="form-control-file border p-2 w-100 rounded bg-light mb-2" accept=".pdf">
                        @if(isset($ds->ly_lich_khoa_hoc['aliasname']))
                        <div class="text-xs text-muted">File hiện tại: <span class="text-monospace text-success">{{ $ds->ly_lich_khoa_hoc['aliasname'] }}</span></div>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4">💾 Lưu các thay đổi</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
(function () {
    var deptOptions = `<option value="">-- Chọn đơn vị --</option>` +
        @foreach($departments as $dept)
        `<option value="{{ $dept->_id }}">{{ $dept->name }}</option>` +
        @endforeach
        ``;

    var rowCount = {{ count($ds->departments ?? []) ?: 1 }};

    function updateRemoveButtons() {
        var rows = document.querySelectorAll('.department-row');
        rows.forEach(function (row) {
            var btn = row.querySelector('.btn-remove-dept');
            btn.disabled = rows.length === 1;
        });
    }

    document.getElementById('btn-add-dept').addEventListener('click', function () {
        var idx = rowCount++;
        var row = document.createElement('div');
        row.className = 'department-row border rounded p-3 mb-2 bg-light';
        row.dataset.index = idx;
        row.innerHTML = `
            <div class="row align-items-end">
                <div class="col-md-4 form-group mb-2">
                    <label class="small text-muted">Đơn vị</label>
                    <select name="departments[${idx}][department_id]" class="form-control" required>
                        ${deptOptions}
                    </select>
                </div>
                <div class="col-md-4 form-group mb-2">
                    <label class="small text-muted">Chức vụ <span class="text-danger">*</span></label>
                    <input type="text" name="departments[${idx}][chuc_vu]" class="form-control" required>
                </div>
                <div class="col-md-2 form-group mb-2">
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

    document.getElementById('department-list').addEventListener('click', function (e) {
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
