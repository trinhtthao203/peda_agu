<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KetQuaTuyenSinh2023;
use App\Models\KetQuaTuyenSinh2024;
use App\Models\KetQuaTuyenSinh2025;
use Str; use Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use GuzzleHttp\Client;
class KetQuaTuyenSinhController extends Controller
{
    //

    function ket_qua(Request $request, $locale = 'vi', $nam = 0, $phuongthuc = '') {
        $keywords = $request->input('q');
        $nam = intval($nam);
        if($keywords && $nam == 2025) { 
            $danhsach = KetQuaTuyenSinh2025::where('phuong_thuc', '=', $phuongthuc)->where(function($query) use ($keywords) {
                $ho_ten = str_replace("  ", " ", $keywords);
                $query->where('cmnd', '=', $keywords)->orWhere('ho_ten', 'regexp', '/^'.$ho_ten. '$/i');
            })->get();
        } else if($keywords && $nam == 2024) {
            $danhsach = KetQuaTuyenSinh2024::where('phuong_thuc', '=', $phuongthuc)->where(function($query) use ($keywords) {
                $ho_ten = str_replace("  ", " ", $keywords);
                $query->where('cmnd', '=', $keywords)->orWhere('ho_ten', 'regexp', '/^'.$ho_ten. '$/i');
            })->get();      
        } else if($keywords && $nam == 2023) {
            $danhsach = KetQuaTuyenSinh2023::where('phuong_thuc', '=', $phuongthuc)->where(function($query) use ($keywords) {
                $ho_ten = str_replace("  ", " ", $keywords);
                $query->where('cmnd', '=', $keywords)->orWhere('ho_ten', 'regexp', '/^'.$ho_ten. '$/i');
            })->get();
        }  else {
            $danhsach = '';
        }
        return view('Frontend.TuyenSinh.ket-qua-'.$nam)->with(compact('nam', 'phuongthuc', 'keywords', 'danhsach'));
    }

    function tai_giay_bao(Request $request, $locale='vi', $nam=0, $id='' ) {
        if($nam == 2025){
            $ds = KetQuaTuyenSinh2025::find($id);
            if($ds['phuong_thuc'] == 'ket-qua-tuyen-sinh-bs'){
                if($ds['nhom_to_hop'] == 'NL1') {
                    $giaybao = new TemplateProcessor('storage/templates/GIAY_BAO_BS_2025_NL1.docx');
                } else {
                    $giaybao = new TemplateProcessor('storage/templates/GIAY_BAO_BS_2025.docx');
                }
            } else if($ds['phuong_thuc'] == 'ket-qua-tuyen-sinh-bs2'){
                if($ds['nhom_to_hop'] == 'NL1') {
                    $giaybao = new TemplateProcessor('storage/templates/GIAY_BAO_BS2_2025_NL1.docx');
                } else {
                    $giaybao = new TemplateProcessor('storage/templates/GIAY_BAO_BS2_2025.docx');
                }
            } else if($ds['phuong_thuc'] == 'ket-qua-tuyen-sinh-bs3'){
                if($ds['nhom_to_hop'] == 'NL1') {
                    $giaybao = new TemplateProcessor('storage/templates/GIAY_BAO_BS3_2025_NL1.docx');
                } else {
                    $giaybao = new TemplateProcessor('storage/templates/GIAY_BAO_BS3_2025.docx');
                }
            } else {
                if($ds['nhom_to_hop'] == 'NL1') {
                $giaybao = new TemplateProcessor('storage/templates/GIAY_BAO_2025_NL1.docx');
                } else {
                    $giaybao = new TemplateProcessor('storage/templates/GIAY_BAO_2025.docx');
                }
            }
            
            $giaybao->setValue('so_gbnh', $ds['gbnh']);
            $giaybao->setValue('ho_ten', $ds['ho_ten']);
            $giaybao->setValue('ngay_sinh', $ds['ngay_sinh']);
            $giaybao->setValue('gioi_tinh', $ds['gioi_tinh']);
            $giaybao->setValue('ma_nganh', $ds['ma_nganh']);
            $giaybao->setValue('ten_nganh', $ds['ten_nganh']);
            $giaybao->setValue('phuong_thuc_trung_tuyen', $ds['phuong_thuc_trung_tuyen']);
            $giaybao->setValue('diem', $ds['diem']);
            $giaybao->setValue('nhom_to_hop', $ds['nhom_to_hop']);
            $giaybao->setValue('thu_tu_nv', $ds['thu_tu_nv']);
            $giaybao->setValue('lop', $ds['lop']);
            $giaybao->setValue('ma_sv', $ds['ma_sv']);
            $giaybao->setValue('khoa', $ds['khoa']);            
            $giaybao->setValue('ngay_nhap_hoc', $ds['ngay_nhap_hoc']);            
            $giaybao->setValue('doi_tuong', $ds['doi_tuong']);            
            $giaybao->setValue('khu_vuc', $ds['khu_vuc']);            
            $giaybao->setValue('phai_dong', str_replace(",",".",$ds['phai_dong']));            
            $giaybao->setValue('hoc_phi', str_replace(",",".",$ds['hoc_phi']));
        } else if($nam == 2024) {
            $ds = KetQuaTuyenSinh2024::find($id);
            if($ds['phuong_thuc'] == 'ket-qua-tuyen-sinh-bs') $giaybao = new TemplateProcessor('storage/templates/GIAY_BAO_BS_2024.docx');
            else $giaybao = new TemplateProcessor('storage/templates/GIAY_BAO_2024.docx');
            $giaybao->setValue('so_gbnh', $ds['so_gbnh']);
            $giaybao->setValue('ho_ten', $ds['ho_ten']);
            $giaybao->setValue('ngay_sinh', $ds['ngay_sinh']);
            $giaybao->setValue('gioi_tinh', $ds['gioi_tinh']);
            $giaybao->setValue('doi_tuong_uu_tien', $ds['doi_tuong']);
            $giaybao->setValue('khu_vuc', $ds['khu_vuc']);
            $giaybao->setValue('ten_nganh', $ds['ten_nganh']);
            $giaybao->setValue('ma_nganh', $ds['ma_nganh']);
            $giaybao->setValue('diem_trung_tuyen', $ds['diem_trung_tuyen']);
            $giaybao->setValue('to_hop', $ds['to_hop']);
            $giaybao->setValue('thu_tu_nguyen_vong', $ds['thu_tu_nguyen_vong']);
            $giaybao->setValue('phuong_thuc_trung_tuyen', $ds['phuong_thuc_trung_tuyen']);

            $giaybao->setValue('lop', $ds['lop']);
            $giaybao->setValue('ma_sv', $ds['ma_sv']);
            $giaybao->setValue('phai_dong', $ds['phai_dong']);
            $giaybao->setValue('hoc_phi', $ds['hoc_phi']);
        } else {
            echo 'Không tồn tại';
            exit;
        }
        $filename = Str::slug($ds['ho_ten'], '_').'_'.$ds['cmnd'].'.docx';
        
        $file_export = 'storage/export/'. $filename;
        $giaybao->saveAs($file_export);
        //return response()->download($file_export);
        return response()->download($file_export)->deleteFileAfterSend(true);        
    }
}
