<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NganhDaoTao;
use Illuminate\Support\Str;

class NganhDaoTaoController extends Controller
{
    public function list(Request $request)
    {
        $query = NganhDaoTao::query();

        if ($request->filled('keyword')) {
            $kw = trim($request->keyword);
            $query->where(function ($q) use ($kw) {
                $q->where('ten', 'regexp', "/{$kw}/i")
                    ->orWhere('ten_en', 'regexp', "/{$kw}/i")
                    ->orWhere('ma_nganh', 'regexp', "/{$kw}/i");
            });
        }

        if ($request->filled('he_dao_tao')) {
            $query->where('he_dao_tao', $request->he_dao_tao);
        }

        $danhsach = $query->orderBy('display_order', 'asc')->paginate(20)->appends($request->all());
        $heDaoTaoList = NganhDaoTao::HE_DAO_TAO;

        return view('Admin.NganhDaoTao.list', compact('danhsach', 'heDaoTaoList'));
    }

    public function add()
    {
        $heDaoTaoList = NganhDaoTao::HE_DAO_TAO;
        return view('Admin.NganhDaoTao.add', compact('heDaoTaoList'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'ten'           => 'required|max:255',
            'ten_en'        => 'nullable|max:255',
            'ma_nganh'      => 'nullable|max:50',
            'he_dao_tao'    => 'required|string',
            'slug_en'       => 'nullable|max:255',
            'display_order' => 'nullable|integer|min:0|max:9999',
            'is_active'     => 'nullable|boolean',
        ]);

        // Sinh slug VI (Tự thêm tiền tố "Thạc sĩ" nếu là Sau đại học để không trùng slug ĐH)
        $slugBase = $request->ten;
        if ($request->he_dao_tao === 'SAU_DAI_HOC' && !Str::contains(Str::lower($slugBase), ['thạc sĩ', 'tiến sĩ', 'sau đại học'])) {
            $slugBase = 'Thạc sĩ ' . $slugBase;
        }
        $slug = $this->generateSlug($slugBase);

        // Sinh slug EN
        $slug_en = null;
        if (!empty($request->slug_en)) {
            $slug_en = Str::slug($request->slug_en);
        } elseif (!empty($request->ten_en)) {
            $slugEnBase = $request->ten_en;
            if ($request->he_dao_tao === 'SAU_DAI_HOC' && !Str::contains(Str::lower($slugEnBase), ['master', 'phd', 'postgraduate'])) {
                $slugEnBase = 'Master of ' . $slugEnBase;
            }
            $slug_en = Str::slug($slugEnBase);
        }

        if (NganhDaoTao::where('slug', $slug)->exists()) {
            return redirect()->back()->withInput()->withErrors(['ten' => 'Slug tiếng Việt đã tồn tại.']);
        }

        if (!empty($slug_en) && NganhDaoTao::where('slug_en', $slug_en)->exists()) {
            return redirect()->back()->withInput()->withErrors(['slug_en' => 'Slug tiếng Anh đã tồn tại.']);
        }

        NganhDaoTao::create([
            'ten'           => $request->ten,
            'ten_en'        => $request->ten_en,
            'ma_nganh'      => $request->ma_nganh,
            'slug'          => $slug,
            'slug_en'       => $slug_en,
            'he_dao_tao'    => $request->he_dao_tao,
            'display_order' => intval($request->display_order ?? 0),
            'is_active'     => $request->has('is_active') ? (bool) $request->is_active : true,
        ]);

        return redirect()->route('admin-nganh-dao-tao', [app()->getLocale()])->with('success', 'Thêm ngành đào tạo thành công!');
    }

    public function edit($locale, $id)
    {
        $item = NganhDaoTao::findOrFail($id);
        $heDaoTaoList = NganhDaoTao::HE_DAO_TAO;
        return view('Admin.NganhDaoTao.edit', compact('item', 'heDaoTaoList'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'            => 'required',
            'ten'           => 'required|max:255',
            'ten_en'        => 'nullable|max:255',
            'ma_nganh'      => 'nullable|max:50',
            'he_dao_tao'    => 'required|string',
            'slug_en'       => 'nullable|max:255',
            'display_order' => 'nullable|integer|min:0|max:9999',
            'is_active'     => 'nullable|boolean',
        ]);

        $item = NganhDaoTao::findOrFail($request->id);

        // Sinh slug VI
        $slugBase = $request->ten;
        if ($request->he_dao_tao === 'SAU_DAI_HOC' && !Str::contains(Str::lower($slugBase), ['thạc sĩ', 'tiến sĩ', 'sau đại học'])) {
            $slugBase = 'Thạc sĩ ' . $slugBase;
        }
        $slug = $this->generateSlug($slugBase);

        // Sinh slug EN
        $slug_en = null;
        if (!empty($request->slug_en)) {
            $slug_en = Str::slug($request->slug_en);
        } elseif (!empty($request->ten_en)) {
            $slugEnBase = $request->ten_en;
            if ($request->he_dao_tao === 'SAU_DAI_HOC' && !Str::contains(Str::lower($slugEnBase), ['master', 'phd', 'postgraduate'])) {
                $slugEnBase = 'Master of ' . $slugEnBase;
            }
            $slug_en = Str::slug($slugEnBase);
        }

        if (NganhDaoTao::where('slug', $slug)->where('_id', '!=', $item->_id)->exists()) {
            return redirect()->back()->withInput()->withErrors(['ten' => 'Slug tiếng Việt đã tồn tại.']);
        }

        if (!empty($slug_en) && NganhDaoTao::where('slug_en', $slug_en)->where('_id', '!=', $item->_id)->exists()) {
            return redirect()->back()->withInput()->withErrors(['slug_en' => 'Slug tiếng Anh đã tồn tại.']);
        }

        $item->update([
            'ten'           => $request->ten,
            'ten_en'        => $request->ten_en,
            'ma_nganh'      => $request->ma_nganh,
            'slug'          => $slug,
            'slug_en'       => $slug_en,
            'he_dao_tao'    => $request->he_dao_tao,
            'display_order' => intval($request->display_order ?? 0),
            'is_active'     => $request->has('is_active') ? (bool) $request->is_active : false,
        ]);

        return redirect()->route('admin-nganh-dao-tao', [app()->getLocale()])->with('success', 'Cập nhật ngành đào tạo thành công!');
    }

    public function delete($locale, $id)
    {
        $item = NganhDaoTao::findOrFail($id);
        $item->delete();
        return redirect()->route('admin-nganh-dao-tao', [app()->getLocale()])->with('success', 'Xóa ngành đào tạo thành công!');
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
