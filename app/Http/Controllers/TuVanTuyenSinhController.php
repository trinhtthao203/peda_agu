<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TranslatePathController;
use App\Models\TranslatePath;
use App\Http\Controllers\ViewsController;
use App\Models\Views;
use App\Models\ViewsLog;
use App\Models\TuVanTuyenSinh;
use Session; use Validator;use Location;use Storage;
class TuVanTuyenSinhController extends Controller
{
    //
    const ARR_CATS = array(
        array('id' => 'ho-so','title' => 'Hồ sơ','bgcolor' => 'bg-yellow','icon' => 'uni-add-file'), 
        array('id' => 'quy-che','title' => 'Quy chế','bgcolor' => 'bg-green','icon' => 'uni-notepad'), 
        array('id' => 'nganh-nghe-tuyen-sinh','title' => 'Ngành nghề Tuyển sinh','bgcolor' => 'bg-pink','icon' => 'uni-gear'), 
        array('id' => 'hoc-bong','title' => 'Học bổng','bgcolor' => 'bg-voilet','icon' => 'uni-heart'), 
        array('id' => 'chinh-sach','title' => 'Chính sách','bgcolor' => 'bg-brow','icon' => 'uni-megaphone'), 
        array('id' => 'hoat-dong','title' => 'Hoạt động','bgcolor' => 'bg-orange','icon' => 'uni-atom'), 
        array('id' => 'viec-lam','title' => 'Việc làm','bgcolor' => 'bg-blue','icon' => 'uni-handshake'), 
        array('id' => 'van-de-khac','title' => 'Những vấn đề khác','bgcolor' => 'bg-red','icon' => 'uni-arrow-around')
    );

    function index(Request $request, $locale = 'vi') {
        $arr_cats = self::ARR_CATS;
        return view('Frontend.TuyenSinh.tu-van')->with(compact('arr_cats'));
    }

    function get_title_cat($id_cat) {
        $arr_cats = self::ARR_CATS;
        foreach($arr_cats as $cat){
            if($cat['id'] == $id_cat) return $cat['title'];
        }
        return '';
    }
    function tu_van(Request $request, $locale = '', $slug = '') {
        $arr_cats = self::ARR_CATS;
        $keywords = $request->input('q');
        $id_cat = $request->input('id_cat');
        if($slug == 'tim-kiem') {
            $title = 'Kết quả tìm kiếm';
            $slug = $id_cat;
        } else {
            $title = $this->get_title_cat($slug);
        }
        $danhsach = TuVanTuyenSinh::where('locale','=',$locale)->where('status', '=', 1);
        
        if($id_cat){
            $danhsach = $danhsach->where('id_cat', $id_cat);
        }
        //$danhsach = TuVanTuyenSinh::where('locale','=',$locale)->where('id_cat', $slug);
        if($keywords) {
            $danhsach = $danhsach->where('noi_dung', 'regexp', '/.*'.$keywords.'/i');
        }
        $danhsach = $danhsach->orderBy('updated_at', 'desc')->paginate(9);
        return view('Frontend.TuyenSinh.tu-van-slug')->with(compact('arr_cats','title','danhsach','slug', 'keywords'));
    }

    function goi_cau_hoi(Request $request, $locale = 'vi') {
        $arr_cats = self::ARR_CATS;
        return view('Frontend.TuyenSinh.goi-cau-hoi')->with(compact('arr_cats'));
    }

    function goi_cau_hoi_create(Request $request, $locale = 'vi') {
        $data = $request->all();
        $db = new TuVanTuyenSinh();
        $db->ho_ten = $data['ho_ten'];
        $db->email = $data['email'];
        $db->dien_thoai = $data['dien_thoai'];
        $db->noi_dung = $data['noi_dung'];        
        $db->tra_loi = '';
        $db->id_cat = array($data['id_cat']);
        $db->status = 0;
        $db->thuong_gap = 0;
        $db->nam = date("Y");
        $db->locale = $locale;
        $db->save();
        Session::flash('msg', 'Success');
        return redirect(env('APP_URL').$locale .'/tuyen-sinh/tu-van-tuyen-sinh/goi-cau-hoi');
    }

    /***********************ADMIN************************* */

    function admin(Request $request, $locale = 'vi') {
        $keywords = $request->input('keywords');
        $id_cat = $request->input('id_cat');
        $tra_loi = $request->input('tra_loi');
        $cong_bo = $request->input('cong_bo');
        $arr_cats = self::ARR_CATS;
        $danhsach = TuVanTuyenSinh::where('locale','=',$locale);
        if($id_cat) {
            $danhsach = $danhsach->where('id_cat', $id_cat);
        }
        if($tra_loi < 2) {
            if($tra_loi == 0){
                $danhsach = $danhsach->where('tra_loi', '=', '');
            }
            if($tra_loi == 1) {
                $danhsach = $danhsach->where('tra_loi', '!=', '');
            }    
        }
        if(intval($cong_bo) < 2) {
            $danhsach = $danhsach->where('status', '=', intval($cong_bo));
        }
        if($keywords){
            $danhsach = $danhsach->where('noi_dung', 'regexp', '/.*'.$keywords.'/i');
        }
        $danhsach = $danhsach->orderBy('thu_thu', 'asc')->orderBy('date_post', 'desc')->paginate(30);
        return view('Admin.TuyenSinh.tu-van')->with(compact('keywords', 'arr_cats', 'id_cat', 'danhsach','tra_loi','cong_bo'));
    }
    function edit(Request $request, $locale = 'vi', $id = '') {
        $ds = TuVanTuyenSinh::find($id);      
        $arr_cats = self::ARR_CATS;
        return view('Admin.TuyenSinh.tu-van-edit')->with(compact('ds','arr_cats'));
    }

    function update(Request $request, $locale = 'vi') {
        $data = $request->all();
        $id_user = $request->session()->get('user._id');
        $fullname = $request->session()->get('user.fullname');
        $db = TuVanTuyenSinh::find($data['id']);
        $db->ho_ten = $data['ho_ten'];
        $db->email = $data['email'];
        $db->dien_thoai = $data['dien_thoai'];
        $db->noi_dung = $data['noi_dung'];
        $db->tra_loi = $data['tra_loi'];
        $db->id_cat = $data['id_cat'];
        $db->status = isset($data['status']) ? intval($data['status']) : 0;
        $db->thuong_gap = isset($data['thuong_gap']) ? intval($data['thuong_gap']) : 0;
        $db->locale = $locale;
        $db->id_user = ObjectController::ObjectId($id_user);
        $db->nguoi_tra_loi =  $fullname;
        $db->save();
        Session::flash('msg', 'Cập nhật thàng công');
        return redirect(env('APP_URL').$locale.'/admin/tuyen-sinh/tu-van');
    }

    function delete(Request $request, $locale ='vi', $id = '') {
        TuVanTuyenSinh::destroy($id);
        Session::flash('msg', 'Cập nhật thàng công');
        return redirect(env('APP_URL').$locale.'/admin/tuyen-sinh/tu-van');
    }
}
