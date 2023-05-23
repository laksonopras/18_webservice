<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'partner_id', 'technisian_id', 'customer_coordinate', 'order_status'
    ];

    public function custoemr(){
        return $this->belongsTo(Customer::class);
    }

    public function technisian(){
        return $this->belongsTo(Technician::class);
    }

    public function partner(){
        return $this->belongsTo(Partner::class);
    }

}
