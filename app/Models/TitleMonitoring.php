<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitleMonitoring extends Model
{
    use HasFactory;

    protected $table = 'title_monitoring';

    protected $fillable = [
        'home_id', 'provider', 'status', 'last_check_at', 'next_check_at',
        'alerts', 'alert_count', 'monitoring_notes'
    ];

    protected $casts = [
        'last_check_at' => 'datetime',
        'next_check_at' => 'datetime',
        'alerts' => 'array',
        'alert_count' => 'integer',
    ];

    /**
     * Home being monitored
     */
    public function home()
    {
        return $this->belongsTo(Home::class);
    }

    /**
     * Check if monitoring is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Check if there are alerts
     */
    public function hasAlerts()
    {
        return $this->alert_count > 0;
    }

    /**
     * Get latest alerts
     */
    public function getLatestAlertsAttribute()
    {
        return collect($this->alerts)->sortByDesc('created_at')->take(5);
    }
}