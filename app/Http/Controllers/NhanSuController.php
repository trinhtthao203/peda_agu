<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NhanSu;
use App\Models\Department;
use Illuminate\Support\Str;

class NhanSuController extends Controller
{
    public function list()
    {
        $danhsach = NhanSu::paginate(20);
        return view('Admin.NhanSu.list', compact('danhsach'));
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
            'email'                       => 'required|email',
            'departments'                 => 'required|array|min:1|max:20',
            'departments.*.department_id' => 'required|string',
            'departments.*.chuc_vu'       => 'required|string|max:100',
        ]);

        // Validate each department_id exists
        foreach ($request->departments as $entry) {
            if (!Department::find($entry['department_id'])) {
                return redirect()->back()->withInput()
                    ->withErrors(['departments' => 'Đơn vị không hợp lệ: ' . $entry['department_id']]);
            }
        }

        // Handle file uploads (keep existing logic)
        $hinh_anh = '';
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $hinh_anh = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/avatars'), $hinh_anh);
        }

        $ly_lich = [];
        if ($request->hasFile('ly_lich_khoa_hoc')) {
            $file = $request->file('ly_lich_khoa_hoc');
            $aliasname = time() . '_llkh_' . \Illuminate\Support\Str::slug($request->ho_ten, '_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/files'), $aliasname);
            $ly_lich = [
                'title' => 'LLKH_' . $request->ho_ten,
                'aliasname' => $aliasname,
                'type' => $file->getClientOriginalExtension()
            ];
        }

        // Build departments array
        $deptEntries = $this->buildDepartmentEntries($request->departments);

        NhanSu::create([
            'ho_ten'           => $request->ho_ten,
            'hoc_ham_hoc_vi'   => $request->hoc_ham_hoc_vi,
            'chuyen_nganh'     => $request->chuyen_nganh,
            'email'            => $request->email,
            'hinh_anh'         => $hinh_anh,
            'ly_lich_khoa_hoc' => $ly_lich,
            'departments'      => $deptEntries,
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
            'departments'                 => 'required|array|min:1|max:20',
            'departments.*.department_id' => 'required|string',
            'departments.*.chuc_vu'       => 'required|string|max:100',
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
            $aliasname = time() . '_llkh_' . \Illuminate\Support\Str::slug($request->ho_ten, '_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/files'), $aliasname);
            $ly_lich = [
                'title' => 'LLKH_' . $request->ho_ten,
                'aliasname' => $aliasname,
                'type' => $file->getClientOriginalExtension()
            ];
        }

        $deptEntries = $this->buildDepartmentEntries($request->departments);

        $ns->ho_ten           = $request->ho_ten;
        $ns->hoc_ham_hoc_vi   = $request->hoc_ham_hoc_vi;
        $ns->chuyen_nganh     = $request->chuyen_nganh;
        $ns->email            = $request->email;
        $ns->hinh_anh         = $hinh_anh;
        $ns->ly_lich_khoa_hoc = $ly_lich;
        $ns->departments      = $deptEntries;
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
                'department_id'   => (string)$entry['department_id'],
                'department_name' => $dept ? $dept->name : '',
                'chuc_vu'         => $entry['chuc_vu'],
                'thu_tu'          => intval($entry['thu_tu'] ?? 0),
                'is_primary'      => $isPrimary,
            ];
        }

        // If no primary was set, promote the first entry
        if (!$primarySet && !empty($entries)) {
            $entries[0]['is_primary'] = true;
        }

        return $entries;
    }
}
