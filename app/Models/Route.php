<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'origin',
        'destination',
        'availableSeats',
        'baseRate',
        'adminuser'
    ];
}