<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class outgoingletters extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =[
        'letter_id',
        'reference_no',
        'organization_name',
        'description',
        'sending_date',
    ];
}

