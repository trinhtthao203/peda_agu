<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubInfo;
use App\Models\Department;
use App\Models\NganhDaoTao;
use Illuminate\Support\Str;

class SubInfoController extends Controller
{
    public function list(Request $request)
    {
        $query = SubInfo::query();

        if ($request->filled('keyword')) {
            $kw = trim($request->keyword);
            $query->where('ten', 'regexp', "/{$kw}/i")
                ->orWhere('slug', 'regexp', "/{$kw}/i");
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('locale')) {
            $query->where('locale', $request->locale);
        }

        $danhsach = $query->orderBy('type', 'asc')->paginate(20)->appends($request->all());

        return view('Admin.SubInfo.list', compact('danhsach'));
    }

    public function add()
    {
        $departments = Department::active()->orderBy('display_order', 'asc')->get();
        $nganhDaoTaos = NganhDaoTao::active()->orderBy('display_order', 'asc')->get();
        return view('Admin.SubInfo.add', compact('departments', 'nganhDaoTaos'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'ten'      => 'required|max:255',
            'type'     => 'required',
            'locale'   => 'required|in:vi,en',
            'noi_dung' => 'required',
            'hinh_anh' => 'nullable|image|max:5120'
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->ten);
        $hinh_anh = '';
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $hinh_anh = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images/subinfo'), $hinh_anh);
        }
        $video_ytb = $this->getYoutubeId($request->video_ytb);

        // Xử lý tệp đính kèm
        $arr_dinhkem = [];
        if ($request->hasFile('file_dinhkem')) {
            $uploadDir = public_path('storage/files');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            foreach ($request->file('file_dinhkem') as $idx => $file) {
                $filename = $file->getClientOriginalName();
                $aliasname = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->move($uploadDir, $aliasname);

                $arr_dinhkem[] = [
                    'aliasname' => $aliasname,
                    'filename'  => $filename,
                    'title'     => !empty($request->file_title[$idx]) ? $request->file_title[$idx] : pathinfo($filename, PATHINFO_FILENAME),
                    'size'      => @filesize($uploadDir . '/' . $aliasname) ?: 0,
                    'type'      => strtolower($file->getClientOriginalExtension())
                ];
            }
        }

        SubInfo::create([
            'ten'         => $request->ten,
            'type'        => $request->type,
            'slug'        => $slug,
            'locale'      => $request->locale,
            'mo_ta'       => $request->mo_ta,
            'noi_dung'    => $request->noi_dung,
            'video_ytb'   => $video_ytb,
            'hinh_anh'    => $hinh_anh,
            'attachments' => $arr_dinhkem,
            'status'      => intval($request->status ?? 1)
        ]);

        return redirect()->route('admin-sub-info', [app()->getLocale()])->with('success', 'Thêm trang thông tin thành công!');
    }

    public function edit($locale, $id)
    {
        $ds = SubInfo::findOrFail($id);
        $departments = Department::active()->orderBy('display_order', 'asc')->get();
        $nganhDaoTaos = NganhDaoTao::active()->orderBy('display_order', 'asc')->get();
        return view('Admin.SubInfo.edit', compact('ds', 'departments', 'nganhDaoTaos'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'       => 'required',
            'ten'      => 'required|max:255',
            'type'     => 'required',
            'locale'   => 'required|in:vi,en',
            'noi_dung' => 'required',
            'hinh_anh' => 'nullable|image|max:5120'
        ]);

        $page = SubInfo::findOrFail($request->id);
        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->ten);

        if ($request->has('delete_hinh_anh') && $request->delete_hinh_anh == '1') {
            if (!empty($page->hinh_anh) && file_exists(public_path('storage/images/subinfo/' . $page->hinh_anh))) {
                @unlink(public_path('storage/images/subinfo/' . $page->hinh_anh));
            }
            $page->hinh_anh = null;
        }

        if ($request->hasFile('hinh_anh')) {
            if (!empty($page->hinh_anh) && file_exists(public_path('storage/images/subinfo/' . $page->hinh_anh))) {
                @unlink(public_path('storage/images/subinfo/' . $page->hinh_anh));
            }
            $file = $request->file('hinh_anh');
            $hinh_anh = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images/subinfo'), $hinh_anh);
            $page->hinh_anh = $hinh_anh;
        }

        // Xử lý tệp đính kèm cũ & xóa tệp được chọn
        $existingFiles = is_array($page->attachments) ? $page->attachments : [];
        $arr_dinhkem = [];
        $deletedAliases = $request->delete_attachments ?? [];

        foreach ($existingFiles as $file) {
            if (in_array($file['aliasname'], $deletedAliases)) {
                $targetFile = public_path('storage/files/' . $file['aliasname']);
                if (file_exists($targetFile)) {
                    @unlink($targetFile);
                }
            } else {
                $arr_dinhkem[] = $file;
            }
        }

        // Upload thêm tệp mới
        if ($request->hasFile('file_dinhkem')) {
            $uploadDir = public_path('storage/files');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            foreach ($request->file('file_dinhkem') as $idx => $file) {
                $filename = $file->getClientOriginalName();
                $aliasname = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->move($uploadDir, $aliasname);

                $arr_dinhkem[] = [
                    'aliasname' => $aliasname,
                    'filename'  => $filename,
                    'title'     => !empty($request->file_title[$idx]) ? $request->file_title[$idx] : pathinfo($filename, PATHINFO_FILENAME),
                    'size'      => @filesize($uploadDir . '/' . $aliasname) ?: 0,
                    'type'      => strtolower($file->getClientOriginalExtension())
                ];
            }
        }

        $page->ten         = $request->ten;
        $page->type        = $request->type;
        $page->slug        = $slug;
        $page->locale      = $request->locale;
        $page->mo_ta       = $request->mo_ta;
        $page->noi_dung    = $request->noi_dung;
        $page->video_ytb   = $this->getYoutubeId($request->video_ytb);
        $page->status      = intval($request->status ?? 1);
        $page->attachments = $arr_dinhkem;

        $page->save();

        return redirect()->route('admin-sub-info', [app()->getLocale()])->with('success', 'Cập nhật trang thông tin thành công!');
    }

    public function delete($locale, $id)
    {
        $page = SubInfo::findOrFail($id);

        if (!empty($page->attachments)) {
            foreach ($page->attachments as $file) {
                if (!empty($file['aliasname'])) {
                    $target = public_path('storage/files/' . $file['aliasname']);
                    if (file_exists($target)) {
                        @unlink($target);
                    }
                }
            }
        }

        if (!empty($page->hinh_anh) && file_exists(public_path('storage/images/subinfo/' . $page->hinh_anh))) {
            @unlink(public_path('storage/images/subinfo/' . $page->hinh_anh));
        }

        $page->delete();
        return redirect()->route('admin-sub-info', [app()->getLocale()])->with('success', 'Xóa trang thành công!');
    }

    private function getYoutubeId(?string $url): ?string
    {
        if (empty($url)) return null;
        $url = trim($url);
        $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([a-zA-Z0-9_-]{11})%i';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        return null;
    }
}
