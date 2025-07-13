<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FelishaAnimal extends Model
{
    protected $table = 'felisha_animals'; // <- Tambahan ini

    protected $fillable = ['name', 'jenis_kelamin', 'category_id', 'image'];

    public function category()
    {
        return $this->belongsTo(FelishaCategory::class, 'category_id');
    }

    public function reports()
    {
        return $this->hasMany(FelishaReport::class, 'animal_id');
    }
}
