<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoSoDangKyXetTuyen2023;
class HoSoDangKyXetTuyenController extends Controller
{
    //
    function ket_qua(Request $request, $locale = 'vi',  $nam = 0, $phuongthuc = ''){
        $keywords = $request->input('q');
        $nam = intval($nam);
        if($keywords && $nam == 2023) {
            //$danhsach = HoSoDangKyXetTuyen2023::where('cmnd', '=', $keywords)->orWhere('ho_ten', 'regexp', '/.*'.$keywords.'/i')->get();

            $danhsach = HoSoDangKyXetTuyen2023::where('phuong_thuc', '=', $phuongthuc)->where(function($query) use ($keywords) {
                $query->where('cmnd', '=', $keywords)->orWhere('ho_ten', 'regexp', '/^'.$keywords. '$/i');
            })->get();
        } else {
            $danhsach = '';
        }
        return view('Frontend.TuyenSinh.ho-so-dangky-xet-tuyen-'.$nam)->with(compact('nam', 'phuongthuc', 'keywords', 'danhsach'));
    }
}
