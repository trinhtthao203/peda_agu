<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TranslatePathController;
use App\Models\DMThongTin;
use App\Models\ThongTin;
use App\Models\TranslatePath;
use Session; use Validator;use Location;
use App\Http\Controllers\ViewsController;
class ThongTinController extends Controller
{
    //
    protected static $sdg_tags = array(
        1 => '1. Xóa nghèo',
        2 => '2. Không còn nạn đói',
        3 => '3. Sức khỏe và có cuộc sống tốt',
        4 => '4. Giáo dục có chất lượng',
        5 => '5. Bình đẳng giới',
        6 => '6. Nước sạch và vệ sinh',
        7 => '7. Năng lượng sạch giá thành hợp lý',
        8 => '8. Công việc tốt và tăng trưởng hợp lý',
        9 => '9. Công nghiệp sáng tạo và phát triển hạ tầng',
        10 => '10. Giảm bất bình đẳng',
        11 => '11. Các thành phố và cộng đồng bền vững',
        12 => '12. Tiêu thụ và sản xuất có trách nhiệm',
        13 => '13. Hành động về khí hậu',
        14 => '14. Tài nguyên và môi trường biển',
        15 => '15. Tài nguyên và môi trường trên đất liền',
        16 => '16. Hòa bình công lý và các thể chế',
        17 => '17. Quan hệ đối tác vì các mục tiêu'
    );

    public static function get_sdg_tags() {
        return self::$sdg_tags;
    }
    
    function list(Request $request, $locale = ''){
        $keywords = $request->input('keywords');
        $id_cat = $request->input('id_cat');
        $dmthongtin = DMThongTin::where('locale', '=', $locale)->get();
        $danhsach = ThongTin::where('locale','=',$locale);
        if($id_cat) {
            $danhsach = $danhsach->where('id_cat', $id_cat);
        }
        if($keywords){
            $danhsach = $danhsach->where('ten', 'regexp', '/.*'.$keywords.'/i');
        }
        $danhsach = $danhsach->where('locale','=',$locale)->orderBy('thu_thu', 'asc')->orderBy('date_post', 'desc')->paginate(30);
        return view('Admin.ThongTin.list')->with(compact('danhsach', 'keywords','dmthongtin', 'id_cat'));
    }

    function add(Request $request, $locale = ''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = ThongTin::find($trans_id);
        } else {
            $ds = '';
        }
        $sdg_tags = self::$sdg_tags;
        $cats = DMThongTin::where('locale', '=', $locale)->orderBy('thu_tu', 'asc')->get();
        return view('Admin.ThongTin.add')->with(compact('ds','trans_id', 'trans_lang', 'cats', 'sdg_tags'));
    }

    function create(Request $request, $locale = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required|unique:thong_tin',
            'ten' => 'required',
            'mo_ta' => 'required',
            'noi_dung' => 'required'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/thong-tin/add?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $arr_photo = array();
        if(isset($data['hinhanh_aliasname'])){
          foreach($data['hinhanh_aliasname'] as $key => $value){
            array_push($arr_photo, array('aliasname' => $value, 'filename' => $data['hinhanh_filename'][$key], 'title' => $data['hinhanh_title'][$key]));
          }
        }

        $arr_dinhkem = array();
        if(isset($data['file_aliasname']) && $data['file_aliasname']){
            foreach($data['file_aliasname'] as $k => $v){
              array_push($arr_dinhkem, array('aliasname' => $v, 'filename' => $data['file_filename'][$k], 'title' => $data['file_title'][$k], 'size' => $data['file_size'][$k], 'type' => $data['file_type'][$k]));
            }
        }

        $id = ObjectController::Id();
        $id_user = $request->session()->get('user._id');
        $db = new ThongTin();
        $db->_id = $id;
        $db->ten = $data['ten'];
        $db->slug = $data['slug'];
        $db->mo_ta = $data['mo_ta'];
        $db->noi_dung = $data['noi_dung'];
        $db->thu_tu = intval($data['thu_tu']);
        $db->photos = $arr_photo;
        $db->attachments = $arr_dinhkem;
        $db->id_cat = isset($data['id_cat']) ? $data['id_cat'] : array();
        $db->id_sdg_tags = isset($data['id_sdg_tags']) ? $data['id_sdg_tags'] : array();
        $db->locale = $locale;
        $db->date_post = $data['date_post'];
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
                $trans->collection = 'thong_tin';
                $trans->save();
            }
        } else {
            $trans = new TranslatePath();
            $trans->{"id_$locale"} = $id;
            $trans->{"slug_$locale"} = $data['slug'];
            $trans->collection = 'thong_tin';
            $trans->save();
        }
        $logQuery = array (
            'action' => 'Thêm Thông tin ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'thong_tin',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/thong-tin');
        return redirect(env('APP_URL') .$locale.'/admin/thong-tin');
    }

    function edit(Request $request, $locale = '', $id = ''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        $ds = ThongTin::find($id);
        $cats = DMThongTin::where('locale', '=', $locale)->orderBy('thu_tu', 'asc')->get();
        $sdg_tags = self::$sdg_tags;
        return view('Admin.ThongTin.edit')->with(compact('ds','trans_id', 'trans_lang', 'cats', 'sdg_tags'));
    }

    function update(Request $request, $locale = '', $id = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required|unique:thong_tin,_id,'.$data['id'],
            'ten' => 'required',
            'mo_ta' => 'required',
            'noi_dung' => 'required'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/thong-tin/edit/'.$data['id'].'?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $arr_photo = array();
        if(isset($data['hinhanh_aliasname'])){
          foreach($data['hinhanh_aliasname'] as $key => $value){
            array_push($arr_photo, array('aliasname' => $value, 'filename' => $data['hinhanh_filename'][$key], 'title' => $data['hinhanh_title'][$key]));
          }
        }
        $arr_dinhkem = array();
        if(isset($data['file_aliasname']) && $data['file_aliasname']){
            foreach($data['file_aliasname'] as $k => $v){
              array_push($arr_dinhkem, array('aliasname' => $v, 'filename' => $data['file_filename'][$k], 'title' => $data['file_title'][$k], 'size' => $data['file_size'][$k], 'type' => $data['file_type'][$k]));
            }
        }

        $id_user = $request->session()->get('user._id');
        $db = ThongTin::find($data['id']);
        $db->ten = $data['ten'];
        $db->slug = $data['slug'];
        $db->mo_ta = $data['mo_ta'];
        $db->noi_dung = $data['noi_dung'];
        $db->thu_tu = intval($data['thu_tu']);
        $db->photos = $arr_photo;
        $db->attachments = $arr_dinhkem;
        $db->id_cat = isset($data['id_cat']) ? $data['id_cat'] : array();
        $db->id_sdg_tags = isset($data['id_sdg_tags']) ? $data['id_sdg_tags'] : array();
        $db->locale = $locale;
        $db->date_post = $data['date_post'];
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
        $trans->collection = 'thong_tin';
        $trans->save();
        $logQuery = array (
            'action' => 'Chỉnh sửa Thông tin ['.$data['ten'].']',
            'id_collection' => $data['id'],
            'collection' => 'thong_tin',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/thong-tin');
        return redirect(env('APP_URL') .$locale.'/admin/thong-tin');
    }

    function delete(Request $request, $locale = '', $id = ''){
        $data = ThongTin::find($id);
        $logQuery = array (
            'action' => 'Xóa Thông tin ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'thong_tin',
            'data' => $data
        );
        if($data['photos']){
            foreach($data['photos'] as $p){
                ImageController::remove($p['aliasname']);
            }
        }
        ThongTin::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        LogController::addLog($logQuery);
        Session::flash('msg', 'Xóa thành công');
        return redirect(env('APP_URL').$locale.'/admin/thong-tin');
    }
}
