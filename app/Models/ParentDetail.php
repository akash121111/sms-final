<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentDetail extends Model
{
    use HasFactory;

    protected $fillable=[
        'father_name',
        'father_contact1',
        'father_email',
        'mother_name',
        'mother_contact1',
        'gender',
        'nationality',
    ];
}
