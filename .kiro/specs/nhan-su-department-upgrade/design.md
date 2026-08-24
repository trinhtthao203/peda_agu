# Design Document

## Feature: nhan-su-department-upgrade

---

## Overview

Tính năng này nâng cấp module quản lý nhân sự của Khoa Sư phạm từ mô hình **1 nhân sự – 1 đơn vị** (`subinfo_id`) sang mô hình **1 nhân sự – nhiều đơn vị** (embedded array `departments`). Đồng thời tách riêng danh mục đơn vị (Department) thành một module CRUD độc lập.

Toàn bộ stack giữ nguyên: **Laravel 11 + MongoDB** (driver `mongodb/laravel-mongodb`), Admin layout Bootstrap 4 (`Admin.layout`), controller trả view (không dùng API/JSON), route group `{locale}/admin`.

### Mục tiêu chính

- Mỗi NhanSu có thể thuộc **N đơn vị** (N = 1..20), mỗi đơn vị có chức vụ và thứ tự hiển thị riêng.
- Đơn vị được quản lý qua module **Department** độc lập (CRUD đầy đủ).
- Tương thích ngược: dữ liệu NhanSu cũ (không có trường `departments`) vẫn hoạt động bình thường.
- Không phá vỡ các route, view, và logic hiện có ngoài phạm vi của feature này.

---

## Architecture

### Tổng quan kiến trúc

```
Admin Browser
      │  HTTP (form POST / GET)
      ▼
routes/web.php  ──────────────────────────────────────────┐
  {locale}/admin/nhan-su/*  → NhanSuController            │
  {locale}/admin/department/* → DepartmentController      │
      │                                                    │
      ▼                                                    │
NhanSuController          DepartmentController            │
  - list()                  - list()                      │
  - add()                   - add()                       │
  - create()                - create()                    │
  - edit()                  - edit()                      │
  - update()                - update()                    │
  - delete()                - delete()                    │
      │                          │                        │
      ▼                          ▼                        │
NhanSu (Model)           Department (Model)               │
  MongoDB: nhan_sus        MongoDB: departments            │
  $fillable w/ departments                                 │
  getRoleInDepartment()                                    │
      │                                                    │
      └────────── Views (Admin.layout) ───────────────────┘
                Admin/NhanSu/{list,add,edit}.blade.php
                Admin/Department/{list,add,edit}.blade.php
```

### Luồng dữ liệu – Create NhanSu

```
Form POST departments[0][department_id], departments[0][chuc_vu], ...
  → NhanSuController::create()
      → validate ho_ten, email, departments[] (not empty)
      → foreach departments[]: lookup Department by id → get name
      → normalize is_primary (exactly one = true)
      → NhanSu::create(['departments' => [...DepartmentEntry...], ...])
  → redirect list with success flash
```

### Luồng dữ liệu – Update Department (name sync)

```
Form POST name, type, display_order, is_active
  → DepartmentController::update()
      → validate
      → Department::findOrFail($id)->update(...)
      → NhanSu::where('departments.department_id', $id)
             ->each: update embedded department_name
  → redirect list with success flash
```

---

## Components and Interfaces

### 1. Model: `Department` (`app/Models/Department.php`)

```php
connection  : mongodb
collection  : departments
fillable    : name, slug, type, display_order, is_active
casts       : display_order (int), is_active (bool)
```

**Không có relationships** (quan hệ với NhanSu được xử lý qua embedded array, không phải Eloquent relation).

### 2. Model: `NhanSu` (`app/Models/NhanSu.php`) – cập nhật

**Thay đổi $fillable:**
- Xóa: `subinfo_id`, `chuc_vu`, `thu_tu`
- Thêm: `departments`

**Casts:**
```php
protected $casts = [
    'departments'       => 'array',
    'ly_lich_khoa_hoc'  => 'array',
];
```

**Method mới:**
```php
public function getRoleInDepartment(?string $departmentId): ?array
```
- Trả về DepartmentEntry (array) nếu tìm thấy `department_id` khớp.
- Trả về `null` nếu `$departmentId` là null, empty string, hoặc không tìm thấy.

**Xóa:**
```php
public function boMon(): BelongsTo  // xóa hoàn toàn
```

### 3. Controller: `DepartmentController` (`app/Http/Controllers/DepartmentController.php`)

| Method    | Route                              | Mô tả                                                                 |
|-----------|------------------------------------|-----------------------------------------------------------------------|
| `list()`  | GET `admin/department`             | Lấy tất cả Department, sort `display_order` ASC, paginate(20)        |
| `add()`   | GET `admin/department/add`         | Trả view form thêm mới                                               |
| `create()`| POST `admin/department/create`     | Validate, auto-gen slug, kiểm tra slug unique, tạo record            |
| `edit()`  | GET `admin/department/edit/{id}`   | Trả view form sửa                                                     |
| `update()`| POST `admin/department/update`     | Validate, update record, sync `department_name` trong NhanSu         |
| `delete()`| GET `admin/department/delete/{id}` | Kiểm tra linked NhanSu; xóa nếu = 0, reject nếu > 0                 |

**Slug auto-generation logic:**
```
Str::slug(transliterate_vi_to_ascii($name))
```
Sử dụng `Str::slug()` của Laravel (đã xử lý ASCII transliteration cho ký tự Latin-extended). Với tiếng Việt, cần dùng hàm helper hoặc package như `cocur/slugify` để chuyển dấu → không dấu trước khi slug.

### 4. Controller: `NhanSuController` (`app/Http/Controllers/NhanSuController.php`) – cập nhật

| Method     | Thay đổi                                                                                     |
|------------|----------------------------------------------------------------------------------------------|
| `list()`   | Bỏ `->with('boMon')`, bỏ `orderBy('thu_tu')` (hoặc sort theo primary department nếu cần)   |
| `add()`    | Truyền `$departments` (Department::active) thay cho `$bo_mon` (SubInfo)                     |
| `create()` | Nhận `departments[]`, validate, auto-fill `department_name`, normalize `is_primary`         |
| `edit()`   | Truyền `$departments` và existing `$ds->departments` để pre-populate                        |
| `update()` | Tương tự create() nhưng replace toàn bộ `departments` array                                 |

### 5. Views Department (`resources/views/Admin/Department/`)

- `list.blade.php`: Table listing với cột name, type, display_order, is_active + nút Sửa/Xóa.
- `add.blade.php`: Form tạo mới (name, type select, display_order, is_active checkbox).
- `edit.blade.php`: Form sửa với pre-populated values.

### 6. Views NhanSu – cập nhật

- `list.blade.php`: Cột "Đơn vị" hiển thị badge per DepartmentEntry; primary badge = `badge-primary`, non-primary = `badge-outline-secondary`.
- `add.blade.php`: Dynamic department rows (JS), initial row 1, nút "Thêm đơn vị" / "Xóa".
- `edit.blade.php`: Tương tự add, pre-populate từ `$ds->departments`.

### 7. Routes (`routes/web.php`) – bổ sung

```php
// Department CRUD
Route::get('department',              [DepartmentController::class, 'list'])  ->name('admin-department');
Route::get('department/add',          [DepartmentController::class, 'add'])   ->name('admin-department-add');
Route::post('department/create',      [DepartmentController::class, 'create'])->name('admin-department-create');
Route::get('department/edit/{id}',    [DepartmentController::class, 'edit'])  ->name('admin-department-edit');
Route::post('department/update',      [DepartmentController::class, 'update'])->name('admin-department-update');
Route::get('department/delete/{id}',  [DepartmentController::class, 'delete'])->name('admin-department-delete');
```

---

## Data Models

### Collection: `departments`

```json
{
  "_id":           "ObjectId",
  "name":          "Bộ môn Toán",
  "slug":          "bo-mon-toan",
  "type":          "ACADEMIC",
  "display_order": 1,
  "is_active":     true,
  "created_at":    "ISODate",
  "updated_at":    "ISODate"
}
```

| Field           | Type    | Constraints                              |
|-----------------|---------|------------------------------------------|
| `name`          | string  | required, max 255                        |
| `slug`          | string  | unique trong collection                  |
| `type`          | string  | enum: `LEADERSHIP`, `ACADEMIC`, `OFFICE` |
| `display_order` | int     | range 0–9999, default 0                  |
| `is_active`     | bool    | default true                             |

### Collection: `nhan_sus` – cấu trúc mới

```json
{
  "_id":            "ObjectId",
  "ho_ten":         "TS. Nguyễn Văn A",
  "hoc_ham_hoc_vi": "Tiến sĩ",
  "email":          "nguyenvana@agu.edu.vn",
  "hinh_anh":       "1234_avatar.jpg",
  "ly_lich_khoa_hoc": {
    "title":      "LLKH_Nguyễn Văn A",
    "aliasname":  "llkh_nguyen_van_a.pdf",
    "type":       "pdf"
  },
  "departments": [
    {
      "department_id":   "ObjectId-string",
      "department_name": "Bộ môn Toán",
      "chuc_vu":         "Phó Trưởng bộ môn",
      "thu_tu":          1,
      "is_primary":      true
    },
    {
      "department_id":   "ObjectId-string-2",
      "department_name": "Ban Lãnh đạo Khoa",
      "chuc_vu":         "Phó Trưởng khoa",
      "thu_tu":          0,
      "is_primary":      false
    }
  ],
  "created_at": "ISODate",
  "updated_at": "ISODate"
}
```

**DepartmentEntry schema:**

| Field             | Type   | Constraints                                  |
|-------------------|--------|----------------------------------------------|
| `department_id`   | string | ObjectId string, must exist in `departments` |
| `department_name` | string | auto-filled from Department.name, max 255    |
| `chuc_vu`         | string | required, max 100 chars                      |
| `thu_tu`          | int    | range 0–9999, default 0                      |
| `is_primary`      | bool   | exactly one = true per NhanSu                |

**Invariant:** Trong mảng `departments` của bất kỳ NhanSu nào, có **đúng một** phần tử với `is_primary = true`.

### Backward compatibility

Các NhanSu record cũ (không có trường `departments`) sẽ trả về `[]` khi truy cập `$nhanSu->departments` nhờ cast `'array'` cùng với default value. Model sẽ dùng:

```php
public function getDepartmentsAttribute($value): array
{
    return $value ?? [];
}
```

---

## Correctness Properties

*A property is a characteristic or behavior that should hold true across all valid executions of a system — essentially, a formal statement about what the system should do. Properties serve as the bridge between human-readable specifications and machine-verifiable correctness guarantees.*

#### Phân tích và lựa chọn Properties

Sau khi phân tích prework, các property sau được giữ lại (loại bỏ redundancy):

- **1.2 và 4.2** đều test về "kết quả có đúng thứ tự/số lượng" nhưng trên hai thực thể khác nhau → giữ cả hai.
- **3.6 và 3.7** bổ sung cho nhau (all-true vs all-false), nhưng có thể gộp thành một property tổng quát về `is_primary` normalization.
- **6.1** (backward compat) là property riêng biệt, không trùng với các property khác.
- **1.5** (slug uniqueness) và **1.3** (slug generation) là hai property khác nhau; giữ cả hai.

---

### Property 1: Department list is sorted by display_order

*For any* collection of Department records with arbitrary `display_order` values, when the list endpoint is called, the returned records SHALL be ordered by `display_order` in ascending order.

**Validates: Requirements 1.2**

---

### Property 2: Department slug is generated as lowercase ASCII with hyphens

*For any* valid `name` string (including Vietnamese characters), when a Department is created, the auto-generated `slug` SHALL consist only of lowercase ASCII letters, digits, and hyphens — with no Vietnamese diacritics, no spaces, and no uppercase letters.

**Validates: Requirements 1.3**

---

### Property 3: Duplicate slug is rejected on create

*For any* two Department create requests whose `name` values produce the same auto-generated `slug`, the second request SHALL be rejected with a slug-collision error, and only the first Department record SHALL exist in the collection.

**Validates: Requirements 1.5**

---

### Property 4: Department name update propagates to all linked NhanSu DepartmentEntry objects

*For any* Department record referenced by N NhanSu records (N ≥ 1), when that Department's `name` is updated, ALL N NhanSu records' `departments` array entries whose `department_id` matches SHALL have their `department_name` updated to the new value.

**Validates: Requirements 1.6**

---

### Property 5: Delete is blocked when Department has linked NhanSu records

*For any* Department referenced by N NhanSu records (N ≥ 1), the delete request SHALL be rejected and the Department record SHALL remain in the collection; the error response SHALL include the count N.

**Validates: Requirements 1.8**

---

### Property 6: Exactly one is_primary per NhanSu — normalization invariant

*For any* NhanSu create or update request with a `departments[]` array of 1–20 elements (regardless of how many elements have `is_primary = true` — zero, one, or multiple), after the NhanSuController processes the request, the stored `departments` array SHALL contain **exactly one** DepartmentEntry with `is_primary = true`, and it SHALL be the first element that had `is_primary = true` in the submitted array (or the first element overall if none were marked primary).

**Validates: Requirements 2.2, 3.6, 3.7**

---

### Property 7: getRoleInDepartment returns the correct entry or null

*For any* NhanSu record with a `departments` array of 0–20 entries, calling `getRoleInDepartment($id)` SHALL return the DepartmentEntry whose `department_id` equals `$id` if it exists, or `null` if it does not exist; calling with `null` or empty string SHALL always return `null` regardless of array contents.

**Validates: Requirements 2.4, 2.5**

---

### Property 8: department_name is auto-filled from Department.name on create and update

*For any* valid NhanSu create or update request containing M department assignments with valid `department_id` values, each stored `DepartmentEntry.department_name` SHALL equal the `name` field of the corresponding Department record at the time of the operation.

**Validates: Requirements 3.5**

---

### Property 9: Invalid department_id causes rejection without data mutation

*For any* NhanSu create or update request containing at least one `department_id` that does not exist in the `departments` collection, the controller SHALL reject the request, and the `nhan_sus` collection SHALL remain unchanged (no new record created; existing record unmodified on update).

**Validates: Requirements 3.3, 3.4**

---

### Property 10: Department badge count matches DepartmentEntry count

*For any* NhanSu record with N DepartmentEntry objects (N ≥ 1), the rendered NhanSu list view SHALL display exactly N department badges for that staff row.

**Validates: Requirements 4.2**

---

### Property 11: Primary badge has distinct CSS class from non-primary badges

*For any* NhanSu record with one primary and M non-primary departments (M ≥ 0), the rendered list view SHALL apply a visually distinct CSS class to the primary badge compared to all non-primary badges.

**Validates: Requirements 4.4**

---

### Property 12: Edit form pre-populates exactly N department rows

*For any* NhanSu record with N DepartmentEntry objects (N ≥ 1), the rendered edit form SHALL contain exactly N department input rows, each pre-populated with the corresponding `department_id`, `chuc_vu`, `thu_tu`, and `is_primary` values from the stored array.

**Validates: Requirements 5.4**

---

### Property 13: Old NhanSu records without departments field return empty array

*For any* NhanSu document in the `nhan_sus` collection that does not have a `departments` field (i.e., was created before this upgrade), accessing `$nhanSu->departments` in PHP SHALL return an empty array `[]` without throwing any exception or PHP error.

**Validates: Requirements 6.1**

---

## Error Handling

### Validation errors

Tất cả validation errors đều được xử lý theo pattern Laravel standard (redirect back with errors), nhất quán với codebase hiện tại:

```php
$request->validate([...]);
// Laravel tự redirect back với $errors bag khi validation fail
```

### Lỗi nghiệp vụ (business logic)

| Tình huống                                    | Xử lý                                                         |
|-----------------------------------------------|---------------------------------------------------------------|
| Slug trùng khi tạo Department                 | Redirect back with error message về slug collision           |
| Department không tồn tại khi tạo NhanSu       | Redirect back with error, không tạo NhanSu                   |
| Xóa Department đang có NhanSu liên kết        | Redirect back with error kèm số lượng NhanSu liên kết        |
| NhanSu/Department không tìm thấy (edit/delete) | `findOrFail()` → Laravel tự ném 404 ModelNotFoundException   |
| departments[] rỗng khi tạo/update NhanSu      | Redirect back with validation error                          |

### File upload errors

Giữ nguyên pattern hiện tại:
- Ảnh chân dung: upload vào `public/storage/avatars/`
- Lý lịch khoa học PDF: upload vào `public/storage/files/`
- Nếu không upload file mới, giữ nguyên giá trị cũ

### Backward compatibility — old NhanSu records

Các record cũ không có trường `departments` được handle tại model layer (attribute accessor + `?? []`), không cần migration hay data transformation tại controller.

---

## Testing Strategy

### Đánh giá phù hợp của Property-Based Testing (PBT)

Feature này bao gồm logic nghiệp vụ thuần (pure function-like): slug generation, `is_primary` normalization, `getRoleInDepartment` lookup, department name sync, validation logic. PBT **phù hợp** cho các property này vì:
- Input space lớn (tên tiếng Việt đa dạng, N phần tử departments, N NhanSu liên kết).
- Behavior thay đổi có nghĩa với input khác nhau.
- Không cần gọi external service thật (dùng mock/in-memory MongoDB).

**PBT library đề xuất:** [PestPHP](https://pestphp.com/) + [pest-plugin-laravel](https://github.com/pestphp/pest-plugin-laravel) kết hợp với [eris/eris](https://github.com/giorgiosironi/eris) hoặc tự viết generator với Pest's `dataset`. Tối thiểu **100 iterations** mỗi property test.

### Dual Testing Approach

#### Unit / Feature Tests (Example-based)

- Department CRUD: list, create, update, delete với dữ liệu cụ thể.
- Validation errors: thiếu `name`, thiếu `type`, empty `departments[]`.
- `findOrFail` → 404 cho NhanSu/Department không tồn tại.
- File upload: upload ảnh và PDF, giữ nguyên file cũ khi không upload mới.
- Backward compat: NhanSu cũ không có `departments` field.

#### Property-Based Tests

Mỗi property test phải có comment tag:
```
Feature: nhan-su-department-upgrade, Property {N}: {property_text}
```

| Property | Tag                    | Generator                                              | Assertion                                        |
|----------|------------------------|--------------------------------------------------------|--------------------------------------------------|
| P1       | P1: Department list sorted | Random array of departments with random display_order  | Output is sorted ASC by display_order            |
| P2       | P2: Slug is ASCII lowercase | Random Vietnamese strings as name                    | Slug matches /^[a-z0-9\-]+$/                    |
| P3       | P3: Duplicate slug rejected | Pairs of names yielding same slug                    | Second create returns error, count = 1           |
| P4       | P4: Name sync to NhanSu | N random NhanSu + one department; update dept name    | All N NhanSu entries have new department_name    |
| P5       | P5: Delete blocked by linked NhanSu | N NhanSu referencing same dept           | Delete rejected, error includes count N          |
| P6       | P6: is_primary normalization | Arrays with 0, 1, or multiple is_primary=true      | Exactly one is_primary=true after processing     |
| P7       | P7: getRoleInDepartment | Random departments arrays + IDs in/not in array      | Returns correct entry or null                    |
| P8       | P8: department_name auto-fill | M valid department assignments                   | Each DepartmentEntry.department_name = Department.name |
| P9       | P9: Invalid dept_id rejected | Arrays with at least one non-existent dept_id      | Rejected; collection unchanged                   |
| P10      | P10: Badge count = entry count | N DepartmentEntry objects                         | N badges rendered                                |
| P11      | P11: Primary badge distinct CSS | 1 primary + M non-primary                        | Primary has different CSS class                  |
| P12      | P12: Edit form pre-populates N rows | N DepartmentEntry objects                  | N rows with correct values                       |
| P13      | P13: Old records return empty array | NhanSu docs without departments field        | ->departments returns []                         |

#### Integration Tests

- Department list với actual MongoDB (smoke test): lấy được danh sách, phân trang hoạt động.
- NhanSu list không còn eager-load `boMon`: verify query không có `with('boMon')`.

#### UI / JavaScript Tests

- "Thêm đơn vị" button appends new row (browser test hoặc Dusk).
- "Xóa" button removes row; disabled khi chỉ còn 1 row.
- Form submit với multiple department rows: verify correct input names `departments[i][field]`.

### Test Configuration

```
Minimum 100 iterations per property test
Seed: fixed seed for reproducibility in CI
```
