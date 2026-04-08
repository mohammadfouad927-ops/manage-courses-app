<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    protected $fillable = [
        'name',
        'code',
        'active',
    ];

    public function trainingProgram():BelongsToMany{
        return $this->belongsToMany(TrainingProgram::class, 'training_program_courses','trainingProgram_id','course_id');
    }
}
