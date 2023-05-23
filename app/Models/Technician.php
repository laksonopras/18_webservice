<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'email', 'avatar', 'partner_id'
    ];

    protected $hidden = [
        'password'
    ];

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function partner(){
        return $this->belongsTo(partner::class);
    }

}
