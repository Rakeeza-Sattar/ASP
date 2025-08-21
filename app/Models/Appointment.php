<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_id', 'assigned_officer_id', 'scheduled_at', 'completed_at',
        'status', 'special_instructions', 'officer_notes', 'duration_minutes'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
        'duration_minutes' => 'integer',
    ];

    /**
     * Home where appointment is scheduled
     */
    public function home()
    {
        return $this->belongsTo(Home::class);
    }

    /**
     * Homeowner (through home relationship)
     */
    public function homeowner()
    {
        return $this->home->owner();
    }

    /**
     * Assigned officer
     */
    public function assignedOfficer()
    {
        return $this->belongsTo(User::class, 'assigned_officer_id');
    }

    /**
     * Items documented during this appointment
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Reports generated from this appointment
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Check if appointment is upcoming
     */
    public function isUpcoming()
    {
        return $this->status === 'scheduled' && $this->scheduled_at > now();
    }

    /**
     * Check if appointment is today
     */
    public function isToday()
    {
        return $this->scheduled_at->isToday();
    }

    /**
     * Get formatted appointment time
     */
    public function getFormattedTimeAttribute()
    {
        return $this->scheduled_at->format('g:i A');
    }

    /**
     * Get formatted appointment date
     */
    public function getFormattedDateAttribute()
    {
        return $this->scheduled_at->format('l, F j, Y');
    }
}
