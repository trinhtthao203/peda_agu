<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class SubInfo extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'sub_infos';

    protected $fillable = [
        'type',
        'slug',
        'locale',
        'ten',
        'mo_ta',
        'noi_dung',
        'status'
    ];
}
