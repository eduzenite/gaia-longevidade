<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'doctor_id', 'status', 'appointment', 'time', 'type', 'amount'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'appointment' => 'datetime:Y-m-d H:i',
        'amount' => 'decimal:2'
    ];

    /**
     * Get all attendance details
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendance_details()
    {
        return $this->hasMany(AttendanceDetails::class);
    }

    /**
     * Get all attendance details
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany(File::class);
    }
}
