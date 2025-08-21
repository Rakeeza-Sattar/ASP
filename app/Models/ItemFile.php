<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ItemFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'type', 'filename', 'original_name', 
        'mime_type', 'file_size', 'storage_path', 'description'
    ];

    /**
     * Item this file belongs to
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Get file URL
     */
    public function getUrlAttribute()
    {
        return Storage::url($this->storage_path);
    }

    /**
     * Get human readable file size
     */
    public function getFormattedFileSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Check if file is image
     */
    public function isImage()
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    /**
     * Check if file is PDF
     */
    public function isPdf()
    {
        return $this->mime_type === 'application/pdf';
    }
}