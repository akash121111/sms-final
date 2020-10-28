<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable=[
        'adreess_type',
        'street',
        'city',
        'state',
        'country',
        'postal_code',
    ];
}
