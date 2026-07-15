<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\ImageController;
use App\Models\Banner;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    function list(Request $request, $locale = '')
    {
        $danhsach = Banner::where('locale', '=', $locale)
            ->orderBy('order', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('Admin.Banner.list')->with(compact('danhsach'));
    }

    function add()
    {
        return view('Admin.Banner.add');
    }

    function create(Request $request, $locale = '')
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required:banner'
        ]);
        if ($validator->fails()) {
            return redirect(env('APP_URL') . $locale . '/admin/banner/add')->withErrors($validator)->withInput();
        }
        $arr_hinhanh = array();
        if (isset($data['hinhanh_aliasname']) && $data['hinhanh_aliasname']) {
            $v = $data['hinhanh_aliasname'][0];
            array_push($arr_hinhanh, array(
                'aliasname' => $v,
                'filename' => $data['hinhanh_filename'][0],
                'title' => $data['hinhanh_title'][0]
            ));
        }
        $db = new Banner();
        $db->title = $data['title'];
        $db->url = $data['url'];
        $db->order = intval($data['thutu']);
        $db->photos = $arr_hinhanh;
        $db->status = isset($data['status']) ? intval($data['status']) : 0;
        $db->trang_chu = isset($data['trang_chu']) ? intval($data['trang_chu']) : 0;
        $db->tuyen_sinh = isset($data['tuyen_sinh']) ? intval($data['tuyen_sinh']) : 0;
        $db->phat_trien_ben_vung = isset($data['phat_trien_ben_vung']) ? intval($data['phat_trien_ben_vung']) : 0;
        $db->locale = $locale;
        $db->save();
        return redirect(env('APP_URL') . $locale . '/admin/banner');
    }

    function edit(Request $request, $locale = '', $id = '')
    {
        $ds = Banner::find($id);
        return view('Admin.Banner.edit')->with(compact('ds'));
    }

    function update(Request $request, $locale = '')
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required:banner'
        ]);

        if ($validator->fails()) {
            return redirect(env('APP_URL') . $locale . '/admin/banner/edit/' . $data['id'])->withErrors($validator)->withInput();
        }
        $db = Banner::find($data['id']);
        $arr_hinhanh = array();

        if (isset($data['hinhanh_aliasname']) && $data['hinhanh_aliasname']) {
            $v = $data['hinhanh_aliasname'][0];
            if ($db && $db->photos) {
                $oldPhotos = json_decode(json_encode($db->photos), true);
                if (!empty($oldPhotos) && isset($oldPhotos[0]['aliasname']) && $oldPhotos[0]['aliasname'] !== $v) {
                    ImageController::remove($oldPhotos[0]['aliasname']);
                }
            }
            array_push($arr_hinhanh, array(
                'aliasname' => $v,
                'filename' => $data['hinhanh_filename'][0],
                'title' => $data['hinhanh_title'][0]
            ));
        } else {
            if ($db && $db->photos) {
                $arr_hinhanh = $db->photos;
            }
        }

        $db->title = $data['title'];
        $db->url = $data['url'];
        $db->order = intval($data['thutu']);
        $db->photos = $arr_hinhanh;
        $db->status = isset($data['status']) ? intval($data['status']) : 0;
        $db->trang_chu = isset($data['trang_chu']) ? intval($data['trang_chu']) : 0;
        $db->tuyen_sinh = isset($data['tuyen_sinh']) ? intval($data['tuyen_sinh']) : 0;
        $db->phat_trien_ben_vung = isset($data['phat_trien_ben_vung']) ? intval($data['phat_trien_ben_vung']) : 0;
        $db->locale = $locale;
        $db->save();
        return redirect(env('APP_URL') . $locale . '/admin/banner')->with('success', 'Cập nhật BANNER thành công!');
    }
    function delete($id, $locale = '')
    {
        $currentLocale = app()->getLocale();

        if (strlen($id) <= 3) {
            $realId = $locale;
        } else {
            $realId = $id;
        }
        $banner = Banner::find($realId);

        if ($banner) {
            $photos = $banner->photos;

            if (is_array($photos) || is_object($photos)) {
                foreach ($photos as $photo) {
                    $photoData = json_decode(json_encode($photo), true);
                    $aliasName = isset($photoData['aliasname']) ? $photoData['aliasname'] : '';

                    if ($aliasName) {
                        // Gọi hàm xóa file vật lý tuyệt đối từ ImageController
                        ImageController::remove($aliasName);
                    }
                }
            }

            $banner->delete();
        }
        return redirect(env('APP_URL') . $currentLocale . '/admin/banner')->with('success', 'Xóa thành công!');
    }
}
