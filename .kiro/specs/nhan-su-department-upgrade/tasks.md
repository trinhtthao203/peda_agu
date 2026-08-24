# Implementation Plan: nhan-su-department-upgrade

## Overview

Nâng cấp module quản lý nhân sự từ mô hình 1 nhân sự – 1 đơn vị sang 1 nhân sự – nhiều đơn vị, đồng thời tách Department thành module CRUD độc lập. Stack: **Laravel 11 + MongoDB** (driver `mongodb/laravel-mongodb`), Admin layout Bootstrap 4, controller trả view, route group `{locale}/admin`.

Thứ tự triển khai: Department Model → Department CRUD → NhanSu Model → NhanSu Controller → Views.

---

## Tasks

- [x] 1. Tạo Model Department và cấu hình MongoDB collection
  - Tạo file `app/Models/Department.php` kế thừa `MongoDB\Laravel\Eloquent\Model`
  - Khai báo `$connection = 'mongodb'`, `$collection = 'departments'`
  - Khai báo `$fillable`: `name`, `slug`, `type`, `display_order`, `is_active`
  - Khai báo `$casts`: `display_order` → `int`, `is_active` → `bool`
  - Thêm scope `scopeActive($query)` trả về `where('is_active', true)` để dùng trong NhanSuController
  - Không khai báo relationship (quan hệ với NhanSu xử lý qua embedded array)
  - _Requirements: 1.1, 2.1_

  - [x] 1.1 Tạo file `app/Models/Department.php`
    - Nội dung như trên, bao gồm scope `active()`
    - _Requirements: 1.1_

  - [ ]* 1.2 Viết unit test cho Department model
    - Test instantiation, fillable fields, casts hoạt động đúng (`display_order` là int, `is_active` là bool)
    - Test scope `active()` lọc đúng các bản ghi có `is_active = true`
    - _Requirements: 1.1_

- [x] 2. Tạo DepartmentController với đầy đủ CRUD và đăng ký routes
  - [x] 2.1 Tạo file `app/Http/Controllers/DepartmentController.php`
    - Implement `list()`: lấy tất cả Department, `orderBy('display_order', 'asc')`, `paginate(20)`; pass `$danhsach` vào view `Admin.Department.list`
    - Implement `add()`: trả view `Admin.Department.add`
    - Implement `create(Request $request)`:
      - Validate: `name` required|max:255, `type` required|in:LEADERSHIP,ACADEMIC,OFFICE, `display_order` integer|min:0|max:9999, `is_active` boolean
      - Auto-generate slug: helper transliterate tiếng Việt → ASCII, sau đó `Str::slug()`
      - Kiểm tra slug unique trong collection; nếu trùng → redirect back với lỗi
      - `Department::create([...])`, redirect `admin-department` với flash success
    - Implement `edit($locale, $id)`: `Department::findOrFail($id)`, trả view `Admin.Department.edit` với `$dp`
    - Implement `update(Request $request)`:
      - Validate tương tự create
      - `Department::findOrFail($id)->update([...])`
      - Sync `department_name` trong tất cả NhanSu liên kết: `NhanSu::where('departments.department_id', $id)->each(fn => update embedded name)`
      - Redirect `admin-department` với flash success
    - Implement `delete($locale, $id)`:
      - Đếm NhanSu liên kết: `NhanSu::where('departments.department_id', $id)->count()`
      - Nếu > 0 → redirect back với lỗi kèm số lượng
      - Nếu = 0 → `Department::findOrFail($id)->delete()`, redirect với success
    - _Requirements: 1.2, 1.3, 1.4, 1.5, 1.6, 1.7, 1.8, 1.9_

  - [x] 2.2 Đăng ký routes Department trong `routes/web.php`
    - Thêm 6 route vào nhóm `admin` (middleware `checkauth`, `role:Admin,Manager,Updater`) theo pattern hiện có:
      ```
      GET  department              → DepartmentController@list   (admin-department)
      GET  department/add          → DepartmentController@add    (admin-department-add)
      POST department/create       → DepartmentController@create (admin-department-create)
      GET  department/edit/{id}    → DepartmentController@edit   (admin-department-edit)
      POST department/update       → DepartmentController@update (admin-department-update)
      GET  department/delete/{id}  → DepartmentController@delete (admin-department-delete)
      ```
    - Thêm `use App\Http\Controllers\DepartmentController;` ở đầu file
    - _Requirements: 1.10_

  - [ ]* 2.3 Viết property test cho P1: Department list sorted by display_order
    - **Property 1: Department list is sorted by display_order**
    - Generator: tạo array ngẫu nhiên các Department với `display_order` ngẫu nhiên (0–9999), insert vào MongoDB test DB, gọi `DepartmentController::list()` hoặc trực tiếp `Department::orderBy('display_order','asc')->get()`
    - Assertion: kết quả trả về có `display_order` tăng dần (ASC) — tức là `$result[i]->display_order <= $result[i+1]->display_order` với mọi i
    - Minimum 100 iterations; dùng Pest dataset hoặc eris generator
    - **Validates: Requirements 1.2**

  - [ ]* 2.4 Viết property test cho P2: Slug is ASCII lowercase
    - **Property 2: Department slug is generated as lowercase ASCII with hyphens**
    - Generator: random Vietnamese strings làm `name` (bao gồm dấu sắc/huyền/nặng/hỏi/ngã, ký tự đặc biệt)
    - Assertion: `slug` kết quả chỉ khớp regex `/^[a-z0-9\-]+$/` — không có ký tự Việt, không có hoa, không có khoảng trắng
    - Minimum 100 iterations
    - **Validates: Requirements 1.3**

  - [ ]* 2.5 Viết property test cho P3: Duplicate slug rejected
    - **Property 3: Duplicate slug is rejected on create**
    - Generator: tạo cặp `name` values cho cùng slug (ví dụ: "Bộ môn Toán" và "Bo Mon Toan" → cùng slug)
    - Assertion: sau khi create đầu tiên thành công, create thứ hai trả về lỗi slug-collision; collection chỉ có đúng 1 record với slug đó
    - Minimum 100 iterations
    - **Validates: Requirements 1.5**

  - [ ]* 2.6 Viết property test cho P4: Name update propagates to all NhanSu
    - **Property 4: Department name update propagates to all linked NhanSu DepartmentEntry objects**
    - Generator: tạo 1 Department + N NhanSu (N = 1..10) cùng tham chiếu department đó; random new `name` cho Department
    - Assertion: sau `update()`, tất cả N NhanSu records có `departments[*].department_name` = new name
    - Minimum 100 iterations
    - **Validates: Requirements 1.6**

  - [ ]* 2.7 Viết property test cho P5: Delete blocked by linked NhanSu
    - **Property 5: Delete is blocked when Department has linked NhanSu records**
    - Generator: tạo 1 Department + N NhanSu (N = 1..10) liên kết
    - Assertion: `delete()` bị reject; Department vẫn còn trong collection; error message chứa số N
    - Minimum 100 iterations
    - **Validates: Requirements 1.8**

- [x] 3. Checkpoint — Kiểm tra Department module hoàn chỉnh
  - Đảm bảo tất cả tests Department pass, ask the user nếu có thắc mắc.

- [x] 4. Cập nhật Model NhanSu hỗ trợ đa đơn vị
  - [x] 4.1 Cập nhật `app/Models/NhanSu.php`
    - Xóa `subinfo_id`, `chuc_vu`, `thu_tu` khỏi `$fillable`; thêm `departments`
    - Thêm `$casts`: `departments => 'array'`, `ly_lich_khoa_hoc => 'array'`
    - Thêm accessor `getDepartmentsAttribute($value): array` trả về `$value ?? []` (backward compat)
    - Thêm method `getRoleInDepartment(?string $departmentId): ?array` — nếu `$departmentId` null/empty trả `null`; nếu không, duyệt `$this->departments` tìm entry có `department_id` khớp, trả entry hoặc `null`
    - Xóa method `boMon()` (belongsTo SubInfo)
    - Xóa `use App\Models\SubInfo;` nếu không còn dùng
    - _Requirements: 2.1, 2.2, 2.3, 2.4, 2.5, 2.6, 6.1_

  - [ ]* 4.2 Viết property test cho P7: getRoleInDepartment returns correct entry or null
    - **Property 7: getRoleInDepartment returns the correct entry or null**
    - Generator: NhanSu với 0–20 DepartmentEntry ngẫu nhiên; test với ID có trong array, ID không có trong array, null, empty string
    - Assertion: trả về đúng DepartmentEntry khi ID tồn tại; trả `null` khi không có hoặc input null/empty
    - Minimum 100 iterations
    - **Validates: Requirements 2.4, 2.5**

  - [ ]* 4.3 Viết property test cho P13: Old records return empty array
    - **Property 13: Old NhanSu records without departments field return empty array**
    - Generator: NhanSu document không có trường `departments` (tạo thẳng vào MongoDB không qua model)
    - Assertion: `$nhanSu->departments` trả về `[]` không ném exception/PHP error
    - Minimum 100 iterations
    - **Validates: Requirements 6.1**

- [x] 5. Cập nhật NhanSuController
  - [x] 5.1 Cập nhật `app/Http/Controllers/NhanSuController.php`
    - `list()`: bỏ `->with('boMon')` và `orderBy('thu_tu', 'asc')`; dùng `NhanSu::paginate(20)` hoặc sort theo primary department name nếu cần
    - `add()`: thay `$bo_mon = SubInfo::...` bằng `$departments = Department::active()->orderBy('display_order','asc')->get()`; pass `$departments` vào view
    - `create(Request $request)`:
      - Validate: `ho_ten` required, `email` required|email, `departments` required|array|min:1|max:20, `departments.*.department_id` required, `departments.*.chuc_vu` required|max:100
      - Validate từng `department_id` tồn tại trong collection `departments`; nếu không → redirect back với lỗi, không tạo NhanSu
      - Normalize `is_primary`: giữ đúng 1 phần tử đầu tiên có `is_primary = true`; nếu không có phần tử nào → set phần tử đầu tiên = true
      - Auto-fill `department_name` từ `Department::find($id)->name`
      - Build array `$deptEntries` và `NhanSu::create([..., 'departments' => $deptEntries])`
      - Xóa các field cũ: không lưu `subinfo_id`, `chuc_vu` đơn lẻ, `thu_tu` đơn lẻ
    - `edit($locale, $id)`: thay `$bo_mon = SubInfo::...` bằng `$departments = Department::active()->...`; giữ `$ds = NhanSu::findOrFail($id)`
    - `update(Request $request)`: logic tương tự `create()` nhưng replace toàn bộ `$ns->departments`; giữ nguyên logic upload file ảnh và PDF
    - Xóa `use App\Models\SubInfo;` và `use App\Models\SubInfo` nếu không còn dùng; thêm `use App\Models\Department;`
    - _Requirements: 3.1, 3.2, 3.3, 3.4, 3.5, 3.6, 3.7, 4.1_

  - [ ]* 5.2 Viết property test cho P6: is_primary normalization invariant
    - **Property 6: Exactly one is_primary per NhanSu — normalization invariant**
    - Generator: arrays với 1–20 DepartmentEntry, trong đó số lượng `is_primary = true` ngẫu nhiên (0, 1, hoặc nhiều hơn)
    - Assertion: sau `create()` hoặc `update()`, `count(array_filter($stored, fn($e) => $e['is_primary']))` === 1; phần tử primary là phần tử đầu tiên có `is_primary = true` (hoặc phần tử đầu tiên nếu không có)
    - Minimum 100 iterations
    - **Validates: Requirements 2.2, 3.6, 3.7**

  - [ ]* 5.3 Viết property test cho P8: department_name auto-filled from Department.name
    - **Property 8: department_name is auto-filled from Department.name on create and update**
    - Generator: M Department records hợp lệ (M = 1..20); NhanSu create/update request với M `department_id` hợp lệ
    - Assertion: mỗi `DepartmentEntry.department_name` trong bản ghi được lưu === `Department::find($id)->name`
    - Minimum 100 iterations
    - **Validates: Requirements 3.5**

  - [ ]* 5.4 Viết property test cho P9: Invalid department_id causes rejection
    - **Property 9: Invalid department_id causes rejection without data mutation**
    - Generator: NhanSu create/update request với ít nhất 1 `department_id` không tồn tại trong collection
    - Assertion: request bị reject (redirect với lỗi); collection `nhan_sus` không thay đổi (không có record mới; record cũ không bị sửa)
    - Minimum 100 iterations
    - **Validates: Requirements 3.3, 3.4**

- [x] 6. Tạo Views Admin/Department (list, add, edit)
  - [x] 6.1 Tạo `resources/views/Admin/Department/list.blade.php`
    - Kế thừa `Admin.layout`, dùng Bootstrap 4 nhất quán với các view hiện có
    - Table listing với các cột: STT, Tên đơn vị, Slug, Loại (`type`), Thứ tự, Trạng thái (Active badge), Thao tác (Sửa / Xóa)
    - Nút "Thêm mới" link đến `admin-department-add`
    - Hiển thị flash message success/error
    - Phân trang dùng `$danhsach->links()`
    - _Requirements: 1.2, 1.10_

  - [x] 6.2 Tạo `resources/views/Admin/Department/add.blade.php`
    - Form POST đến route `admin-department-create`
    - Các trường: `name` (text, required), `type` (select: LEADERSHIP/ACADEMIC/OFFICE, required), `display_order` (number, default 0), `is_active` (checkbox, default checked)
    - Hiển thị validation errors (dùng `$errors`)
    - _Requirements: 1.3, 1.4_

  - [x] 6.3 Tạo `resources/views/Admin/Department/edit.blade.php`
    - Form POST đến route `admin-department-update` với hidden `id`
    - Pre-populate tất cả fields từ `$dp` (Department object)
    - Cấu trúc tương tự add.blade.php
    - _Requirements: 1.6, 1.7_

- [x] 7. Cập nhật Views Admin/NhanSu (list, add, edit)
  - [x] 7.1 Cập nhật `resources/views/Admin/NhanSu/list.blade.php`
    - Thay cột "Bộ môn" (single) bằng cột "Đơn vị" hiển thị badges
    - Với mỗi NhanSu: dùng `@foreach($ns->departments as $entry)` → render badge với `$entry['department_name']`
    - Primary badge (`is_primary = true`): class `badge badge-primary`
    - Non-primary badge: class `badge badge-outline-secondary`
    - Nếu `$ns->departments` rỗng → text "Chưa phân đơn vị"
    - _Requirements: 4.1, 4.2, 4.3, 4.4_

  - [ ]* 7.2 Viết property test cho P10: Badge count matches DepartmentEntry count
    - **Property 10: Department badge count matches DepartmentEntry count**
    - Generator: NhanSu record với N DepartmentEntry (N = 1..20); render view bằng `$this->view()` (Pest/Laravel)
    - Assertion: số lượng phần tử `.badge` trong rendered HTML === N
    - Minimum 100 iterations
    - **Validates: Requirements 4.2**

  - [ ]* 7.3 Viết property test cho P11: Primary badge has distinct CSS class
    - **Property 11: Primary badge has distinct CSS class from non-primary badges**
    - Generator: NhanSu với 1 primary + M non-primary (M = 0..19); render list view
    - Assertion: badge với `is_primary = true` có class `badge-primary`; tất cả non-primary có class `badge-outline-secondary` (khác với primary)
    - Minimum 100 iterations
    - **Validates: Requirements 4.4**

  - [x] 7.4 Cập nhật `resources/views/Admin/NhanSu/add.blade.php`
    - Xóa dropdown `subinfo_id` cũ, xóa input `chuc_vu` và `thu_tu` đơn lẻ
    - Thêm section "Phân đơn vị" với container `#department-list`
    - Initial row (row index 0) chứa: `<select name="departments[0][department_id]">` (options từ `$departments`), `<input name="departments[0][chuc_vu]">`, `<input name="departments[0][thu_tu]" type="number" value="0">`, `<input name="departments[0][is_primary]" type="checkbox">`
    - Nút "Thêm đơn vị" (id `btn-add-dept`) để append row mới
    - Nút "Xóa" trên mỗi row để remove row; disabled khi chỉ còn 1 row
    - JavaScript (inline hoặc file riêng): xử lý add/remove row, cập nhật index, enable/disable nút Xóa
    - _Requirements: 5.1, 5.2, 5.3, 5.5_

  - [x] 7.5 Cập nhật `resources/views/Admin/NhanSu/edit.blade.php`
    - Tương tự add.blade.php nhưng pre-populate từ `$ds->departments`
    - Dùng Blade `@foreach($ds->departments as $i => $entry)` để render N rows với giá trị từ `$entry`
    - Checkbox `is_primary` được checked nếu `$entry['is_primary'] === true`
    - _Requirements: 5.4, 5.5_

  - [ ]* 7.6 Viết property test cho P12: Edit form pre-populates exactly N rows
    - **Property 12: Edit form pre-populates exactly N department rows**
    - Generator: NhanSu với N DepartmentEntry (N = 1..20); render edit view
    - Assertion: HTML chứa đúng N department input rows, mỗi row có giá trị `department_id`, `chuc_vu`, `thu_tu`, `is_primary` khớp với stored data
    - Minimum 100 iterations
    - **Validates: Requirements 5.4**

- [x] 8. Checkpoint — Đảm bảo toàn bộ tests pass
  - Ensure all tests pass, ask the user nếu có thắc mắc.

---

## Notes

- Tasks đánh dấu `*` là optional và có thể bỏ qua cho MVP nhanh hơn.
- Mỗi task đều tham chiếu số requirement cụ thể để đảm bảo traceability.
- Property tests (P1–P13) cần minimum 100 iterations và fixed seed để reproducible trong CI.
- PBT library: [PestPHP](https://pestphp.com/) + [eris/eris](https://github.com/giorgiosironi/eris) hoặc Pest `dataset()` với generated data.
- Backward compatibility (P13): NhanSu cũ không có `departments` field sẽ trả `[]` nhờ accessor — không cần migration data.
- Sync `department_name` khi update Department: dùng MongoDB embedded array query `departments.department_id` — cần kiểm tra driver `mongodb/laravel-mongodb` hỗ trợ dot-notation update.
- Sau khi hoàn thành tất cả tasks, **không deploy** — chạy `php artisan test` và kiểm tra trực tiếp trên browser.

---

## Task Dependency Graph

```json
{
  "waves": [
    { "id": 0, "tasks": ["1.1"] },
    { "id": 1, "tasks": ["1.2", "2.1"] },
    { "id": 2, "tasks": ["2.2", "2.3", "2.4", "2.5", "2.6", "2.7"] },
    { "id": 3, "tasks": ["4.1", "6.1", "6.2", "6.3"] },
    { "id": 4, "tasks": ["4.2", "4.3", "5.1"] },
    { "id": 5, "tasks": ["5.2", "5.3", "5.4", "7.1", "7.4", "7.5"] },
    { "id": 6, "tasks": ["7.2", "7.3", "7.6"] }
  ]
}
```
