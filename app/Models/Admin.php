<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Admin extends Model implements Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use \Illuminate\Auth\Authenticatable;
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['name', 'email'];
    protected $guarded = ['password'];
    protected $hidden = ['password', 'remember_token'];
    
    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'timestamp',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];
}
