<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;use Validator;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Models\Banner;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    //
    function list(Request $request, $locale = ''){
        $danhsach = Banner::where('locale','=',$locale)->orderBy('order', 'asc')->orderBy('updated_at', 'desc')->get();
        return view('Admin.Banner.list')->with(compact('danhsach'));
    }

    function add(){
        return view('Admin.Banner.add');
    }

    function create(Request $request, $locale = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required:banner'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/banner/add')->withErrors($validator)->withInput();
        }
        $arr_hinhanh = array();
        if(isset($data['hinhanh_aliasname']) && $data['hinhanh_aliasname']){
            foreach($data['hinhanh_aliasname'] as $k => $v){
              array_push($arr_hinhanh, array('aliasname' => $v, 'filename' => $data['hinhanh_filename'][$k], 'title' => $data['hinhanh_title'][$k]));
            }
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
        return redirect(env('APP_URL').$locale.'/admin/banner');
    }

    function edit(Request $request, $locale = '', $id = ''){
        $ds = Banner::find($id);
        return view('Admin.Banner.edit')->with(compact('ds'));
    }

    function update(Request $request, $locale = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required:banner'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/banner/edit/'.$data['id'])->withErrors($validator)->withInput();
        }
        $arr_hinhanh = array();
        if(isset($data['hinhanh_aliasname']) && $data['hinhanh_aliasname']){
            foreach($data['hinhanh_aliasname'] as $k => $v){
              array_push($arr_hinhanh, array('aliasname' => $v, 'filename' => $data['hinhanh_filename'][$k], 'title' => $data['hinhanh_title'][$k]));
            }
        }
        $db = Banner::find($data['id']);
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
        return redirect(env('APP_URL').$locale.'/admin/banner');
    }

    function delete(Request $request, $locale = '', $id = null){
        $cat = Banner::find($id);
        if($cat['photos']){
            foreach($cat['photos'] as $h){
                ImageController::remove($h['aliasname']);
            }
        }
        Banner::destroy($id);
        return redirect(env('APP_URL').$locale.'/admin/banner');
    }
}
