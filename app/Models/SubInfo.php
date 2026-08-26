<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class SubInfo extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'sub_infos';

    protected $fillable = [
        'ten',
        'type',
        'slug',
        'locale',
        'mo_ta',
        'noi_dung',
        'video_ytb',
        'hinh_anh',
        'id_parent',
        'status',
    ];

    protected $casts = [
        'status' => 'int',
    ];
}
