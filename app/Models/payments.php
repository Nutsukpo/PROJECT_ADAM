<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\employees;
class payments extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';

    protected $fillable =[
        'voucher_id',
        'payment_date',
        'name_of_employee',
        'month_of_payment',
        'payment_amount',
        'purpose_of_payment',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($Payments) {
            $Payments->voucher_id = self::generatePaymentsId();
        });
    }

    public static function generatePaymentsId()
    {
        $prefix = 'SBZCOPV'; // Change this as needed
        $currentYear = date('Y');
        $uniqueNumber = str_pad((payments::max('id') + 1), 2, '0', STR_PAD_LEFT); // Generates a padded number
        return $prefix . $currentYear . $uniqueNumber;
    }

    use HasFactory;
    public function employees()
    {
        return $this->belongsTo(employees::class);
    }

}

