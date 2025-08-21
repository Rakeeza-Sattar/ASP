<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id', 'address', 'city', 'state', 'zip_code',
        'property_type', 'square_footage', 'year_built', 'notes'
    ];

    protected $casts = [
        'square_footage' => 'decimal:2',
        'year_built' => 'integer',
    ];

    /**
     * Owner of the home
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Appointments for this home
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Items in this home
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Reports for this home
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Title monitoring for this home
     */
    public function titleMonitoring()
    {
        return $this->hasOne(TitleMonitoring::class);
    }

    /**
     * Get full address
     */
    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->state} {$this->zip_code}";
    }

    /**
     * Get total estimated value of items
     */
    public function getTotalEstimatedValueAttribute()
    {
        return $this->items()->sum('estimated_value');
    }
}
