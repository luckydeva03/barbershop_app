<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ReedemCode extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code', 
        'points', 
        'is_active', 
        'user_id',
        'expires_at',
        'description',
        'max_uses',
        'current_uses'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'points' => 'integer',
        'user_id' => 'integer',
        'expires_at' => 'datetime',
        'max_uses' => 'integer',
        'current_uses' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $dates = ['deleted_at', 'expires_at'];

    /**
     * Get the user that redeemed this code.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the code is still valid
     */
    public function isValid(): bool
    {
        return $this->is_active && 
               (!$this->expires_at || $this->expires_at->isFuture()) &&
               ($this->max_uses === null || $this->current_uses < $this->max_uses);
    }

    /**
     * Check if the code is expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Mark code as used
     */
    public function markAsUsed(User $user): bool
    {
        if (!$this->isValid()) {
            return false;
        }

        $this->update([
            'current_uses' => $this->current_uses + 1,
            'user_id' => $user->id,
            'is_active' => $this->max_uses && $this->current_uses + 1 >= $this->max_uses ? false : $this->is_active
        ]);

        return true;
    }

    /**
     * Scope for active codes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for expired codes
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now());
    }

    /**
     * Scope for valid codes
     */
    public function scopeValid($query)
    {
        return $query->where('is_active', true)
                    ->where(function ($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', now());
                    })
                    ->where(function ($q) {
                        $q->whereNull('max_uses')
                          ->orWhereRaw('current_uses < max_uses');
                    });
    }
}
