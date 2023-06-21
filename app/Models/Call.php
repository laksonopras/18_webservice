<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'partner_id', 'link_google_map', 'order_status', 'message', 'address'
    ];

    public function user(){ return $this->belongsTo(User::class); }

    public function partner(){ return $this->belongsTo(Partner::class); }
    
    public function progres(){ return $this->belongsTo(Kemajuan::class, 'order_status'); }
}
