<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'hours',
        'latitude',
        'longitude',
        'image',
        'is_active',
        'order_sort'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'is_active' => 'boolean',
        'order_sort' => 'integer'
    ];

    /**
     * Scope untuk hanya stores yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk mengurutkan berdasarkan order_sort
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_sort', 'asc')->orderBy('name', 'asc');
    }

    /**
     * Get image URL dengan fallback
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path($this->image))) {
            return asset($this->image);
        }
        
        return 'https://via.placeholder.com/400x200/667eea/ffffff?text=Altoz+BarberShop';
    }

    /**
     * Validasi koordinat latitude
     */
    public function setLatitudeAttribute($value)
    {
        if ($value < -90 || $value > 90) {
            throw new \InvalidArgumentException('Latitude must be between -90 and 90');
        }
        $this->attributes['latitude'] = $value;
    }

    /**
     * Validasi koordinat longitude
     */
    public function setLongitudeAttribute($value)
    {
        if ($value < -180 || $value > 180) {
            throw new \InvalidArgumentException('Longitude must be between -180 and 180');
        }
        $this->attributes['longitude'] = $value;
    }
}
