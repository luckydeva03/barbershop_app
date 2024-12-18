<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryPoint extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'after_transaction',
        'before_transaction',
        'points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
