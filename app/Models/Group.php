<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Group extends Model
{
    protected $fillable = [
        'name',
        'program_session_id',
        'branch_id',
        'capacity',
        'isActive',
    ];


    public function programSession():BelongsTo
    {
        return $this->belongsTo(ProgramSession::class);
    }

    public function branch():BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function groupSchedules()
    {
        return $this->hasMany(GroupSchedule::class);
    }
}
