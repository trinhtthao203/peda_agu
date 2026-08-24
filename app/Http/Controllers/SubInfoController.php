<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubInfo;
use Illuminate\Support\Str;

class SubInfoController extends Controller
{
    public function list()
    {
        $danhsach = SubInfo::orderBy('type', 'asc')->paginate(20);
        return view('Admin.SubInfo.list', compact('danhsach'));
    }

    public function add()
    {
        return view('Admin.SubInfo.add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'ten' => 'required',
            'type' => 'required',
            'locale' => 'required',
            'noi_dung' => 'required'
        ]);

        $slug = $request->slug ?: Str::slug($request->ten);

        SubInfo::create([
            'ten' => $request->ten,
            'type' => $request->type,
            'slug' => $slug,
            'locale' => $request->locale,
            'mo_ta' => $request->mo_ta,
            'noi_dung' => $request->noi_dung,
            'status' => intval($request->status)
        ]);

        return redirect()->route('admin-sub-info', [app()->getLocale()])->with('success', 'Thêm trang thông tin thành công!');
    }

    public function edit($locale, $id)
    {
        $ds = SubInfo::findOrFail($id);
        return view('Admin.SubInfo.edit', compact('ds'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'ten' => 'required',
            'type' => 'required',
            'noi_dung' => 'required'
        ]);

        // Tìm chính xác đối tượng cũ dựa vào ID từ form gửi lên
        $page = SubInfo::findOrFail($request->id);
        $slug = $request->slug ?: Str::slug($request->ten);

        // Gán đè dữ liệu trực tiếp lên đối tượng hiện tại
        $page->ten = $request->ten;
        $page->type = $request->type;
        $page->slug = $slug;
        $page->locale = $request->locale;
        $page->mo_ta = $request->mo_ta;
        $page->noi_dung = $request->noi_dung;
        $page->status = intval($request->status);

        // Thực hiện lưu đè (MongoDB Update)
        $page->save();

        return redirect()->route('admin-sub-info', [app()->getLocale()])->with('success', 'Cập nhật trang thông tin thành công!');
    }

    public function delete($locale, $id)
    {
        $page = SubInfo::findOrFail($id);
        $page->delete();
        return redirect()->route('admin-sub-info', [app()->getLocale()])->with('success', 'Xóa trang thành công!');
    }
}
