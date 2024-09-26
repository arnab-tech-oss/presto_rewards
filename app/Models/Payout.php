<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Psy\CodeCleaner\AssignThisVariablePass;

class Payout extends Model
{
    use HasFactory,HasApiTokens,Notifiable;
    protected $fillable = [
        'ref_no',
        'cus_id',
        'amount',
        'payment_type',
        'upi_id',
        'bank_ac',
        'ifsc',
        'phone',
        'customer_name',
        'created_at',
        'updated_at',
        'bank',
        'bank_ref',
        'status',
        'seq_no'
    ];

    public function transaction()
    {
        return $this->hasOne(PayoutTransaction::class,);
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'cus_id','id');
    }
}
