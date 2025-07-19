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
        'file_path',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($outgoingletters) {
            $outgoingletters->letter_id = self::generateOutgoinglettersId();
        });
    }

    public static function generateOutgoinglettersID()
    {
        $prefix = 'SBZCOOGL'; // Change this as needed
        $currentYear = date('Y');
        $uniqueNumber = str_pad((outgoingletters::max('id') + 0), 2, '0', STR_PAD_LEFT); // Generates a padded number
        return $prefix . $currentYear . $uniqueNumber;
    }

}

