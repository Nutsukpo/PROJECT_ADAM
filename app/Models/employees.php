<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class employees extends Model
{
    

public static function generateemployeeId()
{
    return 'STAFF-' . Str::uuid();
}

    use HasFactory,SoftDeletes;
    protected $fillable =[
        'employee_id',
        'firstname',
        'lastname',
        'contact',
        'email',
        'department',
        'position',
        'address',
        'picture',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            $employee->employee_id = self::generateStaffId();
        });
    }

    public static function generateStaffId()
    {
        $prefix = 'SBZCOS'; // Change this as needed
        $currentYear = date('Y');
        $uniqueNumber = str_pad((employees::max('id') + 0), 2, '0', STR_PAD_LEFT); // Generates a padded number
        return $prefix . $currentYear . $uniqueNumber;
    }

    public function setStaffIdAttribute($value)
{
    // Prevent updating of the staff_id
    if ($this->exists) {
        return;
    }

    $this->attributes['staff_id'] = $value;
}

}