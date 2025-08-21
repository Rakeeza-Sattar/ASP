<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_id', 'appointment_id', 'generated_by', 'type', 'report_number',
        'summary', 'total_estimated_value', 'total_items_count', 'pdf_path',
        'homeowner_signature', 'officer_signature', 'signed_at'
    ];

    protected $casts = [
        'total_estimated_value' => 'decimal:2',
        'homeowner_signature' => 'array',
        'officer_signature' => 'array',
        'signed_at' => 'datetime',
    ];

    /**
     * Home this report belongs to
     */
    public function home()
    {
        return $this->belongsTo(Home::class);
    }

    /**
     * Appointment this report was generated from
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * User who generated this report
     */
    public function generatedBy()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    /**
     * Check if report is signed
     */
    public function isSigned()
    {
        return $this->signed_at !== null;
    }

    /**
     * Get PDF URL
     */
    public function getPdfUrlAttribute()
    {
        return $this->pdf_path ? Storage::url($this->pdf_path) : null;
    }
}