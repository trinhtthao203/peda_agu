<?php
namespace App\Models;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class DMDiaChi extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $table = 'dm_diachi';
}
