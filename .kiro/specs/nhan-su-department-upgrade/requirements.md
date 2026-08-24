# Requirements Document

## Introduction

Tính năng này nâng cấp hệ thống quản lý nhân sự của Khoa Sư phạm (Laravel 11 + MongoDB) từ mô hình một nhân sự - một đơn vị sang mô hình một nhân sự - nhiều đơn vị. Hiện tại, mỗi nhân sự chỉ thuộc một đơn vị (`subinfo_id`) với một chức vụ (`chuc_vu`) và một thứ tự hiển thị (`thu_tu`) cố định. Sau nâng cấp, một nhân sự có thể thuộc **nhiều đơn vị (Department)** với chức vụ và thứ tự riêng biệt tại mỗi đơn vị, đồng thời hệ thống quản lý danh mục đơn vị được tách riêng thành module độc lập.

## Glossary

- **NhanSu**: Cán bộ, giảng viên thuộc Khoa Sư phạm, được quản lý trong collection MongoDB `nhan_sus`.
- **Department**: Đơn vị trực thuộc khoa (bộ môn, văn phòng, ban lãnh đạo…), được lưu trong collection MongoDB `departments`.
- **DepartmentEntry**: Một phần tử nhúng (embedded object) trong mảng `departments` của NhanSu, biểu diễn mối quan hệ giữa NhanSu và một Department kèm chức vụ và thứ tự riêng. Gồm 4 trường bắt buộc: `department_id`, `department_name`, `chuc_vu`, `is_primary`, và 1 trường tùy chọn: `thu_tu`.
- **Department_System**: Toàn bộ các thành phần (model, controller, routes, views) liên quan đến Department và NhanSu trong phạm vi tính năng này.
- **NhanSu_Controller**: Controller PHP `NhanSuController` xử lý các yêu cầu CRUD cho NhanSu.
- **Department_Controller**: Controller PHP `DepartmentController` xử lý các yêu cầu CRUD cho Department.
- **Admin_User**: Người dùng có quyền quản trị hệ thống (vai trò Admin, Manager hoặc Updater).
- **Primary_Department**: Đơn vị chính (`is_primary = true`) trong danh sách `departments` của một NhanSu — mỗi NhanSu có đúng một Primary_Department.

## Requirements

### Requirement 1: Quản lý danh mục Department

**User Story:** As an Admin_User, I want to manage the department directory, so that I can assign staff to the correct departments when creating or editing staff profiles.

#### Acceptance Criteria

1. THE Department_System SHALL store each Department with the fields: `name` (string, required, max 255 chars), `slug` (string, unique), `type` (enum: `LEADERSHIP` | `ACADEMIC` | `OFFICE`), `display_order` (int, range 0–9999), `is_active` (boolean).
2. WHEN an Admin_User accesses the department list page, THE Department_Controller SHALL return all Department records sorted by `display_order` ascending.
3. WHEN an Admin_User submits the create-department form with a valid `name` and `type`, THE Department_Controller SHALL create a new record in the `departments` collection and auto-generate `slug` from `name` by converting to lowercase, transliterating Vietnamese characters to ASCII, and replacing spaces with hyphens.
4. IF an Admin_User submits the create-department form without `name` or without `type`, THEN THE Department_Controller SHALL reject the request and return one validation error message per missing required field.
5. IF the auto-generated `slug` from `name` already exists in the `departments` collection, THEN THE Department_Controller SHALL reject the create request and return an error message indicating slug collision.
6. WHEN an Admin_User submits the update-department form with a valid `name` and `type` for an existing Department, THE Department_Controller SHALL update the matching Department record and synchronise the cached `department_name` field in all NhanSu records whose `departments` array contains a DepartmentEntry referencing that Department's identifier.
7. IF the Department record to be updated does not exist, THEN THE Department_Controller SHALL return a not-found error and not modify any data.
8. IF one or more NhanSu records reference the Department to be deleted, THEN THE Department_Controller SHALL reject the delete request and return an error message listing the count of linked staff records.
9. WHEN an Admin_User deletes a Department that has zero linked NhanSu records, THE Department_Controller SHALL remove the Department record from the `departments` collection.
10. THE Department_System SHALL expose routes with prefix `admin/department` covering the actions: list, add, create, edit, update, delete.

---

### Requirement 2: Nâng cấp Model NhanSu hỗ trợ đa đơn vị

**User Story:** As an Admin_User, I want a staff member to belong to multiple departments simultaneously with a distinct role in each, so that the org chart of the faculty is accurately represented.

#### Acceptance Criteria

1. THE Department_System SHALL replace the fields `subinfo_id`, `chuc_vu`, and `thu_tu` in NhanSu `$fillable` with the field `departments` (array of DepartmentEntry objects).
2. THE Department_System SHALL store each DepartmentEntry with: `department_id` (string ObjectId), `department_name` (string, max 255 chars, copied from the department record at the time of assignment), `chuc_vu` (string, max 100 chars), `thu_tu` (int, range 0–9999), `is_primary` (boolean); exactly one DepartmentEntry per NhanSu record SHALL have `is_primary = true`.
3. THE Department_System SHALL configure the NhanSu model so that the `departments` field and the `ly_lich_khoa_hoc` field are automatically cast to PHP arrays when read from MongoDB.
4. WHEN code calls `$nhanSu->getRoleInDepartment($departmentId)` with a valid non-empty string `$departmentId`, THE Department_System SHALL search the current `departments` array of that NhanSu record and return the DepartmentEntry whose `department_id` matches; IF no matching entry exists, THEN THE Department_System SHALL return `null`.
5. IF `$nhanSu->getRoleInDepartment($departmentId)` is called with a `null` or empty string argument, THEN THE Department_System SHALL return `null` immediately without searching the `departments` array.
6. THE Department_System SHALL remove the `boMon()` relationship (belongsTo SubInfo) from the NhanSu model; all department data SHALL be read exclusively from the embedded `departments` array.

---

### Requirement 3: Tạo và cập nhật NhanSu với nhiều đơn vị

**User Story:** As an Admin_User, I want to create and update staff profiles with multiple department assignments and individual roles per department, so that staff management is more flexible.

#### Acceptance Criteria

1. WHEN an Admin_User submits the create-NhanSu form with a `departments[]` array containing 1–20 elements, each element having a non-empty `department_id` and a `chuc_vu` of 1–100 characters, THE NhanSu_Controller SHALL create a new NhanSu record with the `departments` field stored as a valid array of DepartmentEntry objects including `department_id`, `department_name`, `chuc_vu`, and `is_primary`.
2. IF an Admin_User submits the create-NhanSu form with an empty or missing `departments[]` array, THEN THE NhanSu_Controller SHALL reject the request and return an error message requiring at least 1 department.
3. IF an Admin_User submits the create-NhanSu form with a `department_id` that does not exist in the `departments` collection, THEN THE NhanSu_Controller SHALL reject the request and return an invalid-department error message; the NhanSu record SHALL NOT be created.
4. WHEN an Admin_User submits the update-NhanSu form with a valid `departments[]` array (1–20 elements, each with a valid `department_id` and `chuc_vu`), THE NhanSu_Controller SHALL replace the entire existing `departments` array with the new data; IF any `department_id` in the submitted array does not exist in the `departments` collection, THEN THE NhanSu_Controller SHALL reject the request and preserve the existing `departments` array unchanged.
5. WHEN THE NhanSu_Controller processes a valid create or update request, THE NhanSu_Controller SHALL auto-fill `department_name` in each DepartmentEntry by looking up the `name` field in the `departments` collection using `department_id`.
6. IF the `departments[]` form data contains more than one element with `is_primary = true`, THEN THE NhanSu_Controller SHALL retain only the first element with `is_primary = true` and set `is_primary = false` on all remaining elements.
7. IF the `departments[]` form data contains no element with `is_primary = true`, THEN THE NhanSu_Controller SHALL automatically set `is_primary = true` on the first element in the array.

---

### Requirement 4: Danh sách NhanSu hiển thị đầy đủ thông tin đa đơn vị

**User Story:** As an Admin_User, I want the staff list to display all departments each person belongs to, so that I can quickly understand the organisational structure.

#### Acceptance Criteria

1. WHEN an Admin_User accesses the NhanSu list page, THE NhanSu_Controller SHALL return a paginated list of NhanSu records (using the existing pagination configuration) without eager-loading the removed `boMon` relationship.
2. WHEN the NhanSu list page renders a staff member who has one or more DepartmentEntry objects, THE Department_System SHALL display each department name as a separate badge (one badge per DepartmentEntry, using `department_name`).
3. WHEN the NhanSu list page renders a staff member whose `departments` array is empty or missing, THE Department_System SHALL display a placeholder text "Chưa phân đơn vị" instead of badges.
4. WHEN the NhanSu list page renders, THE Department_System SHALL display the Primary_Department badge with a visually distinct style (e.g., filled/solid badge) compared to non-primary department badges (e.g., outlined badge).

---

### Requirement 5: Form add/edit NhanSu hỗ trợ dynamic department rows

**User Story:** As an Admin_User, I want the add and edit staff forms to support adding and removing multiple department rows dynamically via JavaScript, so that managing multiple departments in one interface is straightforward.

#### Acceptance Criteria

1. WHEN an Admin_User accesses the add-NhanSu form, THE Department_System SHALL display exactly one initial department input row containing: a Department `<select>` populated with all active Departments, a `chuc_vu` text input, a `thu_tu` number input (default 0), and an `is_primary` checkbox.
2. WHEN an Admin_User clicks the "Thêm đơn vị" button, THE Department_System SHALL append a new department input row (with the same fields as criterion 1) to the department list container via JavaScript, without reloading the page.
3. WHEN an Admin_User clicks the "Xóa" button on a department row and two or more rows currently exist, THE Department_System SHALL remove that specific row from the DOM via JavaScript; WHEN only one row remains, THE Department_System SHALL disable or hide the "Xóa" button on that row so removal is not possible.
4. WHEN an Admin_User accesses the edit-NhanSu form for a NhanSu record with N DepartmentEntry objects (N ≥ 1), THE Department_System SHALL pre-populate exactly N department input rows with values from the `departments` array: selected `department_id`, `chuc_vu`, `thu_tu`, and `is_primary` checked state.
5. WHEN the add or edit form is submitted, THE Department_System SHALL transmit department data as PHP-compatible indexed arrays using input names: `departments[0][department_id]`, `departments[0][chuc_vu]`, `departments[0][thu_tu]`, `departments[0][is_primary]`, incrementing the index for each subsequent row.

---

### Requirement 6: Tương thích ngược với dữ liệu cũ

**User Story:** As an Admin_User, I want the upgrade to be backward-compatible and not corrupt existing data, so that no staff information entered previously is lost.

#### Acceptance Criteria

1. IF a NhanSu record in the `nhan_sus` collection does not have a `departments` field (i.e., it is an old record created before this upgrade), THEN accessing `$nhanSu->departments` SHALL return an empty array `[]` without throwing any PHP error or exception.
2. WHEN THE Department_System processes any NhanSu record during a create or update operation, THE Department_System SHALL verify that the following fields are present and of valid types before writing: `ho_ten` (string), `hoc_ham_hoc_vi` (string or null), `email` (string), `hinh_anh` (string or null), `ly_lich_khoa_hoc` (array or null); IF any of these fields is found to be of an invalid type in the submitted data, THEN THE Department_System SHALL abort the entire operation and return a validation error, leaving the existing record unchanged.
