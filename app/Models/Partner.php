<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $fillable = [
        'partner_name',
        'email',
        'address',
        'avatar',
        'phone_number',
        'coordinate',
        'description',
        'count_order',
        'account_status',
        'operational_status',
        'category_id',
        'admin_id',
        'user_id',
        'token'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    
}
