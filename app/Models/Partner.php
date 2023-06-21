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
        'description',
        'count_order',
        'account_status',
        'operational_status',
        'category_id',
        'admin_id',
        'user_id',
        'link_google_map',
        'village',
        'district',
        'city_id',
        'postal_code'

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
