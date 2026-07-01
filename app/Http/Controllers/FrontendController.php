<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\ThongTinController;
use App\Models\ThongTin;
use App\Models\DMThongTin;
use App\Models\ThongTinTuyenSinh;
use App\Models\Banner;
use App\Models\Views;
use App\Models\ViewsLog;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Str;
use Storage; use Session;
class FrontendController extends Controller
{
    //
    /*function __construct(Request $request) {
        $fullUrl = $request->fullUrl();
        $browser = request()->userAgent();
        $ip = request()->ip();
        $location = Location::get($ip);
        $id_user = Session::get('user._id');
        $v = Views::where('fullUrl', '=', $fullUrl)->first();
        if($v){
            Views::where('fullUrl', '=', $fullUrl)->increment("views");
        } else {
            $vi = new Views();
            $vi->fullUrl = $fullUrl;
            $vi->views = 1;
            $vi->save();
        }
        $log = new ViewsLog();
        $log->fullUrl = $fullUrl;
        $log->browser = $browser;
        $log->ip = $request->ip();
        $log->location = $location;
        $log->id_user = $id_user ? ObjectController::ObjejctId($id_user) : '';
        $log->save();
    }*/

    function index(Request $request, $locale = 'vi') {
        $tin_moi_nhat = ThongTin::where('locale','=',$locale)->where('id_cat','!=', '65080bb00bc7b8223c27c10a')->orderBy('date_post', 'desc')->take(6)->get();
        //$thong_tin_tuyen_sinh = ThongTinTuyenSinh::where('locale','=',$locale)->where('id_cat','dai-hoc-chinh-quy')->where('date_post', 'regexp', '/.*2026/i')->orderBy('date_post', 'desc')->take(10)->get();
        
        $ch = curl_init('https://tuyensinh.agu.edu.vn/api/partner/v1/news?limit=12');
            curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['X-API-Key: edcrm_f014f7ca_ca0c118571ac7d52e79e0e938acbfd95561b0de790179be5']
        ]);
        
        $data = json_decode(curl_exec($ch), true);
        if(!empty($data['data'])){
            $thong_tin_tuyen_sinh = $data['data'];
        } else {
            $thong_tin_tuyen_sinh = array();
        }
        
        $sdg_tags = ThongTinController::get_sdg_tags();
        return view('Frontend.index')->with(compact('tin_moi_nhat','thong_tin_tuyen_sinh', 'sdg_tags'));
    }

    function gioi_thieu(Request $request, $locale = 'vi', $slug = ''){
        return view('Frontend.GioiThieu.'.$slug);
    }

    function about(Request $request, $locale = 'vi', $slug = ''){
        return view('Frontend.About.'.$slug);
    }

    function thong_tin(Request $request, $locale = 'vi', $slug = '') {
        if($slug == 'tin-moi-nhat' || $slug == '' || $slug == 'lastest-news'){
            if($locale == 'vi'){
                $title = 'Tin mới nhất';
            } else {
                $title = 'Lastest News';
            }
            $danhsach = ThongTin::where('locale','=',$locale)->orderBy('date_post', 'desc')->paginate(12);
        } else {
            $cat = DMThongTin::where('locale', '=', $locale)->where('slug','=', $slug)->first();
            $title = $cat['ten'];
            $danhsach = ThongTin::where('locale','=',$locale)->where('id_cat',$cat['_id'])->orderBy('date_post', 'desc')->paginate(12);
        }
        if($slug == '') {
            if($locale == 'vi') $path = 'tin-tuc-su-kien/tin-moi-nhat';
            else $path = 'news-and-events/lastest-news';
        } else {
            if($locale == 'vi') $path = 'tin-tuc-su-kien/'.$slug;
            else $path = 'news-and-events/'.$slug;
        }
        return view('Frontend.thong-tin')->with(compact('danhsach', 'title', 'slug', 'path'));
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
        $danhsach = ThongTin::where('locale','=',$locale)->where('ten', 'regexp', '/.*'.$q.'/i')->orderBy('date_post', 'desc')->paginate(12);
        return view('Frontend.thong-tin')->with(compact('danhsach', 'title', 'slug', 'path'));
    }

    function xem_truc_tuyen(Request $request, $locale = 'vi', $id = '', $key = 0){
        $ds = ThongTin::find($id);
        $key = intval($key);
        if(strtolower($ds['attachments'][$key]['type']) == 'doc' || strtolower($ds['attachments'][$key]['type']) == 'docx' || strtolower($ds['attachments'][$key]['type']) == 'xlsx'){
            $path_file = 'https://www.agu.edu.vn/storage/files/'.$ds['attachments'][$key]['aliasname'];
            $frame_path = 'https://view.officeapps.live.com/op/embed.aspx?src='.$path_file;
            echo '<iframe src="'.$frame_path.'" onload=\'javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));\' style="height:100%;width:100%;border:none;overflow:hidden;"></iframe>';
        } else if(strtolower($ds['attachments'][$key]['type']) == 'pdf') {
            echo '<embed src="'.env('APP_URL').'storage/files/'.$ds['attachments'][$key]['aliasname'].'" style="width:100%;height:100% !important;" />';
        } else {
            echo 'Không thể xem, vui lòng download về xem. Cám ơn!';
        }
    }

    function tai_ve(Request $request, $locale = 'vi', $id = '', $key = 0){
        $ds = ThongTin::find($id);
        $filename = Str::slug($ds['attachments'][$key]['title'], '_').".". $ds['attachments'][$key]['type'];
        $file_path = 'public/files/'.$ds['attachments'][$key]['aliasname'];
        return Storage::download($file_path, $filename);
    }

    function thong_tin_chi_tiet(Request $request, $locale = 'vi', $slug = ''){
        $ds = ThongTin::where('locale','=', $locale)->where('slug','=',$slug)->first();
        $sdg_tags = ThongTinController::get_sdg_tags();
        $id_cat = $ds['id_cat'];
        $id = ObjectController::ObjectId($ds['_id']);
        $tin_lien_quan = ThongTin::where('locale','=',$locale)->where('_id', '<>', $id)->where('id_cat',$id_cat)->orderBy('date_post', 'desc')->take(9)->get();
        return view('Frontend.thong-tin-chi-tiet')->with(compact('ds','tin_lien_quan', 'sdg_tags'));
    }
}
