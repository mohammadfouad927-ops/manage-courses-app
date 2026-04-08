<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainigProgramCourses extends Model
{
    protected $fillable = [
        'trainingProgram_id',
        'course_id',
    ];

    public function trainingProgram(): BelongsTo{
        return $this->belongsTo(TrainingProgram::class);
    }

    public function course(): BelongsTo{
        return $this->belongsTo(Course::class);
    }
}
