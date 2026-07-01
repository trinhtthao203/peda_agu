<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class ThongTin extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $table = 'thong_tin';

    protected $dates = ['date_post'];
}
