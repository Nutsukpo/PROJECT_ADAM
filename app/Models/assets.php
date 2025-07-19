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
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($assets) {
            $assets->asset_id = self::generateAssetsId();
        });
    }

    public static function generateAssetsId()
    {
        $prefix = 'SBZCOA'; // Change this as needed
        $currentYear = date('Y');
        $uniqueNumber = str_pad((assets::max('id') + 0), 2, '0', STR_PAD_LEFT); // Generates a padded number
        return $prefix . $currentYear . $uniqueNumber;
    }

    public function setAssetIdAttribute($value)
{
    // Prevent updating of the staff_id
    if ($this->exists) {
        return;
    }

    $this->attributes['asset_id'] = $value;
}
}
