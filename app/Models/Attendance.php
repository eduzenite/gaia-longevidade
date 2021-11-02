<?php

namespace App\Models;

use Carbon\Carbon;
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
    protected $fillable = ['user_id', 'doctor_id', 'status', 'appointment', 'time', 'type', 'speciality_id', 'amount', 'url'];

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

    /**
     * Get all attendance details
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function speciality()
    {
        return $this->hasOne(Speciality::class);
    }

    /**
     * Get all attendance details
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function anamnesis()
    {
        return $this->hasOne(Anamnesis::class);
    }

    public function setAppointmentAttribute($value)
    {
        $this->attributes['appointment'] = Carbon::createFromFormat('Y-m-d H:i', $value);
    }
}
