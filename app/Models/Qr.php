<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Coupon;

class Qr extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $fillable = [
        'image',
        'status',
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class,'coupon_id','id');
    }
}
