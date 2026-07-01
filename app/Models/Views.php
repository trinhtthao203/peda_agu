<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Views extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $table = 'views';

    //_id, fullUrl, views

}
