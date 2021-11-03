<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnamnesisQuestions extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['type', 'question', 'anamnesis_question_id'];

    /**
     * Get all attendance details
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function anamnesisAnswers ()
    {
        return $this->hasOne(AnamnesisAnswers::class);
    }
}
