<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class NhanSu extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'nhan_sus';

    protected $fillable = [
        'ho_ten',
        'hoc_ham_hoc_vi',
        'chuyen_nganh',
        'email',
        'hinh_anh',
        'ly_lich_khoa_hoc',
        'departments',
        'chuc_vu'
    ];

    protected $casts = [
        'ly_lich_khoa_hoc' => 'array',
    ];

    /**
     * Accessor for backward compatibility — old records without a `departments`
     * field will return an empty array instead of null.
     * Also handles JSON-encoded strings from MongoDB.
     */
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

    /**
     * Return the DepartmentEntry for the given department ID, or null if not found.
     */
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
