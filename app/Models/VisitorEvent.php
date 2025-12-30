<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorEvent extends Model
{
    protected $fillable = [
        'visitor_id',
        'event',
        'page',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}

