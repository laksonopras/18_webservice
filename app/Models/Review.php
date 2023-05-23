<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id', 'partner_id', 'rating', 'description'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function partner(){
        return $this->belongsTo(Partner::class);
    }
}
