<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familyplanning extends Model
{
    use HasFactory;

    protected $fillable = [
        'arrival_date',
        'body_weight',
        'blood_pressure',
        'return_date',
    ];
}

