<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventStat extends Model
{
    protected $fillable = [
        'date','event','page','count','total_seconds'
    ];
}
