<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
    ];

    public function workers()
    {
        return $this->hasMany(Location::class);
    }
}
