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
     * Get all attendance details
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attendance()
    {
        return $this->belongsToMany(Attendance::class);
    }
}
