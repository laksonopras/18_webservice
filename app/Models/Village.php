<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $fillable = [
        'village', 'district_id', 'postal_code_id'
    ];

    public function postal_code(){
        return $this->belongsTo(PostalCode::class, 'postal_code_id');
    }

    public function district(){
        return $this->belongsTo(District::class, 'district_id');
    }
}
