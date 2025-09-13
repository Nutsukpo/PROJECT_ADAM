<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'payroll_id',
        'employee_id',
        'base_salary',
        'bonuses',
        'deductions',
        'tax',
        'net_pay',
        'payment_method',
        'paid_at',
        'notes'
    ];

    protected $casts = [
        'paid_at' => 'date',
        'base_salary' => 'decimal:2',
        'bonuses' => 'decimal:2',
        'deductions' => 'decimal:2',
        'tax' => 'decimal:2',
        'net_pay' => 'decimal:2',
    ];

    // Relationships
    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }

    public function employees()
    {
        return $this->belongsTo(employees::class);
    }

    // Automatic calculation
    protected static function booted()
    {
        static::saving(function ($item) {
            $item->net_pay = $item->base_salary 
                + $item->bonuses 
                - $item->deductions 
                - $item->tax;
        });
    }
}