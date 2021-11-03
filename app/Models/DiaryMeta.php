<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaryMeta extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['diary_id', 'meta', 'value'];

    /**
     * Get all attendance details
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function diary()
    {
        return $this->belongsTo(Diary::class);
    }
}
