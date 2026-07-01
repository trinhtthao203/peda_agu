<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class KetQuaTuyenSinh2024 extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $table = 'ket_qua_tuyen_sinh_2024';
}
