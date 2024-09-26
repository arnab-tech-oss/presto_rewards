<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Wallet extends Model
{
    use HasFactory,HasApiTokens,Notifiable,SoftDeletes;

    protected $fillable = [
        'customer_id',
        'balance',
        'lifetime_credit',
        'lifetime_debit',
        'created_at',
        'updated_at'
    ];

    public function transaction()
    {
        return $this->hasMany(WalletTransaction::class,'wallet_id','id');
    }
    public function walletlist()
    {
        return $this->hasOne(Customer::class,'id','customer_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
