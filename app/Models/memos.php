<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Memos extends Model
{
    use HasFactory;

    const STAGES = [
        'draft',
        'validated',
        'authorized',
        'processed',
        'disbursed',
        'credited',
    ];

    public static function stageColors()
{
    return [
        'draft'     => 'dark',    
        'validated'  => 'primary', 
        'authorized' => 'warning',   
        'processed'   => 'success',      
        'disbursed'  => 'info',      
        'credited'    => 'danger',      
    ];
}
    

    protected $table = 'memos';

    protected $fillable = [
        'to',
        'from',
        'date',
        'subject',
        'body',
        'amount',
        'currency',
        'items',
        'name_of_employee',
        'status',
        'signature',
        'minute_to',
        'minutes', 
        'minute_date',
        'minute_signature'
        
    ];

    protected $casts = [
        'items' => 'array',  // Auto-cast JSON to array
        'amount' => 'decimal:2',
    ];

    /**
     * Get the user who created the memo.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
