<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'district', 'city_id'
    ];

    public function City(){
        return $this->belongsTo(City::class);
    }

    public function Village(){
        return $this->hasMany(Village::class);
    }
}
