<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\employees;


class Attendance extends Model
{
    protected $fillable = [
        'employee_name',
        'attendance_date',
        'clock_in',
        'clock_out',
        'time',
    ];

    public function employee()
    {
        return $this->belongsTo(employees::class);
    }
}


