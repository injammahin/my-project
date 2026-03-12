<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'visitor_id','ip','device','browser','platform',
        'country','region','city','lat','lng'
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
    ];

    public function events()
    {
        return $this->hasMany(VisitorEvent::class);
    }
}
