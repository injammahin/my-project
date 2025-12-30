<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'visitor_id',
        'ip',
        'device',
        'browser',
        'platform'
    ];

    public function events()
    {
        return $this->hasMany(VisitorEvent::class);
    }
}
