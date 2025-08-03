<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'points',
        'google_id',
        'avatar',
        'provider',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be guarded.
     *
     * @var list<string>
     */
    protected $guarded = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'points' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    protected $dates = ['deleted_at'];

    /**
     * Get the history points for the user.
     */
    public function historyPoints()
    {
        return $this->hasMany(HistoryPoint::class);
    }

    /**
     * Get the reviews for the user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the redeem codes used by the user.
     */
    public function reedemCodes()
    {
        return $this->hasMany(ReedemCode::class);
    }

    /**
     * Increment user points safely
     */
    public function incrementPoints(int $points): bool
    {
        return $this->increment('points', $points);
    }

    /**
     * Decrement user points safely
     */
    public function decrementPoints(int $points): bool
    {
        if ($this->points < $points) {
            return false;
        }
        return $this->decrement('points', $points);
    }
}
