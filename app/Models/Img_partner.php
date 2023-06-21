<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Img_partner extends Model
{
    protected $fillable = [
        'partner_id', 'img_path'
    ];
}
