<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class incomingletters extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =[
        'letter_id',
        'to_whom_received',
        'date_of_letter',
        'sender',
        'mode_of_letter',
        'name_of_person_receiving',
        'reference_no',
        'organization_name',
        'description',
        'receiving_date',
        'file_path',
        
    ];
}
