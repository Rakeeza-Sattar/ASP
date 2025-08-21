<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_id', 'documented_by', 'category', 'description', 'brand', 'model',
        'serial_number', 'estimated_value', 'purchase_price', 'purchase_date',
        'condition', 'location_in_home', 'notes', 'custom_fields'
    ];

    protected $casts = [
        'estimated_value' => 'decimal:2',
        'purchase_price' => 'decimal:2',
        'purchase_date' => 'date',
        'custom_fields' => 'array',
    ];

    /**
     * Home this item belongs to
     */
    public function home()
    {
        return $this->belongsTo(Home::class);
    }

    /**
     * Officer who documented this item
     */
    public function documentedBy()
    {
        return $this->belongsTo(User::class, 'documented_by');
    }

    /**
     * Files associated with this item
     */
    public function files()
    {
        return $this->hasMany(ItemFile::class);
    }

    /**
     * Photos only
     */
    public function photos()
    {
        return $this->hasMany(ItemFile::class)->where('type', 'photo');
    }

    /**
     * Receipts only
     */
    public function receipts()
    {
        return $this->hasMany(ItemFile::class)->where('type', 'receipt');
    }

    /**
     * Get primary photo
     */
    public function getPrimaryPhotoAttribute()
    {
        return $this->photos()->first();
    }

    /**
     * Get full item name
     */
    public function getFullNameAttribute()
    {
        $parts = array_filter([$this->brand, $this->model, $this->description]);
        return implode(' - ', $parts);
    }
}
