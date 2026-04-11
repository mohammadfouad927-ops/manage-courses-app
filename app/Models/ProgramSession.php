<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramSession extends Model
{
    protected $fillable = [
        'training_program_id',
        'price',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function trainingProgram()
    {
        return $this->belongsTo(TrainingProgram::class);
    }
}
