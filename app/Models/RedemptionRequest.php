<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class RedemptionRequest extends Model
{
    use HasFactory,Notifiable,SoftDeletes;

    protected $fillable = [
        'customer_id',
        'product_id',
        'request_date_time',
        'status',
        'admin_comment',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class,);
    }
}
