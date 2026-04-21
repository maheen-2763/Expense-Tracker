<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; 

class Expense extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'type',
        'date',
    ];

    # Casts for date and amount
    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    # Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    # Scope to get only expenses of the authenticated user
    public function scopeOwned($query)
    {
        return $query->where('user_id', Auth::id());
    }
    
    # Automatically set user_id on creation    
   protected static function booted()
{
    static::creating(function ($expense) {
        if (Auth::check()) {
            $expense->user_id = Auth::id();
        }
    });
}
}
