<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [ 
        'id','quantity', 'sub_price', 'price', 'partner_id', 'admin_id', 'payment_proof', 'status'
    ];
    
    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function partner(){
        return $this->belongsTo(Partner::class);
    }
}