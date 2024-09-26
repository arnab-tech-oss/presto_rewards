<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Qr;
use App\Models\CouponRequest;

class Coupon extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $fillable = [
        'coupon_code',
        'coupon_request_id',
        'customer_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'digital'
    ];

    public function couponRequest()
    {
        return $this->belongsTo(CouponRequest::class,'coupon_request_id','id');
    }

    public function qr()
    {
        return $this->hasMAny(Qr::class,'coupon_id','id');
    }
}
