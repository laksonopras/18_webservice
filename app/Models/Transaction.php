<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Transaction extends Model
{
    use HasFactory;

    // protected $primaryKey = 'id';
    // public $incrementing = false;

    protected $fillable = [
        'id', 'package_name', 'count_month', 'price', 'partner_id', 'admin_id', 'payment_proof', 'status', 'date_start', 'date_end'
    ];

    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $incrementing = FALSE;
    protected $keyType = 'string';
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Uuid::uuid4();
            }
        });
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
