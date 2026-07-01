<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class DMThongTin extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $table = 'dm_thong_tin';
}
