<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_start', 'date_end', 'transaction_id', 'partner_id'
    ];

    public function partner(){
        return $this->belongsTo(Partner::class);
    }

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }
}
