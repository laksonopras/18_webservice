<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'city', 'province_id'
    ];

    public function Province(){
        return $this->belongsTo(Province::class);
    }

    public function District(){
        return $this->hasMany(District::class);
    }
}

