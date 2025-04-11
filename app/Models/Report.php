<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'car_plate',
        'description',
        'user_id',
    ];
}
