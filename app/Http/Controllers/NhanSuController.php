<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NhanSu;
use App\Models\Department;
use Illuminate\Support\Str;

class NhanSuController extends Controller
{
    public function list(Request $request)
    {
        $query = NhanSu::query();
        if ($request->filled('keyword')) {
            $keyword = trim($request->keyword);
            $query->where(function ($q) use ($keyword) {
                $q->where('ho_ten', 'regexp', "/{$keyword}/i")
                    ->orWhere('ho_ten_en', 'regexp', "/{$keyword}/i")
                    ->orWhere('email', 'regexp', "/{$keyword}/i")
                    ->orWhere('so_dien_thoai', 'regexp', "/{$keyword}/i");
            });
        }
        if ($request->filled('department_id')) {
            $deptId = (string) $request->department_id;
            $query->where('departments.department_id', $deptId);
        }

        $danhsach = $query->paginate(20)->appends($request->all());
        $departments = Department::active()->orderBy('display_order', 'asc')->get();

        return view('Admin.NhanSu.list', compact('danhsach', 'departments'));
    }

    public function add()
    {
        $departments = Department::active()->orderBy('display_order', 'asc')->get();
        return view('Admin.NhanSu.add', compact('departments'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'ho_ten'                      => 'required|string|max:255',
            'ho_ten_en'                   => 'nullable|string|max:255',
            'hoc_ham_hoc_vi_en'           => 'nullable|string|max:255',
            'chuyen_nganh_en'             => 'nullable|string|max:255',
            'email'                       => 'required|email',
            'so_dien_thoai'               => 'nullable|string|max:20',
            'departments'                 => 'required|array|min:1|max:20',
            'departments.*.department_id' => 'required|string',
            'departments.*.chuc_vu'       => 'required|string|max:100',
            'departments.*.chuc_vu_en'    => 'nullable|string|max:100',
        ]);

        foreach ($request->departments as $entry) {
            if (!Department::find($entry['department_id'])) {
                return redirect()->back()->withInput()
                    ->withErrors(['departments' => 'Đơn vị không hợp lệ: ' . $entry['department_id']]);
            }
        }

        $hinh_anh = '';
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $hinh_anh = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/avatars'), $hinh_anh);
        }

        $ly_lich = [];
        if ($request->hasFile('ly_lich_khoa_hoc')) {
            $file = $request->file('ly_lich_khoa_hoc');
            $aliasname = time() . '_llkh_' . Str::slug($request->ho_ten, '_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/files'), $aliasname);
            $ly_lich = [
                'title' => 'LLKH_' . $request->ho_ten,
                'aliasname' => $aliasname,
                'type' => $file->getClientOriginalExtension()
            ];
        }

        $deptEntries = $this->buildDepartmentEntries($request->departments);

        NhanSu::create([
            'ho_ten'            => $request->ho_ten,
            'ho_ten_en'         => $request->ho_ten_en,
            'hoc_ham_hoc_vi'    => $request->hoc_ham_hoc_vi,
            'hoc_ham_hoc_vi_en' => $request->hoc_ham_hoc_vi_en,
            'chuyen_nganh'      => $request->chuyen_nganh,
            'chuyen_nganh_en'   => $request->chuyen_nganh_en,
            'email'             => $request->email,
            'so_dien_thoai'     => $request->so_dien_thoai,
            'hinh_anh'          => $hinh_anh,
            'ly_lich_khoa_hoc'  => $ly_lich,
            'departments'       => $deptEntries,
        ]);

        return redirect()->route('admin-nhan-su', [app()->getLocale()])->with('success', 'Thêm nhân sự mới thành công!');
    }

    public function edit($locale, $id)
    {
        $ds = NhanSu::findOrFail($id);
        $departments = Department::active()->orderBy('display_order', 'asc')->get();
        return view('Admin.NhanSu.edit', compact('ds', 'departments'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'                          => 'required',
            'ho_ten'                      => 'required|string|max:255',
            'ho_ten_en'                   => 'nullable|string|max:255',
            'hoc_ham_hoc_vi_en'           => 'nullable|string|max:255',
            'chuyen_nganh_en'             => 'nullable|string|max:255',
            'email'                       => 'required|email',
            'so_dien_thoai'               => 'nullable|string|max:20',
            'departments'                 => 'required|array|min:1|max:20',
            'departments.*.department_id' => 'required|string',
            'departments.*.chuc_vu'       => 'required|string|max:100',
            'departments.*.chuc_vu_en'    => 'nullable|string|max:100',
        ]);

        foreach ($request->departments as $entry) {
            if (!Department::find($entry['department_id'])) {
                return redirect()->back()->withInput()
                    ->withErrors(['departments' => 'Đơn vị không hợp lệ: ' . $entry['department_id']]);
            }
        }

        $ns = NhanSu::findOrFail($request->id);

        $hinh_anh = $ns->hinh_anh;
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $hinh_anh = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/avatars'), $hinh_anh);
        }

        $ly_lich = $ns->ly_lich_khoa_hoc;
        if ($request->hasFile('ly_lich_khoa_hoc')) {
            $file = $request->file('ly_lich_khoa_hoc');
            $aliasname = time() . '_llkh_' . Str::slug($request->ho_ten, '_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/files'), $aliasname);
            $ly_lich = [
                'title' => 'LLKH_' . $request->ho_ten,
                'aliasname' => $aliasname,
                'type' => $file->getClientOriginalExtension()
            ];
        }

        $deptEntries = $this->buildDepartmentEntries($request->departments);

        $ns->ho_ten            = $request->ho_ten;
        $ns->ho_ten_en         = $request->ho_ten_en;
        $ns->hoc_ham_hoc_vi    = $request->hoc_ham_hoc_vi;
        $ns->hoc_ham_hoc_vi_en = $request->hoc_ham_hoc_vi_en;
        $ns->chuyen_nganh      = $request->chuyen_nganh;
        $ns->chuyen_nganh_en   = $request->chuyen_nganh_en;
        $ns->email             = $request->email;
        $ns->so_dien_thoai     = $request->so_dien_thoai;
        $ns->hinh_anh          = $hinh_anh;
        $ns->ly_lich_khoa_hoc  = $ly_lich;
        $ns->departments       = $deptEntries;
        $ns->save();

        return redirect()->route('admin-nhan-su', [app()->getLocale()])->with('success', 'Cập nhật nhân sự thành công!');
    }

    public function delete($locale, $id)
    {
        $ns = NhanSu::findOrFail($id);
        $ns->delete();
        return redirect()->route('admin-nhan-su', [app()->getLocale()])->with('success', 'Xóa nhân sự thành công!');
    }

    private function buildDepartmentEntries(array $rawEntries): array
    {
        $entries = [];
        $primarySet = false;

        foreach ($rawEntries as $entry) {
            $dept = Department::find($entry['department_id']);
            $isPrimary = !empty($entry['is_primary']) && !$primarySet;
            if ($isPrimary) $primarySet = true;

            $entries[] = [
                'department_id'      => (string)$entry['department_id'],
                'department_name'    => $dept ? ($dept->name ?? '') : '',
                'department_name_en' => $dept ? ($dept->name_en ?? $dept->name ?? '') : '',
                'chuc_vu'            => $entry['chuc_vu'],
                'chuc_vu_en'         => $entry['chuc_vu_en'] ?? null,
                'thu_tu'             => intval($entry['thu_tu'] ?? 0),
                'is_primary'         => $isPrimary,
            ];
        }

        if (!$primarySet && !empty($entries)) {
            $entries[0]['is_primary'] = true;
        }

        return $entries;
    }
}
