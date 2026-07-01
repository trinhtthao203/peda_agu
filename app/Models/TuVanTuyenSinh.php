<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class TuVanTuyenSinh extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $table = 'tu_van_tuyen_sinh';
}
