<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Banner extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $table = 'banners';
    protected $casts = [
        'photos' => 'array',
    ];
    //_id, photos, url
}
