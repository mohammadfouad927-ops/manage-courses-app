<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupSchedule extends Model
{
    protected $fillable = [
        'group_id',
        'day',
        'start_time',
        'end_time',
    ];

    public function group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
