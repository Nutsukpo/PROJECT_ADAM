<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class payments extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =[
        'voucher_id',
        'payment_date',
        'name_of_employee',
        'month_of_payment',
        'payment_amount',
        'purpose_of_payment',
    ];
}

