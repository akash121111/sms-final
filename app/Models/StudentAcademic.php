<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAcademic extends Model
{
    use HasFactory;

    protected $fillable=[
        'registration_number',
        'admission_number',
        'admission_date',
        'enrollment_number',
        'roll_number',
        'admission_class',

    ];
}
