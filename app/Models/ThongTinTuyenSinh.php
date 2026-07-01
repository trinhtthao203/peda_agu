<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class ThongTinTuyenSinh extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $table = 'thong_tin_tuyen_sinh';
}
