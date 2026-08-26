<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\NhanSu;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function list()
    {
        $danhsach = Department::orderBy('display_order', 'asc')->paginate(20);
        return view('Admin.Department.list', compact('danhsach'));
    }

    public function add()
    {
        return view('Admin.Department.add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'          => 'required|max:255',
            'name_en'       => 'nullable|max:255',
            'slug_en'       => 'nullable|max:255',
            'type'          => 'required|in:LEADERSHIP,ACADEMIC,OFFICE',
            'display_order' => 'nullable|integer|min:0|max:9999',
            'is_active'     => 'nullable|boolean',
        ]);

        $slug = $this->generateSlug($request->name);
        $slug_en = null;
        if (!empty($request->slug_en)) {
            $slug_en = Str::slug($request->slug_en);
        } elseif (!empty($request->name_en)) {
            $slug_en = Str::slug($request->name_en);
        }

        if (Department::where('slug', $slug)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['name' => 'Đường dẫn tiếng Việt (slug) đã tồn tại, vui lòng chọn tên khác.']);
        }

        if (!empty($slug_en) && Department::where('slug_en', $slug_en)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['slug_en' => 'Đường dẫn tiếng Anh (slug_en) đã tồn tại, vui lòng chọn tên khác.']);
        }

        Department::create([
            'name'          => $request->name,
            'name_en'       => $request->name_en,
            'slug'          => $slug,
            'slug_en'       => $slug_en,
            'type'          => $request->type,
            'display_order' => intval($request->display_order ?? 0),
            'is_active'     => $request->has('is_active') ? (bool) $request->is_active : true,
        ]);

        return redirect()->route('admin-department', [app()->getLocale()])
            ->with('success', 'Thêm đơn vị mới thành công!');
    }

    public function edit($locale, $id)
    {
        $dp = Department::findOrFail($id);
        return view('Admin.Department.edit', compact('dp'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'id'            => 'required',
            'name'          => 'required|max:255',
            'name_en'       => 'nullable|max:255',
            'slug_en'       => 'nullable|max:255',
            'type'          => 'required|in:LEADERSHIP,ACADEMIC,OFFICE',
            'display_order' => 'nullable|integer|min:0|max:9999',
            'is_active'     => 'nullable|boolean',
        ]);

        $dept = Department::findOrFail($request->id);

        $slug = $this->generateSlug($request->name);

        $slug_en = null;
        if (!empty($request->slug_en)) {
            $slug_en = Str::slug($request->slug_en);
        } elseif (!empty($request->name_en)) {
            $slug_en = Str::slug($request->name_en);
        }
        if (Department::where('slug', $slug)->where('_id', '!=', $dept->_id)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['name' => 'Đường dẫn tiếng Việt (slug) đã tồn tại.']);
        }

        if (!empty($slug_en) && Department::where('slug_en', $slug_en)->where('_id', '!=', $dept->_id)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['slug_en' => 'Đường dẫn tiếng Anh (slug_en) đã tồn tại.']);
        }

        $dept->update([
            'name'          => $request->name,
            'name_en'       => $request->name_en,
            'slug'          => $slug,
            'slug_en'       => $slug_en,
            'type'          => $request->type,
            'display_order' => intval($request->display_order ?? 0),
            'is_active'     => $request->has('is_active') ? (bool) $request->is_active : false,
        ]);
        $deptId = (string) $request->id;
        $newName = $request->name;
        $newNameEn = $request->name_en ?? $request->name;

        NhanSu::where('departments.department_id', $deptId)
            ->each(function ($nhanSu) use ($deptId, $newName, $newNameEn) {
                $departments = $nhanSu->departments ?? [];
                $updated = array_map(function ($entry) use ($deptId, $newName, $newNameEn) {
                    if (isset($entry['department_id']) && (string) $entry['department_id'] === $deptId) {
                        $entry['department_name'] = $newName;
                        $entry['department_name_en'] = $newNameEn;
                    }
                    return $entry;
                }, $departments);
                $nhanSu->departments = $updated;
                $nhanSu->save();
            });

        return redirect()->route('admin-department', [app()->getLocale()])
            ->with('success', 'Cập nhật đơn vị thành công!');
    }
    public function delete($locale, $id)
    {
        $linked = NhanSu::where('departments.department_id', (string) $id)->count();

        if ($linked > 0) {
            return redirect()->back()
                ->withErrors(['delete' => "Không thể xóa: đơn vị này đang có {$linked} nhân sự liên kết."]);
        }

        Department::findOrFail($id)->delete();

        return redirect()->route('admin-department', [app()->getLocale()])
            ->with('success', 'Xóa đơn vị thành công!');
    }
    private function generateSlug(string $name): string
    {
        $map = [
            'à' => 'a',
            'á' => 'a',
            'ả' => 'a',
            'ã' => 'a',
            'ạ' => 'a',
            'ă' => 'a',
            'ắ' => 'a',
            'ặ' => 'a',
            'ằ' => 'a',
            'ẳ' => 'a',
            'ẵ' => 'a',
            'â' => 'a',
            'ấ' => 'a',
            'ầ' => 'a',
            'ẩ' => 'a',
            'ẫ' => 'a',
            'ậ' => 'a',
            'đ' => 'd',
            'è' => 'e',
            'é' => 'e',
            'ẻ' => 'e',
            'ẽ' => 'e',
            'ẹ' => 'e',
            'ê' => 'e',
            'ế' => 'e',
            'ề' => 'e',
            'ể' => 'e',
            'ễ' => 'e',
            'ệ' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'ỉ' => 'i',
            'ĩ' => 'i',
            'ị' => 'i',
            'ò' => 'o',
            'ó' => 'o',
            'ỏ' => 'o',
            'õ' => 'o',
            'ọ' => 'o',
            'ô' => 'o',
            'ố' => 'o',
            'ồ' => 'o',
            'ổ' => 'o',
            'ỗ' => 'o',
            'ộ' => 'o',
            'ơ' => 'o',
            'ớ' => 'o',
            'ờ' => 'o',
            'ở' => 'o',
            'ỡ' => 'o',
            'ợ' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'ủ' => 'u',
            'ũ' => 'u',
            'ụ' => 'u',
            'ư' => 'u',
            'ứ' => 'u',
            'ừ' => 'u',
            'ử' => 'u',
            'ữ' => 'u',
            'ự' => 'u',
            'ỳ' => 'y',
            'ý' => 'y',
            'ỷ' => 'y',
            'ỹ' => 'y',
            'ỵ' => 'y',
        ];
        $lower = mb_strtolower($name);
        $ascii = strtr($lower, $map);
        return Str::slug($ascii);
    }
}
