<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReedemCode extends Model
{
    protected $fillable = ['code', 'points', 'is_active', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
