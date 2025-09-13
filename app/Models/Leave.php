<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'designation',
        'contact_number',
        'leave_type',
        'reason',
        'date_last_leave',
        'days_entitled',
        'days_applied_for',
        'days_already_utilized',
        'date_commencement',
        'date_resumption',
        'date_of_application',
        'signature',
        'recommendation',
        'administrator_name',
        'administrator_signature',
        'administrator_date',
        'zonal_coordinator_name',
        'zonal_coordinator_signature',
        'zonal_coordinator_date',
        'status',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_last_leave' => 'date',
        'date_commencement' => 'date',
        'date_resumption' => 'date',
        'administrator_date' => 'date',
        'zonal_coordinator_date' => 'date',
        'days_entitled' => 'integer',
        'days_applied_for' => 'integer',
        'days_already_utilized' => 'integer',
    ];

    /**
     * Get the user that owns the leave application.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include pending leaves.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include approved leaves.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope a query to only include rejected leaves.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Calculate the remaining leave days.
     */
    public function getRemainingDaysAttribute()
    {
        return $this->days_entitled - $this->days_already_utilized;
    }

    /**
     * Check if the leave application is pending.
     */
    public function isPending()
    {
        return $this->status === 'daft';
    }

    /**
     * Check if the leave application is approved.
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if the leave application is rejected.
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}