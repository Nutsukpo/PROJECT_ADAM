<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class assets extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'asset_id',
        'asset_name',
        'department_for',
        'asset_type',
        'serial_number',
        'asset_cost',

    ];
}
