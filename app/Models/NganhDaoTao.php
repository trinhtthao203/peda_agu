<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class NganhDaoTao extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'nganh_dao_taos';
    public const HE_DAO_TAO = [
        'DAI_HOC' => [
            'vi' => 'Đại học chính quy',
            'en' => 'Undergraduate Program',
        ],
        'SAU_DAI_HOC' => [
            'vi' => 'Sau đại học',
            'en' => 'Postgraduate Program',
        ],
    ];

    protected $fillable = [
        'ma_nganh',
        'ten',
        'ten_en',
        'slug',
        'slug_en',
        'he_dao_tao',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'display_order' => 'int',
        'is_active'     => 'bool',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
