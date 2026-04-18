<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\DaysWeek;

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

    public function casts(): array
    {
        return [
            'day' => DaysWeek::class,
        ];
    }
}
