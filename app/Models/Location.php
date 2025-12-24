<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'city',
        'longitude',
        'latitude',
    ];

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}
