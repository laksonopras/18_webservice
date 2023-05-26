<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'username', 'email', 'password', 'avatar', 'token'
    ];

    protected $hidden = [
        'password',
    ];

    public function banner(){
        return $this->hasMany(Banner::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function partner(){
        return $this->hasMany(Partner::class);
    }
}
