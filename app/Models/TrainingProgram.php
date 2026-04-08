<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TrainingProgram extends Model
{
    protected $fillable = [
        'name'
    ];

    
    public function courses(): BelongsToMany{
        return $this->belongsToMany(Course::class, 'training_programs_courses', 'trainingProgram_id', 'course_id');
    }
}
