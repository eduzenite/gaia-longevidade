<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnamnesisMeta extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
        protected $fillable = ['anamnesis_id', 'meta', 'value'];

    /**
     * Get all attendance details
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anamnesis()
    {
        return $this->belongsTo(Anamnesis::class);
    }
}
