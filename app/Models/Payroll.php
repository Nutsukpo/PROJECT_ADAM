<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'period_start',
        'period_end',
        'status',
        'notes'
    ];

    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
    ];

    /**
     * The employees that belong to the payroll.
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(employees::class, 'payroll_employee')
                    ->withTimestamps();
    }
}