<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePartners extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_path'
    ];

    public function partner(){ return $this->belongsTo(Partner::class);}
}
