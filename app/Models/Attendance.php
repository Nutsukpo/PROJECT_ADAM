<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\employees;
class Attendance extends Model
{

    protected $fillable =[
        'name_of_employee',
        'clock_in',
        'attendance_date',
        'time',
    ];
    use HasFactory;

}



