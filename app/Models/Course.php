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

    public function trainingPrograms():BelongsToMany{
        return $this->belongsToMany(TrainingProgram::class, 'training_programs_courses','course_id', 'trainingProgram_id')
                    ->withTimestamps();
    }
}
