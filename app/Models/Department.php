<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Department extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'departments';

    protected $fillable = [
        'name',
        'slug',
        'type',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'display_order' => 'int',
        'is_active'     => 'bool',
    ];

    /**
     * Scope lọc các department đang hoạt động.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
