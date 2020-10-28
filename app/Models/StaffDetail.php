<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Validator;

class StaffDetail extends Model
{
    use HasFactory;

    protected $fillable=[
        'first_name',
        'contact1',
        'email',
        'gender',
        'nationality',
    ];
}
