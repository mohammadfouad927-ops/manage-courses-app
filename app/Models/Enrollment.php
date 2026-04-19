<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\PaymentStatus;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'program_session_id',
        'group_id',
        'paymentStatus',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function programSession()
    {
        return $this->belongsTo(ProgramSession::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function casts()
    {
        return [
            'paymentStatus' => PaymentStatus::class,
        ];
    }
}
