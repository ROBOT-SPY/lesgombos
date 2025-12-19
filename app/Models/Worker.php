<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'name',
        'lastname',
        'contact',
        'email',
        'location_id',
        'activity_id',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

}