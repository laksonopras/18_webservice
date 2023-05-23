<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $guard ='customer';

    protected $fillable = [
        'username', 'email', 'password', 'avatar', 'token', 'status'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function call(){
        return $this->hasMany(Call::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }
}
