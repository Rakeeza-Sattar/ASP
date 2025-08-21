<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_id', 'officer_id', 'scheduled_at', 'started_at', 'completed_at',
        'status', 'special_instructions', 'officer_notes', 'estimated_duration',
        'preparation_checklist'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'estimated_duration' => 'decimal:1',
        'preparation_checklist' => 'array',
    ];

    /**
     * Home for this appointment
     */
    public function home()
    {
        return $this->belongsTo(Home::class);
    }

    /**
     * Assigned officer
     */
    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }

    /**
     * Related payment
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Reports generated from this appointment
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Check if appointment is scheduled
     */
    public function isScheduled()
    {
        return $this->status === 'scheduled';
    }

    /**
     * Check if appointment is in progress
     */
    public function isInProgress()
    {
        return $this->status === 'in_progress';
    }

    /**
     * Check if appointment is completed
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    /**
     * Get duration in hours
     */
    public function getActualDurationAttribute()
    {
        if ($this->started_at && $this->completed_at) {
            return $this->started_at->diffInHours($this->completed_at, true);
        }
        return null;
    }
}
