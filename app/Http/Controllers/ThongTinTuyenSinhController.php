<?php

namespace App\Http\Controllers;

use App\Models\ThongTinTuyenSinh;
use Illuminate\Http\Request;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TranslatePathController;
use App\Models\TranslatePath;
use App\Http\Controllers\ViewsController;
use App\Models\Views;
use App\Models\ViewsLog;
use Illuminate\Support\Str;
use Session; use Validator;use Location;use Storage;

class ThongTinTuyenSinhController extends Controller
{
    //
    const ARR_CATS = array(
        'de-an-tuyen-sinh' => 'Đề án Tuyển sinh',
        'dai-hoc-chinh-quy' => 'Đại học Chính quy',
        'dai-hoc-vua-lam-vua-hoc' => 'Đại học Vừa làm Vừa học',
        'dai-hoc-lien-thong-tu-cao-dang' => 'Đại học Liên thông từ Cao đẳng',
        'dai-hoc-van-bang-2' => 'Đại học Văn bằng 2',
        'cam-nang-tuyen-sinh' => 'Cẩm nang Tuyển sinh',
        'sau-dai-hoc' => 'Thông tin Tuyển sinh sau Đại học',
        'dao-tao-ngan-han' => 'Đào tạo Ngắn hạn',
        'trai-nghiem-mot-ngay-lam-sinh-vien-agu' => 'Trải nghiệm một ngày làm sinh viên AGU'
    );
    static function get_cats(){
        return self::ARR_CATS;
    }
    function index(Request $request, $locale = 'vi'){
        $tin_moi_nhat = ThongTinTuyenSinh::where('locale','=',$locale)->orderBy('date_post', 'desc')->take(9)->get();
        $sau_dai_hoc = ThongTinTuyenSinh::where('locale','=',$locale)->where('id_cat','sau-dai-hoc')->orderBy('date_post', 'desc')->take(9)->get();
        $dai_hoc_chinh_quy = ThongTinTuyenSinh::where('locale','=',$locale)->where('id_cat','dai-hoc-chinh-quy')->orderBy('date_post', 'desc')->take(9)->get();
        $vua_lam_vua_hoc = ThongTinTuyenSinh::where('locale','=',$locale)->where('id_cat','dai-hoc-vua-lam-vua-hoc')->orderBy('date_post', 'desc')->take(9)->get();
        $dao_tao_ngan_han = ThongTinTuyenSinh::where('locale','=',$locale)->where('id_cat','dao-tao-ngan-han')->orderBy('date_post', 'desc')->take(9)->get();
        return view('Frontend.TuyenSinh.index')->with(compact('tin_moi_nhat','sau_dai_hoc','dai_hoc_chinh_quy','vua_lam_vua_hoc','dao_tao_ngan_han'));
    }
    function gioi_thieu_ve_agu(){
        return view('Frontend.TuyenSinh.gioi-thieu-ve-agu');
    }

    function video_gioi_thieu_ve_agu(){
        return view('Frontend.TuyenSinh.video-gioi-thieu-ve-agu');
    }

    function tuyen_sinh(Request $request, $locale = 'vi', $slug = '') {
        $danhsach = ThongTinTuyenSinh::where('locale','=',$locale)->where('id_cat', $slug)->orderBy('date_post', 'desc')->paginate(9);
        $arr_cats = self::ARR_CATS;
        $title = isset($arr_cats[$slug]) ? $arr_cats[$slug] : 'Thông tin Tuyển sinh';
        if($slug == '') {
            if($locale == 'vi') $path = 'tuyen-sinh';
            else $path = 'admissions';
        } else {
            if($locale == 'vi') $path = 'tuyen-sinh/'.$slug;
            else $path = 'admissions/'.$slug;
        }
        if($slug == 'thong-tin-tuyen-sinh-dai-hoc' || $slug == 'dai-hoc-chinh-quy') {
            $slug = 'dai-hoc-chinh-quy';
            $danhsach_2026 = ThongTinTuyenSinh::where('locale','=',$locale)->where('id_cat', $slug)->where('date_post', 'regexp', '/.*2026/i')->orderBy('date_post', 'desc')->get();
            $danhsach_2025 = ThongTinTuyenSinh::where('locale','=',$locale)->where('id_cat', $slug)->where('date_post', 'regexp', '/.*2025/i')->orderBy('date_post', 'desc')->get();
            $danhsach_2024 = ThongTinTuyenSinh::where('locale','=',$locale)->where('id_cat', $slug)->where('date_post', 'regexp', '/.*2024/i')->orderBy('date_post', 'desc')->get();
            //$danhsach_2023 = ThongTinTuyenSinh::where('locale','=',$locale)->where('id_cat', $slug)->where('date_post', 'regexp', '/.*2023/i')->orderBy('date_post', 'desc')->get();
            return view('Frontend.TuyenSinh.thong-tin-tuyen-sinh-dai-hoc')->with(compact('danhsach_2026','danhsach_2025','danhsach_2024','slug', 'title','path'));
        } else {
            return view('Frontend.TuyenSinh.tuyen-sinh')->with(compact('danhsach','slug', 'title','path'));
        }
        
    }
    function tim_kiem(Request $request, $locale = 'vi') {
        $q = $request->input('q');
        if($locale == 'vi'){
            $title = 'Kết quả tìm kiếm';
            $path = 'tim-kiem';
        } else {
            $title = 'Search Results';
            $path = 'search';
        }
        $slug = '';
        $danhsach = ThongTinTuyenSinh::where('locale','=',$locale)->where('ten', 'regexp', '/.*'.$q.'/i')->orderBy('date_post', 'desc')->paginate(12);
        return view('Frontend.TuyenSinh.tuyen-sinh')->with(compact('danhsach', 'title', 'slug', 'path'));
    }

    function xem_truc_tuyen(Request $request, $locale = 'vi', $id = '', $key = 0){
        $ds = ThongTinTuyenSinh::find($id);
        $key = intval($key);
        if(strtolower($ds['attachments'][$key]['type']) == 'doc' || strtolower($ds['attachments'][$key]['type']) == 'docx' || strtolower($ds['attachments'][$key]['type']) == 'xlsx'){
            $path_file = env('APP_URL').'/storage/files/'.$ds['attachments'][$key]['aliasname'];
            $frame_path = 'https://view.officeapps.live.com/op/embed.aspx?src='.$path_file;
            echo '<iframe src="'.$frame_path.'" onload=\'javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));\' style="height:100%;width:100%;border:none;overflow:hidden;"></iframe>';
        } else if(strtolower($ds['attachments'][$key]['type']) == 'pdf') {
            echo '<embed src="'.env('APP_URL').'storage/files/'.$ds['attachments'][$key]['aliasname'].'" style="width:100%;height:100% !important;" />';
        } else {
            echo 'Không thể xem, vui lòng download về xem. Cám ơn!';
        }
    }

    function tai_ve(Request $request, $locale = 'vi', $id = '', $key = 0){
        $ds = ThongTinTuyenSinh::find($id);
        //$filename = $ds['slug'] . "." . $ds['attachments'][$key]['type'];
        $filename = Str::slug($ds['attachments'][$key]['title'],'_'). "." . $ds['attachments'][$key]['type'];
        $file_path = 'public/files/'.$ds['attachments'][$key]['aliasname'];
        return Storage::download($file_path, $filename);
    }

    function thong_tin(Request $request, $locale = 'vi', $slug = ''){
        return redirect('https://tuyensinh.agu.edu.vn/tin-tuc/' . $slug);
        /*$ds = ThongTinTuyenSinh::where('locale','=', $locale)->where('slug','=',$slug)->first();
        $id_cat = $ds['id_cat'];
        $arr_cats = self::ARR_CATS;
        $id = ObjectController::ObjectId($ds['_id']);
        $tin_lien_quan = ThongTinTuyenSinh::where('locale','=',$locale)->where('_id', '<>', $id)->where('id_cat',$id_cat)->orderBy('date_post', 'desc')->take(9)->get();
        return view('Frontend.TuyenSinh.thong-tin')->with(compact('ds','tin_lien_quan', 'arr_cats'));*/
    }

    function tra_cuu_kqts(Request $request) {
        return view('Frontend.TuyenSinh.tra-cu-ket-qua-tuyen-sinh');
    }

    /**********************ADMIN ****************************/
    function admin(Request $request, $locale = 'vi'){
        $keywords = $request->input('keywords');
        $id_cat = $request->input('id_cat');
        $arr_cats = self::ARR_CATS;
        $danhsach = ThongTinTuyenSinh::where('locale','=',$locale);
        if($id_cat) {
            $danhsach = $danhsach->where('id_cat', $id_cat);
        }
        if($keywords){
            $danhsach = $danhsach->where('ten', 'regexp', '/.*'.$keywords.'/i');
        }
        $danhsach = $danhsach->where('locale','=',$locale)->orderBy('thu_thu', 'asc')->orderBy('date_post', 'desc')->paginate(30);
        return view('Admin.TuyenSinh.list')->with(compact('keywords', 'arr_cats', 'id_cat', 'danhsach'));
    }

    function admin_add(Request $request, $locale = 'vi') {
        $arr_cats = self::ARR_CATS;
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = ThongTinTuyenSinh::find($trans_id);
        } else {
            $ds = '';
        }
        return view('Admin.TuyenSinh.add')->with(compact('ds','trans_id', 'trans_lang', 'arr_cats'));
    }

    function admin_create(Request $request, $locale = 'vi') {
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
        $db = new ThongTinTuyenSinh();
        $db->_id = $id;
        $db->ten = $data['ten'];
        $db->slug = $data['slug'];
        $db->mo_ta = $data['mo_ta'];
        $db->noi_dung = $data['noi_dung'];
        $db->thu_tu = intval($data['thu_tu']);
        $db->photos = $arr_photo;
        $db->attachments = $arr_dinhkem;
        $db->id_cat = isset($data['id_cat']) ? $data['id_cat'] : array();
        $db->locale = $locale;
        $db->date_post = $data['date_post'];
        $db->published = isset($data['published']) ? intval($data['published']) : 0;
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
            $trans->collection = 'thong_tin_tuyen_sinh';
            $trans->save();
        }
        $logQuery = array (
            'action' => 'Thêm Thông tin Tuyển sinh ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'thong_tin_tuyen_sinh',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công.');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/tuyen-sinh/thong-tin');
        return redirect(env('APP_URL') .$locale.'/admin/tuyen-sinh/thong-tin');
    }

    function admin_edit(Request $request, $locale = 'vi', $id = ''){
        $ds = ThongTinTuyenSinh::find($id);
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        $arr_cats = self::ARR_CATS;
        return view('Admin.TuyenSinh.edit')->with(compact('ds', 'trans_id', 'trans_lang', 'arr_cats'));
    }

    function admin_update(Request $request, $locale = ''){
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'slug' => 'required|unique:thong_tin_tuyen_sinh,_id,'.$data['id'],
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
        $db = ThongTinTuyenSinh::find($data['id']);
        $db->ten = $data['ten'];
        $db->slug = $data['slug'];
        $db->mo_ta = $data['mo_ta'];
        $db->noi_dung = $data['noi_dung'];
        $db->thu_tu = intval($data['thu_tu']);
        $db->photos = $arr_photo;
        $db->attachments = $arr_dinhkem;
        $db->id_cat = isset($data['id_cat']) ? $data['id_cat'] : array();
        $db->locale = $locale;
        $db->date_post = $data['date_post'];
        $db->published = isset($data['published']) ? intval($data['published']) : 0;
        $db->id_user = ObjectController::ObjectId($id_user);
        $db->save();
        
        
        //update translatepath
        $trans_lang = $data['trans_lang'];
        $trans_id = $data['trans_id'];
        $id_path = ObjectController::ObjectId($data['id']);
        $check_path = TranslatePath::where("id_".$locale, "=", $id_path)->first();
        if($check_path) {
            $trans = TranslatePath::find($check_path['_id']);
            $trans->{"id_$locale"} = $id_path;
            $trans->{"slug_$locale"} = $data['slug'];
            $trans->collection = 'thong_tin_tuyen_sinh';
            $trans->save();
        }
        $logQuery = array (
            'action' => 'Chỉnh sửa Thông tin Tuyển sinh ['.$data['ten'].']',
            'id_collection' => $data['id'],
            'collection' => 'thong_tin_tuyen_sinh',
            'data' => $data
        );        
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/tuyen-sinh/thong-tin');
        return redirect(env('APP_URL') .$locale.'/admin/tuyen-sinh/thong-tin');
    }

    function admin_delete(Request $request, $locale = '', $id = ''){
        $data = ThongTinTuyenSinh::find($id);
        $logQuery = array (
            'action' => 'Xóa Thông tin Tuyển sinh ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'thong_tin_tuyen_sinh',
            'data' => $data
        );
        if($data['photos']){
            foreach($data['photos'] as $p){
                ImageController::remove($p['aliasname']);
            }
        }
        ThongTinTuyenSinh::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        LogController::addLog($logQuery);
        Session::flash('msg', 'Xóa thành công');
        return redirect(env('APP_URL').$locale.'/admin/tuyen-sinh/thong-tin');
    }
}
