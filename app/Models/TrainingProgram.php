<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TrainingProgram extends Model
{
    protected $fillable = [
        'name'
    ];

    
    public function course(): BelongsToMany{
        return $this->belongsToMany(Course::class, 'Training_program_courses','course_id', 'trainingProgram_id');
    }
}
