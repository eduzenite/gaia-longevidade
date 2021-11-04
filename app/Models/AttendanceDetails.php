<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceDetails extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['attendance_id', 'title', 'contents'];

    /**
     * Get all attendance details
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attendance()
    {
        return $this->belongsToMany(Attendance::class);
    }
}
