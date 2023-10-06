<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'reservation_date',
        'quantity_seats',
        'purchase_date',
        'payment',
        'idroute'
    ];
}
