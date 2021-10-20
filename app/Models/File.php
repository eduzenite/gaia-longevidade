<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['title', 'type', 'info'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'info' => 'object',
    ];

    /**
     * Get all attendance details
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attendance()
    {
        return $this->belongsToMany(Attendance::class);
    }

    /**
     * Get all attendance details
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function diary()
    {
        return $this->belongsToMany(Diary::class);
    }
}
