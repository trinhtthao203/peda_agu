<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\LogController;
use App\Models\DMThongTin;
use App\Http\Controllers\TranslatePathController;
use App\Models\TranslatePath;
use Session; use Validator;

class DMThongTinController extends Controller
{
    //
    function list(Request $request, $locale = ''){
        $danhsach = DMThongTin::where('locale','=',$locale)->orderBy('thu_tu', 'asc')->get();
        return view('Admin.DMThongTin.list')->with(compact('danhsach'));
    }

    function add(Request $request, $locale = '') {
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = DMThongTin::find($trans_id);
        } else {
            $ds = '';
        }
        return view('Admin.DMThongTin.add')->with(compact('ds','trans_id', 'trans_lang'));
    }

    function create(Request $request, $locale = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required|unique:dm_thong_tin',
            'ten' => 'required'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/danh-muc-thong-tin/add?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }

        $id = ObjectController::Id();
        $id_user = $request->session()->get('user._id');
        $db = new DMThongTin();
        $db->_id = $id;
        $db->ten = $data['ten'];
        $db->slug = $data['slug'];
        $db->thu_tu = intval($data['thu_tu']);
        $db->locale = $locale;
        $db->id_user = ObjectController::ObjectId($id_user);
        $db->save();

        //cập nhật translate path
        $trans_lang = $data['trans_lang'];
        $trans_id = $data['trans_id'];
        if($trans_id && $trans_lang){
            $trans_id = ObjectController::ObjectId($trans_id);
            $check_path = TranslatePath::where("id_".$trans_lang, "=", $trans_id)->first();
            if($check_path){
                $trans = TranslatePath::find($check_path['_id']);
                $trans->{"id_$locale"} = $id;
                $trans->{"slug_$locale"} = $data['slug'];
                $trans->collection = 'dm_thong_tin';
                $trans->save();
            }
        } else {
            $trans = new TranslatePath();
            $trans->{"id_$locale"} = $id;
            $trans->{"slug_$locale"} = $data['slug'];
            $trans->collection = 'dm_thong_tin';
            $trans->save();
        }
        $logQuery = array (
            'action' => 'Thêm Danh mục Kiến thức Nha khoa ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'dm_thong_tin',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL').$trans_lang.'/admin/danh-muc-thong-tin');
        return redirect(env('APP_URL') .$locale.'/admin/danh-muc-thong-tin');
    }

    function edit(Request $request, $locale = '', $id = ''){
        $ds = DMThongTin::find($id);
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        return view('Admin.DMThongTin.edit')->with(compact('ds','trans_id', 'trans_lang'));
    }

    function update(Request $request, $locale = '', $id = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required|unique:dm_thong_tin,_id,'.$data['id'],
            'ten' => 'required'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/danh-muc-thong-tin/edit/'.$data['id'].'?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $id_user = $request->session()->get('user._id');
        $db = DMThongTin::find($data['id']);
        $db->ten = $data['ten'];
        $db->slug = $data['slug'];
        $db->thu_tu = intval($data['thu_tu']);
        $db->locale = $locale;
        $db->id_user = ObjectController::ObjectId($id_user);
        $db->save();
        //update translatepath
        $trans_lang = $data['trans_lang'];
        $trans_id = $data['trans_id'];
        $id_path = ObjectController::ObjectId($data['id']);
        $check_path = TranslatePath::where("id_".$locale, "=", $id_path)->first();
        $trans = TranslatePath::find($check_path['_id']);
        $trans->{"id_$locale"} = $id_path;
        $trans->{"slug_$locale"} = $data['slug'];
        $trans->collection = 'dm_thong_tin';
        $trans->save();
        $logQuery = array (
            'action' => 'Chỉnh sửa Danh mục Kiến thức Nha Khoa ['.$data['ten'].']',
            'id_collection' => $data['id'],
            'collection' => 'dm_thong_tin',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Chỉnh sửa thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/danh-muc-thong-tin');
        return redirect(env('APP_URL') .$locale.'/admin/danh-muc-thong-tin');
    }

    function delete(Request $request, $locale = '', $id = ''){
        $data = DMThongTin::find($id);
        $logQuery = array (
            'action' => 'Xóa Danh mục Kiến thức Nha Khoa ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'dm_thong_tin',
            'data' => $data
        );

        DMThongTin::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        LogController::addLog($logQuery);
        Session::flash('msg', 'Xóa thành công');
        return redirect(env('APP_URL').$locale.'/admin/danh-muc-thong-tin');
    }
}
