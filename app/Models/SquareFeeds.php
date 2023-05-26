<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SquareFeeds extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_path'
    ];

    public function admin(){ return $this->belongsTo(Admin::class);}
}
