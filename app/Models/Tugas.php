<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'file',
        'link_drive',
        'untuk_semua_guru',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'date',
        'untuk_semua_guru' => 'boolean',
    ];

    /**
     * Get the file URL
     */
    public function getFileUrlAttribute()
    {
        if ($this->file) {
            return asset('storage/' . $this->file);
        }
        return null;
    }

    /**
     * Check if task is overdue
     */
    public function getIsOverdueAttribute()
    {
        if (!$this->deadline) {
            return false;
        }
        return now()->isAfter($this->deadline);
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute()
    {
        if ($this->is_overdue) {
            return 'Terlambat';
        }
        if ($this->deadline && now()->isBefore($this->deadline)) {
            return 'Aktif';
        }
        return 'Selesai';
    }

    /**
     * Get status color
     */
    public function getStatusColorAttribute()
    {
        if ($this->is_overdue) {
            return 'red';
        }
        if ($this->deadline && now()->isBefore($this->deadline)) {
            return 'green';
        }
        return 'gray';
    }

    /**
     * Get submissions for this task
     */
    public function submissions()
    {
        return $this->hasMany(GuruSubmission::class, 'tugas_id');
    }
}
