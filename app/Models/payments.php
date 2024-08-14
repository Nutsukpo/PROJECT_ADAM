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
    use HasFactory;
    public function employees()
    {
        return $this->belongsTo(employees::class);
    }

}

