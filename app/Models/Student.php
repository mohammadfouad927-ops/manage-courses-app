<?php

namespace App\Models;

use App\Governorate;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nameEn',
        'nameAr',
        'email',
        'birthDate',
        'governorate',
        'NationalId',
        'photoPath',
        'phoneNumber',
        'studentStatus',
        'school',
    ];

    public function casts():array
    {
        return [
            'governorate' => Governorate::class
        ];
    }

    protected function photoPath(): Attribute{
        return Attribute::make(
            get: fn (?string $value) => $value ?? 'avatars/default_photo.jpg', 
        );
    }
}
