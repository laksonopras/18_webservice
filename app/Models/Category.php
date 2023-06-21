<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name', 'admin_id'
    ];

    public function partner(){ return $this->hasMany(Partner::class); }

    public function admin(){ return $this->belongsTo(Admin::class); }
}
