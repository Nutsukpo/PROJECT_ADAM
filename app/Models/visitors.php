<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class visitors extends Model
{
    // use HasFactory,SoftDeletes;

    protected $fillable = [
        'visitor_name',
        'contact',
        'department',
        'gender',
        'vulnerability',
        'purpose_of_visit',
        'time_in',
        'time_out',
        'visiting_date'

    ];
}