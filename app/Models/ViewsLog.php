<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class ViewsLog extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $table = 'views_log';

    //_id, fullUrl, ip, broswer, location, id_user
}
