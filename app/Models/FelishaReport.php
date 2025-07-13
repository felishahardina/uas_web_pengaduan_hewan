<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FelishaReport extends Model
{
    protected $fillable = [
        'user_id',
        'felisha_animal_id',
        'address',          // Alamat detail kejadian
        'contact_phone',    // No. Telepon yang bisa dihubungi untuk laporan ini
        'description',
        'image_path',
        'status',
    ];
    public function animal()
    {
        return $this->belongsTo(FelishaAnimal::class, 'animal_id');
    }


    public function location()
    {
        return $this->belongsTo(FelishaLocation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
