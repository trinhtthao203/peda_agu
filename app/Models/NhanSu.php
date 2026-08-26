<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class NhanSu extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'nhan_sus';

    protected $fillable = [
        'ho_ten',
        'ho_ten_en',
        'hoc_ham_hoc_vi',
        'hoc_ham_hoc_vi_en',
        'chuyen_nganh',
        'chuyen_nganh_en',
        'email',
        'hinh_anh',
        'ly_lich_khoa_hoc',
        'departments',
        'chuc_vu',
        'chuc_vu_en'
    ];

    protected $casts = [
        'ly_lich_khoa_hoc' => 'array',
    ];

    public function getDepartmentsAttribute($value): array
    {
        if (is_array($value)) {
            return $value;
        }
        if (is_string($value) && !empty($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
    }

    public function getRoleInDepartment(?string $departmentId): ?array
    {
        if (empty($departmentId)) {
            return null;
        }
        $departments = $this->getAttributeFromArray('departments') ?? [];
        foreach ($departments as $entry) {
            if (isset($entry['department_id']) && (string)$entry['department_id'] === (string)$departmentId) {
                return $entry;
            }
        }
        return null;
    }
}
