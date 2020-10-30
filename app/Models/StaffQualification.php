<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staffQualification extends Model
{
    use HasFactory;

    protected $fillable=[
        'qualification_type',
        'institute_name',
        'qualification',
        'board_name',
    ];
}
