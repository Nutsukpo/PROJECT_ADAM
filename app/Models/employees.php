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
        'base_salary',
        'status'
    ];


    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

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

    // Add to Employee model
public function payrollItems()
{
    return $this->hasMany(PayrollItem::class);
}

public function activePayrolls()
{
    return $this->belongsToMany(Payroll::class, 'payroll_items');
}
    public function setStaffIdAttribute($value)
{
    // Prevent updating of the staff_id
    if ($this->exists) {
        return;
    }

    $this->attributes['staff_id'] = $value;
}

public function scopeActive($query)
{
    return $query->where('status', 'active'); // adjust column name if different
}


}

// <?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Illuminate\Database\Eloquent\SoftDeletes;

// class Employee extends Model
// {
//     use SoftDeletes;

//     protected $fillable = [
//         'firstname',
//         'lastname',
//         'position',
//         // add other fields as needed
//     ];

//     /**
//      * The payrolls that belong to the employee.
//      */
//     public function payrolls(): BelongsToMany
//     {
//         return $this->belongsToMany(Payroll::class, 'payroll_employee')
//                     ->withTimestamps();
//     }

//     /**
//      * Accessor for full name
//      */
//     public function getFullNameAttribute(): string
//     {
//         return $this->firstname . ' ' . $this->lastname;
//     }
// }