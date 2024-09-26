<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Company;

class CouponRequest extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $fillable = [
        'no_of_coupons',
        'product_id',
        'company_id',
        'description',
        'status',
        'amount',
        'expiry_date',
        'category_id',
        'digital'
    ];

    public function coupon()
    {
        return $this->hasMany(Coupon::class,'coupon_request_id','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
