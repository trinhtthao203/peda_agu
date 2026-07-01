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

class PhatTrienBenVungController extends Controller
{
    //
    protected $arr_page = array(
        've-nguon-nang-luong' => 'Về nguồn năng lượng',
        've-nguon-nuoc' => 'Về nguồn nước',
        'hoat-dong-tai-che' => 'Hoạt động Tái chế',
        'no-luc-cai-thien-tinh-hinh-giao-thong' => 'Nỗ lực cải thiện tình hình giao thông',
        'tai-su-dung-tai-lieu-giao-trinh' => 'Tái sử dụng tài liệu giáo trình',
        'hoat-dong-trao-doi-sach' => 'Hoạt động trao đổi sách',
        'thu-nhan-pin-da-su-dung' => 'Thu nhận Pin đã sử dụng',
        'tao-san-pham-handmake-tu-vat-lieu-tai-che' => 'Tạo sản phẩm Handmake từ vật liệu tái chế'
    );
    protected $id_cat = '65080bb00bc7b8223c27c10a';
    function index(Request $request, $locale = 'vi') {
        $id_cat = $this->id_cat;
        $sdg_tags = ThongTinController::get_sdg_tags();
        $tin_moi_nhat = ThongTin::where('locale','=',$locale)->where('id_cat', $id_cat)->orderBy('date_post', 'desc')->take(3)->get();
        return view('Frontend.PhatTrienBenVung.index')->with(compact('tin_moi_nhat','sdg_tags'));
    }

    function thong_tin(Request $request, $locale = '', $slug) {
        $arr_page = $this->arr_page;
        $title_page = isset($arr_page[$slug]) ? $arr_page[$slug] : '';
        $id_cat = $this->id_cat;
        $sdg_tags = ThongTinController::get_sdg_tags();
        if($slug == 'tin-tuc-su-kien') {
            $title = 'Tin tức - Sự kiện về Phát triển bền vững';
            $path = 'phat-trien-ben-vung';
            $danhsach = ThongTin::where('locale','=',$locale)->where('id_cat', $id_cat)->orderBy('date_post', 'desc')->paginate(9);
            return view('Frontend.PhatTrienBenVung.tin-tuc-su-kien')->with(compact('danhsach', 'title', 'path'));
        } else if($title_page) {
            return view('Frontend.PhatTrienBenVung.static-page')->with(compact('slug', 'arr_page', 'title_page'));
        } else {
            $ds = ThongTin::where('slug', '=', $slug)->first();
            $id_cat = $this->id_cat; //$ds['id_cat'];
            $id = ObjectController::ObjectId($ds['_id']);
            $tin_lien_quan = ThongTin::where('locale','=',$locale)->where('_id', '<>', $id)->where('id_cat',$id_cat)->orderBy('date_post', 'desc')->take(9)->get();
            return view('Frontend.PhatTrienBenVung.thong-tin')->with(compact('ds','tin_lien_quan', 'arr_page', 'sdg_tags'));
        }
        
    }
}
