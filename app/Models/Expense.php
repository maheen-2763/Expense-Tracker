<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    // 🔗 Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔐 Scope: current user's data
    public function scopeOwned(Builder $query): Builder
    {
        return $query->where('user_id', Auth::user()->id);
    }

    // 🔍 Scope: search + type filter
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%");
            })
            ->when($filters['type'] ?? null, function ($q, $type) {
                $q->where('type', $type);
            });
    }

    // ⚡ Auto-assign user_id
    protected static function booted(): void
    {
        static::creating(function ($expense) {
            if (Auth::check() && !$expense->user_id) {
                $expense->user_id = Auth::id();
            }
        });
    }
}