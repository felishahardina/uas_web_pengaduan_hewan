<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FelishaCategory extends Model
{
    protected $fillable = ['name'];

    public function animals()
    {
        return $this->hasMany(FelishaAnimal::class, 'category_id');
    }
}