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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($incomingletters) {
            $incomingletters->letter_id = self::generateIncominglettersId();
        });
    }

    public static function generateIncominglettersId()
    {
        $prefix = 'SBZCOICL'; // Change this as needed
        $currentYear = date('Y');
        $uniqueNumber = str_pad((incomingletters::max('id') + 0), 2, '0', STR_PAD_LEFT); // Generates a padded number
        return $prefix . $currentYear . $uniqueNumber;
    }

}
