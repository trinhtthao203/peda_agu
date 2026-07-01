<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class HoSoDangKyXetTuyen2023 extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $table = 'ho_so_dang_ky_xet_tuyen_2023';

    /***** PHUONG THUC 5 */
    //_id, cmnd, ho_ten, ngay_sinh, nganh_viet_bai_luan, nguyen_vong_1, nguyen_vong_2, nguyen_vong_3, trang_thai, ghi_chu, phuong_thuc
}
