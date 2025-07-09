<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FelishaLocation extends Model
{
    protected $fillable = ['area_name', 'city'];

    public function reports()
    {
        return $this->hasMany(FelishaReport::class, 'location_id');
    }
}